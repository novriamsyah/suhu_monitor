<?php

namespace App\Exports;

use App\Models\SensorValue;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Carbon\Carbon;

class DataEnergiListrikExport implements FromQuery,WithHeadings,WithMapping
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
            'Energi Listrik' => $row->energi,
            'Biaya' => $row->biaya,
            'Created At' => $createdAt,
        ];
    }
}
