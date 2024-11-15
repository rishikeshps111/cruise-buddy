<?php

namespace App\Http\Requests\Api\v1;

use App\Models\Booking;
use Carbon\Carbon;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class BookingRequest extends FormRequest
{

    protected $user;

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
        return [
            'packageId' => 'required',
            'bookingTypeId' => 'nullable|numeric',
            'totalAmount' => 'nullable|numeric',
            'minimum_amount_paid' => 'nullable|numeric',
            'customerNote' => 'nullable|between:10,5000',
            'startDate' => 'required|date',
            'endDate' => 'sometimes|required|date'
        ];
    }

    public function getAvailability($bookingDates)
    {
        $startDate = Carbon::parse($bookingDates['startDate']);
        $endDate = isset($value['endDate']) ? Carbon::parse($bookingDates['endDate']) : Carbon::parse($bookingDates['startDate']);

        $unavailableDates = Booking::where(function ($query) use ($startDate, $endDate) {
            $query->whereNot('fulfillment_status', 'cancelled')
                ->whereBetween('start_date', [$startDate, $endDate])
                ->orWhereBetween('end_date', [$startDate, $endDate])
                ->orWhere(function ($query) use ($startDate, $endDate) {
                    $query->where('start_date', '<=', $startDate)
                        ->where('end_date', '>=', $endDate);
                });
        })->get();
        return $unavailableDates;
    }

    public function store()
    {
        $order_id = IdGenerator::generate([
            'table' => 'bookings',
            'field' => 'order_id',
            'length' => 10,
            'prefix' => 'INV-'
        ]);
        $data = [
            'order_id' => $order_id,
            'user_id' => $this->user->hasRole('user') ? $this->user->id : null,
            'package_id' => $this->packageId,
            'booking_type_id' => $this->bookingTypeId,
            'total_amount' => $this->totalAmount,
            'amount_paid' => $this->amountPaid,
            'balance_amount' => $this->balanceAmount,
            'customer_note' => $this->customerNote,
            'start_date' => $this->startDate,
            'end_date' => $this->endDate,
            'booked_by_user' => $this->user->hasRole('user') ? true : false,
        ];
        $booking = Booking::create($data);

        return $booking;
    }
}
