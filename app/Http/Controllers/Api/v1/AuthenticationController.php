<?php

namespace App\Http\Controllers\Api\v1;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Google_Client as GoogleClient;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\OtpVerifyRequest;
use App\Http\Requests\Api\v1\RegistrationRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Auth\Events\Registered;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\Api\v1\UserResource;
use Spatie\QueryBuilder\QueryBuilder;

class AuthenticationController extends Controller
{
    public function register(RegistrationRequest $request)
    {
        $user = $request->register();
        $user->assignRole('user');
        // event(new Registered($user)); email sending
        Auth::login($user);
        $token = $user->createToken('AppUser');
        return response()->json([
            'user' => new UserResource($user),
            'token' => $token->plainTextToken
        ], 201);
    }
    public function login(LoginRequest $request)
    {
        $request->authenticate();
        $user = Auth::user();
        $token = $user->createToken('AppUser');
        return response()->json([
            'user' => new UserResource($user),
            'token' => $token->plainTextToken
        ], 200);
    }
    public function phoneVerify(Request $request)
    {
        $request->validate([
            'phoneNumber' => 'required',
            'countryCode' => 'required',
        ]);
        $otp = rand(1000, 9999);
        Cache::put(
            'otp_' . $request->countryCode . $request->phoneNumber,
            $otp,
            Carbon::now()->addMinutes(2)
        );
        return response()->json([
            'message' => 'Send messages successful',
            'otp' => $otp
        ], 200);
    }
    public function otpVerify(OtpVerifyRequest $request)
    {
        $phone = $request->phone_number;
        $country_code = $request->country_code;
        $cacheOtp = Cache::get('otp_' . $country_code . $phone);
        if ($cacheOtp == $request->otp) {
            $user = User::updateOrCreate(
                ['phone' => $phone],
                [
                    'country_code' => $country_code,
                    'password' => str()->password(),
                    'email_verified_at' => User::where('phone', $phone)->value('email_verified_at') ?? now()
                ]
            );

            Auth::login($user);
            $token = $user->createToken('AppUser');
            return response()->json([
                'user' => new UserResource($user),
                'token' => $token->plainTextToken
            ], 201);
        } else {
            return response()->json([
                'error' => 'Invalid OTP'
            ], 401);
        }
    }
    public function googleVerify(Request $request)
    {
        $request->validate([
            'authToken' => 'required'
        ]);
        $client = new GoogleClient(['client_id' => env('GOOGLE_CLIENT_ID')]);
        $payload = $client->verifyIdToken($request->token);

        if ($payload) {
            $email = $payload['email'];
            $user = User::updateOrCreate(
                ['email' => $email],
                [
                    'name' => $payload['name'],
                    'password' => str()->password(),
                    'google_id' => $payload['sub'],
                    'email_verified_at' => User::where('email', $email)->value('email_verified_at') ?? now()
                ]
            );
            Auth::login($user);
            $token = $user->createToken('AppUser');
            return response()->json([
                'user' => new UserResource($user),
                'token' => $token->plainTextToken
            ], 201);
        } else {
            return response()->json([
                'error' => 'Unauthorized'
            ], 401);
        }
    }
    public function whoAmI()
    {
        $user = QueryBuilder::for(User::class)
            ->allowedIncludes(['owner'])->find(Auth::user()->id);
        return new UserResource($user);
    }
    public function logout(Request $request)
    {
        Auth::user()->tokens()->delete();
        return response()->json([
            'message' => 'Logout successfully'
        ], 202);
    }
}
