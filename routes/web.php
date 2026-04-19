<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\AgencyController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Petugas\ReportController as PetugasReportController;
use App\Http\Controllers\UserReportController;

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
Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    Route::resource('categories', CategoryController::class)->names('admin.categories');
    Route::resource('agencies', AgencyController::class)->names('admin.agencies');
    
    Route::resource('reports', ReportController::class)->names('admin.reports');
});

// Petugas routes (auth + petugas role)
Route::prefix('petugas')->middleware(['auth', 'role:petugas'])->group(function () {
    Route::get('/dashboard', function () {
        $assignedReports = \App\Models\Reports::with(['user', 'category', 'agency'])->latest()->take(10)->get();
        $stats = [
            'total' => \App\Models\Reports::count(),
            'pending' => \App\Models\Reports::where('status', 'menunggu')->count(),
            'processing' => \App\Models\Reports::where('status', 'diproses')->count(),
        ];
        return view('petugas.dashboard', compact('assignedReports', 'stats'));
    })->name('petugas.dashboard');
    
    Route::get('/reports', [PetugasReportController::class, 'index'])->name('petugas.reports.index');
    Route::patch('/reports/{report}', [PetugasReportController::class, 'updateStatus'])->name('petugas.reports.updateStatus');
});

// User routes (auth + user role)
Route::middleware(['auth', 'role:masyarakat'])->group(function () {
    Route::get('/user/dashboard', function () {
        $myReports = auth()->user()->reports()->with(['category', 'agency'])->latest()->take(5)->get();
        $publicReports = \App\Models\Reports::with(['user', 'category', 'agency'])->latest()->take(5)->get();
        return view('user.dashboard', compact('myReports', 'publicReports'));
    })->name('user.dashboard');

    Route::get('/report', [UserReportController::class, 'index'])->name('report.index');
    Route::get('/report/create', [UserReportController::class, 'create'])->name('report.create');
    Route::post('/report', [UserReportController::class, 'store'])->name('report.store');
    Route::get('/report/{report}/edit', [UserReportController::class, 'edit'])->name('report.edit');
    Route::put('/report/{report}', [UserReportController::class, 'update'])->name('report.update');
    Route::delete('/report/{report}', [UserReportController::class, 'destroy'])->name('report.destroy');
});
?>

