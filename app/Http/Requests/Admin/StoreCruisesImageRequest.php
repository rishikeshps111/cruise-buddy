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
            'images.required' => 'Please select any images.',
        ];
    }


    public function rules(): array
    {
        return [
            'images' => ['required'],
            'images.*' => ['image', 'max:2048'],
        ];
    }
}
