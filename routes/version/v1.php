<?php

use App\Http\Controllers\Api\v1\AuthenticationController;
use App\Http\Controllers\Api\v1\LocationController;
use App\Http\Controllers\Api\v1\OwnerController;
use App\Http\Controllers\Api\v1\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('/v1')->name('api.v1.')->group(function () {

    Route::post('login', [AuthenticationController::class, 'login'])->name('login');
    Route::post('phone-verify', [AuthenticationController::class, 'phoneVerify']);
    Route::post('otp-verify', [AuthenticationController::class, 'otpVerify']);
    Route::post('google-verify', [AuthenticationController::class, 'googleVerify']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('logout', [AuthenticationController::class, 'logout'])->name('logout');
        Route::apiResource('/user', UserController::class);
        Route::apiResource('owner', OwnerController::class);
        Route::apiResource('location', LocationController::class);
    });
});
