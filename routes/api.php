<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


// Route::get('/test-list/{id}',[TestController::class, 'index']);
// Route::get('/test-user/{id}',[TestController::class, 'user']);
require  __DIR__ .  '/version/v1.php';
