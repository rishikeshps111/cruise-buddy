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
                $directoryPath = dirname($amenity->icon);
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
        $directory = dirname($amenity->icon);

        if (Storage::disk('public')->exists($directory)) {
            Storage::disk('public')->deleteDirectory($directory);
        }

        $amenity->delete();

        return response()->json([
            'message' => 'Amenity ' . $amenity->name . ' Deleted Successfully',
            'data' => $amenity,
        ], 200);
    }

    public function list()
    {
        $amenities = Amenity::orderBy('created_at', 'desc')->get();

        return response()->json($amenities);
    }
}
