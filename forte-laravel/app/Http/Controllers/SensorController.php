<?php

namespace App\Http\Controllers;

use App\Models\Sensor;

class SensorController extends Controller
{
    public function dashboard()
    {
        $sensor = Sensor::latest()->first();

        return view('dashboard', compact('sensor'));
    }
}
