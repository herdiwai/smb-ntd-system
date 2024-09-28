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
                    <h6 class="card-title">Sample Testing Report Approved</h6>
                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                            <tr>
                                    <th>No</th>
                                    <th>Summary After</th>
                                    <th>Schedule of Test</th>
                                    <th>Est of Completion Date</th>
                                    <th>Result Test</th>
                                    {{-- <th>status approvals</th> --}}
                                    <th>Approval Status</th>
                                    <th>Approval Status Action</th>
                                    <th>View Detail</th>
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
                                        {{-- <td>{{ $items->sampleTestingReport->status_approvals }}</td> --}}
                                        <td>
                                            @if($items->status_approvals == 'pending')
                                                <span class="badge bg-warning"><b>pending</b></span>
                                            @elseif($items->status_approvals == 'rejected')
                                                <span class="badge bg-danger"><b>rejected</b></span>
                                            @else
                                                <span class="badge bg-success"><b>approved</b></span>
                                            @endif
                                        </td>
                                        {{-- <td>
                                        @foreach ($items->approvals as $item)
                                            {{ $item->approvals_status }}
                                        @endforeach
                                        </td> --}}
                                        {{-- <td>
                                            @if ($items->status_approvals == 'pending')
                                                <span class="badge bg-danger">pending</span>
                                            @elseif ($items->status_approvals == 'rejected')
                                                <span class="badge bg-warning">rejected</span>
                                            @else
                                                <span class="badge bg-success"><b>approved</b></span>
                                            @endif
                                        </td> --}}
                                        <td>
                                            <!-- Form approval -->
                                            @if($items->status_approvals == 'pending')
                                            <form action="{{ route('store.approvals', $items->id) }}" method="POST">
                                                @csrf
                                                <button class="btn btn-inverse-success btn-sm" type="submit" name="approvals_status" value="approved" title="Approved"><i data-feather="check-circle"></i></button>
                                                &nbsp;&nbsp;
                                                <button class="btn btn-inverse-danger btn-sm" type="submit" name="approvals_status" value="rejected" title="Rejected"><i data-feather="x-circle"></i></button>
                                                
                                                {{-- <select class="form-select" name="approvals_status" required>
                                                    <option value="approved">Approved</option>
                                                    <option value="rejected">Rejected</option>
                                                </select>
                                                <br>
                                                <input type="text" class="form-control" name="notes" placeholder="Notes (opsional)">
                                                <br>
                                                <button class="btn btn-inverse-primary btn-sm" type="submit">submit</button> --}}
                                       
                                                {{-- @elseif($items->approvals_status == 'rejected')
                                                    <button class="btn btn-inverse-success btn-sm" type="submit" name="approvals_status" value="approved" title="Approved"><i data-feather="check-circle"></i></button>
                                                    &nbsp;&nbsp;
                                                    <button class="btn btn-inverse-danger btn-sm" type="submit" name="approvals_status" value="rejected" title="Rejected"><i data-feather="x-circle"></i></button> --}}
                                                @else
                                                     <p>Approvals has been completed</p>
                                                @endif 
                                        </td>
                                        {{-- <td>
                                            <a href="{{ route('show.testing', $items->id) }}" class="btn btn-inverse-success btn-xs" title="ShowDetail"><i data-feather="edit"></i></a>
                                        </td> --}}
                                        <td>
                                            <button type="button" class="btn btn-inverse-warning btn-sm view-details" data-bs-toggle="modal" data-bs-target="#varyingModal" data-id="{{ $items->id }}" title="View Detail"><i data-feather="eye"></i></button>
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

    {{-- MODAL --}}
    <div class="modal fade" id="varyingModal" data-id="{{ $items->id }}" tabindex="-1" aria-labelledby="varyingModalLabel" aria-hidden="true">
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

                            <form class="forms-sample">
                                <div class="row mb-3">
                                    <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Sample Submitted Date</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="exampleInputUsername2" placeholder="27-09-2024">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Doc.No</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="exampleInputEmail2" autocomplete="off" placeholder="IQC /E /K-Supreme /2024-09-27 /336573 /STR-0012">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="exampleInputMobile" class="col-sm-3 col-form-label">Series</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="exampleInputMobile" placeholder="RRU17237901DST">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="exampleInputPassword2" class="col-sm-3 col-form-label">No Of Sample</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="exampleInputPassword2" autocomplete="off" placeholder="Password">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="exampleInputPassword2" class="col-sm-3 col-form-label">Test Purpose</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="exampleInputPassword2" autocomplete="off" placeholder="NORMAL LIFE AND RELIABILITY TEST">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="exampleInputPassword2" class="col-sm-3 col-form-label">Summary Before</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control" id="remarks" name="test_purpose" rows="5" placeholder="NG IN RUBBER"></textarea>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="exampleInputPassword2" class="col-sm-3 col-form-label">Shift</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="exampleInputPassword2" autocomplete="off" placeholder="2nd">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="exampleInputPassword2" class="col-sm-3 col-form-label">Check By</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="exampleInputPassword2" autocomplete="off" placeholder="Melta">
                                    </div>
                                </div>

                            </form>
          </div>
        </div>

                </div>
                <div class="col-md-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">

                            <h6 class="card-title">SAMPLE TESTING REPORT FORM (2)</h6>

                            <form class="forms-sample">
                                <div class="row mb-3">
                                    <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Received Sample Date</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="exampleInputUsername2" placeholder="27-09-2024">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="exampleInputPassword2" class="col-sm-3 col-form-label">Summary After</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control" id="remarks" name="test_purpose" rows="5" placeholder="RUBBER OK"></textarea>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Test Result</label>
                                    <div class="col-sm-9">
                                        <input type="email" class="form-control" id="exampleInputEmail2" autocomplete="off" placeholder="PASS">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="exampleInputMobile" class="col-sm-3 col-form-label">Schedule of Test</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="exampleInputMobile" placeholder="27-09-2024">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="exampleInputMobile" class="col-sm-3 col-form-label">Est Of Completion Date</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="exampleInputMobile" placeholder="28-09-2024">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="exampleInputMobile" class="col-sm-3 col-form-label">Inspector Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="exampleInputMobile" placeholder="Habsyam">
                                    </div>
                                </div>
                                
                                <div class="row mb-3">
                                    <label for="exampleInputMobile" class="col-sm-3 col-form-label">Date</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="exampleInputMobile" placeholder="28-09-2924">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="exampleInputMobile" class="col-sm-3 col-form-label">Review by Spv</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="exampleInputMobile" placeholder="Tirta">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="exampleInputMobile" class="col-sm-3 col-form-label">Date</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="exampleInputMobile" placeholder="29-09-2924">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="exampleInputMobile" class="col-sm-3 col-form-label">Status</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="exampleInputMobile" placeholder="Complete">
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
{{-- <script>
    $(document).ready(function() {
        // Ketika tombol "View Details" diklik
        $('.view-details').click(function() {
            var testingId = $(this).data('id'); // Ambil ID testing dari atribut data-id
            if(testingId === undefined || testingId === null) {
                alert('Invalid testing ID!');
                return; // Jangan lanjutkan jika testing tidak valid
            }
            // AJAX request untuk mengambil data detail testing
            $.ajax({
                url: '/testing/' + testingId, // URL endpoint untuk mengambil data
                type: 'GET',
                success: function(response) {
                    // Masukkan data detail testing ke dalam modal
                    $('#testingDetails').html(response);
                },
                error: function() {
                    $('#testingDetails').html('<p class="text-danger">Failed to fetch details.</p>');
                }
            });
        });
    });
</script> --}}

@endsection