<?php

use App\Http\Controllers\API\BloggerController;
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

Route::get('/users/{user}/deny', [UserController::class, 'deny']);

Route::get('/bloggers', [BloggerController::class, 'index']);
Route::get('/bloggers/{blogger}/accept', [BloggerController::class, 'accept']);

Route::get('/sellers', [SellerController::class, 'index']);
