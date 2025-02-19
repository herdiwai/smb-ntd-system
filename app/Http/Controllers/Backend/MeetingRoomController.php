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
use Illuminate\Support\Facades\Mail;
use App\Mail\BookingNotification;
use App\Mail\BookingApprovedNotification;
use Yajra\DataTables\Facades\DataTables;

class MeetingRoomController extends Controller
{
    public function getRoomDetailsByLot($lots)
    {
        $room = MeetingRoomList::where('Lot', $lots)->get();
        return response()->json($room);
    }

    public function getRoomDetailsByRoomNo($room_no)
    {
        $rooms = MeetingRoomList::where('Room_no', $room_no)->get();
        return response()->json($rooms);
    }

    public function getUsageByLocation($location)
    {
        $usages = MeetingRoomList::where('Location', $location)->pluck('Usage')->unique();
        return response()->json($usages);
    }

    public function calendarViewBooked()
    {
        $lots = MeetingRoomList::select('Lot')->distinct()->get();
        $currentDateTime = now()->format('H:i');
        $bookedrequest =  MeetingRoom::with('meetingroom')->get();

        $bookings = MeetingRoom::with(['meetingroom'])
            // ->where('Status_booking' , 'APPROVED')
            ->where('End_time', '>=', $currentDateTime) // Filter booking aktif
            ->orderBy('Date_booking', 'asc') // Urutkan berdasarkan tanggal booking
            ->get();

        $department = ['P&A','QC','F&A','PIE (NTD)','PIE (MT)','PIE (PE)','PIE (IE)','PIE (FTY)','WH','Shipping','QA','Engineering','PMC/PPC'];
        $room_list = MeetingRoomList::all();
        // $data = $bookings->paginate(10);

        return view('backend.personel.meeting_room.calendar_view_booked', compact('lots','room_list','department','bookings','bookedrequest'));
    }

    public function fetchBookings()
    {
        $bookings = MeetingRoom::with('meetingroom')
            ->where('Status_booking', 'APPROVED')
            ->get();

        $events = $bookings->flatMap(function ($booking) {
            return $booking->meetingroom->map(function ($room) use ($booking) {
                return [
                    'title' => "Name: {$booking->Name} - {$room->Lot} - {$room->Room_no} - {$room->Location} - {$room->Usage}",
                    'start' => $booking->Date_booking . 'T' . \Carbon\Carbon::parse($booking->Start_time)->format('H:i'),
                    'end' => $booking->End_time
                        ? $booking->Date_booking . 'T' . \Carbon\Carbon::parse($booking->End_time)->format('H:i')
                        : null,
                    'color' => $this->getEventColor(\Carbon\Carbon::parse($booking->Date_booking)->format('m')),
                    'extendedProps' => [
                        'name' => $booking->Name,
                        'department' => $booking->Department,
                        'description' => $booking->Description,
                        'lot' => $room->Lot,
                        'room_no' => $room->Room_no,
                        'location' => $room->Location,
                        'usage' => $room->Usage,
                        'remarks_facilities' => $booking->remarks_facilities,
                        'participants' => $booking->participants,
                    ],
                ];
            });
        });

        return response()->json($events);
    }

    private function getEventColor($month)
    {
        $colors = [
            '01' => "yellow", '02' => "green", '03' => "yellow", '04' => "green",
            '05' => "yellow", '06' => "green", '07' => "yellow", '08' => "green",
            '09' => "yellow", '10' => "green", '11' => "yellow", '12' => "green",
        ];

        return $colors[$month] ?? "green";
    }

    // Dengan DataTable
    public function getBookings(Request $request)
    {
        if ($request->ajax()) {
            $bookings = MeetingRoom::with(['meetingroom'])
                ->where('End_time', '>=', now()->format('H:i')) // Filter booking aktif
                ->orderBy('Date_booking', 'asc');

            return DataTables::of($bookings)
                ->addColumn('action', function ($row) {
                    return '
                        <a href="' . route('meeting_rooms.edit', $row->id) . '" class="btn btn-warning btn-sm">Edit</a>
                        <form action="' . route('meeting_rooms.destroy', $row->id) . '" method="POST" class="d-inline">
                            ' . csrf_field() . '
                            ' . method_field('DELETE') . '
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    ';
                })
                ->make(true);
        }

        return view('backend.personel.meeting_room.meeting_room_reservation_record');
    }

    // tanpa DataTable (pagination)
    public function MeetingRoomList(Request $request)
    {
        // Tangkap kata kunci pencarian
        // $search = $request->input('search');

        // // Query data dengan kondisi pencarian
        // $meetingRooms = MeetingRoom::query()
        //     ->when($search, function ($query, $search) {
        //         return $query->where('Status_booking', 'like', "%{$search}%");
        //                     // ->orWhere('Room_no', 'like', "%{$search}%")
        //                     // ->orWhere('Location', 'like', "%{$search}%");
        //     })
        //     ->paginate(10); // Pagination jika diperlukan
        
        $currentDateTime = now()->format('H:i');

        $bookings = MeetingRoom::with(['meetingroom'])
            ->where('End_time', '>=', $currentDateTime) // Filter booking aktif
            ->orderBy('Date_booking', 'asc') // Urutkan berdasarkan tanggal booking
            ->get();

        $rooms = MeetingRoomList::all();

        $bookedrequest =  MeetingRoom::with('meetingroom')->orderBy('Date_booking', 'desc')->paginate(10);

        // $room_id = $request->id;
        // $bookedrequestid = MeetingRoom::with('meetingroom')->findOrFail($room_id);
        // $bookedrequestid = MeetingRoom::with('meetingroom')->findOrFail($id);

        

        return view('backend.personel.meeting_room.meeting_room_reservation_record', compact('bookings','bookedrequest','rooms'));
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

        // Simpan booking ke database
            $booking = MeetingRoom::create([
                'user_id' => Auth::id(),
                'Booking_number_id' => $autoCode,
                'Name' => $request->Name,
                'Department' => $request->Department,
                'Description' => $request->Description,
                'Date_booking' => $request->Date_booking,
                'Start_time' => $request->Start_time,
                'End_time' => $request->End_time,
                'choose_meeting_room' => $request->choose_meeting_room,
                'facilities' => implode(',', $request->facilities),
                // 'facilities' => $request->facilities,
                'remarks_facilities' => $request->remarks_facilities,
                'participants' => $request->participants,

                'Status_booking' => "waiting approvals",
            ]);

            // $adminEmails = ['wulandaridwi257@gmail.com', 'herdi.kom@gmail.com'];
            // Mail::to($adminEmails)->send(new BookingNotification($booking));



        $notification = array(
            'message' => 'Booked Request Form Create Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('personel.meetingroomlist')->with($notification);
    }

    public function updateBookedMeetingRoom(Request $request, $id)
    {
        $meetingRoom = MeetingRoom::findOrFail($id);
        $room_id = $request->id;
        $meetingRoom = MeetingRoom::findOrFail($room_id);
        
        // Update data
        // Cek apakah form pertama dikirim
        if ($request->has('Date_booking') && $request->has('Start_time') && $request->has('End_time') && $request->has('choose_meeting_room')) {
            // Update data form pertama
            $meetingRoom->update([
                'user_id_personel' => Auth::id(),
                'Date_booking' => $request->Date_booking,
                'Start_time' => $request->Start_time,
                'End_time' => $request->End_time,
                'choose_meeting_room' => $request->choose_meeting_room,
                'Status_booking' => $request->Status_booking,
            ]);
        }

        // Cek apakah form kedua dikirim
        elseif ($request->has('Note_personel')) {
            // Update data form kedua
            $meetingRoom->update([
                'user_id_personel' => Auth::id(),
                'Note_personel' => $request->Note_personel,
                'Status_booking' => $request->Status_booking,
            ]);
        }



        // // Jika status sebelumnya REJECTED dan sekarang Approved, atau jika ada perubahan pada start, end, date, atau choose_meeting_room
        // if ($meetingRoom->Status_booking === 'REJECTED' && $request->Status_booking === 'APPROVED') {
            
        //     // Cek apakah ada perubahan pada Start_time, End_time, Date_booking, atau choose_meeting_room
        //     $isEdited = $request->Start_time !== $meetingRoom->Start_time ||
        //                 $request->End_time !== $meetingRoom->End_time ||
        //                 $request->Date_booking !== $meetingRoom->Date_booking ||
        //                 $request->choose_meeting_room !== $meetingRoom->choose_meeting_room;

        //     // Jika tidak ada perubahan pada waktu dan ruangan
        //     if (!$isEdited) {
        //         $meetingRoom->update([
        //             'Status_booking' => 'APPROVED',
        //             'Note_personel' => null, // Reset Note_personel
        //         ]);
        //     } else {
        //         // Jika ada perubahan, update juga data lainnya
        //         $meetingRoom->update([
        //             'Start_time' => $request->Start_time,
        //             'End_time' => $request->End_time,
        //             'Date_booking' => $request->Date_booking,
        //             'choose_meeting_room' => $request->choose_meeting_room,
        //             'Status_booking' => 'APPROVED',
        //             'Note_personel' => null, // Reset Note_personel
        //         ]);
        //     }
        // }
        
        // Kirim email ke user yang booking meeting room
        // Mail::to($meetingRoom->user->email)->send(new BookingApprovedNotification($meetingRoom));
        
        // Notifikasi sukses di halaman
        $notification = array(
            'message' => 'Booked Meeting Room Approved/Updated Successfully & Email Sent',
            'alert-type' => 'info'
        );
        
        // Redirect ke halaman meeting list dengan notifikasi
        return redirect()->route('personel.meetingroomlist')->with($notification);
        
    }

    public function AddDetailApprove($id)
    {
        // $bookedrequestid = MeetingRoom::with('meetingroom')->findOrFail($id);
        // $bookedid = MeetingRoom::findOrFail($id);
        // $bookedrequest =  MeetingRoom::latest()->paginate(10); 
        // $rooms = MeetingRoomList::all();
        
        // return view('backend.personel.meeting_room.detail_approve_form', compact('bookedrequestid', 'rooms','bookedid','bookedrequest'));
        $bookedrequestid = MeetingRoom::with('meetingroom')->findOrFail($id);
        $bookedrequest = MeetingRoom::latest()->paginate(10); 
        $bookedid = MeetingRoom::findOrFail($id);
        $rooms = MeetingRoomList::all();
    
        // Pastikan hanya data yang dibutuhkan yang dikirim dalam JSON
            $response = [
                'id' => $bookedrequestid->id,
                'Name' => $bookedrequestid->Name,
                'Department' => $bookedrequestid->Department,
                'Description' => $bookedrequestid->Description,
                'remarks_facilities' => $bookedrequestid->remarks_facilities,
                'Start_time' => $bookedrequestid->Start_time,
                'End_time' => $bookedrequestid->End_time,
                'Date_booking' => $bookedrequestid->Date_booking,
                'choose_meeting_room' => $bookedrequestid->choose_meeting_room,
                'participants' => $bookedrequestid->participants,
                'rooms' => $rooms, // pastikan rooms dikirimkan
                'Status_booking' => $bookedrequestid->Status_booking,
                'bookedrequest' => $bookedrequest, // menambahkan $bookedrequest ke respons JSON
                'bookedid' => $bookedid, // menambahkan $bookedid ke respons JSON
            ];

            return response()->json($response);
    
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
        // Ambil data dari request
        $dateBooking = $request->input('Date_booking');
        $startTime = $request->input('Start_time');
        $endTime = $request->input('End_time');
        $room = $request->input('choose_meeting_room');

        // Cek apakah ada booking yang bentrok di tanggal dan ruangan yang sama
        $existingBooking = MeetingRoom::where('Date_booking', $dateBooking)
        ->where('choose_meeting_room', $room)
        ->where(function ($query) use ($startTime, $endTime) {
            $query->where(function ($q) use ($startTime, $endTime) {
                $q->where('Start_time', '<', $endTime)  // Start booking baru masuk dalam rentang booking lama
                ->where('End_time', '>', $startTime); // End booking baru masuk dalam rentang booking lama
            });
        })
        ->exists();

        // Jika ada bentrokan waktu, kembalikan response error
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
