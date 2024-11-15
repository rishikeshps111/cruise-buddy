<?php

namespace App\Http\Resources\Api\v1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RatingResource extends JsonResource
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
            'userId' => $this->user_id,
            'cruiseId' => $this->cruise_id,
            'rating' => $this->rating,
            'description' => $this->description,
            'user' => new UserResource($this->whenLoaded('user')),
            'cruises' => new CruiseResource($this->whenLoaded('cruises'))
        ];
    }
}
