<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\v1\OwnerResource;
use App\Models\Owner;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

class OwnerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $page_limit = request()->query('page_limit') ?: 20;
        $owners = QueryBuilder::for(Owner::class)
            ->with('user')
            ->paginate($page_limit)
            ->withQueryString();
        return OwnerResource::collection($owners);
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
    public function show(Owner $owner)
    {
        $query = QueryBuilder::for(Owner::class)
            ->with('user');
        $owner = $query->find($owner->id);
        return new OwnerResource($owner);
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
