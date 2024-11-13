<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\v1\OwnerResource;
use App\Models\Owner;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

class OwnerController extends Controller
{
    public function index()
    {
        $page_limit = request()->query('limit') ?: 20;
        $owners = QueryBuilder::for(Owner::class)
            ->with('user')
            ->paginate($page_limit)
            ->withQueryString();
        return OwnerResource::collection($owners);
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Owner $owner)
    {
        $query = QueryBuilder::for(Owner::class)
            ->with('user');
        $owner = $query->find($owner->id);
        return new OwnerResource($owner);
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
