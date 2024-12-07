<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\FavoriteRequest;
use App\Http\Resources\Api\v1\FavoriteResource;
use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;
use Spatie\QueryBuilder\QueryBuilder;

class FavoriteController extends Controller
{
    public function index()
    {
        $page_limit = request()->query('limit') ?: 20;
        $favorites = QueryBuilder::for(Favorite::class)
            ->allowedIncludes([
                'user',
                'package.cruise',
                'package.cruise.cruiseType',
                'package.cruise.ratings',
                'package.itineraries',
                'package.amenities',
                'package.food',
                'package.packageImages',
                'package.bookingTypes'
            ])
            ->where('user_id', Auth::user()->id)
            ->paginate($page_limit)
            ->withQueryString();
        return FavoriteResource::collection($favorites);
    }

    public function store(FavoriteRequest $request)
    {
        return response()->json([
            'favorite' => new FavoriteResource($request->store())
        ], 201);
    }

    public function show(Favorite $favorite)
    {
        $query = QueryBuilder::for(Favorite::class)
            ->allowedIncludes([
                'user',
                'package.cruise',
                'package.cruise.cruiseType',
                'package.cruise.ratings',
                'package.itineraries',
                'package.amenities',
                'package.food',
                'package.packageImages',
                'package.bookingTypes'
            ]);
        $rating = $query->find($favorite->id);
        return new FavoriteResource($rating);
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(Favorite $favorite)
    {
        $favorite->forceDelete();
        return response()->json([
            'message' => 'Removed successfully'
        ], 201);
    }
}
