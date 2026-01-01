<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SensorController;
use App\Http\Controllers\LogTableController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES (tanpa login)
|--------------------------------------------------------------------------
*/

// Landing page
Route::get('/', function () {
    return view('lp-awal');
})->name('home');

// About
Route::get('/about', function () {
    return view('lp-about');
})->name('about');

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
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    // Fetch realtime / camera
    Route::get('/fetch-data', [DashboardController::class, 'fetchData'])
        ->name('fetch.data');

    Route::get('/camera/status', [DashboardController::class, 'cameraStatus'])
        ->name('camera.status');

    // Sensor dashboard (kalau masih dipakai)
    Route::get('/sensor/dashboard', [SensorController::class, 'dashboard'])
        ->name('sensor.dashboard');

    // Map & Table
    Route::get('/map', function () {
        return view('map');
    })->name('map');

    Route::get('/table-data', [LogTableController::class, 'index'])
        ->name('table-data');

    // Settings
    Route::get('/setting', function () {
        return view('lp-setting');
    })->name('setting');

    Route::get('/wifi', function () {
        return view('lp-setting-wifi');
    })->name('wifi');

    Route::get('/controller', function () {
        return view('lp-setting-controller');
    })->name('controller');

    /*
    |--------------------------------------------------------------------------
    | REPORT (LAPORAN)
    |--------------------------------------------------------------------------
    */

    // Simpan laporan (gambar + title + desc + lat long dummy)
    Route::post('/report', [ReportController::class, 'store'])
        ->name('report.store');
});

/*
|--------------------------------------------------------------------------
| ADMIN ONLY ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'admin'])->group(function () {

    // CRUD User (khusus admin)
    // Route::resource('/users', UserController::class);
});
