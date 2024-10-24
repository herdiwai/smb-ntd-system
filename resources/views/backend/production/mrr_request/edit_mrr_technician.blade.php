@extends('admin.admin_dashboard')
@section('admin')

{{-- <script src="{{ asset('backend/assets/vendors/jquery-ajax/jquery.min.js') }}"></script> --}}

<div class="page-content">

    <div class="row justify-content-center">
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title"><b>FORM INPUT MRR TECHNICIAN </b></h6>
                
                    <form id="myForm" action="{{ route('store.mrrtechnician', $mrr_id->id) }}" method="POST">
                        @method('POST')
                        @csrf
                        <!-- Bagian return sample -->
                        <input type="hidden" name="id" value="{{ $mrr_id->id }}">
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
                                                <input type="text" value="{{ old('Request_dept', $mrr_id->Request_dept) }}" class="form-control form-control-sm" id="request_dept" name="Request_dept" disabled>
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
                                                <input type="text" value="{{ old('model_id', $mrr_id->modelBrewer->model ) }}" class="form-control form-control-sm" id="name" name="model_id" disabled>
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
                                                <input type="text" value="{{ old('Name', $mrr_id->Name ?? '') }}" class="form-control form-control-sm" id="name" name="Name" disabled>
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
                                                <input type="text" value="{{ old('shift_id', $mrr_id->shift->shift ) }}" class="form-control form-control-sm" id="name" name="shift_id" disabled>
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
                                                <input type="text" value="{{ old('To_department', $mrr_id->To_department ) }}" class="form-control form-control-sm" id="name" name="To_department" disabled>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <div class="form-row align-items-center">
                                            <div class="col-sm-3">
                                                <label for="lot_id" class="col-form-label col-form-label-sm"><b>Lot</b></label>
                                            </div>
                                            <div class="col">
                                                <input type="text" value="{{ old('lot_id', $mrr_id->lot->lot ) }}" class="form-control form-control-sm" id="name" name="lot_id" disabled>
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
                                                <label for="process" class="col-form-label col-form-label-sm"><b>Process</b></label>
                                            </div>
                                            <div class="col">
                                                <input type="text" value="{{ old('Equipment_id', $mrr_id->equipmentNo->Equipment_Name ) }}" class="form-control form-control-sm" id="equipment_no" name="Equipment_id" disabled>
                                                {{-- <input type="text" value="{{ old('processes_id', $mrr_id->process->process ) }}" class="form-control form-control-sm" id="name" name="processes_id" disabled> --}}
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
                                                <input type="text" value="{{ old('line_id', $mrr_id->line->line ) }}" class="form-control form-control-sm" id="name" name="line_id" disabled>
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
                                                <input type="text" value="{{ old('Equipment_id', $mrr_id->equipmentNo->Equipment_Number ) }}" class="form-control form-control-sm" id="equipment_no" name="Equipment_id" disabled>
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
                                                <input type="date" value="{{ old('Date_pd', $mrr_id->Date_pd ) }}" class="form-control form-control-sm" name="Date_pd" id="date_pd" disabled>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group mb-3" id="other_purpose">
                                    <label for="description"><b>Description:</b></label>
                                    <textarea class="form-control" id="description" name="Description" rows="4" placeholder="" disabled>{{ old('Description', $mrr_id->Description ) }}</textarea>
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
                                                <input type="time" value="{{ old('Breakdown_time', $mrr_id->Breakdown_time ) }}" class="form-control form-control-sm" name="Breakdown_time" id="breakdown_time" disabled>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <div class="form-row align-items-center">
                                            <div class="col-sm">
                                                <label for="report_time" class="col-form-label col-form-label-sm"><b>Report Time</b></label>
                                            </div>
                                            <div class="col">
                                                <input type="time" value="{{ old('Report_time', $mrr_id->Report_time ) }}" class="form-control form-control-sm" name="Report_time" id="breakdown_time" disabled>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <b><hr></b>
                                <h3 style="text-align: center;">RESULT</h3>
                                <br>
                                <b><hr></b>
                            </div>

                            <div class="row">
                                
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <div class="form-row align-items-center">
                                            <div class="col-sm">
                                                <label for="judgement" class="col-form-label col-form-label-sm"><b>Judgement</b></label>
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control form-control-sm" id="judgement" name="Judgement">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <div class="form-row align-items-center">
                                            <div class="col-sm">
                                                <label for="Response_time" class="col-form-label col-form-label-sm"><b>Response Time</b></label>
                                            </div>
                                            <div class="col">
                                                <input type="time" class="form-control form-control-sm" name="Response_time" id="Response_time">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group mb-3" id="other_purpose">
                                    <label for="Issue"><b>Issue:</b></label>
                                    <textarea class="form-control" id="Issue" name="Issue" rows="5" placeholder=""></textarea>
                                </div>
                                <div class="form-group mb-3" id="other_purpose">
                                    <label for="Root_cause"><b>Root Cause:</b></label>
                                    <textarea class="form-control" id="Root_cause" name="Root_cause" rows="5" placeholder=""></textarea>
                                </div>
                                <div class="form-group mb-3" id="other_purpose">
                                    <label for="Action"><b>Action:</b></label>
                                    <textarea class="form-control" id="Action" name="Action" rows="5" placeholder=""></textarea>
                                </div>
                            </div> 

                            <div class="row">
                                
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <div class="form-row align-items-center">
                                            <div class="col-sm">
                                                <label for="Repair_start_time" class="col-form-label col-form-label-sm"><b>Repair Start Time</b></label>
                                            </div>
                                            <div class="col">
                                                <input type="time" class="form-control form-control-sm" id="Repair_start_time" name="Repair_start_time">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <div class="form-row align-items-center">
                                            <div class="col-sm">
                                                <label for="Repair_end_time" class="col-form-label col-form-label-sm"><b>Repair End Time</b></label>
                                            </div>
                                            <div class="col">
                                                <input type="time" class="form-control form-control-sm" name="Repair_end_time" id="Repair_end_time">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <div class="form-row align-items-center">
                                            <div class="col-sm">
                                                <label for="Repair_by" class="col-form-label col-form-label-sm"><b>Repair By</b></label>
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control form-control-sm" name="Repair_by" id="Repair_by">
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