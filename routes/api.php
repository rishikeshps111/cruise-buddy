<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\v1\RazorpayController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


// Route::get('/test-list/{id}',[TestController::class, 'index']);
// Route::get('/test-user/{id}',[TestController::class, 'user']);
Route::post('razorpay-webhook-payment', [RazorpayController::class, 'webhookStore'])
    ->name('razorpay.webhook.store');

require  __DIR__ .  '/version/v1.php';
