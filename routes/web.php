<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\JobController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;

Route::get('/test', function () {
    return response()->json([
        'status' => 'success',
        'message' => 'Laravel is working!',
        'app_name' => config('app.name'),
        'app_env' => config('app.env'),
        'database' => config('database.default')
    ]);
});

Route::get('/env-check', function () {
    try {
        $dbConnection = DB::connection()->getPdo();
        $dbStatus = 'connected';
    } catch (Exception $e) {
        $dbStatus = 'failed: ' . $e->getMessage();
    }

    return response()->json([
        'app_key' => config('app.key') ? 'set' : 'missing',
        'app_debug' => config('app.debug'),
        'database_status' => $dbStatus,
        'storage_writable' => is_writable(storage_path()),
        'bootstrap_cache_writable' => is_writable(bootstrap_path('cache'))
    ]);
});

// ✅ Redirect root URL to login
Route::get('/', function () {
    return redirect()->route('login');
});

// 🔐 Authentication Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// 👤 Registration
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');

// 🏠 Dashboard (after login)
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// 👤 Profile
Route::get('/profile', [AuthController::class, 'showProfile'])->name('profile');
Route::post('/profile', [AuthController::class, 'updateProfile'])->name('profile.update');

// 💼 Job Routes
Route::get('/jobs', [JobController::class, 'index'])->name('jobs.index');
Route::get('/apply/{job}', [JobController::class, 'showApplyForm'])->name('jobs.apply');
Route::post('/apply/{job}', [JobController::class, 'submitApplication'])->name('jobs.apply.submit');
Route::get('/jobs/create', [JobController::class, 'create'])->name('jobs.create');
Route::post('/jobs/store', [JobController::class, 'store'])->name('jobs.store');

// 📥 Employer: Manage Applications
Route::get('/employer/applications', [ApplicationController::class, 'index'])->name('employer.applications');
Route::post('/employer/applications/{id}/approve', [ApplicationController::class, 'approve'])->name('employer.applications.approve');
Route::post('/employer/applications/{id}/reject', [ApplicationController::class, 'reject'])->name('employer.applications.reject');

// 📄 Jobseeker: View My Applications
Route::get('/my-applications', [ApplicationController::class, 'myApplications'])->name('jobseeker.applications');

// 🛠️ Admin Routes
Route::get('/admin', [AdminController::class, 'index'])->name('admin.page');
Route::post('/admin/employer/{id}', [AdminController::class, 'updateEmployer'])->name('admin.update.employer');
Route::post('/admin/application/{id}', [AdminController::class, 'updateApplication'])->name('admin.update.application');

// 🏢 Employer Company Name Update
Route::post('/employer/company-name', [AuthController::class, 'updateCompanyName'])->name('employer.update.company');
