<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\Rating;
use App\Http\Controllers\Controller;
use Spatie\QueryBuilder\QueryBuilder;
use App\Http\Requests\Api\v1\RatingRequest;
use App\Http\Resources\Api\v1\RatingResource;

class RatingController extends Controller
{
    public function index()
    {
        $page_limit = request()->query('limit') ?: 20;
        $ratings = QueryBuilder::for(Rating::class)
            ->allowedIncludes([
                'user',
                'cruise'
            ])
            ->allowedSorts('rating')
            ->defaultSort('-rating')
            ->paginate($page_limit)
            ->withQueryString();
        return RatingResource::collection($ratings);
    }

    public function store(RatingRequest $request)
    {
        return response()->json([
            'rating' => new RatingResource($request->store())
        ], 201);
    }

    public function show(Rating $rating)
    {
        $query = QueryBuilder::for(Rating::class)
            ->allowedIncludes([
                'user',
                'cruise'
            ])
            ->allowedSorts('rating')
            ->defaultSort('-rating');
        $rating = $query->find($rating->id);
        return new RatingResource($rating);
    }

    public function update(RatingRequest $request, Rating $rating)
    {
        $request->store();
        return response()->json([], 200);
    }

    public function destroy(Rating $rating)
    {
        $rating->forceDelete();
        return response()->json([
            'message' => 'Rating was deleted successfully'
        ], 201);
    }
}
