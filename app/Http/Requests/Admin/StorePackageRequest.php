<?php

namespace App\Http\Requests\Admin;

use App\Models\Cruise;
use App\Models\Package;
use Illuminate\Foundation\Http\FormRequest;

class StorePackageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'category' => [
                'required',
                'in:premium,dulex',
                function ($attribute, $value, $fail) {
                    // Fetch cruise ID using cruise_slug
                    $cruiseId = Cruise::where('slug', $this->cruise_slug)
                        ->value('id');

                    if ($cruiseId) {
                        // Check if the category already exists for this cruise
                        $exists = Package::where('cruise_id', $cruiseId)
                            ->where('name', $value)
                            ->exists();

                        if ($exists) {
                            $fail(toCamelCase($value) . " package is already exist to this cruise.");
                        }
                    } else {
                        $fail('Invalid cruise_slug provided.');
                    }
                },
            ],
            'description' => ['required', 'string', 'max:300'],
            'slug' => [
                'required',
                'unique:packages'
            ],
            'is_active' => [
                'required',
                'boolean'
            ],
            'amenities' => [
                'required',
                'array'
            ],
            'amenities.*' => [
                'exists:amenities,id',
            ],
            'images' => [
                'required'
            ],
            'images.*' => [
                'file',
                'mimes:jpg,jpeg,png',
                'max:2048'
            ]
        ];
    }

    public function messages(): array
    {
        return [
            'images.required' => 'At least one image is required.',
            'slug.unique' => 'The slug must be unique.',
        ];
    }
}
