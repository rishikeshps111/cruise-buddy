<?php

namespace App\Http\Requests\Api\v1;

use App\Models\Rating;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class RatingRequest extends FormRequest
{
    protected $user;
    public function __construct()
    {
        $this->user = Auth::user();
    }
    public function authorize(): bool
    {
        if ($this->user)
            return true;
        else
            return false;
    }

    public function rules(): array
    {
        return [
            'cruiseId' => 'required',
            'rating' => 'required|numeric|in:1,2,3,4,5',
            'description' => 'nullable|string|between:10,5000'
        ];
    }

    public function store()
    {
        $rating = Rating::updateOrCreate(
            [
                'user_id' => $this->user->id,
                'cruise_id' => $this->cruiseId
            ],
            [
                'rating' => $this->rating,
                'description' => $this->description
            ]
        );
        $rating->refresh();
        return $rating;
    }
}
