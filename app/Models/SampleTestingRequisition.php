<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SampleTestingRequisition extends Model
{
    use HasFactory;
    protected $table = 'sample_testing_requisitions';
    // protected $guarded = [];
    protected $fillable = [
            'user_id',
            'incomming_number',
            'shift_id',
            'process_id',
            'date',
            'do_no',
            'series',
            'co_no',
            'no_of_sample',
            'mfg_sample_date',
            'sample_subtmitted_date',
            'tracebility_datecode',
            'completion_date',
            'test_purpose',
            'pilot_project',
            'check_by',
            'model_id',
            'processes_id',
            'lot_id', 
            'testing_purpose', 
            'status',
            'testpurpose',
            'summary',
            'status_approvals_id',
            'status_approvals_id_spv',
            'sample_testing_reports_id',
            'notes_spv',
    ];

    public function modelBrewer()
    {
        return $this->hasOne(ModelBrewer::class,'id','model_id');
    }
    public function lot()
    {
        return $this->hasOne(Lot::class,'id','lot_id');
    }
    public function process()
    {
        return $this->hasOne(Process::class,'id','processes_id');
    }
    public function shift()
    {
        return $this->hasOne(Shift::class,'id','shift_id');
    }
    // Relasi to table SampleTestingReport
    public function sampleReport()
    {
        return $this->hasOne(SampleTestingReport::class,'sample_testing_requisition_id');
    }

    // Relasi ke user (satu form pertama diisi oleh satu user)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    // Relasi ke form kedua (satu form pertama bisa terhubung ke banyak form kedua)
    public function testingReport()
    {
        return $this->hasMany(SampleTestingReport::class);
    }
    public function statusApprovals()
    {
        return $this->hasOne(StatusApprovals::class,'id','status_approvals_id');
    }

}
