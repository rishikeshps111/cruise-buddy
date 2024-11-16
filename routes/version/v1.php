<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\v1\UserController;
use App\Http\Controllers\Api\v1\OwnerController;
use App\Http\Controllers\Api\v1\CruiseController;
use App\Http\Controllers\Api\v1\RatingController;
use App\Http\Controllers\Api\v1\AmenityController;
use App\Http\Controllers\Api\v1\BookingController;
use App\Http\Controllers\Api\v1\PackageController;
use App\Http\Controllers\Api\v1\FavoriteController;
use App\Http\Controllers\Api\v1\LocationController;
use App\Http\Controllers\Api\v1\CruiseTypeController;
use App\Http\Controllers\Api\v1\CruiseImageController;
use App\Http\Controllers\Api\v1\AuthenticationController;
use App\Http\Controllers\Api\v1\PackageBookingTypeController;

Route::prefix('/v1')->middleware('api_auth_key')->name('api.v1.')->group(function () {

    Route::post('register', [AuthenticationController::class, 'register'])
        ->name('register')
        ->middleware('throttle:6,1');
    Route::post('login', [AuthenticationController::class, 'login'])->name('login');
    Route::post('phone-verify', [AuthenticationController::class, 'phoneVerify']);
    Route::post('otp-verify', [AuthenticationController::class, 'otpVerify']);
    Route::post('google-verify', [AuthenticationController::class, 'googleVerify']);

    Route::middleware(['auth:sanctum', 'verified'])->group(function () {
        Route::get('/who-am-i', [AuthenticationController::class, 'whoAmI'])->name('who-am-i');
        Route::post('/logout', [AuthenticationController::class, 'logout'])->name('logout');
        Route::apiResource('/user', UserController::class);
        Route::apiResource('/owner', OwnerController::class);
        Route::get('/owner/{id}/booking', [BookingController::class, 'bookingOwner'])
            ->name('owner.booking')
            ->middleware(['role:owner']);


        Route::apiResource('/location', LocationController::class);
        Route::apiResource('/cruise-type', CruiseTypeController::class);
        Route::apiResource('/cruise-images', CruiseImageController::class);
        Route::apiResource('/amenity', AmenityController::class);

        Route::apiResource('/cruise', CruiseController::class);
        Route::get('/cruise/{id}/booking', [BookingController::class, 'bookingCruise'])->name('owner.booking');


        Route::apiResource('/package', PackageController::class);
        Route::apiResource('/package-booking-type', PackageBookingTypeController::class);
        Route::apiResource('/booking', BookingController::class);

        Route::apiResource('/rating', RatingController::class);
        Route::apiResource('/favorite', FavoriteController::class);
    });
});
