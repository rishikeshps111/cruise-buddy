<?php

namespace App\Http\Requests\Api\v1;

use App\Models\Favorite;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class FavoriteRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'packageId' => 'required'
        ];
    }

    public function store()
    {
        $favorite =  Favorite::updateOrCreate([
            'user_id' => Auth::user()->id,
            'package_id' => $this->packageId
        ],[]);
        $favorite->refresh();
        return $favorite->load('package', 'user');
    }
}
