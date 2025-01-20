@extends('admin.admin_dashboard')
@section('admin')
<div class="page-content">
    <div class="row justify-content-center">
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title"><b>MEETING ROOM RESERVATION FORM </b></h6>
                    <form id="myForm" action="" method="POST">
                        @method('POST')
                        @csrf

                        {{-- <input type="hidden" name="id" value="{{ $bookedrequest->id }}"> --}}

                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <div class="form-group">
                                    <div class="row align-items-center">
                                        <div class="col-4">
                                            <label for="request_name" class="col-form-label col-form-label-sm"><b>Requester Name:</b></label>
                                        </div>
                                        <div class="col-8">
                                            <input type="text" value="{{ old('Name', $bookedrequestid->Name) }}" class="form-control form-control-sm" id="request_name" name="Name" disabled>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <div class="form-group">
                                    <div class="row align-items-center">
                                        <div class="col-4">
                                            <label for="request_dept" class="col-form-label col-form-label-sm"><b>Department:</b></label>
                                        </div>
                                        <div class="col-8">
                                            <input type="text" value="{{ old('Department', $bookedrequestid->Department) }}" class="form-control form-control-sm" id="Department" name="Department" disabled>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-4">
                                            <label for="description" class="col-form-label col-form-label-sm"><b>Meeting Description:</b></label>
                                        </div>
                                        <div class="col-8">
                                            <textarea class="form-control form-control-sm" name="description" id="description" rows="2" disabled>{{ $bookedrequestid->Description }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <div class="form-group">
                                    <div class="row align-items-center">
                                        <div class="col-4">
                                            <label for="start_time" class="col-form-label col-form-label-sm"><b>Time:</b></label>
                                        </div>
                                        <div class="col-4">
                                            <input type="time" value="{{ old('Department', $bookedrequestid->Start_time) }}" class="form-control form-control-sm" id="start_time" name="start_time" min="08:00" max="17:00">
                                            <small class="text-muted">Start: Only 08:00 - 17:00</small>
                                        </div>
                                        <div class="col-4">
                                            <input type="time" value="{{ old('Department', $bookedrequestid->End_time) }}" class="form-control form-control-sm" id="end_time" name="end_time" min="08:00" max="17:00">
                                            <small class="text-muted">End: Only 08:00 - 17:00</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <div class="form-group">
                                    <div class="row align-items-center">
                                        <div class="col-sm-4">
                                            <label for="date" class="col-form-label col-form-label-sm"><b>Date</b></label>
                                        </div>
                                        <div class="col">
                                                <input type="date" value="{{ old('Date_booking', $bookedrequestid->Date_booking) }}" name="Date_booking" id="" class="form-control" placeholder="Select date" required />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <div class="form-group">
                                    <div class="row align-items-center mt-3">
                                        <div class="col-4">
                                            <label class="col-form-label col-form-label-sm"><b>Meeting Room:</b></label>
                                        </div>
                                        <div class="col-6">
                                            <label for="description" class="col-form-label col-form-label-sm"><b>C | Room 1 | GF | Internal & External</b></label>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="d-flex justify-content-center">
                            <button class="btn btn-primary btn-sm me-2" type="submit">
                                <i data-feather="send" style="width: 16px; height: 16px;"></i><b>Approve</b>
                            </button>
                            <button type="button" class="btn btn-inverse-danger btn-xs" data-bs-toggle="modal" data-bs-target="#rejectModalBooking" onclick="openRejectBooking" title="Sign">
                                <i data-feather="check-square" style="width: 16px; height: 16px;"></i><b>Reject</b>
                            </button>
                        </div>

                    
                    </form>
                </div>
            </div>

            {{-- MODAL REJECT BOOKING --}}
            <div class="modal fade" id="rejectModalBooking" tabindex="-1" role="dialog" aria-labelledby="rejectModalBookingModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="rejectModalBookingModalLabel">Status Reject Booking Form</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
                        </div>
                        <form id="rejectFormBooking" class="myForm2" action="" method="POST">
                            @csrf
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <div class="form-group">
                                            <div class="form-row align-items-center">
                                                <div class="col-sm">
                                                    <label for="Note_spv_pd" class="col-form-label col-form-label-sm"><b>Noted:</b></label>
                                                </div>
                                                <div class="col">
                                                    <textarea class="form-control form-control-sm" name="status_booking_room" id="status_booking_room" rows="2"></textarea>
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
            {{-- END MODAL REJECT BOOKING--}}
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    // Mode Sign Spv Production
    function openRejectBooking(itemId) {
        // Set the form action dynamically based on the item ID
        var actionUrl = "{{ route('update.signspv', ':id') }}";
        actionUrl = actionUrl.replace(':id', itemId);
        $('#rejectFormBooking').attr('action', actionUrl);
        // Optionally reset the form fields when modal is opened
        // $('#approval_status').val('approved'); // default status
        // $('#notes').val('');
        
        // Show the modal
        $('#rejectModalBooking').modal('show');
    }
</script>
@endsection