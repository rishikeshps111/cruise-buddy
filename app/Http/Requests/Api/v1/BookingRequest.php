<?php

namespace App\Http\Requests\Api\v1;

use App\Models\Booking;
use App\Models\Cruise;
use App\Models\Package;
use Carbon\Carbon;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class BookingRequest extends FormRequest
{

	protected $user;
	protected $totalAmount;

	public function __construct()
	{
		$this->user = Auth::user();
	}

	public function authorize(): bool
	{
		return true;
	}

	public function rules(): array
	{
		if ($this->isMethod('post')) {
			return [
				'packageId' => 'required',
				'bookingTypeId' => 'required|nullable|numeric',
				'totalAmount' => 'nullable|numeric',
				'customerNote' => 'nullable|between:10,5000',
				'startDate' => 'required|date_format:Y-m-d|before_or_equal:endDate',
				'endDate' => 'sometimes|required|date_format:Y-m-d|after_or_equal:startDate'
			];
		}
		return [
			'packageId' => 'sometimes|required',
			'bookingTypeId' => 'nullable|numeric',
			'totalAmount' => 'nullable|numeric',
			'customerNote' => 'nullable|between:10,5000',
			'startDate' => 'sometimes|required|date_format:Y-m-d|before_or_equal:endDate',
			'endDate' => 'sometimes|required|date_format:Y-m-d|after_or_equal:startDate'
		];
	}

	public function getAvailability()
	{
		$startDate = Carbon::parse($this->startDate)->startOfDay();
		$endDate = $this->endDate ? Carbon::parse($this->startDate)->endOfDay() : Carbon::parse($this->startDate)->startOfDay();
		$package = Package::where('id', $this->packageId)->first();
		$unavailablePackage = Cruise::where('id', $package->cruise_id)
			->whereHas('packages.bookings', function ($query) use ($startDate, $endDate) {
				$query->whereNotIn('fulfillment_status', ['cancelled', 'payment_failed', 'blocked_by_owner'])
					->whereBetween('start_date', [$startDate, $endDate])
					->orWhereBetween('end_date', [$startDate, $endDate])
					->orWhere(function ($query) use ($startDate, $endDate) {
						$query->where('start_date', '<=', $startDate)
							->where('end_date', '>=', $endDate);
					});
			})
			->get();
		return $unavailablePackage;
	}

	public function store()
	{
		$invoice_id = IdGenerator::generate([
			'table' => 'bookings',
			'field' => 'order_id',
			'length' => 10,
			'prefix' => 'INV-'
		]);
		$this->calculateTotalAmount();
		$data = [
			'invoice_id' => $invoice_id,
			'order_id' => $this->order_id,
			'user_id' => $this->user->hasRole('user') ? $this->user->id : null,
			'package_id' => $this->packageId,
			'booking_type_id' => $this->bookingTypeId,
			'veg_count' => $this->vegCount,
			'non_veg_count' => $this->nonVegCount,
			'jain_veg_count' => $this->jainVegCount,
			'total_amount' => $this->totalAmount,
			'balance_amount' => $this->totalAmount,		// initial declaration
			'customer_note' => $this->customerNote,
			'fulfillment_status' => $this->user->hasRole('user') ? $this->fulfillment_status : 'self_booking',
			'start_date' => $this->startDate,
			'end_date' => $this->endDate ?: $this->startDate,
			'booked_by_user' => $this->user->hasRole('user') ? true : false,
		];
		$booking = Booking::create($data);

		return $booking;
	}

	public function update($booking)
	{
		$data = [
			'user_id' => $this->user->hasRole('user') ? $this->user->id : null,
			'order_id' => $this->order_id,
			'package_id' => $this->packageId,
			'booking_type_id' => $this->bookingTypeId,
			'veg_count' => $this->vegCount,
			'non_veg_count' => $this->nonVegCount,
			'jain_veg_count' => $this->jainVegCount,
			'total_amount' => $this->totalAmount,
			'balance_amount' => $this->totalAmount,	// initial declaration
			'customer_note' => $this->customerNote,
			'fulfillment_status' => $this->user->hasRole('user') ? $this->fulfillment_status : 'self_booking',
			'start_date' => $this->startDate,
			'end_date' => $this->endDate ?: $this->startDate,
			'booked_by_user' => $this->user->hasRole('user') ? true : false,
		];
		$booking->update($data);
		return $booking;
	}
	protected function calculateTotalAmount()
	{
		$package = Package::find($this->packageId);
		if (!$package->bookingTypes()->where('booking_type_id', $this->bookingTypeId)->exists()); {
			throw ValidationException::withMessages([
				'bookingTypeId' => 'No booking type is related with this package',
			]);
		}
		$number_of_beds = $this->numberOfBeds ?: 1;
		$number_of_adults = $this->numberOfBeds ?: 1;
		$number_of_children = $this->numberOfBeds ?: 1;
	}
}
