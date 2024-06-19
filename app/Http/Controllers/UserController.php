<?php

namespace App\Http\Controllers;

use App\Models\Blogger;
use App\Models\BloggerPlatform;
use App\Models\Country;
use App\Models\DeepLink;
use App\Models\DeepLinkStat;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Models\Project;
use App\Models\Seller;
use App\Models\TgPhone;
use App\Models\Theme;
use Illuminate\Database\Eloquent\Builder;
use App\Models\User;
use App\Models\Work;
use Illuminate\Support\Facades\Storage;

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
                if ($user->status == 0) {
                    if (!$user->blogger) {
                        $countries = Country::get();
                        $themes = Theme::get();
                        return view('auth.blogger-verify', compact('countries', 'themes'));
                    }

                    return view('auth.moderation');
                }

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

        $works = Work::where([['blogger_id', $user_id]])->where('status', '<>', null)->get();
        $projects = Project::whereIn('id', $works->pluck('project_id'))->get();
        $all_projects = Project::get();

        $blogger_orders = Project::whereHas('works', function (Builder $query) use ($user_id) {
            $query->where([['blogger_id', $user_id]])->where('created_by', '<>', $user_id)->where('accepted_by_blogger_at', null);
        })->get();
        $role = $user->role;

        return compact('projects', 'all_projects', 'blogger_orders', 'works', 'role', 'user_id');
    }


    public function getSellerProfileData()
    {
        $user = Auth::user();
        $user_id = $user->id;

        $validator = Validator::make(request()->all(), [
            'project_type' => [Rule::in(Project::TYPES)],
            'product_name' => '',
            'status' => '',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $projects = $user->projects()->where($validator->validated())->withCount(['works' => function (Builder $query) {
            $query->where('status', 1);
        }])->get();

        $bloggers = Blogger::get();
        $blogger_platforms = BloggerPlatform::get();

        $works = Work::where([['seller_id', $user_id]])->get();
        $role = $user->role;
        $chat_role = "blogger";
        $platforms = BloggerPlatform::PLATFORM_TYPES;
        $themes = Theme::get();

        // $deep_link_ids = DeepLink::whereIn('work_id', $works->pluck('id'))->get();
        // $deep_link_stats = DeepLinkStat::whereHas('deep_links', function (Builder $query) use ($deep_link) {
        //     $query->where('name', 'like', '%' . $validated['blogger_name'] . '%');
        // })->get();

        return compact('projects', 'bloggers', 'works', 'role', 'user_id', 'chat_role', 'blogger_platforms', 'platforms', 'themes');
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
                $query->where('name', 'like', '%' . $validated['blogger_name'] . '%')->where('status', 1);
            })->get();
        } else {
            $bloggers = Blogger::whereHas('user', function (Builder $query) use ($validated) {
                $query->where('status', 1);
            })->get();
        }

        $sellers = [];
        if (!empty($validated['seller_name'])) {
            $sellers = Seller::whereHas('user', function (Builder $query) use ($validated) {
                $query->where('name', 'like', '%' . $validated['seller_name'] . '%');
            })->get();
        } else {
            $sellers = Seller::get();
        }
        $platforms = BloggerPlatform::PLATFORM_TYPES;
        $countries = Country::get();

        return compact('unverified_users', 'bloggers', 'sellers', 'platforms', 'countries');
    }

    public function edit(Request $request)
    {
        $user = Auth::user();
        $countries = Country::get();
        return view('profile.edit.' . $user->role, compact('user', "countries"));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $countries = Country::get();
        $validator = Validator::make(request()->all(), [
            'name' => 'required|min:3',
            'email' => 'required|email',
            'image' => 'image|nullable'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $validated = $validator->validated();

        $user->name = $validated['name'];
        if ($user->email != $validated['email']) {
            $user->email = $validated['email'];
        }

        if ($request->file('image')) {
            if (Storage::exists($user->getImageURL())) {
                Storage::delete($user->getImageURL());
            }

            $product_image = $request->file('image');
            $image_path = $product_image->store('profile', 'public');
            $user->image = $image_path;
        }

        $user->save();

        if ($user->role == 'seller') {
            $this->updateSeller();
        } else {
            $this->updateBlogger();
        }

        return redirect()->route('edit-profile')->with('success', 'Данные успешно обновлены');
    }

    public function updateBlogger()
    {
        $blogger = Auth::user()->blogger;
        $validator = Validator::make(request()->all(), [
            'country_id' => 'required|exists:countries,id',
            'city' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $validated = $validator->validated();

        $blogger->country_id = $validated['country_id'];
        $blogger->city = $validated['city'];

        $blogger->save();
    }

    public function updateSeller()
    {
        $seller = Auth::user()->seller;
        $validator = Validator::make(request()->all(), [
            'wb_api_key' => 'string|nullable',
            'platform_link' => 'string|nullable',
            'inn' => 'string|nullable',
            'organization_type' => 'string|nullable',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $validated = $validator->validated();
        $seller->update([
            'wb_api_key' => $validated['wb_api_key'],
            'inn' => $validated['inn'],
            'platform_link' => $validated['platform_link'],
            'organization_type' => $validated['organization_type'],
        ]);
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
