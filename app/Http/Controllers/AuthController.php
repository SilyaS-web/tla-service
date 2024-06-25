<?php

namespace App\Http\Controllers;

use App\Models\Seller;
use App\Models\TgPhone;
use App\Services\TgService;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function register()
    {
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

        if ($validated['role'] == 'seller') {
            $validated['status'] = 1;
        } else {
            $validated['status'] = 0;
        }

        $phone_for_search = str_replace(['(', ')', ' ', '-'], '', $validated['phone']);

        $tg_phone = TgPhone::where([['phone', '=',  $phone_for_search]])->first();
        if (!$tg_phone) {
            $tg_phone = TgPhone::where([['phone', '=',  mb_substr($phone_for_search, 1)]])->first();
            if (!$tg_phone) {
                return redirect()->route('register')->with('success', 'Необходимо подтвердить телеграм')->withInput();
            }
        }

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'tg_phone_id' => $tg_phone->id,
            'role' => $validated['role'],
            'status' => $validated['status'],
            'password' => bcrypt($validated['password']),
        ]);

        if ($validated['role'] == 'seller') {
            Seller::create([
                'user_id' => $user->id
            ]);
        }

        $credentials = request()->only('phone', 'password');
        Auth::attempt($credentials);
        request()->session()->regenerate();

        return redirect()->route('profile')->with('success', 'Аккаунт успешно создан');
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

        $phone_for_search = str_replace(['(', ')', ' ', '-'], '', $validated['phone']);
        $tgPhone = TgPhone::where([['phone', '=',  $phone_for_search]])->first();
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

        if (auth()->attempt($validated)) {
            request()->session()->regenerate();

            return redirect()->route('profile')->with('success');
        };

        return redirect()->route('login')->withErrors([
            'phone' => 'Пользователь с указанным номером и паролем не найден'
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
        $phone_for_search = str_replace(['(', ')', ' ', '-'], '', $validated['phone']);
        $tg_phone = TgPhone::where([['phone', '=',  $phone_for_search]])->first();
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
