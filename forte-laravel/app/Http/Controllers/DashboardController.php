<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard');
    }

    public function fetchData()
    {
        $host = config('services.raspi.host');
        $port = config('services.raspi.port');

        try {
            $response = Http::timeout(1)->get("http://$host:$port/data");

            if ($response->successful()) {
                return response()->json([
                    'status' => 'ok',
                    'data' => $response->json()
                ]);
            }
        } catch (\Exception $e) {
            // raspi mati / tidak ada data
        }

        return response()->json([
            'status' => 'offline',
            'data' => null
        ], 200);
    }

    public function cameraStatus()
    {
        $host = config('services.raspi.host');
        $port = config('services.raspi.port');

        return response()->json([
            'front' => $this->checkCamera("http://$host:$port/front"),
            'back'  => $this->checkCamera("http://$host:$port/back"),
            'front_url' => "http://$host:$port/front",
            'back_url'  => "http://$host:$port/back",
        ]);
    }

    private function checkCamera($url)
    {
        try {
            return Http::timeout(1)->head($url)->successful();
        } catch (\Exception $e) {
            return false;
        }
    }
}
