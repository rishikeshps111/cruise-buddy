<?php

namespace App\Http\Controllers;

use Kreait\Firebase\Factory;

class TestController extends Controller
{

    public function index(string $googleUserId)
    {
        $factory = (new Factory)
            ->withServiceAccount(base_path(env('FIREBASE_CREDENTIALS')));

        $auth = $factory->createAuth();

        try {
            $users = [];
            $userRecords = $auth->listUsers(10); // 10 users

            // Collect the users into an array
            foreach ($userRecords as $userRecord) {
                $users[] = [
                    'uid' => $userRecord->uid,
                    'email' => $userRecord->email,
                    'displayName' => $userRecord->displayName,
                    'emailVerified' => $userRecord->emailVerified,
                ];
            }

            // Return users as JSON response
            return response()->json($users, 200);
        } catch (\Kreait\Firebase\Exception\Auth\AuthError $e) {
            // Handle Firebase Auth errors
            return response()->json(['error' => 'AuthError: ' . $e->getMessage()], 500);
        } catch (\Exception $e) {
            // Handle other unexpected errors
            return response()->json(['error' => 'Unexpected error: ' . $e->getMessage()], 500);
        }
    }
    public function user($uid)
    {
        $factory = (new Factory)
            ->withServiceAccount(base_path(env('FIREBASE_CREDENTIALS')));

        $auth = $factory->createAuth();

        try {
            // Get a specific user by UID
            $userRecord = $auth->getUser($uid);

            // Prepare user data to return
            $user = [
                'uid' => $userRecord->uid,
                'email' => $userRecord->email,
                'displayName' => $userRecord->displayName,
                'emailVerified' => $userRecord->emailVerified,
            ];

            // Return user data as JSON response
            return response()->json($user, 200);
        } catch (\Kreait\Firebase\Exception\Auth\AuthError $e) {
            // Handle Firebase Auth errors
            return response()->json(['error' => 'AuthError: ' . $e->getMessage()], 500);
        } catch (\Exception $e) {
            // Handle other unexpected errors
            return response()->json(['error' => 'Unexpected error: ' . $e->getMessage()], 500);
        }
    }
}
