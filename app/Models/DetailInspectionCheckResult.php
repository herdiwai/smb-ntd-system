<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailInspectionCheckResult extends Model
{
    use HasFactory;
    protected $table = 'subassy_detail_inspection_check_result';
    protected $fillable = [
        'inspection_check_id',
        'inspection_item',
        'defect_grade',
        'sample_no_pcs',
        'time',
        'result',
        'remark_ddca',
        'material_name',
        'test_result',
        'decision',
       
    ];

    public function inspectionCheckResult()
    {
        return $this->belongsTo(InspectionCheckResult::class, 'inspection_check_id');
    }

    public function inspectionItem()
    {
        return $this->belongsTo(InspectionItem::class, 'inspection_item', 'id');
    }

    
}
