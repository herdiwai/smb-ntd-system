<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\MeetingRoom;
use App\Models\MeetingRoomList;
use Carbon\Carbon;
use Illuminate\Http\Request;

class MeetingRoomListController extends Controller
{
    public function index()
    {
        // $currentDateTime = Carbon::now();

        $roomlist =  MeetingRoomList::with('Meetingroom')->get(); 

        // Ambil data semua ruangan beserta status bookingnya
        // $rooms = MeetingRoomList::with(['Meetingroom' => function ($query) use ($currentDateTime) {
        //     $query->where('End_time', '>=', $currentDateTime) // Booking yang belum selesai
        //         ->orderBy('Start_time', 'asc'); // Urutkan berdasarkan waktu mulai
        // }])->get();

        return view('backend.personel.room_list.room_list', compact('roomlist'));
    }

    public function addRoomMeeting()
    {
        $room_list = MeetingRoomList::all();
     
        return view('backend.personel.room_list.add_room_meeting', compact('room_list'));
    }

    public function storeMeetingRoom(Request $request)
    {
        MeetingRoomList::create([
            'Lot' => $request->Lot,
            'Room_no' => $request->Room_no,
            'Location' => $request->Location,
            'Usage' => $request->Usage
        ]);

        $notification = array(
            'message' => 'Meeting Room Create Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('room.list')->with($notification);
    }

}
