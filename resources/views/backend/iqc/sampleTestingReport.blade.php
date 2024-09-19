@extends('admin.admin_dashboard')
@section('admin')


<div class="page-content">

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">FORM INPUT SAMPLE TESTING REPORT </h6>
                
                    <form action="" method="POST" enctype="multipart/form-data">
                        @csrf

                        <style>
                            .form-row {
                                display: flex;
                                align-items: center; /* Agar label dan input sejajar secara vertikal */
                            }
                    
                            .form-row label {
                                margin-right: 10px; /* Jarak antara label dan input */
                                min-width: 120px; /* Lebar minimal untuk label */
                            }
                    
                            .form-row input {
                                flex: 1; /* Input menyesuaikan lebar sisa ruang */
                            }
                        </style>

                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <div class="form-row">
                                    <label for="reposrtNo">Report No.</label>
                                    <input type="text" class="form-control" id="input6" placeholder="">
                                </div>
                            </div>
                        </div>
                        <hr/>
                        <!-- class baris pertama -->
                        <div class="row">
                            <div class="col-md-4 mb-4">
                                <div class="form-row align-items-center">
                                    <div class="col-sm-4">
                                        <label for="model" class="col-form-label">Model</label>
                                    </div>
                                    <div class="col">
                                        <input type="text" class="form-control" id="model" placeholder="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-4">
                                <div class="form-row align-items-center">
                                    <div class="col-sm-6">
                                        <label for="flatpickr-date" class="col-form-label">Traceability (Date Code)</label>
                                    </div>
                                    <div class="col" id="flatpickr-date">
                                        <input type="date" value="" name="date" class="form-control" placeholder="Select date" data-input>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-4">
                                <div class="form-row align-items-center">
                                    <div class="col-sm-6">
                                        <label for="process" class="col-form-label">Process</label>
                                    </div>
                                    <div class="col">
                                        <input type="text" class="form-control" id="process" placeholder="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- class baris kedua -->
                        <div class="row">
                            <div class="col-md-4 mb-4">
                                <div class="form-row align-items-center">
                                    <div class="col-sm-4">
                                        <label for="seriesPN" class="col-form-label">Series / PN</label>
                                    </div>
                                    <div class="col">
                                        <input type="text" class="form-control" id="seriesPN" placeholder="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-4">
                                <div class="form-row align-items-center">
                                    <div class="col-sm-6">
                                        <label for="receivedSampleData" class="col-form-label">Received Sample Date</label>
                                    </div>
                                    <div class="col" id="flatpickr-date">
                                        <input type="date" value="" name="date" class="form-control" placeholder="Select date" data-input>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-4">
                                <div class="form-row align-items-center">
                                    <div class="col-sm-6">
                                        <label for="mfgSampleDate" class="col-form-label">MFG Sample Date</label>
                                    </div>
                                    <div class="col" id="flatpickr-date">
                                            <input type="date" value="" name="date" class="form-control" placeholder="Select date" data-input>
                                    </div>
                                </div>
                            </div>  
                        </div>
                        
                        <!-- class baris ketiga -->
                        <div class="row">
                            <div class="col-md-4 mb-4">
                                <div class="form-row align-items-center">
                                    <div class="col-sm-4">
                                        <label for="noOfSample" class="col-form-label">No of Samples</label>
                                    </div>
                                    <div class="col">
                                        <input type="text" class="form-control" id="noOfSample" placeholder="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-4">
                                <div class="form-row align-items-center">
                                    <div class="col-sm-6">
                                        <label for="cO" class="col-form-label">C/O</label>
                                    </div>
                                    <div class="col">
                                        <input type="text" class="form-control" id="cO" placeholder="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-4">
                                <div class="form-row align-items-center">
                                    <div class="col-sm-6">
                                        <label for="personInCharged" class="col-form-label">Person In Charged</label>
                                    </div>
                                    <div class="col">
                                        <input type="text" class="form-control" id="personInCharged" placeholder="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <hr/>

                        <div class="row">
                            <div class="col-md-12 mb-6">
                                <div class="form-row align-items-center">
                                    <div class="col-auto">
                                        <label for="testingPurpose" class="col-form-label">Testing Purpose</label>
                                    </div>
                                    <div class="col">
                                        <textarea class="form-control" id="testingPurpose" placeholder=""></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <hr/>

                        <div class="row">
                            <div class="col-md-12 mb-6">
                                <div class="form-row align-items-center">
                                    <div class="col-auto">
                                        <label for="testItem" class="col-form-label">Test Item</label>
                                    </div>
                                    <div class="col">
                                        <textarea class="form-control" id="testItem" placeholder=""></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr/>

                    
                        <div class="row">
                            <label for="summary" class="form-label"><b>Summary</b></label>
                            <div class="col-md-12 mb-3">
                                <div class="form-row align-items-center">
                                    <div class="col-auto">
                                        <label for="before" class="col-form-label">Before :</label>
                                    </div>
                                    <div class="col">
                                        <textarea class="form-control" id="before" placeholder=""></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br/>

                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <div class="form-row align-items-center">
                                    <div class="col-auto">
                                        <label for="after" class="col-form-label">After :</label>
                                    </div>
                                    <div class="col">
                                        <textarea class="form-control" id="after" placeholder=""></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr/>

                        <div class="row">
                            <div class="col-md-12 mb-4">
                                <div class="form-row align-items-center">
                                    <label for="Results" class="col-form-label"><b>Results</b></label>
                                    <div class="col">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" value="" id="passResults">
                                            <label class="form-check-label" for="passResults">PASS</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" value="" id="conditionalPass">
                                            <label class="form-check-label" for="conditionalPass">CONDITIONAL PASS</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" value="" id="reserved">
                                            <label class="form-check-label" for="reserved">RESERVED</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" value="" id="fail">
                                            <label class="form-check-label" for="fail">FAIL</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" value="" id="nA">
                                            <label class="form-check-label" for="nA">N/A</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <div class="form-row align-items-center">
                                    <div class="col-auto">
                                        <label for="remark" class="col-form-label">Remark :</label>
                                    </div>
                                    <div class="col">
                                        <textarea class="form-control" id="remark" placeholder=""></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr/>

                        <div class="row">
                            <div class="col-md-4 mb-4">
                                <div class="form-row align-items-center">
                                    <div class="col-auto">
                                        <label for="inspector" class="col-form-label">Inspector</label>
                                    </div>
                                    <div class="col">
                                        <input type="text" class="form-control" id="inspector" placeholder="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-4">
                                <div class="form-row align-items-center">
                                    <div class="col-auto">
                                        <label for="review" class="col-form-label">Review</label>
                                    </div>
                                    <div class="col">
                                        <input type="text" class="form-control" id="review" placeholder="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-4">
                                <div class="form-row align-items-center">
                                    <div class="col-auto">
                                        <label for="approved" class="col-form-label">Approved</label>
                                    </div>
                                    <div class="col">
                                        <input type="text" class="form-control" id="process" placeholder="">
                                    </div>
                                </div>
                            </div>  
                        </div>

                        <div class="row">
                            <div class="col-md-4 mb-4">
                                <div class="form-row align-items-center">
                                    <div class="col-auto">
                                        <label for="approved" class="col-form-label">Date</label>
                                    </div>
                                    <div class="col" id="flatpickr-date">
                                            <input type="date" value="" name="date" class="form-control" placeholder="Select date" data-input>
                                            {{-- <span class="input-group-text input-group-addon" data-toggle><i data-feather="calendar"></i></span> --}}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-4">
                                <div class="form-row align-items-center">
                                    <div class="col-auto">
                                        <label for="approved" class="col-form-label">Date</label>
                                    </div>
                                    <div class="col" id="flatpickr-date">
                                            <input type="date" value="" name="date" class="form-control" placeholder="Select date" data-input>
                                            {{-- <span class="input-group-text input-group-addon" data-toggle><i data-feather="calendar"></i></span> --}}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-4">
                                <div class="form-row align-items-center">
                                    <div class="col-auto">
                                        <label for="approved" class="col-form-label">Date</label>
                                    </div>
                                    <div class="col" id="flatpickr-date">
                                            <input type="date" value="" name="date" class="form-control" placeholder="Select date" data-input>
                                            {{-- <span class="input-group-text input-group-addon" data-toggle><i data-feather="calendar"></i></span> --}}
                                    </div>
                                </div>
                            </div>  
                        </div>
                        <br/>

                        <button class="btn btn-primary btn-sm" type="submit"><i data-feather="save"></i> SAVE</button>
    
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection