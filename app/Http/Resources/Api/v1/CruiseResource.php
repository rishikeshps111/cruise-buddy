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
            'images' => CruiseImageResource::collection($this->whenLoaded('cruises_images')),
            'packages' => PackageResource::collection($this->whenLoaded('packages')),
            'location' => new LocationResource($this->whenLoaded('location')),
            'cruiseType' => new CruiseTypeResource($this->whenLoaded('cruise_type')),
            'owner' => new OwnerResource($this->whenLoaded('owner'))
        ];
    }
}
