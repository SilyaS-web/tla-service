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

return view('index');

Route::get('/policy', function () {
    return view('policy');
})->name('policy');

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

Route::middleware(['auth', 'banned'])->group(function () {
    Route::get('/project/edit', function () {
        return view('project.edit');
    })->name('');

    Route::get('/payment/debug/{tariff}', [PaymentController::class, 'debugPayment']);
    Route::get('/payment/{tariff}/init', [PaymentController::class, 'init']);
    Route::get('/payment/{payment}/check', [PaymentController::class, 'checkState']);
    Route::get('/payment/{payment}/success', [PaymentController::class, 'successPayment']);
    Route::get('/payment/{payment}/fail', [PaymentController::class, 'failPayment']);
    Route::match(['get', 'post'], '/payment/{payment}/notifications', [PaymentController::class, 'notificationsPayment']);

    Route::get('/blogger/{blogger}', [BloggerController::class, 'show'])->name('blogger-page');
    Route::get('/seller/{seller}', [SellerController::class, 'show'])->name('seller-page');

    Route::get('/profile', [UserController::class, 'profile'])->name('profile');
    Route::get('/profile/edit', [UserController::class, 'edit'])->name('edit-profile');
    Route::post('/profile/update', [UserController::class, 'update'])->name('edit-profile-post');

    Route::get('admin/blogger/{user}/edit', [AdminController::class, 'editBlogger'])->name('edit-blogger');
    Route::post('admin/blogger/{user}/update', [AdminController::class, 'updateBlogger'])->name('update-blogger');

    Route::resource('projects', ProjectController::class);
    Route::get('/project/{project_id}', [ProjectController::class, 'selectBloggers'])->name('select-bloggers');
    Route::post('/projects/{project}/update', [ProjectController::class, 'update'])->name('update-project');

    Route::get('/tariff', [UserController::class, 'tariffs'])->name('tariff');

    Route::post('/tariff', [SellerController::class, 'updateTariff']);

    Route::prefix('apist')->group(function () {
        Route::post('/projects', [ProjectController::class, 'index']);
        Route::post('/projects/confirm', [WorkController::class, 'confirm']);
        Route::get('/projects/categories', [ProjectController::class, 'categories']);
        Route::get('/projects/{project}/product-info', [ProjectController::class, 'getProductInfo']);
        Route::get('/projects/{project}/activate', [ProjectController::class, 'activate']);
        Route::get('/projects/{project}/ban', [ProjectController::class, 'ban']);
        Route::get('/projects/{project}/unban', [ProjectController::class, 'unban']);
        Route::get('/projects/{project}/edit', [ProjectController::class, 'edit']);
        Route::get('/projects/{project}/delete', [ProjectController::class, 'delete']);
        Route::get('/projects/{project}/stop', [ProjectController::class, 'stop']);
        Route::get('/projects/{project}/start', [ProjectController::class, 'start']);

        Route::post('/bloggers', [BloggerController::class, 'index']);
        Route::get('/bloggers/{blogger}', [BloggerController::class, 'info']);
        Route::post('/bloggers/create', [BloggerController::class, 'store'])->name('create-blogger');
        Route::post('/blogger/projects', [ProjectController::class, 'bloggerProjects']);
        Route::post('/seller/projects', [ProjectController::class, 'bloggerProjects']);

        Route::post('/works', [WorkController::class, 'store'])->name('create-work');
        Route::post('/works/accept-application', [WorkController::class, 'acceptApplication']);
        Route::post('/works/{work_id}/accept', [WorkController::class, 'accept']);
        Route::get('/works/{work_id}/accept', [WorkController::class, 'accept']);
        Route::get('/works/{work_id}/start', [WorkController::class, 'start']);
        Route::post('/works/{work_id}/confirm', [WorkController::class, 'confirm']);
        Route::post('/works/{work}/stats', [WorkController::class, 'stats']);
        Route::get('/works/{work}/deny', [WorkController::class, 'deny']);
        Route::get('/works/{work}/chat', [WorkController::class, 'viewChat'])->name('work-chat');

        Route::post('/messages/create', [MessageController::class, 'store']);
        Route::post('/messages/count', [MessageController::class, 'count']);
        Route::post('/messages', [MessageController::class, 'index']);

        Route::post('/admin/bloggers', [AdminController::class, 'bloggers']);
        Route::post('/admin/sellers', [AdminController::class, 'sellers']);
        Route::post('/admin/moderation', [AdminController::class, 'moderation']);
        Route::post('/admin/bloggers/accept', [AdminController::class, 'accept']);
        Route::get('/admin/deny/{user}', [AdminController::class, 'deny']);
        Route::get('/admin/achievement/{user_id}', [AdminController::class, 'achievement']);

        Route::get('/applications-count', [ProjectController::class, 'getApplicationsCount']);

        Route::get('/notifications', [UserController::class, 'getNewNotifications']);
        Route::get('/notifications/view/{notification}', [NotificationController::class, 'view']);

        Route::get('/notifications/{project_id}/view', [NotificationController::class, 'view']);

        Route::get('/coverage-data', [DeepLinkController::class, 'stats']);
        Route::delete('/users/{user}', [UserController::class, 'deleteUser']);
    });
});
