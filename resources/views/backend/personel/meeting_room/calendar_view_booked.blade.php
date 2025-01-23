@extends('admin.admin_dashboard')
@section('admin')

<div class="page-content">
    <nav class="page-breadcrumb">
        <div class="container">
            <h1>Meeting Room Bookings</h1>
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

<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.5/index.global.min.js"></script>

<script>
        document.addEventListener('DOMContentLoaded', function () {
        var calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            height: '1000px', // Mengatur tinggi kalender
            contentHeight: 'auto', // Konten kalender menyesuaikan
            aspectRatio: 1.5, // Mengubah aspek rasio untuk tampilan lebih kompak
            events: [
                @foreach ($bookings as $booking)
                    @foreach ($booking->meetingroom as $room)
                    {
                        title: 'Name: {{ $booking->Name }} - {{ $room->Lot }} - {{ $room->Room_no }} - {{ $room->Location }} - {{ $room->Usage }}',
                        start: '{{ \Carbon\Carbon::parse($booking->Date_booking)->format("Y-m-d") }}T{{ \Carbon\Carbon::parse($booking->Start_time)->format("H:i") }}',
                        end: '{{ \Carbon\Carbon::parse($booking->Date_booking)->format("Y-m-d") }}T{{ \Carbon\Carbon::parse($booking->End_time)->format("H:i") }}',
                        color: '{{ \Carbon\Carbon::parse($booking->End_time)->lt(now()) ? "red" : "green" }}',
                        extendedProps: {
                            name: '{{ $booking->Name }}', // Menambahkan data name
                            department: '{{ $booking->Department }}', // Menambahkan data department
                            description: '{{ $booking->Description }}', // Menambahkan data description
                            lot: '{{ $room->Lot }}',
                            room_no: '{{ $room->Room_no }}',
                            location: '{{ $room->Location }}',
                            usage: '{{ $room->Usage }}',
                        }
                    },
                    @endforeach
                @endforeach
            ],
            eventClick: function(info) {
        // Tampilkan detail event
        var event = info.event.extendedProps;
        var details = `
        <table class="table table-bordered">
            <tr><td><strong>Requester Name</strong></td><td>${event.name}</td></tr>
            <tr><td><strong>Deparment</strong></td><td>${event.department}</td></tr>
            <tr><td><strong>Brief description on meeting agenda</strong></td><td>${event.description}</td></tr>
        </table>
        <table class="table table-bordered">
            <tr><td><strong>Lot</strong></td><td>${event.lot}</td></tr>
            <tr><td><strong>Room No</strong></td><td>${event.room_no}</td></tr>
            <tr><td><strong>Location</strong></td><td>${event.location}</td></tr>
            <tr><td><strong>Usage</strong></td><td>${event.usage}</td></tr>
            <tr><td><strong>Start Date Time:</strong></td><td>${info.event.start.toLocaleString()}</td></tr>
            <tr><td><strong>End Date Time:</strong></td><td>${info.event.end.toLocaleString()}</td></tr>
        </table>
        `;

        // Contoh: Tampilkan dalam alert atau modal
        $('#eventDetailModal').modal('show').find('.modal-body').html(details);

        // Anda juga dapat memanggil modal Bootstrap atau elemen lain
        // Contoh: $('#eventDetailModal').modal('show').find('.modal-body').html(details);
    }
        });

        calendar.render();
    });
</script>

{{-- <script>
    document.addEventListener('DOMContentLoaded', function () {
        var calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            events: [
                @foreach ($bookings as $booking)
                {
                    title: 'Room: {{ $booking->room->Lot }} - {{ $booking->user->name }}',
                    start: '{{ $booking->Date_booking }}T{{ $booking->Start_time }}',
                    end: '{{ $booking->Date_booking }}T{{ $booking->End_time }}',
                    color: '{{ $booking->End_time < now() ? "green" : "red" }}', // Tampilkan warna sesuai status
                },
                @endforeach
            ]
        });

        calendar.render();
    });
</script> --}}


@endsection