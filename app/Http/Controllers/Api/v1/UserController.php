<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\v1\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $page_limit = request()->query('page_limit') ?: 20;
        $users = QueryBuilder::for(User::class)
            ->allowedIncludes('owners')
            ->paginate($page_limit)
            ->withQueryString();
        return UserResource::collection($users);

        // if (request()->query('include', '') && in_array('owners', explode(',', request()->query('include')))) {
        //     // 'owners' is included, do something if needed
        // }
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
    public function show(string $id)
    {
        //
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
    public function destroy(User $user)
    {
        $user->delete();
        return response()->noContent(204);
    }
}
