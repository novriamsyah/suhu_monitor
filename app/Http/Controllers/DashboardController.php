<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SensorValue;
use App\Models\Token;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.index');
    }

    public function dataCardSensor()
    {
        $data = SensorValue::latest()->take(1)->get();

        return response()->json([
            'data' => $data,
        ]);

    }
}
