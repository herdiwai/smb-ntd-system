<?php

namespace App\Exports;

use App\Models\SampleTestingRequisition;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class SampleTesting implements FromCollection, WithHeadings, WithMapping, WithStyles, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */

    protected $from_date;
    protected $to_date;
    protected $model_id;
    protected $series;
    protected $processes_id;
    protected $lot_id;
    protected $shift_id;
    protected $do_no;
    protected $status_approvals_id;

    public function __construct($from_date, $to_date, $model_id, $series, $processes_id, $lot_id, $shift_id, $do_no, $status_approvals_id)
    {
        $this->from_date = $from_date;      
        $this->to_date = $to_date;      
        $this->model_id = $model_id;      
        $this->series = $series;      
        $this->processes_id = $processes_id;      
        $this->lot_id = $lot_id;
        $this->shift_id = $shift_id;   
        $this->do_no = $do_no;   
        $this->status_approvals_id = $status_approvals_id;      
    }

    public function collection()
    {

        $filters = [
            'model_id' => $this->model_id,
            'lot_id' => $this->lot_id,
            'series' => $this->series,
            'shift_id' => $this->shift_id,
            'do_no' => $this->do_no,
            'status_approvals_id' => $this->status_approvals_id,
        ];
    
        return SampleTestingRequisition::with('sampleReport', 'statusApprovals', 'modelBrewer', 'lot', 'process')
            ->when($filters, function ($query) use ($filters) {
                foreach ($filters as $column => $value) {
                    if ($value !== null) {
                        $query->where($column, $value);
                    }
                }
            })
            ->when($this->from_date, function ($query) {
                return $query->whereDate('sample_subtmitted_date', '>=', $this->from_date);
            })
            ->when($this->to_date, function ($query) {
                return $query->whereDate('sample_subtmitted_date', '<=', $this->to_date);
            })
            ->get();

        // return SampleTestingRequisition::with('sampleReport','statusApprovals','modelBrewer','lot','process')
        //         ->when($this->model_id, function($query) {
        //             return $query->where('model_id', $this->model_id);
        //         })
        //         ->when($this->lot_id, function($query) {
        //             return $query->where('lot_id', $this->lot_id);
        //         })
        //         ->when($this->series, function($query) {
        //             return $query->where('series', $this->series);
        //         })
        //         ->when($this->shift_id, function($query) {
        //             return $query->where('shift_id', $this->shift_id);
        //         })
        //         ->when($this->do_no, function($query) {
        //             return $query->where('do_no', $this->do_no);
        //         })
        //         ->when($this->status_approvals_id, function($query) {
        //             return $query->where('status_approvals_id', $this->status_approvals_id);
        //         })
        //         ->when($this->from_date, function($query) {
        //             return $query->whereDate('sample_subtmitted_date', '>=', $this->from_date);
        //         })
        //         ->when($this->to_date, function($query) {
        //             return $query->whereDate('sample_subtmitted_date', '<=', $this->to_date);
        //         })->get();
    }

    public function headings(): array
    {
        return [
            'SAMPLE SUBMITTED DATE',
            'DOC NO',
            'SERIES',
            'NO OF SAMPLE',
            'TEST PURPOSE',
            'OTHER PURPOSE/REMARK',
            'SUMMARY BEFORE',
            'SHIFT',
            'CHECK BY',
            'QE REVIEW',
            'RECEIVED SAMPLE DATE',
            'SUMMARY AFTER',
            'TEST RESULT',
            'SCHDULE OF TEST',
            'EST OF COMPLETION DATE',
            'INSPECTOR NAME',
            'DATE',
            'QE REVIEW',
            'DATE',
            'APPROVED',
            'DATE',
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

    public function map($SampleTesting): array
    {
        $processName = $SampleTesting->process->process ?? 'N/A';
        $lot = $SampleTesting->lot->lot ?? 'N/A';
        $model = $SampleTesting->modelBrewer->model ?? 'N/A';
        $date = $SampleTesting->sample_subtmitted_date  ?? 'N/A';
        $doNo = $SampleTesting->do_no  ?? 'N/A';
        $incommingNumb = $SampleTesting->incomming_number  ?? 'N/A';

        // Menggabungkan nilai dari kolom yang berbeda
        $combinedValues = sprintf(
        '%s/%s/%s/%s/%s/%s', 
        $processName, 
        $lot, 
        $model,
        $date,
        $doNo,
        $incommingNumb,
    );


        return [
            $SampleTesting->sample_subtmitted_date ?? 'N/A',
            $combinedValues ?? 'N/A',
            $SampleTesting->series ?? 'N/A',
            $SampleTesting->no_of_sample ?? 'N/A',
            $SampleTesting->testpurpose ?? 'N/A',
            $SampleTesting->test_purpose ?? 'N/A',
            $SampleTesting->summary ?? 'N/A',
            $SampleTesting->shift->shift ?? 'N/A',
            $SampleTesting->check_by ?? 'N/A',
            'Shelma',
            $SampleTesting->sample_subtmitted_date ?? 'N/A',
            $SampleTesting->sampleReport->summary_after ?? 'N/A',
            $SampleTesting->sampleReport->result_test ?? 'N/A',
            $SampleTesting->sampleReport->schedule_of_test ?? 'N/A',
            $SampleTesting->sampleReport->est_of_completion_date ?? 'N/A',
            $SampleTesting->sampleReport->inspector ?? 'N/A',
            $SampleTesting->sampleReport->date ?? 'N/A',
            'Nel Hendri',
            $SampleTesting->sample_subtmitted_date ?? 'N/A',
            'Andri',
            $SampleTesting->sample_subtmitted_date ?? 'N/A',
        ];
    }

}
