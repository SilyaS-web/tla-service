<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BloggerController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WorkController;
use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/projects', [ProjectController::class, 'index']);

Route::post('/bloggers', [BloggerController::class, 'index']);
Route::post('/bloggers/create', [BloggerController::class, 'store']);

Route::post('/works', [WorkController::class, 'store']);
Route::post('/works/accept', [WorkController::class, 'acceptWorkByBlogger']);

Route::post('/messages/create', [MessageController::class, 'store']);
Route::post('/messages', [MessageController::class, 'index']);

Route::post('/tg', [AuthController::class, 'setTGPhone']);
