<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ReportController extends Controller
{
    // -------------------
    // USER METHODS
    // -------------------
    public function index()
    {
        if (Auth::user()->hasRole('admin|supervisor')) {
            abort(403); // admin jangan akses route user
        }

        $reports = Report::where('user_id', Auth::id())->latest()->get();
        return view('user.reports.index', compact('reports'));
    }

    public function store(Request $request)
    {
        if (Auth::user()->hasRole('admin|supervisor')) {
            abort(403); // admin jangan akses route user
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|string',
        ]);

        $imagePath = null;
        if ($request->image) {
            $imageData = preg_replace('#^data:image/\w+;base64,#i', '', $request->image);
            $imageData = str_replace(' ', '+', $imageData);
            $imageBinary = base64_decode($imageData);

            $filename = 'reports/' . uniqid() . '.png';
            Storage::disk('public')->put($filename, $imageBinary);

            $imagePath = $filename;
        }

        $report = Report::create([
            'title' => $request->title,
            'description' => $request->description,
            'image_path' => $imagePath,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'user_id' => Auth::id(),
            'status' => 'pending',
        ]);

        return redirect()->back()->with('success', 'Laporan berhasil disimpan!');
    }

    // -------------------
    // ADMIN METHODS
    // -------------------
    public function adminIndex()
    {
        if (!Auth::user()->hasRole('admin|supervisor')) {
            abort(403); // user biasa nggak boleh akses admin
        }

        $reports = Report::latest()->get();
        return view('admin.reports', compact('reports'));
    }

    public function approve($id)
    {
        if (!Auth::user()->hasRole('admin|supervisor')) abort(403);

        $report = Report::findOrFail($id);
        $report->status = 'approved';
        $report->save();

        return redirect()->back()->with('success', 'Laporan disetujui!');
    }

    public function reject($id)
    {
        if (!Auth::user()->hasRole('admin|supervisor')) abort(403);

        $report = Report::findOrFail($id);
        $report->status = 'rejected';
        $report->save();

        return redirect()->back()->with('success', 'Laporan ditolak!');
    }
}
