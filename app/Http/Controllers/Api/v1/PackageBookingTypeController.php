<?php

namespace App\Http\Controllers\Api\v1;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\PackageBookingType;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\v1\PackageBookingTypeResource;

class PackageBookingTypeController extends Controller
{
    public function index()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(PackageBookingType $packageBookingType)
    {
        $packageBookingType->load(['priceRule' => function ($query) {
            $query->whereDate('start_date', '>=', Carbon::today())
                ->orWhereDate('end_date', '>=', Carbon::today());
        }]);

        return new PackageBookingTypeResource($packageBookingType);
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
