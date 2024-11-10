<?php

namespace App\Http\Resources\Api\v1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ItineraryResource extends JsonResource
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
            'title' => $this->title,
            'time' => $this->time,
            'description' => $this->description,
            'isActive' => $this->is_active
        ];
    }
}
