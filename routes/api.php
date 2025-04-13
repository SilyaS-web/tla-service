<?php

use App\Http\Controllers\API\AdminController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\BloggerController;
use App\Http\Controllers\API\DashboardController;
use App\Http\Controllers\API\PartnerController;
use App\Http\Controllers\API\PaymentController;
use App\Http\Controllers\API\PlatformController;
use App\Http\Controllers\API\ProjectController;
use App\Http\Controllers\API\SellerController;
use App\Http\Controllers\API\TariffController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\ReferralController;
use App\Http\Controllers\API\TelegramController;
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
Route::get('/users/exist', [UserController::class, 'check']);
Route::post('/distribute', [TelegramController::class, 'distribute']);

Route::prefix('payment')->group(function () {
    Route::get('/debug/{tariff}', [PaymentController::class, 'debugPayment']);
    Route::get('/{payment}/check', [PaymentController::class, 'checkState']);
    Route::get('/{payment}/success', [PaymentController::class, 'successPayment']);
    Route::get('/{payment}/fail', [PaymentController::class, 'failPayment']);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::delete('/users/{user}', [UserController::class, 'delete']);
    Route::post('/users/{user}', [UserController::class, 'update']);
    Route::get('/users/current', [UserController::class, 'currentUser']);
    Route::get('/users/{user}', [UserController::class, 'show']);
    Route::get('/users/{user}/modals/{modal}/show', [UserController::class, 'showModal']);
    Route::get('/users/{user}/dashboard', [DashboardController::class, 'index']);
    Route::get('/users/{user}/ban', [UserController::class, 'ban']);
    Route::get('/users/{user}/unban', [UserController::class, 'unban']);
    Route::get('/users/{user}/projects', [UserController::class, 'projects']);
    Route::get('/users/{user}/projects/brands', [UserController::class, 'brands']);
    Route::get('/users/{user}/works', [UserController::class, 'works']);
    Route::get('/users/{user}/works/{work}/messages', [UserController::class, 'messages']);
    Route::post('/users/{user}/works/{work}/messages', [UserController::class, 'storeMessage']);
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
    Route::get('/projects/types', [ProjectController::class, 'types']);
    Route::post('/projects', [ProjectController::class, 'store']);
    Route::post('/projects/{project}', [ProjectController::class, 'update']);
    Route::get('/projects/categories', [ProjectController::class, 'categories']);
    Route::get('/projects/{project}', [ProjectController::class, 'show']);
    Route::get('/projects/{project}/ban', [ProjectController::class, 'ban']);
    Route::get('/projects/{project}/unban', [ProjectController::class, 'unban']);
    Route::get('/projects/{project}/works', [ProjectController::class, 'works']);
    Route::get('/projects/{project}/statistics', [ProjectController::class, 'statistics']);
    Route::delete('/projects/{project}', [ProjectController::class, 'delete']);
    Route::get('/projects/{project}/stop', [ProjectController::class, 'stop']);
    Route::get('/projects/{project}/start', [ProjectController::class, 'start']);
    Route::get('/projects/{project}/activate', [ProjectController::class, 'activate']);

    Route::post('/works', [WorkController::class, 'store']);
    Route::get('/works/{work}/deny', [WorkController::class, 'deny']);
    Route::get('/works/{work}/cancel', [WorkController::class, 'cancel']);
    Route::get('/works/{work}/accept', [WorkController::class, 'accept']);
    Route::get('/works/{work}/start', [WorkController::class, 'start']);
    Route::get('/works/{work}/confirm', [WorkController::class, 'confirm']);
    Route::post('/works/{work}/stats', [WorkController::class, 'stats']);

    Route::get('/payments', [PaymentController::class, 'index']);
    Route::get('payment/{tariff}/init', [PaymentController::class, 'initTariffPayment']);
    Route::get('payment/init', [PaymentController::class, 'initBalancePayment']);

    Route::post('/partners', [PartnerController::class, 'store']);
    Route::get('/partners', [PartnerController::class, 'index']);
    Route::get('/partners/{partner}', [PartnerController::class, 'show']);
    Route::post('/partners/{partner}', [PartnerController::class, 'update']);
    Route::delete('/partners/{partner}', [PartnerController::class, 'destroy']);

    Route::get('/stats', [AdminController::class, 'stats']);
    Route::post('/feedback', [UserController::class, 'sendFeedback']);
    Route::get('/referrals', [ReferralController::class, 'index']);
    Route::get('/referrals/export', [ReferralController::class, 'export']);
    Route::get('/tariffs', [TariffController::class, 'index']);
});

