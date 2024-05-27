<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
    if (Auth::check()) {
        route('profile');
    } else {
        route('login');
    }
});


Route::get('/policy', function() { return view('policy'); })->name('policy');

Route::middleware(['auth'])->group(function () {
    Route::get('/telegram', [AuthController::class, 'telegram'])->name('telegram');
    Route::get('/profile', [UserController::class, 'profile'])->name('profile');
    Route::get('/admin-panel', [AdminController::class, 'index']);
    Route::resource('projects', ProjectController::class);
    Route::get('/tariff', function() { return view('tariff'); })->name('tariff');
    Route::post('/tariff', [SellerController::class, 'updateTariff']);
});
