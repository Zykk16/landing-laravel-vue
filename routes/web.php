<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

//Route::view('', 'pages.app')->name('app');
//Route::view('/admin', 'pages.app')->name('app.admin');
//
//Route::view('/login', 'pages.app')->name('login');
//Route::view('/register', 'pages.app')->name('register');

Route::get('{any}', function () {
    return view('pages.app');
})->where('any', '.*');

Auth::routes();
