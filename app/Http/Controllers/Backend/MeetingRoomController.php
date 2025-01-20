<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Shift;
use App\Models\Lot;
use App\Models\Line;
use App\Models\MeetingRoom;

class MeetingRoomController extends Controller
{
    public function MeetingRoomList()
    {
        $shift = Shift::all();
        $lot = Lot::all();
        $line = Line::all();
        $bookedrequest =  MeetingRoom::latest()->paginate(10); 
         // Mengambil semua inspeksi beserta item inspeksi terkait
        return view('backend.personel.meeting_room.meeting_room_reservation_report', compact('bookedrequest','shift','line','lot'));
    }
    
    public function AddBookedMeetingRoom()
    {
        $shift = Shift::all();
        $lot = Lot::all();
        $line = Line::all();
        $bookedrequest =  MeetingRoom::latest()->paginate(10); 
         // Mengambil semua inspeksi beserta item inspeksi terkait
        return view('backend.personel.meeting_room.meeting_reservation_form', compact('bookedrequest','shift','line','lot'));
    }

    public function AddDetailApprove()
    {
        $shift = Shift::all();
        $lot = Lot::all();
        $line = Line::all();
        $bookedrequest =  MeetingRoom::latest()->paginate(10); 
         // Mengambil semua inspeksi beserta item inspeksi terkait
        return view('backend.personel.meeting_room.detail_approve_form', compact('bookedrequest','shift','line','lot'));
    }

    

}
