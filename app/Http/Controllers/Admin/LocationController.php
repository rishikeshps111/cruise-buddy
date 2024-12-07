<?php

namespace App\Http\Controllers\Admin;

use App\Models\Location;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreLocationRequest;
use App\Http\Requests\Admin\UpdateLocationRequest;
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
                $thumbnailPath = $location->getRawOriginal('thumbnail');
                $directory = dirname($thumbnailPath);
                Storage::disk('public')->deleteDirectory($directory);
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
        $thumbnailPath = $location->getRawOriginal('thumbnail');
        $directory = dirname($thumbnailPath);

        if (Storage::disk('public')->exists($directory)) {
            Storage::disk('public')->deleteDirectory($directory);
        }

        $location->delete();

        return response()->json([
            'message' => 'Location ' . $location->name . ' Deleted Successfully',
            'data' => $location,
        ], 200);
    }

    public function list(Request $request)
    {

        $query = Location::query();

        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->input('name') . '%');
        }
        if ($request->filled('district')) {
            $query->where('district', 'like', '%' . $request->input('district') . '%');
        }
        if ($request->filled('state')) {
            $query->where('state', 'like', '%' . $request->input('state') . '%');
        }
        if ($request->filled('country')) {
            $query->where('country', 'like', '%' . $request->input('country') . '%');
        }

        // Global search (all fields)
        if ($request->filled('search.value')) {
            $search = $request->input('search.value');
            $query->where('name', 'like', '%' . $search . '%')
                ->orWhere('district', 'like', '%' . $search . '%')
                ->orWhere('state', 'like', '%' . $search . '%')
                ->orWhere('country', 'like', '%' . $search . '%');
        }

        if ($request->filled('order') && $request->input('order')[0]['column'] != 0) {
            $orderColumnIndex = $request->input('order')[0]['column']; // Column index
            $orderDirection = $request->input('order')[0]['dir'];     // 'asc' or 'desc'

            // Map DataTables column index to database column names
            $columns = [
                2 => 'name',
                3 => 'district',
                4 => 'state',
                5 => 'country'
            ];

            if (array_key_exists($orderColumnIndex, $columns)) {
                $orderColumn = $columns[$orderColumnIndex];
                $query->orderBy($orderColumn, $orderDirection);
            }
        } else {
            // Default sorting
            $query->orderBy('created_at', 'desc');
        }

        $totalRecords = Location::count();
        $filteredRecords = $query->count();

        // Apply pagination
        $query->skip($request->input('start', 0))
            ->take($request->input('length', 10));

        $locations = $query->get();

        return response()->json([
            'draw' => intval($request->input('draw')),
            'recordsTotal' => $totalRecords,                      // Total records before filtering
            'recordsFiltered' => $filteredRecords,                // Total records after filtering
            'data' => $locations                                       // Data to display
        ]);
    }
}
