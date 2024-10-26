<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelBrewer extends Model
{
    use HasFactory;
    protected $table = 'models';
    protected $guarded = [];

    public function TestingRequisition()
    {
        return $this->belongsTo(SampleTestingRequisition::class,'id');
    }

    public function ProcessPatrol()
    {
        return $this->belongsTo(InspectionCheckResult::class,'id');
    }

    public function ProcessChangeNotice()
    {
        return $this->belongsTo(ECNotice::class,'id');
    }
}
