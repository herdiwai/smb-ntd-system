@extends('admin.admin_dashboard')
@section('admin')
    <div class="page-content">

        <nav class="page-breadcrumb">
            <ol class="breadcrumb"> 
                 <a href="{{ route('request.bookedmeetingroom') }}" class="btn btn-inverse-info btn-xs"><i data-feather="file-plus" style="width: 16px; height: 16px;"></i> ADD RESERVATION FORM</a>
            </ol>
        </nav>
    
            <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="card-title">List Meeting Room Reservation</h6>
                            <div class="table-responsive">
                                <table id="table" class="table">
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
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($bookedrequest as $key => $booked)
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>{{ $booked->Date_booking }}</td>
                                            <td>{{ $booked->Department }}</td>
                                            <td>{{ $booked->Name }}</td>
                                            <td>{{ $booked->Description }}</td>
                                            <td>{{ $booked->Start_time }}</td>
                                            <td>{{ $booked->End_time }}</td>
                                            <td>
                                                {{ $booked->meetingroom->Lot }} |
                                                {{ $booked->meetingroom->Room_no }} |
                                                {{ $booked->meetingroom->Location }} |
                                                {{ $booked->meetingroom->Usage }}
                                            </td>
                                            <td>
                                                <p class="text-warning">{{ $booked->Status_booking }}</p>
                                            </td>
                                            <td>
                                                <a href="{{ route('add.detailapprove', $booked->id ) }}" class="btn btn-inverse-primary btn-xs" title="Approval"><i data-feather="activity" style="width: 16px; height: 20px;"></i></a>
                                                <a href="{{ route('delete.booked', $booked->id ) }}" class="btn btn-inverse-danger btn-xs" title="Delete Mrr"><i data-feather="trash-2" style="width: 16px; height: 16px;"></i></a>
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