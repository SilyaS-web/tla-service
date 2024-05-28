<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\BloggerController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\WorkController;
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
        return redirect()->route('profile');
    } else {
        return redirect()->route('login');
    }
});


Route::get('/policy', function () {
    return view('policy');
})->name('policy');

Route::middleware(['auth'])->group(function () {
    Route::get('/telegram', [AuthController::class, 'telegram'])->name('telegram');
    Route::get('/profile', [UserController::class, 'profile'])->name('profile');
    Route::get('/profile/edit', [UserController::class, 'edit'])->name('edit-profile');
    Route::get('/admin-panel', [AdminController::class, 'index']);
    Route::resource('projects', ProjectController::class);
    Route::get('/tariff', function () {
        return view('tariff');
    })->name('tariff');
    Route::post('/tariff', [SellerController::class, 'updateTariff']);
});

Route::prefix('apist')->group(function () {
    Route::post('/projects', [ProjectController::class, 'index']);

    Route::post('/bloggers', [BloggerController::class, 'index']);
    Route::post('/bloggers/create', [BloggerController::class, 'store']);

    Route::post('/works', [WorkController::class, 'store']);
    Route::post('/works/accept', [WorkController::class, 'acceptWorkByBlogger']);

    Route::post('/messages/create', [MessageController::class, 'store']);
    Route::post('/messages/count', [MessageController::class, 'count']);
    Route::post('/messages', [MessageController::class, 'index']);

    Route::post('/tg', [AuthController::class, 'setTGPhone']);
});
