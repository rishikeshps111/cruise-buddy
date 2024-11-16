<?php

namespace App\Http\Resources\Api\v1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OwnerResource extends JsonResource
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
            'proofType' => $this->proof_type,
            'proofId'=> $this->proof_id,
            'proofImage'=> $this->proof_image,
            'countryCode'=> $this->country_code,
            'additionalPhone'=> $this->additional_phone,
            'user' => new UserResource($this->whenLoaded('user'))
        ];
    }
}
