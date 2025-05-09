@extends('admin.admin_dashboard')
@section('admin')

<script src="{{ asset('backend/assets/vendors/jquery-ajax/jquery.min.js') }}"></script>

<div class="page-content">

    <div class="row justify-content-center">
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title"><b>FORM INPUT SAMPLE TESTING REQUISITION </b></h6>
                
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
                                {{-- <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <div class="form-row align-items-center">
                                            <div class="col-sm-3">
                                                <label for="date" class="col-form-label">Date</label>
                                            </div>
                                            <div class="col">
                                                <input type="date" name="date" id="date" class="form-control" placeholder="Select date" data-input>
                                            </div>
                                        </div>
                                    </div>                                   
                                </div> --}}
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <div class="form-row align-items-center">
                                            <div class="col-sm-3">
                                                <label for="process" class="col-form-label col-form-label-sm"><b>Process</b></label>
                                            </div>
                                            <div class="col">
                                                <select id="process" name="processes_id" class="form-select form-select-sm">
                                                    <option value="">Select Process</option>
                                                    @foreach($process as $processs)
                                                        {{-- <option value="{{ $processs->id }}">{{ $processs->process }}</option> --}}
                                                        <option value="{{ $processs->id }}" {{ old('process') == $processs ? 'selected' : '' }}>{{ $processs->process }}</option>
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
                                                <label for="model" class="col-form-label col-form-label-sm"><b>Model</b></label>
                                            </div>
                                            <div class="col">
                                                <select id="model" name="model_id" class="form-select form-select-sm">
                                                    <option value="">Select Model</option>
                                                    @foreach($modelbrewer as $models)
                                                        {{-- <option value="{{ $models->id }}">{{ $models->model }}</option> --}}
                                                        <option value="{{ $models->id }}" {{ old('modelbrewer') == $models->id ? 'selected' : '' }}>{{ $models->model }}</option>
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
                                                <label for="shift" class="col-form-label col-form-label-sm"><b>Shift</b></label>
                                            </div>
                                            <div class="col">
                                                <select id="shift" name="shift_id" class="form-select form-select-sm">
                                                    <option value="">Select Shift</option>
                                                    @foreach($shift as $shifts)
                                                        {{-- <option value="{{ $shifts->id }}">{{ $shifts->shift }}</option> --}}
                                                        <option value="{{ $shifts->id }}" {{ old('shift') == $shifts->id ? 'selected' : '' }}>{{ $shifts->shift }}</option>
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
                                
                            </div>    

                            <div class="row">
                               
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <div class="form-row align-items-center">
                                            <div class="col">
                                                <label for="noOfSample" class="col-form-label col-form-label-sm"><b>No Of Sample</b></label>
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control form-control-sm" id="noOfSample" name="no_of_sample">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <div class="form-row align-items-center">
                                            <div class="col-sm-3">
                                                <label for="cONo" class="col-form-label col-form-label-sm"><b>C/O No.</b></label>
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control form-control-sm" id="co_no" placeholder="" name="co_no">
                                            </div>
                                        </div>
                                    </div>  
                                </div>
                            </div>    


                         
                            <div class="row">
                               
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <div class="form-row align-items-center">
                                            <div class="col">
                                                <label for="" class="col-form-label col-form-label-sm"><b>Do Number</b></label>
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control form-control-sm" id="" placeholder="" name="do_no">
                                            </div>
                                        </div>
                                    </div>  
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <div class="form-row align-items-center">
                                            <div class="col-sm-3">
                                                <label for="series" class="col-form-label col-form-label-sm"><b>Series</b></label>
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control form-control-sm" id="series" name="series">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <div class="form-row align-items-center">
                                            <div class="col">
                                                <label for="mfgSample" class="col-form-label col-form-label-sm"><b>MFG Sample Date</b></label>
                                            </div>
                                            <div class="col">
                                                <input type="date" class="form-control form-control-sm" name="mfg_sample_date" id="mfgSample" placeholder="">
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
                                        <div class="col">
                                            <label for="sampleSubmittedDate" class="col-form-label col-form-label-sm"><b>Sample Submitted (Date)</b></label>
                                        </div>
                                        <div class="col">
                                            <input type="date" name="sample_subtmitted_date" id="sampleSubmittedDate" class="form-control form-control-sm" placeholder="Select date" data-input>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <div class="form-row align-items-center">
                                        <div class="col">
                                            <label for="completionDate" class="col-form-label col-form-label-sm"><b>Completion Date</b></label>
                                        </div>
                                        <div class="col">
                                            <input type="text" name="completion_date" class="form-control form-control-sm">
                                            {{-- <input type="text" name="completion_date" id="completionDate" class="form-control form-control-sm" placeholder="Select date" data-input> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <div class="form-row align-items-center">
                                        <div class="col">
                                            <label for="traceabilityDate" class="col-form-label col-form-label-sm"><b>Traceability (Date Code)</b></label>
                                        </div>
                                        <div class="col">
                                            {{-- <input type="text" name="tracebility_datecode" class="form-control form-control-sm"> --}}
                                            <input type="date" name="tracebility_datecode" id="completionDate" class="form-control form-control-sm" placeholder="Select date" data-input>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>             
                        </div>
                    <hr/>

                        <!-- Test Purpose Section -->

                        <div class="form-group mb-3">
                            <label for="test-purpose" class="form-label form-label-sm"><b>Test Purpose</b></label>

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
                                <label for="remarks"><b>Other purpose/remarks:</b></label>
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
                                        <label for="qeReview"><b>Summary</b></label>
                                        <textarea class="form-control" id="summary" placeholder="" rows="5" name="summary"></textarea>
                                    </div>
                                </div>
                                &nbsp;
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="form-row">
                                            <label for="qeReview"><b>Check By</b></label>
                                            {{-- <input type="text" class="form-control" value="{{ $profileData->username }}" id="name" placeholder=""name="check_by" readonly> --}}
                                            <input type="text" class="form-control form-control-sm" id="name" placeholder=""name="check_by">
                                        </div>
                                    </div>
                                    <br>
                                        <button class="btn btn-primary btn-sm" type="submit"><i data-feather="send" style="width: 16px; height: 16px;"></i> SAVE</button>
                                </div>
                            </div>
                        </div>

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
                lot_id: {
                    required : true,
                }, 
                model_id: {
                    required : true,
                }, 
                shift_id: {
                    required : true,
                }, 
                series: {
                    required : true,
                }, 
                no_of_sample: {
                    required : true,
                }, 
                co_no: {
                    required : true,
                }, 
                do_no: {
                    required : true,
                }, 
                processes_id: {
                    required : true,
                },
                mfg_sample_date: {
                    required : true,
                },
                sample_subtmitted_date: {
                    required : true,
                },
                completion_date: {
                    required : true,
                },
                tracebility_datecode: {
                    required : true,
                },
                summary: {
                    required : true,
                },
                check_by: {
                    required : true,
                },
                testpurpose: {
                    required : true,
                },
                
            },
            messages :{
                lot_id: {
                    required : 'Please Enter Lot Name',
                }, 
                model_id: {
                    required : 'Please Enter Model Name',
                }, 
                shift_id: {
                    required : 'Please Enter Shift Name',
                }, 
                series: {
                    required : 'Please Enter Series Name',
                }, 
                no_of_sample: {
                    required : 'Please Enter No of Sample',
                }, 
                co_no: {
                    required : 'Please Enter C/O No',
                }, 
                do_no: {
                    required : 'Please Enter D.O Number',
                }, 
                processes_id: {
                    required : 'Please Enter Process',
                },
                mfg_sample_date: {
                    required : 'Please Enter MFG Sample',
                },  
                sample_subtmitted_date: {
                    required : 'Please Select Sample Submited Date',
                },  
                completion_date: {
                    required : 'Please Select Completion Date',
                }, 
                tracebility_datecode: {
                    required : 'Please Select Traceability Date',
                },
                summary: {
                    required : 'Please Enter Summary',
                },
                check_by: {
                    required : 'Please Enter Your Name',
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
    

    // document.querySelectorAll('input[type="checkbox"]').forEach(function(checkbox) {
    //     checkbox.addEventListener('change', function() {
    //         const checkboxes = document.querySelectorAll('input[type="checkbox"]');
    //         const otherInput = document.getElementById('other_purpose');
    //         let checked = false;

    //         // Periksa jika ada checkbox yang dipilih
    //         checkboxes.forEach(function(checkbox) {
    //             if (checkbox.checked) {
    //                 checked = true;
    //             }
    //         });

    //         // Jika ada checkbox yang dipilih, sembunyikan textarea
    //         if (checked) {
    //             otherInput.style.display = 'none';
    //         } else {
    //             otherInput.style.display = 'block';
    //         }
    //     });
    // });


</script>

@endsection