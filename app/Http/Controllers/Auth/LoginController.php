<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\RateLimiter;

class LoginController extends Controller
{
    public function show()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'no_hp' => 'required|string',
            'password' => 'required|string',
        ]);

        $key = 'login:' . $request->no_hp;
        if (RateLimiter::tooManyAttempts($key, 5)) {
            $seconds = RateLimiter::availableIn($key);
            throw ValidationException::withMessages([
                'no_hp' => trans('auth.throttle', ['seconds' => $seconds]),
            ]);
        }

        if (Auth::attempt(['no_hp' => $request->no_hp, 'password' => $request->password], $request->boolean('remember'))) {
            $request->session()->regenerate();
            RateLimiter::clear($key);

            $role = Auth::user()->role ?? 'user'; // Assume manual 'role' column or default 'user'
            if ($role === 'admin') {
                return redirect()->intended('/admin/dashboard');
            } elseif ($role === 'petugas') {
            return redirect()->intended('/petugas/dashboard');
            } else {
                return redirect()->intended('/user/dashboard');
            }
        }

        RateLimiter::hit($key);
        throw ValidationException::withMessages([
            'no_hp' => 'Credentials do not match.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}

