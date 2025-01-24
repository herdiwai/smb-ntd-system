<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\MeetingRoom;
use App\Models\MeetingRoomList;
use Carbon\Carbon;
use Illuminate\Http\Request;

class MeetingRoomListController extends Controller
{
    public function index(Request $request)
    {
        // $currentDateTime = Carbon::now();
        $room_id = $request->id;
        $roomlist =  MeetingRoomList::with('Meetingroom')->get(); 

        // Ambil data semua ruangan beserta status bookingnya
        // $rooms = MeetingRoomList::with(['Meetingroom' => function ($query) use ($currentDateTime) {
        //     $query->where('End_time', '>=', $currentDateTime) // Booking yang belum selesai
        //         ->orderBy('Start_time', 'asc'); // Urutkan berdasarkan waktu mulai
        // }])->get();

        return view('backend.personel.room_list.room_list', compact('roomlist','room_id'));
    }

    public function addRoomMeeting()
    {
        $room_list = MeetingRoomList::all();
     
        return view('backend.personel.room_list.add_room_meeting', compact('room_list'));
    }

    public function storeMeetingRoom(Request $request)
    {

        // $room = MeetingRoomList::create($request->all());
        // return response()->json($room);

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

    public function editRoomMeeting($id)
    {
        $room_id = MeetingRoomList::findOrFail($id);
        $room_list = MeetingRoomList::all();
        // dd($room_list);
        return view('backend.personel.room_list.edit_room_meeting', compact('room_list','room_id'));
    }

    public function updateRoomMeeting(Request $request)
    {
        $room_id = $request->id;
        MeetingRoomList::findOrFail($room_id)->update([
            'Lot' => $request->Lot,
            'Room_no' => $request->Room_no,
            'Location' => $request->Location,
            'Usage' => $request->Usage,
        ]);

        $notification = array(
            'message' => 'Update Meeting Room Successfully',
            'alert-type' => 'info'
        );
        return redirect()->route('room.list')->with($notification);
    }

    public function deleteMeetingRoom($id) 
    {
        // Cari data berdasarkan ID yang ingin dihapus
        $room_list = MeetingRoomList::find($id);

        // Setelah data relasi dihapus, hapus data utama
        $room_list->delete();

        $notification = array(
            'message' => 'Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('room.list')->with($notification);
    }

}
