<?php

namespace App\Exceptions;

use App\Services\TgService;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\Auth;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            $user_message = 'Неавторизованный пользователь';
            if (Auth::check()) {
                $user_message = 'ID пользователя: ' . Auth::id();
            }
            $message =  $user_message . ', ошибка в файле: ' . $e->getFile() . ' на строке: ' . $e->getLine() . '
            ' . $e->getMessage() ;
            TgService::sendToDevBot($message);
        });
    }
}
