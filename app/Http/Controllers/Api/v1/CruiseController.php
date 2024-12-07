<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\Cruise;
use App\Models\Rating;
use Illuminate\Http\Request;
use App\Models\PackageBookingType;
use App\Http\Controllers\Controller;
use App\Filters\Cruise\AmenityFilter;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;
use App\Filters\Cruise\DateRangeFilter;
use App\Filters\Cruise\PriceRangeFilter;
use App\Http\Resources\Api\v1\CruiseResource;
use App\Http\Resources\Api\v1\PackageResource;
use App\Models\Package;
use Spatie\QueryBuilder\Enums\FilterOperator;

class CruiseController extends Controller
{
    public function index()
    {
        $page_limit = request()->query('limit') ?: 20;
        $cruises = QueryBuilder::for(Cruise::class)
            ->allowedIncludes([
                'packages.bookings',
                'packages.bookingTypes',
                'packages.amenities',
                'location',
                'cruiseType',
                'cruisesImages',
                'owner.user'
            ])
            ->allowedFilters([
                'location.name',
                AllowedFilter::custom('dateRange', new DateRangeFilter),
                AllowedFilter::custom('priceRange', new PriceRangeFilter),
                AllowedFilter::custom('packagesAmenity', new AmenityFilter),
                AllowedFilter::exact('cruiseType.model_name'),
                AllowedFilter::exact('cruiseType.type'),
                AllowedFilter::operator('rooms', FilterOperator::DYNAMIC),
                AllowedFilter::operator('max_capacity', FilterOperator::DYNAMIC),
            ])
            ->allowedSorts(['default_price', 'created_at', 'avg_rating'])
            ->addSelect([
                'default_price' => PackageBookingType::selectRaw('MIN(price)')
                    ->whereColumn('packages.id', 'package_booking_types.package_id')
                    ->limit(1)
            ])
            ->addSelect([
                'avg_rating' => Rating::selectRaw('AVG(rating)')
                    ->whereColumn('cruise_id', 'cruises.id')
            ])
            ->join('packages', 'cruises.id', '=', 'packages.cruise_id')
            ->paginate($page_limit)->withQueryString();
        return CruiseResource::collection($cruises);
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Cruise $cruise)
    {
        $query = QueryBuilder::for(Cruise::class)
            ->allowedIncludes([
                'packages.bookings',
                'packages.bookingTypes',
                'packages.amenities',
                'location',
                'cruiseType',
                'cruisesImages',
                'owner.user'
            ])
            ->allowedFilters([
                'location.name',
                AllowedFilter::custom('date_range', new DateRangeFilter),
                AllowedFilter::exact('cruiseType.model_name'),
                AllowedFilter::exact('cruiseType.type'),
            ]);
        try {
            $cruise = $query->findOrFail($cruise->id);
            return new CruiseResource($cruise);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => "We regret to inform you that there are no scheduled dates available for this cruise.",
            ], 404);
        }
    }

    public function update(Request $request, Cruise $cruise)
    {
        //
    }

    public function destroy(Cruise $cruise)
    {
        //
    }

    public function featuredCruise()
    {
        $page_limit = request()->query('limit') ?: 10;
        $cruises = QueryBuilder::for(Cruise::class)
            ->allowedSorts('avg_rating')
            ->defaultSort('-avg_rating')
            ->allowedIncludes([
                'cruisesImages',
                'packages.packageImages'
            ])
            ->addSelect([
                'avg_rating' => Rating::selectRaw('AVG(rating)')
                    ->whereColumn('cruise_id', 'cruises.id')
            ])
            ->limit(20)
            ->paginate($page_limit)
            ->withQueryString();
        return $cruises;
        return CruiseResource::collection($cruises);
    }

    public function package($cruise_id)
    {
        $packages = Package::where('cruise_id', $cruise_id)->get();
        return PackageResource::collection($packages);
    }
}
