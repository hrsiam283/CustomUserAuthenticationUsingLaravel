<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/extra', function () {
    return view('extra');
});
Route::get('/register', [AuthController::class, 'register'])->name('register.view');
Route::get('/store', [AuthController::class, 'store'])->name('register.store');
Route::get('/login', [AuthController::class, 'login'])->name('login.view');
Route::get('/check_login', [AuthController::class, 'check_login'])->name('login.check');


// routes for custom authentications

Route::get('/custom_register', [CustomController::class, 'custom_register'])->name('custom_register.view');
Route::post('/custom_register', [CustomController::class, 'custom_registerPost'])->name('custom_registerPost');
Route::get('/custom_login', [CustomController::class, 'custom_login'])->name('custom_login.view');
Route::post('/custom_login', [CustomController::class, 'custom_loginPost'])->name('custom_loginPost');




