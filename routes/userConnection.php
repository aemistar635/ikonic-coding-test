<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;

Route::resource('suggestions', App\Http\Controllers\UserController::class);
Route::get('get-request-data', [HomeController::class,'getRequestData']);
