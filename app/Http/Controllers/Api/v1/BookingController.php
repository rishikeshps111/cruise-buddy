<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\BookingRequest;
use App\Http\Resources\Api\v1\BookingResource;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\QueryBuilder\QueryBuilder;

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
        $bookingDates = $request->only(['startDate', 'endDate']);
        $unavailableDates = $request->getAvailability($bookingDates);
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
            ->get()->first();

        if ($data)
            return new BookingResource($data);
        else
            return response()->json([
                'message' => "We regret to inform you that there are no bookings associated with this user.",
            ], 404);
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }

    public function bookingOwner($owner)
    {
        $bookings = QueryBuilder::for(Booking::class)
            ->allowedIncludes(['package.cruise.owner.user'])
            ->whereHas('package.cruise.owner', function ($query) use ($owner) {
                $query->where('user_id', $owner);
            })
            ->paginate()
            ->withQueryString();
        return BookingResource::collection($bookings);
    }
}