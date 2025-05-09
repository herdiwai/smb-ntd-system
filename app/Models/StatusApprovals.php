<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusApprovals extends Model
{
    use HasFactory;
    protected $table = 'status_approvals';
    protected $guarded = [];

    public function TestingRequisition()
    {
        return $this->belongsTo(SampleTestingRequisition::class);
    }

    public function ProcessPatrol()
    {
        return $this->belongsTo(InspectionCheckResult::class);
    }
}
