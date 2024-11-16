<?php

namespace App\Http\Resources\Api\v1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PackageBookingTypeResource extends JsonResource
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
            'packageId' => $this->package_id,
            'bookingTypeId' => $this->booking_type_id,
            'price' => $this->price,
            'pricePerDay' => $this->price_per_day,
            'comparePrice' => $this->compare_price,
            'minAmountToPay' => $this->min_amount_to_pay,
            'pricePerPerson' => $this->price_per_person,
            'pricePerBed' => $this->price_per_bed, 
            'priceRules' => PriceRuleResource::collection($this->whenLoaded('priceRule'))
        ];
    }
}
