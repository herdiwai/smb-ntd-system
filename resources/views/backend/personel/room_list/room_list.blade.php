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
                                <table id="serverside" class="table">
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

{{-- <script>
    $(document).ready( function() {
        var canDelete = {{ Auth::user()->can('column.delete') ? 'true' : 'false' }};
        var columns = [
                {
                    data: 'no',
                    name: 'no',
                },
                {
                    data: 'Lot',
                    name: 'sample_submitted_date',
                },
                {
                    data: 'Room_no',
                    name: 'doc_no',
                },
                {
                    data: 'Location',
                    name: 'series',
                },
                {
                    data: 'Usage',
                    name: 'no_of_sample',
                },
                // {
                //     data: 'status_report',
                //     name: 'status_report',
                // },
                // {
                //     data: 'status_review_qe_iqc',
                //     name: 'status_review_qe_iqc',
                // },
                // {
                //     data: 'status_review_qe_qca',
                //     name: 'status_review_qe_qca',
                // },
                // {
                //     data: 'status_approvals',
                //     name: 'status_approvals',
                // },
                {
                    data: 'action',
                    name: 'action',
                },
                
                ];
                if(canDelete) {
                    columns.push({ data: 'action', name: 'action'});
                }
                
        $('#serverside').DataTable({
            pageLength: 10,
            lengthMenu: [ [5,10, 25, 50, -1], [5, 10, 25, 50, "All"] ],
            processing:true,
            pagination:true,
            responsive:true,
            serverSide:true,
            searching:true,
            ordering:false,
            columnDefs: [ 
                {
                    "targets": 0, // Menargetkan kolom pertama untuk nomor urut
                    "searchable": false,
                    "orderable": false,
                    "render": function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                }
            ],
            drawCallback: function() {
                    feather.replace(); // Redraw icons after table update
                },
            ajax:{
                url:"{{ route('qualitycontrol.sampletestingreport') }}",
            },
            columns:columns
        });
    });
</script> --}}

@endsection