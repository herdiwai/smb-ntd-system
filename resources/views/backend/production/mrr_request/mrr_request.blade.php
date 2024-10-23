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

    {{-- @php
        $id = Auth::user()->id;
        $profileData = App\Models\User::find($id);
    @endphp --}}

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
                                    <th hidden>Sign Spv pd</th>
                                    <th hidden>Judgement</th>
                                    <th hidden>Response_time</th>


                                    <th>Status MRR</th>
                                    <th>View Detail</th>
                                    <th>Action Spv PD</th>
                                    <th>Action Techinician</th>
                                    <th>Action QC</th>
                                    <th>Export to PDF</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $key => $mrr)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td class="request-dept">{{ $mrr->Request_dept }}</td>
                                        <td class="name">{{ $mrr->Name }}</td>
                                        <td class="to_department">{{ $mrr->To_department }}</td>
                                        <td class="process">{{ $mrr->equipmentNo->Equipment_Name }}</td>
                                        <td class="equipment_no">{{ $mrr->equipmentNo->Equipment_Number }}</td>
                                        <td class="description">{{ $mrr->Description }}</td>
                                        <td class="model">{{ $mrr->modelbrewer->model }}</td>
                                        <td class="shift">{{ $mrr->shift->shift }}</td>
                                        <td class="lot">{{ $mrr->lot->lot }}</td>
                                        <td class="line">{{ $mrr->line->line }}</td>
                                        <td class="date">{{ $mrr->Date_pd }}</td>
                                        <td class="breakdown_time">{{ $mrr->Breakdown_time }}</td>
                                        <td class="report_time">{{ $mrr->Report_time }}</td>
                                        {{-- Status Sign Spv Production --}}
                                        @if($mrr->Status_approvals_id_spv_pd == '3')
                                            <td class="sign_spv_pd" hidden>Pending</td>
                                        @else
                                            <td class="sign_spv_pd" hidden>{{ $mrr->Note_spv_pd  }}</td>
                                        @endif
                                        {{-- End Status Sign Spv Production --}}
                                        {{-- Status judgement --}}
                                        @if($mrr->Judgement == '')
                                            <td class="judgement" hidden><p class="text-secondary">no record</p></td>
                                        @else
                                            <td class="judgement" hidden>{{ $mrr->Judgement }}</td>
                                        @endif
                                        {{-- End Status judgement --}}
                                        {{-- Status Response_time --}}
                                        @if($mrr->Response_time == '')
                                            <td class="Response_time" hidden><p class="text-secondary">no record</p></td>
                                        @else
                                            <td class="Response_time" hidden>{{ $mrr->Response_time }}</td>
                                        @endif
                                        {{-- End Status Response_time --}}
                                        <td>
                                            @if($mrr->status_mrr == 'incomplete')
                                                <span class="badge bg-danger" style="color: black;"> {{ $mrr->status_mrr }} </span>
                                            @else
                                                <span class="badge bg-info" style="color: black;"> {{ $mrr->status_mrr }} </span>
                                            @endif
                                        </td>
                                        <td><button type="button" class="btn btn-inverse-primary btn-xs view-details" data-bs-toggle="modal" data-bs-target="#varyingModal" data-id="'.$mrr->id.'" title="View Detail"><i data-feather="eye" style="width: 16px; height: 16px;"></i></button></td>
                                        <td>
                                            <button type="button" class="btn btn-inverse-success btn-xs" data-bs-toggle="modal" data-bs-target="#signModalSpv" onclick="openSignSpv({{ $mrr->id }})" title="Sign">
                                                <i data-feather="check-square" style="width: 16px; height: 16px;"></i>
                                            </button>
                                        </td>
                                        <td>
                                            {{-- <button type="button" class="btn btn-inverse-success btn-xs" data-bs-toggle="modal" data-bs-target="#resultModalMrr" onclick="openResultMrr({{ $mrr->id }})" title="AddMrr">
                                                <i data-feather="check-square" style="width: 16px; height: 16px;"></i> AddMrr
                                            </button> --}}
                                            <a href="{{ route('edit.mrrtechnician', $mrr->id ) }}" class="btn btn-inverse-warning btn-xs" title="Add Mrr"><i data-feather="edit" style="width: 16px; height: 16px;"></i></a>
                                            {{-- <a href="{{ route('delete.hourlyoutput', $production->id) }}" class="btn btn-inverse-danger" title="Delete"><i data-feather="trash-2"></i></a> --}}
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-inverse-info btn-xs" data-bs-toggle="modal" data-bs-target="#qcAccepted" onclick="openQcAccepted({{ $mrr->id }})" title="Sign">
                                                <i data-feather="check-square" style="width: 16px; height: 16px;"></i>
                                            </button>
                                        </td>
                                        <td><a href="{{ route('mrr.export-pdf', $mrr->id ) }}" class="btn btn-inverse-success btn-xs" title="Export-PDF"><i data-feather="download" style="width: 16px; height: 16px;"></i> PDF</a></td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                        {{ $data->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>


{{-- MODAL QC ACCEPTED --}}
<div class="modal fade" id="qcAccepted" tabindex="-1" role="dialog" aria-labelledby="qcAcceptedModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="qcAcceptedModalLabel">QC Form</h5>
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
</div>


{{-- MODAL SIGN SPV --}}
<div class="modal fade" id="signModalSpv" tabindex="-1" role="dialog" aria-labelledby="signModalSpvModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="signModalSpvModalLabel">Sign Form Spv</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
          {{-- <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"> --}}
            {{-- <span aria-hidden="true">&times;</span> --}}
          </button> 
        </div>
        <form id="signFormSpv" action="" method="POST">
          @csrf
          <div class="modal-body">

            <div class="row">
              <div class="col-md-6 mb-3">
                <div class="form-group">
                    <div class="form-row align-items-center">
                        <div class="col-sm">
                            <label for="Qc_start_time" class="col-form-label col-form-label-sm"><b>Sign</b></label>
                        </div>
                        <div class="col">
                            <select name="Status_approvals_id_spv_pd" id="approval_status" class="form-select form-select-sm">
                                <option value="1">approved</option>
                                <option value="2">rejected</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="form-group">
                    <div class="form-row align-items-center">
                        <div class="col-sm">
                            <label for="Note_spv_pd" class="col-form-label col-form-label-sm"><b>Name</b></label>
                        </div>
                        <div class="col">
                            <input type="text" class="form-control form-control-sm" name="Note_spv_pd" id="Note_spv_pd" >
                        </div>
                    </div>
                </div>
            </div>
            {{-- Data untuk note spv_pd sementara masuk di kolom Note_spv_mt --}}
          <div class="form-group mb-3" id="other_purpose">
            <label for="Note_spv_mt"><b>Note:</b></label>
            <textarea class="form-control" id="Note_spv_mt" name="Note_spv_mt" rows="2" placeholder=""></textarea>
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
{{-- END MODAL Sign SPV--}}
</div>


{{-- MODAL VIEW DETAIL --}}
<div class="modal fade" id="varyingModal" tabindex="-1" role="dialog" aria-labelledby="varyingModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="varyingModalLabel">Sign Form Spv</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
          {{-- <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"> --}}
            {{-- <span aria-hidden="true">&times;</span> --}}
          </button> 
        </div>
        <form action="" method="POST">
          <div class="modal-body">

            <div class="row">
              <div class="col-md-6 mb-3">
                <div class="form-group">
                    <div class="form-row align-items-center">
                        <div class="col-sm">
                            <label for="request_dept" class="col-form-label col-form-label-sm request_dept"><b>Request Dept</b></label>
                        </div>
                        <div class="col">
                            <input type="text" class="form-control form-control-sm request_dept" id="request_dept" disabled>
                        </div>
                    </div>
                </div>
            </div>
              <div class="col-md-6 mb-3">
                <div class="form-group">
                    <div class="form-row align-items-center">
                        <div class="col-sm">
                            <label for="model" class="col-form-label col-form-label-sm model"><b>Model</b></label>
                        </div>
                        <div class="col">
                            <input type="text" class="form-control form-control-sm model" id="model" disabled>
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
                            <label for="name" class="col-form-label col-form-label-sm name"><b>Name</b></label>
                        </div>
                        <div class="col">
                            <input type="text" class="form-control form-control-sm name" id="name" disabled>
                        </div>
                    </div>
                </div>
            </div>
              <div class="col-md-6 mb-3">
                <div class="form-group">
                    <div class="form-row align-items-center">
                        <div class="col-sm">
                            <label for="shift" class="col-form-label col-form-label-sm shift"><b>Shift</b></label>
                        </div>
                        <div class="col">
                            <input type="text" class="form-control form-control-sm shift" id="shift" disabled>
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
                          <label for="to_department" class="col-form-label col-form-label-sm to_department"><b>To Department</b></label>
                      </div>
                      <div class="col">
                          <input type="text" class="form-control form-control-sm to_department" id="to_department" disabled>
                      </div>
                  </div>
              </div>
          </div>
            <div class="col-md-6 mb-3">
              <div class="form-group">
                  <div class="form-row align-items-center">
                      <div class="col-sm">
                          <label for="lot" class="col-form-label col-form-label-sm lot"><b>Lot</b></label>
                      </div>
                      <div class="col">
                          <input type="text" class="form-control form-control-sm lot" id="lot" disabled>
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
                          <label for="process" class="col-form-label col-form-label-sm process"><b>Process</b></label>
                      </div>
                      <div class="col">
                          <input type="text" class="form-control form-control-sm process" id="process" disabled>
                      </div>
                  </div>
              </div>
          </div>
            <div class="col-md-6 mb-3">
              <div class="form-group">
                  <div class="form-row align-items-center">
                      <div class="col-sm">
                          <label for="line" class="col-form-label col-form-label-sm line"><b>Line</b></label>
                      </div>
                      <div class="col">
                          <input type="text" class="form-control form-control-sm line" id="line" disabled>
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
                          <label for="equipment_no" class="col-form-label col-form-label-sm equipment_no"><b>Equipment No</b></label>
                      </div>
                      <div class="col">
                          <input type="text" class="form-control form-control-sm equipment_no" id="equipment_no" disabled>
                      </div>
                  </div>
              </div>
          </div>
            <div class="col-md-6 mb-3">
              <div class="form-group">
                  <div class="form-row align-items-center">
                      <div class="col-sm">
                          <label for="date" class="col-form-label col-form-label-sm date"><b>Date</b></label>
                      </div>
                      <div class="col">
                          <input type="text" class="form-control form-control-sm date" id="date" disabled>
                      </div>
                  </div>
              </div>
          </div>
          <div class="form-group mb-3" id="other_purpose">
            <label for="description"><b>Description:</b></label>
            <textarea class="form-control description" id="description" rows="2" placeholder="" disabled></textarea>
        </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
              <div class="form-group">
                  <div class="form-row align-items-center">
                      <div class="col-sm">
                          <label for="breakdown_time" class="col-form-label col-form-label-sm breakdown_time"><b>Breakdown Time</b></label>
                      </div>
                      <div class="col">
                          <input type="text" class="form-control form-control-sm breakdown_time" id="breakdown_time" disabled>
                      </div>
                  </div>
              </div>
          </div>
            <div class="col-md-6 mb-3">
              <div class="form-group">
                  <div class="form-row align-items-center">
                      <div class="col-sm">
                          <label for="report_time" class="col-form-label col-form-label-sm report_time"><b>Report Time</b></label>
                      </div>
                      <div class="col">
                          <input type="text" class="form-control form-control-sm report_time" id="report_time" disabled>
                      </div>
                  </div>
              </div>
          </div>
            <div class="col-md-6 mb-3">
              <div class="form-group">
                  <div class="form-row align-items-center">
                      <div class="col-sm">
                          <label for="sign_spv_pd" class="col-form-label col-form-label-sm sign_spv_pd"><b>Sign Spv</b></label>
                      </div>
                      <div class="col">
                          <input type="text" class="form-control form-control-sm sign_spv_pd" id="sign_spv_pd" disabled>
                      </div>
                  </div>
              </div>
          </div>
        </div>

        <b><hr></b>
        <h4 style="text-align: center;">RESULT</h4>
        <b><hr></b>

        <div class="row">
                                
            <div class="col-md-6 mb-3">
                <div class="form-group">
                    <div class="form-row align-items-center">
                        <div class="col-sm">
                            <label for="judgement" class="col-form-label col-form-label-sm"><b>Judgement</b></label>
                        </div>
                        <div class="col">
                            <input type="text" class="form-control form-control-sm judgement" id="judgement" disabled>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="form-group">
                    <div class="form-row align-items-center">
                        <div class="col-sm">
                            <label for="Response_time" class="col-form-label col-form-label-sm"><b>Response Time</b></label>
                        </div>
                        <div class="col">
                            <input type="text" class="form-control form-control-sm Response_time" id="Response_time" disabled>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="form-group mb-3" id="other_purpose">
                <label for="Issue"><b>Issue:</b></label>
                <textarea class="form-control" id="Issue" name="Issue" rows="5" placeholder=""></textarea>
            </div>
            <div class="form-group mb-3" id="other_purpose">
                <label for="Root_cause"><b>Root Cause:</b></label>
                <textarea class="form-control" id="Root_cause" name="Root_cause" rows="5" placeholder=""></textarea>
            </div>
            <div class="form-group mb-3" id="other_purpose">
                <label for="Action"><b>Action:</b></label>
                <textarea class="form-control" id="Action" name="Action" rows="5" placeholder=""></textarea>
            </div>
        </div> 



        </form>
      </div>
    </div>
  </div>
{{-- END MODAL Sign SPV--}}




</div>



<script type="text/javascript">
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

    // Mode Sign Spv Production
    function openSignSpv(itemId) {
        // Set the form action dynamically based on the item ID
        var actionUrl = "{{ route('update.signspv', ':id') }}";
        actionUrl = actionUrl.replace(':id', itemId);
        $('#signFormSpv').attr('action', actionUrl);
        // Optionally reset the form fields when modal is opened
        // $('#approval_status').val('approved'); // default status
        // $('#notes').val('');
        
        // Show the modal
        $('#signModalSpv').modal('show');
    }

    $(document).on('click','.view-details', function(){
        var _this = $(this).parents('tr');
            $('.request_dept').val(_this.find('.request-dept').text());
            $('.model').val(_this.find('.model').text());
            $('.name').val(_this.find('.name').text());
            $('.shift').val(_this.find('.shift').text());
            $('.to_department').val(_this.find('.to_department').text());
            $('.lot').val(_this.find('.lot').text());
            $('.process').val(_this.find('.process').text());
            $('.line').val(_this.find('.line').text());
            $('.equipment_no').val(_this.find('.equipment_no').text());
            $('.date').val(_this.find('.date').text());
            $('.description').val(_this.find('.description').text());
            $('.breakdown_time').val(_this.find('.breakdown_time').text());
            $('.report_time').val(_this.find('.report_time').text());
            $('.sign_spv_pd').val(_this.find('.sign_spv_pd').text());
            $('.judgement').val(_this.find('.judgement').text());
            $('.Response_time').val(_this.find('.Response_time').text());
            // $('.status_report').val(_this.find('.status_report').text());
            // $('.status_approvals_spv').val(_this.find('.status_approvals_spv').text());
            // $('.status_approvals_manager').val(_this.find('.status_approvals_manager').text());
            // $('.qe_review').val(_this.find('.qe_review').text());
            // $('.notes_qe_iqc').val(_this.find('.notes_qe_iqc').text());
            // $('.notes_qe_qca').val(_this.find('.notes_qe_qca').text());
    });

</script>


@endsection