<?php

use App\Http\Controllers\Admin\AmenityController;
use App\Http\Controllers\Admin\CruiseController;
use App\Http\Controllers\Admin\CruiseTypeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\OwnerController;
use App\Http\Controllers\Admin\LocationController;
use App\Http\Controllers\Admin\DashboardController;

Route::prefix('admin')->middleware(['auth', 'verified', 'role:admin'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('owners/list', [OwnerController::class, 'list'])->name('owners.list');
    Route::resource('owners', OwnerController::class);

    Route::get('locations/list', [LocationController::class, 'list'])->name('locations.list');
    Route::resource('locations', LocationController::class);

    Route::get('amenities/list', [AmenityController::class, 'list'])->name('amenities.list');
    Route::resource('amenities', AmenityController::class);

    Route::get('cruise-type/list', [CruiseTypeController::class, 'list'])->name('cruise-type.list');
    Route::resource('cruise-type', CruiseTypeController::class);

    Route::get('cruises/list', [CruiseController::class, 'list'])->name('cruises.list');
    Route::resource('cruises', CruiseController::class);
    
});
