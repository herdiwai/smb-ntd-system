<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use App\Models\WorkOrderRequest;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\Style;
use PhpOffice\PhpSpreadsheet\Style\Fill; // Untuk pengisian warna
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class WorkOrderExport implements FromCollection, WithHeadings, WithMapping, WithStyles, ShouldAutoSize

{
    /**
    * @return \Illuminate\Support\Collection
    */

    protected $from_date;
    protected $to_date;
    protected $lot_id;
    protected $line_id;
    protected $shift_id;
    protected $status_wo;
    protected $status_priority;

    public function __construct($from_date, $to_date, $lot_id, $line_id, $shift_id, $status_wo, $status_priority )
    {
        $this->from_date = $from_date;      
        $this->to_date = $to_date;           
        $this->lot_id = $lot_id;      
        $this->line_id = $line_id;      
        $this->shift_id = $shift_id;      
        $this->status_wo = $status_wo; 
        $this->status_priority = $status_priority;     
    }


    public function collection()
    {
        $query = WorkOrderRequest::with('lot', 'shift', 'line')
            ->when($this->lot_id && $this->lot_id !== '-', function($query) {
                return $query->where('lot', $this->lot_id);
            })
            ->when($this->line_id && $this->line_id !== '-', function($query) {
                return $query->where('line', $this->line_id);
            })
            ->when($this->shift_id && $this->shift_id !== '-', function($query) {
                return $query->where('shift', $this->shift_id);
            })
            ->when($this->status_wo, function($query) {
                return $query->where('status', $this->status_wo);
            })
            ->when($this->status_priority, function($query) {
                return $query->where('priority', $this->status_priority);
            })
            ->when($this->from_date, function($query) {
                return $query->whereDate('date', '>=', $this->from_date);
            })
            ->when($this->to_date, function($query) {
                return $query->whereDate('date', '<=', $this->to_date);
            });
    
        // Uncomment for debugging:
        // dd($query->toSql(), $query->getBindings());
    
        return $query->get();
    }
    

    public function headings(): array
    {
        return [
            'DATE',
            'REPORTED BY',
            'REQUESTED BY',
            'REQUEST (DEPT)',
            'LINE',
            'LOT',
            'SHIFT',
            'LOCATION',
            'DESCRIPTION',
            'PRIORITY',
            'REQUEST TIME',
            'ASSIGNED TO',
            'TIME SPENT (HOUR/MIN)',
            'COMPLETED BY',
            'DATE COMPLETED',
            'FINAL ACCEPTED',
            'FINAL TIME',
            'FINAL DATE ',
    
            
        ];
    }

    public function styles(Worksheet $sheet)
    {
        // Mengatur warna dan gaya untuk header (baris pertama)
        return [
            // Baris pertama untuk header
            1 => [
                'font' => [
                    'bold' => true,
                    'color' => ['rgb' => 'FFFFFF'], // Warna teks putih
                ],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => '4F81BD'], // Warna latar belakang biru
                ],
            ],
        ];
    }

    public function map($WorkOrderRequest): array
    {
        return [
            $WorkOrderRequest->date,
            $WorkOrderRequest->reported_by,
            $WorkOrderRequest->request_by,
            $WorkOrderRequest->request_dept,
            $WorkOrderRequest->lines->line ?? 'N/A',
            $WorkOrderRequest->lots->lot ?? 'N/A',
            $WorkOrderRequest->shifts->shift ?? 'N/A',
            $WorkOrderRequest->location ?? 'N/A',
            $WorkOrderRequest->decription ?? 'N/A',
            $WorkOrderRequest->priority ?? 'N/A',
            $WorkOrderRequest->request_time ?? 'N/A',
            $WorkOrderRequest->assigned_technician ?? 'N/A', 
            $WorkOrderRequest->time_spent ?? 'N/A',
            $WorkOrderRequest->complated_by_technician ?? 'N/A',
            $WorkOrderRequest->date_complated_technician ?? 'N/A',
            $WorkOrderRequest->name_spv ?? 'N/A',
            $WorkOrderRequest->time_accepted ?? 'N/A',
            $WorkOrderRequest->date_final ?? 'N/A',
           
        ];
    }



}
