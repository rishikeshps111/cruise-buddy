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
            'cruise_id' => $this->cruise_id,
            'packageId' => $this->package_id,
            'package' => new PackageResource($this->whenLoaded('package')),
            'bookingTypeId' => $this->booking_type_id,
            'vegCount' => $this->veg_count,
            'nonVegCount' => $this->non_veg_count,
            'jainVegCount' => $this->jain_veg_count,
            'totalAmount' => $this->total_amount,
            'amountPaid' => $this->amount_paid,
            'balanceAmount' => $this->balance_amount,
            'customerNote' => $this->customer_note,
            'startDate' => date_format($this->start_date, 'Y-m-d'),
            'endDate' => date_format($this->end_date, 'Y-m-d'),
            'fulfillmentStatus' => $this->fulfillment_status,
            'bookedByUser' => $this->booked_by_user,
            'isActive' => $this->is_active
        ];
    }
}
