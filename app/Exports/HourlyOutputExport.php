<?php

namespace App\Exports;

use App\Models\PDHourlyOutput;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class HourlyOutputExport implements FromCollection, WithHeadings, WithMapping
{
    protected $startDate;
    protected $endDate;
    protected $process;
    protected $lot;
    protected $shift;
    protected $line;
    protected $model;

    
    public function __construct($process, $lot, $shift, $line, $model, $startDate, $endDate)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->process = $process;
        $this->lot = $lot;
        $this->shift = $shift;
        $this->line = $line;
        $this->model = $model;
    }

    public function collection()
    {
        return PDHourlyOutput::when($this->lot, function($query) {
            return $query->where('lot', $this->lot);
        })
        ->when($this->shift, function($query) {
            return $query->where('shift', $this->shift);
        })
        ->when($this->process, function($query) {
            return $query->where('process', $this->process);
        })
        ->when($this->line, function($query) {
            return $query->where('line', $this->line);
        })
        ->when($this->model, function($query) {
            return $query->where('model', $this->model);
        })
        ->when($this->startDate, function($query) {
            return $query->whereDate('created_at', '>=', $this->startDate);
        })
        ->when($this->endDate, function($query) {
            return $query->whereDate('created_at', '<=', $this->endDate);
        })
        ->get();

        // return PDHourlyOutput::whereBetween('created_at', [$this->startDate, $this->endDate])
        //                  ->where('process', $this->process)
        //                  ->where('lot', $this->lot)
        //                  ->where('shift', $this->shift)
        //                  ->where('line', $this->line)
        //                  ->where('model', $this->model)
        //                  ->get();
    }

    public function headings(): array
    {
        return [
            'Date',
            'Process',
            'Model',
            'Lot',
            'Shift',
            'Line',
            'Time',
            'Target',
            'Output',
            'Accm',
            'Deskcription',
            'PIC',
            
            //'Created At',
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
