@extends('admin.admin_dashboard')
@section('admin')

<div class="page-content">
  
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
             <a href="{{ route('add.sampletestingrequisition') }}" class="btn btn-inverse-info btn-sm"><i data-feather="plus-square"></i> Add Requistion Form</a>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Sample Testing Requisition</h6>
                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                            <tr>
                                    <th>No</th>
                                    <th>Sample Subtmitted Date</th>
                                    <th>Doc.No</th>
                                    <th>Series</th>
                                    <th>No of samples</th>
                                    <th>status</th>
                                    <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($testingrequisition as $key => $items)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $items->sample_subtmitted_date }}</td>
                                        <td>
                                            {{ $items->process->process }}
                                            /{{ $items->lot->lot }}
                                            /{{ $items->modelBrewer->model }}
                                            /{{ $items->date }}
                                            /{{ $items->do_no }}
                                            /{{ $items->incomming_number }} 
                                        </td>
                                        <td>{{ $items->series }}</td>
                                        <td>{{ $items->no_of_sample }}</td>
                                        <td>
                                            <span class="badge bg-danger"> {{ $items->status }} </span>
                                        </td>   
                                        <td> 
                                            <a href="{{ route('edit.TestingRequisition', $items->id) }}" class="btn btn-inverse-warning btn-xs" title="Edit"><i data-feather="edit"></i></a>
                                            <a href="" class="btn btn-inverse-danger btn-sm" title="Delete"><i data-feather="trash-2"></i></a>
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