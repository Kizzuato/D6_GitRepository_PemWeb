<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\Validation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index()
    {
        $reports = Report::all();
        return view('admin.reports', compact('reports'));
    }
    public function approve(Request $request, $id)
    {
        $report = Report::findOrFail($id);

        DB::transaction(function () use ($report) {
            // 1. Update status di tabel reports
            $report->update(['status' => 'approved']);

            // 2. Simpan data ke tabel validations (Relasi hasOne)
            $report->validation()->create([
                'admin_id' => auth()->id(), // Admin yang approve
                'validated_at' => now(),
                'notes' => 'Validasi otomatis oleh sistem'
            ]);

            // 3. OTOMATIS: Generate Classification (Relasi belongsToMany)
            // Contoh: kita assign classification ID 1 (misal: "Verified") secara otomatis
            // Cek dulu apakah ID 1 ada di table classifications
            $report->classifications()->syncWithoutDetaching([1]);
        });

        return back()->with('success', 'Report Approved & Classification Linked!');
    }

    public function reject($id)
    {
        $report = Report::findOrFail($id);
        $report->update(['status' => 'rejected']);

        return back()->with('error', 'Report Rejected!');
    }
}
