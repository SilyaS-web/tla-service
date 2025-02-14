<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\BloggerController;
use App\Http\Controllers\API\DashboardController;
use App\Http\Controllers\API\PartnerController;
use App\Http\Controllers\API\PaymentController;
use App\Http\Controllers\API\PlatformController;
use App\Http\Controllers\API\ProjectController;
use App\Http\Controllers\API\SellerController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\ReferralController;
use App\Http\Controllers\API\TariffController;
use App\Http\Controllers\API\ThemeController;
use App\Http\Controllers\API\WorkController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/login', [AuthController::class, 'authenticate']);
Route::get('/users/reset-password', [AuthController::class, 'resetPassword']);
Route::get('/users/phone-confirmed', [AuthController::class, 'isTgConfirmed']);
Route::post('/phones', [AuthController::class, 'setTGPhone']);
Route::get('/platforms', [PlatformController::class, 'index']);
Route::get('/themes', [ThemeController::class, 'index']);
Route::post('/users', [AuthController::class, 'store']);

Route::prefix('payment')->group(function () {
    Route::get('/debug/{tariff}', [PaymentController::class, 'debugPayment']);
    Route::get('/{payment}/check', [PaymentController::class, 'checkState']);
    Route::get('/{payment}/success', [PaymentController::class, 'successPayment']);
    Route::get('/{payment}/fail', [PaymentController::class, 'failPayment']);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::delete('/users/{user}', [UserController::class, 'delete']);
    Route::get('/users/current', [UserController::class, 'currentUser']);
    Route::get('/users/{user}', [UserController::class, 'show']);
    Route::get('/users/{user}/modals/{modal}/show', [UserController::class, 'showModal']);
    Route::get('/users/{user}/dashboard', [DashboardController::class, 'index']);
    Route::get('/users/{user}/ban', [UserController::class, 'ban']);
    Route::get('/users/{user}/unban', [UserController::class, 'unban']);
    Route::get('/users/{user}/projects', [UserController::class, 'projects']);
    Route::get('/users/{user}/projects/barnds', [UserController::class, 'brands']);
    Route::get('/users/{user}/deals', [UserController::class, 'works']);
    Route::get('/users/{user}/deals/{work}/messages', [UserController::class, 'messages']);
    Route::post('/users/{user}/deals/{work}/messages', [UserController::class, 'storeMessage']);
    Route::get('/users/{user}/notifications', [UserController::class, 'notifications']);
    Route::get('/users/{user}/notifications/view', [UserController::class, 'viewNotification']);
    Route::get('/users/{user}/notifications/{notification}/view', [UserController::class, 'viewNotification']);

    Route::post('/bloggers', [BloggerController::class, 'store']);
    Route::get('/bloggers', [BloggerController::class, 'index']);
    Route::get('/bloggers/{blogger}', [BloggerController::class, 'show']);
    Route::post('/bloggers/{blogger}/accept', [BloggerController::class, 'accept']);
    Route::post('/bloggers/{blogger}', [BloggerController::class, 'update']);
    Route::get('/bloggers/{blogger}/content', [BloggerController::class, 'getContent']);
    Route::post('/bloggers/{blogger}/content', [BloggerController::class, 'setContent']);
    Route::delete('/bloggers/{blogger}/content', [BloggerController::class, 'deleteContent']);

    Route::get('/sellers', [SellerController::class, 'index']);
    Route::get('/sellers/{seller}', [SellerController::class, 'show']);
    Route::post('/sellers/{seller}', [SellerController::class, 'update']);

    Route::get('/projects', [ProjectController::class, 'index']);
    Route::post('/projects', [ProjectController::class, 'store']);
    Route::post('/projects/{project}', [ProjectController::class, 'update']);
    Route::get('/projects/categories', [ProjectController::class, 'categories']);
    Route::get('/projects/{project}', [ProjectController::class, 'show']);
    Route::get('/projects/{project}/ban', [ProjectController::class, 'ban']);
    Route::get('/projects/{project}/unban', [ProjectController::class, 'unban']);
    Route::get('/projects/{project}/deals', [ProjectController::class, 'works']);
    Route::get('/projects/{project}/statistics', [ProjectController::class, 'statistics']);
    Route::delete('/projects/{project}', [ProjectController::class, 'delete']);
    Route::get('/projects/{project}/stop', [ProjectController::class, 'stop']);
    Route::get('/projects/{project}/start', [ProjectController::class, 'start']);
    Route::get('/projects/{project}/activate', [ProjectController::class, 'activate']);

    Route::post('/deals', [WorkController::class, 'store']);
    Route::get('/deals/{work}/deny', [WorkController::class, 'deny']);
    Route::get('/deals/{work}/cancel', [WorkController::class, 'cancel']);
    Route::get('/deals/{work}/accept', [WorkController::class, 'accept']);
    Route::get('/deals/{work}/start', [WorkController::class, 'start']);
    Route::get('/deals/{work}/confirm', [WorkController::class, 'confirm']);
    Route::post('/deals/{work}/stats', [WorkController::class, 'stats']);

    Route::get('/payments', [PaymentController::class, 'index']);

    Route::get('/referrals', [ReferralController::class, 'index']);
    Route::get('/referrals/export', [ReferralController::class, 'export']);

    Route::get('/tariifs', [TariffController::class, 'index']);
    Route::get('/tariifs/{tariff}/price', [TariffController::class, 'getPrice']);

    Route::post('/feedback', [UserController::class, 'sendFeedback']);

    Route::get('payment/{tariff}/init', [PaymentController::class, 'init']);

    Route::post('/partners', [PartnerController::class, 'store']);
    Route::get('/partners', [PartnerController::class, 'index']);
    Route::get('/partners/{partner}', [PartnerController::class, 'show']);
    Route::post('/partners/{partner}', [PartnerController::class, 'update']);
    Route::delete('/partners/{partner}', [PartnerController::class, 'destroy']);
});

