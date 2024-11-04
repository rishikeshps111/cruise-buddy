<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\v1\CruiseResource;
use App\Models\Cruise;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

class CruiseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $page_limit = request()->query('page_limit') ?: 20;
        $cruise = QueryBuilder::for(Cruise::class)
            ->allowedIncludes(['location', 'cruise_type', 'owner.user'])
            ->allowedFilters([
                'location.name',
                'cruise_type.model_name',
                'cruise_type.type',
            ])
            ->with('cruises_images')
            ->paginate($page_limit)->withQueryString();

        return CruiseResource::collection($cruise);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Cruise $cruise)
    {
        $query = QueryBuilder::for(Cruise::class)
            ->allowedIncludes(['location', 'cruise_type', 'owner.user'])
            ->with('cruises_images');
        $cruise = $query->find($cruise->id);
        return new CruiseResource($cruise);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
