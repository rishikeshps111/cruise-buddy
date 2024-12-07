<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\v1\FoodController;
use App\Http\Controllers\Api\v1\UserController;
use App\Http\Controllers\Api\v1\OwnerController;
use App\Http\Controllers\Api\v1\CruiseController;
use App\Http\Controllers\Api\v1\RatingController;
use App\Http\Controllers\Api\v1\AmenityController;
use App\Http\Controllers\Api\v1\BookingController;
use App\Http\Controllers\Api\v1\PackageController;
use App\Http\Controllers\Api\v1\PaymentController;
use App\Http\Controllers\Api\v1\FavoriteController;
use App\Http\Controllers\Api\v1\LocationController;
use App\Http\Controllers\Api\v1\ItineraryController;
use App\Http\Controllers\Api\v1\CruiseTypeController;
use App\Http\Controllers\Api\v1\CruiseImageController;
use App\Http\Controllers\Api\v1\GoogleVerifyController;
use App\Http\Controllers\Api\v1\PackageImageController;
use App\Http\Controllers\Api\v1\AuthenticationController;
use App\Http\Controllers\Api\v1\PackageBookingTypeController;

Route::prefix('/v1')->name('api.v1.')->group(function () {
    // Route::prefix('/v1')->middleware('api_auth_key')->name('api.v1.')->group(function () {

    Route::post('register', [AuthenticationController::class, 'register'])
        ->name('register')
        ->middleware('throttle:6,1');
    Route::post('login', [AuthenticationController::class, 'login'])->name('login');
    Route::post('phone-verify', [AuthenticationController::class, 'phoneVerify']);
    Route::post('otp-verify', [AuthenticationController::class, 'otpVerify']);
    Route::post('google-verify', [GoogleVerifyController::class, 'googleVerify']);
    Route::post('google-verify-uid', [GoogleVerifyController::class, 'googleVerifyUId']);

    Route::middleware(['auth:sanctum', 'verified'])->group(function () {
        Route::get('/who-am-i', [AuthenticationController::class, 'whoAmI'])->name('who-am-i');
        Route::post('/logout', [AuthenticationController::class, 'logout'])->name('logout');
        Route::apiResource('/user', UserController::class);
        Route::apiResource('/owner', OwnerController::class);
        Route::get('/owner/{id}/booking', [BookingController::class, 'bookingOwner'])
            ->name('owner.booking')
            ->middleware(['role:owner'])->name('owner.booking');


        Route::apiResource('/location', LocationController::class);
        Route::apiResource('/cruise-type', CruiseTypeController::class);
        Route::apiResource('/cruise-images', CruiseImageController::class);

        Route::apiResource('/cruise', CruiseController::class);
        Route::get('/cruise/{cruise_id}/package', [CruiseController::class, 'package'])->name('cruise.package');
        Route::apiResource('/cruise/{cruise_id}/image', CruiseImageController::class);
        Route::get('/cruise/{id}/booking', [BookingController::class, 'bookingCruise'])->name('cruise.booking');
        Route::get('/featured/cruise/', [CruiseController::class, 'featuredCruise'])->name('feature.cruise');


        Route::get('/featured/package/', [PackageController::class, 'featuredPackage'])->name('feature.package');
        Route::apiResource('/package', PackageController::class);
        Route::get('/package/{id}/unavailable-date', [PackageController::class, 'unavailableDate'])->name('package.unavailable.date');
        Route::apiResource('/package/{package_id}/image', PackageImageController::class);
        Route::apiResource('/package/{package_id}/amenity', AmenityController::class);
        Route::apiResource('/package/{package_id}/food', FoodController::class);
        Route::apiResource('/package/{package_id}/itinerary', ItineraryController::class);
        Route::apiResource('/package-booking-type', PackageBookingTypeController::class);

        Route::apiResource('/booking', BookingController::class);

        Route::apiResource('/payment', PaymentController::class);

        Route::apiResource('/rating', RatingController::class);
        Route::apiResource('/favorite', FavoriteController::class);
    });
});
