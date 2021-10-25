<?php

//use App\Http\Controllers\LoginController;
//use App\Http\Controllers\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
//Route::middleware('auth:sanctum')->group(function () {
//    Route::get('/logout', [UserController::class, 'logout'])->name('logout.api');
//    Route::get('/user', [UserController::class, 'getUser'])->name('user.api');
//});

//Route::post('/register', 'App\Http\Controllers\Auth\registerController@register');
//Route::post('/login', [LoginController::class, 'login']);

//Route::post('register', [RegisterController::class, 'register']);
//Route::post('login', [LoginController::class, 'login']);
//Route::post('logout', [LoginController::class, 'logout'])->middleware('auth:sanctum');
