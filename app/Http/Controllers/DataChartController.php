<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DataChartController extends Controller
{
    public function collectionDataSensor()
    {
        $collectionData = DB::table('sensor_values')
                            ->latest('created_at')
                            ->take(10)
                            ->get()
                            ->sortBy('created_at');

        $tegangan = $collectionData->pluck('tegangan');
        $arus = $collectionData->pluck('arus');
        $dayaAktif = $collectionData->pluck('dy_aktif');
        $dayaReaktif = $collectionData->pluck('dy_reaktif');
        $dayaSemu = $collectionData->pluck('dy_semu');
        $frekuensi = $collectionData->pluck('frekuensi');
        $energi = $collectionData->pluck('energi');

        $waktu = $collectionData->pluck('created_at')->map(function ($date) {
            return Carbon::parse($date)->format('H:i:s');
        });

        return response()->json([
            'tegangan' => $tegangan,
            'arus' => $arus,
            'dayaAktif' => $dayaAktif,
            'dayaReaktif' => $dayaReaktif,
            'dayaSemu' => $dayaSemu,
            'frekuensi' => $frekuensi,
            'energi' => $energi,
            'waktu' => $waktu 
        ]);
    }

    public function collectionDataSensorDaya()
    {
        $collectionData = DB::table('sensor_values')
                            ->latest('created_at')
                            ->take(1)
                            ->get()
                            ->sortBy('created_at');

        $dayaAktif = $collectionData->pluck('dy_aktif');
        $dayaReaktif = $collectionData->pluck('dy_reaktif');
        $dayaSemu = $collectionData->pluck('dy_semu');

        $waktu = $collectionData->pluck('created_at')->map(function ($date) {
            return Carbon::parse($date)->format('H:i:s');
        });

        return response()->json([
            'dayaAktif' => $dayaAktif,
            'dayaReaktif' => $dayaReaktif,
            'dayaSemu' => $dayaSemu,
            'waktu' => $waktu 
        ]);
    }
}
