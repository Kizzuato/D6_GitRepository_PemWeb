<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{

    public function login(Request $request)
  {
    $request->validate([
      'username' => 'required',
      'password' => 'required'
    ], [
      'username.required' => 'Username atau email wajib diisi',
      'password.required' => 'Password wajib diisi'
    ]);

    $loginField = filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

    $infologin = [
      $loginField => $request->username,
      'password' => $request->password
    ];

    if (Auth::attempt($infologin)) {

      return redirect()->route('dashboard');
    } else {
      return redirect()->route('login')->with('error', 'Username dan Password yang dimasukan tidak valid');
    }
  }

    public function index()
  {
    if (auth()->check()) {
      return redirect()->route('dashboard');
    }

    return view('login');
  }

  public function logout()
  {
    Auth::logout();
    return redirect()->route('login');
  }
}
