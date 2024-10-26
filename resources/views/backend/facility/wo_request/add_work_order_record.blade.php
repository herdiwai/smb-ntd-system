@extends('admin.admin_dashboard')
@section('admin')

<div class="page-content">
    <div class="row justify-content-center">
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title"><b>FORM INPUT WORK ORDER </b></h6>
                    <form id="myForm" action="" method="POST">
                        @method('POST')
                        @csrf

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <div class="form-row align-items-center">
                                        <div class="col-sm-3">
                                            <label for="date" class="col-form-label col-form-label-sm"><b>Date</b></label>
                                        </div>
                                        <div class="col">
                                                <input type="date" name="date" id="" class="form-control" placeholder="Select date" value="{{ old('date', session('date')) }}" required />
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
                                            <input type="text" class="form-control form-control-sm" id="request_dept" name="request_dept">
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
                                            <input type="text" class="form-control form-control-sm" id="report_by" name="report_by">
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
                                            <input type="text" class="form-control form-control-sm" id="request_by" name="request_by">
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
                                            <select id="line" name="line_id" class="form-select form-select-sm">
                                                <option value="">Select Line</option>
                                                @foreach($line as $lines)
                                                    <option value="{{ $lines->id }}">{{ $lines->line }}</option>
                                                @endforeach
                                            </select>
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
                                            <input type="text" class="form-control form-control-sm" id="location" name="location">
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
                                            <select id="lot" name="lot_id" class="form-select form-select-sm">
                                                <option value="">Select Lot</option>
                                                @foreach($lot as $lots)
                                                    <option value="{{ $lots->id }}">{{ $lots->lot }}</option>
                                                @endforeach
                                            </select>
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
                                            <select id="shift" name="shift_id" class="form-select form-select-sm">
                                                <option value="">Select Shift</option>
                                                @foreach($shift as $shifts)
                                                    <option value="{{ $shifts->id }}">{{ $shifts->shift }}</option>
                                                @endforeach
                                            </select>
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
                                            <input type="time" class="form-control form-control-sm" name="request_time" id="request_time" >
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <div class="form-row align-items-center">
                                        <div class="col-sm-3">
                                            <label for="priority" class="col-form-label col-form-label-sm"><b>Priority</b></label>
                                        </div>
                                        <div class="col">
                                            <div class="row">
                                                <div class="col-md-4 d-flex align-items-center">
                                                    <div class="form-check me-3">
                                                        <input class="form-check-input" type="checkbox" id="priority1" value="High" name="priority">
                                                        <label class="form-check-label" for="priority1">High</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 d-flex align-items-center">
                                                    <div class="form-check me-3">
                                                        <input class="form-check-input" type="checkbox" id="priority2" value="Medium" name="priority">
                                                        <label class="form-check-label" for="priority2">Medium</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 d-flex align-items-center">
                                                    <div class="form-check me-3">
                                                        <input class="form-check-input" type="checkbox" id="priority3" value="Low" name="priority">
                                                        <label class="form-check-label" for="priority3">Low</label>
                                                    </div>
                                                </div>
                                            </div>
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
                                            <textarea class="form-control" value="{{ old('description') }}" name="description" id="description" rows="2"></textarea>
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