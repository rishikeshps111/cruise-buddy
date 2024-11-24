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
            $imagePath = $user->getRawOriginal('image_path');
            $directoryPath = dirname($imagePath);
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
            $proofPath = $owner->getRawOriginal('proof_image');
            $directoryPath = dirname($proofPath);
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

    public function list(Request $request)
    {
        $query = Owner::with('user');

        if ($request->filled('name')) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->input('name') . '%');
            });
        }
        if ($request->filled('email')) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('email', 'like', '%' . $request->input('email') . '%');
            });
        }
        if ($request->filled('phone')) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('phone', 'like', '%' . $request->input('phone') . '%');
            });
        }
        if ($request->filled('proof_id')) {
            $query->where('proof_id', 'like', '%' . $request->input('proof_id') . '%');
        }
        if ($request->filled('status')) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('is_active', $request->input('status'));
            });
        }

        // Global search (all fields)
        if ($request->filled('search.value')) {
            $search = $request->input('search.value');
            $query->where(function ($query) use ($search) {
                $query->whereHas('user', function ($q) use ($search) {
                    $q->where('email', 'like', '%' . $search . '%')
                        ->orWhere('name', 'like', '%' . $search . '%')
                        ->orWhere('phone', 'like', '%' . $search . '%');
                })
                    ->orWhere('proof_id', 'like', '%' . $search . '%')
                    // Add more columns to search if needed
                ;
            });
        }

        if ($request->filled('order') && $request->input('order')[0]['column'] != 0) {
            $orderColumnIndex = $request->input('order')[0]['column']; // Column index
            $orderDirection = $request->input('order')[0]['dir'];     // 'asc' or 'desc'

            // Map DataTables column index to database column names
            $columns = [
                2 => 'user.name',
                3 => 'user.email',
                4 => 'user.phone',
                6 => 'proof_id',
                7 => 'user.is_active'
            ];

            if (array_key_exists($orderColumnIndex, $columns)) {
                $orderColumn = $columns[$orderColumnIndex];

                if (str_starts_with($orderColumn, 'user.')) {
                    // Sorting for columns in the `users` table using a subquery
                    $relatedColumn = str_replace('user.', '', $orderColumn);
                    $query->orderBy(
                        User::select($relatedColumn)
                            ->whereColumn('users.id', 'owners.user_id') // Match relationship
                            ->take(1),
                        $orderDirection
                    );
                } else {
                    // Sorting for columns in the `owners` table
                    $query->orderBy($orderColumn, $orderDirection);
                }
            }
        } else {
            // Default sorting
            $query->orderBy('created_at', 'desc');
        }

        $totalRecords = Owner::count();
        $filteredRecords = $query->count();

        // Apply pagination
        $query->skip($request->input('start', 0))
            ->take($request->input('length', 10));

        $owners = $query->get();

        return response()->json([
            'draw' => intval($request->input('draw')),
            'recordsTotal' => $totalRecords,                      // Total records before filtering
            'recordsFiltered' => $filteredRecords,                // Total records after filtering
            'data' => $owners                                       // Data to display
        ]);
    }
}
