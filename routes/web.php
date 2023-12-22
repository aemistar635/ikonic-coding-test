<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/send_request', [App\Http\Controllers\HomeController::class,'getSendRequestData'])->name('send_request');
Route::get('/received_request', [App\Http\Controllers\HomeController::class,'getReceivedRequestData'])->name('received_request');
Route::get('/connection', [App\Http\Controllers\HomeController::class,'getConnectionData'])->name('connection');
Route::get('send-request/{id}', [App\Http\Controllers\HomeController::class,'sendRequest'])->name('send.request');
Route::get('widthdraw-request/{id}', [App\Http\Controllers\HomeController::class,'withdarwRequest'])->name('send.widthdarawrequest');
Route::get('accept-request/{id}', [App\Http\Controllers\HomeController::class,'acceptRequest'])->name('send.acceptrequest');
Route::get('remove-connection/{id}', [App\Http\Controllers\HomeController::class,'removeConnection'])->name('send.removeConnection');
