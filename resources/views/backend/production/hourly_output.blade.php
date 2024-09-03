@extends('admin.admin_dashboard')
@section('admin')

<div class="page-content">
  
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <a href="{{ route('add.hourlyoutput') }}" class="btn btn-inverse-info">Add Hourly Output</a>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Production Hourly Output</h6>
                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                            <tr>
                                <th>No</th>
                                    <th>PROCESS</th>
                                    <th>MODEL</th>
                                    <th>LOT</th>
                                    <th>SHIFT</th>
                                    <th>LINE</th>
                                    <th>TIME</th>
                                    <th>DATE</th>
                                    <th>TARGET</th> 
                                    <th>OUTPUT</th>
                                    <th>ACCM</th>
                                    <th>DESCRIPTION</th>
                                    <th>PIC</th>
                                    <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($pd as $key => $production)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $production->process }}</td>
                                        <td>{{ $production->model }}</td>
                                        <td>{{ $production->lot }}</td>
                                        <td>{{ $production->shift }}</td>
                                        <td>{{ $production->line }}</td>
                                        <td>{{ $production->time }}</td>
                                        <td>{{ $production->date }}</td>
                                        <td>{{ $production->target }}</td>
                                        <td>{{ $production->output }}</td>
                                        <td>{{ $production->accm }}</td>
                                        <td>{{ $production->deskription }}</td>
                                        <td>{{ $production->name }}</td>
                                        <td>
                                            <a href="{{ route('edit.hourlyoutput', $production->id) }}" class="btn btn-inverse-warning">Edit</a>
                                            <a href="" class="btn btn-inverse-daanger">Delete</a>
                                        </td>
                                    </tr>
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