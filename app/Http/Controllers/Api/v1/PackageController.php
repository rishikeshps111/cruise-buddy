<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\Rating;
use App\Models\Package;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;
use App\Filters\Package\CruiseTypeFilter;
use App\Filters\Package\CruiseModelFilter;
use App\Http\Resources\Api\v1\PackageResource;
use App\Filters\Package\UnavailableDatesFilter;
use App\Http\Resources\Api\v1\UnavailableDateResource;

class PackageController extends Controller
{
    public function index()
    {
        $page_limit = request()->query('limit') ?: 20;

        $packages = QueryBuilder::for(Package::class)
            ->allowedIncludes([
                'cruise.cruiseType',
                'itineraries',
                'amenities',
                'food',
                'packageImages',
                'bookingTypes',
                'unavailableDates',
            ])
            ->allowedFilters([
                AllowedFilter::exact('amenities.name'),
                AllowedFilter::custom('dateRange', new UnavailableDatesFilter),
                AllowedFilter::custom('cruiseType.model_name', new CruiseModelFilter),
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
                'cruise.cruiseType',
                'itineraries',
                'amenities',
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

    public function destroy(Package $package)
    {
        $package->forceDelete();
        return response()->json([
            'message' => 'Package was deleted successfully'
        ], 201);
    }
    public function unavailableDate($id)
    {
        $package = Package::find($id);
        $unavailable_date = $package->unavailableDates()->get();
        return UnavailableDateResource::collection($unavailable_date);
    }

    public function featuredPackage()
    {
        $page_limit = request()->query('limit') ?: 10;
        $packages = QueryBuilder::for(Package::class)
            ->allowedSorts('avg_rating')
            ->defaultSort('-avg_rating')
            ->allowedIncludes([
                'cruise.cruisesImages',
                'packageImages'
            ])
            ->select('packages.*') // Ensure you select the base table fields
            ->addSelect([
                'avg_rating' => Rating::selectRaw('AVG(rating)')
                    ->whereColumn('cruise_id', 'cruises.id') // Link to related cruises
            ])
            ->join('cruises', 'cruises.id', '=', 'packages.cruise_id') // Join related cruises
            ->groupBy('packages.id') // Prevent ambiguity errors with aggregates
            ->orderByDesc('avg_rating') // Sort by average rating
            ->limit(20)
            ->paginate($page_limit)
            ->withQueryString();

        return $packages;
        return PackageResource::collection($packages);
    }
}
