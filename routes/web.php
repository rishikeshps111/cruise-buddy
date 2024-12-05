<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\v1\RazorpayController;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

// Route::get('razorpay',[RazorpayController::class,'index']);
// Route::post('razorpay-payment',[RazorpayController::class,'store'])->name('razorpay.payment.store');

require __DIR__.'/auth.php';
require __DIR__.'/admin.php';

