<?php

namespace App\Http\Controllers\Admin;

use App\Models\Owner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOwnerRequest;
use App\Http\Requests\UpdateOwnerRequest;
use Google\Service\CloudSourceRepositories\Repo;

class OwnerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $owners = Owner::with('user')->get();

        return view('2_AdminPanel.4_Pages.2_Owners.owner',compact('owners'));
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $action = $request->get('action', 'store');
        $itemId = $request->get('id');
        $size = $request->get('size', 'modal-md');
        $data = ($action === 'edit' && $itemId) ? Owner::with('user')->find($itemId) : null;
    
        return response()->json([
            'title' => $action === 'edit' ? 'Edit Owner' : 'Add New Owner',
            'size' => $size,
            'content' => view('2_AdminPanel.4_Pages.2_Owners.Form.form', compact('data'))->render(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOwnerRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Owner $owner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Owner $owner)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOwnerRequest $request, Owner $owner)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Owner $owner)
    {
        //
    }
}
