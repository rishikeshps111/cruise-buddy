<?php

namespace App\Http\Controllers\Admin;

use App\Models\Cruise;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCruiseRequest;
use App\Http\Requests\Admin\UpdateCruiseRequest;
use App\Models\CruiseType;

class CruiseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cruise_types = CruiseType::get();
        return view('2_AdminPanel.4_Pages.6_Cruises.cruise',compact('cruise_types'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCruiseRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Cruise $cruise)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cruise $cruise)
    {
        //
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
