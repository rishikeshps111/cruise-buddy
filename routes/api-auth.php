<?php

use Google\Client as GoogleClient;
use Google\Service\OAuth2 as GoogleOAuth2;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('google-redirect', function () {
    $client = new GoogleClient();
    $client->setClientId(config('services.google.client_id'));
    $client->setClientSecret(config('services.google.client_secret'));
    $client->setRedirectUri(config('services.google.redirect'));
    $client->addScope('email');
    $client->addScope('profile');

    return redirect($client->createAuthUrl());
});
Route::get('google-verify', function (Request $request) {
    $client = new GoogleClient();
    $client->setClientId(env('GOOGLE_CLIENT_ID'));
    $client->setClientSecret(env('GOOGLE_CLIENT_SECRET'));
    $client->setRedirectUri(env('GOOGLE_REDIRECT_URI'));

    $token = $client->fetchAccessTokenWithAuthCode($request->code);
    $oauth2 = new GoogleOAuth2($client);
    $userInfo = $oauth2->userinfo->get();
    $googleId = $userInfo->id;
    $email = $userInfo->email;
    $name = $userInfo->name;
    $picture = $userInfo->picture;

    return [
        'google_id' => $googleId,
        'token' => $token['id_token'],
        'name' => $name,
        'email' => $email,
        'picture' => $picture
    ];
});