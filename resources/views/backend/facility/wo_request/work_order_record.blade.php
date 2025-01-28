@extends('admin.admin_dashboard')
@section('admin')
<div class="page-content">
  
    <nav class="page-breadcrumb">
        <ol class="breadcrumb"> 
             <a href="{{ route('add.WorkOrderRecord') }}" class="btn btn-inverse-info btn-xs"><i data-feather="file-plus" style="width: 16px; height: 16px;"></i> ADD WO FORM</a>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Table Work Order Request</h6>
                    <div class="table-responsive">
                        <table id="table" class="table">
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
                                    <th>Action Techinician</th>
                                    <th>Action Spv FCT</th>
                                    <th>Export to PDF</th>
                                    <th>Action</th>   
                                </tr>
                            </thead>
                            <tbody>
                                
                                @foreach ($workrequest as $key => $workorder)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td class="date">{{ $workorder->date }}</td>
                                        <td class="reported-by">{{ $workorder->reported_by }}</td>
                                        <td class="request-by">{{ $workorder->request_by }}</td>
                                        <td class="request-dept">{{ $workorder->request_dept }}</td>
                                        <td class="line">{{ $workorder->lines->line ?? '-' }}</td>
                                        <td class="lot">{{ $workorder->lots->lot ?? '-' }}</td>
                                        <td class="shift">{{ $workorder->shifts->shift ?? '-' }}</td>
                                        <td class="location">{{ $workorder->location ?? '-' }}</td>
                                        <td class="description">{{ $workorder->decription }}</td>
                                        <td class="priority">{{ $workorder->priority }}</td>
                                        <td class="request-time">{{ $workorder->request_time }}</td>

                                        <td>
                                            @if($workorder->status == 'incomplete')
                                                <span class="badge bg-danger" style="color: black;"> {{ $workorder->status }} </span>
                                            @else
                                                <span class="badge bg-info" style="color: black;"> {{ $workorder->status }} </span>
                                            @endif
                                        </td>

                                        <td class="assigned-technician" hidden>{{ $workorder->assigned_technician}}</td>
                                        <td class="time-spent" hidden>{{ $workorder->time_spent }}</td>
                                        <td class="completed-by" hidden>{{ $workorder->complated_by_technician }}</td>
                                        <td class="date-completed" hidden>{{ $workorder->date_complated_technician }}</td>
                                        <td class="name-spv" hidden>{{ $workorder->name_spv }}</td>




                                        <td><button type="button" class="btn btn-inverse-primary btn-xs view-details" data-bs-toggle="modal" data-bs-target="#varyingModal" data-id="'.$workorder->id.'" title="View Detail"><i data-feather="eye" style="width: 16px; height: 16px;"></i></button></td>
                                        <td>
                                            <a href="{{ route('edit.wotechnician', $workorder->id ) }}" class="btn btn-inverse-warning btn-xs" title="Add WO"><i data-feather="edit" style="width: 16px; height: 16px;"></i></a>
                                        </td>

                                        <td>
                                            <button type="button" class="btn btn-inverse-info btn-xs" data-bs-toggle="modal" data-bs-target="#spvAccepted" onclick="openQcAccepted({{ $workorder->id }})" title="Sign">
                                                <i data-feather="check-square" style="width: 16px; height: 16px;"></i>
                                            </button>
                                        </td>
                                        
                                       @if($workorder->status == 'incomplete')
                                            <td><p class="text-danger">status work order not complete</p></td>
                                        @elseif($workorder->status == 'complete')
                                            <td><a href="{{ route('wo.export-pdf', $workorder->id ) }}" class="btn btn-inverse-success btn-xs" title="Export-PDF"><i data-feather="download" style="width: 16px; height: 16px;"></i> PDF</a></td>
                                        @endif

                                         <td><a href="{{ route('delete.workorder', $workorder->id) }}" class="btn btn-inverse-danger btn-sm" title="Delete"><i data-feather="trash-2"></i></a></td>
                                       

                                       
                                    </tr>
                                @endforeach
                            </tbody>

                        </table>
                        {{ $workrequest->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>

        {{-- MODAL QC ACCEPTED --}}
        <div class="modal fade" id="spvAccepted" tabindex="-1" role="dialog" aria-labelledby="spvAcceptedModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="spvAcceptedModalLabel">Facility Form</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
                </div>
                <form id="spvFormAccepted" action="" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <div class="form-row align-items-center">
                                        <div class="col-sm">
                                            <label for="name_spv" class="col-form-label col-form-label-sm"><b>Name</b></label>
                                        </div>
                                        <div class="col">
                                            <input type="text" class="form-control form-control-sm" name="name_spv" id="name_spv" >
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <div class="form-row align-items-center">
                                        <div class="col-sm">
                                            <label for="time_accepted" class="col-form-label col-form-label-sm"><b>Time</b></label>
                                        </div>
                                        <div class="col">
                                            <input type="time" class="form-control form-control-sm" name="time_accepted" id="time_accepted" >
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <div class="form-row align-items-center">
                                        <div class="col-sm">
                                            <label for="date_final" class="col-form-label col-form-label-sm"><b>Date</b></label>
                                        </div>
                                        <div class="col">
                                            <input type="date" name="date_final" id="" class="form-control" placeholder="Select date" value="{{ old('date_final', session('date_final')) }}" required />
                                    </div>
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
                                        <label for="name_spv" class="col-form-label col-form-label-sm"><b>Assigned To</b></label>
                                    </div>
                                    <div class="col">
                                        <input type="text" class="form-control form-control-sm name_spv" id="name_spv" disabled>
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
                    {{-- <div class="row">
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
                    </div> --}}
                    

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