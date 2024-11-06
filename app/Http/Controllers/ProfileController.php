<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\Admin\ProfileUpdateRequest;
use Propaganistas\LaravelPhone\PhoneNumber;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('2_AdminPanel.3_Profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $avatar = $request->avatar ?? null;

        if ($avatar) {

            if ($request->user()->image_path) {
                $directoryPath = dirname($request->user()->image_path);
                Storage::disk('public')->deleteDirectory($directoryPath);
            }
            $request->user()->image_path = $avatar->store('users/' . $request->user()->id . '/avatar/' . Str::random(), 'public');
        }

        $formattedPhoneNumber = new PhoneNumber($request->phone, $request->country_code);
        $request->user()->phone = $formattedPhoneNumber->formatE164();
        $request->user()->country_code = $request->country_code;
        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
