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
                                            <th>Note Personel</th>
                                            @if(Auth::user()->can('detail.bookedapproved'))
                                            <th>Action</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($bookedrequest as $key => $booked)
                                        <tr>
                                            {{-- <td>{{ $key+1 }}</td> --}}
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
                                                {{-- {{ $booked->meetingroom->Lot }} | --}}
                                                {{-- {{ $booked->meetingroom->Room_no }} |
                                                {{ $booked->meetingroom->Location }} |
                                                {{ $booked->meetingroom->Usage }} --}}
                                            </td>
                                            {{-- <td> --}}
                                                {{-- @if ($booked->meetingroom->isEmpty())
                                                    <span class="badge bg-success">Available</span>
                                                @else
                                                    <span class="badge bg-danger">Booked</span>
                                                @endif --}}
                                                @if($booked->Status_booking === 'waiting approvals')
                                                    <td><p class="text-warning">{{ $booked->Status_booking }}</p></td>
                                                @elseif($booked->Note_personel == true )
                                                    <td><p class="text-danger">REJECTED</p></td>
                                                @else
                                                    <td><p class="text-success">APPROVED</p></td>
                                                @endif
                                            {{-- </td> --}}

                                            {{-- <td>
                                                @if (!$booked->meetingroom->isEmpty())
                                                    @foreach ($booked->meetingroom as $booking)
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

                                            @if($booked->Note_personel == true )
                                                <td><p class="text-danger">{{ $booked->Note_personel }}</p></td>
                                            @elseif($booked->Note_personel == false)
                                                <td><p class="text-secondary">no record</p></td>
                                            @endif

                                            @if(Auth::user()->can('detail.bookedapproved'))
                                            <td>
                                                @if ($booked->Status_booking === 'waiting approvals')
                                                    <a href="{{ route('add.detailapprove', $booked->id ) }}" class="btn btn-info btn-xs" title="View Detail"><i data-feather="eye" style="width: 16px; height: 20px;"></i></a>
                                                @elseif($booked->Note_personel == true )
                                                    <a href="{{ route('add.detailapprove', $booked->id ) }}" class="btn btn-info btn-xs" title="View Detail"><i data-feather="eye" style="width: 16px; height: 20px;"></i></a>
                                                @else    
                                                    <button class="btn btn-success btn-xs" disabled><i data-feather="check-circle" style="width: 16px; height: 16px;"></i> APPROVED</button>
                                                    {{-- <i data-feather="check-circle" style="width: 16px; height: 20px;"></i><p class="text-success">APPROVED</p> --}}
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
                            </div>
                        </div>
                    </div>
                </div>

        </div>
    </div>

@endsection