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

Route::prefix('lnk')->group(function () {
    Route::get('/create', [DeepLinkController::class, 'store']);
    Route::get('/stats', [DeepLinkController::class, 'stats']);
    Route::get('/{link}', [DeepLinkController::class, 'index']);
});

Route::prefix('apist')->group(function () {
    Route::post('/password/reset', [AuthController::class, 'resetPassword']);
    Route::post('/tg/confirmed', [AuthController::class, 'isTgConfirmed']);
    Route::post('/tg', [AuthController::class, 'setTGPhone']);
});

Route::middleware(['auth'])->group(function () {
    Route::get('/blogger/{blogger}', [BloggerController::class, 'show'])->name('blogger-page');
    Route::get('/seller/{seller}', [SellerController::class, 'show'])->name('seller-page');

    Route::get('/profile', [UserController::class, 'profile'])->name('profile');
    Route::get('/profile/edit', [UserController::class, 'update'])->name('edit-profile');
    Route::post('/profile/update', [UserController::class, 'edit'])->name('edit-profile-post');

    Route::resource('projects', ProjectController::class);
    Route::get('/project/{project_id}', [ProjectController::class, 'selectBloggers'])->name('select-bloggers');

    Route::get('/tariff', function () {
        return view('tariff');
    })->name('tariff');
    Route::post('/tariff', [SellerController::class, 'updateTariff']);

    Route::prefix('apist')->group(function () {
        Route::post('/projects', [ProjectController::class, 'index']);
        Route::post('/projects/confirm', [WorkController::class, 'confirm']);

        Route::post('/bloggers', [BloggerController::class, 'index']);
        Route::post('/bloggers/create', [BloggerController::class, 'store'])->name('create-blogger');
        Route::post('/blogger/projects', [ProjectController::class, 'bloggerProjects']);

        Route::post('/works', [WorkController::class, 'store'])->name('create-work');
        Route::post('/works/{work_id}/accept', [WorkController::class, 'accept']);
        Route::get('/works/{work_id}/accept', [WorkController::class, 'accept']);
        Route::post('/works/{work_id}/confirm', [WorkController::class, 'confirm']);

        Route::post('/messages/create', [MessageController::class, 'store']);
        Route::post('/messages/count', [MessageController::class, 'count']);
        Route::post('/messages', [MessageController::class, 'index']);

        Route::post('/admin/bloggers', [AdminController::class, 'bloggers']);
        Route::post('/admin/sellers', [AdminController::class, 'sellers']);
        Route::post('/admin/moderation', [AdminController::class, 'moderation']);
        Route::post('/admin/bloggers/accept', [AdminController::class, 'accept']);
        Route::get('/admin/deny/{user_id}', [AdminController::class, 'deny']);
        Route::get('/admin/achievement/{user_id}', [AdminController::class, 'achievement']);

        Route::get('/notifications', [UserController::class, 'getNewNotifications']);
        Route::get('/notifications/view', [NotificationController::class, 'view']);

        Route::get('/coverage-data', [DeepLinkController::class, 'stats']);
    });
});
