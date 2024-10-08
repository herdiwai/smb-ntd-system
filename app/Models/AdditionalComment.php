<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdditionalComment extends Model
{
    use HasFactory;

    protected $fillable = ['review_approval_id', 'comment'];

    // Relasi ke ReviewApproval
    public function reviewApproval()
    {
        return $this->belongsTo(ReviewApproval::class);
    }
}
