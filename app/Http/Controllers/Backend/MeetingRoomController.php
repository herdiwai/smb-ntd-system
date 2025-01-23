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
    public function calendarViewBooked()
    {
        $currentDateTime = now()->format('H:i');
        $bookedrequest =  MeetingRoom::with('meetingroom')->get();

        $bookings = MeetingRoom::with(['meetingroom'])
        ->where('End_time', '>=', $currentDateTime) // Filter booking aktif
        ->orderBy('Date_booking', 'asc') // Urutkan berdasarkan tanggal booking
        ->get();

        // $data = $bookings->paginate(10);

        return view('backend.personel.meeting_room.calendar_view_booked', compact('bookings','bookedrequest'));
    }

    public function MeetingRoomList()
    {
        // $booked_id = MeetingRoom::findOrFail($id); // Ambil booking berdasarkan ID
        $currentDateTime = now()->format('H:i');

        // Ambil data semua ruangan beserta status bookingnya
        // $rooms = MeetingRoom::with(['meetingroom' => function ($query) use ($currentDateTime) {
        //     $query->where('End_time', '>=', $currentDateTime) // Booking yang belum selesai
        //         ->orderBy('Start_time', 'asc'); // Urutkan berdasarkan waktu mulai
        // }])->get();

        $bookings = MeetingRoom::with(['meetingroom'])
            ->where('End_time', '>=', $currentDateTime) // Filter booking aktif
            ->orderBy('Date_booking', 'asc') // Urutkan berdasarkan tanggal booking
            ->get();

        // $bookedrequest =  MeetingRoom::latest()->paginate(10); 
        $bookedrequest =  MeetingRoom::with('meetingroom')->paginate(10);
         // Mengambil semua inspeksi beserta item inspeksi terkait
        //  dd($bookings);
        return view('backend.personel.meeting_room.meeting_room_reservation_record', compact('bookings','bookedrequest'));
    }
    
    public function AddBookedMeetingRoom(Request $request)
    {
        $booked_id = $request->id;

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
        return view('backend.personel.meeting_room.add_meeting_reservation_form', compact('booked_id','department','unavailableRoomIds','rooms','bookedrequest','room_list'));
    }

    public function StoreBookedMeetingRoom(Request $request) 
    {
        // $request->validate([
        //     'room_id' => 'required|exists:rooms,id',
        //     'start_time' => 'required|date|before:end_time',
        //     'end_time' => 'required|date|after:start_time',
        // ]);

        // Buat incomming_number (kode urut)
        $lastCode = MeetingRoom::latest('Booking_number_id')->first();
        if (!$lastCode) {
            // Jika tidak ada kode sebelumnya, mulai dari angka 1
            $autoCode = 'MR-0001';
        } else {
            // Ambil angka terakhir setelah "MR-" dan tambah 1
            $lastNumber = (int) substr($lastCode->Booking_number_id, 3); // Ambil angka setelah "MR-"
            $number = $lastNumber + 1;
            $autoCode = 'MR-' . str_pad($number, 4, '0', STR_PAD_LEFT); // Format kode auto: MR-XXXX
        }

        MeetingRoom::create([
            'user_id' => Auth::id(),
            'Booking_number_id' => $autoCode,
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

    public function updateBookedMeetingRoom(Request $request)
    {
        $room_id = $request->id;
        MeetingRoom::findOrFail($room_id)->update([
            'user_id_personel' => Auth::id(),
            'Note_personel' => $request->Note_personel,
            'Status_booking' => $request->Status_booking,
        ]);
        $notification = array(
            'message' => 'Booked Meeting Room Approved/Update Successfully',
            'alert-type' => 'info'
        );
        return redirect()->route('personel.meetingroomlist')->with($notification);
    }

    public function AddDetailApprove($id)
    {
        $bookedrequestid = MeetingRoom::with('meetingroom')->findOrFail($id);
        $bookedid = MeetingRoom::findOrFail($id);
        $bookedrequest =  MeetingRoom::latest()->paginate(10); 
        $rooms = MeetingRoomList::all();

         // Mengambil semua inspeksi beserta item inspeksi terkait
        return view('backend.personel.meeting_room.detail_approve_form', compact('bookedid','rooms','bookedrequestid','bookedrequest'));
    }

    public function deleteBooked($id) 
    {
        // Cari data berdasarkan ID yang ingin dihapus
        $mrr = MeetingRoom::find($id);

        // Setelah data relasi dihapus, hapus data utama
        $mrr->delete();

        $notification = array(
            'message' => 'Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('personel.meetingroomlist')->with($notification);
    }

    public function checkBooking(Request $request)
    {
          // Ambil data dari form
        $dateBooking = $request->input('Date_booking');
        $startTime = $request->input('Start_time');
        $endTime = $request->input('End_time');
        $room = $request->input('choose_meeting_room');

        // Cari booking yang sudah ada dengan Date, Start Time, End Time dan Room yang sama
        $existingBooking = MeetingRoom::where('Date_booking', $dateBooking)
            ->where('Start_time', $startTime)
            ->where('End_time', $endTime)
            ->where('choose_meeting_room', $room)
            ->first();

        // Jika ada booking yang ditemukan
        if ($existingBooking) {
            return response()->json([
                'status' => 'error',
                'message' => 'The room is already booked at that time. Please choose another time or room.'
            ]);
        }

        // Jika tidak ada conflict, lanjutkan dengan proses pemesanan
        return response()->json([
            'status' => 'success',
            'message' => 'Ruangan tersedia, silakan lanjutkan pemesanan.'
        ]);
    }

}
