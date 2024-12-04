<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreCruisesImageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function messages(): array
    {
        return [
            'cruise_images.required' => 'Please select any images.',
        ];
    }


    public function rules(): array
    {
        return [
            'cruise_images' => ['required'],
            'cruise_images.*' => ['image', 'max:2048'],
        ];
    }
}
