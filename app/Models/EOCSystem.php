<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Support\Facades\Date;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class EOCSystem extends Model
{
    use HasFactory;
    protected $table = 'eoc_system';
    // protected $guarded = [];
    protected $fillable = 
    [
        'EmployeeID', 
        'EmployeeName', 
        'Position', 
        'JoinDate', 
        'ContractType', 
        'ContractStart', 
        'ContractEnd', 
        'ContractFinish', 
        'CurrentLeaveBalance',
        'Absent', 
        'Sick', 
        'Performance',
        'Remarks',
        'CategoryContract'
    ];

    public function categoryContract()
    {
        return $this->hasOne(CategoryContract::class,'id','category_contract_id');
    }

    public function setJoinDateAttribute($value)
    {
        $this->attributes['JoinDate'] = is_numeric($value) 
            ? Date::excelToDateTimeObject($value)->format('d-m-Y') 
            : $value;
    }
    public function setContractStartAttribute($value)
    {
        $this->attributes['ContractStart'] = is_numeric($value) 
            ? Date::excelToDateTimeObject($value)->format('d-m-Y') 
            : $value;
    }
    public function setContractEndAttribute($value)
    {
        $this->attributes['ContractEnd'] = is_numeric($value) 
            ? Date::excelToDateTimeObject($value)->format('d-m-Y') 
            : $value;
    }
    public function setContractFinishAttribute($value)
    {
        $this->attributes['ContractFinish'] = is_numeric($value) 
            ? Date::excelToDateTimeObject($value)->format('d-m-Y') 
            : $value;
    }
}
