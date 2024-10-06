<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/banned', [AuthController::class, 'banned'])->name('banned');
