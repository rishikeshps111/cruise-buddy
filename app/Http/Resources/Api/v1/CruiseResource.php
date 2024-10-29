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
            'images' => $this->cruises_images,
            'location' => new LocationResource($this->whenLoaded('location')),
            'cruiseType' => new LocationResource($this->whenLoaded('cruise_type')),
            'owner' => new LocationResource($this->whenLoaded('owner'))
        ];
    }
}
