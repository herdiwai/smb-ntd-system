@extends('admin.admin_dashboard')
@section('admin')
<meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="page-content">

        {{-- <nav class="page-breadcrumb">
            <ol class="breadcrumb"> 
                 <a href="{{ route('request.bookedmeetingroom') }}" class="btn btn-inverse-info btn-xs"><i data-feather="file-plus" style="width: 16px; height: 16px;"></i> CALENDAR</a>
            </ol>
        </nav> --}}

        {{-- <div class="row mb-3">
            <div class="col-md-6">
                <form action="" method="GET">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Search..." value="{{ request('search') }}"/>
                        <button type="submit" class="btn btn-primary">
                            Search
                        </button>
                    </div>
                </form>
            </div>
        </div>
     --}}
            <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">BOOKED LIST RESERVATION ROOM</h4>
                            <a href="{{ route('calendar.booked') }}" class="btn btn-inverse-primary btn-xs"><i data-feather="calendar" style="width: 16px; height: 16px;"></i> CALENDAR</a>
                            <div class="table-responsive">
                            <table id="table" class="table">
                                {{-- <table id="bookingsTable" class="table table-striped table-bordered"> --}}
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Date</th>
                                            <th>Requested Dept</th>
                                            <th>Name</th>
                                            <th>Description</th>
                                            <th>Start Time</th>
                                            <th>End Time</th>
                                            <th>Room Detail</th>
                                            <th>Status</th>
                                            <th>Note</th>
                                            <th>Remarks Facilities</th>
                                            @if(Auth::user()->can('detail.bookedapproved'))
                                            <th>Action</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($bookedrequest as $key => $booked)
                                        <tr>
                                            <td>{{ $key+1 + ($bookedrequest->currentPage() - 1) * $bookedrequest->perPage() }}</td>
                                            <td>{{ $booked->Date_booking }}</td>
                                            <td>{{ $booked->Department }}</td>
                                            <td>{{ $booked->Name }}</td>
                                            <td>{{ $booked->Description }}</td>
                                            <td>{{ $booked->Start_time }}</td>
                                            <td>{{ $booked->End_time }}</td>
                                            <td>
                                                @foreach ($booked->meetingroom as $meetingrooms)
                                                    {{ $meetingrooms->Lot }} |
                                                    {{ $meetingrooms->Room_no }} |
                                                    {{ $meetingrooms->Location }} |
                                                    {{ $meetingrooms->Usage }}
                                                @endforeach
                                            </td>
                                            

                                            @if($booked->Status_booking === 'waiting approvals')
                                                <td><p class="text-warning">{{ $booked->Status_booking }}</p></td>
                                            @elseif($booked->Note_personel == true )
                                                <td><p class="text-danger">REJECTED</p></td>
                                            @else
                                                <td><p class="text-success">APPROVED</p></td>
                                            @endif

                                            @if($booked->Note_personel == true )
                                                <td><p class="text-danger">{{ $booked->Note_personel }}</p></td>
                                            @elseif($booked->Note_personel == false)
                                                <td><p class="text-secondary">no record</p></td>
                                            @endif

                                            <td>{{ $booked->remarks_facilities }}</td>

                                            @if(Auth::user()->can('detail.bookedapproved'))
                                            <td>
                                                @if ($booked->Status_booking === 'waiting approvals')
                                                <button class="btn btn-success btn-xs" data-bs-toggle="modal" data-bs-target="#approveBookingModal"
                                                        data-booked-id="{{ $booked->id }}" onclick="loadBookingData({{ $booked->id }})">
                                                    <i data-feather="check-circle" style="width: 16px; height: 20px;"></i> APPROVED
                                                </button>
                                                    {{-- <a href="{{ route('add.detailapprove', $booked->id ) }}" class="btn btn-success btn-xs" title="View Detail"><i data-feather="check-circle" style="width: 16px; height: 20px;"></i> APPROVED</a> --}}
                                                @elseif($booked->Note_personel == true )
                                                <button class="btn btn-danger btn-xs" disabled data-bs-toggle="modal" data-bs-target="#approveBookingModal"
                                                        data-booked-id="{{ $booked->id }}" onclick="loadBookingData({{ $booked->id }})">
                                                    <i data-feather="check-circle" style="width: 16px; height: 20px;"></i> REJECTED
                                                </button>
                                                    {{-- <a href="{{ route('add.detailapprove', $booked->id ) }}" class="btn btn-success btn-xs" title="View Detail"><i data-feather="check-circle" style="width: 16px; height: 20px;"></i> APPROVED</a> --}}
                                                @else    
                                                    <button class="btn btn-success btn-xs" disabled><i data-feather="check-circle" style="width: 16px; height: 16px;"></i> APPROVED</button>
                                                @endif

                                                 @if(Auth::user()->can('delete.booked'))
                                                <a href="{{ route('delete.booked', $booked->id ) }}" class="btn btn-inverse-danger btn-xs" title="Delete Mrr"><i data-feather="trash-2" style="width: 16px; height: 16px;"></i></a>
                                                 @endif
                                            </td>
                                            @endif
                                        <tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{ $bookedrequest->links('pagination::bootstrap-5') }}
                                {{-- {{ $meetingRooms->appends(['search' => request('search')])->links('pagination::bootstrap-5') }} --}}
                            </div>
                        </div>
                    </div>
                </div>

        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#bookingsTable').DataTable({
                processing: false,
                serverSide: false,
                ajax: '{{ route("getBookings") }}',
                order: [[1, 'asc']], // Urutkan berdasarkan kolom kedua (kolom indeks 1)
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'name', name: 'name' },
                    { data: 'meetingroom.room_no', name: 'meetingroom.Room_no' },
                    { data: 'meetingroom.location', name: 'meetingroom.Location' },
                    { data: 'Date_booking', name: 'Date_booking' },
                    { data: 'End_time', name: 'End_time' },
                    { data: 'action', name: 'action', orderable: false, searchable: false },
                ]
            });
        });
    </script>

<div class="modal fade" id="approveBookingModal" tabindex="-1" aria-labelledby="approveBookingModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="approveBookingModalLabel">MEETING ROOM RESERVATION FORM</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="modalContent">
                <!-- Konten modal akan dimuat di sini -->
            </div>
        </div>
    </div>
</div>



<script>
    function loadBookingData(bookedrequestid) {
        // Menampilkan loader jika perlu
        $('#modalContent').html('<p>Loading...</p>');

        // Melakukan AJAX request untuk mengambil data detail booking
        $.ajax({
            url: '/add/detailapprove/' + bookedrequestid,  // pastikan bookedid berisi ID yang benar
            type: 'get',
            success: function(data) {
                console.log(data); // Periksa data yang diterima
                $('#modalContent').html(`
                    <form id="approveForm" action="/update/request-meetingroom-approval/${data.id}" method="POST">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="_method" value="PATCH">

                        <div class="mb-3">
                            <label class="form-label"><b>Requester Name:</b></label>
                            <input type="text" class="form-control" value="${data.Name}" disabled>
                        </div>

                        <div class="mb-3">
                            <label class="form-label"><b>Department:</b></label>
                            <input type="text" class="form-control" value="${data.Department}" disabled>
                        </div>

                        <div class="mb-3">
                            <label class="form-label"><b>Meeting Description:</b></label>
                            <textarea class="form-control" rows="2" disabled>${data.Description}</textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label"><b>Remarks Facilities:</b></label>
                            <textarea class="form-control" rows="2" disabled>${data.remarks_facilities}</textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label"><b>Time:</b></label>
                            <div class="d-flex">
                                <input type="time" class="form-control me-2" name="Start_time" value="${data.Start_time}" required>
                                <input type="time" class="form-control" name="End_time" value="${data.End_time}" required>
                            </div>
                            <small class="text-muted">Allowed time: 08:00 - 17:00</small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label"><b>Date:</b></label>
                            <input type="date" class="form-control" name="Date_booking" value="${data.Date_booking}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label"><b>Meeting Room:</b></label>
                            <select name="choose_meeting_room" class="form-select" id="meetingRoomSelect">
                                <!-- Options will be dynamically added by JavaScript -->
                            </select>
                        </div>

                        <div class="d-flex justify-content-end">
                            <!-- Kondisi untuk tombol Approve dan Reject berdasarkan Status_booking -->
                            ${data.Status_booking === 'waiting approvals' ?
                                `
                                <button type="submit" name="Status_booking" value="APPROVED" class="btn btn-success me-2">
                                    <i data-feather="check-circle"></i> Approved
                                </button>
                                <button type="button" class="btn btn-danger reject-btn"
                                    data-bs-toggle="modal" data-bs-target="#rejectModalBooking" 
                                    data-id="${data.id}">
                                    <i data-feather="x-circle"></i> Rejected
                                </button>
                                ` : ''
                            }
                            ${data.Status_booking === 'APPROVED' ?
                                `
                                <button type="button" class="btn btn-danger reject-btn"
                                    data-bs-toggle="modal" data-bs-target="#rejectModalBooking" 
                                    data-id="${data.id}">
                                    <i data-feather="x-circle"></i> Rejected
                                </button>
                                ` : ''
                            }
                            
                        </div>
                    </form>
                `);

                // Menambahkan options untuk meeting room
                var meetingRoomSelect = $('#meetingRoomSelect');
                data.rooms.forEach(function(room) {
                    var selected = (room.id == data.choose_meeting_room) ? 'selected' : '';
                    meetingRoomSelect.append(`
                        <option value="${room.id}" ${selected}>
                            ${room.Lot} | ${room.Room_no} | ${room.Location} | ${room.Usage}
                        </option>
                    `);
                });

                // Cek jika tombol berhasil ditambahkan atau diubah
                feather.replace();
            },
            error: function() {
                $('#modalContent').html('<p>Error loading booking details.</p>');
            }
        });
    }
</script>
<script>
    $(document).on("click", ".approve-btn", function() {
    var bookedId = $(this).data("id"); 
    var status = $(this).data("status");

    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
        }
    });

    $.ajax({
        url: `/update/request-meetingroom-approval/${bookedId}`,
        type: "POST", // Gunakan POST jika PATCH tidak bekerja
        data: {
            _method: "PATCH", 
            Status_booking: status,
            Note_personel: "" // Gunakan string kosong
        },
        success: function(response) {
            window.location.reload();
        },
        error: function(xhr) {
            alert("Failed to approve booking. Please try again.");
            console.log("Status Code:", xhr.status);
            console.log(xhr.responseText);
        }
    });
});
</script>



<div class="modal fade" id="rejectModalBooking" tabindex="-1" aria-labelledby="rejectModalBookingLabel" aria-hidden="true"  data-id="">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="rejectModalBookingLabel">Reject Booking</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <div class="form-group">
                            <label for="status_booking_room"><b>Reason:</b></label>
                            <textarea class="form-control form-control-sm" name="Note_personel" id="status_booking_room" rows="2"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger" id="submitReject">Reject</button>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
        $(document).on('click', '.reject-btn', function () {
        let bookedrequestid = $(this).data('id'); // Ambil ID dari tombol
        console.log('ID yang dikirim ke tombol reject:', bookedrequestid); // Cek ID di console
        $('#submitReject').data('id', bookedrequestid); // Set ID ke tombol submit di modal
        });

        $(document).on('click', '#submitReject', function () {
        let bookedrequestid = $(this).data('id'); // Ambil ID dari tombol submit
        console.log('ID dari tombol submit reject:', bookedrequestid); // Cek ID di console

        let note = $('#status_booking_room').val(); // Ambil isi textarea
        if (note.trim() === '') {
            alert('Harap isi alasan penolakan!');
            return;
        }

        $.ajax({
            url: `/update/request-meetingroom-approval/${bookedrequestid}`, // Gunakan ID dinamis
            type: 'POST', // Ganti menjadi POST
            data: {
                _token: '{{ csrf_token() }}',
                _method: 'PATCH', // Gunakan _method PATCH untuk method PATCH
                Status_booking: 'REJECTED',
                Note_personel: note
            },
            success: function(response) {
                alert('Request berhasil ditolak!');
                $('#rejectModalBooking').modal('hide');
                location.reload();
            },
            error: function(xhr) {
                console.log(xhr.responseText);
                alert('Terjadi kesalahan: ' + xhr.responseText);
            }
        });
    });
        
</script>

<!-- Modal Form -->
{{-- <div class="modal fade" id="approveBookingModal" tabindex="-1" aria-labelledby="approveBookingModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="approveBookingModalLabel">MEETING ROOM RESERVATION FORM</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="approveFormBooking" action="" method="POST">
                    @csrf
                    @method('PATCH')

                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="request_name" class="form-label"><b>Requester Name:</b></label>
                            <input type="text" class="form-control" id="request_name" name="Name" disabled>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="request_dept" class="form-label"><b>Department:</b></label>
                            <input type="text" class="form-control" id="request_dept" name="Department" disabled>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="description" class="form-label"><b>Meeting Description:</b></label>
                            <textarea class="form-control" name="description" id="description" rows="2" disabled></textarea>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="start_time" class="form-label"><b>Start Time:</b></label>
                            <input type="time" class="form-control" id="start_time" name="start_time" min="08:00" max="17:00">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="end_time" class="form-label"><b>End Time:</b></label>
                            <input type="time" class="form-control" id="end_time" name="end_time" min="08:00" max="17:00">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="date" class="form-label"><b>Date:</b></label>
                            <input type="date" class="form-control" name="Date_booking" id="date" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label class="form-label"><b>Meeting Room:</b></label>
                            <select id="Choose_meeting_room" name="Choose_meeting_room" class="form-select">
                                @foreach($rooms as $room)
                                    <option value="{{ $room->id }}">{{ $room->Lot }} | {{ $room->Room_no }} | {{ $room->Location }} | {{ $room->Usage }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end">
                        <button class="btn btn-success btn-sm me-2" type="submit" name="Status_booking" value="APPROVED">
                            <i data-feather="check-circle"></i> APPROVED
                        </button>
                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#rejectModalBooking" onclick="openRejectBooking()">
                            <i data-feather="x-circle"></i> REJECTED
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div> --}}

{{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
{{-- <script>
    $(document).ready(function() {
        $('.approve-btn').click(function() {
            var bookingId = $(this).data('id');

            $.ajax({
                url: "/add/detailapprove/" + bookingId, // Sesuaikan route dengan route yang benar
                type: "GET",
                success: function(response) {
                    // Isi modal dengan data yang diterima dari server
                    // $('#booking_id').val(response.id);
                    $('#Name').val(response.Name);
                    $('#Department').val(response.Department);
                    $('#Description').val(response.description);
                    $('#Start_time').val(response.start_time);
                    $('#End_time').val(response.end_time);
                    $('#Date_booking').val(response.date);

                    // Pilih meeting room yang sesuai
                    $('#Choose_meeting_room').val(response.meeting_room_id);

                    // Tampilkan modal
                    $('#approveBookingModal').modal('show');
                },
                error: function(xhr) {
                    alert('Gagal memuat data. Silakan coba lagi.');
                }
            });
        });

        // Handle form submission (jika ingin menggunakan AJAX)
        $('#approveFormBooking').submit(function(event) {
            event.preventDefault(); // Mencegah reload halaman

            var formData = $(this).serialize(); // Ambil semua data form

            $.ajax({
                url: "/add/detailapprove/" + $('#booking_id').val(), // Sesuaikan dengan route update
                type: "PATCH",
                data: formData,
                success: function(response) {
                    alert('Booking Approved Successfully!');
                    location.reload(); // Refresh halaman setelah approval
                },
                error: function(xhr) {
                    alert('Gagal menyetujui booking.');
                }
            });
        });
    });
</script> --}}

    

@endsection