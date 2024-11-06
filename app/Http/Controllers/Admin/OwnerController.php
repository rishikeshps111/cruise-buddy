<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Owner;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Admin\StoreOwnerRequest;
use App\Http\Requests\Admin\UpdateOwnerRequest;
use Propaganistas\LaravelPhone\PhoneNumber;


class OwnerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('2_AdminPanel.4_Pages.2_Owners.owner');
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
        $data = $request->validated();
        $avatar = $data['avatar'] ?? null;
        $proof_image = $data['proof_image'] ?? null;

        $phoneNumber = new PhoneNumber($data['phone'], $request->country_code);

        $user_id = User::insertGetId([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $phoneNumber->formatE164(),
            'country_code' => $request->country_code,
            'is_active' => $data['status'],
            'password' => Hash::make($data['email']),
        ]);

        $user = User::find($user_id);
        $user->assignRole('owner');

        if ($avatar) {
            $data['avatar'] = $avatar->store('users/' . $user_id . '/avatar/' . Str::random(), 'public');
        }

        $user->update([
            'image_path' => $data['avatar'],
        ]);

        if ($proof_image) {
            $data['proof_image'] = $proof_image->store('users/' . $user_id . '/proof/' . Str::random(), 'public');
        }

        $phone2Number = new PhoneNumber($data['phone_2'], $request->phone_2_country_code);

        $owner = Owner::create([
            'user_id' => $user_id,
            'proof_type' => $data['proof_type'],
            'proof_id' => $data['proof_id'],
            'proof_image' => $data['proof_image'],
            'country_code' => $request->phone_2_country_code,
            'additional_phone' => $phone2Number->formatE164()
        ]);

        return response()->json([
            'message' => 'Owner Added Successfully',
            'data' => $owner,
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Owner $owner)
    {
        $data = Owner::with('user')->find($owner->id);

        return response()->json([
            'title' => 'Owner Details',
            'size' => 'modal-md',
            'content' => view('2_AdminPanel.4_Pages.2_Owners.View.view', compact('data'))->render(),
        ]);
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
        $data = $request->validated();
        $avatar = $data['avatar'] ?? null;
        $proof_image = $data['proof_image'] ?? null;

        $user = User::find($owner->user_id);
        $phoneNumber = new PhoneNumber($data['phone'], $request->country_code);

        $user->update([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $phoneNumber->formatE164(),
            'country_code' => $request->country_code,
            'is_active' => $data['status'],
        ]);

        if ($avatar) {
            $directoryPath = dirname($user->image_path);
            Storage::disk('public')->deleteDirectory($directoryPath);
            $data['avatar'] = $avatar->store('users/' . $user->id . '/avatar/' . Str::random(), 'public');
            $user->update([
                'image_path' => $data['avatar'],
            ]);
        }
        $phone2Number = new PhoneNumber($data['phone_2'], $request->phone_2_country_code);

        $owner->update([
            'proof_type' => $data['proof_type'],
            'proof_id' => $data['proof_id'],
            'country_code' => $request->phone_2_country_code,
            'additional_phone' => $phone2Number->formatE164()
        ]);

        if ($proof_image) {
            $directoryPath = dirname($owner->proof_image);
            Storage::disk('public')->deleteDirectory($directoryPath);
            $data['proof_image'] = $proof_image->store('users/' . $user->id . '/proof/' . Str::random(), 'public');
            $owner->update([
                'proof_image' => $data['proof_image'],
            ]);
        }

        return response()->json([
            'message' => $data['name'] . ' Details Updated Successfully',
            'data' => $owner,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Owner $owner)
    {
        $user = User::findOrFail($owner->user_id);

        $userDirectory = 'users/' . $user->id;

        if (Storage::disk('public')->exists($userDirectory)) {
            Storage::disk('public')->deleteDirectory($userDirectory);
        }

        $user->delete();
        $owner->delete();

        return response()->json([
            'message' => 'Owner ' . $user->name . ' Deleted Successfully',
            'data' => $owner,
        ], 200);
    }

    public function list()
    {
        $owners = Owner::with('user')->orderBy('created_at', 'desc')->get();

        return response()->json($owners);
    }
}
