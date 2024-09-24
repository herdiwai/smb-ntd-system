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
                                    <th>Summary After</th>
                                    <th>Schedule of Test</th>
                                    <th>Est of Completion Date</th>
                                    <th>Result Test</th>
                                    <th>Approval Status</th>
                                    <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($testingreport as $key => $items)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $items->summary_after }}</td>
                                        <td>{{ $items->schedule_of_test }}</td>
                                        <td>{{ $items->est_of_completion_date }}</td>
                                        <td>{{ $items->result_test }}</td>
                                        <td></td>
                                        <td>
                                            <!-- Form approval -->
                                            <form action="{{ route('store.approvals', $items->id) }}" method="POST">
                                                @csrf
                                                @method('POST')

                                                <select name="approvals_status" required>
                                                    <option value="approved">Setujui</option>
                                                    <option value="rejected">Tolak</option>
                                                </select>
                                                
                                                <input type="text" name="notes" placeholder="Catatan (opsional)">
                                                
                                                <button type="submit">Simpan</button>
                                        </td>
                                        
                                        {{-- <td>  --}}
                                            {{-- <a href="{{ route('edit.TestingRequisition', $items->id) }}" class="btn btn-inverse-warning btn-xs" title="Edit"><i data-feather="edit"></i></a> --}}
                                            {{-- <a href="{{ route('add.sampletestingreport', $items->id) }}" class="btn btn-inverse-info btn-sm" title="Add Report"><i data-feather="file-plus"></i></a>
                                            <a href="" class="btn btn-inverse-danger btn-sm" title="Delete"><i data-feather="trash-2"></i></a> --}}
                                        {{-- </td>  --}}
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