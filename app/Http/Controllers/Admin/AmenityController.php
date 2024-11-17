<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Amenity;
use App\Http\Requests\Admin\StoreAmenityRequest;
use App\Http\Requests\Admin\UpdateAmenityRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;


class AmenityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('2_AdminPanel.4_Pages.4_Amenities.amenity');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $action = $request->get('action', 'store');
        $itemId = $request->get('id');
        $size = $request->get('size', 'modal-md');
        $data = ($action === 'edit' && $itemId) ? Amenity::find($itemId) : null;

        return response()->json([
            'title' => $action === 'edit' ? 'Edit Amenity' : 'Add New Amenity',
            'size' => $size,
            'content' => view('2_AdminPanel.4_Pages.4_Amenities.Form.form', compact('data'))->render(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAmenityRequest $request)
    {
        $data = $request->validated();
        $icon = $data['icon'] ?? null;

        if ($icon) {
            $data['icon'] = $icon->store('amenity_icons/' . Str::random(), 'public');
        }

        $amenity = Amenity::create($data);

        return response()->json([
            'message' => 'Amenity Added Successfully',
            'data' => $amenity,
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Amenity $amenity)
    {
    
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Amenity $amenity)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAmenityRequest $request, Amenity $amenity)
    {
        $data = $request->validated();
        $icon = $data['icon'] ?? null;


        if ($icon) {
            if ($amenity->icon) {
                $iconPath = $amenity->getRawOriginal('icon'); 
                $directoryPath = dirname($iconPath);
                Storage::disk('public')->deleteDirectory($directoryPath);
            }
            $data['icon'] = $icon->store('amenity_icons/' . Str::random(), 'public');
        }

        $amenity->update($data);

        return response()->json([
            'message' => $data['name'] . ' Details Updated Successfully',
            'data' => $amenity,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Amenity $amenity)
    {

        $iconPath = $amenity->getRawOriginal('icon'); 
        $directory = dirname($iconPath);

        if (Storage::disk('public')->exists($directory)) {
            Storage::disk('public')->deleteDirectory($directory);
        }

        $amenity->delete();

        return response()->json([
            'message' => 'Amenity ' . $amenity->name . ' Deleted Successfully',
            'data' => $amenity,
        ], 200);
    }

    public function list(Request $request)
    {
        $query = Amenity::query();

        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->input('name') . '%');
        }

        // Global search (all fields)
        if ($request->filled('search.value')) {
            $search = $request->input('search.value');
            $query->where('name', 'like', '%' . $search . '%');
        }

        if ($request->filled('order')) {
            $orderColumnIndex = $request->input('order')[0]['column']; // Column index
            $orderDirection = $request->input('order')[0]['dir'];     // 'asc' or 'desc'

            // Map DataTables column index to database column names
            $columns = [
                2 => 'name'
            ];

            if (array_key_exists($orderColumnIndex, $columns)) {
                $orderColumn = $columns[$orderColumnIndex];
                $query->orderBy($orderColumn, $orderDirection);
            }
        } else {
            // Default sorting
            $query->orderBy('created_at', 'desc');
        }

        $totalRecords = Amenity::count();
        $filteredRecords = $query->count();

        // Apply pagination
        $query->skip($request->input('start', 0))
            ->take($request->input('length', 10));

        $amenities = $query->get();

        return response()->json([
            'draw' => intval($request->input('draw')),
            'recordsTotal' => $totalRecords,                      // Total records before filtering
            'recordsFiltered' => $filteredRecords,                // Total records after filtering
            'data' => $amenities                                       // Data to display
        ]);
    }
}
