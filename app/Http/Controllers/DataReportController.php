<?php

namespace App\Http\Controllers;

use App\Exports\DataEnergiListrikExport;
use App\Exports\OutputDataSensorExport;
use App\Models\SensorValue;
use Illuminate\Http\Request;
use DataTables;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class DataReportController extends Controller
{
    public function listAllDataSensor(Request $request)
    {
        if ($request->ajax()) {
            $startDate = $request->input('start_date');
            $endDate = $request->input('end_date');

            $data = SensorValue::query()->orderBy('created_at', 'desc');

            if ($startDate && $endDate) {
                $data->whereBetween('created_at', [$startDate, $endDate]);
            }

            return Datatables::of($data)
                ->addIndexColumn()
                ->editColumn('created_at', function ($row) {
                    return $row->created_at->translatedFormat('d F Y H:i:s');
                })
                ->make(true);
        }
    }


    public function allReportPage()
    {
        return view('report.all_data');
    }

    public function energiReportPage()
    {
        return view('report.energi_data');
    }


    //EXPORT DATA ALL SENSOR
    public function exportXlxsAllData(Request $request)
    {
        $validate = $request->validate([
            'from_date' => 'nullable|date',
            'to_date' => 'nullable|date|after_or_equal:from_date',
        ]);

        $fromDateData = $request->input('from_date');
        $toDateData = $request->input('to_date');
        $filename = "data_sensor_" . uniqid() . ".xlsx";

        return Excel::download(new OutputDataSensorExport($fromDateData, $toDateData), $filename, \Maatwebsite\Excel\Excel::XLSX);
    }

    public function exportCsvAllData(Request $request)
    {
        $validate = $request->validate([
            'from_date' => 'nullable|date',
            'to_date' => 'nullable|date|after_or_equal:from_date',
        ]);

        $fromDateData = $request->input('from_date');
        $toDateData = $request->input('to_date');
        $filename = "data_sensor_" . uniqid() . ".csv";

        return Excel::download(new OutputDataSensorExport($fromDateData, $toDateData), $filename, \Maatwebsite\Excel\Excel::CSV);
    }

    public function exportPdfAllData(Request $request)
    {
        $validate = $request->validate([
            'from_date' => 'nullable|date',
            'to_date' => 'nullable|date|after_or_equal:from_date',
        ]);

        $from = $request->from_date ? date('Y-m-d', strtotime($request->from_date)) : null;
        $to = $request->to_date ? date('Y-m-d', strtotime($request->to_date)) : null;

        $datas = SensorValue::query()
            ->when($from && $to, function ($query) use ($from, $to) {
                return $query->whereDate('created_at', '>=', $from)
                    ->whereDate('created_at', '<=', $to);
            })
            ->get();

        $pdf = Pdf::loadView('report.pdf_all_sensor_data', [
            'datas' => $datas,
            'from_date' => $request->from_date ?? $datas->first()->created_at,
            'to_date' => $request->to_date ?? $datas->last()->created_at,

        ]);

        return $pdf->stream();
    }

}
