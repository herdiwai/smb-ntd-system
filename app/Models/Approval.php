<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Approval extends Model
{
    use HasFactory;
    protected $table = 'approvals';
    protected $fillable = [
        'sample_testing_reports',
        'manager_id',
        'approvals_status',
        'notes'
    ];
    // Relasi ke sample testing report
    public function sampleTestingReport()
    {
        return $this->belongsTo(SampleTestingReport::class,'id');
    }
    // Relasi ke user sebagai manager
    public function manager()
    {
        return $this->belongsTo(User::class);
    }

}
