@extends('admin.admin_dashboard')
@section('admin')

<div class="page-content">
  
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            @if(Auth::user()->can('add.testingrequisition'))
             <a href="{{ route('add.sampletestingrequisition') }}" class="btn btn-inverse-info btn-sm"><i data-feather="plus-circle"></i> ADD REQUISITION FORM</a>
            @endif
        </ol>
    </nav>

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
                                        <th>status report</th>
                                        <th hidden>status_approvals_spv</th>
                                        <th hidden>status_approvals_manager</th>
                                        @if(Auth::user()->can('statusapprovalsspv.column'))
                                        <th>status approvals manager</th>
                                        @endif
                                        @if(Auth::user()->can('statusapprovalsmanager.column'))
                                        <th>status approvals spv</th>
                                        @endif
                                        {{-- @if(Auth::user()->can('actionApprovals.column')) --}}
                                        @if(Auth::user()->can('actionApprovals.column'))
                                            <th>action approvals manager</th>
                                        @endif
                                        {{-- @endif --}}
                                        @if(Auth::user()->can('actionapprovalsspv.show'))
                                            <th>action approvals spv</th>
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
                                            @if($items->status_approvals_id_spv == '1')
                                            <span class="badge bg-success"> approved </span>
                                            @elseif($items->status_approvals_id_spv == 2)
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
                                        @elseif($items->statusApprovals->status == 'rejected' OR $items->statusApprovals->status == 'pending')
                                        <td>
                                            <form action="{{ route('update.approvals', $items->id) }}" method="POST">
                                            @csrf
                                                <button class="btn btn-inverse-success btn-sm" type="submit" name="status_approvals_id_spv" value="1" title="Review"><i data-feather="check-circle"></i></button>
                                                &nbsp;&nbsp;
                                                <button class="btn btn-inverse-danger btn-sm" type="submit" name="status_approvals_id_spv" value="2" title="Rejected"><i data-feather="x-circle"></i></button>
                                        </td>
                                        @elseif($items->statusApprovals->status == 'approved')
                                        <td>
                                            <p style="color: green">REVIEW</p>
                                        </td>
                                        @endif
                                        @endif

                                        {{-- jika status pending/rejected makan tombol action tetap ada Manager--}}
                                        @if(Auth::user()->can('actionApprovals.show'))
                                        @if($items->status == 'incomplete')
                                            <td><p style="color: red">status report not completed</p></td>
                                        @elseif($items->statusApprovals->status == 'pending')
                                            <td><p style="color: rgb(255, 234, 0)">waiting spv to approvals</p></td>
                                        @elseif($items->status_approvals_id_spv == '3' OR $items->status_approvals_id_spv == '2' && $items->status_approvals_id_spv == '')
                                        <td>
                                            <form action="{{ route('update.approvalsspv', $items->id) }}" method="POST">
                                            @csrf
                                                <button class="btn btn-inverse-success btn-sm" type="submit" name="status_approvals_id" value="1" title="Approved"><i data-feather="check-circle"></i></button>
                                                &nbsp;&nbsp;
                                                <button class="btn btn-inverse-danger btn-sm" type="submit" name="status_approvals_id" value="2" title="Rejected"><i data-feather="x-circle"></i></button>
                                        </td>
                                        @elseif($items->status_approvals_id_spv == '1')
                                        <td>
                                            <p style="color: green">APPROVED</p>
                                        </td>
                                        @endif
                                        @endif

                                        <td><button type="button" class="btn btn-inverse-primary btn-xs view-details" data-bs-toggle="modal" data-bs-target="#varyingModal" data-id="'.$items->id.'" title="View Detail"><i data-feather="eye"></i></button></td>
                                       
                                        @if(Auth::user()->can('edit.testingrequisition'))
                                        <td> 
                                            @if(Auth::user()->can('edit.testingrequisition'))
                                                <a href="{{ route('edit.TestingRequisition', $items->id) }}" class="btn btn-inverse-warning btn-xs" title="Edit"><i data-feather="edit"></i></a>
                                            @endif
                                            @if(Auth::user()->can('delete.testingreport'))
                                                <a href="{{ route('delete.requisition', $items->id) }}" class="btn btn-inverse-danger btn-xs" title="Delete"><i data-feather="trash-2"></i></a>
                                            @endif
                                        </td> 
                                        @endif
                                        @if($items->status == 'incomplete')
                                        <td>
                                            <p style="color: red">status report not completed</p>
                                        </td>
                                        @else
                                            <td><a href="{{ route('requisition.export-pdf', $items->id ) }}" class="btn btn-inverse-danger btn-xs" title="Export-PDF"><i data-feather="download"></i></a></td>
                                        @endif
                                    </tr>
                                @endforeach 

                            </tbody>
                        </table>
                        {{ $testingrequisition->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

{{-- MODAL --}}
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