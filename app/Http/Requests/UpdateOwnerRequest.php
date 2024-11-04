<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateOwnerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users')->ignore($this->user_id),
            ],
            'phone' => [
                'required',
                Rule::unique('users')->ignore($this->user_id),
            ],
            'phone_2' => ['required'],
            'proof_type' => ['required', 'in:aadhaar,passport,driving_license,voter_id'],
            'proof_id' => ['required', 'string', 'max:50'],
            'proof_image' => ['nullable', 'image', 'max:2048'], 
            'avatar' => ['nullable', 'image', 'max:2048'], 
            'status' => ['required', 'boolean'],
        ];
    }
}
