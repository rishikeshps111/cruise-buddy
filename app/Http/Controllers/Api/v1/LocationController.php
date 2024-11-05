<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\v1\LocationResource;
use App\Models\Location;
use Spatie\QueryBuilder\QueryBuilder;

class LocationController extends Controller
{
    public function index()
    {
        $page_limit = request()->query('page_limit') ?: 20;

        $locations = QueryBuilder::for(Location::class)
            ->allowedFilters([
                'location',
                'district',
                'state'
            ])
            ->allowedSorts('location')
            ->paginate($page_limit)
            ->withQueryString();

        return LocationResource::collection($locations);
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Location $location)
    {
        return new LocationResource($location);
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
