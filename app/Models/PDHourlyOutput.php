<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PDHourlyOutput extends Model
{
    use HasFactory;

    protected $table = 'p_d_hourly_outputs';
    // protected $fillable = ['']
    protected $guarded = [];

    public function processmodels()
    {
        return $this->hasMany(PDHourlyOutput::class);
    }

    // protected $fillable = [
    //     'process',
    //     'model',
    //     'lot',
    //     'shift',
    //     'line',
    //     'time',
    //     'date',
    //     'target',
    //     'output',
    //     'accm',
    //     'name',
    //     'deskription'
    // ];
}