<?php

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

    Route::get('locations/list', [LocationController::class, 'list'])->name('owners.list');
    Route::resource('locations', LocationController::class);
    
});
