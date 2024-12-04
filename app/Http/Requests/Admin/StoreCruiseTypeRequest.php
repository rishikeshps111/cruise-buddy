<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class StoreCruiseTypeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function messages(): array
    {
        return [
            'model_name.unique' => 'A Cruise Type with this model name and type already exists.',
        ];
    }

    public function rules(): array
    {
        return [
            'model_name' => [
                'required',
                Rule::unique('cruise_types')->where(function ($query) {
                    return $query->where('type', $this->type);
                }),
            ],
            'type' => ['required'],
            'image' => ['required', 'image', 'max:2048'],
        ];
    }
}
