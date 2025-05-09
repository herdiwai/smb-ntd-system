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
        'result_test',
        'remark_test',
        'inspector',
        'date',
        'user_id',
        'sample_testing_requisition_id',
        'status_approvals_id',
        'report_no',
    ];

    // Relasi to table SampleTestingRequisition
    public function sampleRequisition()
    {
        return $this->belongsTo(SampleTestingRequisition::class,'id','sample_testing_reports_id');
    }
    // Mendapatkan user dari form pertama(SampleTestingRequisition)
    public function user()
    {
        return $this->sampleRequisition->user;
    }
    // Relasti ke table Approvals
    public function approval()
    {
        return $this->hasOne(Approval::class,'id','sample_testing_reports');
    }
    public function approvalStatus()
    {
        return $this->hasOne(Approval::class,'id','approval_id');
    }
    // Relasi ke user (pengguna yang mengisi form sample report)
    public function user_report()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    public function statusApprovals()
    {
        return $this->hasOne(StatusApprovals::class,'id','status_approvals_id');
    }

}
