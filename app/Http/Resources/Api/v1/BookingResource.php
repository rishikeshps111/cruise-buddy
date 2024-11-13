<?php

namespace App\Http\Resources\Api\v1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'orderId' => $this->order_id,
            'userId' => $this->user_id,
            'packageId' => $this->package_id,
            'bookingTypeId' => $this->booking_type_id,
            'totalAmount' => $this->total_amount,
            'amountPaid' => $this->amount_paid,
            'balanceAmount' => $this->balance_amount,
            'customerNote' => $this->customer_note,
            'startDate' => $this->start_date,
            'endDate' => $this->end_date,
            'fulfillmentStatus' => $this->fulfillment_status,
            'isActive' => $this->is_active
        ];
    }
}
