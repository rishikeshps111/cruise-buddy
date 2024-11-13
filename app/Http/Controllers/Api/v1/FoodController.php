<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\v1\FoodResource;
use App\Models\Food;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

class FoodController extends Controller
{
    public function index()
    {
        $foods = QueryBuilder::for(Food::class)
            ->get();
        return FoodResource::collection($foods);
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Food $food)
    {
        return new FoodResource($food);
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
