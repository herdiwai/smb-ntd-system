<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InspectionItem extends Model
{
    use HasFactory;
    protected $table = 'subassy_inspection_items';
    protected $fillable = [
        'inspection_item',
    ];
    protected $guarded = [];

    public function detailInspectionCheckResult()
    {
        return $this->hasMany(DetailInspectionCheckResult::class, 'inspection_item');
    }


    
}
