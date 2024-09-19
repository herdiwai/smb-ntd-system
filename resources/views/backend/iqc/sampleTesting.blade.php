@extends('admin.admin_dashboard')
@section('admin')

<div class="page-content">
  
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
             <a href="{{ route('add.sampleTesting') }}" class="btn btn-inverse-info btn-sm""><i data-feather="plus-square"></i> Add Requistion Form</a>
        </ol>
    </nav>
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
             <a href="{{ route('update.sampleTesting') }}" class="btn btn-inverse-info btn-sm""><i data-feather="plus-square"></i> UpdateForm</a>
        </ol>
    </nav>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">SAMPLE TESTING REQUISITION FORM</h6>
                    <div class="table-responsive">
                        <table id="" class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>DATE</th>
                                    <th>Doc No</th>
                                    <th>Process</th>
                                    <th>Shift</th>
                                    <th>Test Purpose</th>
                                    <th>Pilot Project</th>
                                    <th>Check By</th>
                                    <th>Action</th>
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