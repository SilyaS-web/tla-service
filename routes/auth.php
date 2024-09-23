<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/reg', [AuthController::class, 'register'])->name('register');
Route::post('/reg', [AuthController::class, 'store']);

Route::get('/auth', [AuthController::class, 'login'])->name('login');
Route::post('/auth', [AuthController::class, 'authenticate']);

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/banned', [AuthController::class, 'banned'])->name('banned');
