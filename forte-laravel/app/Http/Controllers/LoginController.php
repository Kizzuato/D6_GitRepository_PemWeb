<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function index()
    {
        if (auth()->check()) {
            return redirect()->route('dashboard');
        }

        return view('login.form_login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $loginField = filter_var($request->username, FILTER_VALIDATE_EMAIL)
            ? 'email'
            : 'username';

        if (Auth::attempt([
            $loginField => $request->username,
            'password' => $request->password
        ])) {
            return redirect()->route('dashboard');
        }

        return back()->with('error', 'Username atau password salah');
    }

    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:users,username',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:4|confirmed',
        ]);

        Users::create([
            'name' => $request->username,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user',
        ]);

        return redirect()->route('login')->with('success', 'Registrasi berhasil');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
