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
                                            <td>
                                                <a href="" class="btn btn-inverse-primary btn-xs" title="Approval"><i data-feather="arrow-up-circle" style="width: 16px; height: 20px;"></i></a>
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