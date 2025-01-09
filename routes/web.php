<?php

use App\Http\Controllers\API\PaymentController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BloggerController;
use App\Http\Controllers\DeepLinkController;

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

Route::match(['get', 'post'], '/payment/{tariff}', [PaymentController::class, 'regFromPayment']);

Route::prefix('apist')->group(function () {
    Route::get('/check-tariffs', [SellerController::class, 'checkTariffs']);
    Route::get('/check-projects', [SellerController::class, 'checkProjectWorks']);
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
