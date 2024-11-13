<?php

namespace App\Http\Requests\Api\v1;

use App\Models\Booking;
use Carbon\Carbon;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class BookingRequest extends FormRequest
{

    protected $order_id;
    protected $user_id;

    public function __construct()
    {
        $this->user_id = Auth::user()->id;
    }

    public function authorize(): bool
    {
        if ($this->user_id)
            return true;
        else
            return false;
    }

    public function rules(): array
    {
        return [
            'packageId' => 'required',
            'bookingTypeId' => 'required|numeric',
            'totalAmount' => 'required|numeric',
            'minimum_amount_paid' => 'required|numeric',
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
            $query->whereBetween('start_date', [$startDate, $endDate])
                ->orWhereBetween('end_date', [$startDate, $endDate])
                ->orWhere(function ($query) use ($startDate, $endDate) {
                    $query->where('start_date', '<=', $startDate)
                        ->where('end_date', '>=', $endDate);
                });
        })->get();
        return $unavailableDates;
    }

    public function bookingStore()
    {
        $this->order_id = IdGenerator::generate([
            'table' => 'bookings',
            'field' => 'order_id',
            'length' => 10,
            'prefix' => 'INV-'
        ]);

        $data = [
            'order_id' => $this->order_id,
            'user_id' => $this->user_id,
            'package_id' => $this->packageId,
            'booking_type_id' => $this->bookingTypeId,
            'total_amount' => $this->totalAmount,
            'amount_paid' => $this->amountPaid,
            'balance_amount' => $this->balanceAmount,
            'customer_note' => $this->customerNote,
            'start_date' => $this->startDate,
            'end_date' => $this->endDate
        ];
        $booking = Booking::create($data);

        return $booking;
    }
}
