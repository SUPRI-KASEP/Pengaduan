<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoryController;

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
        Route::get('/admin/categories', [CategoryController::class, 'index'])->name('admin.categories.index');
        Route::get('/admin/categories/create', [CategoryController::class, 'create'])->name('admin.categories.create');
        Route::post('/admin/categories', [CategoryController::class, 'store'])->name('admin.categories.store');
        Route::get('/admin/categories/{category}', [CategoryController::class, 'show'])->name('admin.categories.show');
        Route::get('/admin/categories/{category}/edit', [CategoryController::class, 'edit'])->name('admin.categories.edit');
        Route::put('/admin/categories/{category}', [CategoryController::class, 'update'])->name('admin.categories.update');
        Route::delete('/admin/categories/{category}', [CategoryController::class, 'destroy'])->name('admin.categories.destroy');
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

