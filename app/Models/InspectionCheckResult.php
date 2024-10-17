<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InspectionCheckResult extends Model
{
    use HasFactory;
    protected $table = 'subassy_inspection_check_result';
    protected $fillable = [
        'date', 
        'model', 
        'product_name', 
        'production_unit', 
        'frequency_of_inspection', 
        'inspection_standard', 
        'line', 
        'shift', 
        'lot', 
        'inspected_by', 
        'reviewed_by',
        'status'
    ];

    public function modelBrewer()
    {
        return $this->hasOne(ModelBrewer::class,'id','model');
    }

    public function lots()
    {
        return $this->hasOne(Lot::class,'id','lot');
    }

    public function shifts()
    {
        return $this->hasOne(Shift::class,'id','shift');
    }

    public function detailInspectionCheckResult()
    {
        return $this->hasMany(DetailInspectionCheckResult::class, 'inspection_check_id');
    }

   
}
   

