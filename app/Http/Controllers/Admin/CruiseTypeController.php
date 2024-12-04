<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CruiseType;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\StoreCruiseTypeRequest;
use App\Http\Requests\Admin\UpdateCruiseTypeRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;


class CruiseTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('2_AdminPanel.4_Pages.5_CruiseType.cruiseType');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $action = $request->get('action', 'store');
        $itemId = $request->get('id');
        $size = $request->get('size', 'modal-md');
        $data = ($action === 'edit' && $itemId) ? CruiseType::find($itemId) : null;

        return response()->json([
            'title' => $action === 'edit' ? 'Edit Cruise Type' : 'Add New Cruise Type',
            'size' => $size,
            'content' => view('2_AdminPanel.4_Pages.5_CruiseType.Form.form', compact('data'))->render(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCruiseTypeRequest $request)
    {
        $data = $request->validated();

        $image = $data['image'] ?? null;

        if ($image) {
            $data['image'] = $image->store('cruise_type/' . Str::random(), 'public');
        }

        $cruise_type = CruiseType::create($data);

        return response()->json([
            'message' => 'Cruise Type Added Successfully',
            'data' => $cruise_type,
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(CruiseType $cruiseType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CruiseType $cruiseType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCruiseTypeRequest $request, CruiseType $cruiseType)
    {
        $data = $request->validated();

        $image = $data['image'] ?? null;

        if ($image) {
            if ($cruiseType->image) {
                $imagePath = $cruiseType->getRawOriginal('image');
                $directory = dirname($imagePath);
                Storage::disk('public')->deleteDirectory($directory);
            }
            $data['image'] = $image->store('cruise_type/' . Str::random(), 'public');
        }

        $cruiseType->update($data);

        return response()->json([
            'message' => 'Cruise Type Updated Successfully',
            'data' => $cruiseType,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CruiseType $cruiseType)
    {
        $imagePath = $cruiseType->getRawOriginal('thumbnail');
        $directory = dirname($imagePath);

        if (Storage::disk('public')->exists($directory)) {
            Storage::disk('public')->deleteDirectory($directory);
        }

        $cruiseType->forceDelete();

        return response()->json([
            'message' => 'cruise Type Deleted Successfully',
            'data' => $cruiseType,
        ], 200);
    }

    public function list(Request $request)
    {
        $query = CruiseType::query();

        if ($request->filled('model_name')) {
            $query->where('model_name', 'like', '%' . $request->input('model_name') . '%');
        }

        if ($request->filled('type')) {
            $query->where('type', 'like', '%' . $request->input('type') . '%');
        }

        // Global search (all fields)
        if ($request->filled('search.value')) {
            $search = $request->input('search.value');
            $query->where('model_name', 'like', '%' . $search . '%')
                ->orWhere('type', 'like', '%' . $search . '%');
        }

        // dd($request->input('order')[0]['column']);
        if ($request->filled('order') && $request->input('order')[0]['column'] != 0) {
            $orderColumnIndex = $request->input('order')[0]['column']; // Column index
            $orderDirection = $request->input('order')[0]['dir'];     // 'asc' or 'desc'

            // Map DataTables column index to database column names
            $columns = [
                1 => 'model_name',
                2 => 'type'
            ];

            if (array_key_exists($orderColumnIndex, $columns)) {
                $orderColumn = $columns[$orderColumnIndex];
                $query->orderBy($orderColumn, $orderDirection);
            }
        } else {
            // Default sorting
            $query->orderBy('created_at', 'desc');
        }

        $totalRecords = CruiseType::count();
        $filteredRecords = $query->count();

        // Apply pagination
        $query->skip($request->input('start', 0))
            ->take($request->input('length', 10));

        $cruise_types = $query->get();

        return response()->json([
            'draw' => intval($request->input('draw')),
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $filteredRecords,
            'data' => $cruise_types
        ]);
    }
}
