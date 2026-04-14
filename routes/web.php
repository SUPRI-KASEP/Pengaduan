<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (Auth::check()) {
        $role = Auth::user()->role ?? 'user';
        if ($role === 'admin') {
            return redirect('/admin/dashboard');
        }
        return redirect('/user/dashboard');
    }
    return view('welcome');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [\App\Http\Controllers\Auth\LoginController::class, 'show'])->name('login');
    Route::post('/login', [\App\Http\Controllers\Auth\LoginController::class, 'login']);
    
    Route::get('/register', [\App\Http\Controllers\Auth\RegisterController::class, 'show'])->name('register');
    Route::post('/register', [\App\Http\Controllers\Auth\RegisterController::class, 'register']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [\App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');
    
    Route::middleware('role:admin')->group(function () {
        Route::get('/admin/dashboard', function () {
            return view('admin.dashboard');
        });
    });
    
    Route::middleware('role:user')->group(function () {
        Route::get('/user/dashboard', function () {
            return view('user.dashboard');
        });
    });
    
    Route::get('/reports', function () {
        return view('reports.index');
    });
    
    Route::get('/reports/create', function () {
        return view('reports.create');
    });
});

