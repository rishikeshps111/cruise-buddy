<?php

namespace App\Http\Requests\Admin;

use App\Models\Cruise;
use App\Models\Package;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePackageRequest extends FormRequest
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
                        // Check if the category already exists for this cruise, ignoring the current record
                        $exists = Package::where('cruise_id', $cruiseId)
                            ->where('name', $value)
                            ->where('id', '!=', $this->route('package')->id) // Ignore current package during update
                            ->exists();

                        if ($exists) {
                            $fail(toCamelCase($value) . " package already exists for this cruise.");
                        }
                    } else {
                        $fail('Invalid cruise_slug provided.');
                    }
                },
            ],
            'description' => ['required', 'string', 'max:300'],
            'slug' => [
                'required',
                Rule::unique('packages')->ignore($this->id)
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
                'nullable'
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
            'slug.unique' => 'The slug must be unique.',
        ];
    }
}
