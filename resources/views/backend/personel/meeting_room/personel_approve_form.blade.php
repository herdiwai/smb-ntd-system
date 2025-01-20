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

                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <div class="form-group">
                                    <div class="row align-items-center">
                                        <div class="col-4">
                                            <label for="request_name" class="col-form-label col-form-label-sm"><b>Requester Name:</b></label>
                                        </div>
                                        <div class="col-8">
                                            <input type="text" class="form-control form-control-sm" id="request_name" name="request_name">
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
                                            <input type="text" class="form-control form-control-sm" id="request_dept" name="request_dept">
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
                                            <textarea class="form-control form-control-sm" name="description" id="description" rows="2"></textarea>
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
                                            <label for="start_time_approve" class="col-form-label col-form-label-sm"><b>Time:</b></label>
                                        </div>
                                        <div class="col-4">
                                            <input type="text" class="form-control form-control-sm" id="start_time" name="start_time_approve">
                                        </div>
                                        <div class="col-4">
                                            <input type="text" class="form-control form-control-sm" id="end_time" name="end_time_approve">
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
                            <!-- Tombol Booking Submit -->
                            <button class="btn btn-primary btn-sm me-3" type="submit">
                                <i data-feather="send" style="width: 16px; height: 16px;"></i> Booking Approve
                            </button>
                            
                            <!-- Tombol Booking Changes -->
                            <button class="btn btn-secondary btn-sm" type="button">
                                <i data-feather="edit" style="width: 16px; height: 16px;"></i> Booking Changes
                            </button>
                        </div>

                        
                        

                        

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection