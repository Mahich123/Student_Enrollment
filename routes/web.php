<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;



Route::get('/', function () {
    return view('welcome');
});

// Route::get('dashboard', function() {
//     return view('template');
// });

Route::get('/dash',[AuthController::class,'Dashboard']);