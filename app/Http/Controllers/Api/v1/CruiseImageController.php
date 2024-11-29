<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\v1\CruiseImageResource;
use Spatie\QueryBuilder\QueryBuilder;
use App\Models\CruisesImage;

class CruiseImageController extends Controller
{
    public function index(int $cruise_id)
    {
        $cruise_images = CruisesImage::where('cruise_id', $cruise_id)->get();
        return CruiseImageResource::collection($cruise_images);
    }

    public function store(Request $request)
    {
        //
    }

    public function show(int $cruise_id, int $id)
    {
        $cruise_image = CruisesImage::where('cruise_id', $cruise_id)
            ->where('id', $id)
            ->first();
        if ($cruise_image) {
            return CruiseImageResource::collection($cruise_image);
        }
        return response()->json([
            'message' => "No image founded",
        ], 404);
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
