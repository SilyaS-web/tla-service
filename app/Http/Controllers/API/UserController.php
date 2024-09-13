<?php

namespace App\Http\Controllers\API;

use App\Models\Blogger;
use App\Models\BloggerPlatform;
use App\Models\User;
use App\Services\TgService;
use App\Http\Controllers\Controller;
use App\Models\DbLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Builder;

class UserController extends Controller
{
    public function ban(User $user)
    {
        $user->status = -1;
        $user->save();
        if ($user->status == 0 && $user->role == User::BLOGGER) {
            TgService::notify($user->tgPhone->chat_id, 'Вы не прошли модерацию');
        } else {
            TgService::notify($user->tgPhone->chat_id, 'Вы были забанены');
        }

        return response()->json()->setStatusCode(200);
    }

    public function unban(User $user)
    {
        $user->status = 1;
        $user->save();
        TgService::notify($user->tgPhone->chat_id, 'Ваш аккаунт разблокировали');

        return response()->json()->setStatusCode(200);
    }

    public function delete(User $user) {
        $log_message = 'Удалён пользователь ' . $user->name . ', роль ' . $user->role . ', телефон' . $user->phone . ', email' . $user->email;
        DbLog::create(['text' => $log_message]);

        $user->forceDelete();
        return response()->json()->setStatusCode(200);
    }
}
Ye 
