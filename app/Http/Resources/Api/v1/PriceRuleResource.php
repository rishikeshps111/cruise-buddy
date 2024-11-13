<?php

namespace App\Http\Resources\Api\v1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PriceRuleResource extends JsonResource
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
            'bookingTypeId' => $this->booking_type_id,
            'priceType' => $this->price_type,
            'price' => $this->price,
            'comparePrice' => $this->compare_price,
            'minAmountToPay' => $this->min_amount_to_pay,
            'pricePerPerson' => $this->price_per_person,
            'pricePerBed' => $this->price_per_bed,
            'startDate' => $this->start_date,
            'endDate' => $this->end_date,
            'isActive' => $this->is_active
        ];
    }
}
