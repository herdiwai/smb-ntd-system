<?php

namespace App\Exports;

use App\Models\EOCSystem;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Illuminate\Http\Request;

class EOCSystemExport implements FromCollection, WithHeadings, WithMapping, WithStyles, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $status;

    public function __construct($status)
    {
        $this->status = $status;
    }


    public function collection()
    {
        $query = EOCSystem::with('categoryContract');

        if ($this->status === 'Extend') {
            $query->whereNotNull('ExtendOptions');
        } elseif ($this->status === 'Not Extend') {
            // Hanya data yang tidak memiliki ExtendOptions dan bukan Permanent, Resign, Absconded, atau End Of Contract
            $query->whereNull('ExtendOptions')
                 ->whereHas('categoryContract', function($query) {
                     $query->whereNotIn('ContractName', ['Permanent', 'Resign', 'Absconded', 'End Of Contract']);
                 });
        } elseif ($this->status === 'Permanent') {
            $query->whereHas('categoryContract', function($q) {
                $q->where('ContractName', 'Permanent');
            });
        } elseif ($this->status === 'Resign') {
            $query->whereHas('categoryContract', function($q) {
                $q->where('ContractName', 'Resign');
            });
        }
        return $query->get();
    }

    public function headings(): array
    {
        return [
            'Employee ID', 'Employee Name', 'Position', 'Join Date', 'Contract Type',
            'Contract Start', 'Contract End', 'Contract Finish', 'Current Leave Balance',
            'Absent', 'Sick', 'Extend Duration', 'Date Submit Contract', 'Performance', 'Remarks'
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

    public function map($row): array
    {
        return [
            $row->EmployeeID,
            $row->EmployeeName,
            $row->Position,
            $row->JoinDate,
            $row->ContractType,
            $row->ContractStart,
            $row->ContractEnd,
            $row->ContractFinish,
            $row->CurrentLeaveBalance,
            $row->Absent,
            $row->Sick,
            $row->ExtendOptions ?? '-',
            $row->DateSubmitContract ?? '-',
            $row->Performance ?? '-',
            $row->Remarks ?? '-',
        ];
    }

}
