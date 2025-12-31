<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('reports', 'public');
        }

        Report::create([
            'title' => $request->title,
            'description' => $request->description,
            'image_path' => $imagePath,
            'latitude' => -7.1203,
            'longitude' => 110.4210,
            'user_id' => auth()->id(),
        ]);

        return redirect()->back()->with('success', 'Laporan berhasil disimpan');
    }
}
