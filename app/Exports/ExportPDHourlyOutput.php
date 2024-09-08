<?php

namespace App\Exports;

use App\Models\PDHourlyOutput;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ExportPDHourlyOutput implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */

    protected $process;
    protected $lot;
    protected $shift;
    protected $line;
    protected $model;
    protected $startDate;
    protected $endDate;

    public function __construct($process, $lot, $shift, $line, $model, $startDate, $endDate)
    {
        $this->process = $process;      
        $this->lot = $lot;      
        $this->shift = $shift;      
        $this->line = $line;      
        $this->model = $model;      
        $this->startDate = $startDate;      
        $this->endDate = $endDate;      
    }

    public function collection()
    {
        return PDHourlyOutput::when($this->process, function($query) {
            return $query->where('process', $this->process);
        })
        ->when($this->lot, function($query) {
            return $query->where('lot', $this->lot);
        })
        ->when($this->shift, function($query) {
            return $query->where('shift', $this->shift);
        })
        ->when($this->line, function($query) {
            return $query->where('line', $this->line);
        })
        ->when($this->model, function($query) {
            return $query->where('model', $this->model);
        })
        ->when($this->startDate, function($query) {
            return $query->whereDate('date', '>=', $this->startDate);
        })
        ->when($this->endDate, function($query) {
            return $query->whereDate('date', '<=', $this->endDate);
            // return PDHourlyOutput::select('date','process','model','lot','shift','line','time','target','output','accm','deskription','name')->get();
    })->get();
    }


    public function headings(): array
    {
        return [
            'DATE',
            'PROCESS',
            'MODEL',
            'LOT',
            'SHIFT',
            'LINE',
            'TIME',
            'TARGET',
            'OUTPUT',
            'ACCM',
            'DESKCRIPTION',
            'PIC',
        ];
    }

    public function map($PDHourlyOutput): array
    {
        return [
            $PDHourlyOutput->date,
            $PDHourlyOutput->process,
            $PDHourlyOutput->model,
            $PDHourlyOutput->lot,
            $PDHourlyOutput->shift,
            $PDHourlyOutput->line,
            $PDHourlyOutput->time,
            $PDHourlyOutput->target,
            $PDHourlyOutput->output,
            $PDHourlyOutput->accm,
            $PDHourlyOutput->deskription,
            $PDHourlyOutput->name,
        ];
    }
    
}
