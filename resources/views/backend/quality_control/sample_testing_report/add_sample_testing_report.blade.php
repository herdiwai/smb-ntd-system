@extends('admin.admin_dashboard')
@section('admin')

<script src="{{ asset('backend/assets/vendors/jquery-ajax/jquery.min.js') }}"></script>

<div class="page-content">

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title"><b>FORM EDIT SAMPLE TESTING REPORT </b></h6>
                
                    <form id="myForm" action="{{ route('store.sampletestingreport', $testinggetid->id) }}" method="POST">
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
                        <input type="hidden" name="id" value="{{ $testinggetid->id }}">
                        <input type="hidden" name="status_approvals_id" value="{{ $testinggetid->status_approvals_id }}">
                        
                        {{-- <div class="row">
                            <div class="col-md-12 mb-3">
                                <div class="form-row">
                                    <label for="reposrtNo">Report No.</label>
                                    <input type="text" name="report_no" class="form-control" id="input6" placeholder="">
                                </div>
                            </div>
                        </div> --}}

                        <div class="row">
                            <div class="col-md-4 mb-4">
                                <div class="form-row align-items-center">
                                    <div class="col-sm-4">
                                        <label for="model" class="col-form-label"><b>Model</b></label>
                                    </div>
                                    <div class="col">
                                        <input type="text" class="form-control" value="{{ old('mdoel_id', $testinggetid->modelBrewer->model)  }}" id="model" readonly>                             
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 mb-4">
                                <div class="form-row align-items-center">
                                    <div class="col-sm-6">
                                        <label for="model" class="col-form-label"><b>Tracebility (Date Code)</b></label>
                                    </div>
                                    <div class="col">
                                        <input type="text" value="{{ old('tracebility_datecode', $testinggetid->tracebility_datecode) }}" class="form-control" id="model" placeholder="">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 mb-4">
                                <div class="form-row align-items-center">
                                    <div class="col-sm-6">
                                        <label for="model" class="col-form-label"><b>Process</b></label>
                                    </div>
                                    <div class="col">
                                        <input type="text" value="{{ old('process', $testinggetid->process)  }}" class="form-control" id="model" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- endd of row --}}

                        <div class="row">
                            <div class="col-md-4 mb-4">
                                <div class="form-row align-items-center">
                                    <div class="col-sm-4">
                                        <label for="seriesPN" class="col-form-label"><b>Series / PN </b></label>
                                    </div>
                                    <div class="col">
                                        <input type="text" value="{{ old('series', $testinggetid->series)  }}" class="form-control" id="seriesPN" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 mb-4">
                                <div class="form-row align-items-center">
                                    <div class="col-sm-6">
                                        <label for="receivedSampleData" class="col-form-label"><b>Received Sample Date</b></label>
                                    </div>
                                    <div class="col" id="flatpickr-date">
                                        <input type="text" value="{{ old('sample_subtmitted_date', $testinggetid->sample_subtmitted_date)  }}" class="form-control" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 mb-4">
                                <div class="form-row align-items-center">
                                    <div class="col-sm-6">
                                        <label for="mfgSampleDate" class="col-form-label"><b>MFG Sample Date</b></label>
                                    </div>
                                    <div class="col" id="flatpickr-date">
                                            <input type="text" value="{{ old('mfg_sample_date', $testinggetid->mfg_sample_date)  }}" class="form-control" readonly>
                                    </div>
                                </div>
                            </div> 
                        </div>
                        {{-- endd of row --}}

                        <!-- class baris ketiga -->
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="form-row align-items-center">
                                    <div class="col-sm-4">
                                        <label for="noOfSample" class="col-form-label"><b>No of Samples</b></label>
                                    </div>
                                    <div class="col">
                                        <input type="text" value="{{ old('no_of_sample', $testinggetid->no_of_sample)  }}" class="form-control" id="noOfSample" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="form-row align-items-center">
                                    <div class="col-sm-6">
                                        <label for="cO" class="col-form-label"><b>C/O</b></label>
                                    </div>
                                    <div class="col">
                                        <input type="text" value="{{ old('co_no', $testinggetid->co_no)  }}" class="form-control" id="cO" readonly>
                                    </div>
                                </div>
                            </div>

                            {{-- <div class="col-md-4 mb-4">
                                <div class="form-row align-items-center">
                                    <div class="col-sm-6">
                                        <label for="personInCharged" class="col-form-label">Person In Charged</label>
                                    </div>
                                    <div class="col">
                                        <input type="text" value="" class="form-control" id="personInCharged">
                                    </div>
                                </div>
                            </div> --}}

                        </div>
                        {{-- endd of row --}}

                        <hr/>

                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <div class="form-row">
                                    <label for="reposrtNo"><b>Testing Purpose</b></label>
                                    <input type="text" value="{{ old('testpurpose', $testinggetid->testpurpose)  }}" class="form-control" id="input6" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <div class="form-row">
                                    <label for="reposrtNo"><b>Test Item</b></label>
                                    <input type="text" value="{{ old('test_purpose', $testinggetid->test_purpose)  }}" class="form-control" id="input6" placeholder="Data not found" readonly>
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
                                        <textarea class="form-control" id="before" readonly>{{ old('summary', $testinggetid->summary) }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br/>

                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <div class="form-row align-items-center">
                                    <div class="col-auto">
                                        <label for="after" class="col-form-label"><b>After :</b></label>
                                    </div>
                                    <div class="col">
                                        <textarea name="summary_after" class="form-control" id="after" placeholder=""></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="form-group mb-3">
                            <label for="test-purpose" class="form-label"><b>Result</b></label>

                            <div class="row mb-3">
                                <!-- Checkbox Group 1 -->                               
                                <div class="col-md-6 d-flex align-items-center">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="pass" value="Pass" name="result_test[]">
                                        <label class="form-check-label me-2" for="pass">PASS</label>
                                    </div>
                                </div>
                                <div class="col-md-6 d-flex align-items-center">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="conditionalPass" value="Conditional Pass" name="result_test[]">
                                        <label class="form-check-label me-2" for="conditionalPass">CONDITIONAL PASS</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <!-- Checkbox Group 2 -->
                                <div class="col-md-6 d-flex align-items-center">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="reserverd" value="Reserved" name="result_test[]">
                                        <label class="form-check-label me-2" for="reserverd">RESERVED</label>
                                    </div>
                                </div>
                                <div class="col-md-6 d-flex align-items-center">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="fail" value="fail" name="result_test[]">
                                        <label class="form-check-label me-2" for="fail">FAIL</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <!-- Checkbox Group 3 -->
                                <div class="col-md-6 d-flex align-items-center">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="na" value="N/A" name="result_test[]">
                                        <label class="form-check-label me-2" for="na">N/A</label>
                                    </div>
                                </div>

                            <div class="form-group mb-3" id="other_purpose">
                                <label for="remarks"><b>Remarks:</b></label>
                                <textarea class="form-control" id="remarks" name="remark_test" rows="5" placeholder=""></textarea>
                            </div>
                        </div>

                        <hr>





                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <div class="form-row align-items-center">
                                            <div class="col-sm-3">
                                                <label for="" class="col-form-label"><b>Schedule of Test</b></label>
                                            </div>
                                            <div class="col">
                                                <input type="date" name="schedule_of_test" id="" class="form-control" placeholder="Select date" data-input>
                                            </div>
                                        </div>
                                    </div>                                   
                                </div>

                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <div class="form-row align-items-center">
                                            <div class="col-sm-3">
                                                <label for="" class="col-form-label"><b>Est of Completion Date</b></label>
                                            </div>
                                            <div class="col">
                                                <input type="date" name="est_of_completion_date" id="" class="form-control" placeholder="Select date" data-input>
                                            </div>
                                        </div>
                                    </div>                                   
                                </div>

                                <hr>

                                <div class="row">
                                    <div class="col-md-4 mb-4">
                                        <div class="form-row align-items-center">
                                            <div class="col-sm-4">
                                                <label for="model" class="col-form-label"><b>Inspector</b></label>
                                            </div>
                                            <div class="col">
                                                <input type="text" value="{{ $profileData->username }}" class="form-control" name="inspector" id="model" readonly>                             
                                            </div>
                                        </div>
                                    </div>
        
                                    <div class="col-md-4 mb-4">
                                        <div class="form-row align-items-center">
                                            <div class="col-sm-6">
                                                <label for="model" class="col-form-label"><b>Review by Spv</b></label>
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" id="model" placeholder="">
                                            </div>
                                        </div>
                                    </div>
        
                                    {{-- <div class="col-md-4 mb-4">
                                        <div class="form-row align-items-center">
                                            <div class="col-sm-6">
                                                <label for="model" class="col-form-label"><b>Approved by Manager</b></label>
                                            </div>
                                            <div class="col">
                                                <input type="text"  class="form-control" id="model" readonly>
                                            </div>
                                        </div>
                                    </div> --}}
                                </div>
                                {{-- end of row --}}

                                <div class="row">
                                    <div class="col-md-4 mb-4">
                                        <div class="form-row align-items-center">
                                            <div class="col-sm-4">
                                                <label for="model" class="col-form-label"><b>Date</b></label>
                                            </div>
                                            <div class="col">
                                                <input type="date" class="form-control" name="date" id="model">                             
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4 mb-4">
                                        <div class="form-row align-items-center">
                                            <div class="col-sm-4">
                                                <label  class="col-form-label"><b>Date</b></label>
                                            </div>
                                            <div class="col">
                                                <input type="date" class="form-control">                             
                                            </div>
                                        </div>
                                    </div>

                                    {{-- <div class="col-md-4 mb-4">
                                        <div class="form-row align-items-center">
                                            <div class="col-sm-4">
                                                <label class="col-form-label"><b>Date</b></label>
                                            </div>
                                            <div class="col">
                                                <input type="date" class="form-control">                             
                                            </div>
                                        </div>
                                    </div> --}}
                                </div>
                                {{-- End of row --}}
                            </div>
                        {{-- END --}}

                    
                        <button class="btn btn-primary btn-sm" type="submit"><i data-feather="save"></i> SUBMIT</button>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>

  
</div>

{{-- <script type="text/javascript">
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

    // document.addEventListener('DOMContentLoaded', function () {
    //     // Ambil elemen checkbox dan textarea
    //     var checkbox = document.getElementById('toggleCheckbox');
    //     var otherpurpose = document.getElementById('otherpurpose');

    //     // Fungsi untuk menyembunyikan atau menampilkan textarea
    //     function toggleTextarea() {
    //         if (checkbox.checked) {
    //             otherpurpose.style.display = 'none'; // Sembunyikan textarea jika checkbox tercentang
    //         } else {
    //             otherpurpose.style.display = 'block'; // Tampilkan textarea jika checkbox tidak tercentang
    //         }
    //     }

    //     // Jalankan fungsi saat halaman pertama kali dimuat
    //     toggleTextarea();

    //     // Tambahkan event listener saat checkbox diubah
    //     checkbox.addEventListener('change', toggleTextarea);
    // });


</script> --}}

@endsection