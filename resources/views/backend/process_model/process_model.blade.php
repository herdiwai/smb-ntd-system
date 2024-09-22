@extends('admin.admin_dashboard')
@section('admin')

<div class="page-content">
  
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            {{-- <a href="{{ route('add.hourlyoutput') }}" class="btn btn-inverse-info btn-sm""><i data-feather="plus-square"></i> Add Hourly Output</a> --}}
        </ol>
    </nav>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Process Model</h6>
                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                            <tr>
                                    <th>No</th>
                                    <th>PROCESS</th>
                                    <th>MODEL</th>
                                    <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($pm as $key => $proccessmodel)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $proccessmodel->process }}</td>
                                        <td>{{ $proccessmodel->model }}</td>
                                        <td>
                                            <a href="{{ route('edit.processmodel', $proccessmodel->id) }}" class="btn btn-inverse-warning" title="Edit"><i data-feather="edit"></i></a>
                                            {{-- <a href="{{ route('delete.hourlyoutput', $production->id) }}" class="btn btn-inverse-danger" title="Delete"><i data-feather="trash-2"></i></a> --}}
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