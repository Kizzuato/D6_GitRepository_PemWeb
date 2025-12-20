<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Halaman Utama diarahkan langsung ke Login
Route::get('/', function () {
    return view('login.form_login');
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
Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

// Route Tabel Data
Route::get('/table-data', function () {
    return view('table-data');
})->name('table-data');