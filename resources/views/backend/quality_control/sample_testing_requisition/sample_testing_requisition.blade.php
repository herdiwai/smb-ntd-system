@extends('admin.admin_dashboard')
@section('admin')

<div class="page-content">
  
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
             <a href="{{ route('add.sampletestingrequisition') }}" class="btn btn-inverse-info btn-sm"><i data-feather="plus-circle"></i> ADD REQUISITION FORM</a>
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
                                        <th>status approvals manager</th>
                                        <th hidden>status approvals manager</th>
                                        @if(Auth::user()->can('actionApprovals.show'))
                                            <th>action approvals</th>
                                        @endif
                                        <th>View Details</th>
                                        @if(Auth::user()->can('edit.testingrequisition'))
                                            <th>Action</th>
                                        @endif
                                        <th>Export to PDF</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($testingrequisition as $key => $items)
                                {{-- @foreach($items->sampleReport as $item) --}}
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td class="sample_subtmitted_date">{{ $items->sample_subtmitted_date }}</td>
                                        <td class="doc_no">{{ $items->process->process }}/{{ $items->lot->lot }}/{{ $items->modelBrewer->model }}/{{ $items->date }}/{{ $items->do_no }}/{{ $items->incomming_number }}</td>
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
                                        <td>
                                            @if($items->status == 'incomplete')
                                                {{-- <p style="color:red">{{ $items->status }}</p> --}}
                                                <span class="badge bg-danger"> {{ $items->status }} </span>
                                            @else
                                                <span class="badge bg-success"> {{ $items->status }} </span>
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
                                        {{-- jika status pending/rejected makan tombol action tetap ada --}}
                                        @if($items->statusApprovals->status == 'rejected' OR $items->statusApprovals->status == 'pending')
                                        <td>
                                            <form action="{{ route('update.approvals', $items->id) }}" method="POST">
                                                @csrf
                                                <button class="btn btn-inverse-success btn-sm" type="submit" name="status_approvals_id" value="1" title="Approved"><i data-feather="check-circle"></i></button>
                                                &nbsp;&nbsp;
                                                <button class="btn btn-inverse-danger btn-sm" type="submit" name="status_approvals_id" value="2" title="Rejected"><i data-feather="x-circle"></i></button>
                                        {{-- @elseif($items->statusApprovals->status == 'approved')
                                        <p>Approvals has been approved</p> --}}
                                            </td>
                                            @endif
                                        @if($items->statusApprovals->status == 'approved')
                                            <td>
                                                <p>Approvals has been approved</p>
                                            </td>
                                        @endif
                                           
                                        {{-- @if($items->statusApprovals->status == 'rejected')
                                        <td>
                                            @if(Auth::user()->can('actionApprovals.show'))
                                                @if($items->statusApprovals->status == 'pending')
                                                <form action="{{ route('update.approvals', $items->id) }}" method="POST">
                                                    @csrf
                                                    <button class="btn btn-inverse-success btn-sm" type="submit" name="status_approvals_id" value="1" title="Approved"><i data-feather="check-circle"></i></button>
                                                    &nbsp;&nbsp;
                                                    @else
                                                    <button class="btn btn-inverse-danger btn-sm" type="submit" name="status_approvals_id" value="2" title="Rejected"><i data-feather="x-circle"></i></button>
                                               @endif
                                                </td>
                                                    @else
                                                <td>
                                                    <p>Approvals has been approved</p>
                                                </td>
                                        @endif --}}
                                        <td> 
                                            {{-- <button type="button" class="btn btn-inverse-primary btn-sm view-details" data-bs-toggle="modal" data-bs-target="#varyingModal" onclick="showPostDetails({{ $items->id }})" data-url="{{ route('show.testing', $items->id) }}" title="View Detail"><i data-feather="eye"></i></button> --}}
                                            <button type="button" class="btn btn-inverse-primary btn-sm view-details" data-bs-toggle="modal" data-bs-target="#varyingModal" data-id="'.$items->id.'" title="View Detail"><i data-feather="eye"></i></button>
                                            @if(Auth::user()->can('edit.testingrequisition'))
                                                <a href="{{ route('edit.TestingRequisition', $items->id) }}" class="btn btn-inverse-warning btn-xs" title="Edit"><i data-feather="edit"></i></a>
                                            @endif
                                            @if(Auth::user()->can('delete.testingreport'))
                                                <a href="" class="btn btn-inverse-danger btn-sm" title="Delete"><i data-feather="trash-2"></i></a>
                                            @endif
                                        </td> 
                                        <td><a href="{{ route('requisition.export-pdf', $items->id ) }}" class="btn btn-inverse-danger btn-sm" title="Export-PDF"><i data-feather="download"></i></a></td>
                                    </tr>
                                @endforeach
                                {{-- @endforeach --}}

                            </tbody>
                        </table>
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
          <div class="row">
              <div class="col-md-6 grid-margin stretch-card">
                  <div class="card">
                      <div class="card-body">

                          <h6 class="card-title">Sample Testing Requisition Form  (1)</h6>
                          {{-- <input type="hidden" class="form-control id"> --}}

                          <form class="forms-sample">
                              <div class="row mb-3">
                                  <label for="samplesubmitted" class="col-sm-3 col-form-label">Sample Submitted Date</label>
                                  <div class="col-sm-9">
                                      <input type="text" class="form-control submitedDate" value="" id="samplesubmitted" readonly>
                                  </div>
                              </div>
                              <div class="row mb-3">
                                  <label for="docno" class="col-sm-3 col-form-label">Doc.No</label>
                                  <div class="col-sm-9">
                                      <input type="text" class="form-control doc_no" id="docno" readonly>
                                  </div>
                              </div>
                              <div class="row mb-3">
                                  <label for="exampleInputMobile" class="col-sm-3 col-form-label">Series</label>
                                  <div class="col-sm-9">
                                      <input type="text" class="form-control series" id="exampleInputMobile" readonly>
                                  </div>
                              </div>
                              <div class="row mb-3">
                                  <label for="noofsample" class="col-sm-3 col-form-label">No Of Sample</label>
                                  <div class="col-sm-9">
                                      <input type="text" class="form-control no_of_sample" id="noofsample" readonly>
                                  </div>
                              </div>
                              <div class="row mb-3">
                                  <label for="testpurpose" class="col-sm-3 col-form-label">Test Purpose</label>
                                  <div class="col-sm-9">
                                      <input type="text" class="form-control testpurpose" id="testpurpose" readonly>
                                  </div>
                              </div>
                              <div class="row mb-3">
                                  <label for="otherpurpose" class="col-sm-3 col-form-label">Other purpose/remarks:</label>
                                  <div class="col-sm-9">
                                    <textarea class="form-control test_purpose" id="otherpurpose" rows="5" readonly></textarea>
                                  </div>
                              </div>
                              <div class="row mb-3">
                                  <label for="summarybefore" class="col-sm-3 col-form-label">Summary Before</label>
                                  <div class="col-sm-9">
                                      <textarea class="form-control summary" id="summarybefore" rows="5" readonly></textarea>
                                  </div>
                              </div>
                              <div class="row mb-3">
                                  <label for="shift" class="col-sm-3 col-form-label">Shift</label>
                                  <div class="col-sm-9">
                                      <input type="text" class="form-control shift" id="shift" readonly>
                                  </div>
                              </div>
                              <div class="row mb-3">
                                  <label for="checkby" class="col-sm-3 col-form-label">Check By</label>
                                  <div class="col-sm-9">
                                      <input type="text" class="form-control check_by" id="checkby" readonly>
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
                                      <input type="text" class="form-control received_sample_date" id="exampleInputUsername2" readonly>
                                  </div>
                              </div>
                              <div class="row mb-3">
                                  <label for="summaryafter" class="col-sm-3 col-form-label">Summary After</label>
                                  <div class="col-sm-9">
                                      <textarea class="form-control summary_after" id="summaryafter" rows="5" readonly></textarea>
                                  </div>
                              </div>

                              <div class="row mb-3">
                                  <label for="result_test" class="col-sm-3 col-form-label">Test Result</label>
                                  <div class="col-sm-9">
                                      <input type="email" class="form-control result_test" id="result_test">
                                  </div>
                              </div>
                              <div class="row mb-3">
                                  <label for="scheduletest" class="col-sm-3 col-form-label">Schedule of Test</label>
                                  <div class="col-sm-9">
                                      <input type="text" class="form-control schdule_test" id="scheduletest" readonly>
                                  </div>
                              </div>
                              <div class="row mb-3">
                                  <label for="esofdate" class="col-sm-3 col-form-label">Est Of Completion Date</label>
                                  <div class="col-sm-9">
                                      <input type="text" class="form-control completion_date" id="esofdate" readonly>
                                  </div>
                              </div>
                              <div class="row mb-3">
                                  <label for="inspectorname" class="col-sm-3 col-form-label">Inspector Name</label>
                                  <div class="col-sm-9">
                                      <input type="text" class="form-control inspector_name" id="inspectorname" readonly>
                                  </div>
                              </div>
                              
                              <div class="row mb-3">
                                  <label for="date" class="col-sm-3 col-form-label">Date</label>
                                  <div class="col-sm-9">
                                      <input type="text" class="form-control date" id="date" readonly>
                                  </div>
                              </div>
                              {{-- <div class="row mb-3">
                                  <label for="reviewby" class="col-sm-3 col-form-label">Review by Spv</label>
                                  <div class="col-sm-9">
                                      <input type="text" class="form-control" id="reviewby">
                                  </div>
                              </div> --}}

                              <div class="row mb-3">
                                  <label for="status" class="col-sm-3 col-form-label">Status</label>
                                  <div class="col-sm-9">
                                      <input type="text" class="form-control status_report" id="status" readonly>
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
    });
  </script>
  
  {{-- <script>
    function showPostDetails(id) {
        var url = $(event.target).data('url');
        $.ajax({
            url: url,
            // url: '/testing/' + id,
            type: 'GET',
            success: function(data) {
                // Mengisi data ke modal
                $('.submitedDate').text(data.sample_subtmitted_date);
    
                // Kosongkan list komentar sebelumnya
                // $('#commentsList').empty();
    
                // Tambahkan komentar ke list
                // data.comments.forEach(function(comment) {
                //     $('#commentsList').append('<li>' + comment.body + '</li>');
                // });
    
                // Tampilkan modal
                $('#varyingModal').modal('show');
            }
        });
    }
    </script> --}}
    


@endsection