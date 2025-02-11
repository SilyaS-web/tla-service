<?php

namespace App\Http\Controllers;

class AuthController extends Controller
{
    public function logout()
    {
        auth()->logout();
        request()->session()->regenerateToken();
        request()->session()->invalidate();

        return redirect()->route('login');
    }
}
