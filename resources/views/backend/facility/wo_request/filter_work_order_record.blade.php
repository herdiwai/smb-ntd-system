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
    <div class="row">
        <form action="{{ route('filter.workorder') }}" method="GET" class="mb-3">
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

                <!-- Filter by Lot -->
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="lot">Lot:</label>
                        <select name="lot_id" id="lot" class="form-select form-select-xs">
                            <option value="">--select lot--</option>
                            @foreach($lot as $lots)
                                <option value="{{ $lots->id }}" {{ old('lot_id') == $lots->id ? 'selected' : '' }}>{{ $lots->lot }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Filter by Line -->
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="lot">Line:</label>
                        <select name="line_id" id="line" class="form-select form-select-xs">
                            <option value="">--select line--</option>
                            @foreach($line as $lines)
                                <option value="{{ $lines->id }}" {{ old('line_id') == $lines->id ? 'selected' : '' }}>{{ $lines->line }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Filter by shift -->
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="shift">shift:</label>
                        <select name="shift_id" id="shift" class="form-select form-select-xs">
                            <option value="">--select shift--</option>
                            @foreach($shift as $shifts)
                                <option value="{{ $shifts->id }}" {{ old('shift_id') == $shifts->id ? 'selected' : '' }}>{{ $shifts->shift }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Filter by status -->
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="status">status:</label>
                        <select name="status_wo" id="status_wo" class="form-control form-control-xs">
                            <option value="">--select status--</option>
                            <option value="complete">complete</option>
                            <option value="incomplete">incomplete</option>
                            {{-- @foreach($mrr_status as $status_mrrs)
                                <option value="{{ $status_mrrs }}" {{ old('status') == $status_mrrs ? 'selected' : '' }}>{{ $status_mrrs }}</option>
                            @endforeach --}}
                        </select>
                    </div>
                </div>

                <!-- Filter by priority -->
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="status">Priority:</label>
                        <select name="status_priority" id="status_priority" class="form-select form-select-xs">
                            <option value="">--select priority--</option>
                            <option value="High">High</option>
                            <option value="Medium">Medium</option>
                            <option value="Low">Low</option>
                            {{-- @foreach($mrr_status as $status_mrrs)
                                <option value="{{ $status_mrrs }}" {{ old('status') == $status_mrrs ? 'selected' : '' }}>{{ $status_mrrs }}</option>
                            @endforeach --}}
                        </select>
                    </div>
                </div>

                <div class="col-md-2 align-self-end mt-3"> <!-- Tambahkan kelas 'mt-3' di sini -->
                    <button type="submit" class="btn btn-info btn-xs">
                        <i data-feather="search" style="width: 16px; height: 16px;"></i> Search..
                    </button>
                    <a href="{{ route('filter.workorder') }}" class="btn btn-light btn-xs" style="position: absolute; margin-left:1%;">
                        <i data-feather="refresh-ccw" style="width: 16px; height: 16px;"></i> Refresh
                    </a>
                </div>
            </div>
        </form>

        <form action="{{ route('workorder.export-excel') }}" method="POST">
            @csrf
            <input type="hidden" name="from_date" value="{{ request('from_date') }}">
            <input type="hidden" name="to_date" value="{{ request('to_date') }}">
            <input type="hidden" name="model_id" value="{{ request('model_id') }}">
            <input type="hidden" name="lot_id" value="{{ request('lot_id') }}">
            <input type="hidden" name="line_id" value="{{ request('line_id') }}">
            <input type="hidden" name="shift_id" value="{{ request('shift_id') }}">
            <input type="hidden" name="status_wo" value="{{ request('status_wo') }}">
            <input type="hidden" name="status_priority" value="{{ request('status_priority') }}">
            
            <div class="col-md-2 align-self-end">
                <button type="submit" class="btn btn-success btn-xs"><i data-feather="download" style="width: 16px; height: 16px;"></i> Export to Excel..</button>
            </div>
        </form>
    </div>
    <br>
   
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title"> WORK ORDER RECORD FORM</h6>
                    <div class="table-responsive">
                        <table id="" class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Date</th>
                                    <th>Reported By</th>
                                    <th>Requested By</th>
                                    <th>Requested Dept</th>
                                    <th>Line</th>
                                    <th>Lot</th>
                                    <th>Shift</th>
                                    <th>Location</th>
                                    <th>Description</th>
                                    <th>Priority</th>
                                    <th>Report Time</th>
                                    <th>Status WO</th>

                                    <th hidden>Assign Tch</th>
                                    <th hidden>Time Spent</th>
                                    <th hidden>completed Tch</th>
                                    <th hidden>Completed Date</th>
                                    <th hidden>Sign Spv</th>

                                    <th>View Detail</th>
                                    
                                    <th>Export to PDF</th> 
                                </tr>
                            </thead>
                            <tbody>
                                @if($workorder->isEmpty())
                                        <tr>
                                            <td colspan="3" style="color: red;">No data found</td>
                                        </tr>
                                    @else
                                @foreach ($workorder as $key => $facility)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td class="date">{{ $facility->date }}</td>
                                        <td class="reported-by">{{ $facility->reported_by }}</td>
                                        <td class="request-by">{{ $facility->request_by }}</td>
                                        <td class="request-dept">{{ $facility->request_dept }}</td>
                                        <td class="line">{{ $facility->lines->line ?? '-' }}</td>
                                        <td class="lot">{{ $facility->lots->lot ?? '-' }}</td>
                                        <td class="shift">{{ $facility->shifts->shift ?? '-' }}</td>
                                        <td class="location">{{ $facility->location ?? '-' }}</td>
                                        <td class="description">{{ $facility->decription }}</td>
                                        <td class="priority">{{ $facility->priority }}</td>
                                        <td class="request-time">{{ $facility->request_time }}</td>
                                        <td>
                                            @if($facility->status == 'incomplete')
                                                <span class="badge bg-danger" style="color: black;"> {{ $facility->status }} </span>
                                            @else
                                                <span class="badge bg-info" style="color: black;"> {{ $facility->status }} </span>
                                            @endif
                                        </td>

                                        <td class="assigned-technician" hidden>{{ $facility->assigned_technician}}</td>
                                        <td class="time-spent" hidden>{{ $facility->time_spent }}</td>
                                        <td class="completed-by" hidden>{{ $facility->complated_by_technician }}</td>
                                        <td class="date-completed" hidden>{{ $facility->date_complated_technician }}</td>
                                        <td class="name-spv" hidden>{{ $facility->name_spv }}</td>




                                        <td><button type="button" class="btn btn-inverse-primary btn-xs view-details" data-bs-toggle="modal" data-bs-target="#varyingModal" data-id="'.$facility->id.'" title="View Detail"><i data-feather="eye" style="width: 16px; height: 16px;"></i></button></td>
                                       
                                        {{-- <td><a href="{{ route('delete.workorder', $workorder->id) }}" class="btn btn-inverse-danger btn-sm" title="Delete"><i data-feather="trash-2"></i></a></td> --}}
                                         
                                       @if($facility->status == 'incomplete')
                                            <td><p class="text-danger">status work order not complete</p></td>
                                        @elseif($facility->status == 'complete')
                                            <td><a href="{{ route('wo.export-pdf', $facility->id ) }}" class="btn btn-inverse-success btn-xs" title="Export-PDF"><i data-feather="download" style="width: 16px; height: 16px;"></i> PDF</a></td>
                                        @endif
                                    </tr>
                                    @endforeach
                                    @endif
                            </tbody>
                        </table>
                        {{ $workorder->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </div>



{{-- MODAL VIEW DETAIL --}}
<div class="modal fade" id="varyingModal" tabindex="-1" role="dialog" aria-labelledby="varyingModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="varyingModalLabel">Facility Work Order</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
            </div>
            <form action="" method="POST">
                <div class="modal-body">
                    <div class="row">
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
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <div class="form-row align-items-center">
                                    <div class="col-sm">
                                        <label for="request_dept" class="col-form-label col-form-label-sm"><b>Request Dept</b></label>
                                    </div>
                                    <div class="col">
                                        <!-- Ganti 'request_dept' di input class menjadi 'request-dept' agar sesuai dengan script -->
                                        <input type="text" class="form-control form-control-sm request-dept" id="request_dept" disabled>
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
                                        <label for="reported_by" class="col-form-label col-form-label-sm"><b>Reported By</b></label>
                                    </div>
                                    <div class="col">
                                        <!-- Ganti 'request_dept' di input class menjadi 'request-dept' agar sesuai dengan script -->
                                        <input type="text" class="form-control form-control-sm reported-by" id="reported_by" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <div class="form-row align-items-center">
                                    <div class="col-sm">
                                        <label for="request_by" class="col-form-label col-form-label-sm"><b>Requested By</b></label>
                                    </div>
                                    <div class="col">
                                        <!-- Ganti 'request_dept' di input class menjadi 'request-dept' agar sesuai dengan script -->
                                        <input type="text" class="form-control form-control-sm request-by" id="request_by" disabled>
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
                                        <label for="line" class="col-form-label col-form-label-sm line"><b>Line</b></label>
                                    </div>
                                    <div class="col">
                                        <input type="text" class="form-control form-control-sm line" id="line" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <div class="form-row align-items-center">
                                    <div class="col-sm">
                                        <label for="location" class="col-form-label col-form-label-sm"><b>Location</b></label>
                                    </div>
                                    <div class="col">
                                        <!-- Ganti 'request_dept' di input class menjadi 'request-dept' agar sesuai dengan script -->
                                        <input type="text" class="form-control form-control-sm location" id="location" disabled>
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
                                        <label for="lot" class="col-form-label col-form-label-sm lot"><b>Lot</b></label>
                                    </div>
                                    <div class="col">
                                        <input type="text" class="form-control form-control-sm lot" id="lot" disabled>
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
                                        <label for="request_time" class="col-form-label col-form-label-sm"><b>Request Time</b></label>
                                    </div>
                                    <div class="col">
                                        <input type="text" class="form-control form-control-sm request-time" id="request_time" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <div class="form-row align-items-center">
                                    <div class="col-sm">
                                        <label for="priority" class="col-form-label col-form-label-sm"><b>Priority</b></label>
                                    </div>
                                    <div class="col">
                                        <input type="text" class="form-control form-control-sm priority" id="priority" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group mb-3">
                            <label for="description"><b>Description:</b></label>
                            <textarea class="form-control description" id="description" rows="2" placeholder="" disabled></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <div class="form-row align-items-center">
                                    <div class="col-sm">
                                        <label for="assigned_technician" class="col-form-label col-form-label-sm"><b>Assigned To</b></label>
                                    </div>
                                    <div class="col">
                                        <input type="text" class="form-control form-control-sm assigned-technician" id="assigned_technician" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <div class="form-row align-items-center">
                                    <div class="col-sm">
                                        <label for="time_spent" class="col-form-label col-form-label-sm"><b>Time Spent (Hour/Min)</b></label>
                                    </div>
                                    <div class="col">
                                        <input type="text" class="form-control form-control-sm time-spent" id="time_spent" disabled>
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
                                        <label for="completed_by_technician" class="col-form-label col-form-label-sm"><b>Completed By</b></label>
                                    </div>
                                    <div class="col">
                                        <input type="text" class="form-control form-control-sm completed-by" id="completed_by_technician" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <div class="form-row align-items-center">
                                    <div class="col-sm">
                                        <label for="date_completed_technician" class="col-form-label col-form-label-sm"><b>Date Completed</b></label>
                                    </div>
                                    <div class="col">
                                        <input type="text" class="form-control form-control-sm date-completed" id="date_completed_technician" disabled>
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
                                        <label for="name_spv" class="col-form-label col-form-label-sm"><b>Name Spv</b></label>
                                    </div>
                                    <div class="col">
                                        <input type="text" class="form-control form-control-sm name-spv" id="name_spv" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    

                </div>
            </form>
        </div>
    </div>
</div>

</div>

<script type="text/javascript">
    // Mode QC Accepted
    function openQcAccepted(itemId) {
        // Set the form action dynamically based on the item ID
        var actionUrl = "{{ route('update.spv', ':id') }}";
        actionUrl = actionUrl.replace(':id', itemId);
        $('#spvFormAccepted').attr('action', actionUrl);
        // Optionally reset the form fields when modal is opened
        // $('#approval_status').val('approved'); // default status
        // $('#notes').val('');
        
        // Show the modal
        $('#spvAccepted').modal('show');
    }

    $(document).on('click','.view-details', function(){
        var _this = $(this).parents('tr');
            $('.date').val(_this.find('.date').text());
            $('.reported-by').val(_this.find('.reported-by').text());
            $('.request-by').val(_this.find('.request-by').text());
            $('.request-dept').val(_this.find('.request-dept').text());
            $('.line').val(_this.find('.line').text());
            $('.lot').val(_this.find('.lot').text());
            $('.shift').val(_this.find('.shift').text());
            $('.location').val(_this.find('.location').text());
            $('.description').val(_this.find('.description').text());
            $('.priority').val(_this.find('.priority').text());
            $('.request-time').val(_this.find('.request-time').text());
            $('.assigned-technician').val(_this.find('.assigned-technician').text());
            $('.time-spent').val(_this.find('.time-spent').text());
            $('.completed-by').val(_this.find('.completed-by').text());
            $('.date-completed').val(_this.find('.date-completed').text());
            $('.name-spv').val(_this.find('.name-spv').text())
                    
          
                        
    });

</script>

@endsection