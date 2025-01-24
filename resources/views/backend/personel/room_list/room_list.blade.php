@extends('admin.admin_dashboard')
@section('admin')
    <div class="page-content">

        <nav class="page-breadcrumb">
            <ol class="breadcrumb"> 
                 <a href="{{ route('add.meetingroom') }}" class="btn btn-inverse-info btn-xs"><i data-feather="file-plus" style="width: 16px; height: 16px;"></i> ADD MEETING ROOM</a>
            </ol>
        </nav>
    
            <div class="row">
                <div class="col-xs-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="card-title">List Meeting Room Reservation</h6>
                            <div class="table-responsive">
                                <table id="table" class="table">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Lot</th>
                                            <th>Room No</th>
                                            <th>Location</th>
                                            <th>Usage</th>
                                            {{-- <th>Status</th>
                                            <th>Booking Details</th> --}}
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($roomlist as $key => $rooms)
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>{{ $rooms->Lot }}</td>
                                            <td>{{ $rooms->Room_no }}</td>
                                            <td>{{ $rooms->Location }}</td>
                                            <td>{{ $rooms->Usage }}</td>
                                            {{-- <td>
                                                @if ($rooms->Meetingroom->isEmpty())
                                                    <span class="badge bg-success">Available</span>
                                                @else
                                                    <span class="badge bg-danger">Booked</span>
                                                @endif
                                            </td> --}}

                                            {{-- <td>
                                                @if (!$rooms->Meetingroom->isEmpty())
                                                    @foreach ($rooms->Meetingroom as $booking)
                                                        <p>
                                                            <strong>Date:</strong> {{ $booking->Date_booking }}<br>
                                                            <strong>Start Time:</strong> {{ $booking->Start_time }}<br>
                                                            <strong>End Time:</strong> {{ $booking->End_time }}
                                                        </p>
                                                    @endforeach
                                                @else
                                                    <p>No bookings</p>
                                                @endif
                                            </td> --}}

                                            <td>
                                                <a href="{{ route('edit.meetingroom', $rooms->id ) }}" class="btn btn-inverse-primary btn-xs" title="Approval"><i data-feather="edit" style="width: 16px; height: 20px;"></i></a>
                                                <a href="{{ route('delete.meetingroom', $rooms->id ) }}" class="btn btn-inverse-danger btn-xs" title="Approval"><i data-feather="trash" style="width: 16px; height: 20px;"></i></a>
                                            </td>
                                        <tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
@endsection