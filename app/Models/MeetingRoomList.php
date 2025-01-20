<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MeetingRoomList extends Model
{
    use HasFactory;
    protected $table = 'room_meetings';
    protected $fillable = [
        'Lot',
        'Room_no',
        'Location',
        'Usage'
    ];

    public function MeetingRoom()
    {
        return $this->belongsTo(MeetingRoom::class,'id');
    }
}
