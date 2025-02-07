<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MeetingRoom extends Model
{
    use HasFactory;
    protected $table = 'booking_meeting_room';
    protected $fillable = [
        'Booking_number_id',
        'Name',
        'Department',
        'Description',
        'Start_time',
        'End_time',
        'Date_booking',
        'Status_booking',
        'room_meeting_id',
        'user_id',
        'user_id_personel',
        'Note_personel',
        'choose_meeting_room',
        'facilities',
        'remarks_facilities',
        ];
    
    public function meetingroom()
    {
        return $this->hasMany(MeetingRoomList::class,'id','choose_meeting_room');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
}
