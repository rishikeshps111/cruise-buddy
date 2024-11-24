<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\Package;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;
use App\Filters\Package\CruiseTypeFilter;
use App\Filters\Package\cruiseModelFilter;
use App\Http\Resources\Api\v1\PackageResource;
use App\Filters\Package\UnavailableDatesFilter;

class PackageController extends Controller
{
    public function index()
    {
        $page_limit = request()->query('limit') ?: 20;

        $packages = QueryBuilder::for(Package::class)
            ->allowedIncludes([
                'cruise.cruiseType',
                'itineraries',
                'amenity',
                'food',
                'packageImages',
                'bookingTypes',
                'unavailableDates',
            ])
            ->allowedFilters([
                AllowedFilter::exact('amenity.name'),
                AllowedFilter::custom('dateRange', new unavailableDatesFilter),
                AllowedFilter::custom('cruiseType.model_name', new cruiseModelFilter),
                AllowedFilter::custom('cruiseType.type', new CruiseTypeFilter)
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
