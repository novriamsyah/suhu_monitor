<?php

namespace App\Exports;

use App\Models\SensorValue;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Carbon\Carbon;

class OutputDataSensorExport implements FromQuery,WithHeadings,WithMapping
{
    use Exportable;


    protected $fromDate, $toDate;

    public function __construct($fromDate, $toDate)
    {
        $this->fromDate = $fromDate;
        $this->toDate = $toDate;
    }

    public function query()
    {
        $from = date('Y-m-d', strtotime($this->fromDate));
        $to = date('Y-m-d', strtotime($this->toDate));

        return SensorValue::query()
                ->when(!blank($this->fromDate) && !blank($this->toDate), function ($query) use ($from, $to) {
                    return $query
                        ->whereDate('created_at', '>=', $from)
                        ->whereDate('created_at', '<=', $to);
                });
    }

    public function headings(): array
    {
        return [
            'No.',
            'Tegangan',
            'Arus',
            'Daya',
            // 'Daya Reaktif',
            // 'Daya Semu',
            // 'Frekuensi',
            'Energi Listrik',
            'Biaya',
            'Waktu'
        ];
    }

    public function map($row): array
    {
        $createdAt = Carbon::parse($row->created_at)->translatedFormat('d F Y H:i:s');
        
        unset($row->updated_at); 
        
        return [
            'No.' => $row->id,
            'Tegangan' => $row->tegangan . ' V',
            'Arus' => $row->arus . ' A',
            'Daya' => $row->dy_aktif . ' W',
            // 'Daya Reaktif' => $row->dy_reaktif,
            // 'Daya Semu' => $row->dy_semu,
            // 'Frekuensi' => $row->frekuensi,
            'Energi Listrik' => $row->energi . ' kWh',
            'Biaya' => 'Rp' . $row->biaya,
            'Created At' => $createdAt,
        ];
    }
}
