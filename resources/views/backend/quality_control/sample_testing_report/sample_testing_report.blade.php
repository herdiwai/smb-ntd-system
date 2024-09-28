@extends('admin.admin_dashboard')
@section('admin')

<div class="page-content">
  
    {{-- <nav class="page-breadcrumb">
        <ol class="breadcrumb">
             <a href="" class="btn btn-inverse-info btn-sm"><i data-feather="plus-square"></i> Add Report Form</a>
        </ol>
    </nav> --}}

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Sample Testing Report</h6>
                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Sample Subtmitted Date</th>
                                    <th>Doc.No</th>
                                    <th>Series</th>
                                    <th>No of samples</th>
                                    <th>status report</th>
                                    <th>Status Approvals</th>
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
                                            @if ($items->status == 'incomplete')
                                                <span class="badge bg-danger">incomplete</span>
                                            @else
                                                <span class="badge bg-success"><b>complete</b></span>
                                            @endif
                                        </td> 
                                        <td>
                                            @if($items->statusApprovals->status == 'pending')
                                                <span class="badge bg-warning"> {{ $items->statusApprovals->status }}</span>
                                            @elseif($items->statusApprovals->status == 'rejected')
                                                <span class="badge bg-danger"> {{ $items->statusApprovals->status }} </span>
                                            @else
                                                <span class="badge bg-success"> {{ $items->statusApprovals->status }} </span>
                                            @endif
                                        </td> 

                                        <td> 
                                            @if($items->status == 'incomplete')
                                                {{-- <a href="{{ route('edit.TestingRequisition', $items->id) }}" class="btn btn-inverse-warning btn-xs" title="Edit"><i data-feather="edit"></i></a> --}}
                                                <a href="{{ route('add.sampletestingreport', $items->id) }}" class="btn btn-inverse-info btn-sm" title="Add Report"><i data-feather="file-plus"></i></a>
                                            @else
                                                <p>report has been completed</p>
                                            @endif

                                            @if(Auth::user()->can('delete.testingreport'))
                                                <a href="" class="btn btn-inverse-danger btn-sm" title="Delete"><i data-feather="trash-2"></i></a>
                                            @endif

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