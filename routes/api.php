<?php

use App\Http\Controllers\API\BloggerController;
use App\Http\Controllers\API\PaymentController;
use App\Http\Controllers\API\ProjectController;
use App\Http\Controllers\API\SellerController;
use App\Http\Controllers\API\UserController;
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

Route::delete('/users/{user}', [UserController::class, 'delete']);
Route::get('/users/{user}/ban', [UserController::class, 'ban']);
Route::get('/users/{user}/unban', [UserController::class, 'unban']);

Route::get('/bloggers', [BloggerController::class, 'index']);
Route::get('/bloggers/{blogger}', [BloggerController::class, 'show']);
Route::get('/bloggers/{blogger}/accept', [BloggerController::class, 'accept']);

Route::get('/sellers', [SellerController::class, 'index']);

Route::get('/projects', [ProjectController::class, 'index']);
Route::get('/projects/{project}/ban', [ProjectController::class, 'ban']);
Route::get('/projects/{project}/unban', [ProjectController::class, 'unban']);

Route::get('/payments', [PaymentController::class, 'index']);
