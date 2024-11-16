<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\v1\PackageResource;
use App\Models\Package;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

class PackageController extends Controller
{
    public function index()
    {
        $page_limit = request()->query('limit') ?: 20;

        $packages = QueryBuilder::for(Package::class)
            ->allowedIncludes([
                'cruise',
                'itineraries',
                'amenity',
                'food',
                'packageImages',
                'bookingTypes',
                'unavailableDates',
            ])
            ->allowedFilters([
                'food.title',
                'food.is_veg',
                'amenity.name'
            ])
            ->paginate($page_limit)
            ->withQueryString();
        return PackageResource::collection($packages);
    }

    public function store(Request $request, $cruise_id)
    {
        //
    }

    public function show(Package $package)
    {
        return $package;
        $query = QueryBuilder::for(Package::class)
            ->allowedIncludes([
                'cruise',
                'itineraries',
                'amenity',
                'food',
                'packageImages',
                'bookingTypes',
                'unavailableDates',
            ]);
        $package = $query->find($package->id);
        return new PackageResource($package);
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
