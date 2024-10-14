@extends('admin.admin_dashboard')
@section('admin')

<script src="{{ asset('backend/assets/vendors/jquery-ajax/jquery.min.js') }}"></script>

<style>
    label {
        font-weight: bold;
    }
</style>

<div class="page-content">

    <div class="row justify-content-center">
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">FORM EDIT SAMPLE TESTING REQUISITION </h6>
                
                    <form id="myForm" action="{{ route('update.TestingRequisition') }}" method="POST">
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
                        
                            <div class="row">
                                {{-- <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <div class="form-row align-items-center">
                                            <div class="col">
                                                <label for="" class="col-form-label-sm">Date</label>
                                            </div>
                                            <div class="col">
                                                <input type="date" value="{{ old('date', $testinggetid->date) }}" name="date" id="" class="form-control form-control-sm" placeholder="Select date" data-input>
                                            </div>
                                        </div>
                                    </div>                                   
                                </div> --}}
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <div class="form-row align-items-center">
                                            <div class="col-sm-3">
                                                <label for="lot" class="col-form-label-sm">Lot</label>
                                            </div>
                                            <div class="col">
                                                <select id="lot" name="lot_id" class="form-select form-select-sm">
                                                    <option value="">Select Lot</option>
                                                    @foreach($lot as $lots)
                                                        <option value="{{ $lots->id }}" {{ $lots->id ==  old('lot_id', $testinggetid->lot_id) ? 'selected' : '' }}>
                                                            {{ $lots->lot }}
                                                        </option>
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
                                                <label for="model" class="col-form-label-sm">Model</label>
                                            </div>
                                            <div class="col">
                                                <select id="model" name="model_id" class="form-select form-select-sm">
                                                    <option value="">Select Model</option>
                                                    @foreach($modelbrewer as $modelbrewers)
                                                        <option value="{{ $modelbrewers->id }}" {{ $modelbrewers->id ==  old('model_id', $testinggetid->model_id) ? 'selected' : '' }}>
                                                            {{ $modelbrewers->model }}
                                                        </option>
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
                                                <label for="shift" class="col-form-label-sm">Shift</label>
                                            </div>
                                            <div class="col">
                                                <select id="shift" name="shift_id" class="form-select form-select-sm">
                                                    <option value="">Select Shift</option>
                                                    @foreach($shift as $shifts)
                                                        <option value="{{ $shifts->id }}" {{ $shifts->id ==  old('shift_id', $testinggetid->shift_id) ? 'selected' : '' }}>
                                                            {{ $shifts->shift }}
                                                        </option>
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
                                                <label for="series" class="col-form-label-sm">Series</label>
                                            </div>
                                            <div class="col">
                                                <input type="text" value="{{ old('series', $testinggetid->series) }}" class="form-control form-control-sm" id="series" placeholder="" name="series">
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
                                                <label for="noOfSample" class="col-form-label-sm">No Of Sample</label>
                                            </div>
                                            <div class="col">
                                                <input type="text" value="{{ old('no_of_sample', $testinggetid->no_of_sample) }}" class="form-control form-control-sm" id="noOfSample" placeholder="" name="no_of_sample">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <div class="form-row align-items-center">
                                            <div class="col">
                                                <label for="cONo" class="col-form-label-sm">C/O No.</label>
                                            </div>
                                            <div class="col">
                                                <input type="text" value="{{ old('co_no', $testinggetid->co_no) }}" class="form-control form-control-sm" id="co_no" placeholder="" name="co_no">
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
                                                <label for="" class="col-form-label-sm">Do Number</label>
                                            </div>
                                            <div class="col">
                                                <input type="text" value="{{ old('do_no', $testinggetid->do_no) }}" class="form-control form-control-sm" id="" placeholder="" name="do_no">
                                            </div>
                                        </div>
                                    </div>  
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <div class="form-row align-items-center">
                                            <div class="col">
                                                <label for="process" class="col-form-label-sm">Process</label>
                                            </div>
                                            <div class="col">
                                                <select id="process" name="processes_id" class="form-select form-select-sm">
                                                    <option value="">Select Process</option>
                                                    @foreach($process as $processs)
                                                        <option value="{{ $processs->id }}" {{ $processs->id ==  old('processes_id', $testinggetid->processes_id) ? 'selected' : '' }}>
                                                            {{ $processs->process }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <div class="form-row align-items-center">
                                            <div class="col">
                                                <label for="mfgSample" class="col-form-label-sm">MFG Sample Date</label>
                                            </div>
                                            <div class="col">
                                                <input type="date" value="{{ old('mfg_sample_date', $testinggetid->mfg_sample_date) }}" class="form-control form-control-sm" name="mfg_sample_date" id="mfgSample" placeholder="">
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
                                            <label for="sampleSubmittedDate" class="col-form-label-sm">Sample Submitted (Date)</label>
                                        </div>
                                        <div class="col">
                                            <input type="date" value="{{ old('sample_subtmitted_date', $testinggetid->sample_subtmitted_date) }}" name="sample_subtmitted_date" id="sampleSubmittedDate" class="form-control form-control-sm" placeholder="Select date" data-input>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <div class="form-row align-items-center">
                                        <div class="col">
                                            <label for="completionDate" class="col-form-label-sm">Completion Date</label>
                                        </div>
                                        <div class="col">
                                            <input type="text" value="{{ old('completion_date', $testinggetid->completion_date) }}" name="completion_date" id="completionDate" class="form-control form-control-sm">
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
                                            <label for="traceabilityDate" class="col-form-label-sm">Traceability (Date Code)</label>
                                        </div>
                                        <div class="col">
                                            <input type="date" value="{{ old('tracebility_datecode', $testinggetid->tracebility_datecode) }}" name="tracebility_datecode" id="traceabilityDate" class="form-control form-control-sm" placeholder="Select date" data-input>
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
                                @foreach($testpurpose as $testpurposes)
                                    <div class="col-md-6 d-flex align-items-center">
                                        <div class="form-check">
                                                <input class="form-check-input" name="testpurpose[]" id="toggleCheckbox" type="checkbox" value="{{ $testpurposes }}" {{ $testpurposes == $testinggetid->testpurpose ? 'checked' : '' }}>
                                                    {{ $testpurposes }}
                                                </option>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <div class="form-group mb-3" id="other_purpose">
                                <label for="remarks">Other purpose/remarks:</label>
                                <textarea class="form-control form-control-sm" id="remarks" name="test_purpose" rows="5" placeholder="">{{ $testinggetid->test_purpose }}</textarea>
                            </div>
                        </div>
                        <!-- end class test purpose -->
                        <hr />
                       
                        <div class="row">
                            <div class="col-md-12 mb-6">
                                {{-- <div class="form-group">
                                    <div class="form-row">
                                        <label for="qeReview" >Testing purpose</label>
                                        <input type="text" value="{{ old('testing_purpose', $testinggetid->testing_purpose) }}" class="form-control form-control-sm" id="name" placeholder=""name="testing_purpose" >
                                    </div>
                                </div>
                                &nbsp;   --}}

                                <div class="form-group">
                                    <div class="form-row">
                                        <label for="qeReview" >Summary</label>
                                        <textarea class="form-control form-control-sm" id="summary" placeholder="" rows="5" name="summary">{{ old('summary', $testinggetid->summary) }}</textarea>
                                    </div>
                                </div>
                                &nbsp;
                                <div class="col-md-6">
                                <div class="form-group">
                                    <div class="form-row">
                                        <label for="qeReview" >Check By</label>
                                        <input type="text" class="form-control form-control-sm" value="{{ $testinggetid->check_by }}" id="name" placeholder=""name="check_by">
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


</script>

@endsection