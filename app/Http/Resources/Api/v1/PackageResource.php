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
            'ownerId' => $this->owner_id,
            'name' => $this->name,
            'description' => $this->description,
            'isActive' => $this->is_active,
            'cruise' => new CruiseResource($this->whenLoaded('cruise'))
        ];
    }
}
