@extends('admin.admin_dashboard')
@section('admin')

<style>
    .table .form-control,
    .table .form-select {
    width: auto; /* Agar input dan select tidak memakan seluruh lebar */
    margin-right: 10px; /* Jarak antara elemen */
    }
</style>

<div class="page-content">
  
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            @if(Auth::user()->can('add.testingrequisition'))
             <a href="{{ route('add.sampletestingrequisition') }}" class="btn btn-inverse-info btn-xs"><i data-feather="file-plus" style="width: 16px; height: 16px;"></i> ADD REQUISITION FORM</a>
            @endif

        </ol>
    </nav>

    <div class="row">
<!-- Form filter -->
    <form action="{{ route('filter.sample') }}" method="GET" class="mb-3">
        @csrf
        @method('GET')
        <div class="row">
            <!-- Filter by Date -->
            <div class="col-md-2">
                <div class="form-group">
                    <label for="date">from date:</label>
                    <input type="date" name="from_date" id="date" class="form-control form-control-xs">
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="date">to date:</label>
                    <input type="date" name="to_date" id="date" class="form-control form-control-xs">
                </div>
            </div>

            <!-- Filter by DO Number -->
            {{-- <div class="col-md-3">
                <div class="form-group">
                    <label for="text">Do.Number:</label>
                    <input type="text" name="text" id="text" class="form-control" value="{{ request()->get('date') }}">
                </div>
            </div> --}}

            <!-- Filter by Process QCA/IQC -->
            {{-- <div class="col-md-3">
                <div class="form-group">
                    <label for="processs">Process:</label>
                    <select name="process" id="process" class="form-control">
                        <option value="">-- Select Process --</option>
                        <option value="1" {{ request()->get('process') == '1' ? 'selected' : '' }}>QCA</option>
                        <option value="2" {{ request()->get('process') == '2' ? 'selected' : '' }}>IQC</option>
                    </select>
                </div>
            </div> --}}

            <!-- Filter by Series -->
            {{-- <div class="col-md-3">
                <div class="form-group">
                    <label for="series">Series:</label>
                    <select name="series" id="series" class="form-control">
                        <option value="">-- Select series --</option>
                        <option value="1" {{ request()->get('series') == '1' ? 'selected' : '' }}>RRU172337901DST</option>
                        <option value="2" {{ request()->get('series') == '2' ? 'selected' : '' }}>RRU1234523sERSR</option>
                    </select>
                </div>
            </div> --}}

            <!-- Filter by Model -->
            {{-- <div class="col-md-2">
                <div class="form-group">
                    <label for="model">Model:</label>
                    <select name="model_id" id="model" class="form-control form-control-xs">
                        <option value="">--select model--</option>
                        @foreach($modelbrewer as $models)
                            <option value="{{ $models->id }}" {{ old('modelbrewer') == $models->id ? 'selected' : '' }}>{{ $models->model }}</option>
                        @endforeach
                    </select>
                </div>
            </div> --}}

            <!-- Filter by Lot -->
            {{-- <div class="col-md-2">
                <div class="form-group">
                    <label for="lot">Lot:</label>
                    <select name="lot_id" id="lot" class="form-control form-control-xs">
                        <option value="">-select lot--</option>
                        @foreach($lot as $lots)
                            <option value="{{ $lots->id }}" {{ old('lot') == $lots->id ? 'selected' : '' }}>{{ $lots->lot }}</option>
                        @endforeach
                    </select>
                </div>
            </div> --}}

            <!-- Filter by status -->
            <div class="col-md-2">
                <div class="form-group">
                    <label for="lot">status:</label>
                    <select name="status_approvals_id" id="status_approvals" class="form-control form-control-xs">
                        <option value="">--select status--</option>
                        @foreach($status as $status_approvals)
                            <option value="{{ $status_approvals->id }}" {{ old('status') == $status_approvals->id ? 'selected' : '' }}>{{ $status_approvals->status }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Filter by Shift -->
            {{-- <div class="col-md-3">
                <div class="form-group">
                    <label for="shift">Shift:</label>
                    <select name="shift" id="shift" class="form-control">
                        <option value="">-- Select Shift --</option>
                        <option value="1" {{ request()->get('shift') == '1' ? 'selected' : '' }}>Shift 1</option>
                        <option value="2" {{ request()->get('shift') == '2' ? 'selected' : '' }}>Shift 2</option>
                        <option value="3" {{ request()->get('shift') == '3' ? 'selected' : '' }}>Shift 3</option>
                    </select>
                </div>
            </div> --}}
            
            <div class="col-md-2 align-self-end">
                <button type="submit" class="btn btn-info btn-xs"><i data-feather="search" style="width: 16px; height: 16px;"></i> Search..</button>
                <a href="{{ route('qualitycontrol.sampletestingrequisition') }}" class="btn btn-light btn-xs" style="position: absolute; margin-left:1%;"><i data-feather="refresh-ccw" style="width: 16px; height: 16px;"></i> Refresh</a>
            </div>
        
        </div>
    </form>
    </div>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Sample Testing Requisition</h6>
                    <div class="table-responsive">
                        {{-- id="dataTableExample" --}}
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Sample Subtmitted Date</th>
                                    <th>Doc.No</th>
                                    <th>Series</th>
                                    <th hidden>No of samples</th>
                                    <th hidden>Test Purpose</th>
                                    <th hidden>Test_Purpose_remarks</th>
                                    <th hidden>Summary Before</th>
                                    <th hidden>shift</th>
                                    <th hidden>check by</th>
                                    <th hidden>summary_report</th>
                                    <th hidden>received sample date</th>
                                    <th hidden>result_test</th>
                                    <th hidden>schedule_of_test</th>
                                    <th hidden>est_of_completion_date</th>
                                    <th hidden>inspector_name</th>
                                    <th hidden>date</th>
                                    <th>status approvals spv</th>
                                    <th>status approvals QE</th>
                                    <th>status testing report</th>
                                    <th hidden>statusapprovals_spv</th>
                                    <th hidden>status_approvals_manager</th>
                                    @if(Auth::user()->can('statusapprovalsspv.column'))
                                    <th>status approvals manager</th>
                                    @endif
                                    @if(Auth::user()->can('statusapprovalsmanager.column'))
                                        <th>status approvals manager</th>
                                    @endif
                                    {{-- @if(Auth::user()->can('actionApprovals.column')) --}}
                                    @if(Auth::user()->can('actionApprovals.column'))
                                        <th>action approvals manager</th>
                                    @endif
                                    {{-- @endif --}}
                                    @if(Auth::user()->can('actionapprovalsspv.show'))
                                        <th>action approvals spv</th>
                                    @endif
                                    @if(Auth::user()->can('column.action.approvalsQE'))
                                        <th>action approvals QE</th>
                                    @endif
                                    <th>View Details</th>
                                    @if(Auth::user()->can('edit.testingrequisition'))
                                        <th>Action</th>
                                    @endif
                                    <th>Export to PDF</th>
                                    <th hidden>Export to PDF</th>
                                </tr>
                            </thead>
                            <tbody>
                                    @if($testingrequisition->isEmpty())
                                        <tr>
                                            <td colspan="3">No data found for the selected date range.</td>
                                        </tr>
                                    @else
                                @foreach ($testingrequisition as $key => $items)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td class="sample_subtmitted_date">{{ $items->sample_subtmitted_date }}</td>
                                        <td class="doc_no">{{ $items->process->process }}/{{ $items->lot->lot }}/{{ $items->modelBrewer->model }}/{{ $items->sample_subtmitted_date }}/{{ $items->do_no }}/{{ $items->incomming_number }}</td>
                                        <td class="series">{{ $items->series }}</td>
                                        <td class="no_of_sample" hidden>{{ $items->no_of_sample }}</td>
                                        <td class="testpurpose" hidden>{{ $items->testpurpose }}</td>
                                        <td class="test_purpose" hidden>{{ $items->test_purpose }}</td>
                                        <td class="summary" hidden>{{ $items->summary }}</td>
                                        <td class="shift" hidden>{{ $items->shift->shift }}</td>
                                        <td class="check_by" hidden>{{ $items->check_by }}</td>
                                        <td class="summary_after" hidden>@if($items->sampleReport == '')<p style="color:red">Report not completed</p>@else{{ $items->sampleReport->summary_after }}@endif</td>
                                        <td class="received_sample_date" hidden>{{ $items->sample_subtmitted_date }}</td>
                                        <td class="result_test" hidden>@if($items->sampleReport == '')<p style="color:red">Report not completed</p>@else{{ $items->sampleReport->result_test }}@endif</td>
                                        <td class="schdule_test" hidden>@if($items->sampleReport == '')<p style="color:red">Report not completed</p>@else{{ $items->sampleReport->schedule_of_test }}@endif</td>
                                        <td class="completion_date" hidden>@if($items->sampleReport == '')<p style="color:red">Report not completed</p>@else{{ $items->sampleReport->est_of_completion_date }}@endif</td>
                                        <td class="inspector_name" hidden>@if($items->sampleReport == '')<p style="color:red">Report not completed</p>@else{{ $items->sampleReport->inspector }}@endif</td>
                                        <td class="date" hidden>@if($items->sampleReport == '')<p style="color:red">Report not completed</p>@else{{ $items->sampleReport->date }}@endif</td>
                                        {{-- status approvals by spv --}}
                                        @if($items->status_approvals_id_spv == '3')
                                            <td><span class="badge bg-warning">pending</span></td>
                                        @elseif($items->status_approvals_id_spv == '2')
                                            <td><span class="badge bg-danger">rejected</span></td>
                                        @elseif($items->status_approvals_id_spv == '1')
                                            <td><span class="badge bg-success">review</span></td>
                                        @endif
                                        {{-- End status approvals by spv --}}

                                        {{-- Status approvals by QE --}}
                                        @if($items->status_approvals_id_qe == '3' OR $items->status_approvals_id_qe == '')
                                            <td class="qe_review"><span class="badge bg-warning">pending</span></td>
                                        @elseif($items->status_approvals_id_qe == '2')
                                            <td class="qe_review"><span class="badge bg-danger">rejected</span></td>
                                        @elseif($items->status_approvals_id_qe == '1')
                                            <td class="qe_review"><span class="badge bg-success">review</span></td>
                                        @endif
                                        {{-- End Status by QE --}}

                                        <td class="status_report" hidden>@if($items->status == '')<p style="color:red">Report not completed</p>@else{{ $items->status }}@endif</td>
                                        <td class="status_approvals_spv" hidden>@if($items->status_approvals_id_spv == '')<p style="color:red">Report not completed</p>@else<span>Approved</span>@endif</td>
                                        <td class="status_approvals_manager" hidden>@if($items->statusApprovals->status == '3' OR $items->statusApprovals->status == '2' )<p style="color:red">Report not completed</p>@else{{ $items->statusApprovals->status }}@endif</td>
                                        <td>
                                            @if($items->status == 'incomplete')
                                                <span class="badge bg-danger"> {{ $items->status }} </span>
                                            @else
                                                <span class="badge bg-success"> {{ $items->status }} </span>
                                            @endif
                                        </td>
                                        {{-- status approval spv --}}
                                        @if(Auth::user()->can('statusapprovalspv.column'))
                                        <td>
                                            @if($items->statusApprovals->status == 'pending')
                                                <span class="badge bg-warning"> {{ $items->statusApprovals->status }}</span>
                                            @elseif($items->statusApprovals->status == 'rejected')
                                                <span class="badge bg-danger"> {{ $items->statusApprovals->status }} </span>
                                            @else
                                                <span class="badge bg-success"> {{ $items->statusApprovals->status }} </span>
                                            @endif
                                        </td> 
                                        @endif
                                        {{-- status approval manager --}}
                                        @if(Auth::user()->can('statusapprovalmanager.column'))
                                        <td>
                                            @if($items->status_approvals_id == '1')
                                                <span class="badge bg-success"> approved </span>
                                            @elseif($items->status_approvals_id == '2')
                                                <span class="badge bg-danger"> rejected </span>
                                            @else
                                                <span class="badge bg-warning"> pending </span>
                                            @endif
                                        </td> 
                                        @endif

                                        {{-- jika status pending/rejected makan tombol action tetap ada SPV--}}
                                        @if(Auth::user()->can('actionapprovalsspv.show'))
                                        @if($items->status == 'incomplete')
                                            <td><p style="color: red">status report not completed</p></td>
                                        @elseif($items->status_approvals_id_spv == '2' OR $items->status_approvals_id_spv == '')
                                        <td>
                                            <button type="button" class="btn btn-inverse-success btn-xs" data-bs-toggle="modal" data-bs-target="#approvalModal" onclick="openApprovalModal({{ $items->id }})" title="Approvals">
                                                <i data-feather="check-square"></i>
                                                </button>
                                            </td>
                                        @elseif($items->status_approvals_id_spv == '')
                                            <td>
                                                <p style="color: rgb(238, 38, 12)">please review first</p>
                                            </td>
                                        @elseif($items->status_approvals_id_spv == '1')
                                            <td>
                                                <p style="color: green">REVIEW</p>
                                            </td>
                                        @endif
                                        @endif

                                        {{-- Button approvals by manager--}}
                                        @if(Auth::user()->can('actionApprovals.show'))
                                        @if($items->status_approvals_id_spv == '3' OR $items->status_approvals_id_spv == '2' OR $items->status_approvals_id_qe == '3' OR $items->status_approvals_id_qe == '2')
                                            <td><p style="color: rgb(255, 234, 0)">waiting spv/qe to review</p></td>
                                        @elseif($items->status_approvals_id_spv == '1' OR $items->status_approvals_id_qe == '1' OR $items->status_approvals_id == '3' OR $items->status_approvals_id == '2')
                                        <td>
                                            <button type="button" class="btn btn-inverse-success btn-xs" data-bs-toggle="modal" data-bs-target="#approvalModalManager" onclick="openApprovalModalManager({{ $items->id }})" title="Approvals">
                                                Approved/Rejected
                                            </button>
                                        </td>
                                        @elseif($items->status_approvals_id === '1')
                                        <td>
                                            <p style="color: green">APPROVED</p>
                                        </td>
                                        @endif
                                        @endif
                                        {{-- End button approvals by manager --}}

                                        {{-- Button Action Approval by QE --}}
                                        @if(Auth::user()->can('action.approvalsQE'))
                                        @if($items->status == 'incomplete')
                                            <td><p style="color: red">status report not completed</p></td>
                                        @elseif($items->status_approvals_id_qe == '2' OR $items->status_approvals_id_qe == '')
                                        <td>
                                            <button type="button" class="btn btn-inverse-success btn-xs" data-bs-toggle="modal" data-bs-target="#approvalModalQe" onclick="openApprovalModalQe({{ $items->id }})" title="Approvals">
                                                <i data-feather="check-square" style="width: 16px; height: 16px;"></i>
                                            </button>
                                        </td>
                                        @elseif($items->status_approvals_id_qe == '')
                                            <td>
                                                <p style="color: rgb(238, 38, 12)">please review first</p>
                                            </td>
                                        @elseif($items->status_approvals_id_qe == '1')
                                            <td>
                                                <p style="color: green">REVIEW</p>
                                            </td>
                                        @endif
                                        @endif
                                        {{-- End button approvals by QE --}}

                                        {{-- Button view details --}}
                                        <td><button type="button" class="btn btn-inverse-primary btn-xs view-details" data-bs-toggle="modal" data-bs-target="#varyingModal" data-id="'.$items->id.'" title="View Detail"><i data-feather="eye" style="width: 16px; height: 16px;"></i></button></td>
                                        {{-- End button view details --}}

                                        @if(Auth::user()->can('edit.testingrequisition'))
                                        <td> 
                                            @if(Auth::user()->can('edit.testingrequisition'))
                                                <a href="{{ route('edit.TestingRequisition', $items->id) }}" class="btn btn-inverse-warning btn-xs" title="Edit"><i data-feather="edit" style="width: 16px; height: 16px;"></i></a>
                                            @endif
                                            @if(Auth::user()->can('delete.testingreport'))
                                                <a href="{{ route('delete.requisition', $items->id) }}" class="btn btn-inverse-danger btn-xs" title="Delete"><i data-feather="trash-2" style="width: 16px; height: 16px;"></i></a>
                                            @endif
                                        </td> 
                                        @endif
                                        @if($items->status == 'incomplete' || 
                                        in_array($items->status_approvals_id, [2, 3]) ||
                                        in_array($items->status_approvals_id_spv, [2, 3]) || 
                                        in_array($items->status_approvals_id_qe, [2, 3]))
                                        <td>
                                            <p style="color: red">can't download pdf/form status not complete</p>
                                        </td>
                                        @else
                                            <td><a href="{{ route('requisition.export-pdf', $items->id ) }}" class="btn btn-inverse-danger btn-xs" title="Export-PDF"><i data-feather="download" style="width: 16px; height: 16px;"></i></a></td>
                                        @endif
                                    </tr>
                                @endforeach 
                                @endif

                            </tbody>
                        </table>
                        {{ $testingrequisition->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

{{-- MODAL APPROVALS BY MANAGER --}}
<!-- Modal -->
<div class="modal fade" id="approvalModalManager" tabindex="-1" role="dialog" aria-labelledby="approvalModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="approvalModalLabel">Approval Forms</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
          {{-- <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"> --}}
            {{-- <span aria-hidden="true">&times;</span> --}}
          </button>
        </div>
        <form id="approvalFormManager" action="" method="POST">
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
          <div class="modal-footer">
            {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
            <button type="submit" class="btn btn-inverse-info btn-xs"><i data-feather="send" style="width: 16px; height: 16px;"></i> Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>
{{-- END MODAL APPROVALS BY MANAGER--}}


{{-- MODAL APPROVALS BY QE --}}
<!-- Modal -->
<div class="modal fade" id="approvalModalQe" tabindex="-1" role="dialog" aria-labelledby="approvalModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="approvalModalLabel">Approval Forms</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
          {{-- <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"> --}}
            {{-- <span aria-hidden="true">&times;</span> --}}
          </button>
        </div>
        <form id="approvalFormQe" action="" method="POST">
          @csrf
          <div class="modal-body">
            <div class="form-group">
              <label for="approval_status">Approval Status</label>
              <select name="status_approvals_id_qe" id="approval_status" class="form-control">
                <option value="1">Approved</option>
                <option value="2">Rejected</option>
              </select>
            </div>
            <div class="form-group">
              <label for="notes">Notes</label>
              <textarea name="notes_qe" id="notes" class="form-control" rows="4" placeholder="Optional"></textarea>
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
{{-- END MODAL APPROVALS BY QE--}}


{{-- MODAL APPROVALS BY SPV --}}
<!-- Modal -->
<div class="modal fade" id="approvalModal" tabindex="-1" role="dialog" aria-labelledby="approvalModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="approvalModalLabel">Approval Form</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
          {{-- <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"> --}}
            {{-- <span aria-hidden="true">&times;</span> --}}
          </button>
        </div>
        <form id="approvalForm" action="" method="POST">
          @csrf
          <div class="modal-body">
            <div class="form-group">
              <label for="approval_status">Approval Status</label>
              <select name="status_approvals_id_spv" id="approval_status" class="form-control">
                <option value="1">Approved</option>
                <option value="2">Rejected</option>
              </select>
            </div>
            <div class="form-group">
              <label for="notes">Notes</label>
              <textarea name="notes_spv" id="notes" class="form-control" rows="4" placeholder="Optional"></textarea>
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
{{-- END MODAL APPROVALS BY SPV--}}


{{-- MODAL VIEW --}}
<div class="modal fade" id="varyingModal" tabindex="-1" aria-labelledby="varyingModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="varyingModalLabel">FORM DETAIL TESTING REQUISITION & TESTING REPORT</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
        </div>
        {{-- Content --}}
        <div class="modal-body">
          {{-- Data detail akan tampil di sini - {{ $items->summary_after }} --}}
            <p id="modal-contentt"></p>
          <div class="row">
              <div class="col-md-6 grid-margin stretch-card">
                  <div class="card">
                      <div class="card-body" id="detailContent">

                          <h6 class="card-title">Sample Testing Requisition Form  (1)</h6>
                          {{-- <input type="hidden" class="form-control id"> --}}
                          <form class="forms-sample">
                              <div class="row mb-3">
                                  <label for="samplesubmitted" class="col-sm-3 col-form-label">Sample Submitted Date</label>
                                  <div class="col-sm-9">
                                      <input type="text" class="form-control submitedDate" value="" id="samplesubmitted" disabled>
                                  </div>
                              </div>
                              <div class="row mb-3">
                                  <label for="docno" class="col-sm-3 col-form-label">Doc.No</label>
                                  <div class="col-sm-9">
                                      <input type="text" class="form-control doc_no" id="docno" disabled>
                                  </div>
                              </div>
                              <div class="row mb-3">
                                  <label for="exampleInputMobile" class="col-sm-3 col-form-label">Series</label>
                                  <div class="col-sm-9">
                                      <input type="text" class="form-control series" id="exampleInputMobile" disabled>
                                  </div>
                              </div>
                              <div class="row mb-3">
                                  <label for="noofsample" class="col-sm-3 col-form-label">No Of Sample</label>
                                  <div class="col-sm-9">
                                      <input type="text" class="form-control no_of_sample" id="noofsample" disabled>
                                  </div>
                              </div>
                              <div class="row mb-3">
                                  <label for="testpurpose" class="col-sm-3 col-form-label">Test Purpose</label>
                                  <div class="col-sm-9">
                                      <input type="text" class="form-control testpurpose" id="testpurpose" disabled>
                                  </div>
                              </div>
                              <div class="row mb-3">
                                  <label for="otherpurpose" class="col-sm-3 col-form-label">Other purpose/remarks:</label>
                                  <div class="col-sm-9">
                                    <textarea class="form-control test_purpose" id="otherpurpose" rows="5" disabled></textarea>
                                  </div>
                              </div>
                              <div class="row mb-3">
                                  <label for="summarybefore" class="col-sm-3 col-form-label">Summary Before</label>
                                  <div class="col-sm-9">
                                      <textarea class="form-control summary" id="summarybefore" rows="5" disabled></textarea>
                                  </div>
                              </div>
                              <div class="row mb-3">
                                  <label for="shift" class="col-sm-3 col-form-label">Shift</label>
                                  <div class="col-sm-9">
                                      <input type="text" class="form-control shift" id="shift" disabled>
                                  </div>
                              </div>
                              <div class="row mb-3">
                                  <label for="checkby" class="col-sm-3 col-form-label">Check By</label>
                                  <div class="col-sm-9">
                                      <input type="text" class="form-control check_by" id="checkby" disabled>
                                  </div>
                              </div>

                              <div class="row mb-3">
                                  <label for="qe_review" class="col-sm-3 col-form-label">QE Review</label>
                                  <div class="col-sm-9">
                                      <input type="text" class="form-control qe_review" id="qe_review" disabled>
                                  </div>
                              </div>

                          </form>
        </div>
      </div>

      {{-- Form Sample Testing Report --}}
              </div>
              <div class="col-md-6 grid-margin stretch-card">
                  <div class="card">
                      <div class="card-body">

                          <h6 class="card-title">SAMPLE TESTING REPORT FORM (2)</h6>

                          <form class="forms-sample">
                              <div class="row mb-3">
                                  <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Received Sample Date</label>
                                  <div class="col-sm-9">
                                      <input type="text" class="form-control received_sample_date" id="exampleInputUsername2" disabled>
                                  </div>
                              </div>
                              <div class="row mb-3">
                                  <label for="summaryafter" class="col-sm-3 col-form-label">Summary After</label>
                                  <div class="col-sm-9">
                                      <textarea class="form-control summary_after" id="summaryafter" rows="5" disabled></textarea>
                                  </div>
                              </div>

                              <div class="row mb-3">
                                  <label for="result_test" class="col-sm-3 col-form-label">Test Result</label>
                                  <div class="col-sm-9">
                                      <input type="email" class="form-control result_test" id="result_test" disabled>
                                  </div>
                              </div>
                              <div class="row mb-3">
                                  <label for="scheduletest" class="col-sm-3 col-form-label">Schedule of Test</label>
                                  <div class="col-sm-9">
                                      <input type="text" class="form-control schdule_test" id="scheduletest" disabled>
                                  </div>
                              </div>
                              <div class="row mb-3">
                                  <label for="esofdate" class="col-sm-3 col-form-label">Est Of Completion Date</label>
                                  <div class="col-sm-9">
                                      <input type="text" class="form-control completion_date" id="esofdate" disabled>
                                  </div>
                              </div>
                              <div class="row mb-3">
                                  <label for="inspectorname" class="col-sm-3 col-form-label">Inspector Name</label>
                                  <div class="col-sm-9">
                                      <input type="text" class="form-control inspector_name" id="inspectorname" disabled>
                                  </div>
                              </div>
                              
                              <div class="row mb-3">
                                  <label for="date" class="col-sm-3 col-form-label">Date</label>
                                  <div class="col-sm-9">
                                      <input type="text" class="form-control date" id="date" disabled>
                                  </div>
                              </div>
                              {{-- <div class="row mb-3">
                                  <label for="reviewby" class="col-sm-3 col-form-label">Review by Spv</label>
                                  <div class="col-sm-9">
                                      <input type="text" class="form-control" id="reviewby">
                                  </div>
                              </div> --}}

                              <div class="row mb-3">
                                  <label for="status" class="col-sm-3 col-form-label">Status Report</label>
                                  <div class="col-sm-9">
                                      <input type="text" class="form-control status_report" id="status" disabled>
                                  </div>
                              </div>
                              <div class="row mb-3">
                                  <label for="status_approvals_spv" class="col-sm-3 col-form-label">Approvals Spv</label>
                                  <div class="col-sm-9">
                                      <input type="text" class="form-control status_approvals_spv" id="status_approvals_spv" disabled>
                                  </div>
                              </div>
                              <div class="row mb-3">
                                  <label for="status_approvals_manager" class="col-sm-3 col-form-label">Approvals Manager</label>
                                  <div class="col-sm-9">
                                      <input type="text" class="form-control status_approvals_manager" id="status_approvals_manager" disabled>
                                  </div>
                              </div>

                          </form>

                      </div>
                  </div>
              </div>

      </div>
        </div>
        {{-- END CONTENT --}}

      </div>
    </div>
  </div>
  {{-- END MODAL --}}

  {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
  <script>
    // modal approvals Manager
    function openApprovalModalManager(itemId) {
        // Set the form action dynamically based on the item ID
        var actionUrl = "{{ route('update.approvalsmanager', ':id') }}";
        actionUrl = actionUrl.replace(':id', itemId);
        $('#approvalFormManager').attr('action', actionUrl);
        // Optionally reset the form fields when modal is opened
        // $('#approval_status').val('approved'); // default status
        // $('#notes').val('');
        
        // Show the modal
        $('#approvalModalManager').modal('show');
    }

    // modal approvals spv
    function openApprovalModal(itemId) {
        // Set the form action dynamically based on the item ID
    var actionUrl = "{{ route('update.approvalsspv', ':id') }}";
        actionUrl = actionUrl.replace(':id', itemId);
        $('#approvalForm').attr('action', actionUrl);
        // Optionally reset the form fields when modal is opened
        // $('#approval_status').val('approved'); // default status
        // $('#notes').val('');
        
        // Show the modal
        $('#approvalModal').modal('show');
    }
    // modal approvals QE
    function openApprovalModalQe(itemId) {
        // Set the form action dynamically based on the item ID
        var actionUrl = "{{ route('update.approvalsqe', ':id') }}";
        actionUrl = actionUrl.replace(':id', itemId);
        $('#approvalFormQe').attr('action', actionUrl);
        // Optionally reset the form fields when modal is opened
        // $('#approval_status').val('approved'); // default status
        // $('#notes').val('');
        
        // Show the modal
        $('#approvalModalQe').modal('show');
    }


    $(document).on('click','.view-details', function(){
        var _this = $(this).parents('tr');
            $('.submitedDate').val(_this.find('.sample_subtmitted_date').text());
            $('.doc_no').val(_this.find('.doc_no').text());
            $('.series').val(_this.find('.series').text());
            $('.no_of_sample').val(_this.find('.no_of_sample').text());
            $('.testpurpose').val(_this.find('.testpurpose').text());
            $('.test_purpose').val(_this.find('.test_purpose').text());
            $('.summary').val(_this.find('.summary').text());
            $('.shift').val(_this.find('.shift').text());
            $('.check_by').val(_this.find('.check_by').text());
            $('.summary_after').val(_this.find('.summary_after').text());
            $('.received_sample_date').val(_this.find('.received_sample_date').text());
            $('.result_test').val(_this.find('.result_test').text());
            $('.schdule_test').val(_this.find('.schdule_test').text());
            $('.completion_date').val(_this.find('.completion_date').text());
            $('.inspector_name').val(_this.find('.inspector_name').text());
            $('.date').val(_this.find('.date').text());
            $('.status_report').val(_this.find('.status_report').text());
            $('.status_approvals_spv').val(_this.find('.status_approvals_spv').text());
            $('.status_approvals_manager').val(_this.find('.status_approvals_manager').text());
            $('.qe_review').val(_this.find('.qe_review').text());
    });
  </script>
  
  <script type="text/javascript">
    // $('#serverside tbody').on('click', 'tr', function() {
    //     $(this).toggleClass('selected');  // Tambahkan kelas 'selected' pada baris yang dipilih
    // });
        // $(document).ready( function() {
        //     var columns = [
        //             {
        //                 data: 'no',
        //                 name: 'no',
        //             },
        //             {
        //                 data: 'Sample Submitted Date',
        //                 name: 'sample_subtmitted_date',
        //             },
        //             {
        //                 data: 'Doc.No',
        //                 name: 'doc_no',
        //             },
        //             {
        //                 data: 'series',
        //                 name: 'series',
        //             },
        //             {
        //                 data: 'no_of_sample',visible: false,
        //                 name: 'no_of_sample',
        //             },
        //             {
        //                 data: 'testpurpose',visible: false,
        //                 name: 'testpurpose',
        //             },
        //             {
        //                 data: 'test_purpose_remark',visible: false,
        //                 name: 'test_purpose',
        //             },
        //             {
        //                 data: 'summary_before',visible: false,
        //                 name: 'summary',
        //             },
        //             {
        //                 data: 'shift',visible: false,
        //                 name: 'shift',
        //             },
        //             {
        //                 data: 'check_by',visible: false,
        //                 name: 'check_by',
        //             },
        //             {
        //                 data: 'summary_report',visible: false,
        //                 name: 'summary_after',
        //             },
        //             {
        //                 data: 'Received Submitted Date',visible: false,
        //                 name: 'sample_subtmitted_date',
        //             },
        //             {
        //                 data: 'result_test',visible: false,
        //                 name: 'result_test',
        //             },
        //             {
        //                 data: 'schedule_of_test',visible: false,
        //                 name: 'schedule_of_test',
        //             },
        //             {
        //                 data: 'est_of_completion_date',visible: false,
        //                 name: 'est_of_completion_date',
        //             },
        //             {
        //                 data: 'inspector_name',visible: false,
        //                 name: 'inspector',
        //             },
        //             {
        //                 data: 'date',visible: false,
        //                 name: 'date',
        //             },{
        //                 data: 'status_report',
        //                 name: 'status',
        //             },
        //             {
        //                 data: 'status_approvals_spv',visible: false,
        //                 name: 'status_approvals_id_spv',
        //             },
        //             {
        //                 data: 'status_approvals_manager',visible: false,
        //                 name: 'status_approvals_id',
        //             },
        //             {
        //                 data: 'status approvals manager',
        //                 name: 'status',
        //             },
        //             {
        //                 data: 'status approvals spv',
        //                 name: 'status_approvals_id',
        //             },
                    
        //             {
        //                 data: 'action_approvals_manager',
        //                 name: 'status_approvals_id',
        //             },
        //             {
        //                 data: 'action_approvals_spv',
        //                 name: 'status_approvals_id_spv',
        //             },
        //             {
        //                 data: 'view_details',
        //                 name: 'view_details',
        //             },
        //             {
        //                 data: 'export_to_pdf',
        //                 name: 'action',
        //             },
        //             {
        //                 data: 'export_to_pdf',visible: false,
        //                 name: 'action',
        //             },
        //     ];
        
        //     var table = $('#serverside').DataTable({
        //         pageLength: 5,
        //         lengthMenu: [ [5, 10, 25, 50, -1], [5, 10, 25, 50, "All"] ],
        //         processing:true,
        //         pagination:true,
        //         responsive:true,
        //         serverSide:true,
        //         searching:true,
        //         ordering:false,
        //         columnDefs: [ 
        //             {
        //                 "targets": 0, // Menargetkan kolom pertama untuk nomor urut
        //                 "searchable": false,
        //                 "orderable": false,
        //                 "render": function (data, type, row, meta) {
        //                     return meta.row + meta.settings._iDisplayStart + 1;
        //                 }
        //             }
        //         ],
        //         ajax:{
        //             url:"{{ route('qualitycontrol.sampletestingrequisition') }}",
        //         },
        //         columns:columns
        //     });

            // Capture click event on any row
    // $('#serverside tbody').on('click', 'tr', function() {
    //     var data = table.row(this).data();
    //     var id = data.id; // Assuming the row has an 'id' field

        // Fetch detail using AJAX
    //     $.ajax({
    //         url: '/show.testing/' + id,
    //         type: 'GET',
    //         success: function(response) {
    //             // Assuming response contains the detail HTML
    //             $('#detailContent').html(response);
    //             $('#varyingModal').modal('show'); // Show the modal
    //         },
    //         error: function(xhr, status, error) {
    //             console.log(error);
    //         }
    //     });
    // });

            // Ketika tombol View diklik
    // $('#serverside').on('click', '.view-details', function() {
    //     var id = $(this).data('id');
    //     // Lakukan AJAX untuk mengambil data detail dari server
    //     if(id){ 
    //         $.ajax({
    //         url: '/show.testing/' + id,
    //         type: 'GET',
    //         success: function(response) {
    //             if(response.data) {
    //                 $('#varyingModal').modal('show'); // Tampilkan modal
    //                 $('#modal-contentt').text(response.data.id);
    //             } else {
    //                 console.log("Data tidak ditemukan.");
    //             }
    //         },
    //         error: function(xhr, status, error) {
    //             console.error("Error: " + error);
    //         }
    //     });
    //     } else {
    //         console.error('ID tidak valid atau tidak ditemukan.');
    //     }
        
    // });

    // Ketika tombol View diklik
    // $('#serverside').on('click', '.view-details', function() {
    //     var id = $(this).data('id');
    //     // Lakukan AJAX untuk mengambil data detail dari server
    //     $.ajax({
    //         url: "/testing/" + id,
    //         type: "GET",
    //         success: function(response) {
    //             // Isi modal dengan data yang diambil
    //              // Sesuaikan dengan data yang diambil
    //              $('#modal-content').text(response.data.detail);
    //             $('#varyingModal').modal('show'); // Tampilkan modal
    //         },
    //         error: function(xhr) {
    //             alert('Terjadi kesalahan!');
    //         }
    //     });
    // });

    // $('#serverside').on('click', '.view-details', function() {
    //     var useURL = $(this).data('url');
    //     $.get(useURL, function(data) {
    //         $('#varyingModal').modal('show');
    //         $('#test').text(data.id)
    //     })
    // });

// });
// {{-- </script>
    
@endsection