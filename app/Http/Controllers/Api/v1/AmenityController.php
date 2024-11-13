<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\v1\AmenityResource;
use App\Models\Amenity;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

class AmenityController extends Controller
{
    public function index()
    {
        $amenities = QueryBuilder::for(Amenity::class)
            ->allowedIncludes(['packages'])
            ->get();
        return AmenityResource::collection($amenities);
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Amenity $amenity)
    {
        $query = QueryBuilder::for(Amenity::class)
            ->allowedIncludes(['packages']);
        $amenity = $query->find($amenity->id);
        return new AmenityResource($amenity);
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
