@extends('admin.admin_dashboard')
@section('admin')
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

                                            @if(Auth::user()->can('detail.bookedapproved'))
                                            <td>
                                                @if ($booked->Status_booking === 'waiting approvals')
                                                    <a href="{{ route('add.detailapprove', $booked->id ) }}" class="btn btn-success btn-xs" title="View Detail"><i data-feather="check-circle" style="width: 16px; height: 20px;"></i> APPROVED</a>
                                                @elseif($booked->Note_personel == true )
                                                    <a href="{{ route('add.detailapprove', $booked->id ) }}" class="btn btn-success btn-xs" title="View Detail"><i data-feather="check-circle" style="width: 16px; height: 20px;"></i> APPROVED</a>
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

@endsection