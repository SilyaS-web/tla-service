<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\BloggerController;
use App\Http\Controllers\DeepLinkController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PaymentController;
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

Route::prefix('lnk')->group(function () {
    Route::get('/create', [DeepLinkController::class, 'store']);
    Route::get('/stats', [DeepLinkController::class, 'stats']);
    Route::get('/{link}', [DeepLinkController::class, 'index']);
});

Route::prefix('apist')->group(function () {
    Route::post('/tg', [AuthController::class, 'setTGPhone']);
    Route::get('/check-tariffs', [SellerController::class, 'checkTariffs']);
    Route::get('/check-projects', [SellerController::class, 'checkProjectWorks']);
    Route::match(['get', 'post'], '/payment/{tariff}', [PaymentController::class, 'regFromPayment']);
    Route::post('/send-feedback', [UserController::class, 'sendFeedback']);
});

Route::get('/profile/admin', function () {
    return view('profile.admin');
});

Route::get('/bloggers/{blogger}', [BloggerController::class, 'show'])->name('blogger-page');
Route::get('/sellers/{seller}', [SellerController::class, 'show'])->name('seller-page');

Route::get('/policy', function () {
    return view('policy');
})->name('policy');

Route::get('{any?}', function () {
    return view('index');
})->where('any', '.*');
