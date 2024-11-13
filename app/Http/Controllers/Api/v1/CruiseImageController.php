<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\v1\CruiseImageResource;
use Spatie\QueryBuilder\QueryBuilder;
use App\Models\CruisesImage;

class CruiseImageController extends Controller
{
    public function index()
    {
        $page_limit = request()->query('limit') ?: 20;
        $cruise = QueryBuilder::for(CruisesImage::class)
            ->allowedIncludes(['cruise'])
            ->paginate($page_limit)->withQueryString();

        return CruiseImageResource::collection($cruise);
    }

    public function store(Request $request)
    {
        //
    }

    public function show(CruisesImage $cruiseImage)
    {
        $query = QueryBuilder::for(CruisesImage::class)
            ->allowedIncludes(['cruise']);
        $cruiseImage = $query->find($cruiseImage->id);
        return new CruiseImageResource($cruiseImage);
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
