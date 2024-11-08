<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\v1\PackageResource;
use App\Models\Package;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

class PackageController extends Controller
{
    public function index()
    {
        $page_limit = request()->query('page_limit') ?: 20;
        $packages = QueryBuilder::for(Package::class)
            ->allowedIncludes([
                'cruise',
                'itineraries',
                'amenity',
                'food',
                'package_images'
            ])
            ->paginate($page_limit)
            ->withQueryString();
        return PackageResource::collection($packages);
    }

    public function store(Request $request)
    {
        //
    }

    public function show(string $id)
    {
        //
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
