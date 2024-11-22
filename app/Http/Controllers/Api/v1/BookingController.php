<?php

namespace App\Http\Controllers\Api\v1;

use Carbon\Carbon;
use App\Models\Booking;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Spatie\QueryBuilder\QueryBuilder;
use App\Http\Requests\Api\v1\BookingRequest;
use App\Http\Resources\Api\v1\BookingResource;

class BookingController extends Controller
{
    protected $user;
    public function __construct()
    {
        $this->user = Auth::user();
    }
    public function index()
    {
        $bookings = QueryBuilder::for(Booking::class)
            ->allowedIncludes(['package.cruise.owner'])
            ->where('user_id', $this->user->id)
            ->paginate()
            ->withQueryString();
        return BookingResource::collection($bookings);
    }

    public function store(BookingRequest $request)
    {
        $unavailableDates = $request->getAvailability();
        if (!$unavailableDates->isEmpty()) {
            return response()->json([
                'message' => "We regret to inform you that there are no scheduled dates available for this cruise.",
            ], 404);
        }
        return response()->json([
            'booking' => new BookingResource($request->store())
        ], 201);
    }

    public function show(Booking $booking)
    {
        $data = QueryBuilder::for(Booking::class)
            ->where('id', $booking->id)
            ->where('user_id', $this->user->id)
            ->first();

        if ($data) {
            return new BookingResource($data);
        }
        return response()->json([
            'message' => "We regret to inform you that there are no bookings associated with this user.",
        ], 404);
    }

    public function update(BookingRequest $request, Booking $booking)
    {
        $startDate = Carbon::parse($request->startDate)->toDateString();
        $endDate = Carbon::parse($request->endDate)->toDateString();

        $existingStartDate = Carbon::parse($booking->start_date)->toDateString();
        $existingEndDate = Carbon::parse($booking->end_date)->toDateString();

        if (($startDate >= $existingStartDate && $startDate <= $existingEndDate) &&
            ($endDate >= $existingStartDate && $endDate <= $existingEndDate) &&
            $request->packageId == $booking->package_id
        ) {
            return response()->json([
                'booking' => new BookingResource($request->update($booking))
            ], 201);
        }

        $unavailableDates = $request->getAvailability();
        if (!$unavailableDates->isEmpty()) {
            return response()->json([
                'message' => "We regret to inform you that there are no scheduled dates available for this cruise.",
            ], 404);
        }

        return response()->json([
            'booking' => new BookingResource($request->update($booking))
        ], 201);
    }

    public function destroy(string $id)
    {
        //
    }

    public function bookingOwner($id)
    {
        $bookings = QueryBuilder::for(Booking::class)
            ->allowedIncludes(['package.cruise.owner.user'])
            ->whereHas('package.cruise.owner', function ($query) use ($id) {
                $query->where('user_id', $id);
            })
            ->paginate()
            ->withQueryString();
        return BookingResource::collection($bookings);
    }
    public function bookingCruise($id)
    {
        $bookings = QueryBuilder::for(Booking::class)
            ->allowedIncludes(['package.cruise.owner.user'])
            ->whereHas('package.cruise', function ($query) use ($id) {
                $query->where('id', $id);
            })
            ->whereHas('package.cruise.owner', function ($query) use ($id) {
                $query->where('user_id', $this->user->id);
            })
            ->paginate()
            ->withQueryString();
        return BookingResource::collection($bookings);
    }
}
