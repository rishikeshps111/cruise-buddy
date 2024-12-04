<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class UpdateCruiseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function messages(): array
    {
        return [
            'rooms.required' => 'Rooms is required.',
            'rooms.numeric' => 'Rooms must be a number.',
            'rooms.min' => 'Rooms must be at least 1.',
            'rooms.max' => 'Rooms must be no more than 8.',

            'max_capacity.required' => 'Max Capacity is required.',
            'max_capacity.numeric' => 'Max Capacity must be a number.',
            'max_capacity.min' => 'Max Capacity must be at least 1.',
            'max_capacity.max' => 'Max Capacity must be no more than 50.',

            'description.required' => 'Description is required.',
            'description.string' => 'Description must be a valid string.',
            'description.max' => 'Description must not exceed 200 characters.',
        ];
    }

    public function rules(): array
    {
        return [
            'name' => ['required', Rule::unique('cruises')->ignore($this->id)],
            'owner_id' => ['required'],
            'cruise_type_id' => ['required'],
            'location_id' => ['required'],
            'rooms' => [
                'required',
                'numeric',
                'min:1',
                'max:8',
            ],
            'max_capacity' => [
                'required',
                'numeric',
                'min:1',
                'max:50',
            ],
            'description' => [
                'required',
                'string',
                'max:200',
            ],
            'slug' => [
                'required',
                Rule::unique('cruises')->ignore($this->id)
            ],
            'is_active' => [
                'required',
            ],
        ];
    }
}
