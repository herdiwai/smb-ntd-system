<?php

namespace App\Imports;

use App\Models\EOCSystem;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class EOCSystemImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new EOCSystem([
            'EmployeeID'    => $row['employeeid'],
            'EmployeeName'   => $row['employeename'],
            'Position' => $row['position'],
            'JoinDate' => $row['joindate'],
            'ContractType' => $row['contracttype'],
            'ContractStart' => $row['contractstart'],
            // 'ContractEnd' => $row['contractend'],
            'ContractFinish' => $row['contractfinish'],
            'CurrentLeaveBalance' => $row['currentleavebalance'],
            'Absent' => $row['absent'],
            'Sick' => $row['sick'],
            // 'Performance' => $row['performance'],
            // 'Remarks' => $row['remarks'],
        ]);
    }
}
