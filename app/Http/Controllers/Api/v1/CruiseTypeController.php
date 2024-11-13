<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\v1\CruiseTypeResource;
use App\Models\CruiseType;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

class CruiseTypeController extends Controller
{
    public function index()
    {
        $cruise_types = QueryBuilder::for(CruiseType::class)->get();
        return CruiseTypeResource::collection($cruise_types);
    }

    public function store(Request $request)
    {
        //
    }

    public function show(CruiseType $cruise_type)
    {
        return new CruiseTypeResource($cruise_type);
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
