<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SensorController;
use App\Http\Controllers\LogTableController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminReportController;
use App\Http\Controllers\OperatorController;
use App\Http\Controllers\AdminController;
use PHPUnit\Framework\Constraint\Operator;
use App\Http\Controllers\PowerController;
use App\Http\Controllers\MQTTController;

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
// Route::middleware('auth')->group(function () {

// Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/power', [PowerController::class, 'index'])->name('power');
Route::get('/fetch-mqtt-data', [MQTTController::class, 'getLatestData'])->name('mqttfetch.data');

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
Route::view('/profil', 'lp-setting-profile')->name('profil');


// REPORT (laporan)
Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
Route::post('/reports', [ReportController::class, 'store'])->name('reports.store');
// });

/*
|--------------------------------------------------------------------------
| ADMIN ONLY ROUTES (spatie role: admin|superadmin)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin|superadmin'])->group(function () {

    // Admin Dashboard
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');

    // CRUD Resources
    Route::resource('admin/sensors', SensorController::class);

    Route::resource('admin/users', UserController::class);
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/export', [UserController::class, 'exportCsv'])->name('users.export');
    Route::post('/users/import', [UserController::class, 'importCsv'])->name('users.import');

    Route::get('admin/reports', [ReportController::class, 'adminIndex'])->name('reports.index');
    Route::post('admin/reports/{id}/approve', [ReportController::class, 'approve'])->name('reports.approve');
    Route::post('admin/reports/{id}/reject', [ReportController::class, 'reject'])->name('reports.reject');
});
