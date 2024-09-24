<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SampleTestingReport extends Model
{
    use HasFactory;
    protected $table = 'sample_testing_reports';
    // protected $guarded = [];
    protected $fillable = [
        'summary_after',
        'schedule_of_test',
        'est_of_completion_date',
        'report_no',
        'result_test',
        'remark_test',
        'inspector',
        'date',
        'user_id',
        'sample_testing_requisition_id',
    ];

    // Relasi to table SampleTestingRequisition
    public function sampleRequisition()
    {
        return $this->belongsTo(SampleTestingRequisition::class);
    }
    // Mendapatkan user dari form pertama(SampleTestingRequisition)
    public function user()
    {
        return $this->sampleRequisition->user;
    }
    // Relasti ke table Approvals
    public function approval()
    {
        return $this->hasOne(Approval::class);
    }
    // Relasi ke user (pengguna yang mengisi form sample report)
    public function user_report()
    {
        return $this->belongsTo(User::class);
    }

}
