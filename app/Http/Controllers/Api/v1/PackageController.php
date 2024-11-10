<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\v1\PackageResource;
use App\Models\Package;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

class PackageController extends Controller
{
    public function index($cruise_id)
    {
        $packages = QueryBuilder::for(Package::class)
            ->allowedIncludes([
                'cruise',
                'itineraries',
                'amenity',
                'food',
                'package_images'
            ])
            ->where('cruise_id', $cruise_id)
            ->get();
        return PackageResource::collection($packages);
    }

    public function store(Request $request, $cruise_id)
    {
        //
    }

    public function show($cruise_id, Package $package)
    {
        $query = QueryBuilder::for(Package::class)
            ->allowedIncludes([
                'cruise',
                'itineraries',
                'amenity',
                'food',
                'package_images'
            ]);
        $package = $query->find($package->id);
        return new PackageResource($package);
    }

    public function update(Request $request, $cruise_id, string $id)
    {
        //
    }

    public function destroy($cruise_id, string $id)
    {
        //
    }
}
