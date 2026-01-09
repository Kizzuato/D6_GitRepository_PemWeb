<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Power;
use Illuminate\Support\Facades\DB;

class PowerController extends Controller
{
    public function index()
    {
        // Data terbaru (realtime card)
        $latest = Power::latest('created_at')->first();

        // Total energy & cost
        $totalEnergy = Power::max('energy_kwh');

        // Tarif PLN (dummy, bisa pindah ke tabel tariff)
        $tarifPerKwh = 1444.7;

        $totalCost = $totalEnergy * $tarifPerKwh;

        // Energy hari ini
        $todayEnergy = Power::whereDate('created_at', today())
            ->max('energy_kwh');

        // Prediksi bulanan (simple & dosen-friendly)
        $avgDailyEnergy = Power::select(
            DB::raw('MAX(energy_kwh) / COUNT(DISTINCT DATE(created_at)) as avg')
        )->value('avg');

        $predictedMonthlyCost = $avgDailyEnergy * 30 * $tarifPerKwh;

        return view('operator.power', compact(
            'latest',
            'totalEnergy',
            'totalCost',
            'todayEnergy',
            'predictedMonthlyCost',
            'tarifPerKwh'
        ));
    }

    public function chartPower()
    {
        return Power::orderBy('created_at', 'asc')
            ->limit(50)
            ->get()
            ->map(fn($p) => [
                'time' => $p->created_at->format('H:i'),
                'power' => $p->power
            ]);
    }
    /**
     * API: summary harian
     */
    public function dailySummary()
    {
        $tarif = 1444.7;

        $data = Power::select(
            DB::raw('DATE(created_at) as date'),
            DB::raw('MAX(energy_kwh) as energy')
        )
            ->groupBy('date')
            ->orderBy('date')
            ->get()
            ->map(function ($row) use ($tarif) {
                return [
                    'date'  => $row->date,
                    'kwh'   => $row->energy,
                    'cost'  => round($row->energy * $tarif, 2)
                ];
            });

        return response()->json($data);
    }

    public function logTable(Request $request)
    {
        $query = Power::query();

        // 🔍 search (voltage / current / power)
        if ($request->search) {
            $query->where('voltage', 'like', "%{$request->search}%")
                ->orWhere('current', 'like', "%{$request->search}%")
                ->orWhere('power', 'like', "%{$request->search}%");
        }

        // 📅 filter date
        if ($request->date) {
            $query->whereDate('created_at', $request->date);
        }

        $logs = $query
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return response()->json($logs);
    }
}
