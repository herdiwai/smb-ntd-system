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
                                    <th>status review QE-IQC</th>
                                    <th>status review QE-QCA</th>
                                    <th>Status Approvals Manager</th>
                                    <th>Action Corection Form Requisition</th>
                                    <th>Action Report</th>
                                    <th>Edit Report</th>
                                    @if(Auth::user()->can('column.delete'))
                                    <th>action</th>
                                    @endif
                                    {{-- <th>Notes QE-IQC</th> --}}
                                    <th>Notes QE-QCA</th>
                                    <th><th>Notes Correction</th></th>
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

{{-- MODAL CORECTION FORM REQUISITION --}}
<!-- Modal -->
<div class="modal fade" id="correctionModal" tabindex="-1" role="dialog" aria-labelledby="approvalModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="approvalModalLabel">Correction Form</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
          {{-- <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"> --}}
            {{-- <span aria-hidden="true">&times;</span> --}}
          </button>
        </div>
        <form id="correctionFormModal" action="" method="POST">
          @csrf
          @method('POST')
          <div class="modal-body">
            <div class="form-group">
              <label for="approval_status">Correction Status</label>
              <select name="status_approvals_id_qc" id="approval_status" class="form-control">
                <option value="1">Approved</option>
                <option value="2">Rejected</option>
              </select>
            </div>
            <div class="form-group">
              <label for="notes">Notes</label>
              <textarea name="notes_qc" id="notes" class="form-control" rows="4" placeholder="Optional"></textarea>
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
{{-- END MODAL CORECTION FORM REQUISITION--}}


<script type="text/javascript">

    // $('#serverside tbody').on('click', 'tr', function() {
    //     $(this).toggleClass('selected');  // Tambahkan kelas 'selected' pada baris yang dipilih
    // });
        $(document).ready( function() {
            var canDelete = {{ Auth::user()->can('column.delete') ? 'true' : 'false' }};
            var columns = [
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
                        data: 'status_review_qe_iqc',
                        name: 'status_review_qe_iqc',
                    },
                    {
                        data: 'status_review_qe_qca',
                        name: 'status_review_qe_qca',
                    },
                    {
                        data: 'status_approvals',
                        name: 'status_approvals',
                    },
                    {
                        data: 'action_correction',
                        name: 'action_correction',
                    },
                    {
                        data: 'action_report',
                        name: 'action_report',
                    },
                    {
                        data: 'edit_report',
                        name: 'edit_report',
                    },
                    {
                        data: 'notes_qe_qca',
                        name: 'notes_qe_qca',
                    },
                    {
                        data: 'notes_correction',
                        name: 'notes_correction',
                    },
                    
                    ];
                    if(canDelete) {
                        columns.push({ data: 'action', name: 'action'});
                    }
                    
            $('#serverside').DataTable({
                pageLength: 10,
                lengthMenu: [ [5,10, 25, 50, -1], [5, 10, 25, 50, "All"] ],
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
                drawCallback: function() {
                        feather.replace(); // Redraw icons after table update
                    },
                ajax:{
                    url:"{{ route('qualitycontrol.sampletestingreport') }}",
                },
                columns:columns
            });
        });

    // modal Corection Form Requisition
    function openCorrectionForm(itemId) {
        // Set the form action dynamically based on the item ID
        var actionUrl = "{{ route('update.correction', ':id') }}";
        actionUrl = actionUrl.replace(':id', itemId);
        $('#correctionFormModal').attr('action', actionUrl);
        // Optionally reset the form fields when modal is opened
        // $('#approval_status').val('approved'); // default status
        // $('#notes').val('');
        
        // Show the modal
        $('#correctionModal').modal('show');
    }// End modal Corection Form Requisition


</script>


</div>
@endsection