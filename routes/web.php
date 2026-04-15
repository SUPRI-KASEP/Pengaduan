<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\AgencyController;
use App\Http\Controllers\ReportController;

use Illuminate\Support\Facades\Auth;

// Public welcome
Route::get('/', function () {
    return view('welcome');
});

// Auth routes (public)
Route::get('/login', [LoginController::class, 'show'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'show'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Admin routes (auth + admin role)
Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    Route::resource('categories', CategoryController::class)->names('admin.categories');
    Route::resource('agencies', AgencyController::class)->names('admin.agencies');
});

// User routes (auth + user role)
Route::middleware(['auth'])->group(function () {
    Route::get('/user/dashboard', function () {
        return view('user.dashboard');
    })->name('user.dashboard');

    Route::resource('report', ReportController::class)->names('report');
});

