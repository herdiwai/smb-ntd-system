<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{
    use HasFactory;
    protected $table = 'shifts';
    protected $guarded = [];

    public function TestingRequisition()
    {
        return $this->belongsTo(SampleTestingRequisition::class);
    }

    public function ProcessPatrol()
    {
        return $this->belongsTo(InspectionCheckResult::class,'id');
    }

    public function ProcessChangeNotice()
    {
        return $this->belongsTo(ECNotice::class,'id');
    }

    public function WorkOrderRecord()
    {
        return $this->belongsTo(WorkOrderRequest::class,'id');
    }
}
