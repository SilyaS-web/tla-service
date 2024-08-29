<?php

namespace App\Http\Controllers;

use App\Models\Seller;
use App\Models\SellerTariff;
use App\Models\Tariff;
use App\Models\TgPhone;
use App\Services\TgService;
use Illuminate\Http\Request;
use App\Models\User;
use App\Services\PhoneService;
use App\Services\ReferralService;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function register()
    {
        session()->put('ref_code', $_GET['code'] ?? session()->get('ref_code', null) ?? null);
        return view('auth.register');
    }

    public function login()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|unique:users,phone',
            'role' => ['required', Rule::in(User::TYPES)],
            'password' => 'required|confirmed|min:8'
        ]);

        if ($validator->fails()) {
            return redirect()->route('register')->withErrors($validator->errors())->withInput();
        }

        $validated = $validator->validated();
        $phone = PhoneService::format($validated['phone']);
        if (User::where([['phone', '=',  $phone]])->first()) {
            return redirect()->route('register')->with('success', 'Аккаунт с таким номером телефона уже существует')->withInput();
        }

        $tg_phone = TgPhone::where([['phone', '=',  $phone]])->first();
        if (!$tg_phone) {
            return redirect()->route('register')->with('success', 'Необходимо подтвердить телеграм')->withInput();
        }

        $is_agent = 0;

        if ($validated['role'] == 'agent') {
            $validated['role'] = 'seller';
            $is_agent = 1;
        }

        $validated['status'] = $validated['role'] == 'seller' ? 1 :0;

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
            $tariff = Tariff::find(1);
            SellerTariff::create([
                'user_id' => $user->id,
                'tariff_id' => $tariff->id,
                'type' => $tariff->type,
                'quantity' => $tariff->quantity,
                'finish_date' => \Carbon\Carbon::now()->addDays($tariff->period),
                'activation_date' => \Carbon\Carbon::now(),
            ]);
            $user->update(['status' => 1]);
        }

        if (session()->has('ref_code')) {
            ReferralService::ref($user->id, session()->get('ref_code'));
        }

        $credentials = [
            'phone' => $phone,
            'password' => $validated['password'],
        ];

        Auth::attempt($credentials);
        request()->session()->regenerate();
        if ($user->role == 'seller') {
            return redirect()->route('profile')->with('success', 'Аккаунт успешно создан')->with('show_tariffs', true);
        } else {
            return redirect()->route('profile')->with('success', 'Аккаунт успешно создан');
        }
    }


    public function setTGPhone()
    {
        $validator = Validator::make(request()->all(), [
            'phone' => 'required|numeric|unique:tg_phones,phone',
            'chat_id' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $validated = $validator->validated();
        $validated['phone'] = PhoneService::format($validated['phone']);
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
        $tgPhone = TgPhone::where([['phone', '=',  $phone]])->first();
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

        if (!User::where('phone',  $phone)->first()) {
            return redirect()->route('login')->withErrors([
                'phone' => 'Пользователь с указанным номером не найден',
            ]);
        }

        if (auth()->attempt($credentials)) {
            request()->session()->regenerate();

            return redirect()->route('profile')->with('success');
        };

        return redirect()->route('login')->withErrors([
            'password' => 'Пароль неверный'
        ]);
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
        $tg_phone = TgPhone::where([['phone', '=',  $phone]])->first();
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

    public function banned() {
        return view('auth.banned');
    }
}
