@extends('admin.admin_dashboard')
@section('admin')

<div class="page-content">
  
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            @if(Auth::user()->can('add.Mrr'))
                <a href="{{ route('add.mrr') }}" class="btn btn-inverse-info btn-xs"><i data-feather="file-plus" style="width: 16px; height: 16px;"></i> ADD MRR FORM</a>
            @endif

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
                                    <th>Date</th>
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
                                    <th>Breakdown Time</th>
                                    <th>Report Time</th>
                                    <th hidden>Sign Spv pd</th>
                                    <th hidden>Judgement</th>
                                    <th hidden>Response_time</th>
                                    <th hidden>Issue</th>
                                    <th hidden>Root Cause</th>
                                    <th hidden>Action</th>
                                    <th hidden>Repair Start Time</th>
                                    <th hidden>Repair End Time</th>
                                    <th hidden>Qc Start Time</th>
                                    <th hidden>Qc End Time</th>
                                    <th hidden>Qc Sign</th>
                                    <th hidden>Date Qc</th>
                                    <th hidden>PD Sign</th>
                                    <th hidden>Date PD</th>


                                    <th>Status MRR</th>
                                    <th>View Detail</th>
                                    @if(Auth::user()->can('sign.mrrSpv'))
                                        <th>Action Spv PD</th>
                                    @endif
                                    @if(Auth::user()->can('edit.mrrtechnician'))
                                        <th>Action Techinician</th>
                                    @endif
                                    @if(Auth::user()->can('sign.mrrQc'))
                                        <th>Action QC</th>
                                    @endif
                                    @if(Auth::user()->can('edit.correction.production'))
                                        <th>Edit Mrr</th>
                                    @endif
                                    @if(Auth::user()->can('column.mrrtechnician'))
                                        <th>Correction NTD</th>
                                    @endif
                                    @if(Auth::user()->can('column.correctionMT'))
                                        <th>Correction MT</th>
                                    @endif
                                    <th>Export to PDF</th>
                                    @if(Auth::user()->can('column.deleteMrr'))
                                        <th>Action</th>
                                    @endif
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $key => $mrr)
                                    <tr>
                                        <td>{{ $key+1 + ($data->currentPage() - 1) * $data->perPage() }}</td>
                                        <td class="date">{{ $mrr->Date_pd }}</td>
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
                                        <td class="breakdown_time">{{ $mrr->Breakdown_time }}</td>
                                        <td class="report_time">{{ $mrr->Report_time }}</td>
                                        {{-- Status Sign Spv Production --}}
                                        @if($mrr->Status_approvals_id_spv_pd == '3')
                                            <td class="sign_spv_pd" hidden>Pending</td>
                                        @else
                                            {{-- Nama sign sementara diambil dari kolom Note_spv_pd --}}
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
                                    
                                        @if($mrr->Issue == '' )
                                            <td class="issue" hidden><p class="text-secondary">no record</p></td>
                                        @else
                                            <td class="issue" hidden>{{ $mrr->Issue }}</td>
                                        @endif

                                        @if($mrr->Root_cause == '')
                                            <td class="root_cause" hidden><p class="text-secondary">no record</p></td>
                                        @else
                                            <td class="root_cause" hidden>{{ $mrr->Root_cause }}</td>
                                        @endif

                                        @if($mrr->Action == '')
                                            <td class="action" hidden><p class="text-secondary">no record</p></td>
                                        @else
                                            <td class="action" hidden>{{ $mrr->Action }}</td>
                                        @endif

                                        @if($mrr->Repair_start_time == '')
                                            <td class="repair_start" hidden><p class="text-secondary">no record</p></td>
                                        @else
                                            <td class="repair_start" hidden>{{ $mrr->Repair_start_time }}</td>
                                        @endif

                                        @if($mrr->Repair_end_time == '')
                                            <td class="repair_end" hidden><p class="text-secondary">no record</p></td>
                                        @else
                                            <td class="repair_end" hidden>{{ $mrr->Repair_end_time }}</td>
                                        @endif

                                        @if($mrr->Qc_start_time == '')
                                            <td class="qc_start" hidden><p class="text-secondary">no record</p></td>
                                        @else
                                            <td class="qc_start" hidden>{{ $mrr->Qc_start_time }}</td>
                                        @endif

                                        @if($mrr->Qc_end_time == '')
                                            <td class="qc_end" hidden><p class="text-secondary">no record</p></td>
                                        @else
                                            <td class="qc_end" hidden>{{ $mrr->Qc_end_time }}</td>
                                        @endif

                                        @if($mrr->Qc_name_sign == '')
                                            <td class="qc_sign" hidden><p class="text-secondary">no record</p></td>
                                        @else
                                            <td class="qc_sign" hidden>{{ $mrr->Qc_name_sign }}</td>
                                        @endif

                                        @if($mrr->Date_qc == '')
                                            <td class="date_qc" hidden><p class="text-secondary">no record</p></td>
                                        @else
                                            <td class="date_qc" hidden>{{ $mrr->Date_qc }}</td>
                                        @endif

                                        @if($mrr->Name == '')
                                            <td class="pd_sign" hidden><p class="text-secondary">no record</p></td>
                                        @else
                                            <td class="pd_sign" hidden>{{ $mrr->Name }}</td>
                                        @endif

                                        @if($mrr->Date_pd == '')
                                            <td class="date_pd" hidden><p class="text-secondary">no record</p></td>
                                        @else
                                            <td class="date_pd" hidden>{{ $mrr->Date_pd }}</td>
                                        @endif

                                        <td>
                                            @if($mrr->status_mrr == '25')
                                                {{-- <span class="badge bg-danger" style="color: black;"> {{ $mrr->status_mrr }} </span> --}}
                                                <div class="progress">
                                                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-danger" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" title="25%"><strong class="text-dark">25%</strong></div>
                                                </div>
                                            @elseif($mrr->status_mrr == '50')
                                                <div class="progress">
                                                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-primary" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" title="50%"><strong class="text-dark">50%</strong></div>
                                                </div>
                                            @elseif($mrr->status_mrr == '75')
                                                <div class="progress">
                                                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-info" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" title="75%"><strong class="text-dark">75%</strong></div>
                                                </div>
                                            @else
                                                {{-- <span class="badge bg-info" style="color: black;"> {{ $mrr->status_mrr }} </span> --}}
                                                <div class="progress">
                                                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" title="100%"><strong class="text-dark">100%</strong></div>
                                                </div>
                                            @endif
                                        </td>
                                        <td><button type="button" class="btn btn-inverse-primary btn-xs view-details" data-bs-toggle="modal" data-bs-target="#varyingModal" data-id="'.$mrr->id.'" title="View Detail"><i data-feather="eye" style="width: 16px; height: 16px;"></i></button></td>
                                        
                                        @if(Auth::user()->can('sign.mrrSpv'))
                                            @if($mrr->Status_approvals_id_spv_pd == '3' OR $mrr->Status_approvals_id_spv_pd == '2')
                                                <td>
                                                    <button type="button" class="btn btn-inverse-success btn-xs" data-bs-toggle="modal" data-bs-target="#signModalSpv" onclick="openSignSpv({{ $mrr->id }})" title="Sign">
                                                        <i data-feather="check-square" style="width: 16px; height: 16px;"></i>
                                                    </button>
                                                </td>
                                            @elseif($mrr->Status_approvals_id_spv_pd == '1')
                                                <td><p class="text-success">DONE</p></td>
                                            @endif
                                        @endif

                                        @if(Auth::user()->can('edit.mrrtechnician'))
                                            @if($mrr->Status_approvals_id_spv_pd == 3)
                                                <td><p class="text-warning">waiting for spv sign</p></td>
                                            @elseif($mrr->status_mrr == '50')
                                                <td>
                                                    <a href="{{ route('edit.mrrtechnician', $mrr->id ) }}" class="btn btn-inverse-warning btn-xs" title="Add Mrr"><i data-feather="edit" style="width: 16px; height: 16px;"></i></a>
                                                </td>
                                             @elseif($mrr->Status_approvals_id_spv_ntd == '1')
                                                <td><p class="text-success">DONE</p></td>
                                            @endif
                                        @endif

                                        @if(Auth::user()->can('sign.mrrQc'))
                                            @if($mrr->Status_approvals_id_spv_ntd == '' OR $mrr->Status_approvals_id_spv_ntd == 3 OR $mrr->Status_approvals_id_spv_ntd == 2)
                                                <td><p class="text-warning">waiting for ntd/mt sign</p></td>
                                            @elseif($mrr->Status_approvals_id_qc == '3' OR $mrr->Status_approvals_id_qc == '2' OR $mrr->Status_approvals_id_qc == '')
                                                <td>
                                                    <button type="button" class="btn btn-inverse-info btn-xs" data-bs-toggle="modal" data-bs-target="#qcAccepted" onclick="openQcAccepted({{ $mrr->id }})" title="Sign">
                                                        <i data-feather="check-square" style="width: 16px; height: 16px;"></i>
                                                    </button>
                                                </td>
                                            @elseif($mrr->Status_approvals_id_qc == 1)
                                                <td><p class="text-success">DONE</p></td>
                                            @endif
                                        @endif

                                        @if(Auth::user()->can('edit.correction.production'))
                                            @if($mrr->Note_spv_ntd == '')
                                                <td><p class="text-secondary">nothing to edit</p></td>
                                            @elseif($mrr->Note_spv_ntd == true)
                                                <td>
                                                    <a href="{{ route('edit.mrrproduction', $mrr->id ) }}" class="btn btn-inverse-warning btn-xs" title="Edit Mrr"><i data-feather="edit" style="width: 16px; height: 16px;"></i></a>
                                                </td>
                                            @endif
                                        @endif
                                        
                                        @if(Auth::user()->can('column.mrrtechnician'))
                                            @if($mrr->Note_spv_ntd == '')
                                                <td><p class="text-secondary">no record</p></td>
                                            @else
                                                <td><p class="text-danger">{{ $mrr->Note_spv_ntd }}</p></td>
                                            @endif
                                        @endif

                                        @if(Auth::user()->can('column.correctionMT'))
                                            @if($mrr->Note_spv_mt == '')
                                                <td><p class="text-secondary">no record</p></td>
                                            @else
                                                <td><p class="text-danger">{{ $mrr->Note_spv_mt }}</p></td>
                                            @endif
                                        @endif

                                        @if($mrr->Status_approvals_id_qc == '3' OR $mrr->Status_approvals_id_qc == '2' OR $mrr->Status_approvals_id_qc == '')
                                            <td><p class="text-danger">status mrr not complete</p></td>
                                        @elseif($mrr->Status_approvals_id_qc == '1')
                                            <td><a href="{{ route('mrr.export-pdf', $mrr->id ) }}" class="btn btn-inverse-success btn-xs" title="Export-PDF"><i data-feather="download" style="width: 16px; height: 16px;"></i> PDF</a></td>
                                        @endif
                                        
                                        @if(Auth::user()->can('column.deleteMrr'))
                                            <td>
                                                <a href="{{ route('delete.mrr', $mrr->id ) }}" class="btn btn-inverse-danger btn-xs" title="Delete Mrr"><i data-feather="trash-2" style="width: 16px; height: 16px;"></i></a>
                                            </td>
                                        @endif
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
          <h5 class="modal-title" id="qcAcceptedModalLabel">QC SIGN MRR FORM</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
          {{-- <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"> --}}
            {{-- <span aria-hidden="true">&times;</span> --}}
          </button> 
        </div>
        <form id="qcFormAccepted" class="myForm" action="" method="POST">
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
                          <label for="Qc_name_sign" class="col-form-label col-form-label-sm"><b>Qc Name</b></label>
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

          {{-- <div class="form-group mb-3"> --}}
            {{-- <label for="test-purpose" class="form-label form-label-sm"><b>Sign</b></label> --}}

            {{-- <div class="row mb-3">
                <!-- Checkbox Group 1 -->                               
                <div class="col-md-6 d-flex align-items-center">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="quatationSample" value="1" name="Status_approvals_id_qc">
                        <label class="form-check-label me-2" for="quatationSample">Confirm</label>
                    </div>
                </div>
                <div class="col-md-6 d-flex align-items-center">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="quatationSample" value="2" name="Status_approvals_id_qc">
                        <label class="form-check-label me-2" for="quatationSample">Correction</label>
                    </div>
                </div>
            </div>
          </div> --}}
          <div class="form-group mb-3" id="other_purpose">
            <label for="Note_qc"><b>Note:</b></label>
            <textarea class="form-control" id="Note_qc" name="Note_qc" rows="2" placeholder="if any correction.."></textarea>
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
        <form id="signFormSpv" class="myForm2" action="" method="POST">
          @csrf
          <div class="modal-body">

            <div class="row">
              {{-- <div class="col-md-6 mb-3">
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
            </div> --}}
            <div class="col-md-12 mb-3">
                <div class="form-group">
                    <div class="form-row align-items-center">
                        <div class="col-sm">
                            {{-- Data untuk Name sementara masuk di kolom Note_spv_pd --}}
                            <label for="Note_spv_pd" class="col-form-label col-form-label-sm"><b>Name</b></label>
                        </div>
                        <div class="col">
                            <input type="text" class="form-control form-control-sm" name="Note_spv_pd" id="Note_spv_pd" >
                        </div>
                    </div>
                </div>
            </div>
            {{-- Data untuk note spv_pd sementara masuk di kolom Note_spv_mt --}}
          {{-- <div class="form-group mb-3" id="other_purpose">
            <label for="Note_spv_mt"><b>Note:</b></label>
            <textarea class="form-control" id="Note_spv_mt" name="Note_spv_mt" rows="2" placeholder=""></textarea>
        </div> --}}
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
          <h5 class="modal-title" id="varyingModalLabel">View Detail MRR</h5>
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
                <textarea class="form-control issue" id="Issue" name="Issue" rows="2" placeholder="" disabled></textarea>
            </div>
            <div class="form-group mb-3" id="other_purpose">
                <label for="Root_cause"><b>Root Cause:</b></label>
                <textarea class="form-control root_cause" id="Root_cause" name="Root_cause" rows="2" placeholder="" disabled></textarea>
            </div>
            <div class="form-group mb-3" id="other_purpose">
                <label for="Action"><b>Action:</b></label>
                <textarea class="form-control action" id="Action" name="Action" rows="2" placeholder="" disabled></textarea>
            </div>
        </div> 

        <div class="row">
                                
            <div class="col-md-6 mb-3">
                <div class="form-group">
                    <div class="form-row align-items-center">
                        <div class="col-sm">
                            <label for="repair_start" class="col-form-label col-form-label-sm"><b>Repair Start Time</b></label>
                        </div>
                        <div class="col">
                            <input type="text" class="form-control form-control-sm repair_start" id="repair_start" disabled>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="form-group">
                    <div class="form-row align-items-center">
                        <div class="col-sm">
                            <label for="repair_end" class="col-form-label col-form-label-sm"><b>Repair End Time</b></label>
                        </div>
                        <div class="col">
                            <input type="text" class="form-control form-control-sm repair_end" id="repair_end" disabled>
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
                            <label for="qc_start" class="col-form-label col-form-label-sm"><b>QC Start Time</b></label>
                        </div>
                        <div class="col">
                            <input type="text" class="form-control form-control-sm qc_start" id="qc_start" disabled>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="form-group">
                    <div class="form-row align-items-center">
                        <div class="col-sm">
                            <label for="qc_end" class="col-form-label col-form-label-sm"><b>QC End Time</b></label>
                        </div>
                        <div class="col">
                            <input type="text" class="form-control form-control-sm qc_end" id="qc_end" disabled>
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
                            <label for="qc_sign" class="col-form-label col-form-label-sm"><b>QC Sign</b></label>
                        </div>
                        <div class="col">
                            <input type="text" class="form-control form-control-sm qc_sign" id="qc_sign" disabled>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="form-group">
                    <div class="form-row align-items-center">
                        <div class="col-sm">
                            <label for="date_qc" class="col-form-label col-form-label-sm"><b>Date/Time</b></label>
                        </div>
                        <div class="col">
                            <input type="text" class="form-control form-control-sm date_qc" id="date_qc" disabled>
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
                            <label for="pd_sign" class="col-form-label col-form-label-sm"><b>PD Sign</b></label>
                        </div>
                        <div class="col">
                            <input type="text" class="form-control form-control-sm pd_sign" id="pd_sign" disabled>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="form-group">
                    <div class="form-row align-items-center">
                        <div class="col-sm">
                            <label for="date_pd" class="col-form-label col-form-label-sm"><b>Date/Time</b></label>
                        </div>
                        <div class="col">
                            <input type="text" class="form-control form-control-sm date_pd" id="date_pd" disabled>
                        </div>
                    </div>
                </div>
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
            $('.issue').val(_this.find('.issue').text());
            $('.root_cause').val(_this.find('.root_cause').text());
            $('.action').val(_this.find('.action').text());
            $('.repair_start').val(_this.find('.repair_start').text());
            $('.repair_end').val(_this.find('.repair_end').text());
            $('.qc_start').val(_this.find('.qc_start').text());
            $('.qc_end').val(_this.find('.qc_end').text());
            $('.qc_sign').val(_this.find('.qc_sign').text());
            $('.date_qc').val(_this.find('.date_qc').text());
            $('.pd_sign').val(_this.find('.pd_sign').text());
            $('.date_pd').val(_this.find('.date_pd').text());
    });

    // Validate form action MRR QC
    $(document).ready(function (){
        $('.myForm').validate({
            rules: {
                Qc_start_time: {
                    required : true,
                },
                Qc_end_time: {
                    required : true,
                },
                Qc_name_sign: {
                    required : true,
                },
                Date_qc: {
                    required : true,
                },
                
            },
            messages :{
                Qc_start_time: {
                    required : 'Please Enter Qc Start Time',
                },
                Qc_end_time: {
                    required : 'Please Enter Qc End Time',
                },
                Qc_name_sign: {
                    required : 'Please Enter Qc Name',
                },
                Date_qc: {
                    required : 'Please Enter Date Qc',
                },
                 
            },
            errorElement : 'span', 
            errorPlacement: function (error,element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight : function(element, errorClass, validClass){
                $(element).addClass('is-invalid');
            },
            unhighlight : function(element, errorClass, validClass){
                $(element).removeClass('is-invalid');
            },
        });
    });

    // Validate form action MRR Spv PD
    $(document).ready(function (){
        $('.myForm2').validate({
            rules: {
                Note_spv_pd: {
                    required : true,
                },
                
            },
            messages :{
                Note_spv_pd: {
                    required : 'Please Enter Name',
                },
                 
            },
            errorElement : 'span', 
            errorPlacement: function (error,element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight : function(element, errorClass, validClass){
                $(element).addClass('is-invalid');
            },
            unhighlight : function(element, errorClass, validClass){
                $(element).removeClass('is-invalid');
            },
        });
    });


</script>


@endsection