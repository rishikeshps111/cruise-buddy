<?php

namespace App\Http\Controllers\Admin;

use App\Models\Location;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLocationRequest;
use App\Http\Requests\UpdateLocationRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;



class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('2_AdminPanel.4_Pages.3_Locations.location');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $action = $request->get('action', 'store');
        $itemId = $request->get('id');
        $size = $request->get('size', 'modal-md');
        $data = ($action === 'edit' && $itemId) ? Location::find($itemId) : null;

        return response()->json([
            'title' => $action === 'edit' ? 'Edit Location' : 'Add New Location',
            'size' => $size,
            'content' => view('2_AdminPanel.4_Pages.3_Locations.Form.form', compact('data'))->render(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLocationRequest $request)
    {
        $data = $request->validated();
        $thumbnail = $data['thumbnail'] ?? null;

        if ($thumbnail) {
            $data['thumbnail'] = $thumbnail->store('locations/' . Str::random(), 'public');
        }

        $location = Location::create($data);

        return response()->json([
            'message' => 'Location Added Successfully',
            'data' => $location,
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Location $location)
    {
        return response()->json([
            'title' => 'Location Details',
            'size' => 'modal-md',
            'content' => view('2_AdminPanel.4_Pages.3_Locations.View.view', compact('location'))->render(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Location $location)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLocationRequest $request, Location $location)
    {
        $data = $request->validated();
        $thumbnail = $data['thumbnail'] ?? null;

        // dd($location->thumbnail);

        if ($thumbnail) {
            if ($location->thumbnail) {
                $directoryPath = dirname($location->thumbnail);
                Storage::disk('public')->deleteDirectory($directoryPath);
            }
            $data['thumbnail'] = $thumbnail->store('locations/' . Str::random(), 'public');
        }

        $location->update($data);

        return response()->json([
            'message' => $data['name'] . ' Details Updated Successfully',
            'data' => $location,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Location $location)
    {

        $directory = dirname($location->thumbnail);

        if (Storage::disk('public')->exists($directory)) {
            Storage::disk('public')->deleteDirectory($directory);
        }

        $location->delete();

        return response()->json([
            'message' => 'Location ' . $location->name . ' Deleted Successfully',
            'data' => $location,
        ], 200);
    }

    public function list()
    {
        $locations = Location::orderBy('created_at', 'desc')->get();

        return response()->json($locations);
    }
}
