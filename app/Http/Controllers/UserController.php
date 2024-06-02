<?php

namespace App\Http\Controllers;

use App\Models\Blogger;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Models\Project;
use App\Models\Seller;
use App\Models\TgPhone;
use Illuminate\Database\Eloquent\Builder;
use App\Models\User;
use App\Models\Work;

class UserController extends Controller
{
    public function profile()
    {
        $user = Auth::user();

        switch ($user->role) {
            case 'seller':
                $data = $this->getSellerProfileData();
                break;

            case 'blogger':
                $data = $this->getBloggerProfileData();
                break;

            case 'admin':
                $data = $this->getAdminProfileData();
                break;

            default:
                break;
        }

        return view("profile." . $user->role, $data);
    }

    public function getBloggerProfileData()
    {
        $user = Auth::user();
        $user_id = $user->id;

        $validator = Validator::make(request()->all(), [
            'project_type' => [Rule::in(Project::TYPES)],
            'project_name' => '',
            'status' => '',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $works = Work::where([['blogger_id', $user_id]])->get();
        $projects = Project::whereIn('id', $works->pluck('project_id'))->get();
        $all_projects = Project::where($validator->validated())->get();

        $role = $user->role;

        return compact('projects', 'all_projects', 'works', 'role', 'user_id');
    }


    public function getSellerProfileData()
    {
        $user = Auth::user();
        $user_id = $user->id;

        $validator = Validator::make(request()->all(), [
            'project_type' => [Rule::in(Project::TYPES)],
            'project_name' => '',
            'status' => '',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $projects = $user->projects()->where($validator->validated())->withCount(['works' => function (Builder $query) {
            $query->where('status', 1);
        }])->get();

        $bloggers = Blogger::get();

        $works = Work::where([['seller_id', $user_id]])->get();
        $role = $user->role;
        $chat_role = "blogger";
        return compact('projects', 'bloggers', 'works', 'role', 'user_id', 'chat_role');
    }

    public function getAdminProfileData()
    {
        $validator = Validator::make(request()->all(), [
            'user_name' => 'string',
            'blogger_name' => 'string',
            'seller_name' => 'string',
        ]);

        if ($validator->fails()) {
            return [];
        }
        $validated = $validator->validated();

        $filter = [
            ['role', 'blogger'],
            ['status', 0],
        ];

        if (!empty($validated['user_name'])) {
            $filter[] = ['user_name', 'like', '%' . $validated['user_name'] . '%'];
        }

        $unverified_users = User::where($filter)->get();

        $bloggers = [];
        if (!empty($validated['blogger_name'])) {
            $bloggers = Blogger::whereHas('user', function (Builder $query) use ($validated) {
                $query->where('name', 'like', '%' . $validated['blogger_name'] . '%');
            })->get();
        } else {
            $bloggers = Blogger::get();
        }

        $sellers = [];
        if (!empty($validated['seller_name'])) {
            $sellers = Seller::whereHas('user', function (Builder $query) use ($validated) {
                $query->where('name', 'like', '%' . $validated['seller_name'] . '%');
            })->get();
        } else {
            $sellers = Seller::get();
        }
        $platforms = Blogger::PLATFORM_TYPES;

        return compact('unverified_users', 'bloggers', 'sellers', 'platforms');
    }

    public function edit()
    {
        $user = Auth::user();

        return view('profile.edit.' . $user->role, compact('user'));
    }

    public function update(Request $request)
    {
        $validated = request()->validate([
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|unique:users,phone',
            'role' => ['required', Rule::in(User::TYPES)],
            'password' => 'required|confirmed|min:8'
        ]);

        if ($validated['role'] == 'seller') {
            $validated['status'] = 1;
        } else {
            $validated['status'] = 0;
        }
        $phone_for_search = str_replace(['(', ')', ' ', '-'], '', $validated['phone']);
        $phone_for_search = '+7' . mb_substr($phone_for_search, 1);
        $tgPhone = TgPhone::where([['phone', '=',  $phone_for_search]])->first();
        if (!$tgPhone) {
            return redirect()->route('register')->with('success', 'Необходимо подтвердить телеграм')->withInput();
        }

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'role' => $validated['role'],
            'status' => $validated['status'],
            'password' => bcrypt($validated['password']),
        ]);

        if ($validated['role'] == 'seller') {
            Seller::create([
                'user_id' => $user->id
            ]);
        }
    }

    public function getNewNotifications(Request $request)
    {
        $validated = request()->validate([
            'type' => 'string',
        ]);

        $user = Auth::user();
        $user_id = $user->id;

        if (isset($validated['type']) && $validated['type'] == 'message') {
            $message_count = Message::whereHas('work', function (Builder $query) use ($user) {
                $query->where($user->role . '_id', $user->id);
            })->where('user_id', '<>', $user->id)->where('viewed_at', null)->count();
            return response()->json(['count' => $message_count]);
        }

        $old_notifications = $user->notifications()->where('viewed_at', '<>', null)->latest()->limit(4)->get();
        $notifications = $user->notifications()->where('viewed_at', null)->get();
        return response()->json(['view' => view('shared.notifications', compact('notifications', 'old_notifications'))->render(), 'count' => $notifications->count()]);
    }
}
