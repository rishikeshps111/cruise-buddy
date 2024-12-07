<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreAmenityRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function messages(): array
    {
        return [
            'name.unique' => 'The Amenity is already exists'
        ];
    }

    public function rules(): array
    {
        return [
            'name' => ['required','unique:amenities'],
            'icon' => ['required', 'image', 'max:2048'],
        ];
    }
}
