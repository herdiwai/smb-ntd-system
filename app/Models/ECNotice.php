<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ECNotice extends Model
{
    use HasFactory;
    protected $table = 'prod_change_notice';
    protected $fillable = [
        'date',
        'model',
        'change_notice',
        'change_from_notice',
        'change_to_notice',
        'line',
        'shift',
        'lot',
        'so_no',
        'co_no',
        'week',
        'implement_datecode',
        'change_from_datecode',
        'change_to_datecode',
        'con_no',
        'sah_key',
        'con_name',
        'sn_awal',
        'sn_rndm',
        'pic',
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
