<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Services\TgService;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProjectResource;
use App\Models\DbLog;
use App\Models\Project;
use Illuminate\Validation\Rule;
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

    public function projects(User $user) {
        $validator = Validator::make(request()->all(), [
            'project_type' => [Rule::in(Project::TYPES)],
            'product_name' => '',
            'statuses' => 'array|nullable',
            'statuses.*' => 'string',
            'is_blogger_access' => 'boolean|nullable'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors())->setStatusCode(400);
        }

        $projects = $user->projects();

        $validated = $validator->validated();

        if (isset($validated['statuses']) && !empty($validated['statuses'])) {
            $projects->whereIn('status', $validated['statuses']);
        }

        if (isset($validated['is_blogger_access']) && !empty($validated['is_blogger_access'])) {
            $projects->where('is_blogger_access', $validated['is_blogger_access']);
        }

        if (isset($validated['project_name']) && !empty($validated['project_name'])) {
            $projects->where('product_name', 'like', '%' . $validated['project_name'] . '%');
        }

        if (isset($validated['project_type']) && !empty($validated['project_type'])) {
            $projects->whereHas('projectWorks', function (Builder $query) use ($validated) {
                $query->where('type', $validated['project_type']);
            });
        }

        $data = [
            'projects' => ProjectResource::collection($projects),
        ];

        return response()->json($data)->setStatusCode(200);
    }
}
