@extends('admin.admin_dashboard')
@section('admin')

<div class="page-content">
  
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            {{-- @if(Auth::user()->can('add.testingrequisition')) --}}
             <a href="{{ route('add.mrr') }}" class="btn btn-inverse-info btn-xs"><i data-feather="file-plus" style="width: 16px; height: 16px;"></i> ADD MRR FORM</a>
            {{-- @endif --}}

        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Table MRR Request</h6>
                    <div class="table-responsive">
                        <table id="table" class="table">
                            <thead>
                            <tr>
                                    <th>No</th>
                                    <th>Request Dept</th>
                                    <th>Name</th>
                                    <th>To Department</th>
                                    <th>Proccess</th>
                                    <th>Equipment_no</th>
                                    <th>Description</th>
                                    <th>Model</th>
                                    <th>Shift</th> 
                                    <th>Lot</th>
                                    <th>Line</th>
                                    <th>Date</th>
                                    <th>Breakdown Time</th>
                                    <th>Report Time</th>
                                    <th>Status MRR</th>
                                    <th>Action MRR</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $key => $mrr)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $mrr->Request_dept }}</td>
                                        <td>{{ $mrr->Name }}</td>
                                        <td>{{ $mrr->To_department }}</td>
                                        <td>{{ $mrr->equipmentNo->Equipment_Name }}</td>
                                        <td>{{ $mrr->equipmentNo->Equipment_Number }}</td>
                                        <td>{{ $mrr->Description }}</td>
                                        <td>{{ $mrr->modelbrewer->model }}</td>
                                        <td>{{ $mrr->shift->shift }}</td>
                                        <td>{{ $mrr->lot->lot }}</td>
                                        <td>{{ $mrr->line->line }}</td>
                                        <td>{{ $mrr->Date_pd }}</td>
                                        <td>{{ $mrr->Breakdown_time }}</td>
                                        <td>{{ $mrr->Report_time }}</td>
                                        <td>
                                            @if($mrr->status_mrr == 'incomplete')
                                                <span class="badge bg-danger" style="color: black;"> {{ $mrr->status_mrr }} </span>
                                            @else
                                                <span class="badge bg-info" style="color: black;"> {{ $mrr->status_mrr }} </span>
                                            @endif
                                        </td>
                                        <td>
                                            {{-- <button type="button" class="btn btn-inverse-success btn-xs" data-bs-toggle="modal" data-bs-target="#resultModalMrr" onclick="openResultMrr({{ $mrr->id }})" title="AddMrr">
                                                <i data-feather="check-square" style="width: 16px; height: 16px;"></i> AddMrr
                                            </button> --}}
                                            <a href="{{ route('edit.mrrtechnician', $mrr->id ) }}" class="btn btn-inverse-warning" title="Add Mrr"><i data-feather="edit"></i></a>
                                            {{-- <a href="{{ route('delete.hourlyoutput', $production->id) }}" class="btn btn-inverse-danger" title="Delete"><i data-feather="trash-2"></i></a> --}}
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                        {{ $data->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

{{-- MODAL APPROVALS BY MANAGER --}}
<!-- Modal -->
{{-- <div class="modal fade" id="resultModalMrr" tabindex="-1" role="dialog" aria-labelledby="resultMrrModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="resultMrrModalLabel">Approval Forms</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button> --}}
          {{-- <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"> --}}
            {{-- <span aria-hidden="true">&times;</span> --}}
          {{-- </button>
        </div>
        <form id="resultFormMrr" action="" method="POST">
          @csrf
          <div class="modal-body">
            <div class="form-group">
              <label for="approval_status">Approval Status</label>
              <select name="status_approvals_id" id="approval_status" class="form-control">
                <option value="1">Approved</option>
                <option value="2">Rejected</option>
              </select>
            </div>
            <div class="form-group">
              <label for="notes">Notes</label>
              <textarea name="notes_manager" id="notes" class="form-control" rows="4" placeholder="Optional"></textarea>
            </div>
          </div>
          <div class="modal-footer"> --}}
            {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
            {{-- <button type="submit" class="btn btn-inverse-info btn-xs"><i data-feather="send" style="width: 16px; height: 16px;"></i> Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div> --}}
{{-- END MODAL APPROVALS BY MANAGER--}}

<script>
    // modal approvals Manager
    // function openResultMrr(itemId) {
    //     // Set the form action dynamically based on the item ID
    //     var actionUrl = "{{ route('update.approvalsmanager', ':id') }}";
    //     actionUrl = actionUrl.replace(':id', itemId);
    //     $('#resultFormMrr').attr('action', actionUrl);
    //     // Optionally reset the form fields when modal is opened
    //     // $('#approval_status').val('approved'); // default status
    //     // $('#notes').val('');
        
    //     // Show the modal
    //     $('#resultModalMrr').modal('show');
    // }

</script>


@endsection