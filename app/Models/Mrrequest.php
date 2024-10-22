<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mrrequest extends Model
{
    use HasFactory;
    protected $table = 'mrrequest';
    protected $fillable = [
        'Request_dept',
        'Name',
        'To_department',
        'Equipment_id',
        'Description',
        'model_id',
        'processes_id',
        'shift_id',
        'lot_id',
        'line_id',
        'user_id',
        'Date_pd',
        'Breakdown_time',
        'Report_time',
        'Status_approvals_id_spv_pd',
        'Note_spv_pd',
        'Judgement',
        'Issue',
        'Root_cause',
        'Action',
        'Repair_by',
        'Response_time',
        'Repair_start_time',
        'Repair_end_time',
        'Qc_start_time',
        'Qc_end_time',
        'Status_approvals_id_qc',
        'Note_qc',
        'Date_qc',
        'Status_approvals_id_spv_ntd',
        'Note_spv_ntd',
        'Date_spv_ntd',
        'Status_approvals_id_spv_mt',
        'Note_spv_mt',
        'Date_spv_mt',
        'Qc_name_sign',
        'status_mrr',
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
    public function line()
    {
        return $this->hasOne(Line::class,'id','line_id');
    }
    public function equipmentNo()
    {
        return $this->hasOne(EquipmentNo::class,'id','Equipment_id');
    }
}
