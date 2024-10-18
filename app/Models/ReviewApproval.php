<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReviewApproval extends Model
{
    use HasFactory;

    protected $fillable = ['status', 'notes'];

    // Relasi ke komentar tambahan
    public function additionalComments()
    {
        return $this->hasMany(AdditionalComment::class);
    }
}
