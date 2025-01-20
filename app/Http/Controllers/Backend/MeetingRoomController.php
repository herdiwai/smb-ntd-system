<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Shift;
use App\Models\Lot;
use App\Models\Line;
use App\Models\MeetingRoom;
use App\Models\MeetingRoomList;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class MeetingRoomController extends Controller
{
    public function MeetingRoomList()
    {
        $bookedrequest =  MeetingRoom::latest()->paginate(10); 
         // Mengambil semua inspeksi beserta item inspeksi terkait
        return view('backend.personel.meeting_room.meeting_room_reservation_record', compact('bookedrequest'));
    }
    
    public function AddBookedMeetingRoom()
    {
        $currentTime = Carbon::now();

        // Ambil semua ruangan
        $rooms = MeetingRoomList::all();

        // Cari ruangan yang sedang dibooking (booking yang aktif)
        $unavailableRoomIds = MeetingRoom::where('End_time', '>', $currentTime)
            ->pluck('choose_meeting_room')
            ->toArray();

        $department = ['PIE(NTD)','PIE(MT)','PIE(PE)','PIE(IE)','PIE(FTY)'];
        $bookedrequest =  MeetingRoom::with('meetingroom')->orderBy('created_at', 'desc'); 

        // $query = Mrrequest::with('modelBrewer', 'lot', 'process', 'shift', 'line', 'equipmentNo', 'statusApprovals')
        // ->orderBy('Date_pd', 'desc');

        $room_list = MeetingRoomList::all();
         // Mengambil semua inspeksi beserta item inspeksi terkait
        return view('backend.personel.meeting_room.add_meeting_reservation_form', compact('department','unavailableRoomIds','rooms','bookedrequest','room_list'));
    }

    public function StoreBookedMeetingRoom(Request $request) 
    {
        // $request->validate([
        //     'room_id' => 'required|exists:rooms,id',
        //     'start_time' => 'required|date|before:end_time',
        //     'end_time' => 'required|date|after:start_time',
        // ]);

        MeetingRoom::create([
            'user_id' => Auth::id(),
            'Name' => $request->Name,
            'Department' => $request->Department,
            'Description' => $request->Description,
            'Date_booking' => $request->Date_booking,
            'Start_time' => $request->Start_time,
            'End_time' => $request->End_time,
            // 'Date_booking' => $request->Date_booking,
            'choose_meeting_room' => $request->choose_meeting_room,
            'Status_booking' => "waiting approvals",
        ]);

        $notification = array(
            'message' => 'Booked Request Form Create Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('personel.meetingroomlist')->with($notification);
    }

    public function AddDetailApprove($id)
    {
        $bookedrequestid = MeetingRoom::with('meetingroom')->findOrFail($id);
        $bookedrequest =  MeetingRoom::latest()->paginate(10); 
         // Mengambil semua inspeksi beserta item inspeksi terkait
        return view('backend.personel.meeting_room.detail_approve_form', compact('bookedrequestid','bookedrequest'));
    }

    

}
