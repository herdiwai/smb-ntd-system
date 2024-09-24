@extends('admin.admin_dashboard')
@section('admin')

<div class="page-content">
  
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
             <a href="{{ route('add.ProcessPatrol') }}" class="btn btn-inverse-info btn-sm"><i data-feather="plus-square"></i> Add Sub Assy Process Patrol Form</a>
        </ol>
    </nav>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title"> IN-PROCESS PATROL AND MATERIAL INSPECTION RECORD FORM</h6>
                    <div class="table-responsive">
                        <table id="" class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>DATE</th>
                                    <th>MODEL</th>
                                    <th>PRODUCT NAME</th>
                                    <th>PRODUCT UNIT</th>
                                    <th>INSPECTED BY</th>
                                    <th>REVIEWED BY</th>
                                    <th>ACTION</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
