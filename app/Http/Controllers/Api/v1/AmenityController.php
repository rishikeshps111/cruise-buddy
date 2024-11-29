<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\v1\AmenityResource;
use App\Models\Package;
use Illuminate\Http\Request;

class AmenityController extends Controller
{
    public function index(int $package_id)
    {
        $package = Package::find($package_id);
        $amenities = $package->amenities()->get();
        return AmenityResource::collection($amenities);
    }

    public function store(Request $request)
    {
        //
    }

    public function show(int $package_id, int $id)
    {
        $package = Package::find($package_id);
        $amenity = $package->amenities->where('id', $id)->first();
        if ($amenity) {
            return new AmenityResource($amenity);
        }

        return response()->json([
            'message' => "No amenity founded",
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
