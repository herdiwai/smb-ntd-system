<?php

namespace App\Exports;

use App\Models\Mrrequest;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\Style;
use PhpOffice\PhpSpreadsheet\Style\Fill; // Untuk pengisian warna
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class MrrequestExport implements FromCollection, WithHeadings, WithMapping, WithStyles, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */

    protected $from_date;
    protected $to_date;
    protected $model_id;
    protected $lot_id;
    protected $line_id;
    protected $shift_id;
    protected $status_mrr;

    public function __construct($from_date, $to_date, $model_id, $lot_id, $line_id, $shift_id, $status_mrr)
    {
        $this->from_date = $from_date;      
        $this->to_date = $to_date;      
        $this->model_id = $model_id;      
        $this->lot_id = $lot_id;      
        $this->line_id = $line_id;      
        $this->shift_id = $shift_id;      
        $this->status_mrr = $status_mrr;      
    }

    public function collection()
    {
        $query = Mrrequest::with('modelBrewer', 'lot', 'process', 'shift', 'line', 'equipmentNo', 'statusApprovals');
        // Filter department based on user's email
        if (Auth::check()) {
            $email = Auth::user()->email;
            if ($email === 'btm-mt@gmail.com') {
                $query->where('To_department', 'PIE(MT)');
            } elseif ($email === 'btm-ntd@gmail.com') {
                $query->where('To_department', 'PIE(NTD)');
            }
        }
        // Apply other filters
        $query->when($this->model_id, fn($q) => $q->where('model_id', $this->model_id))
              ->when($this->lot_id, fn($q) => $q->where('lot_id', $this->lot_id))
              ->when($this->line_id, fn($q) => $q->where('line_id', $this->line_id))
              ->when($this->shift_id, fn($q) => $q->where('shift_id', $this->shift_id))
              ->when($this->status_mrr, fn($q) => $q->where('status_mrr', $this->status_mrr))
              ->when($this->from_date && $this->to_date, fn($q) => $q->whereBetween('Date_pd', [$this->from_date, $this->to_date]));
    
        return $query->get();
    }

    public function headings(): array
    {
        return [
            'DATE',
            'REQUEST (DEPT)',
            'NAME',
            'TO DEPARTMENT',
            'Process',
            'EQUIP NO',
            'MODEL',
            'SHIFT',
            'LOT',
            'LINE',
            'REPORT TIME',
            'SIGN (SPV)',
            'DESCRIPTION',
            'ISSUE',
            'ROOT CAUSE',
            'ACTION',
            'RESPONSE TIME',
            'REPAIR START TIME',
            'REPAIR END TIME',
            'REPAIR BY',
            'QC START TIME',
            'QC END TIME',
            'QC SIGN',
            'DATE/TIME',
            'PD SIGN',
            'DATE/TIME',
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

    public function map($Mrrequest): array
    {
        return [
            $Mrrequest->Date_pd,
            $Mrrequest->Request_dept,
            $Mrrequest->Name,
            $Mrrequest->To_department,
            $Mrrequest->equipmentNo->Equipment_Name ?? 'N/A',
            $Mrrequest->equipmentNo->Equipment_Number ?? 'N/A',
            $Mrrequest->modelBrewer->model ?? 'N/A',
            $Mrrequest->shift->shift ?? 'N/A',
            $Mrrequest->lot->lot ?? 'N/A',
            $Mrrequest->line->line ?? 'N/A',
            $Mrrequest->Report_time ?? 'N/A',
            $Mrrequest->Note_spv_pd ?? 'N/A',
            $Mrrequest->Description ?? 'N/A',
            $Mrrequest->Issue ?? 'N/A',
            $Mrrequest->Root_cause ?? 'N/A',
            $Mrrequest->Action ?? 'N/A',
            $Mrrequest->Response_time ?? 'N/A',
            $Mrrequest->Repair_start_time ?? 'N/A',
            $Mrrequest->Repair_end_time ?? 'N/A',
            $Mrrequest->Repair_by ?? 'N/A',
            $Mrrequest->Qc_start_time ?? 'N/A',
            $Mrrequest->Qc_end_time ?? 'N/A',
            $Mrrequest->Qc_name_sign ?? 'N/A',
            $Mrrequest->Date_qc ?? 'N/A',
            $Mrrequest->Name ?? 'N/A',
            $Mrrequest->Date_pd ?? 'N/A',
        ];
    }


}
