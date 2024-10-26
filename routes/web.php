<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

// `Route::get('/', function () {
//     return view('welcome');
// });`

require __DIR__.'/auth.php';
require __DIR__.'/admin.php';
require __DIR__.'/api-auth.php';

