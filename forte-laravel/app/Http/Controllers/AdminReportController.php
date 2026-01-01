<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Report;
use App\Models\Validation;
use Illuminate\Support\Facades\DB;

class AdminReportController extends Controller
{
    public function approve(Request $request, Report $report)
    {
        $request->validate([
            'classification_ids' => 'required|array'
        ]);

        DB::transaction(function () use ($report, $request) {
            $report->update(['status' => 'approved']);

            Validation::create([
                'report_id' => $report->id,
                'admin_id' => auth()->id(),
                'note' => 'Laporan disetujui',
                'validated_at' => now()
            ]);

            $report->classifications()->sync($request->classification_ids);
        });

        return redirect()->back()->with('success', 'Report approved & classified!');
    }
}
