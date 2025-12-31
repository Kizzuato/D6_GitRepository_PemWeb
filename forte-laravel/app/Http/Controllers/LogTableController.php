<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LogTableController extends Controller
{
    public function index()
    {
        $data = [
            [
                'id_sensor' => 'Node_A01',
                'lintang' => '-7.1203',
                'bujur' => '110.4210',
                'zona' => 'Zona A',
                'suhu' => '29.1',
                'kelembaban' => '68'
            ],
            [
                'id_sensor' => 'Node_A02',
                'lintang' => '-7.1208',
                'bujur' => '110.4223',
                'zona' => 'Zona B',
                'suhu' => '31.3',
                'kelembaban' => '60'
            ],
            [
                'id_sensor' => 'Node_A03',
                'lintang' => '-7.1212',
                'bujur' => '110.4236',
                'zona' => 'Zona C',
                'suhu' => '27.8',
                'kelembaban' => '72'
            ],
        ];

        return view('table-data', compact('data'));
    }
}
