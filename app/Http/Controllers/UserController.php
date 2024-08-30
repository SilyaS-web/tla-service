<?php

namespace App\Http\Controllers;

use App\Models\Blogger;
use App\Models\BloggerPlatform;
use App\Models\Country;
use App\Models\DbLog;
use App\Models\DeepLink;
use App\Models\DeepLinkStat;
use App\Models\Message;
use App\Models\Platform;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Models\Project;
use App\Models\ProjectWork;
use App\Models\Seller;
use App\Models\TariffGroup;
use App\Models\Platform;
use App\Models\Theme;
use Illuminate\Database\Eloquent\Builder;
use App\Models\User;
use App\Models\Work;
use App\Services\TgService;
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

        $works = Work::where([['blogger_id', $user_id]])->where('status', Work::IN_PROGRESS)->get();

        $active_project_works = ProjectWork::whereIn('id', $works->pluck('project_work_id'))->get();

        $all_projects = Project::where('status', Project::ACTIVE)->where('is_blogger_access', 1)->get();
        $platforms = Platform::get();
        $application_works = Work::where([['blogger_id', $user_id]])->where('status', null)->where('created_by', '<>', $user_id)->where('accepted_by_blogger_at', null)->get();
        $role = $user->role;

        return compact('active_project_works', 'all_projects', 'application_works', 'works', 'role', 'user_id', 'platforms');
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

        $bloggers = Blogger::whereHas('user', function (Builder $query) {
            $query->where('status', 1);
        })->get();
        $blogger_platforms = BloggerPlatform::get();

        $works = Work::where([['seller_id', $user_id]])->get();
        $role = $user->role;
        $chat_role = "blogger";
        $platforms = Platform::get();
        $themes = Theme::get();


        $start_date = now()->subDays(30);
        $end_date = now();
        $deep_link_ids = DeepLink::whereIn('work_id', $works->pluck('id'))->get()->pluck('id');
        $deep_link_stats = DeepLinkStat::selectRaw('DATE_FORMAT(created_at, "%Y-%m-%e") as date')->whereHas('deepLink', function (Builder $query) use ($deep_link_ids) {
            $query->whereIn('link_id', $deep_link_ids);
        })->whereBetween('created_at', [$start_date, $end_date])->get();

        $bloggers_finish = Work::selectRaw('DATE_FORMAT(confirmed_by_seller_at, "%Y-%m-%e") as date')->where('seller_id', $user_id)->where('status', Work::COMPLETED)->whereBetween('created_at', [$start_date, $end_date])->get();
        $total_stats = [];
        $total_clicks = 0;
        foreach ($deep_link_stats as $deep_link_stat) {
            $total_clicks += 1;
            if (isset($total_stats[$deep_link_stat->date])) {
                $total_stats[$deep_link_stat->date]['coverage'] += 1;
            } else {
                $total_stats[$deep_link_stat->date] = [
                    'dt' => $deep_link_stat->date,
                    'coverage' => 1,
                    'bloggers' => 0
                ];
            }
        }

        foreach ($bloggers_finish as $blogger_finish) {
            if (isset($total_stats[$blogger_finish->date])) {
                $total_stats[$blogger_finish->date]['bloggers'] += 1;
            } else {
                $total_stats[$blogger_finish->date] = [
                    'dt' => $blogger_finish->date,
                    'coverage' => 0,
                    'bloggers' => 1
                ];
            }
        }
        $subscribers = 0;
        foreach ($projects as $project) {
            $subscribers = ($subscribers + $project->getSuscribers()) / 2;
        }

        $total_stats = json_encode(array_values($total_stats));

        $avg_price = $projects->avg('product_price');
        $all_projects = Project::where('status', Project::ACTIVE)->where('is_blogger_access', 1)->get();

        $brands = $user->projects()->distinct()->where('marketplace_brand', '<>', null)->pluck('marketplace_brand')->all();
        return compact('projects', 'all_projects', 'bloggers', 'works', 'role', 'user_id', 'chat_role', 'blogger_platforms', 'platforms', 'themes', 'total_stats', 'total_clicks', 'subscribers', 'avg_price', 'brands');
    }

    public function getAdminProfileData()
    {
        return [];
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
            'image' => 'image|nullable',
            'old_password' => 'min:8|nullable',
            'password' => 'min:8|nullable',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $validated = $validator->validated();
        if (isset($validated['password'])) {
            if (auth()->attempt(['phone' => $user->phone, 'password' => $validated['old_password']])) {
                $user->password = bcrypt($validated['password']);
                $user->save();
            } else {
                return redirect()->route('edit-profile')->with('success', 'Введён неверный пароль');
            }
        }

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
            'wb_link' => 'string|nullable',
            'wb_api_key' => 'string|nullable',
            'ozon_link' => 'string|nullable',
            'ozon_client_id' => 'numeric|nullable',
            'ozon_api_key' => 'string|nullable',
            'inn' => 'string|nullable',
            'organization_type' => 'string|nullable',
            'organization_name' => 'string|nullable',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $validated = $validator->validated();
        $seller->update([
            'wb_link' => $validated['wb_link'],
            'wb_api_key' => $validated['wb_api_key'],
            'ozon_api_key' => $validated['ozon_api_key'],
            'ozon_link' => $validated['ozon_link'],
            'ozon_client_id' => $validated['ozon_client_id'],
            'inn' => $validated['inn'],
            'organization_type' => $validated['organization_type'],
            'organization_name' => $validated['organization_name'],
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

        $notifications = $user->notifications()->where('viewed_at', null)->get();
        return response()->json(['view' => view('shared.notifications', compact('notifications'))->render(), 'count' => $notifications->count()]);
    }

    public function tariffs() {
        $tariff_groups = TariffGroup::where('id', '<>', 1)->get();
        return view('tariff', compact('tariff_groups'));
    }

    public function sendFeedback() {
        $validator = Validator::make(request()->all(), [
            'phone' => 'string|required',
            'name' => 'string|required',
            'comment' => 'string|required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $validated = $validator->validated();
        $message_text = "Форма обратной связи\n\nИмя: " . $validated['name'] ."\nТелефон: " . $validated['phone'] ."\nСообщение: " . $validated['comment'];
        $result = TgService::sendForm($message_text);
        return response()->json($result);
    }

    public function deleteUser(User $user) {
        $log_message = 'Удалён пользователь ' . $user->name . ', роль ' . $user->role . ', телефон' . $user->phone . ', email' . $user->email;
        DbLog::create(['text' => $log_message]);

        $user->forceDelete();
        return response()->json();
    }
}
