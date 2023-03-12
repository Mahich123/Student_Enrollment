<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;



Route::get('/', function () {
    return view('welcome');
});

// Route::get('dashboard', function() {
//     return view('template');
// });

Route::get('admin/dash',[AuthController::class,'Dashboard']);

Route::get('admin/login',[AuthController::class,'login']);

Route::get('admin/registration',[AuthController::class,'registration']);

Route::get('admin/signin',[AuthController::class,'signin']);
Route::post('admin/User-signin',[AuthController::class,'usersignin']);

Route::get('admin/signup',[AuthController::class,'signup']);
Route::post('admin/create-User',[AuthController::class,'createUser']);