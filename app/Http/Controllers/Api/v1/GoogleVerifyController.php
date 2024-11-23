<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\Api\v1\UserResource;
use App\Http\Requests\Api\v1\GoogleVerifyRequest;
use Illuminate\Support\Facades\Hash;
use Kreait\Firebase\Contract\Auth as FirebaseAuth;
use Kreait\Firebase\Exception\Auth\FailedToVerifyToken;
use Kreait\Firebase\Factory;

;

class GoogleVerifyController extends Controller
{

    public function googleVerify(FirebaseAuth $firebaseAuth, GoogleVerifyRequest $request)
    {
        try {
            $verifiedIdToken = $firebaseAuth->verifyIdToken($request->idToken);
        } catch (FailedToVerifyToken $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 400);
        }
        $uid = $verifiedIdToken->claims()->get('sub');
        $user = User::updateOrCreate(
            ['google_id' => $uid],
            [
                'email' => $verifiedIdToken->claims()->get('email'),
                'password' => str()->password(),
                'email_verified_at' => User::where('google_id', $uid)->value('email_verified_at') ?? now()
            ]
        );
        Auth::login($user);
        $token = $user->createToken('AppUser');
        return response()->json([
            'user' => new UserResource($user),
            'token' => $token->plainTextToken
        ], 201);
    }
    public function googleVerifyUId(GoogleVerifyRequest $request)
    {
        $uid = $request->idToken;
        $factory = (new Factory)
            ->withServiceAccount(base_path(env('FIREBASE_CREDENTIALS')));

        $auth = $factory->createAuth();

        try {
            $userRecord = $auth->getUser($uid);
            $user = User::updateOrCreate(
                ['google_id' => $userRecord->uid],
                [
                    'name' => $userRecord->displayName,
                    'email' => $userRecord->email,
                    'password' => Hash::make(str()->password()),
                    'email_verified_at' => User::where('google_id', $uid)->value('email_verified_at') ?? now()
                ]
            );
            Auth::login($user);
            $token = $user->createToken('AppUser');
            return response()->json([
                'user' => new UserResource($user),
                'token' => $token->plainTextToken
            ], 201);
        } catch (\Kreait\Firebase\Exception\Auth\AuthError $e) {
            return response()->json(['error' => 'AuthError: ' . $e->getMessage()], 500);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Unexpected error: ' . $e->getMessage()], 500);
        }
    }
}
