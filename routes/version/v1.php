<?php

use App\Http\Controllers\Api\v1\AmenityController;
use App\Http\Controllers\Api\v1\AuthenticationController;
use App\Http\Controllers\Api\v1\CruiseController;
use App\Http\Controllers\Api\v1\CruiseImageController;
use App\Http\Controllers\Api\v1\CruiseTypeController;
use App\Http\Controllers\Api\v1\LocationController;
use App\Http\Controllers\Api\v1\OwnerController;
use App\Http\Controllers\Api\v1\PackageController;
use App\Http\Controllers\Api\v1\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('/v1')->middleware('api_auth_key')->name('api.v1.')->group(function () {

    Route::post('register', [AuthenticationController::class, 'register'])
        ->name('register')
        ->middleware('throttle:6,1');
    Route::post('login', [AuthenticationController::class, 'login'])->name('login');
    Route::post('phone-verify', [AuthenticationController::class, 'phoneVerify']);
    Route::post('otp-verify', [AuthenticationController::class, 'otpVerify']);
    Route::post('google-verify', [AuthenticationController::class, 'googleVerify']);

    Route::middleware(['auth:sanctum', 'verified'])->group(function () {

        Route::post('logout', [AuthenticationController::class, 'logout'])->name('logout');
        Route::apiResource('/user', UserController::class);

        Route::apiResource('/owner', OwnerController::class);

        Route::apiResource('/location', LocationController::class);

        Route::apiResource('/cruise-type', CruiseTypeController::class);

        Route::apiResource('/cruise-images', CruiseImageController::class);
        Route::apiResource('/amenity', AmenityController::class);

        Route::apiResource('cruise', CruiseController::class);
        Route::apiResource('cruise/{cruise_id}/package', PackageController::class);
    });
});
