<?php

namespace App\Http\Controllers;

use Filament\Facades\Filament;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Login extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            session()->regenerate();
            return redirect()->intended(Filament::getUrl());
        }
        return redirect('/login');
    }
    public function index()
    {
        if (Auth::check()) {
            return redirect()->intended(Filament::getUrl());
        }
        return view('auth.login');
    }
}
