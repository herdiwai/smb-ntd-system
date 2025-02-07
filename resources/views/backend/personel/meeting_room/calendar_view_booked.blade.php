@extends('admin.admin_dashboard')
@section('admin')

<style>
    /* Mengubah warna teks pada header day */
    .fc-theme-standard th {
        background-color: #f37a2a !important; /* Warna background header */
        color: #333 !important; /* Warna teks agar terlihat jelas */
        font-weight: bold; /* Supaya lebih tegas */
    }
</style>

<div class="page-content">
    <nav class="page-breadcrumb">
        <div class="container">
            <h3>APPROVED MEETING ROOM</h3><br>
            <div id="calendar"></div>
        </div>
    </nav>
</div>

<!-- Modal -->
<div class="modal fade" id="eventDetailModal" tabindex="-1" aria-labelledby="eventDetailModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="eventDetailModalLabel">BOOKING DETAIL</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Detail event akan diisi di sini -->
            </div>
        </div>
    </div>
</div>

{{-- <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.5/index.global.min.js"></script> --}}

{{-- <script>
    document.addEventListener('DOMContentLoaded', function () {
        var calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            height: '1000px', // Mengatur tinggi kalender
            contentHeight: 'auto', // Konten kalender menyesuaikan
            aspectRatio: 1.5, // Mengubah aspek rasio untuk tampilan lebih kompak
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth'
            },
            events: [
                @foreach ($bookings as $booking)
                    @foreach ($booking->meetingroom as $room)
                    {
                        title: 'Name: {{ $booking->Name }} - {{ $room->Lot }} - {{ $room->Room_no }} - {{ $room->Location }} - {{ $room->Usage }}',
                        start: '{{ \Carbon\Carbon::parse($booking->Date_booking)->format("Y-m-d") }}T{{ \Carbon\Carbon::parse($booking->Start_time)->format("H:i") }}',
                        end: '{{ $booking->End_time ? \Carbon\Carbon::parse($booking->Date_booking)->format("Y-m-d") . "T" . \Carbon\Carbon::parse($booking->End_time)->format("H:i") : "" }}',
                        color: getEventColor('{{ \Carbon\Carbon::parse($booking->Date_booking)->format("m") }}'), // Warna berdasarkan bulan
                        extendedProps: {
                            name: '{{ $booking->Name }}',
                            department: '{{ $booking->Department }}',
                            description: '{{ $booking->Description }}',
                            lot: '{{ $room->Lot }}',
                            room_no: '{{ $room->Room_no }}',
                            location: '{{ $room->Location }}',
                            usage: '{{ $room->Usage }}',
                        }
                    },
                    @endforeach
                @endforeach
            ],

            dateClick: function(info) {
                // Set the clicked date in the modal form
                document.getElementById('selectedDate').value = info.dateStr;

                // Show the modal
                var bookingModal = new bootstrap.Modal(document.getElementById('bookingModal'));
                bookingModal.show();
            },
            eventClick: function(info) {
                var event = info.event.extendedProps;
                var startDate = info.event.start.toLocaleString();
                var endDate = info.event.end ? info.event.end.toLocaleString() : "Not specified";

                var details = `
                    <table class="table table-bordered">
                        <tr><td><strong>Requester Name</strong></td><td>${event.name}</td></tr>
                        <tr><td><strong>Department</strong></td><td>${event.department}</td></tr>
                        <tr><td><strong>Brief Description on Meeting Agenda</strong></td><td>${event.description}</td></tr>
                    </table>
                    <table class="table table-bordered">
                        <tr><td><strong>Lot</strong></td><td>${event.lot}</td></tr>
                        <tr><td><strong>Room No</strong></td><td>${event.room_no}</td></tr>
                        <tr><td><strong>Location</strong></td><td>${event.location}</td></tr>
                        <tr><td><strong>Usage</strong></td><td>${event.usage}</td></tr>
                        <tr><td><strong>Start Date Time:</strong></td><td>${startDate}</td></tr>
                        <tr><td><strong>End Date Time:</strong></td><td>${endDate}</td></tr>
                    </table>
                `;

                $('#eventDetailModal').modal('show').find('.modal-body').html(details);
            }
        });

        calendar.render();
    });

    // Fungsi untuk mengatur warna event berdasarkan bulan
    function getEventColor(month) {
        const colors = {
            '01': "yellow",  '02': "green", '03': "yellow",  '04': "green",
            '05': "yellow",  '06': "green",    '07': "yellow", '08': "green",
            '09': "yellow", '10': "green",   '11': "yellow",   '12': "green"
        };
        return colors[month] || "green";
    }
</script> --}}

<script>
    document.addEventListener('DOMContentLoaded', function () {
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        height: 'auto',
        contentHeight: 'auto',
        aspectRatio: 1.5,
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth'
        },
        events: {
            url: '/fetch-bookings', // Endpoint untuk mengambil data dari server
            method: 'GET',
            failure: function () {
                alert('Failed to load events');
            }
        },
        dateClick: function (info) {
            document.getElementById('selectedDate').value = info.dateStr;
            var bookingModal = new bootstrap.Modal(document.getElementById('bookingModal'));
            bookingModal.show();
        },
        eventClick: function (info) {
            var event = info.event.extendedProps;
            var startDate = info.event.start.toLocaleString();
            var endDate = info.event.end ? info.event.end.toLocaleString() : "Not specified";

            var details = `
                <table class="table table-bordered">
                    <tr><td><strong>Requester Name</strong></td><td>${event.name}</td></tr>
                    <tr><td><strong>Department</strong></td><td>${event.department}</td></tr>
                    <tr><td><strong>Brief Description on Meeting Agenda</strong></td><td>${event.description}</td></tr>
                </table>
                <table class="table table-bordered">
                    <tr><td><strong>Lot</strong></td><td>${event.lot}</td></tr>
                    <tr><td><strong>Room No</strong></td><td>${event.room_no}</td></tr>
                    <tr><td><strong>Location</strong></td><td>${event.location}</td></tr>
                    <tr><td><strong>Usage</strong></td><td>${event.usage}</td></tr>
                    <tr><td><strong>Remarks Facilities</strong></td><td>${event.remarks_facilities}</td></tr>
                    <tr><td><strong>Start Date Time:</strong></td><td>${startDate}</td></tr>
                    <tr><td><strong>End Date Time:</strong></td><td>${endDate}</td></tr>
                </table>
            `;

            $('#eventDetailModal').modal('show').find('.modal-body').html(details);
        }
    });

    calendar.render();
});
</script>

<!-- Modal Form -->
<div class="modal fade" id="bookingModal" tabindex="-1" aria-labelledby="bookingModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="bookingModalLabel">Request Booking Form</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="bookingForm" action="{{ route('store.request.meetingroom') }}" method="POST">
                    @method('POST')
                    @csrf

                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <div class="form-group">
                                <div class="row align-items-center">
                                    <div class="col-4">
                                        <label for="request_name" class="col-form-label col-form-label-sm"><b>SELECTED DATE:</b></label>
                                    </div>
                                    <div class="col-8">
                                        <input type="text" class="form-control form-control-sm text-secondary" id="selectedDate" name="Date_booking" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <div class="form-group">
                                <div class="row align-items-center">
                                    <div class="col-4">
                                        <label for="request_name" class="col-form-label col-form-label-sm"><b>NAME:</b></label>
                                    </div>
                                    <div class="col-8">
                                        <input type="text" class="form-control form-control-sm" id="request_name" name="Name">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <div class="form-group">
                                <div class="row align-items-center">
                                    <div class="col-4">
                                        <label for="department" class="col-form-label col-form-label-sm"><b>DEPARTMENT:</b></label>
                                    </div>
                                    <div class="col-8">
                                        <select id="department" name="Department" class="form-select form-select-sm">
                                            <option value="">--select department--</option>
                                            @foreach($department as $departments)
                                                <option value="{{ $departments }}" {{ old('department') == $departments ? 'selected' : '' }}>{{ $departments }}</option>
                                            @endforeach
                                        </select>
                                        {{-- <input type="text" class="form-control form-control-sm" id="request_dept" name="Department"> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-4">
                                        <label for="description" class="col-form-label col-form-label-sm"><b>MEETING DESCRIPTION:</b></label>
                                    </div>
                                    <div class="col-8">
                                        <textarea class="form-control form-control-sm" name="Description" id="description" rows="2"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- <div class="row">
                        <div class="col-md-12 mb-3">
                            <div class="form-group">
                                <div class="row align-items-center">
                                    <div class="col-4">
                                        <label for="date_booking" class="col-form-label col-form-label-sm"><b>DATE BOOKING:</b></label>
                                    </div>
                                    <div class="col-8">
                                        <div class="input-group flatpickr" id="flatpickr-date">
                                            <input type="text" name="Date_booking" class="form-control" placeholder="--select date--" data-input>
                                            <span class="input-group-text input-group-addon" data-toggle><i data-feather="calendar"></i></span>
                                          </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}

                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <div class="form-group">
                                <div class="row align-items-center">
                                    <div class="col-4">
                                        <label for="start_time1" class="col-form-label col-form-label-sm"><b>START TIME:</b></label>
                                    </div>
                                    <div class="col input-group flatpickr" id="flatpickr-time">
                                        <input type="text" class="form-control form-control-sm" name="Start_time" placeholder="Select time" data-input>
                                        <span class="input-group-text input-group-addon" data-toggle><i data-feather="clock"></i></span>
                                        {{-- <input type="time" class="form-control form-control-sm" id="start_time" name="Start_time" min="08:00" max="17:00">
                                        <small class="text-muted">Start: Only 08:00 - 17:00</small> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <div class="form-group">
                                <div class="row align-items-center">
                                    <div class="col-4">
                                        <label for="start_time2" class="col-form-label col-form-label-sm"><b>END TIME:</b></label>
                                    </div>
                                    <div class="col input-group flatpickr" id="flatpickr-time">
                                        <input type="text" class="form-control form-control-sm" name="End_time" placeholder="Select time" data-input>
                                        <span class="input-group-text input-group-addon" data-toggle><i data-feather="clock"></i></span>
                                        {{-- <input type="time" class="form-control form-control-sm" id="end_time" name="End_time" min="08:00" max="17:00">
                                        <small class="text-muted">End: Only 08:00 - 17:00</small> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <div class="form-group">
                                <div class="row align-items-center mt-3">
                                    <div class="col-4">
                                        <label class="col-form-label col-form-label-sm"><b>CHOOSE MEETING ROOM:</b></label>
                                    </div>
                                    <div class="col-8">
                                        <select id="Meeting_room" name="choose_meeting_room" class="form-select form-select-sm">
                                            <option value="">--select meeting room--</option>
                                            @foreach($room_list as $room_meeting_list)
                                                <option value="{{ $room_meeting_list->id }}">{{ $room_meeting_list->Lot }} | {{ $room_meeting_list->Room_no }} | {{ $room_meeting_list->Location }} | {{ $room_meeting_list->Usage }}</option>
                                            @endforeach
                                        </select>                 
                            
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <div class="form-group">
                                <div class="row align-items-center">
                                    <div class="col-4">
                                        <label class="col-form-label col-form-label-sm"><b>ADDITIONAL FACILITIES:</b></label>
                                    </div>
                                    <div class="col-8">
                                        <div class="d-flex gap-3">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="seat" name="facilities[]" value="seat">
                                                <label class="form-check-label" for="seat"><b>SEAT</b></label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="food" name="facilities[]" value="food">
                                                <label class="form-check-label" for="food"><b>FOOD</b></label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="drink" name="facilities[]" value="drink">
                                                <label class="form-check-label" for="drink"><b>DRINK</b></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <div class="form-group">
                                <div class="row align-items-center">
                                    <div class="col-4">
                                        <label for="remarks_facilities" class="col-form-label col-form-label-sm"><b>REMARKS:</b></label>
                                    </div>
                                    <div class="col-8">
                                        <textarea class="form-control form-control-sm" name="remarks_facilities" id="remarks" rows="2"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <br>
                        <div class="d-flex justify-content-right modal-footer">
                            <button class="btn btn-primary btn-sm" type="submit">
                                <i data-feather="send" style="width: 16px; height: 16px;"></i> Booking Submit
                            </button>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal notifikasi -->
<div id="notificationModal" class="modal1">
    <div class="modal-content1">
        <span id="closeModal" class="close1">&times;</span>
        {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
        {{-- <span id="closeModal" class="close1" data-bs-dismiss="modal1" aria-label="close1">&times;</span> --}}
        <p id="modalMessage">
            The room is already booked at that time. Please choose another time or room</p>
    </div>
</div>


<script>
    // Function to show modal
    function openModal(message) {
        document.getElementById('modalMessage').innerText = message;
        document.getElementById('notificationModal').style.display = "block"; // Show modal
    }

    // Close modal
    document.getElementById("closeModal").onclick = function() {
        document.getElementById('notificationModal').style.display = "none"; // Hide modal
    }

    // Close modal when clicking outside of it
    window.onclick = function(event) {
        if (event.target == document.getElementById('notificationModal')) {
            document.getElementById('notificationModal').style.display = "none"; // Hide modal
        }
    }

    // jQuery validation script
    $(document).ready(function () {
    $('#bookingForm').validate({
        rules: {
            Name: { required: true },
            Department: { required: true },
            Description: { required: true },
            Date_booking: { required: true },
            Start_time: { required: true },
            End_time: { required: true },
            choose_meeting_room: { required: true },
            // facilities: { required: true },
            // Remarks: { required: true },
        },
        messages: {
            Name: { required: 'Please Enter Name' },
            Department: { required: 'Please Enter Dept' },
            Description: { required: 'Please Enter Description' },
            Date_booking: { required: 'Please Enter Booking Date' },
            Start_time: { required: 'Please Enter Time' },
            End_time: { required: '' },
            choose_meeting_room: { required: 'Please Select Room' },
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            error.css('font-size', '12px');  // Menambahkan ukuran font
            element.closest('.form-group').after(error);;
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        },
        submitHandler: function(form) {
            // Prevent the default form submission to handle custom logic first
            const formData = new FormData(form);

            // Send AJAX request to check if the room is already booked
            fetch("{{ route('check.booking') }}", {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'error') {
                    // If there's a conflict, show the modal and prevent form submission
                    openModal(data.message);
                } else {
                    // If no conflict, submit the form
                    form.submit();
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }
    });
});
</script>
<!-- CSS Modal -->
<style>
    .modal1 {
        display: none;
        position: fixed;
        z-index: 1055;
        left: 0;
        top: 0;
        width: 115%;
        height: 115%;
        background-color: rgba(0, 0, 0, 0.5);
        overflow: auto;
    }

    .modal-content1 {
        background-color: #18284e;
        margin: 10% auto;
        padding: 15px;
        border: 1px solid #888;
        width: 35%;
        text-align: center;
        border-radius: 5px;
        z-index: 1055;
        position: relative; /* Agar elemen anak seperti .close1 mengikuti posisi relatif kontainer ini */
    }

    .close1 {
        color: #aaa;
        font-size: 20px;
        font-weight: bold;
        position: absolute; /* Posisi absolut untuk menempatkan tombol secara tepat */
        top: 10px; /* Jarak dari bagian atas modal */
        right: 15px; /* Jarak dari bagian kanan modal */
        cursor: pointer; /* Menunjukkan tombol bisa diklik */
        z-index: 1060; /* Pastikan tetap di atas konten */
    }

    .close1:hover,
    .close1:focus {
        color: white;      /* Ubah warna saat hover menjadi putih */
        text-decoration: none;
        cursor: pointer;
    }
    @media (max-width: 768px) {
    .modal-content1 {
        width: 90%; /* Perbesar modal pada perangkat kecil */
        padding: 10px; /* Kurangi padding */
    }

    .close1 {
        font-size: 16px; /* Kecilkan tombol "close" */
    }
}
</style>

@endsection