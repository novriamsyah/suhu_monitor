<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class SensorController extends Controller
{
    public function getValueSensor($tegangan=0, $arus=0, $dy_aktif=0, $energi=0, $biaya=0, $sisa_token=0) {
        
        try {
            DB::beginTransaction();
            
            $data = DB::table('sensor_values');
            $tgl = Carbon::now();

            $data->insert([
                'tegangan' => $tegangan,
                'arus' => $arus,
                'dy_aktif' => $dy_aktif,
                // 'dy_reaktif' => $dy_reaktif,
                // 'dy_semu' => $dy_semu,
                // 'frekuensi' => $frekuensi,
                'energi' => $energi,
                'biaya' => $biaya,
                'created_at' => $tgl,
                'updated_at' => $tgl
            ]);

            $token = DB::table('tokens');
            $token->update([
                'sisa_token' => $sisa_token,
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
