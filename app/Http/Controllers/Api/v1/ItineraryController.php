<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\v1\ItineraryResource;
use App\Models\Itinerary;
use Illuminate\Http\Request;

class ItineraryController extends Controller
{
    public function index(int $package_id)
    {
        $itineraries = Itinerary::where('package_id', $package_id)->get();
        return ItineraryResource::collection($itineraries);
    }

    public function store(Request $request)
    {
        //
    }

    public function show(int $package_id, int $id)
    {
        $itinerary = Itinerary::where('package_id', $package_id)
            ->where('id', $id)
            ->first();
        if ($itinerary) {
            return new ItineraryResource($itinerary);
        }
        return response()->json([
            'message' => "No itinerary founded",
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
