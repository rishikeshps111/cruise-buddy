<?php

namespace App\Http\Resources\Api\v1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookingTypeResource extends JsonResource
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
            'packageId' => $this->pivot ?  $this->pivot->package_id : null,
            'name' => $this->name,
            'icon' => $this->icon,
            "price" => $this->pivot ?  $this->pivot->price : null,
            "comparePrice" => $this->pivot ?  $this->pivot->compare_price : null,
            "minAmountToPay" => $this->pivot ?  $this->pivot->min_amount_to_pay : null,
            "pricePerPerson" => $this->pivot ?  $this->pivot->price_per_person : null,
            "pricePerBed" => $this->pivot ?  $this->pivot->price_per_bed : null,
            'priceRules' => PriceRuleResource::collection($this->whenLoaded('priceRules'))
        ];
    }
}
