<?php

namespace App\Http\Controllers\Api\v1;

use App\Filters\DateRangeFilter;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\v1\CruiseResource;
use App\Models\Cruise;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\Enums\FilterOperator;
use Spatie\QueryBuilder\QueryBuilder;

class CruiseController extends Controller
{
    public function index()
    {
        $page_limit = request()->query('limit') ?: 20;
        $cruises = QueryBuilder::for(Cruise::class)
            ->allowedIncludes([
                'packages.bookings',
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
                AllowedFilter::operator('rooms', FilterOperator::DYNAMIC),
                AllowedFilter::operator('max_capacity', FilterOperator::DYNAMIC),
            ])
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
            ], Response::HTTP_NOT_FOUND);
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
}
