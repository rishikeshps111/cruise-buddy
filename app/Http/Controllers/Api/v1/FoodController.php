<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\v1\FoodResource;
use App\Models\Package;
use Illuminate\Http\Request;

class FoodController extends Controller
{
    public function index(int $package_id)
    {
        $package = Package::find($package_id);
        $food = $package->food()->get();
        return FoodResource::collection($food);
    }

    public function store(Request $request)
    {
        //
    }

    public function show(int $package_id, int $id)
    {
        $package = Package::find($package_id);
        $food = $package->food->where('id', $id)->first();
        if ($food) {
            return new FoodResource($food);
        }
        return response()->json([
            'message' => "No food founded",
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
