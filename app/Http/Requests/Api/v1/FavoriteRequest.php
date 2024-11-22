<?php

namespace App\Http\Requests\Api\v1;

use App\Models\Favorite;
use Illuminate\Foundation\Http\FormRequest;

class FavoriteRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'userId' => 'required',
            'cruiseId' => 'required'
        ];
    }

    public function store()
    {
        $favorite =  Favorite::create([
            'user_id' => $this->userId,
            'cruise_id' => $this->cruiseId
        ]);
        return $favorite;
    }
}
