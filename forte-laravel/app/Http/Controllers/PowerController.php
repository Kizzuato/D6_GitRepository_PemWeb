<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PowerController extends Controller
{
    public function index()
    {
        return view('operator.power');
    }
}
