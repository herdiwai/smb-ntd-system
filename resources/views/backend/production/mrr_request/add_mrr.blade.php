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
                                                    <option value="">--select model--</option>
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
                                                    <option value="">--select shift--</option>
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
                                                    <option value="">--select department--</option>
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
                                                    <option value="">--select lot--</option>
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
                                                {{-- <input type="text" class="form-control form-control-sm" name="processes_id" id="processes_id" > --}}
                                                <select id="Equipment_Name" name="Equipment_id" class="form-select form-select-sm">
                                                    <option value="">--select process--</option>
                                                    @foreach($equipment as $equipments)
                                                        <option value="{{ $equipments->id }}">{{ $equipments->Equipment_Name }}</option>
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
                                                <label for="line" class="col-form-label col-form-label-sm"><b>Line</b></label>
                                            </div>
                                            <div class="col">
                                                <select id="line" name="line_id" class="form-select form-select-sm">
                                                    <option value="">--select line--</option>
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
                                                <label for="Equipment_Number" class="col-form-label col-form-label-sm"><b>Equipment No</b></label>
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control form-control-sm" id="Equipment_Number" disabled>
                                                {{-- <select id="equipment_id" name="Equipment_id" class="form-select form-select-sm">
                                                    <option value="">Select equipment no</option>
                                                    @foreach($equipment as $equipments)
                                                        <option value="{{ $equipments->id }}">{{ $equipments->Equipment_Number }}</option>
                                                    @endforeach
                                                </select> --}}
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
                                                {{-- <input type="date" class="form-control form-control-sm" name="Date_pd" id="date_pd" > --}}
                                                <div class="input-group flatpickr" id="flatpickr-date">
                                                    <input type="text" name="Date_pd" class="form-control" placeholder="--select date--" data-input>
                                                    <span class="input-group-text input-group-addon" data-toggle><i data-feather="calendar"></i></span>
                                                  </div>
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
                                    <button class="btn btn-primary btn-sm" type="submit"><i data-feather="save" style="width: 16px; height: 16px;"></i> SAVE</button>
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

document.getElementById('Equipment_Name').addEventListener('change', function() {
    const equipmentId = this.value;
    const equipmentNoInput = document.getElementById('Equipment_Number');

    if (equipmentId) {
        // AJAX request untuk mendapatkan equipment_no
        fetch(`/get-equipment-no/${equipmentId}`)
            .then(response => response.json())
            .then(data => {
                equipmentNoInput.value = data.Equipment_Number || 'Not Found';
            })
            .catch(error => console.error('Error fetching equipment number:', error));
    } else {
        equipmentNoInput.value = '';
    }
});

    $(document).ready(function (){
        $('#myForm').validate({
            rules: {
                Request_dept: {
                    required : true,
                }, 
                model_id: {
                    required : true,
                }, 
                Name: {
                    required : true,
                }, 
                shift_id: {
                    required : true,
                }, 
                To_department: {
                    required : true,
                }, 
                lot_id: {
                    required : true,
                }, 
                Equipment_id: {
                    required : true,
                }, 
                line_id: {
                    required : true,
                }, 
                Date_pd: {
                    required : true,
                }, 
                Description: {
                    required : true,
                }, 
                Breakdown_time: {
                    required : true,
                }, 
                Report_time: {
                    required : true,
                }, 
                
            },
            messages :{
                Request_dept: {
                    required : 'Please Enter Request_dept',
                },
                model_id: {
                    required : 'Please Enter Model',
                },
                Name: {
                    required : 'Please Enter Model',
                },
                shift_id: {
                    required : 'Please Enter Shift',
                },
                To_department: {
                    required : 'Please Enter To_department',
                },
                lot_id: {
                    required : 'Please Enter Lot',
                },
                Equipment_id: {
                    required : 'Please Enter Process',
                },
                line_id: {
                    required : 'Please Enter Line',
                },
                Date_pd: {
                    required : 'Please Enter Date_pd',
                },
                Description: {
                    required : 'Please Enter Description',
                },
                Breakdown_time: {
                    required : 'Please Enter Breakdown_time',
                },
                Report_time: {
                    required : 'Please Enter Report_time',
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