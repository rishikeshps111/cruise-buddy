<?php

namespace App\Http\Resources\Api\v1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CruiseResource extends JsonResource
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
            'rooms' => $this->rooms,
            'maxCapacity' => $this->max_capacity,
            'description' => $this->description,
            'isActive' => $this->is_active,
            'default_price' => $this->when($this->default_price, $this->default),
            'avgRating' => $this->when($this->avg_rating, $this->avg_rating),
            'cruiseType' => new CruiseTypeResource($this->whenLoaded('cruiseType')),
            'images' => CruiseImageResource::collection($this->whenLoaded('cruisesImages')),
            'location' => new LocationResource($this->whenLoaded('location')),
            'owner' => new OwnerResource($this->whenLoaded('owner')),
            'packages' => PackageResource::collection($this->whenLoaded('packages')),
        ];
    }
}
