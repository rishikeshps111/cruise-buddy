<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\v1\PackageImageResource;
use App\Models\PackageImage;
use Illuminate\Http\Request;

class PackageImageController extends Controller
{
    public function index(int $package_id)
    {
        $package_images = PackageImage::where('package_id', $package_id)->get();
        return PackageImageResource::collection($package_images);
    }

    public function store(Request $request)
    {
        //
    }

    public function show(int $package_id, int $id)
    {
        $package_image = PackageImage::where('id', $id)
            ->where('package_id', $package_id)
            ->first();
        if ($package_image) {
            return new PackageImageResource($package_image);
        }
        return response()->json([
            'message' => "No images founded",
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
