@extends('admin.admin_dashboard')
@section('admin')
<div class="page-content">
    <div class="row justify-content-center">
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title"><b>FORM INPUT WO TECHNICIAN </b></h6>

                    <form id="myForm" action="{{ route('store.wotechnician', $wo_id->id) }}" method="POST">
                        @method('POST')
                        @csrf
                      
                        <input type="hidden" name="id" value="{{ $wo_id->id }}">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <div class="form-row align-items-center">
                                        <div class="col-sm-3">
                                            <label for="date" class="col-form-label col-form-label-sm"><b>Date</b></label>
                                        </div>
                                        <div class="col">
                                            <input type="date" value="{{ old('date', $wo_id->date ?? '') }}" class="form-control form-control-sm" name="date" id="date" disabled>
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
                                            <input type="text" value="{{ old('request_dept', $wo_id->request_dept) }}" class="form-control form-control-sm" id="request_dept" name="request_dept" disabled>
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
                                            <label for="report_by" class="col-form-label col-form-label-sm"><b>Reported By</b></label>
                                        </div>
                                        <div class="col">
                                            <input type="text" value="{{ old('report_by', $wo_id->reported_by) }}" class="form-control form-control-sm" id="report_by" name="report_by" disabled>
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
                                            <input type="text" value="{{ old('request_by', $wo_id->request_by) }}" class="form-control form-control-sm" id="request_by" name="request_by" disabled>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <div class="form-row align-items-center">
                                        <div class="col-sm-3">
                                            <label for="line" class="col-form-label col-form-label-sm"><b>Line</b></label>
                                        </div>
                                        <div class="col">
                                            @if($wo_id->line == '-') <!-- Memeriksa apakah nilai line adalah '-' -->
                                                <input type="text" value="{{ old('line_id', $wo_id->line) }}" class="form-control form-control-sm" id="line" name="line_id" disabled>
                                            @else
                                                <input type="text" value="{{ old('line_id', $wo_id->lines->line) }}" class="form-control form-control-sm" id="line" name="line_id">
                                            @endif
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
                                            <input type="text" value="{{ old('location', $wo_id->location) }}" class="form-control form-control-sm" id="location" name="location" disabled>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <div class="form-row align-items-center">
                                        <div class="col-sm-3">
                                            <label for="lot" class="col-form-label col-form-label-sm"><b>Lot</b></label>
                                        </div>
                                        <div class="col">
                                            @if($wo_id->lot == '-') <!-- Memeriksa apakah nilai line adalah '-' -->
                                                <input type="text" value="{{ old('lot_id', $wo_id->lot) }}" class="form-control form-control-sm" id="lot" name="lot_id" disabled>
                                            @else
                                                <input type="text" value="{{ old('lot_id', $wo_id->lots->lot) }}" class="form-control form-control-sm" id="lot" name="lot_id">
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <div class="form-row align-items-center">
                                        <div class="col-sm-3">
                                            <label for="shift" class="col-form-label col-form-label-sm"><b>Shift</b></label>
                                        </div>
                                        <div class="col">
                                            @if($wo_id->shift == '-') <!-- Memeriksa apakah nilai line adalah '-' -->
                                                <input type="text" value="{{ old('shift_id', $wo_id->shift) }}" class="form-control form-control-sm" id="shift" name="shift_id" disabled>
                                            @else
                                                <input type="text" value="{{ old('shift_id', $wo_id->shifts->shift) }}" class="form-control form-control-sm" id="shift" name="shift_id">
                                            @endif
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
                                            <input type="text" value="{{ old('request_time', $wo_id->request_time ) }}" class="form-control form-control-sm" id="request_time" name="request_time" disabled>
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
                                            <input type="text" value="{{ old('priority', $wo_id->priority ) }}" class="form-control form-control-sm" id="priority" name="priority" disabled>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <div class="form-group">
                                    <div class="form-row align-items-center">
                                        <div class="col-sm">
                                            <label for="description" class="col-form-label col-form-label-sm"><b>Description</b></label>
                                        </div>
                                        <div class="col">
                                            <textarea class="form-control" name="description" id="description" rows="2" readonly>{{ old('description', $wo_id->decription) }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr/>

                        <div class="row">     
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <div class="form-row align-items-center">
                                        <div class="col-sm">
                                            <label for="assigned_technician" class="col-form-label col-form-label-sm"><b>Assigned To</b></label>
                                        </div>
                                        <div class="col">
                                            <input type="text" class="form-control form-control-sm" id="assigned_technician" name="assigned_technician">
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
                                            <input type="text" class="form-control form-control-sm" id="time_spent" name="time_spent">
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
                                            <label for="complated_by_technician" class="col-form-label col-form-label-sm"><b>Complated By</b></label>
                                        </div>
                                        <div class="col">
                                            <input type="text" class="form-control form-control-sm" id="complated_by_technician" name="complated_by_technician">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <div class="form-row align-items-center">
                                        <div class="col-sm">
                                            <label for="date_complated_technician" class="col-form-label col-form-label-sm"><b>Date Complated</b></label>
                                        </div>
                                        <div class="col">
                                                <input type="date" name="date_complated_technician" id="date_complated_technician" class="form-control" placeholder="Select date" value="{{ old('date_complated_technician', session('date_complated_technician')) }}" required />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-primary btn-sm" type="submit"><i data-feather="send" style="width: 16px; height: 16px;"></i> SAVE</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection