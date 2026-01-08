<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Power;

class PowerController extends Controller
{
    public function index()
    {
        return view('operator.power');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'voltage'     => 'required|numeric',
            'current'     => 'required|numeric',
            'power'       => 'required|numeric',
            'energy_wh'   => 'required|numeric',
            'energy_kwh'  => 'required|numeric',
        ]);

        $reading = Power::create($data);

        $tarif = ElectricityTariff::latest('effective_from')->first();
        $biaya = $tarif
            ? $reading->energy_kwh * $tarif->price_per_kwh
            : 0;

        return response()->json([
            'success' => true,
            'data' => [
                'voltage'    => $reading->voltage,
                'current'    => $reading->current,
                'power'      => $reading->power,
                'energy_wh'  => $reading->energy_wh,
                'energy_kwh' => $reading->energy_kwh,
                'biaya'      => round($biaya, 2),
            ]
        ]);
    }
}
