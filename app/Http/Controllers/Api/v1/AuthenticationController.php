<?php

namespace App\Http\Controllers\Api\v1;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Google_Client as GoogleClient;
use Illuminate\Validation\Rules;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cache;
use Illuminate\Auth\Events\Registered;
use App\Http\Requests\Auth\LoginRequest;

class AuthenticationController extends Controller
{
    public function register(LoginRequest $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'password_confirmation' => ['required']
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'email_verified_at' => now()
        ]);

        event(new Registered($user));
        Auth::login($user);
        $token = $user->createToken('AppUser');
        return response()->json([
            'user' => $user,
            'token' => $token->plainTextToken
        ], 201);
    }
    public function login(LoginRequest $request)
    {
        $request->authenticate();
        $user = Auth::user();
        $token = $user->createToken('AppUser');
        return response()->json([
            'user' => $user,
            'token' => $token->plainTextToken
        ], 201);
    }
    public function phoneVerify(Request $request)
    {
        $request->validate([
            'phoneNumber' => 'required'
        ]);
        $otp = rand(1000, 9999);
        Cache::put(
            'otp_' . $request->phoneNumber,
            $otp,
            Carbon::now()->addMinutes(2)
        );
        return response()->json([
            'message' => 'Send messages successful',
            'opt' => $otp
        ], 200);
    }
    public function otpVerify(Request $request)
    {
        $request->validate([
            'otp' => 'required|min:4|max:4',
            'phoneNumber' => 'required'
        ]);
        $phone = $request->phoneNumber;
        $cacheOtp = Cache::get('otp_' . $phone);
        if ($cacheOtp == $request->otp) {
            $user = User::updateOrCreate(
                ['phone' => $phone],
                [
                    'password' => str()->password(),
                    'email_verified_at' => User::where('phone', $phone)->value('email_verified_at') ?? now()
                ]
            );

            Auth::login($user);
            $token = $user->createToken('AppUser');
            return response()->json([
                'user' => $user,
                'token' => $token->plainTextToken
            ], 201);
        } else {
            return response()->json([
                'error' => 'Unauthorized'
            ], 401);
        }
    }
    public function googleVerify(Request $request)
    {
        $request->validate([
            'token' => 'required'
        ]);
        $client = new GoogleClient(['client_id' => env('GOOGLE_CLIENT_ID')]);
        $payload = $client->verifyIdToken($request->token);

        if ($payload) {
            $googleId = $payload['sub'];
            $email = $payload['email'];
            $name = $payload['name'];

            $user = User::updateOrCreate(
                ['email' => $email],
                [
                    'password' => str()->password(),
                    'google_id' => $googleId,
                    'email_verified_at' => User::where('email', $email)->value('email_verified_at') ?? now()
                ]
            );
            Auth::login($user);
            $token = $user->createToken('AppUser');
            return response()->json([
                'user' => $user,
                'token' => $token->plainTextToken
            ], 200);
        } else {
            return response()->json([
                'error' => 'Unauthorized'
            ], 401);
        }
    }
    public function logout(Request $request)
    {
        Auth::user()->tokens()->delete();
        return response()->json([
            'message' => 'Logout successfully'
        ], 202);
    }
}
