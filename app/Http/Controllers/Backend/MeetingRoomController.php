<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Shift;
use App\Models\Lot;
use App\Models\Line;
use App\Models\MeetingRoom;
use App\Models\MeetingRoomList;
use Illuminate\Support\Facades\Auth;

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
        $room_list = MeetingRoomList::all();
         // Mengambil semua inspeksi beserta item inspeksi terkait
        return view('backend.personel.meeting_room.add_meeting_reservation_form', compact('bookedrequest','shift','line','lot','room_list'));
    }

    public function StoreBookedMeetingRoom(Request $request) 
    {
        MeetingRoom::create([
            'user_id' => Auth::id(),
            'Name' => $request->Name,
            'Department' => $request->Department,
            'Description' => $request->Description,
            'Start_time' => $request->Start_time,
            'End_time' => $request->End_time,
            // 'Date_booking' => $request->Date_booking,
            'choose_meeting_room' => $request->choose_meeting_room,
            'Status_booking' => 50,
        ]);

        $notification = array(
            'message' => 'Booked Request Form Create Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('personel.meetingroomlist')->with($notification);
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
