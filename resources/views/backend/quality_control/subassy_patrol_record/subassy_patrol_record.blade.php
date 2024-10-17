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
                                    <th>LINE</th>
                                    <th>SHIFT</th>
                                    <th>LOT</th>
                                    <th>INSPECTED BY</th>
                                    <th>REVIEWED BY</th>
                                    <th>STATUS</th>
                                    <th>ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($inspectioncheckresult as $key => $items)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $items->date }}</td>
                                        <td>{{ $items->modelBrewer->model }}</td>
                                        <td>{{ $items->product_name }}</td>
                                        <td>{{ $items->production_unit }}</td>
                                        <td>{{ $items->line }}</td>
                                        <td>{{ $items->shifts->shift }}</td>
                                        <td>{{ $items->lots->lot }}</td>
                                        <td>{{ $items->inspected_by }}</td>
                                        <td>{{ $items->reviewed_by }}</td> 
                                        <td>
                                            @if ($items->status == 'incomplete')
                                                <span class="badge bg-danger">incomplete</span>
                                            @else
                                                <span class="badge bg-success"><b>complete</b></span>
                                            @endif
                                        </td> 
                                        <td> 
                                            <a href="{{ route('edit.ProcessPatrol', $items->id) }}" class="btn btn-inverse-warning btn-xs" title="Edit"><i data-feather="edit"></i></a>
                                            <a href="{{ route('delete.ProcessPatrol', $items->id) }}" class="btn btn-inverse-danger btn-sm" title="Delete"><i data-feather="trash-2"></i></a>
                                            <a href="{{ route('detail.ProcessPatrol', $items->id) }}" class="btn btn-inverse-primary btn-xs" title="Detail"><i data-feather="eye"></i></a>   
                                            <a href="{{ route('pdf.ProcessPatrol', $items->id) }}" class="btn btn-inverse-info btn-xs" title="Detail"><i data-feather="download"></i></a>
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
