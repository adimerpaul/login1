<?php

use App\Http\Controllers\GoogleController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
//Route::get('/auth/google/redirect', [GoogleController::class, 'redirect'])
//    ->name('google.redirect');
//
//Route::get('/auth/google/callback', [GoogleController::class, 'callback'])
//    ->name('google.callback');
