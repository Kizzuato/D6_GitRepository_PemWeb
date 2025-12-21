<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard');
    }

    public function fetchData()
    {
        $response = Http::get('http://192.168.1.73:5000/data');

        if ($response->successful()) {
            return response()->json($response->json());
        } else {
            return response()->json(null, 500);
        }
    }
}
