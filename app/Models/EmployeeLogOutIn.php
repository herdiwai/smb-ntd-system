<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeLogOutIn extends Model
{
    use HasFactory;

    protected $table = 'EmployeeLogsNew';
    protected $guarded = [];
}
