<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\v1\CruiseResource;
use App\Models\Cruise;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

class CruiseController extends Controller
{
    public function index()
    {
        $page_limit = request()->query('page_limit') ?: 20;
        $cruise = QueryBuilder::for(Cruise::class)
            ->allowedIncludes(['location', 'cruise_type', 'cruises_images' , 'owner.user'])
            ->allowedFilters([
                'location.name',
                'cruise_type.model_name',
                'cruise_type.type',
            ])
            ->paginate($page_limit)->withQueryString();

        return CruiseResource::collection($cruise);
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Cruise $cruise)
    {
        $query = QueryBuilder::for(Cruise::class)
            ->allowedIncludes(['location', 'cruise_type', 'owner.user'])
            ->with('cruises_images');
        $cruise = $query->find($cruise->id);
        return new CruiseResource($cruise);
    }

    public function update(Request $request, Cruise $cruise)
    {
        //
    }

    public function destroy(Cruise $cruise)
    {
        //
    }
}
