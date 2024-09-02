<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\BloggerController;
use App\Http\Controllers\API\PaymentController;
use App\Http\Controllers\API\ProjectController;
use App\Http\Controllers\API\SellerController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\ReferralController;
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

Route::post('/users', [AuthController::class, 'store']);
Route::delete('/users/{user}', [UserController::class, 'delete']);
Route::get('/users/{user}/ban', [UserController::class, 'ban']);
Route::get('/users/{user}/unban', [UserController::class, 'unban']);

Route::get('/bloggers', [BloggerController::class, 'index']);
Route::get('/bloggers/{blogger}', [BloggerController::class, 'show']);
Route::post('/bloggers/{blogger}/accept', [BloggerController::class, 'accept']);

Route::get('/sellers', [SellerController::class, 'index']);

Route::get('/projects', [ProjectController::class, 'index']);
Route::post('/projects', [ProjectController::class, 'store']);
Route::get('/projects/{project}', [ProjectController::class, 'show']);
Route::get('/projects/{project}/ban', [ProjectController::class, 'ban']);
Route::get('/projects/{project}/unban', [ProjectController::class, 'unban']);

Route::post('/works', [WorkController::class, 'store']);
Route::get('/works/{work}/deny', [WorkController::class, 'deny']);
Route::get('/works/{work_id}/accept', [WorkController::class, 'accept']);
Route::get('/works/{work_id}/start', [WorkController::class, 'start']);
Route::get('/works/{work}/confirm', [WorkController::class, 'confirm']);
Route::post('/works/{work}/stats', [WorkController::class, 'stats']);

Route::get('/payments', [PaymentController::class, 'index']);

Route::get('/referrals', [ReferralController::class, 'index']);
Route::get('/referrals/export', [ReferralController::class, 'export']);
