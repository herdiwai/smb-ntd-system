<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkOrderRequest extends Model
{
    use HasFactory;
    protected $table = 'facility_work_order';
    protected $fillable = [
        'date',
        'reported_by',
        'request_by',
        'request_dept',
        'line',
        'lot',
        'shift',
        'location',
        'decription',
        'priority',
        'request_time',
        'assigned_technician',
        'complated_by_technician',
        'time_spent',
        'date_complated_technician',
        'sign_final',
        'name_spv',
        'time_accepted',
        'date_final',
        'status',
    ];

    public function lots()
    {
        return $this->hasOne(Lot::class,'id','lot');
    }

    public function shifts()
    {
        return $this->hasOne(Shift::class,'id','shift');
    }

    public function lines()
    {
        return $this->hasOne(Line::class,'id','line');
    }

    public function lot()
    {
        return $this->hasOne(Lot::class,'id','lot');
    }

    public function shift()
    {
        return $this->hasOne(Shift::class,'id','shift');
    }

    public function line()
    {
        return $this->hasOne(Line::class,'id','line');
    }
}
