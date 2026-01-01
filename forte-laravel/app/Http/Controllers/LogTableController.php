<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Report;
use Illuminate\Support\Facades\Auth;

class LogTableController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $reports = Report::with('classifications')
        ->where('user_id', $userId)
        ->orderBy('created_at', 'desc')
        ->paginate(10);
        
        return view('table-data', compact('reports'));
    }
}
