<?php

namespace App\Http\Middleware;

use App\Models\DbLog;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Route;

class LogAction
{
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            $name = Route::currentRouteName();
            $action = Route::currentRouteAction();
            if ($action !== '@notifications' && $action !== '@works') {
                DbLog::query()->create([
                    'user_id' => Auth::id(),
                    'text' => $name . '|' . $action . '|' . json_encode($request->all()),
                ]);
            }
        }

        return $next($request);
    }
}
