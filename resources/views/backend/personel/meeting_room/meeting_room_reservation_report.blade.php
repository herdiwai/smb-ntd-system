@extends('admin.admin_dashboard')
@section('admin')
    <div class="page-content">

        <nav class="page-breadcrumb">
            <ol class="breadcrumb"> 
                 <a href="" class="btn btn-inverse-info btn-xs"><i data-feather="file-plus" style="width: 16px; height: 16px;"></i> ADD RESERVATION FORM</a>
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
                                            <th>Lot</th>
                                            <th>Room.No</th>
                                            <th>Location</th>
                                            <th>Usage</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

        </div>
    




    </div>
@endsection