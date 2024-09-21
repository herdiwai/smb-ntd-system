<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProcessModel extends Model
{
    use HasFactory;

    protected $table = 'process_model';
    protected $guarded = [];
}
