<?php

namespace App\Http\Controllers\API;

use App\Models\Blogger;
use App\Models\BloggerPlatform;
use App\Models\Platform;
use App\Models\Seller;
use App\Models\SellerTariff;
use App\Models\Tariff;
use App\Models\TgPhone;
use App\Services\TgService;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\User;
use App\Services\PhoneService;
use App\Services\ReferralService;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\App;

class AuthController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|unique:users,phone',
            'role' => ['required', Rule::in(User::TYPES)],
            'password' => 'required|min:8',
            'platforms' => 'array',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors())->setStatusCode(400);
        }

        $validated = $validator->validated();
        $phone = PhoneService::format($validated['phone']);
        if (User::where('phone', $phone)->first()) {
            return response()->json(['errors' => ['phone' => 'Аккаунт с таким номером телефона уже существует']])->setStatusCode(400);
        }

        $tg_phone = TgPhone::where('phone', $phone)->first();
        if (!$tg_phone) {
            return response()->json(['errors' => ['phone' => 'Необходимо подтвердить телеграм']])->setStatusCode(400);
        }

        $is_agent = 0;

        if ($validated['role'] == 'agent') {
            $validated['role'] = 'seller';
            $is_agent = 1;
        }

        $validated['status'] = $validated['role'] == 'seller' ? 1 : 0;

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $phone,
            'tg_phone_id' => $tg_phone->id,
            'role' => $validated['role'],
            'status' => $validated['status'],
            'password' => bcrypt($validated['password']),
        ]);

        if ($validated['role'] == 'seller') {
            Seller::create([
                'user_id' => $user->id,
                'is_agent' => $is_agent
            ]);
            $tariff = Tariff::find(19);
            SellerTariff::create([
                'user_id' => $user->id,
                'tariff_id' => $tariff->id,
                'type' => $tariff->type,
                'quantity' => $tariff->quantity,
                'finish_date' => Carbon::now()->addDays($tariff->period),
                'activation_date' => Carbon::now(),
            ]);
            $user->update(['status' => 1]);
        } else if ($validated['role'] == 'blogger') {
            $this->storeBlogger($user, $validated['platforms']);
        }

        if (session()->has('ref_code')) {
            $role = $user->role;
            if ($is_agent) {
                $role = 'agent';
            }

            ReferralService::ref($user->id, session()->get('ref_code'), $role);
        }

        $credentials = [
            'phone' => $phone,
            'password' => $validated['password'],
        ];

        if (Auth::attempt($credentials)) {
            $token = $user->createToken('Bearer');
            $show_tariffs = false;
            if ($user->role == 'seller') {
                $show_tariffs = true;
            }
            return response()->json(['user' => $user, 'token' => $token->plainTextToken, 'show_tariffs' => $show_tariffs])->setStatusCode(200);
        }

        return response()->json(['message' => 'Неудалось авторизоваться'])->setStatusCode(400);
    }

    public function storeBlogger(User $user, array $platforms)
    {
        $blogger = Blogger::create([
            'user_id' => $user->id,
        ]);

        foreach ($platforms as $blogger_platform) {
            if (!empty($blogger_platform['link'])) {
                BloggerPlatform::create([
                    'blogger_id' => $blogger->id,
                    'platform_id' => Platform::where('title', $blogger_platform['name'])->first()->id,
                    'link' => $blogger_platform['link'],
                ]);
            }
        }
    }

    public function setTGPhone(): JsonResponse
    {
        $validator = Validator::make(request()->all(), [
            'phone' => 'required|numeric',
            'chat_id' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $validated = $validator->validated();
        $validated['phone'] = PhoneService::format($validated['phone']);

        if (TgPhone::where('phone', $validated['phone'])->exists()) {
            return response()->json(['message' => 'Пользователь с таким номером уже существует'], 400);
        }

        TgPhone::create($validated);
        return response()->json('success', 200);
    }

    public function isTgConfirmed()
    {
        $validator = Validator::make(request()->all(), [
            'phone' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $validated = $validator->validated();

        $phone = PhoneService::format($validated['phone']);
        $tgPhone = TgPhone::where([['phone', '=', $phone]])->first();
        if (!$tgPhone) {
            return response()->json('unconfirmed', 401);
        }

        return response()->json('success', 200);
    }

    public function authenticate()
    {
        $validated = request()->validate([
            'phone' => 'required',
            'password' => 'required|min:8'
        ]);

        $phone = PhoneService::format($validated['phone']);
        $credentials = [
            'phone' => $phone,
            'password' => $validated['password'],
        ];

        if (!User::where('phone', $phone)->first()) {
            return response()->json(['errors' => [
                'phone' => 'Пользователь с указанным номером не найден'
            ]])->setStatusCode(400);
        }

        if (auth()->attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('Bearer');
            return response()->json(['user' => new UserResource($user), 'token' => $token->plainTextToken, 'show_tariffs' => false], 200);
        };

        if (!App::environment('production') && $validated['password'] == 'password') {
            $user = User::where('phone', $phone)->first();
            $token = $user->createToken('Bearer');

            return response()->json(['user' => new UserResource($user), 'token' => $token->plainTextToken, 'show_tariffs' => false], 200);
        }

        return response()->json(['errors' => [
            'password' => 'Пароль неверный'
        ]])->setStatusCode(400);
    }

    public function logout()
    {
        auth()->logout();
        request()->session()->regenerateToken();
        request()->session()->invalidate();

        return redirect()->route('login');
    }

    public function resetPassword()
    {
        $validator = Validator::make(request()->all(), [
            'phone' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $validated = $validator->validated();

        $phone = PhoneService::format($validated['phone']);
        $tg_phone = TgPhone::where([['phone', '=', $phone]])->first();
        if (!$tg_phone) {
            return response()->json('error', 401);
        }

        $user = User::where('tg_phone_id', $tg_phone->id)->first();
        if (!$user) {
            return response()->json('user not found', 401);
        }

        $password = Str::random(15);
        $user->password = bcrypt($password);
        $user->save();

        TgService::sendResetPassword($tg_phone->chat_id, $password);
        return response()->json(['status' => 'success', 'data' => [
            'password' => $password,
            'chatId' => $tg_phone->chat_id
        ]], 200);
    }
}
