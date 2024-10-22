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
                                    <th>Action Techinician</th>
                                    <th>Action QC</th>
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
                                            <a href="{{ route('edit.mrrtechnician', $mrr->id ) }}" class="btn btn-inverse-warning btn-xs" title="Add Mrr"><i data-feather="edit" style="width: 16px; height: 16px;"></i></a>
                                            {{-- <a href="{{ route('delete.hourlyoutput', $production->id) }}" class="btn btn-inverse-danger" title="Delete"><i data-feather="trash-2"></i></a> --}}
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-inverse-success btn-xs" data-bs-toggle="modal" data-bs-target="#qcAccepted" onclick="openQcAccepted({{ $mrr->id }})" title="AddMrr">
                                                <i data-feather="check-square" style="width: 16px; height: 16px;"></i>
                                            </button>
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

{{-- MODAL QC ACCEPTED --}}
<div class="modal fade" id="qcAccepted" tabindex="-1" role="dialog" aria-labelledby="qcAcceptedModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="qcAcceptedModalLabel">QC Final Accepted Form</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
          {{-- <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"> --}}
            {{-- <span aria-hidden="true">&times;</span> --}}
          </button> 
        </div>
        <form id="qcFormAccepted" action="" method="POST">
          @csrf
          <div class="modal-body">

            <div class="row">
              <div class="col-md-6 mb-3">
                <div class="form-group">
                    <div class="form-row align-items-center">
                        <div class="col-sm">
                            <label for="Qc_start_time" class="col-form-label col-form-label-sm"><b>Qc Start Time</b></label>
                        </div>
                        <div class="col">
                            <input type="time" class="form-control form-control-sm" name="Qc_start_time" id="Qc_start_time" >
                        </div>
                    </div>
                </div>
            </div>
              <div class="col-md-6 mb-3">
                <div class="form-group">
                    <div class="form-row align-items-center">
                        <div class="col-sm">
                            <label for="Qc_end_time" class="col-form-label col-form-label-sm"><b>Qc End Time</b></label>
                        </div>
                        <div class="col">
                            <input type="time" class="form-control form-control-sm" name="Qc_end_time" id="Qc_end_time" >
                        </div>
                    </div>
                </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6 mb-3">
              <div class="form-group">
                  <div class="form-row align-items-center">
                      <div class="col-sm">
                          <label for="Qc_name_sign" class="col-form-label col-form-label-sm"><b>Qc Sign</b></label>
                      </div>
                      <div class="col">
                          <input type="text" class="form-control form-control-sm" name="Qc_name_sign" id="Qc_name_sign" >
                      </div>
                  </div>
              </div>
          </div>
            <div class="col-md-6 mb-3">
              <div class="form-group">
                  <div class="form-row align-items-center">
                      <div class="col-sm">
                          <label for="Date_qc" class="col-form-label col-form-label-sm"><b>Date</b></label>
                      </div>
                      <div class="col">
                          <input type="date" class="form-control form-control-sm" name="Date_qc" id="Date_qc" >
                      </div>
                  </div>
              </div>
          </div>
        </div>

          <div class="modal-footer">
            {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
            <button type="submit" class="btn btn-inverse-info btn-xs"><i data-feather="send" style="width: 16px; height: 16px;"></i> Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>
{{-- END MODAL QC ACCEPTED--}}

<script>
    // Mode QC Accepted
    function openQcAccepted(itemId) {
        // Set the form action dynamically based on the item ID
        var actionUrl = "{{ route('update.qc', ':id') }}";
        actionUrl = actionUrl.replace(':id', itemId);
        $('#qcFormAccepted').attr('action', actionUrl);
        // Optionally reset the form fields when modal is opened
        // $('#approval_status').val('approved'); // default status
        // $('#notes').val('');
        
        // Show the modal
        $('#qcAccepted').modal('show');
    }

</script>


@endsection