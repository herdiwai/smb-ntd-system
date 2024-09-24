@extends('admin.admin_dashboard')
@section('admin')

<script src="{{ asset('backend/assets/vendors/jquery-ajax/jquery.min.js') }}"></script>

<div class="page-content">

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">FORM INPUT SAMPLE TESTING REQUISITION </h6>
                
                    <form id="myForm" action="{{ route('store.sampletestingrequisition') }}" method="POST">
                        @method('POST')
                        @csrf
                        <!-- Bagian return sample -->
                        
                            {{-- <div class="row mb-3 align-items-center">
                                <label for="return-sample" class="form-label col-sm-2">Return Sample</label>
                                <div class="col-sm-10 d-flex align-items-center">
                                    <div class="form-group">
                                        <div class="form-check me-3">
                                            <input class="form-check-input" type="checkbox" value="yes" id="flexCheckYes" name="flexCheckYes">
                                            <label class="form-check-label" for="flexCheckYes">Yes</label>                                   
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="no" id="flexCheckNo" name="flexCheckNo">
                                            <label class="form-check-label" for="flexCheckNo">No</label>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div> --}}

                        
                        <!-- end return sample-->

                        
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <div class="form-row align-items-center">
                                            <div class="col-sm-3">
                                                <label for="" class="col-form-label">Date</label>
                                            </div>
                                            <div class="col">
                                                <input type="date" name="date" id="" class="form-control" placeholder="Select date" data-input>
                                            </div>
                                        </div>
                                    </div>                                   
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <div class="form-row align-items-center">
                                            <div class="col-sm-3">
                                                <label for="lot" class="col-form-label">Lot</label>
                                            </div>
                                            <div class="col">
                                                <select id="lot" name="lot_id" class="form-select">
                                                    <option value="">Select Lot</option>
                                                    @foreach($lot as $lots)
                                                        <option value="{{ $lots->id }}">{{ $lots->lot }}</option>
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
                                            <div class="col-sm-3">
                                                <label for="model" class="col-form-label">Model</label>
                                            </div>
                                            <div class="col">
                                                <select id="model" name="model_id" class="form-select">
                                                    <option value="">Select Model</option>
                                                    @foreach($modelbrewer as $models)
                                                        <option value="{{ $models->id }}">{{ $models->model }}</option>
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
                                                <label for="shift" class="col-form-label">Shift</label>
                                            </div>
                                            <div class="col">
                                                <select id="shift" name="shift_id" class="form-select">
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
                                            <div class="col-sm-3">
                                                <label for="series" class="col-form-label">Series</label>
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" id="series" placeholder="" name="series">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <div class="form-row align-items-center">
                                            <div class="col-sm-3">
                                                <label for="noOfSample" class="col-form-label">No Of Sample</label>
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" id="noOfSample" placeholder="" name="no_of_sample">
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
                                                <label for="cONo" class="col-form-label">C/O No.</label>
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" id="co_no" placeholder="" name="co_no">
                                            </div>
                                        </div>
                                    </div>  
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <div class="form-row align-items-center">
                                            <div class="col-sm-3">
                                                <label for="" class="col-form-label">Do Number</label>
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" id="" placeholder="" name="do_no">
                                            </div>
                                        </div>
                                    </div>  
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <div class="form-row align-items-center">
                                            <div class="col-sm-3">
                                                <label for="process" class="col-form-label">Process</label>
                                            </div>
                                            <div class="col">
                                                <select id="process" name="processes_id" class="form-select">
                                                    <option value="">Select Process</option>
                                                    @foreach($process as $processs)
                                                        <option value="{{ $processs->id }}">{{ $processs->process }}</option>
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
                                                <label for="mfgSample" class="col-form-label">MFG Sample Date</label>
                                            </div>
                                            <div class="col">
                                                <input type="date" class="form-control" name="mfg_sample_date" id="mfgSample" placeholder="">
                                            </div>
                                        </div>
                                    </div>
                                </div>   
                            </div>
                        {{-- END --}}

                        <div class="row">
                                     
                        </div>

                        <hr/>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <div class="form-row align-items-center">
                                        <div class="col-sm-5">
                                            <label for="sampleSubmittedDate" class="col-form-label">Sample Submitted (Date)</label>
                                        </div>
                                        <div class="col">
                                            <input type="date" name="sample_subtmitted_date" id="sampleSubmittedDate" class="form-control" placeholder="Select date" data-input>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <div class="form-row align-items-center">
                                        <div class="col-sm-3">
                                            <label for="completionDate" class="col-form-label">Completion Date</label>
                                        </div>
                                        <div class="col">
                                            <input type="date" name="completion_date" id="completionDate" class="form-control" placeholder="Select date" data-input>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <div class="form-row align-items-center">
                                        <div class="col-sm-5">
                                            <label for="traceabilityDate" class="col-form-label">Traceability (Date Code)</label>
                                        </div>
                                        <div class="col">
                                            <input type="date" name="tracebility_datecode" id="traceabilityDate" class="form-control" placeholder="Select date" data-input>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>             
                        </div>
                    <hr/>

                        <!-- Test Purpose Section -->

                        <div class="form-group mb-3">
                            <label for="test-purpose" class="form-label">Test Purpose</label>

                            <div class="row mb-3">
                                <!-- Checkbox Group 1 -->                               
                                <div class="col-md-6 d-flex align-items-center">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="quatationSample" value="Quatation Sample Test" name="testpurpose[]">
                                        <label class="form-check-label me-2" for="quatationSample">Quatation Sample Test</label>
                                    </div>
                                </div>
                                <div class="col-md-6 d-flex align-items-center">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="moldProcess" value="Mold/Tool Process Change Sample Test" name="testpurpose[]">
                                        <label class="form-check-label me-2" for="moldProcess">Mold/Tool Process Change Sample Test</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <!-- Checkbox Group 2 -->
                                <div class="col-md-6 d-flex align-items-center">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="eppSample" value="EP/PP Sample Test" name="testpurpose[]">
                                        <label class="form-check-label me-2" for="eppSample">EP/PP Sample Test</label>
                                    </div>
                                </div>
                                <div class="col-md-6 d-flex align-items-center">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="firstBatch" value="First Batch Production/Conversion Sample Test" name="testpurpose[]">
                                        <label class="form-check-label me-2" for="firstBatch">First Batch Production/Conversion Sample Test</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <!-- Checkbox Group 3 -->
                                <div class="col-md-6 d-flex align-items-center">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="ssbApproves" value="The SSB approves the sample test" name="testpurpose[]">
                                        <label class="form-check-label me-2" for="ssbApproves">The SSB approves the sample test</label>
                                    </div>
                                </div>
                                <div class="col-md-6 d-flex align-items-center">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="normalLife" value="Normal Life and Reliability Test" name="testpurpose[]">
                                        <label class="form-check-label me-2" for="normalLife">Normal Life and Reliability Test</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <!-- Checkbox Group 4 -->
                                <div class="col-md-6 d-flex align-items-center">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="designChange" value="Design Change Sample Test" name="testpurpose[]">
                                        <label class="form-check-label me-2" for="designChange">Design Change Sample Test</label>                       
                                    </div>
                                </div>
                                <div class="col-md-6 d-flex align-items-center">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="presented" value="Presented to the Client for Approval of the Sample Test" name="testpurpose[]">
                                        <label class="form-check-label me-2" for="presented">Presented to the Client for Approval of the Sample Test</label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mb-3" id="other_purpose">
                                <label for="remarks">Other purpose/remarks:</label>
                                <textarea class="form-control" id="remarks" name="test_purpose" rows="5" placeholder=""></textarea>
                            </div>
                        </div>

                        <!-- end class test purpose -->
                        {{-- <hr /> --}}
                        {{-- <div class="row">
                            <div class="col-md-6 mb-3">
                                <h6 class="card-title">Pilot Project</h6>
                                <!-- pilot project 1 -->
                                <div class="form-check">
                                    <label class="form-check-label" for="executeAccording">Execute according to the quality plan/inspection ir</label>
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp
                                    <input class="form-check-input" type="checkbox" value="" id="checkbox7"><br/><br/>
                                </div>
                                
                                
                                <!-- pilot project 2 -->
                                <div class="form-check">
                                    <label class="form-check-label" for="determinedBy">Determined by the QE Department</label>
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <input class="form-check-input" type="checkbox" value="" id="checkbox7" ><br/><br/>
                                </div>
                                
                                <!-- pilot project 3 -->
                                <div class="form-check">
                                    <label class="form-check-label" for="suggestedBy">Suggested by the submitter</label>
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;
                                    <input class="form-check-input" type="checkbox" value="" id="checkbox8" >
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <h6 class="card-title">Reference File</h6>  
                                <input type="text" class="form-control" id="input4" placeholder="">
                                &nbsp;
                                <input type="text" class="form-control" id="input4" placeholder="">
                                &nbsp;
                                <input type="text" class="form-control" id="input4" placeholder="">
                            </div>
                        </div> --}}
                        

                        <div class="row">
                            <div class="col-md-12 mb-6">
                                {{-- <div class="form-group">
                                    <div class="form-row">
                                        <label for="qeReview" >Testing purpose</label>
                                        <input type="text" class="form-control" id="name" placeholder=""name="testing_purpose" >
                                    </div>
                                </div>
                                &nbsp;   --}}

                                <div class="form-group">
                                    <div class="form-row">
                                        <label for="qeReview" >Summary</label>
                                        <textarea class="form-control" id="summary" placeholder="" rows="5" name="summary"></textarea>
                                    </div>
                                </div>
                                &nbsp;

                                <div class="form-group">
                                    <div class="form-row">
                                        <label for="qeReview" >Check By</label>
                                        <input type="text" class="form-control" value="{{ $profileData->username }}" id="name" placeholder=""name="check_by" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button class="btn btn-primary btn-sm" type="submit"><i data-feather="save"></i> SAVE</button>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>

    <br/>
    {{-- <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h5 class="mb-0"></h5>
                
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
                            <div class="col-md-6 mb-3">
                                <div class="form-row align-items-center">
                                    <div class="col-sm-4">
                                        <label for="qeReview" class="col-form-label">QE Review</label>
                                    </div>
                                    <div class="col">
                                        <input type="text" class="form-control" id="qeReview" placeholder="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-row align-items-center">
                                    <div class="col-sm-4">
                                        <label for="regAccept" class="col-form-label">Reg Accepted</label>
                                    </div>
                                    <div class="col-sm-10 d-flex align-items-center">
                                        <div class="form-check me-3">
                                            <input class="form-check-input" type="checkbox" value="yes" id="flexCheckYes1">
                                            <label class="form-check-label" for="flexCheckYes1">Yes</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="no" id="flexCheckNo1">
                                            <label class="form-check-label" for="flexCheckNo1">No</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="form-row align-items-center">
                                    <div class="col-sm-4">
                                        <label for="flatpickr-date" class="col-form-label">Schedule Of Test</label>
                                    </div>
                                    <div class="col" id="flatpickr-date">
                                        <input type="date" value="" name="date" class="form-control" placeholder="Select date" data-input>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-row align-items-center">
                                    <div class="col-sm-4">
                                        <label for="flatpickr-date" class="col-form-label">Est Of Completion Date</label>
                                    </div>
                                    <div class="col" id="flatpickr-date">
                                        <input type="date" value="" name="date" class="form-control" placeholder="Select date" data-input>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="form-row align-items-center">
                                    <div class="col-sm-4">
                                        <label for="reportNo" class="col-form-label">Report No.</label>
                                    </div>
                                    <div class="col">
                                        <input type="text" class="form-control" id="reportNo" placeholder="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-row align-items-center">
                                    <div class="col-sm-4">
                                        <label for="testResults" class="col-form-label">Test Results :</label>
                                    </div>
                                    <div class="col">
                                        <input type="text" class="form-control" id="testResults" placeholder="">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <br/>

                        <button class="btn btn-primary btn-sm" type="submit"><i data-feather="save"></i> SUBMIT</button>
    
                    </form>
                        
                </div>
            </div>
        </div>
    </div> --}}
</div>

<script type="text/javascript">
    $(document).ready(function (){
        $('#myForm').validate({
            rules: {
                lot: {
                    required : true,
                }, 
                model: {
                    required : true,
                }, 
                shift: {
                    required : true,
                }, 
                series: {
                    required : true,
                }, 
                noOfSample: {
                    required : true,
                }, 
                cONo: {
                    required : true,
                }, 
                process: {
                    required : true,
                },
                mfgSample: {
                    required : true,
                },
                sampleSubmittedDate: {
                    required : true,
                },
                completionDate: {
                    required : true,
                },
                traceabilityDate: {
                    required : true,
                },
                quatationSample: {
                    required : true,
                },
                moldProcess: {
                    required : true,
                },
                epPPSample: {
                    required : true,
                },
                firstBatch: {
                    required : true,
                },
                ssbApproves: {
                    required : true,
                },
                normalLife: {
                    required : true,
                },
                designChange: {
                    required : true,
                },
                presented: {
                    required : true,
                },
                name: {
                    required : true,
                },
                
            },
            messages :{
                lot: {
                    required : 'Please Enter Lot Name',
                }, 
                model: {
                    required : 'Please Enter Model Name',
                }, 
                shift: {
                    required : 'Please Enter Shift Name',
                }, 
                series: {
                    required : 'Please Series Name',
                }, 
                noOfSample: {
                    required : 'Please Enter No of Sample',
                }, 
                cONo: {
                    required : 'Please Enter C/O No',
                }, 
                process: {
                    required : 'Please Enter Process',
                },
                mfgSample: {
                    required : 'Please Enter MFG Sample',
                },  
                sampleSubmittedDate: {
                    required : 'Please Select Sample Submited Date',
                },  
                completionDate: {
                    required : 'Please Select Completion Date',
                }, 
                traceabilityDate: {
                    required : 'Please Select Traceability Date',
                },
                quatationSample: {
                    required : 'Please Enter Select Test Purpose',
                },
                moldProcess: {
                    required : '',
                },
                epPPSample: {
                    required : '',
                },
                firstBatch: {
                    required : '',
                },
                ssbApproves: {
                    required : '',
                },
                normalLife: {
                    required : '',
                },
                designChange: {
                    required : '',
                },
                presented: {
                    required : '',
                },
                 
            },
            errorElement : 'span', 
            errorPlacement: function (error,element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight : function(element, errorClass, validClass){
                $(element).addClass('is-invalid');
            },
            unhighlight : function(element, errorClass, validClass){
                $(element).removeClass('is-invalid');
            },
        });
    });
    
    document.querySelectorAll('input[type="checkbox"]').forEach(function(checkbox) {
        checkbox.addEventListener('change', function() {
            const checkboxes = document.querySelectorAll('input[type="checkbox"]');
            const otherInput = document.getElementById('other_purpose');
            let checked = false;

            // Periksa jika ada checkbox yang dipilih
            checkboxes.forEach(function(checkbox) {
                if (checkbox.checked) {
                    checked = true;
                }
            });

            // Jika ada checkbox yang dipilih, sembunyikan textarea
            if (checked) {
                otherInput.style.display = 'none';
            } else {
                otherInput.style.display = 'block';
            }
        });
    });


</script>

@endsection