<?php

namespace App\Http\Resources\Api\v1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PackageResource extends JsonResource
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
            'name' => $this->name,
            'description' => $this->description,
            'isActive' => $this->is_active,
            'cruiseId' => $this->cruise_id,
            'avgRating' => $this->when($this->avg_rating, $this->avg_rating),
            'images' => PackageImageResource::collection($this->whenLoaded('packageImages')),
            'cruise' => new CruiseResource($this->whenLoaded('cruise')),
            'amenities' => AmenityResource::collection($this->whenLoaded('amenities')),
            'food' => FoodResource::collection($this->whenLoaded('food')),
            'itineraries' => ItineraryResource::collection($this->whenLoaded('itineraries')),
            'bookingTypes' => BookingTypeResource::collection($this->whenLoaded('bookingTypes')),
            'unavailableDate' => UnavailableDateResource::collection($this->whenLoaded('unavailableDates'))
        ];
    }
}
