<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SensorController;
use App\Http\Controllers\LogTableController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminReportController;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES (tanpa login)
|--------------------------------------------------------------------------
*/

// Landing page
Route::view('/', 'lp-awal')->name('home');
Route::view('/about', 'lp-about')->name('about');

// Login & Register
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.process');

Route::get('/register', [LoginController::class, 'showRegister'])->name('register');
Route::post('/register', [LoginController::class, 'register'])->name('register.process');

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| AUTHENTICATED USER ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Fetch realtime / camera
    Route::get('/fetch-data', [DashboardController::class, 'fetchData'])->name('fetch.data');
    Route::get('/camera/status', [DashboardController::class, 'cameraStatus'])->name('camera.status');

    // Sensor dashboard
    Route::get('/sensor/dashboard', [SensorController::class, 'dashboard'])->name('sensor.dashboard');

    // Map & Table
    Route::view('/map', 'map')->name('map');
    Route::get('/table-data', [LogTableController::class, 'index'])->name('table-data');

    // Settings pages
    Route::view('/setting', 'lp-setting')->name('setting');
    Route::view('/wifi', 'lp-setting-wifi')->name('wifi');
    Route::view('/controller', 'lp-setting-controller')->name('controller');

    // REPORT (laporan)
    Route::post('/report', [ReportController::class, 'store'])->name('report.store');
});

/*
|--------------------------------------------------------------------------
| ADMIN ONLY ROUTES (spatie role: admin|superadmin)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin|superadmin'])->group(function () {

    // Admin Dashboard
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');

    // CRUD Resources
    Route::resource('admin/users', UserController::class);
    Route::resource('admin/sensors', SensorController::class);
    Route::resource('admin/reports', AdminReportController::class);
});
