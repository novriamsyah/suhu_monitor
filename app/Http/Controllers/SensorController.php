<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class SensorController extends Controller
{
    public function getValueSensor($temperature=0, $humidity=0) {
        
        try {
            DB::beginTransaction();
            
            $data = DB::table('sensor_values');
            $tgl = Carbon::now();

            $data->insert([
                'temperature' => $temperature,
                'humidity' => $humidity,
                'created_at' => $tgl,
                'updated_at' => $tgl
            ]);

            Db::commit();
        } catch (\Throwable $th) {
            Db::rollBack();
            throw $th;
        }

        // return event(new Ytbs1Projek($tegangan, $arus, $dy_aktif, $energi));
    }
}
