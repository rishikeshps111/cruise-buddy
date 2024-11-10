<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\v1\ItineraryResource;
use App\Models\Itinerary;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

class ItineraryController extends Controller
{
    public function index()
    {
        $page_limit = request()->query('page_limit') ?: 20;
        $itineraries = QueryBuilder::for(Itinerary::class)
            ->allowedIncludes(['package'])
            ->with(['package'])
            ->paginate($page_limit)
            ->withQueryString();
        return ItineraryResource::collection($itineraries);
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Itinerary $itinerary)
    {
        $query = QueryBuilder::for(Itinerary::class)
            ->allowedIncludes(['package'])
            ->with('cruises_images');
        $itinerary = $query->find($itinerary->id);
        return new ItineraryResource($itinerary);
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
