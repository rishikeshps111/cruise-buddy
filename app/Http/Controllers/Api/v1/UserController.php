<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\v1\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

class UserController extends Controller
{
    public function index()
    {
        $page_limit = request()->query('limit') ?: 20;
        $users = QueryBuilder::for(User::class)
            ->allowedIncludes('owner')
            ->paginate($page_limit)
            ->withQueryString();
        return UserResource::collection($users);

        // if (request()->query('include', '') && in_array('owner', explode(',', request()->query('include')))) {
        //     // 'owner' is included, do something if needed
        // }
    }

    public function store(Request $request)
    {
        //
    }

    public function show(User $user)
    {
        $user = QueryBuilder::for(User::class)
            ->allowedIncludes('owner')
            ->findOrFail($user->id);
        return new UserResource($user);
    }

    public function update(Request $request, User $user)
    {
        //
    }

    public function destroy(User $user)
    {
        $user->delete();
        return response()->noContent(204);
    }
}
