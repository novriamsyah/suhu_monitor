<?php

namespace App\Http\Controllers;

use App\Models\SensorValue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DataTableController extends Controller
{
    public function dataTableSensor() 
    {
        $datas = SensorValue::latest()->take(10)->get();

        $datas->transform(function ($item, $key) {
            $item->waktu = Carbon::parse($item->created_at)->diffForHumans();
            return $item;
        });
        
        return json_encode(array('datas'=>$datas,));
    }
}
