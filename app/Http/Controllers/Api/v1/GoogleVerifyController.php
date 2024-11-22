<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\Api\v1\UserResource;
use App\Http\Requests\Api\v1\GoogleVerifyRequest;
use Kreait\Firebase\Contract\Auth as FirebaseAuth;
use Kreait\Firebase\Exception\Auth\FailedToVerifyToken;;

class GoogleVerifyController extends Controller
{
    protected $firebaseAuth;
    public function __construct(FirebaseAuth $firebaseAuth)
    {
        $this->firebaseAuth = $firebaseAuth;
    }
    public function googleVerify(GoogleVerifyRequest $request)
    {
        try {
            $verifiedIdToken = $this->firebaseAuth->verifyIdToken($request->idToken);
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
}
