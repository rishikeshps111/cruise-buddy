<?php

namespace App\Http\Controllers\Admin;

use App\Models\Owner;
use App\Models\Cruise;
use App\Models\Location;
use App\Models\CruiseType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCruiseRequest;
use App\Http\Requests\Admin\UpdateCruiseRequest;
use App\Models\CruisesImage;
use Illuminate\Support\Facades\Storage;

class CruiseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cruise_types = CruiseType::get();
        return view('2_AdminPanel.4_Pages.6_Cruises.cruise', compact('cruise_types'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $action = $request->get('action', 'store');
        $itemId = $request->get('id');
        $size = $request->get('size', 'modal-md');
        $data = ($action === 'edit' && $itemId) ? Cruise::select(
            'cruises.*',
            'owners.id as owner_id',
            'users.name as owner_name',
            'cruise_types.model_name',
            'cruise_types.type',
            'locations.name as location_name',
            'locations.district',
            'locations.state',
            'locations.country',
            'locations.map_url',
        )
            ->leftJoin('owners', 'owners.id', 'cruises.owner_id')
            ->leftJoin('users', 'users.id', 'owners.user_id')
            ->leftJoin('cruise_types', 'cruise_types.id', 'cruises.cruise_type_id')
            ->leftJoin('locations', 'locations.id', 'cruises.location_id')
            ->with('cruisesImages')->find($itemId) : null;

        $owners = Owner::with('user')
            ->whereHas('user', function ($query) {
                $query->where('is_active', 1);
            })
            ->get();

        $cruise_types = CruiseType::get();

        $locations = Location::get();


        return response()->json([
            'title' => $action === 'edit' ? 'Edit Cruise' : 'Add New Cruise',
            'size' => $size,
            'content' => view('2_AdminPanel.4_Pages.6_Cruises.Form.form', compact('data', 'owners', 'cruise_types', 'locations'))->render(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCruiseRequest $request)
    {
        $data = $request->validated();
        $cruise = Cruise::create($data);

        return response()->json([
            'message' => 'Cruise Added Successfully',
            'data' => $cruise,
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show($slug)
    {
        $cruise_details = Cruise::select(
            'cruises.*',
            'owners.id as owner_id',
            'users.name as owner_name',
            'users.image_path as owner_image',
            'cruise_types.model_name',
            'cruise_types.type',
            'locations.name as location_name',
            'locations.district',
            'locations.state',
            'locations.country',
            'locations.map_url',
        )
            ->leftJoin('owners', 'owners.id', 'cruises.owner_id')
            ->leftJoin('users', 'users.id', 'owners.user_id')
            ->leftJoin('cruise_types', 'cruise_types.id', 'cruises.cruise_type_id')
            ->leftJoin('locations', 'locations.id', 'cruises.location_id')
            ->with('cruisesImages')->where('slug', $slug)->firstOrFail();

        return view('2_AdminPanel.4_Pages.6_Cruises.View.view', compact('cruise_details'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cruise $cruise)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCruiseRequest $request, Cruise $cruise)
    {
        $data = $request->validated();

        $cruise->update($data);

        return response()->json([
            'message' => $cruise->name . ' Details Updated Successfully',
            'data' => $cruise,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cruise $cruise)
    {
        $cruise_images = CruisesImage::where('cruise_id', $cruise->id)->get();

        foreach ($cruise_images as $cruise_image) {

            $imagePath = $cruise_image->getRawOriginal('cruise_img');
            $directory = dirname($imagePath);

            if (Storage::disk('public')->exists($directory)) {
                Storage::disk('public')->deleteDirectory($directory);
            }

            $cruise_image->delete();
        }
        $cruise->delete();

        return response()->json([
            'message' => $cruise->name . ' Deleted Successfully',
            'data' => $cruise,
        ], 200);
    }

    public function list(Request $request)
    {
        $query = Cruise::select(
            'cruises.*',
            'owners.id as owner_id',
            'users.name as owner_name',
            'cruise_types.model_name',
            'cruise_types.type',
            'locations.name as location_name',
            'locations.district',
            'locations.state',
            'locations.country',
            'locations.map_url',
        )
            ->leftJoin('owners', 'owners.id', 'cruises.owner_id')
            ->leftJoin('users', 'users.id', 'owners.user_id')
            ->leftJoin('cruise_types', 'cruise_types.id', 'cruises.cruise_type_id')
            ->leftJoin('locations', 'locations.id', 'cruises.location_id')
            ->with('cruisesImages');


        if ($request->filled('name')) {
            $query->where('cruises.name', 'like', '%' . $request->input('name') . '%');
        }

        if ($request->filled('owner_id')) {
            $query->where('owner_id', $request->input('owner_id'));
        }

        if ($request->filled('owner_name')) {
            $query->where('users.name', 'like', '%' . $request->input('owner_name') . '%');
        }

        if ($request->filled('rooms')) {
            $query->where('rooms', $request->input('rooms'));
        }

        if ($request->filled('max_capacity')) {
            $query->where('max_capacity', $request->input('max_capacity'));
        }

        if ($request->filled('is_active')) {
            $query->where('cruises.is_active', $request->input('is_active'));
        }

        if ($request->filled('type')) {
            $query->where('cruises.cruise_type_id', $request->input('type'));
        }

        // Global search (all fields)
        if ($request->filled('search.value')) {
            $search = $request->input('search.value');
            $query->where('cruises.name', 'like', '%' . $search . '%')
                ->orWhere('owner_id', 'like', '%' . $search . '%')
                ->orWhere('users.name', 'like', '%' . $search . '%')
                ->orWhere('rooms', 'like', '%' . $search . '%')
                ->orWhere('max_capacity', 'like', '%' . $search . '%');
        }

        if ($request->filled('order') && $request->input('order')[0]['column'] != 0) {
            $orderColumnIndex = $request->input('order')[0]['column']; // Column index
            $orderDirection = $request->input('order')[0]['dir'];     // 'asc' or 'desc'

            // Map DataTables column index to database column names
            $columns = [
                2 => 'name',
                3 => 'owners.id',
                4 => 'users.name',
                6 => 'rooms',
                7 => 'max_capacity',
                8 => 'is_active',
            ];

            if (array_key_exists($orderColumnIndex, $columns)) {
                $orderColumn = $columns[$orderColumnIndex];
                $query->orderBy($orderColumn, $orderDirection);
            }
        } else {
            // Default sorting
            $query->orderBy('created_at', 'desc');
        }

        $totalRecords = Cruise::count();
        $filteredRecords = $query->count();

        // Apply pagination
        $query->skip($request->input('start', 0))
            ->take($request->input('length', 10));

        $cruises = $query->get();

        return response()->json([
            'draw' => intval($request->input('draw')),
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $filteredRecords,
            'data' => $cruises
        ]);
    }
}
