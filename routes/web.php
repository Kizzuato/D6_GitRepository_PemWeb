<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Halaman Utama diarahkan langsung ke Login
// Route::get('/', function () {
//     return view('login.form_login');
// });

// Route Tampilan Awal
Route::get('/', function () {
    return view('lp-awal');
});

// Route Login
Route::get('/login', function () {
    return view('login.form_login');
})->name('login');

// Route Register (Sudah diperbaiki ke file form_register)
Route::get('/register', function () {
    return view('login.form_register');
})->name('register');

// Route Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard');
Route::get('/fetch-data', [DashboardController::class, 'fetchData'])->name('fetch.data');
// routes/web.php
Route::get('/camera/status', [DashboardController::class, 'cameraStatus'])
    ->name('camera.status');

// Route Tabel Data
Route::get('/map', function () {
    return view('map');
})->name('map');

// Route Tabel Data
Route::get('/table-data', function () {
    return view('table-data');
})->name('table-data');

// Route Tampilan Awal
// Route::get('/awal', function () {
//     return view('lp-awal');
// })->name('awal');

// Route Tampilan Setting
Route::get('/setting', function () {
    return view('lp-setting');
})->name('setting');
// Route Tampilan Setting/wifi
Route::get('wifi', function () {
    return view('lp-setting-wifi');
})->name('wifi');
Route::get('/controller', function () {
    return view('lp-setting-controller');
})->name('controller');

// route Tampilan About
Route::get('/about', function () {
    return view('lp-about');
})->name('about');
