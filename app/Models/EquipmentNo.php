<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EquipmentNo extends Model
{
    use HasFactory;
    protected $table = 'equipment';
    protected $guarded = [];

    public function Mrrequest()
    {
        return $this->belongsTo(Mrrequest::class,'id');
    }
}
