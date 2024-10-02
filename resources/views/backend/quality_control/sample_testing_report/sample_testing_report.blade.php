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
                        <table id="serverside" class="table">
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
                                {{-- @foreach ($testingrequisition as $key => $items)
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
                                                <a href="{{ route('add.sampletestingreport', $items->id) }}" class="btn btn-inverse-info btn-sm" title="Add Report"><i data-feather="file-plus"></i></a>
                                            @elseif($items->statusApprovals->status == 'rejected')
                                            <a href="{{ route('add.sampletestingreport', $items->id) }}" class="btn btn-inverse-info btn-sm" title="Add Report"><i data-feather="file-plus"></i></a>
                                            @else
                                            <p style="color: rgb(4, 189, 4)">report has been completed</p>
                                            @endif
                                                
                                            @if(Auth::user()->can('delete.testingreport'))
                                                <a href="" class="btn btn-inverse-danger btn-sm" title="Delete"><i data-feather="trash-2"></i></a>
                                            @endif

                                        </td> 
                                    </tr>
                                @endforeach --}}

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready( function() {
            loadData();
        });
        function loadData() {
            $('#serverside').DataTable({
                pageLength: 5,
                lengthMenu: [ [5, 10, 25, 50, -1], [5, 10, 25, 50, "All"] ],
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
                ajax:{
                    url:"{{ route('qualitycontrol.sampletestingreport') }}",
                },
                columns:[
                    {
                        data: 'no',
                        name: 'no',
                    },
                    {
                        data: 'Sample Submitted Date',
                        name: 'sample_submitted_date',
                    },
                    {
                        data: 'Doc.No',
                        name: 'doc_no',
                    },
                    {
                        data: 'series',
                        name: 'series',
                    },
                    {
                        data: 'no_of_sample',
                        name: 'no_of_sample',
                    },
                    {
                        data: 'status_report',
                        name: 'status_report',
                    },
                    {
                        data: 'status_approvals',
                        name: 'status_approvals',
                    },
                    {
                        data: 'action',
                        name: 'action',
                    },
                ],
            });
        }

    </script>


</div>
@endsection