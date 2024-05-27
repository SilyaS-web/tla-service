<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Project;
use App\Models\ProjectFile;
use App\Models\User;
use App\Models\Work;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Builder;

class MessageController extends Controller
{
    public function index(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'exists:users,id|nullable',
            'new_only' => 'boolean',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $user = Auth::user();
        if (!$user) {
            $user = User::find($request->user_id);
        }
        $validated = $validator->validated();
        $user_id = $user->id;
        $role = $user->role;
        $works = Work::where([
            'user_id' => $user_id,
        ]);

        return view('shared.chat.index', compact('works', 'user_id', 'role'));
    }

    public function count(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'exists:users,id|nullable',
            'work_id' => 'required|exists:users,id',
        ]);

        $user = Auth::user();
        if (!$user) {
            $user = User::find($request->user_id);
        }

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $validated = $validator->validated();
        $user_id = $user->id;

        $works = Message::where([
            ['work_id', $validated['work_id']],
            ['user_id', '<>', $user_id]
        ]);

        

        return view('shared.chat.index', compact('works', 'user_id'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'work_id' => 'required|exists:works,id',
            'user_id' => 'exists:users,id|nullable',
            'message' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $user = Auth::user();
        if (!$user) {
            $user = User::find($request->user_id);
        }

        $validated = $validator->validated();
        $validated['user_id'] = $user->id;

        Message::create($validated);

        return response()->json(['message' => 'success'], 200);
    }

    public function workViewed(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'work_id' => 'required|exists:works,id',
            'user_id' => 'exists:users,id|nullable',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $validated = $validator->validated();

        $user = Auth::user();
        if (!$user) {
            $user = User::find($request->user_id);
        }

        Message::whereIn('work_id', $validated['work_id'])->where('created_at', '<=', time())->update(['viewed_at' => time()]);
        return response()->json(['message' => 'success'], 200);
    }
}
