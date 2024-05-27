<?php

namespace App\Http\Controllers;

use App\Models\Seller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

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

    public function telegram()
    {
        return view('auth.telegram');
    }

    public function store(Request $request)
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

        $credentials = request()->only('phone', 'password');
        Auth::attempt($credentials);
        request()->session()->regenerate();

        return redirect()->route('profile')->with('success', 'Аккаунт успешно создан');
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

        return redirect()->route('login')->with('success','');
    }
}
