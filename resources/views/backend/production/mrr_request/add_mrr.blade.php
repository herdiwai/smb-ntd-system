@extends('admin.admin_dashboard')
@section('admin')

{{-- <script src="{{ asset('backend/assets/vendors/jquery-ajax/jquery.min.js') }}"></script> --}}

<div class="page-content">

    <div class="row justify-content-center">
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title"><b>FORM INPUT MRR </b></h6>
                
                    <form id="myForm" action="{{ route('store.mrr') }}" method="POST">
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
                                            <div class="col-sm">
                                                <label for="request_dept" class="col-form-label col-form-label-sm"><b>Request Dept</b></label>
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control form-control-sm" id="noOfSample" name="Request_dept">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <div class="form-row align-items-center">
                                            <div class="col-sm-3">
                                                <label for="name" class="col-form-label col-form-label-sm"><b>Model</b></label>
                                            </div>
                                            <div class="col">
                                                <select id="model" name="model_id" class="form-select form-select-sm">
                                                    <option value="">Select Model</option>
                                                    @foreach($modelbrewer as $models)
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
                                                <label for="name" class="col-form-label col-form-label-sm"><b>Name</b></label>
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control form-control-sm" id="noOfSample" name="Name">
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
                                                <label for="to_department" class="col-form-label col-form-label-sm"><b>To Department</b></label>
                                            </div>
                                            <div class="col">
                                                <select id="department" name="To_department" class="form-select form-select-sm">
                                                    <option value="">Select Department</option>
                                                    @foreach($department as $departments)
                                                        <option value="{{ $departments }}" {{ old('department') == $departments ? 'selected' : '' }}>{{ $departments }}</option>
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
                                            <div class="col-sm-3">
                                                <label for="to_department" class="col-form-label col-form-label-sm"><b>Process</b></label>
                                            </div>
                                            <div class="col">
                                                <select id="process" name="processes_id" class="form-select form-select-sm">
                                                    <option value="">Select process</option>
                                                    @foreach($equipment as $equipments)
                                                        <option value="{{ $equipments->id }}">{{ $equipments->Equipment_Name }} - {{ $equipments->Equipment_Number }}</option>
                                                    @endforeach
                                                    {{-- @foreach($process as $processes)
                                                        <option value="{{ $processes->id }}">{{ $processes->process }}</option>
                                                    @endforeach --}}
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
                                
                            </div>    


                            <div class="row">
                                
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <div class="form-row align-items-center">
                                            <div class="col-sm">
                                                <label for="equipment_no" class="col-form-label col-form-label-sm"><b>Equipment No</b></label>
                                            </div>
                                            <div class="col">
                                                <select id="equipment_id" name="Equipment_id" class="form-select form-select-sm">
                                                    <option value="">Select equipment no</option>
                                                    @foreach($equipment as $equipments)
                                                        <option value="{{ $equipments->id }}">{{ $equipments->Equipment_Number }}</option>
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
                                                <label for="date_pd" class="col-form-label col-form-label-sm"><b>Date</b></label>
                                            </div>
                                            <div class="col">
                                                <input type="date" class="form-control form-control-sm" name="Date_pd" id="date_pd" >
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group mb-3" id="other_purpose">
                                    <label for="description"><b>Description:</b></label>
                                    <textarea class="form-control" id="description" name="Description" rows="5" placeholder=""></textarea>
                                </div>

                            </div>    

                            <div class="row">
                                
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <div class="form-row align-items-center">
                                            <div class="col-sm">
                                                <label for="breakdown_time" class="col-form-label col-form-label-sm"><b>Breakdown Time</b></label>
                                            </div>
                                            <div class="col">
                                                <input type="time" class="form-control form-control-sm" name="Breakdown_time" id="breakdown_time" >
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <button class="btn btn-primary btn-sm" type="submit"><i data-feather="send" style="width: 16px; height: 16px;"></i> SAVE</button>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <div class="form-row align-items-center">
                                            <div class="col-sm">
                                                <label for="report_time" class="col-form-label col-form-label-sm"><b>Report Time</b></label>
                                            </div>
                                            <div class="col">
                                                <input type="time" class="form-control form-control-sm" name="Report_time" id="report_time" >
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

    <br/>
</div>

<script type="text/javascript">
    // $(document).ready(function (){
    //     $('#myForm').validate({
    //         rules: {
    //             lot_id: {
    //                 required : true,
    //             }, 
    //             model_id: {
    //                 required : true,
    //             }, 
    //             shift_id: {
    //                 required : true,
    //             }, 
    //             series: {
    //                 required : true,
    //             }, 
    //             no_of_sample: {
    //                 required : true,
    //             }, 
    //             co_no: {
    //                 required : true,
    //             }, 
    //             do_no: {
    //                 required : true,
    //             }, 
    //             processes_id: {
    //                 required : true,
    //             },
    //             mfg_sample_date: {
    //                 required : true,
    //             },
    //             sample_subtmitted_date: {
    //                 required : true,
    //             },
    //             completion_date: {
    //                 required : true,
    //             },
    //             tracebility_datecode: {
    //                 required : true,
    //             },
    //             summary: {
    //                 required : true,
    //             },
    //             check_by: {
    //                 required : true,
    //             },
    //             testpurpose: {
    //                 required : true,
    //             },
                
    //         },
    //         messages :{
    //             lot_id: {
    //                 required : 'Please Enter Lot Name',
    //             }, 
    //             model_id: {
    //                 required : 'Please Enter Model Name',
    //             }, 
    //             shift_id: {
    //                 required : 'Please Enter Shift Name',
    //             }, 
    //             series: {
    //                 required : 'Please Enter Series Name',
    //             }, 
    //             no_of_sample: {
    //                 required : 'Please Enter No of Sample',
    //             }, 
    //             co_no: {
    //                 required : 'Please Enter C/O No',
    //             }, 
    //             do_no: {
    //                 required : 'Please Enter D.O Number',
    //             }, 
    //             processes_id: {
    //                 required : 'Please Enter Process',
    //             },
    //             mfg_sample_date: {
    //                 required : 'Please Enter MFG Sample',
    //             },  
    //             sample_subtmitted_date: {
    //                 required : 'Please Select Sample Submited Date',
    //             },  
    //             completion_date: {
    //                 required : 'Please Select Completion Date',
    //             }, 
    //             tracebility_datecode: {
    //                 required : 'Please Select Traceability Date',
    //             },
    //             summary: {
    //                 required : 'Please Enter Summary',
    //             },
    //             check_by: {
    //                 required : 'Please Enter Your Name',
    //             },
                 
    //         },
    //         errorElement : 'span', 
    //         errorPlacement: function (error,element) {
    //             error.addClass('invalid-feedback');
    //             element.closest('.form-group').append(error);
    //         },
    //         highlight : function(element, errorClass, validClass){
    //             $(element).addClass('is-invalid');
    //         },
    //         unhighlight : function(element, errorClass, validClass){
    //             $(element).removeClass('is-invalid');
    //         },
    //     });
    // });
    

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