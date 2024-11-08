<?php

namespace App\Http\Requests\Api\v1;

use Illuminate\Foundation\Http\FormRequest;

class OtpVerifyRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'otp' => 'required|min:4|max:4',
            'phoneNumber' => 'required',
            'countryCode' => 'required'
        ];
    }

    public function passedValidation(): void
    {
        $fields = [
            'phone_number' => 'phoneNumber',
            'country_code' => 'countryCode'
        ];
        $data = [];
        foreach ($fields as $key => $value) {
            if ($this->$value) {
                $data[$key] = $this->$value;
                $this->request->remove($value);
            }
        }
        $this->merge($data);
    }
}
