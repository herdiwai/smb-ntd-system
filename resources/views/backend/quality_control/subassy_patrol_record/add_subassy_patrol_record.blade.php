@extends('admin.admin_dashboard')
@section('admin')

<script src="{{ asset('backend/assets/vendors/jquery-ajax/jquery.min.js') }}"></script>

<div class="page-content">
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">IN-PROCESS PATROL AND MATERIAL INSPECTION RECORD FORM </h6>

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

                    <form id="myForm" action="" method="POST">
                        @csrf
                        {{-- @if ($currentPage == 1)
                            <div id="page1"> --}}
                            <div class="form-step" id="step1">
                                <div class="row">
                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <div class="form-row align-items-center">
                                                <div class="col-sm-4">
                                                    <label for="model">Model</label>
                                                </div>
                                                <div class="col">
                                                    <select id="model" name="model_id" class="form-select">
                                                        <option value="">Select Model</option>
                                                        @foreach($modelbrewer as $models)
                                                            <option value="{{ $models->id }}" 
                                                                {{ (old('model', session('model')) == $models->id) ? 'selected' : '' }}>
                                                                {{ $models->model }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>                                   
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <div class="form-group">
                                            <div class="form-row align-items-center">
                                                <div class="col-sm-5">
                                                    <label for="frequency_of_inspection" class="col-form-label">Frequency of Inspection</label>
                                                </div>
                                                <div class="col">
                                                    <input type="text" class="form-control" id="frequency_of_inspection" placeholder=""
                                                        name="frequency_of_inspection" value="{{ old('frequency_of_inspection', session('frequency_of_inspection')) }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <div class="form-group">
                                            <div class="form-row align-items-center">
                                                <div class="col-sm-3">
                                                    <label for="" class="col-form-label">Date</label>
                                                </div>
                                                <div class="col">
                                                    <input type="date" name="date" id="" class="form-control" placeholder="Select date" value="{{ old('date', session('date')) }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end row pertama -->

                                <!-- row kedua -->
                                <div class="row">
                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <div class="form-row align-items-center">
                                                <div class="col-sm-4">
                                                    <label for="product_name" class="col-form-label">Product Name</label>
                                                </div>
                                                <div class="col">
                                                    <input type="text" class="form-control" id="product_name" placeholder="" name="product_name" value="{{ old('product_name', session('product_name')) }}">
                                                </div>
                                            </div>
                                        </div>                                   
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <div class="form-group">
                                            <div class="form-row align-items-center">
                                                <div class="col-sm-5">
                                                    <label for="inspection_standard" class="col-form-label">Inspection Standard</label>
                                                </div>
                                                <div class="col">
                                                    <input type="text" class="form-control" id="inspection_standard" placeholder="" name="inspection_standard" value="{{ old('inspection_standard', session('inspection_standard')) }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <div class="form-group">
                                            <div class="form-row align-items-center">
                                                <div class="col-sm-3">
                                                    <label for="inspected_by" class="col-form-label">Inspected By</label>
                                                </div>
                                                <div class="col">
                                                    <input type="text" class="form-control" id="inspected_by" placeholder="" name="inspected_by" value="{{ old('inspected_by', session('inspected_by')) }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end row kedua -->

                                <!-- row ketiga -->
                                <div class="row">
                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <div class="form-row align-items-center">
                                                <div class="col-sm-4">
                                                    <label for="production_unit" class="col-form-label">Production Unit</label>
                                                </div>
                                                <div class="col">
                                                    <input type="text" class="form-control" id="production_unit" placeholder="" name="production_unit" value="{{ old('production_unit', session('production_unit')) }}">
                                                </div>
                                            </div>
                                        </div>                                   
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <div class="form-group">
                                            <div class="form-row align-items-center">
                                                <div class="col-sm-5">
                                                    <label for="shift" class="col-form-label">Shift</label>
                                                </div>
                                                <div class="col">
                                                    <select id="shift" name="shift_id" class="form-select">
                                                        <option value="">Select Shift</option>
                                                        @foreach($shift as $shifts)
                                                            <option value="{{ $shifts->id }}" {{ (old('shift_id', session('shift_id')) == $shifts->id) ? 'selected' : '' }}>
                                                                {{ $shifts->shift }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <div class="form-group">
                                            <div class="form-row align-items-center">
                                                <div class="col-sm-3">
                                                    <label for="reviewed_by" class="col-form-label">Reviewed By</label>
                                                </div>
                                                <div class="col">
                                                    <input type="text" class="form-control" id="reviewed_by" placeholder="" name="reviewed_by" value="{{ old('reviewed_by', session('reviewed_by')) }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end row ketiga -->

                                <!-- row keempat -->
                                <div class="row">
                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <div class="form-row align-items-center">
                                                <div class="col-sm-4">
                                                    <label for="line" class="col-form-label">Line</label>
                                                </div>
                                                <div class="col">
                                                    <select id="line" name="line_id" class="form-select">
                                                        <option value="">Select Line</option>
                                                        @foreach($line as $lines)
                                                            <option value="{{ $lines->id }}" {{ (old('line_id', session('line_id')) == $lines->id) ? 'selected' : '' }}>
                                                                {{ $lines->line }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>                                   
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <div class="form-group">
                                            <div class="form-row align-items-center">
                                                <div class="col-sm-5">
                                                    <label for="lot" class="col-form-label">Lot</label>
                                                </div>
                                                <div class="col">
                                                    <select id="lot" name="lot_id" class="form-select">
                                                        <option value="">Select Lot</option>
                                                        @foreach($lot as $lots)
                                                            <option value="{{ $lots->id }}" {{ (old('lot_id', session('lot_id')) == $lines->id) ? 'selected' : '' }}>
                                                                {{ $lots->lot }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>        
                                </div>
                                <!-- end row keempat -->

                                <hr/>
                                <h6>Inspection Checking Results ( FTH ASSY )</h6>
                                <div class="row">
                                    <div class="row d-flex align-items-center">
                                        <div class="col-sm-2">
                                            <label for="inspection_item_select" class="col-form-label">Inspection Item</label>
                                            <select name="inspection_item[]" id="inspection_item_select" class="form-select">
                                                <option value="">Select Item</option>
                                                @foreach ($inspection_item as $item)
                                                    @if ($item->name == 'FTH Assy')
                                                        <option value="{{ $item->id }}">{{ $item->inspection_item }}</option> 
                                                    @endif
                                                @endforeach
                                            </select> 
                                        </div>
                                    
                                        <div class="col-sm-2">
                                            <label for="defect_grade_select1" class="col-form-label">Defect Grade</label>
                                            <select name="defect_grade[]" id="defect_grade_select1" class="form-select">
                                                <option value="{{ session('defect_grade') }}">Select Grade</option>                                           
                                                <option value="Cricital">Cricital</option>
                                                <option value="Major">Major</option>
                                                <option value="Minor">Minor</option>
                                                <option value="Critical/Major">Critical/Major</option>                                              
                                            </select>
                                            {{-- <input type="text" class="form-control" id="defect_grade" placeholder="" name="defect_grade[]" value="{{ old('defect_grade', session('defect_grade')) }}"> --}}
                                        </div>
                                    
                                        <div class="col-sm-2">
                                            <label for="sample_no_pcs1" class="col-form-label">Sample No (PCS)</label>
                                            <select name="sample_no_pcs[]" id="sample_no_pcs1" class="form-select">
                                                <option value="{{ session('sample_no_pcs') }}">Select Item</option>
                                                <option value="13pcs/2hrs">13pcs/2hrs</option>
                                                <option value="2pcs/shift">2pcs/shift</option>
                                                <option value="2pcs/2hrs">2pcs/2hrs</option>
                                                <option value="13pcs/shift">13pcs/shift</option>                                              
                                            </select>
                                            {{-- <input type="text" class="form-control" id="sample_no_pcs1" placeholder="" name="sample_no_pcs[]" value="{{ old('sample_no_pcs', session('sample_no_pcs')) }}"> --}}
                                        </div>
                                    
                                        <div class="col-sm-2">
                                            <label for="timeSelect" class="col-form-label">Time</label>
                                            <select name="time[]" id="timeSelect" class="form-select">
                                                <option value="{{ session('time') }}">Select Time</option>
                                                    @foreach($time as $times)
                                                        <option value="{{ $times->id }}">{{ $times->time }}</option>
                                                    @endforeach
                                            </select>
                                        </div>
                                    
                                        <div class="col-sm-2">
                                            <label for="result1" class="col-form-label">Result</label>
                                            <select name="result[]" id="result1" class="form-select">
                                                <option value="{{ session('result') }}">Select Result</option>
                                                <option value="OK">OK</option>
                                                <option value="NG">NG</option>                                              
                                            </select>
                                            {{-- <input type="text" class="form-control" id="result" placeholder="" name="result[]" value="{{ old('result', session('result')) }}"> --}}
                                        </div>
                                        
                                    
                                        <div class="col-sm-2">
                                            <label for="remark_ddca" class="col-form-label">Remark DDP & CA</label>
                                            <input type="text" class="form-control" id="remark_ddca" placeholder="" name="remark_ddca[]" value="{{ old('remark_ddca', session('remark_ddca')) }}">
                                            {{-- @foreach(old('remark_ddca', session('remark_ddca', [])) as $key => $value)
                                                <input type="text" class="form-control" id="remark_ddca_{{ $key }}" placeholder="" name="remark_ddca[]" value="{{ $value }}">
                                            @endforeach --}}
                                        </div>
                                    </div>
                                </div>
                                <br/>

                                <div class="row">
                                    <div class="row d-flex align-items-center">
                                        <div class="col-sm-2">
                                            <select name="inspection_item[]" id="inspection_item_select2" class="form-select">
                                                <option value="">Select Item</option>
                                                @foreach ($inspection_item as $item)
                                                    @if ($item->name == 'FTH Assy')
                                                        <option value="{{ $item->id }}">{{ $item->inspection_item }}</option> 
                                                    @endif
                                                @endforeach
                                            </select> 
                                        </div>
                                    
                                        <div class="col-sm-2">
                                            <select name="defect_grade[]" id="defect_grade_select2" class="form-select">
                                                <option value="{{ session('defect_grade') }}">Select Grade</option>                                           
                                                <option value="Cricital">Cricital</option>
                                                <option value="Major">Major</option>
                                                <option value="Minor">Minor</option>
                                                <option value="Critical/Major">Critical/Major</option>                                              
                                            </select>
                                            {{-- <input type="text" class="form-control" id="defect_grade2" placeholder="" name="defect_grade2[]" value="{{ old('defect_grade2', session('defect_grade2')) }}"> --}}
                                        </div>
                                    
                                        <div class="col-sm-2">
                                            <select name="sample_no_pcs[]" id="sample_no_pcs2" class="form-select">
                                                <option value="{{ session('sample_no_pcs') }}">Select Item</option>
                                                <option value="13pcs/2hrs">13pcs/2hrs</option>
                                                <option value="2pcs/shift">2pcs/shift</option>
                                                <option value="2pcs/2hrs">2pcs/2hrs</option>
                                                <option value="13pcs/shift">13pcs/shift</option>                                              
                                            </select>
                                            {{-- <input type="text" class="form-control" id="sample_no2" placeholder="" name="sample_no2[]" value="{{ old('sample_no2', session('sample_no2')) }}"> --}}
                                        </div>
                                    
                                        <div class="col-sm-2">
                                            <select name="time[]" id="time_2" class="form-select">
                                                <option value="{{ session('time_2') }}">Select Time</option>
                                                    @foreach($time as $times)
                                                        <option value="{{ $times->id }}">{{ $times->time }}</option>
                                                    @endforeach
                                            </select>
                                            {{-- <input type="text" class="form-control" id="time_2" placeholder="" name="time[]" value="{{ old('time_2', session('time_2')) }}" readonly> --}}
                                        </div>
                                    
                                        <div class="col-sm-2">
                                            <select name="result[]" id="result2" class="form-select">
                                                <option value="{{ session('result') }}">Select Result</option>
                                                <option value="OK">OK</option>
                                                <option value="NG">NG</option>                                              
                                            </select>
                                            {{-- <input type="text" class="form-control" id="result2" placeholder="" name="result[]" value="{{ old('result2', session('result2')) }}"> --}}
                                        </div>
                                    
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" id="remark_ddca2" placeholder="" name="remark_ddca[]" value="{{ old('remark_ddca2', session('remark_ddca2')) }}">
                                        </div>
                                    </div>
                                </div>
                                <br/>

                                <div class="row">
                                    <div class="row d-flex align-items-center">
                                        <div class="col-sm-2">
                                            <select name="inspection_item[]" id="inspection_item_select3" class="form-select">
                                                <option value="">Select Item</option>
                                                @foreach ($inspection_item as $item)
                                                    @if ($item->name == 'FTH Assy')
                                                        <option value="{{ $item->id }}">{{ $item->inspection_item }}</option> 
                                                    @endif
                                                @endforeach
                                            </select> 
                                        </div>
                                    
                                        <div class="col-sm-2">
                                            <select name="defect_grade[]" id="defect_grade_select3" class="form-select">
                                                <option value="{{ session('defect_grade') }}">Select Grade</option>                                           
                                                <option value="Cricital">Cricital</option>
                                                <option value="Major">Major</option>
                                                <option value="Minor">Minor</option>
                                                <option value="Critical/Major">Critical/Major</option>                                              
                                            </select>
                                            {{-- <input type="text" class="form-control" id="defect_grade3" placeholder="" name="defect_grade3[]" value="{{ old('defect_grade3', session('defect_grade3')) }}"> --}}
                                        </div>
                                    
                                        <div class="col-sm-2">
                                            <select name="sample_no_pcs[]" id="sample_no_pcs3" class="form-select">
                                                <option value="{{ session('sample_no_pcs') }}">Select Item</option>
                                                <option value="13pcs/2hrs">13pcs/2hrs</option>
                                                <option value="2pcs/shift">2pcs/shift</option>
                                                <option value="2pcs/2hrs">2pcs/2hrs</option>
                                                <option value="13pcs/shift">13pcs/shift</option>                                              
                                            </select>
                                            {{-- <input type="text" class="form-control" id="sample_no3" placeholder="" name="sample_no3[]" value="{{ old('sample_no3', session('sample_no3')) }}"> --}}
                                        </div>
                                    
                                        <div class="col-sm-2">
                                            <select name="time[]" id="time_3" class="form-select">
                                                <option value="{{ session('time_3') }}">Select Time</option>
                                                    @foreach($time as $times)
                                                        <option value="{{ $times->id }}">{{ $times->time }}</option>
                                                    @endforeach
                                            </select>
                                            {{-- <input type="text" class="form-control" id="time_3" placeholder="" name="time[]" value="{{ old('time_3', session('time_3')) }}" readonly> --}}
                                        </div>
                                    
                                        <div class="col-sm-2">
                                            <select name="result[]" id="result3" class="form-select">
                                                <option value="{{ session('result') }}">Select Result</option>
                                                <option value="OK">OK</option>
                                                <option value="NG">NG</option>                                              
                                            </select>
                                            {{-- <input type="text" class="form-control" id="result3" placeholder="" name="result[]" value="{{ old('result3', session('result3')) }}"> --}}
                                        </div>
                                    
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" id="remark_ddca3" placeholder="" name="remark_ddca[]" value="{{ old('remark_ddca3', session('remark_ddca3')) }}">
                                        </div>
                                    </div>
                                </div>
                                <br/>

                                <div class="row">
                                    <div class="row d-flex align-items-center">
                                        <div class="col-sm-2">   
                                            <select name="inspection_item[]" id="inspection_item_select4" class="form-select">
                                                <option value="">Select Item</option>
                                                @foreach ($inspection_item as $item)
                                                    @if ($item->name == 'FTH Assy')
                                                        <option value="{{ $item->id }}">{{ $item->inspection_item }}</option> 
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    
                                        <div class="col-sm-2">
                                            <select name="defect_grade[]" id="defect_grade_select4" class="form-select">
                                                <option value="{{ session('defect_grade') }}">Select Grade</option>                                           
                                                <option value="Cricital">Cricital</option>
                                                <option value="Major">Major</option>
                                                <option value="Minor">Minor</option>
                                                <option value="Critical/Major">Critical/Major</option>                                              
                                            </select>
                                            {{-- <input type="text" class="form-control" id="defect_grade4" placeholder="" name="defect_grade4[]" value="{{ old('defect_grade4', session('defect_grade4')) }}"> --}}
                                        </div>
                                    
                                        <div class="col-sm-2">
                                            <select name="sample_no_pcs[]" id="sample_no_pcs4" class="form-select">
                                                <option value="{{ session('sample_no_pcs') }}">Select Item</option>
                                                <option value="13pcs/2hrs">13pcs/2hrs</option>
                                                <option value="2pcs/shift">2pcs/shift</option>
                                                <option value="2pcs/2hrs">2pcs/2hrs</option>
                                                <option value="13pcs/shift">13pcs/shift</option>                                              
                                            </select>
                                            {{-- <input type="text" class="form-control" id="sample_no4" placeholder="" name="sample_no4[]" value="{{ old('sample_no4', session('sample_no4')) }}"> --}}
                                        </div>
                                    
                                        <div class="col-sm-2">
                                            <select name="time[]" id="time_4" class="form-select">
                                                <option value="{{ session('time_4') }}">Select Time</option>
                                                    @foreach($time as $times)
                                                        <option value="{{ $times->id }}">{{ $times->time }}</option>
                                                    @endforeach
                                            </select>
                                            {{-- <input type="text" class="form-control" id="time_4" placeholder="" name="time[]" value="{{ old('time_4', session('time_4')) }}" readonly> --}}
                                        </div>
                                    
                                        <div class="col-sm-2">
                                            <select name="result[]" id="result4" class="form-select">
                                                <option value="{{ session('result') }}">Select Result</option>
                                                <option value="OK">OK</option>
                                                <option value="NG">NG</option>                                              
                                            </select>
                                            {{-- <input type="text" class="form-control" id="result4" placeholder="" name="result[]" value="{{ old('result4', session('result4')) }}"> --}}
                                        </div>
                                    
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" id="remark_ddca4" placeholder="" name="remark_ddca[]" value="{{ old('remark_ddca4', session('remark_ddca4')) }}">
                                        </div>
                                    </div>
                                </div>
                                <br/>

                                <div class="row">
                                    <div class="row d-flex align-items-center">
                                        <div class="col-sm-2">
                                            <select name="inspection_item[]" id="inspection_item_select5" class="form-select">
                                                <option value="">Select Item</option>
                                                @foreach ($inspection_item as $item)
                                                    @if ($item->name == 'FTH Assy')
                                                        <option value="{{ $item->id }}">{{ $item->inspection_item }}</option> 
                                                    @endif
                                                @endforeach
                                            </select> 
                                        </div>
                                    
                                        <div class="col-sm-2">
                                            <select name="defect_grade[]" id="defect_grade_select5" class="form-select">
                                                <option value="{{ session('defect_grade') }}">Select Grade</option>                                           
                                                <option value="Cricital">Cricital</option>
                                                <option value="Major">Major</option>
                                                <option value="Minor">Minor</option>
                                                <option value="Critical/Major">Critical/Major</option>                                              
                                            </select>

                                            {{-- <input type="text" class="form-control" id="defect_grade5" placeholder="" name="defect_grade5[]" value="{{ old('defect_grade5', session('defect_grade5')) }}"> --}}
                                        </div>
                                    
                                        <div class="col-sm-2">
                                            <select name="sample_no_pcs[]" id="sample_no_pcs5" class="form-select">
                                                <option value="{{ session('sample_no_pcs') }}">Select Item</option>
                                                <option value="13pcs/2hrs">13pcs/2hrs</option>
                                                <option value="2pcs/shift">2pcs/shift</option>
                                                <option value="2pcs/2hrs">2pcs/2hrs</option>
                                                <option value="13pcs/shift">13pcs/shift</option>                                              
                                            </select>
                                            {{-- <input type="text" class="form-control" id="sample_no5" placeholder="" name="sample_no5[]" value="{{ old('sample_no5', session('sample_no5')) }}"> --}}
                                        </div>
                                    
                                        <div class="col-sm-2">
                                            <select name="time[]" id="time_5" class="form-select">
                                                <option value="{{ session('time_5') }}">Select Time</option>
                                                    @foreach($time as $times)
                                                        <option value="{{ $times->id }}">{{ $times->time }}</option>
                                                    @endforeach
                                            </select>
                                            {{-- <input type="text" class="form-control" id="time_5" placeholder="" name="time[]" value="{{ old('time_5', session('time_5')) }}" readonly> --}}
                                        </div>
                                    
                                        <div class="col-sm-2">
                                            <select name="result[]" id="result5" class="form-select">
                                                <option value="{{ session('result') }}">Select Result</option>
                                                <option value="OK">OK</option>
                                                <option value="NG">NG</option>                                              
                                            </select>
                                            {{-- <input type="text" class="form-control" id="result5" placeholder="" name="result[]" value="{{ old('result5', session('result5')) }}"> --}}
                                        </div>
                                    
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" id="remark_ddca5" placeholder="" name="remark_ddca[]" value="{{ old('remark_ddca5', session('remark_ddca5')) }}">
                                        </div>
                                    </div>
                                </div>
                                <br/>

                                <div class="row">
                                    <div class="row d-flex align-items-center">
                                        <div class="col-sm-2">
                                            <select name="inspection_item[]" id="inspection_item_select6" class="form-select">
                                                <option value="">Select Item</option>
                                                @foreach ($inspection_item as $item)
                                                    @if ($item->name == 'FTH Assy')
                                                        <option value="{{ $item->id }}">{{ $item->inspection_item }}</option> 
                                                    @endif
                                                @endforeach
                                            </select> 
                                        </div>
                                    
                                        <div class="col-sm-2">
                                            <select name="defect_grade[]" id="defect_grade_select6" class="form-select">
                                                <option value="{{ session('defect_grade') }}">Select Grade</option>                                           
                                                <option value="Cricital">Cricital</option>
                                                <option value="Major">Major</option>
                                                <option value="Minor">Minor</option>
                                                <option value="Critical/Major">Critical/Major</option>                                              
                                            </select>
                                            {{-- <input type="text" class="form-control" id="defect_grade6" placeholder="" name="defect_grade6[]" value="{{ old('defect_grade6', session('defect_grade6')) }}"> --}}
                                        </div>
                                    
                                        <div class="col-sm-2">
                                            <select name="sample_no_pcs[]" id="sample_no_pcs6" class="form-select">
                                                <option value="{{ session('sample_no_pcs') }}">Select Item</option>
                                                <option value="13pcs/2hrs">13pcs/2hrs</option>
                                                <option value="2pcs/shift">2pcs/shift</option>
                                                <option value="2pcs/2hrs">2pcs/2hrs</option>
                                                <option value="13pcs/shift">13pcs/shift</option>                                              
                                            </select>
                                            {{-- <input type="text" class="form-control" id="sample_no6" placeholder="" name="sample_no6[]" value="{{ old('sample_no6', session('sample_no6')) }}"> --}}
                                        </div>
                                    
                                        <div class="col-sm-2">
                                            <select name="time[]" id="time_6" class="form-select">
                                                <option value="{{ session('time_6') }}">Select Time</option>
                                                    @foreach($time as $times)
                                                        <option value="{{ $times->id }}">{{ $times->time }}</option>
                                                    @endforeach
                                            </select>
                                            {{-- <input type="text" class="form-control" id="time_6" placeholder="" name="time[]" value="{{ old('time_6', session('time_6')) }}" > --}}
                                        </div>
                                    
                                        <div class="col-sm-2">
                                            <select name="result[]" id="result6" class="form-select">
                                                <option value="{{ session('result') }}">Select Result</option>
                                                <option value="OK">OK</option>
                                                <option value="NG">NG</option>                                              
                                            </select>
                                            {{-- <input type="text" class="form-control" id="result6" placeholder="" name="result[]" value="{{ old('result6', session('result6')) }}"> --}}
                                        </div>
                                    
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" id="remark_ddca6" placeholder="" name="remark_ddca[]" value="{{ old('remark_ddca6', session('remark_ddca6')) }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="row d-flex align-items-center">
                                        <div class="col-sm-2">
                                            <input type="hidden" class="form-control" id="inspection_item7" name="inspection_item[]" value="20"> 
                                            {{-- <input type="hidden" class="form-control" id="inspection_item7" name="inspection_item[]" value="{{ old('inspection_item7', session('inspection_item7')) }}">  --}}
                                        </div>
                                        <div class="col-sm-2">
                                            <input type="hidden" class="form-control" id="defect_grade7" name="defect_grade[]" value="20"> 
                                        </div>
                                        <div class="col-sm-2">
                                            <input type="hidden" class="form-control" id="sample_no7" name="sample_no_pcs[]" value="20"> 
                                        </div>
                                       
                                        <div class="col-sm-2">
                                            <input type="hidden" class="form-control" id="time_7" name="time[]" value="1"> 
                                        </div>

                                        <div class="col-sm-2">
                                            <input type="hidden" class="form-control" id="result7" name="result[]" value="N/A"> 
                                        </div>
                                    
                                        <div class="col-sm-2">
                                            <input type="hidden" class="form-control" id="remark_ddca7" placeholder="" name="remark_ddca[]" value="-">
                                        </div>
                                    </div>
                                </div>
                                <br/>

                                
                                <hr/>

                                <h6>Check Material Specification Record</h6>
                                <br/>
                                <!-- row pertama -->
                                <div class="row">
                                    <div class="col-md-4 mb-4">
                                        <div class="form-row align-items-center">
                                            <div class="col-sm-4">
                                                <label for="material_name" class="col-form-label">Material Name</label>
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" id="material_name_1" placeholder="Enter Material Name" name="material_name[]" value="{{ old('material_name.0', session('material_name.0')) }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <div class="form-row align-items-center">
                                            <div class="col-sm-4">
                                                <label for="test_result" class="col-form-label">Test Result</label>
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" id="test_result_1" placeholder="Enter Test Result" name="test_result[]" value="{{ old('test_result.0', session('test_result.0')) }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <div class="form-row align-items-center">
                                            <div class="col-sm-4">
                                                <label for="decision" class="col-form-label">Decision</label>
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" id="decision_1" placeholder="Enter Decision" name="decision[]" value="{{ old('decision.0', session('decision.0')) }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end row pertama -->

                                <!-- row kedua -->
                                <div class="row">
                                    <div class="col-md-4 mb-4">
                                        <div class="form-row align-items-center">
                                            <div class="col-sm-4">
                                                <label for="material_name_2" class="col-form-label" style="display: none;" >Material Name</label>
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" id="material_name_2" placeholder="Enter Material Name" name="material_name[]" value="{{ old('material_name.1', session('material_name.1')) }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <div class="form-row align-items-center">
                                            <div class="col-sm-4">
                                                <label for="test_result_2" class="col-form-label" style="display: none;">Test Result</label>
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" id="test_result_2" placeholder="Enter Test Result" name="test_result[]" value="{{ old('test_result.1', session('test_result.1')) }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <div class="form-row align-items-center">
                                            <div class="col-sm-4">
                                                <label for="decision_2" class="col-form-label" style="display: none;">Decision</label>
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" id="decision_2" placeholder="Enter Decision" name="decision[]" value="{{ old('decision.1', session('decision.1')) }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                               

                                <!-- row ketiga -->
                                <div class="row">
                                    <div class="col-md-4 mb-4">
                                        <div class="form-row align-items-center">
                                            <div class="col-sm-4">
                                                <label for="material_name_3" class="col-form-label" style="display: none;">Material Name</label>
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" id="material_name_3" placeholder="Enter Material Name" name="material_name[]" value="{{ old('material_name.2', session('material_name.2')) }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <div class="form-row align-items-center">
                                            <div class="col-sm-4">
                                                <label for="test_result_3" class="col-form-label" style="display: none;">Test Result</label>
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" id="test_result_3" placeholder="Enter Test Result" name="test_result[]" value="{{ old('test_result.2', session('test_result.2')) }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <div class="form-row align-items-center">
                                            <div class="col-sm-4">
                                                <label for="decision_3" class="col-form-label" style="display: none;">Decision</label>
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" id="decision_3" placeholder="Enter Decision" name="decision[]" value="{{ old('decision.2', session('decision.2')) }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- row keempat -->
                                <div class="row">
                                    <div class="col-md-4 mb-4">
                                        <div class="form-row align-items-center">
                                            <div class="col-sm-4">
                                                <label for="material_name_4" class="col-form-label" style="display: none;">Material Name</label>
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" id="material_name_4" placeholder="Enter Material Name" name="material_name[]" value="{{ old('material_name.3', session('material_name.3')) }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <div class="form-row align-items-center">
                                            <div class="col-sm-4">
                                                <label for="test_result_4" class="col-form-label" style="display: none;">Test Result</label>
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" id="test_result_4" placeholder="Enter Test Result" name="test_result[]" value="{{ old('test_result.3', session('test_result.3')) }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <div class="form-row align-items-center">
                                            <div class="col-sm-4">
                                                <label for="decision_4" class="col-form-label" style="display: none;">Decision</label>
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" id="decision_4" placeholder="Enter Decision" name="decision[]" value="{{ old('decision.3', session('decision.3')) }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- row kelima -->
                                <div class="row">
                                    <div class="col-md-4 mb-4">
                                        <div class="form-row align-items-center">
                                            <div class="col-sm-4">
                                                <label for="material_name_5" class="col-form-label" style="display: none;">Material Name</label>
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" id="material_name_5" placeholder="Enter Material Name" name="material_name[]" value="{{ old('material_name.4', session('material_name.4')) }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <div class="form-row align-items-center">
                                            <div class="col-sm-4">
                                                <label for="test_result_5" class="col-form-label" style="display: none;">Test Result</label>
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" id="test_result_5" placeholder="Enter Test Result" name="test_result[]" value="{{ old('test_result.4', session('test_result.4')) }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <div class="form-row align-items-center">
                                            <div class="col-sm-4">
                                                <label for="decision_5" class="col-form-label" style="display: none;">Decision</label>
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" id="decision_5" placeholder="Enter Decision" name="decision[]" value="{{ old('decision.4', session('decision.4')) }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- row keenam -->
                                <div class="row">
                                    <div class="col-md-4 mb-4">
                                        <div class="form-row align-items-center">
                                            <div class="col-sm-4">
                                                <label for="material_name_6" class="col-form-label" style="display: none;">Material Name</label>
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" id="material_name_6" placeholder="Enter Material Name" name="material_name[]" value="{{ old('material_name.5', session('material_name.5')) }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <div class="form-row align-items-center">
                                            <div class="col-sm-4">
                                                <label for="test_result_6" class="col-form-label" style="display: none;">Test Result</label>
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" id="test_result_6" placeholder="Enter Test Result" name="test_result[]" value="{{ old('test_result.5', session('test_result.5')) }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <div class="form-row align-items-center">
                                            <div class="col-sm-4">
                                                <label for="decision_6" class="col-form-label" style="display: none;">Decision</label>
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" id="decision_6" placeholder="Enter Decision" name="decision[]" value="{{ old('decision.5', session('decision.5')) }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- row ketujuh -->
                                <div class="row">
                                    <div class="col-md-4 mb-4">
                                        <div class="form-row align-items-center">
                                            <div class="col-sm-4">
                                                <label for="material_name_7" class="col-form-label" style="display: none;">Material Name</label>
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" id="material_name_7" placeholder="Enter Material Name" name="material_name[]" value="{{ old('material_name.6', session('material_name.6')) }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <div class="form-row align-items-center">
                                            <div class="col-sm-4">
                                                <label for="test_result_7" class="col-form-label" style="display: none;">Test Result</label>
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" id="test_result_7" placeholder="Enter Test Result" name="test_result[]" value="{{ old('test_result.6', session('test_result.6')) }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <div class="form-row align-items-center">
                                            <div class="col-sm-4">
                                                <label for="decision_7" class="col-form-label" style="display: none;">Decision</label>
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" id="decision_7" placeholder="Enter Decision" name="decision[]" value="{{ old('decision.6', session('decision.6')) }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- <div id="error-message" style="color: red; display: none;"></div> <!-- Elemen untuk menampilkan pesan error --> --}}
                                <button type="button" class="btn btn-outline-primary" onclick="nextStep(2)">Next</button>
                            </div>
                            <!-- end step 1 -->
                        
                            {{-- @elseif ($currentPage == 2) 
                                <!-- pivot form -->
                                    <div id="page2"> --}}
                            <div class="form-step" id="step2" style="display:none;">
                                <h6>Inspection Checking Results ( PIVOT PLATE )</h6>
                                <div class="row">
                                    <div class="row d-flex align-items-center">
                                        <div class="col-sm-2">
                                            <label for="inspectionItem_PivotPlate_select" class="col-form-label">Inspection Item</label>
                                            <select name="inspection_item[]" id="inspectionItem_PivotPlate_select" class="form-select">
                                                <option value="">Select Item</option>
                                                @foreach ($inspection_item as $item)
                                                    @if ($item->name == 'Pivot Plate Assy')
                                                        <option value="{{ $item->id }}">{{ $item->inspection_item }}</option> 
                                                    @endif
                                                @endforeach
                                            </select> 
                                        </div>
                                        
                                        <div class="col-sm-2">
                                            <label for="defectGrade_PivotPlate" class="col-form-label">Defect Grade</label>
                                            <select name="defect_grade[]" id="defectGrade_PivotPlate" class="form-select">
                                                <option value="{{ session('defect_grade') }}">Select Grade</option>                                           
                                                <option value="Cricital">Cricital</option>
                                                <option value="Major">Major</option>
                                                <option value="Minor">Minor</option>
                                                <option value="Critical/Major">Critical/Major</option>                                              
                                            </select>
                                            {{-- <input type="text" class="form-control" id="defectGrade_PivotPlate" name="defectGrade_PivotPlate" value="{{ old('defectGrade_PivotPlate', session('defectGrade_PivotPlate')) }}"> --}}
                                        </div>
                                        <div class="col-sm-2">
                                            <label for="sampleNo_PivotPlate" class="col-form-label">Sample No (PCS)</label>
                                            <select name="sample_no_pcs[]" id="sampleNo_PivotPlate" class="form-select">
                                                <option value="{{ session('sample_no_pcs') }}">Select Item</option>
                                                <option value="13pcs/2hrs">13pcs/2hrs</option>
                                                <option value="2pcs/shift">2pcs/shift</option>
                                                <option value="2pcs/2hrs">2pcs/2hrs</option>
                                                <option value="13pcs/shift">13pcs/shift</option>                                              
                                            </select>
                                            {{-- <input type="text" class="form-control" id="sampleNo_PivotPlate" name="sampleNo_PivotPlate" value="{{ old('sampleNo_PivotPlate', session('sampleNo_PivotPlate')) }}"> --}}
                                        </div>
                                        
                                        <div class="col-sm-2">
                                            <label for="time_pivotplate_Select" class="col-form-label">Time</label>
                                            <select name="time[]" id="time_pivotplate_Select" class="form-select">
                                                <option value="">Select Time</option>
                                                @foreach($time as $times)
                                                    <option value="{{ $times->id }}" 
                                                        {{ (old('time_pivotplate_Select', session('time_pivotplate_Select')) == $times->id) ? 'selected' : '' }}>
                                                        {{ $times->time }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-sm-2">
                                            <label for="result_PivotPlate" class="col-form-label">Result</label>
                                            <select name="result[]" id="result_PivotPlate" class="form-select">
                                                <option value="{{ session('result') }}">Select Result</option>
                                                <option value="OK">OK</option>
                                                <option value="NG">NG</option>                                              
                                            </select>
                                            {{-- <input type="text" class="form-control" id="result_PivotPlate" name="result_PivotPlate" value="{{ old('result_PivotPlate', session('result_PivotPlate')) }}"> --}}
                                        </div>
                                        
                                        <div class="col-sm-2">
                                            <label for="remark_PivotPlate" class="col-form-label">Remark DDP & CA</label>
                                            <input type="text" class="form-control" id="remark_PivotPlate" placeholder="" name="remark_ddca[]" value="{{ old('remark_PivotPlate', session('remark_PivotPlate')) }}">
                                        </div>
                                    </div>
                                </div>
                                    
                                <br/>

                                <div class="row">
                                    <div class="row d-flex align-items-center">
                                        <div class="col-sm-2">
                                            <select name="inspection_item[]" id="inspectionItem_PivotPlate_select2" class="form-select">
                                                <option value="">Select Item</option>
                                                @foreach ($inspection_item as $item)
                                                    @if ($item->name == 'Pivot Plate Assy')
                                                        <option value="{{ $item->id }}">{{ $item->inspection_item }}</option> 
                                                    @endif
                                                @endforeach
                                            </select> 
                                            
                                        </div>
                                    
                                        <div class="col-sm-2">
                                            <select name="defect_grade[]" id="defectGrade_PivotPlate2" class="form-select">
                                                <option value="{{ session('defect_grade') }}">Select Grade</option>                                           
                                                <option value="Cricital">Cricital</option>
                                                <option value="Major">Major</option>
                                                <option value="Minor">Minor</option>
                                                <option value="Critical/Major">Critical/Major</option>                                              
                                            </select>
                                            {{-- <input type="text" class="form-control" id="defectGrade_PivotPlate2" placeholder="" name="defectGrade_PivotPlate2"  value="{{ old('defectGrade_PivotPlate2', session('defectGrade_PivotPlate2')) }}"> --}}
                                        </div>
                                    
                                        <div class="col-sm-2">
                                            <select name="sample_no_pcs[]" id="sampleNo_PivotPlate2" class="form-select">
                                                <option value="{{ session('sample_no_pcs') }}">Select Item</option>
                                                <option value="13pcs/2hrs">13pcs/2hrs</option>
                                                <option value="2pcs/shift">2pcs/shift</option>
                                                <option value="2pcs/2hrs">2pcs/2hrs</option>
                                                <option value="13pcs/shift">13pcs/shift</option>                                              
                                            </select>
                                            {{-- <input type="text" class="form-control" id="sampleNo_PivotPlate2" placeholder="" name="sampleNo_PivotPlate2"  value="{{ old('sampleNo_PivotPlate2', session('sampleNo_PivotPlate2')) }}"> --}}
                                        </div>
                                    
                                        <div class="col-sm-2">
                                            <select name="time[]" id="time_PivotPlate2" class="form-select">
                                                <option value="">Select Time</option>
                                                @foreach($time as $times)
                                                    <option value="{{ $times->id }}" 
                                                        {{ (old('time_PivotPlate2', session('time_PivotPlate2')) == $times->id) ? 'selected' : '' }}>
                                                        {{ $times->time }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            {{-- <input type="text" class="form-control" id="time_PivotPlate2" placeholder="" name="time[]"  value="{{ old('time_PivotPlate2', session('time_PivotPlate2')) }}"> --}}
                                        </div>
                                    
                                        <div class="col-sm-2">
                                            <select name="result[]" id="result_PivotPlate2" class="form-select">
                                                <option value="{{ session('result') }}">Select Result</option>
                                                <option value="OK">OK</option>
                                                <option value="NG">NG</option>                                              
                                            </select>
                                            {{-- <input type="text" class="form-control" id="result_PivotPlate2" placeholder="" name="result_PivotPlate2"  value="{{ old('result_PivotPlate2', session('result_PivotPlate2')) }}"> --}}
                                        </div>
                                    
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" id="remark_PivotPlate2" placeholder="" name="remark_ddca[]" value="{{ old('remark_PivotPlate2', session('remark_PivotPlate2')) }}">
                                        </div>
                                    </div>
                                </div>
                                <br/>

                                <div class="row">
                                    <div class="row d-flex align-items-center">
                                        <div class="col-sm-2">
                                            <select name="inspection_item[]" id="inspectionItem_PivotPlate_select3" class="form-select">
                                                <option value="">Select Item</option>
                                                @foreach ($inspection_item as $item)
                                                    @if ($item->name == 'Pivot Plate Assy')
                                                        <option value="{{ $item->id }}">{{ $item->inspection_item }}</option> 
                                                    @endif
                                                @endforeach
                                            </select> 
                                        </div>
                                    
                                        <div class="col-sm-2">
                                            <select name="defect_grade[]" id="defectGrade_PivotPlate3" class="form-select">
                                                <option value="{{ session('defect_grade') }}">Select Grade</option>                                           
                                                <option value="Cricital">Cricital</option>
                                                <option value="Major">Major</option>
                                                <option value="Minor">Minor</option>
                                                <option value="Critical/Major">Critical/Major</option>                                              
                                            </select>
                                            {{-- <input type="text" class="form-control" id="defectGrade_PivotPlate3" placeholder="" name="defectGrade_PivotPlate3" value="{{ old('defectGrade_PivotPlate3', session('defectGrade_PivotPlate3')) }}"> --}}
                                        </div>
                                    
                                        <div class="col-sm-2">
                                            <select name="sample_no_pcs[]" id="sampleNo_PivotPlate3" class="form-select">
                                                <option value="{{ session('sample_no_pcs') }}">Select Item</option>
                                                <option value="13pcs/2hrs">13pcs/2hrs</option>
                                                <option value="2pcs/shift">2pcs/shift</option>
                                                <option value="2pcs/2hrs">2pcs/2hrs</option>
                                                <option value="13pcs/shift">13pcs/shift</option>                                              
                                            </select>
                                            {{-- <input type="text" class="form-control" id="sampleNo_PivotPlate3" placeholder="" name="sampleNo_PivotPlate3" value="{{ old('sampleNo_PivotPlate3', session('sampleNo_PivotPlate3')) }}"> --}}
                                        </div>
                                    
                                        <div class="col-sm-2">
                                            <select name="time[]" id="time_PivotPlate3" class="form-select">
                                                <option value="">Select Time</option>
                                                @foreach($time as $times)
                                                    <option value="{{ $times->id }}" 
                                                        {{ (old('time_PivotPlate3', session('time_PivotPlate3')) == $times->id) ? 'selected' : '' }}>
                                                        {{ $times->time }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            {{-- <input type="text" class="form-control" id="time_PivotPlate3" placeholder="" name="time[]" value="{{ old('time_PivotPlate3', session('time_PivotPlate3')) }}"> --}}
                                        </div>
                                    
                                        <div class="col-sm-2">
                                            <select name="result[]" id="result_PivotPlate3" class="form-select">
                                                <option value="{{ session('result') }}">Select Result</option>
                                                <option value="OK">OK</option>
                                                <option value="NG">NG</option>                                              
                                            </select>
                                            {{-- <input type="text" class="form-control" id="result_PivotPlate3" placeholder="" name="result_PivotPlate3" value="{{ old('result_PivotPlate3', session('result_PivotPlate3')) }}"> --}}
                                        </div>
                                    
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" id="remark_PivotPlate3" placeholder="" name="remark_ddca[]" value="{{ old('remark_PivotPlate3', session('remark_PivotPlate3')) }}">
                                        </div>
                                    </div>
                                </div>
                                <br/>

                                <div class="row">
                                    <div class="row d-flex align-items-center">
                                        <div class="col-sm-2">
                                            <select name="inspection_item[]" id="inspectionItem_PivotPlate_select4" class="form-select">
                                                <option value="">Select Item</option>
                                                @foreach ($inspection_item as $item)
                                                    @if ($item->name == 'Pivot Plate Assy')
                                                        <option value="{{ $item->id }}">{{ $item->inspection_item }}</option> 
                                                    @endif
                                                @endforeach
                                            </select> 
                                        </div>
                                    
                                        <div class="col-sm-2">
                                            <select name="defect_grade[]" id="defectGrade_PivotPlate4" class="form-select">
                                                <option value="{{ session('defect_grade') }}">Select Grade</option>                                           
                                                <option value="Cricital">Cricital</option>
                                                <option value="Major">Major</option>
                                                <option value="Minor">Minor</option>
                                                <option value="Critical/Major">Critical/Major</option>                                              
                                            </select>
                                            {{-- <input type="text" class="form-control" id="defectGrade_PivotPlate4" placeholder="" name="defectGrade_PivotPlate4" value="{{ old('defectGrade_PivotPlate4', session('defectGrade_PivotPlate4')) }}"> --}}
                                        </div>
                                    
                                        <div class="col-sm-2">
                                            <select name="sample_no_pcs[]" id="sampleNo_PivotPlate4" class="form-select">
                                                <option value="{{ session('sample_no_pcs') }}">Select Item</option>
                                                <option value="13pcs/2hrs">13pcs/2hrs</option>
                                                <option value="2pcs/shift">2pcs/shift</option>
                                                <option value="2pcs/2hrs">2pcs/2hrs</option>
                                                <option value="13pcs/shift">13pcs/shift</option>                                              
                                            </select>
                                            {{-- <input type="text" class="form-control" id="sampleNo_PivotPlate4" placeholder="" name="sampleNo_PivotPlate4" value="{{ old('sampleNo_PivotPlate4', session('sampleNo_PivotPlate4')) }}"> --}}
                                        </div>
                                    
                                        <div class="col-sm-2">
                                            <select name="time[]" id="time_PivotPlate4" class="form-select">
                                                <option value="">Select Time</option>
                                                @foreach($time as $times)
                                                    <option value="{{ $times->id }}" 
                                                        {{ (old('time_PivotPlate4', session('time_PivotPlate4')) == $times->id) ? 'selected' : '' }}>
                                                        {{ $times->time }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            {{-- <input type="text" class="form-control" id="time_PivotPlate4" placeholder="" name="time[]" value="{{ old('time_PivotPlate4', session('time_PivotPlate4')) }}"> --}}
                                        </div>
                                    
                                        <div class="col-sm-2">
                                            <select name="result[]" id="result_PivotPlate4" class="form-select">
                                                <option value="{{ session('result') }}">Select Result</option>
                                                <option value="OK">OK</option>
                                                <option value="NG">NG</option>                                              
                                            </select>
                                            {{-- <input type="text" class="form-control" id="result_PivotPlate4" placeholder="" name="result_PivotPlate4" value="{{ old('result_PivotPlate4', session('result_PivotPlate4')) }}"> --}}
                                        </div>
                                    
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" id="remark_PivotPlate4" placeholder="" name="remark_ddca[]" value="{{ old('remark_PivotPlate4', session('remark_PivotPlate4')) }}">
                                        </div>
                                    </div>
                                </div>
                                <br/>

                                <div class="row">
                                    <div class="row d-flex align-items-center">
                                        <div class="col-sm-2">
                                            {{-- <input type="hidden" class="form-control" id="inspection_item_PivotPlate5" placeholder="" name="inspection_item[]" value="{{ old('inspection_item_PivotPlate5', session('inspection_item_PivotPlate5')) }}">    --}}
                                            <input type="hidden" class="form-control" id="inspection_item7" name="inspection_item[]" value="21"> 
                                        </div>
                                    
                                        <div class="col-sm-2">
                                            <input type="hidden" class="form-control" id="defectGrade_PivotPlate5" placeholder="" name="defect_grade[]" value="21">
                                        </div>
                                    
                                        <div class="col-sm-2">
                                            <input type="hidden" class="form-control" id="sampleNo_PivotPlate5" placeholder="" name="sample_no_pcs[]" value="21">
                                        </div>
                                    
                                        <div class="col-sm-2">
                                            <input type="hidden" class="form-control" id="time_PivotPlate5" placeholder="" name="time[]" value="1">
                                        </div>
                                    
                                        <div class="col-sm-2">
                                            <input type="hidden" class="form-control" id="result_PivotPlate5" placeholder="" name="result[]" value="N/A">
                                        </div>
                                    
                                        <div class="col-sm-2">
                                            <input type="hidden" class="form-control" id="remark_PivotPlate5" placeholder="" name="remark_ddca[]" value="-">
                                        </div>
                                    </div>
                                </div>
                                <br/>

                                <br/>

                                <h6>Check Material Specification Record</h6>
                                <br/>
                                
                                <!-- row pertama -->
                                <div class="row">
                                    <div class="col-md-4 mb-4">
                                        <div class="form-row align-items-center">
                                            <div class="col-sm-4">
                                                <label for="material_name_pivot_plate" class="col-form-label">Material Name</label>
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" id="material_name_pivot_plate" placeholder="Enter Material Name" name="material_name[]" value="{{ old('material_name_pivot_plate', session('material_name_pivot_plate')) }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <div class="form-row align-items-center">
                                            <div class="col-sm-4">
                                                <label for="test_result_pivot_plate" class="col-form-label">Test Result</label>
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" id="test_result_pivot_plate" placeholder="Enter Test Result" name="test_result[]" value="{{ old('test_result_pivot_plate', session('test_result_pivot_plate')) }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <div class="form-row align-items-center">
                                            <div class="col-sm-4">
                                                <label for="decision_pivot_plate" class="col-form-label">Decision</label>
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" id="decision_pivot_plate" placeholder="Enter Decision" name="decision[]" value="{{ old('decision_pivot_plate', session('decision_pivot_plate')) }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end row pertama -->

                                <!-- row kedua -->
                                <div class="row">
                                    <div class="col-md-4 mb-4">
                                        <div class="form-row align-items-center">
                                            <div class="col-sm-4">
                                                <label for="material_name_pivot_plate2" class="col-form-label" style="display: none;">Material Name</label>
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" id="material_name_pivot_plate2" placeholder="Enter Material Name" name="material_name[]" value="{{ old('material_name_pivot_plate2', session('material_name_pivot_plate2')) }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <div class="form-row align-items-center">
                                            <div class="col-sm-4">
                                                <label for="test_result_pivot_plate2" class="col-form-label" style="display: none;">Test Result</label>
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" id="test_result_pivot_plate2" placeholder="Enter Test Result" name="test_result[]" value="{{ old('test_result_pivot_plate2', session('test_result_pivot_plate2')) }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <div class="form-row align-items-center">
                                            <div class="col-sm-4">
                                                <label for="decision_pivot_plate2" class="col-form-label" style="display: none;">Decision</label>
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" id="decision_pivot_plate2" placeholder="Enter Decision" name="decision[]" value="{{ old('decision_pivot_plate2', session('decision_pivot_plate2')) }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end row kedua -->

                                <!-- row ketiga -->
                                <div class="row">
                                    <div class="col-md-4 mb-4">
                                        <div class="form-row align-items-center">
                                            <div class="col-sm-4">
                                                <label for="material_name_pivot_plate3" class="col-form-label" style="display: none;">Material Name</label>
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" id="material_name_pivot_plate3" placeholder="Enter Material Name" name="material_name[]" value="{{ old('material_name_pivot_plate3', session('material_name_pivot_plate3')) }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <div class="form-row align-items-center">
                                            <div class="col-sm-4">
                                                <label for="test_result_pivot_plate3" class="col-form-label" style="display: none;">Test Result</label>
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" id="test_result_pivot_plate3" placeholder="Enter Test Result" name="test_result[]" value="{{ old('test_result_pivot_plate3', session('test_result_pivot_plate3')) }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <div class="form-row align-items-center">
                                            <div class="col-sm-4">
                                                <label for="decision_pivot_plate3" class="col-form-label" style="display: none;">Decision</label>
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" id="decision_pivot_plate3" placeholder="Enter Decision" name="decision[]" value="{{ old('decision_pivot_plate3', session('decision_pivot_plate3')) }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end row ketiga -->

                                <!-- row keempat -->
                                <div class="row">
                                    <div class="col-md-4 mb-4">
                                        <div class="form-row align-items-center">
                                            <div class="col-sm-4">
                                                <label for="material_name_pivot_plate4" class="col-form-label" style="display: none;">Material Name</label>
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" id="material_name_pivot_plate4" placeholder="Enter Material Name" name="material_name[]" value="{{ old('material_name_pivot_plate4', session('material_name_pivot_plate4')) }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <div class="form-row align-items-center">
                                            <div class="col-sm-4">
                                                <label for="test_result_pivot_plate4" class="col-form-label" style="display: none;">Test Result</label>
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" id="test_result_pivot_plate4" placeholder="Enter Test Result" name="test_result[]" value="{{ old('test_result_pivot_plate4', session('test_result_pivot_plate4')) }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <div class="form-row align-items-center">
                                            <div class="col-sm-4">
                                                <label for="decision_pivot_plate4" class="col-form-label" style="display: none;">Decision</label>
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" id="decision_pivot_plate4" placeholder="Enter Decision" name="decision[]" value="{{ old('decision_pivot_plate4', session('decision_pivot_plate4')) }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end row keempat -->

                                <!-- row kelima -->
                                <div class="row">
                                    <div class="col-md-4 mb-4">
                                        <div class="form-row align-items-center">
                                            <div class="col-sm-4">
                                                <label for="material_name_pivot_plate5" class="col-form-label" style="display: none;">Material Name</label>
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" id="material_name_pivot_plate5" placeholder="Enter Material Name" name="material_name[]" value="{{ old('material_name_pivot_plate5', session('material_name_pivot_plate5')) }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <div class="form-row align-items-center">
                                            <div class="col-sm-4">
                                                <label for="test_result_pivot_plate5" class="col-form-label" style="display: none;">Test Result</label>
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" id="test_result_pivot_plate5" placeholder="Enter Test Result" name="test_result[]" value="{{ old('test_result_pivot_plate5', session('test_result_pivot_plate5')) }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <div class="form-row align-items-center">
                                            <div class="col-sm-4">
                                                <label for="decision_pivot_plate5" class="col-form-label" style="display: none;">Decision</label>
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" id="decision_pivot_plate5" placeholder="Enter Decision" name="decision[]" value="{{ old('decision_pivot_plate5', session('decision_pivot_plate5')) }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end row kelima -->

                              

                               
                                {{-- <a href="{{ route('add.ProcessPatrol', ['page' => 1]) }}" class="btn btn-outline-primary">Previous</a>
                                <button type="submit" formaction="{{ route('add.ProcessPatrol', ['page' => 3]) }}" class="btn btn-outline-primary">Next</button> --}}

                                <button type="button" class="btn btn-outline-primary" onclick="previousStep(1)">Previous</button>
                                <button type="button" class="btn btn-outline-primary" onclick="nextStep(3)">Next</button>
                            </div>

                            {{-- @elseif ($currentPage == 3)  --}}
                            <!-- water probe -->
                            {{-- <div id="page3"> --}}
                            <div class="form-step" id="step3" style="display:none;">
                                <h6>Inspection Checking Results ( WATER PROBE )</h6>
                                <br/>
                                <div class="row">
                                    <div class="row d-flex align-items-center">
                                        <div class="col-sm-2">
                                            <label for="inspectionItem_WaterProbe_select" class="col-form-label">Inspection Item</label>
                                            <select name="inspection_item[]" id="inspectionItem_WaterProbe_select" class="form-select">
                                                <option value="">Select Item</option>
                                                @foreach ($inspection_item as $item)
                                                    @if ($item->name == 'Water Probe')
                                                        <option value="{{ $item->id }}">{{ $item->inspection_item }}</option> 
                                                    @endif
                                                @endforeach
                                            </select> 
                                        </div>
                                        
                                        <div class="col-sm-2">
                                            <label for="defectGrade_WaterProbe" class="col-form-label">Defect Grade</label>
                                            <select name="defect_grade[]" id="defectGrade_WaterProbe" class="form-select">
                                                <option value="{{ session('defect_grade') }}">Select Grade</option>                                           
                                                <option value="Cricital">Cricital</option>
                                                <option value="Major">Major</option>
                                                <option value="Minor">Minor</option>
                                                <option value="Critical/Major">Critical/Major</option>                                              
                                            </select>
                                            {{-- <input type="text" class="form-control" id="defectGrade_WaterProbe" name="defectGrade_WaterProbe" value="{{ old('defectGrade_WaterProbe', session('defectGrade_WaterProbe')) }}"> --}}
                                        </div>
                                        <div class="col-sm-2">
                                            <label for="sampleNo_WaterProbe" class="col-form-label">Sample No (PCS)</label>
                                            <select name="sample_no_pcs[]" id="sampleNo_WaterProbe" class="form-select">
                                                <option value="{{ session('sample_no_pcs') }}">Select Item</option>
                                                <option value="13pcs/2hrs">13pcs/2hrs</option>
                                                <option value="2pcs/shift">2pcs/shift</option>
                                                <option value="2pcs/2hrs">2pcs/2hrs</option>
                                                <option value="13pcs/shift">13pcs/shift</option>                                              
                                            </select>
                                            {{-- <input type="text" class="form-control" id="sampleNo_WaterProbe" name="sampleNo_WaterProbe" value="{{ old('sampleNo_WaterProbe', session('sampleNo_WaterProbe')) }}"> --}}
                                        </div>
                                        
                                        <div class="col-sm-2">
                                            <label for="time_waterprobe_select" class="col-form-label">Time</label>
                                            <select name="time[]" id="time_waterprobe_select" class="form-select">
                                                <option value="">Select Time</option>
                                                @foreach($time as $times)
                                                    <option value="{{ $times->id }}" 
                                                        {{ (old('time_WaterProbe', session('time_WaterProbe')) == $times->id) ? 'selected' : '' }}>
                                                        {{ $times->time }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-sm-2">
                                            <label for="result_WaterProbe" class="col-form-label">Result</label>
                                            <select name="result[]" id="result_WaterProbe" class="form-select">
                                                <option value="{{ session('result') }}">Select Result</option>
                                                <option value="OK">OK</option>
                                                <option value="NG">NG</option>                                              
                                            </select>
                                            {{-- <input type="text" class="form-control" id="result_WaterProbe" name="result_WaterProbe" value="{{ old('result_WaterProbe', session('result_WaterProbe')) }}"> --}}
                                        </div>
                                        
                                        <div class="col-sm-2">
                                            <label for="remark_WaterProbe" class="col-form-label">Remark DDP & CA</label>
                                            <input type="text" class="form-control" id="remark_WaterProbe" placeholder="" name="remark_ddca[]" value="{{ old('remark_WaterProbe', session('remark_WaterProbe')) }}">
                                        </div>
                                    </div>
                                </div>
                                   
                                <br/>
                                <div class="row">
                                    <div class="row d-flex align-items-center">
                                        <div class="col-sm-2">
                                            <select name="inspection_item[]" id="inspectionItem_WaterProbe_select2" class="form-select">
                                                <option value="">Select Item</option>
                                                @foreach ($inspection_item as $item)
                                                    @if ($item->name == 'Water Probe')
                                                        <option value="{{ $item->id }}">{{ $item->inspection_item }}</option> 
                                                    @endif
                                                @endforeach
                                            </select> 
                                        </div>
                                    
                                        <div class="col-sm-2">
                                            <select name="defect_grade[]" id="defectGrade_WaterProbe2" class="form-select">
                                                <option value="{{ session('defect_grade') }}">Select Grade</option>                                           
                                                <option value="Cricital">Cricital</option>
                                                <option value="Major">Major</option>
                                                <option value="Minor">Minor</option>
                                                <option value="Critical/Major">Critical/Major</option>                                              
                                            </select>
                                            {{-- <input type="text" class="form-control" id="defectGrade_WaterProbe2" placeholder="" name="defectGrade_WaterProbe2" value="{{ old('defectGrade_WaterProbe2', session('remark_WaterProbe')) }}"> --}}
                                        </div>
                                    
                                        <div class="col-sm-2">
                                            <select name="sample_no_pcs[]" id="sampleNo_WaterProbe2" class="form-select">
                                                <option value="{{ session('sample_no_pcs') }}">Select Item</option>
                                                <option value="13pcs/2hrs">13pcs/2hrs</option>
                                                <option value="2pcs/shift">2pcs/shift</option>
                                                <option value="2pcs/2hrs">2pcs/2hrs</option>
                                                <option value="13pcs/shift">13pcs/shift</option>                                              
                                            </select>
                                            {{-- <input type="text" class="form-control" id="sampleNo_WaterProbe2" placeholder="" name="sampleNo_WaterProbe2" value="{{ old('remark_WaterProbe', session('remark_WaterProbe')) }}"> --}}
                                        </div>
                                    
                                        <div class="col-sm-2">
                                            <select name="time[]" id="time_WaterProbe2" class="form-select">
                                                <option value="">Select Time</option>
                                                @foreach($time as $times)
                                                    <option value="{{ $times->id }}" 
                                                        {{ (old('time_WaterProbe2', session('time_WaterProbe2')) == $times->id) ? 'selected' : '' }}>
                                                        {{ $times->time }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            {{-- <input type="text" class="form-control" id="time_WaterProbe2" placeholder="" name="time[]" value="{{ old('remark_WaterProbe', session('remark_WaterProbe')) }}"> --}}
                                        </div>
                                    
                                        <div class="col-sm-2">
                                            <select name="result[]" id="result_WaterProbe2" class="form-select">
                                                <option value="{{ session('result') }}">Select Result</option>
                                                <option value="OK">OK</option>
                                                <option value="NG">NG</option>                                              
                                            </select>
                                            {{-- <input type="text" class="form-control" id="result_WaterProbe2" placeholder="" name="result_WaterProbe2" value="{{ old('remark_WaterProbe', session('remark_WaterProbe')) }}"> --}}
                                        </div>
                                    
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" id="remark_WaterProbe2" placeholder="" name="remark_ddca[]" value="{{ old('remark_WaterProbe2', session('remark_WaterProbe2')) }}">
                                        </div>
                                    </div>
                                </div>
                                <hr/>
                                <h6>Check Material Specification Record</h6>
                                <br/>
                                 <!-- row pertama -->
                                 <div class="row">
                                    <div class="col-md-4 mb-4">
                                        <div class="form-row align-items-center">
                                            <div class="col-sm-4">
                                                <label for="material_name_WaterProbe1" class="col-form-label">Material Name</label>
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" id="material_name_WaterProbe1" placeholder="Enter Material Name" name="material_name[]" value="{{ old('material_name_WaterProbe1', session('material_name_WaterProbe1')) }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <div class="form-row align-items-center">
                                            <div class="col-sm-4">
                                                <label for="test_result_WaterProbe1" class="col-form-label">Test Result</label>
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" id="test_result_WaterProbe1" placeholder="Enter Test Result" name="test_result[]" value="{{ old('test_result_WaterProbe1', session('test_result_WaterProbe1')) }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <div class="form-row align-items-center">
                                            <div class="col-sm-4">
                                                <label for="decision_WaterProbe1" class="col-form-label">Decision</label>
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" id="decision_WaterProbe1" placeholder="Enter Decision" name="decision[]" value="{{ old('decision_WaterProbe1', session('decision_WaterProbe1')) }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- row kedua -->
                                <div class="row">
                                    <div class="col-md-4 mb-4">
                                        <div class="form-row align-items-center">
                                            <div class="col-sm-4">
                                                <label for="material_name_WaterProbe2" class="col-form-label" style="display: none;">Material Name</label>
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" id="material_name_WaterProbe2" placeholder="Enter Material Name" name="material_name[]" value="{{ old('material_name_WaterProbe2', session('material_name_WaterProbe2')) }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <div class="form-row align-items-center">
                                            <div class="col-sm-4">
                                                <label for="test_result_WaterProbe2" class="col-form-label"style="display: none;">Test Result</label>
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" id="test_result_WaterProbe2" placeholder="Enter Test Result" name="test_result[]" value="{{ old('test_result_WaterProbe2', session('test_result_WaterProbe2')) }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <div class="form-row align-items-center">
                                            <div class="col-sm-4">
                                                <label for="decision_WaterProbe2" class="col-form-label" style="display: none;">Decision</label>
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" id="decision_WaterProbe2" placeholder="Enter Decision" name="decision[]" value="{{ old('decision_WaterProbe2', session('decision_WaterProbe2')) }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end row kedua -->
                                
                              
                                {{-- <a href="{{ route('add.ProcessPatrol', ['page' => 2]) }}" class="btn btn-outline-primary">Previous</a>
                                <button type="submit" formaction="{{ route('add.ProcessPatrol', ['page' => 4]) }}" class="btn btn-outline-primary">Next</button> --}}
                                <button type="button" class="btn btn-outline-primary" onclick="previousStep(2)">Previous</button>
                                <button type="button" class="btn btn-outline-primary" onclick="nextStep(4)">Next</button>
                            </div>

                            {{-- @elseif ($currentPage == 4)  --}}
                            <!-- water probe -->
                            {{-- <div id="page3"> --}}
                            <div class="form-step" id="step4" style="display:none;">
                                <h6>Inspection Checking Results ( PM TRAY )</h6>
                                <br/>
                               <div class="row">
                                    <div class="row d-flex align-items-center">
                                        <div class="col-sm-2">
                                            <label for="inspectionItem_pmtray_select" class="col-form-label">Inspection Item</label>
                                            <select name="inspection_item[]" id="inspectionItem_pmtray_select" class="form-select">
                                                <option value="">Select Item</option>
                                                @foreach ($inspection_item as $item)
                                                    @if ($item->name == 'PM Tray')
                                                        <option value="{{ $item->id }}">{{ $item->inspection_item }}</option> 
                                                    @endif
                                                @endforeach
                                            </select>   
                                        </div>
                                        
                                        <div class="col-sm-2">
                                            <label for="defectGrade_pmtray" class="col-form-label">Defect Grade</label>
                                            <select name="defect_grade[]" id="defectGrade_pmtray" class="form-select">
                                                <option value="{{ session('defect_grade') }}">Select Grade</option>                                           
                                                <option value="Cricital">Cricital</option>
                                                <option value="Major">Major</option>
                                                <option value="Minor">Minor</option>
                                                <option value="Critical/Major">Critical/Major</option>                                              
                                            </select>
                                            {{-- <input type="text" class="form-control" id="defectGrade_pmtray" name="defectGrade_pmtray" value="{{ old('defectGrade_pmtray', session('defectGrade_pmtray')) }}"> --}}
                                        </div>
                                        <div class="col-sm-2">
                                            <label for="sampleNo_pmtray" class="col-form-label">Sample No (PCS)</label>
                                            <select name="sample_no_pcs[]" id="sampleNo_pmtray" class="form-select">
                                                <option value="{{ session('sample_no_pcs') }}">Select Item</option>
                                                <option value="13pcs/2hrs">13pcs/2hrs</option>
                                                <option value="2pcs/shift">2pcs/shift</option>
                                                <option value="2pcs/2hrs">2pcs/2hrs</option>
                                                <option value="13pcs/shift">13pcs/shift</option>                                              
                                            </select>
                                            {{-- <input type="text" class="form-control" id="sampleNo_pmtray" name="sampleNo_pmtray" value="{{ old('sampleNo_pmtray', session('sampleNo_pmtray')) }}"> --}}
                                        </div>
                                        
                                        <div class="col-sm-2">
                                            <label for="time_pmtray_select" class="col-form-label">Time</label>
                                            <select name="time[]" id="time_pmtray_select" class="form-select">
                                                <option value="">Select Item</option>    
                                                @foreach($time as $times)
                                                        <option value="{{ $times->id }}" 
                                                            {{ (old('time_pmtray_select', session('time_pmtray_select')) == $times->id) ? 'selected' : '' }}>
                                                            {{ $times->time }}
                                                        </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-sm-2">
                                            <label for="result_pmtray" class="col-form-label">Result</label>
                                            <select name="result[]" id="result_pmtray" class="form-select">
                                                <option value="{{ session('result') }}">Select Result</option>
                                                <option value="OK">OK</option>
                                                <option value="NG">NG</option>                                              
                                            </select>
                                            {{-- <input type="text" class="form-control" id="result_pmtray" name="result_pmtray" value="{{ old('result_pmtray', session('result_WaterProbe')) }}"> --}}
                                        </div>
                                        
                                        <div class="col-sm-2">
                                            <label for="remark_PMTray" class="col-form-label">Remark DDP & CA</label>
                                            <input type="text" class="form-control" id="remark_PMTray" placeholder="" name="remark_ddca[]" value="{{ old('remark_PMTray', session('remark_PMTray')) }}">
                                        </div>
                                    </div>
                                </div>
                                    
                                <br/>

                                <hr/>
                                <h6>Check Material Specification Record</h6>
                                <br/>
                                 <!-- row pertama -->
                                 <div class="row">
                                    <div class="col-md-4 mb-4">
                                        <div class="form-row align-items-center">
                                            <div class="col-sm-4">
                                                <label for="material_name_pmtray" class="col-form-label">Material Name</label>
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" id="material_name_pmtray" placeholder="Enter Material Name" name="material_name[]" value="{{ old('material_name_pmtray', session('material_name_pmtray')) }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <div class="form-row align-items-center">
                                            <div class="col-sm-4">
                                                <label for="test_result_pmtray" class="col-form-label">Test Result</label>
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" id="test_result_pmtray" placeholder="Enter Test Result" name="test_result[]" value="{{ old('test_result_pmtray', session('test_result_pmtray')) }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <div class="form-row align-items-center">
                                            <div class="col-sm-4">
                                                <label for="decision_pmtray" class="col-form-label">Decision</label>
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" id="decision_pmtray" placeholder="Enter Decision" name="decision[]" value="{{ old('decision_pmtray', session('decision_pmtray')) }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- end row pertama -->
                                <hr/>

                                <h6>Inspection Checking Results ( SAFETY VALVE )</h6>
                                <br/>
                                <div class="row">
                                    <div class="row d-flex align-items-center">
                                        <div class="col-sm-2">
                                            <label for="inspectionItem_safetyvalve" class="col-form-label">Inspection Item</label>
                                            <select name="inspection_item[]" id="inspectionItem_safetyvalve_select" class="form-select">
                                                <option value="">Select Item</option>
                                                @foreach ($inspection_item as $item)
                                                    @if ($item->name == 'Safety Valve')
                                                        <option value="{{ $item->id }}">{{ $item->inspection_item }}</option> 
                                                    @endif
                                                @endforeach
                                            </select> 
                                        </div>
                                        
                                        <div class="col-sm-2">
                                            <label for="defectGrade_safetyvalve" class="col-form-label">Defect Grade</label>
                                            <select name="defect_grade[]" id="defectGrade_safetyvalve" class="form-select">
                                                <option value="{{ session('defect_grade') }}">Select Grade</option>                                           
                                                <option value="Cricital">Cricital</option>
                                                <option value="Major">Major</option>
                                                <option value="Minor">Minor</option>
                                                <option value="Critical/Major">Critical/Major</option>                                              
                                            </select>
                                            {{-- <input type="text" class="form-control" id="defectGrade_safetyvalve" name="defectGrade_safetyvalve" value="{{ old('defectGrade_safetyvalve', session('defectGrade_safetyvalve')) }}"> --}}
                                        </div>
                                        <div class="col-sm-2">
                                            <label for="sampleNo_safetyvalve" class="col-form-label">Sample No (PCS)</label>
                                            <select name="sample_no_pcs[]" id="sampleNo_safetyvalve" class="form-select">
                                                <option value="{{ session('sample_no_pcs') }}">Select Item</option>
                                                <option value="13pcs/2hrs">13pcs/2hrs</option>
                                                <option value="2pcs/shift">2pcs/shift</option>
                                                <option value="2pcs/2hrs">2pcs/2hrs</option>
                                                <option value="13pcs/shift">13pcs/shift</option>                                              
                                            </select>
                                            {{-- <input type="text" class="form-control" id="sampleNo_safetyvalve" name="sampleNo_safetyvalve" value="{{ old('sampleNo_safetyvalve', session('sampleNo_safetyvalve')) }}"> --}}
                                        </div>
                                        
                                        <div class="col-sm-2">
                                            <label for="time_WaterProbe" class="col-form-label">Time</label>
                                            <select name="time[]" id="time_safetyvalve" class="form-select">
                                                <option value="">Select Item</option>    
                                                @foreach($time as $times)
                                                        <option value="{{ $times->id }}" 
                                                            {{ (old('time_safetyvalve', session('time_safetyvalve')) == $times->id) ? 'selected' : '' }}>
                                                            {{ $times->time }}
                                                        </option>
                                                @endforeach
                                            </select>
                                            {{-- <input type="text" class="form-control" id="time_safetyvalve" name="time[]" value="{{ old('time_safetyvalve', session('time_safetyvalve')) }}"> --}}
                                        </div>
                                        <div class="col-sm-2">
                                            <label for="result_safetyvalve" class="col-form-label">Result</label>
                                            <select name="result[]" id="result_safetyvalve" class="form-select">
                                                <option value="{{ session('result') }}">Select Result</option>
                                                <option value="OK">OK</option>
                                                <option value="NG">NG</option>                                              
                                            </select>
                                            {{-- <input type="text" class="form-control" id="result_safetyvalve" name="result_safetyvalve" value="{{ old('result_safetyvalve', session('result_safetyvalve')) }}"> --}}
                                        </div>
                                        
                                        <div class="col-sm-2">
                                            <label for="remark_safetyvalve" class="col-form-label">Remark DDP & CA</label>
                                            <input type="text" class="form-control" id="remark_safetyvalve" placeholder="" name="remark_ddca[]" value="{{ old('remark_safetyvalve', session('remark_safetyvalve')) }}">
                                        </div>
                                    </div>
                                </div>
                                <br/>

                                <hr/>
                                <h6>Check Material Specification Record</h6>
                                <br/>
                                 <!-- row pertama -->
                                 <div class="row">
                                    <div class="col-md-4 mb-4">
                                        <div class="form-row align-items-center">
                                            <div class="col-sm-4">
                                                <label for="material_name_safetyvalve" class="col-form-label">Material Name</label>
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" id="material_name_safetyvalve" placeholder="Enter Material Name" name="material_name[]" value="{{ old('material_name_safetyvalve', session('material_name_safetyvalve')) }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <div class="form-row align-items-center">
                                            <div class="col-sm-4">
                                                <label for="test_result_safetyvalve" class="col-form-label">Test Result</label>
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" id="test_result_safetyvalve" placeholder="Enter Test Result" name="test_result[]" value="{{ old('test_result_safetyvalve', session('test_result_safetyvalve')) }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <div class="form-row align-items-center">
                                            <div class="col-sm-4">
                                                <label for="decision_safetyvalve" class="col-form-label">Decision</label>
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" id="decision_safetyvalve" placeholder="Enter Decision" name="decision[]" value="{{ old('decision_safetyvalve', session('decision_safetyvalve')) }}">
                                            </div>
                                            <input type="hidden" name="is_final_step" value="true">
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- end row pertama -->
                                {{-- <a href="{{ route('add.ProcessPatrol', ['page' => 3]) }}" class="btn btn-outline-primary">Previous</a>
                                <button type="submit" formaction="" class="btn btn-outline-primary">Submit</button> --}}

                                <button type="button" class="btn btn-outline-primary" onclick="previousStep(3)">Previous</button>
                                <button type="submit" class="btn btn-outline-primary">Submit</button>
                            </div>
                                    
                        {{-- @endif --}}
                    </form>
                    @if (session('success'))
                        <p>{{ session('success') }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

{{-- <script>
    // Tambahkan event listener pada tombol Next
    document.getElementById('nextBtn').addEventListener('click', function (event) {
        nextStep(2, event); // Panggil fungsi dengan parameter step dan event
    });
</script> --}}


<script>
    function nextStep(step) {
        // Sembunyikan semua step
        document.querySelectorAll('.form-step').forEach(function(stepDiv) {
            stepDiv.style.display = 'none';
        });

        // Tampilkan step yang dipilih
        document.getElementById('step' + step).style.display = 'block';
    }

    function previousStep(step) {
        // Sembunyikan semua step
        document.querySelectorAll('.form-step').forEach(function(stepDiv) {
            stepDiv.style.display = 'none';
        });

        // Tampilkan step yang dipilih
        document.getElementById('step' + step).style.display = 'block';
    }

    // function nextStep(step, event) {
    //     // Mencegah aksi default tombol Next
    //     event.preventDefault();

    //     // Ambil semua input yang wajib diisi
    //     const requiredFields = document.querySelectorAll(
    //         '[name="remark_ddca[]"], [name="material_name[]"], [name="test_result[]"], [name="decision[]"]'
    //     );

    //     let isValid = true; // Asumsi awal valid
    //     const errorMessageDiv = document.getElementById('error-message');
    //     errorMessageDiv.style.display = 'none'; // Sembunyikan pesan error sebelumnya
    //     errorMessageDiv.innerHTML = ''; // Reset isi pesan error

    //     let errorMessages = []; // Array untuk menyimpan pesan kesalahan

    //     requiredFields.forEach(field => {
    //         if (field.value.trim() === '') {
    //             errorMessages.push(`${field.getAttribute('placeholder') || field.name} harus diisi minimal dengan "-"`);
    //             field.focus(); // Fokuskan ke field yang tidak valid
    //             isValid = false; // Tandai bahwa ada field kosong
    //         }
    //     });

    //     // Tampilkan pesan error jika ada
    //     if (!isValid) {
    //         errorMessageDiv.innerHTML = errorMessages.join('<br>'); // Gabungkan pesan kesalahan
    //         errorMessageDiv.style.display = 'block'; // Tampilkan pesan error
    //         return; // Hentikan eksekusi jika validasi gagal
    //     }

    //     // Jika validasi sukses, lanjutkan ke step berikutnya
    //     alert("Semua field sudah diisi, lanjut ke step " + step);
    //     // Tambahkan logika untuk menampilkan form step berikutnya
    // }

    // // Tambahkan event listener pada tombol Next
    // document.getElementById('nextBtn').addEventListener('click', function (event) {
    //     nextStep(2, event); // Panggil fungsi dengan event sebagai parameter
    // });
</script>

@endsection

{{-- <script type="text/javascript">
    $(document).ready(function (){
        $('#myForm').validate({
            rules: {
                remark_ddca: {
                    required : true,
                },
                remark_ddca2: {
                    required : true,
                },
                remark_ddca3: {
                    required : true,
                },
                remark_ddca4: {
                    required : true,
                },
                remark_ddca5: {
                    required : true,
                },
                remark_ddca6: {
                    required : true,
                },
                remark_ddca7: {
                    required : true,
                },
                material_name: {
                    required : true,
                },
                material_name_1: {
                    required : true,
                },
                material_name_2: {
                    required : true,
                },
                material_name_3: {
                    required : true,
                },
                material_name_4: {
                    required : true,
                },
                material_name_5: {
                    required : true,
                },
                material_name_6: {
                    required : true,
                },
                material_name_7: {
                    required : true,
                },
                
            },
            messages :{
                remark_ddca: {
                    required : 'Please Enter Remark',
                }, 
                remark_ddca3: {
                    required : '',
                }, 
                remark_ddca4: {
                    required : '',
                }, 
                remark_ddca5: {
                    required : '',
                }, 
                remark_ddca6: {
                    required : '',
                }, 
                material_name: {
                    required : 'Please Enter Material Name',
                },
                material_name_1: {
                    required : '',
                }, 
                material_name_2: {
                    required : '',
                }, 
                material_name_3: {
                    required : '',
                }, 
                material_name_4: {
                    required : '',
                }, 
                material_name_5: {
                    required : '',
                },  
                material_name_6: {
                    required : '',
                }, 
                material_name_7: {
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
    
</script> --}}

<!-- resources/views/form.blade.php -->
{{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $('#timeSelect').on('change', function() {
            var timeId = $(this).val();
            if (timeId) {
                // Lakukan AJAX request untuk mendapatkan data time
                $.ajax({
                    url: '/time/' + timeId,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        // Isi form input dengan data dari response
                        $('#time_2').val(data.time);
                        $('#time_3').val(data.time);
                        $('#time_4').val(data.time);
                        $('#time_5').val(data.time);
                        $('#time_6').val(data.time);  
                    }
                });
            } else {
                // Jika tidak ada produk yang dipilih, kosongkan input
                $('#time_2').val('');
                $('#time_3').val('');
                $('#time_4').val('');
                $('#time_5').val('');
                $('#time_6').val('');
            }
        });
    });

    $(document).ready(function() {
        $('#time_pivotplate_Select').on('change', function() {
            var timeId = $(this).val();
            if (timeId) {
                // Lakukan AJAX request untuk mendapatkan data time
                $.ajax({
                    url: '/time/' + timeId,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        // Isi form input dengan data dari response
                        $('#time_PivotPlate2').val(data.time);
                        $('#time_PivotPlate3').val(data.time);
                        $('#time_PivotPlate4').val(data.time); 
                    }
                });
            } else {
                // Jika tidak ada produk yang dipilih, kosongkan input
                $('#time_PivotPlate2').val('');
                $('#time_PivotPlate3').val('');
                $('#time_PivotPlate4').val('');
            }
        });
   
    });

 </script>

<script type="text/javascript">
    $(document).ready(function() {
        $('#time_waterprobe_select').on('change', function() {
            var timeId = $(this).val();
            if (timeId) {
                // Lakukan AJAX request untuk mendapatkan data time
                $.ajax({
                    url: '/time/' + timeId,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        // Isi form input dengan data dari response
                        $('#time_WaterProbe2').val(data.time);
                       
                    }
                });
            } else {
                // Jika tidak ada produk yang dipilih, kosongkan input
                $('#time_WaterProbe2').val('');
                
            }
        });
   
    });

    $(document).ready(function() {
        $('#time_pmtray_select').on('change', function() {
            var timeId = $(this).val();
            if (timeId) {
                // Lakukan AJAX request untuk mendapatkan data time
                $.ajax({
                    url: '/time/' + timeId,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        // Isi form input dengan data dari response
                        $('#time_safetyvalve').val(data.time);
                       
                    }
                });
            } else {
                // Jika tidak ada produk yang dipilih, kosongkan input
                $('#time_safetyvalve').val('');
                
            }
        });
   
    });

</script> --}}

{{-- <script type="text/javascript">
    $(document).ready(function() {
        $('#inspection_item_select').on('change', function() {
            var inspection_itemId = $(this).val();
            if (inspection_itemId) {
                // Lakukan AJAX request untuk mendapatkan data time
                $.ajax({
                    url: '/inspectionitem/' + inspection_itemId,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        // Isi form input dengan data dari response
                        $('#defect_grade').val(data.defect_grade);
                        $('#sample_no_pcs').val(data.sample_no_pcs); 
                    }
                });
            } else {
                // Jika tidak ada produk yang dipilih, kosongkan input
                $('#defect_grade').val('');
                $('#sample_no_pcs').val('');
            }
        });

        $('#inspection_item_select2').on('change', function() {
            var inspection_itemId = $(this).val();
            if (inspection_itemId) {
                // Lakukan AJAX request untuk mendapatkan data time
                $.ajax({
                    url: '/inspectionitem/' + inspection_itemId,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        // Isi form input dengan data dari response
                        $('#defect_grade2').val(data.defect_grade);
                        $('#sample_no2').val(data.sample_no_pcs); 
                    }
                });
            } else {
                // Jika tidak ada produk yang dipilih, kosongkan input
                $('#defect_grade2').val('');
                $('#sample_no2').val('');
            }
        });

        $('#inspection_item_select3').on('change', function() {
            var inspection_itemId = $(this).val();
            if (inspection_itemId) {
                // Lakukan AJAX request untuk mendapatkan data time
                $.ajax({
                    url: '/inspectionitem/' + inspection_itemId,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        // Isi form input dengan data dari response
                        $('#defect_grade3').val(data.defect_grade);
                        $('#sample_no3').val(data.sample_no_pcs); 
                    }
                });
            } else {
                // Jika tidak ada produk yang dipilih, kosongkan input
                $('#defect_grade3').val('');
                $('#sample_no3').val('');
            }
        });

        $('#inspection_item_select4').on('change', function() {
            var inspection_itemId = $(this).val();
            if (inspection_itemId) {
                // Lakukan AJAX request untuk mendapatkan data time
                $.ajax({
                    url: '/inspectionitem/' + inspection_itemId,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        // Isi form input dengan data dari response
                        $('#defect_grade4').val(data.defect_grade);
                        $('#sample_no4').val(data.sample_no_pcs); 
                    }
                });
            } else {
                // Jika tidak ada produk yang dipilih, kosongkan input
                $('#defect_grade4').val('');
                $('#sample_no4').val('');
            }
        });

        $('#inspection_item_select5').on('change', function() {
            var inspection_itemId = $(this).val();
            if (inspection_itemId) {
                // Lakukan AJAX request untuk mendapatkan data time
                $.ajax({
                    url: '/inspectionitem/' + inspection_itemId,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        // Isi form input dengan data dari response
                        $('#defect_grade5').val(data.defect_grade);
                        $('#sample_no5').val(data.sample_no_pcs); 
                    }
                });
            } else {
                // Jika tidak ada produk yang dipilih, kosongkan input
                $('#defect_grade5').val('');
                $('#sample_no5').val('');
            }
        });

        $('#inspection_item_select6').on('change', function() {
            var inspection_itemId = $(this).val();
            if (inspection_itemId) {
                // Lakukan AJAX request untuk mendapatkan data time
                $.ajax({
                    url: '/inspectionitem/' + inspection_itemId,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        // Isi form input dengan data dari response
                        $('#defect_grade6').val(data.defect_grade);
                        $('#sample_no6').val(data.sample_no_pcs); 
                    }
                });
            } else {
                // Jika tidak ada produk yang dipilih, kosongkan input
                $('#defect_grade6').val('');
                $('#sample_no6').val('');
            }
        });

        $('#inspectionItem_PivotPlate_select').on('change', function() {
            var inspection_itemId = $(this).val();
            if (inspection_itemId) {
                // Lakukan AJAX request untuk mendapatkan data time
                $.ajax({
                    url: '/inspectionitem/' + inspection_itemId,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        // Isi form input dengan data dari response
                        $('#defectGrade_PivotPlate').val(data.defect_grade);
                        $('#sampleNo_PivotPlate').val(data.sample_no_pcs); 
                    }
                });
            } else {
                // Jika tidak ada produk yang dipilih, kosongkan input
                $('#defectGrade_PivotPlate').val('');
                $('#sampleNo_PivotPlate').val('');
            }
        });

        $('#inspectionItem_PivotPlate_select2').on('change', function() {
            var inspection_itemId = $(this).val();
            if (inspection_itemId) {
                // Lakukan AJAX request untuk mendapatkan data time
                $.ajax({
                    url: '/inspectionitem/' + inspection_itemId,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        // Isi form input dengan data dari response
                        $('#defectGrade_PivotPlate2').val(data.defect_grade);
                        $('#sampleNo_PivotPlate2').val(data.sample_no_pcs); 
                    }
                });
            } else {
                // Jika tidak ada produk yang dipilih, kosongkan input
                $('#defectGrade_PivotPlate2').val('');
                $('#sampleNo_PivotPlate2').val('');
            }
        });

        $('#inspectionItem_PivotPlate_select3').on('change', function() {
            var inspection_itemId = $(this).val();
            if (inspection_itemId) {
                // Lakukan AJAX request untuk mendapatkan data time
                $.ajax({
                    url: '/inspectionitem/' + inspection_itemId,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        // Isi form input dengan data dari response
                        $('#defectGrade_PivotPlate3').val(data.defect_grade);
                        $('#sampleNo_PivotPlate3').val(data.sample_no_pcs); 
                    }
                });
            } else {
                // Jika tidak ada produk yang dipilih, kosongkan input
                $('#defectGrade_PivotPlate3').val('');
                $('#sampleNo_PivotPlate3').val('');
            }
        });

        $('#inspectionItem_PivotPlate_select4').on('change', function() {
            var inspection_itemId = $(this).val();
            if (inspection_itemId) {
                // Lakukan AJAX request untuk mendapatkan data time
                $.ajax({
                    url: '/inspectionitem/' + inspection_itemId,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        // Isi form input dengan data dari response
                        $('#defectGrade_PivotPlate4').val(data.defect_grade);
                        $('#sampleNo_PivotPlate4').val(data.sample_no_pcs); 
                    }
                });
            } else {
                // Jika tidak ada produk yang dipilih, kosongkan input
                $('#defectGrade_PivotPlate4').val('');
                $('#sampleNo_PivotPlate4').val('');
            }
        });


        $('#inspectionItem_WaterProbe_select').on('change', function() {
            var inspection_itemId = $(this).val();
            if (inspection_itemId) {
                // Lakukan AJAX request untuk mendapatkan data time
                $.ajax({
                    url: '/inspectionitem/' + inspection_itemId,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        // Isi form input dengan data dari response
                        $('#defectGrade_WaterProbe').val(data.defect_grade);
                        $('#sampleNo_WaterProbe').val(data.sample_no_pcs); 
                    }
                });
            } else {
                // Jika tidak ada produk yang dipilih, kosongkan input
                $('#defectGrade_WaterProbe').val('');
                $('#sampleNo_WaterProbe').val('');
            }
        });

        $('#inspectionItem_WaterProbe_select2').on('change', function() {
            var inspection_itemId = $(this).val();
            if (inspection_itemId) {
                // Lakukan AJAX request untuk mendapatkan data time
                $.ajax({
                    url: '/inspectionitem/' + inspection_itemId,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        // Isi form input dengan data dari response
                        $('#defectGrade_WaterProbe2').val(data.defect_grade);
                        $('#sampleNo_WaterProbe2').val(data.sample_no_pcs); 
                    }
                });
            } else {
                // Jika tidak ada produk yang dipilih, kosongkan input
                $('#defectGrade_WaterProbe2').val('');
                $('#sampleNo_WaterProbe2').val('');
            }
        });


        $('#inspectionItem_pmtray_select').on('change', function() {
            var inspection_itemId = $(this).val();
            if (inspection_itemId) {
                // Lakukan AJAX request untuk mendapatkan data time
                $.ajax({
                    url: '/inspectionitem/' + inspection_itemId,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        // Isi form input dengan data dari response
                        $('#defectGrade_pmtray').val(data.defect_grade);
                        $('#sampleNo_pmtray').val(data.sample_no_pcs); 
                    }
                });
            } else {
                // Jika tidak ada produk yang dipilih, kosongkan input
                $('#defectGrade_pmtray').val('');
                $('#sampleNo_pmtray').val('');
            }
        });

        $('#inspectionItem_safetyvalve_select').on('change', function() {
            var inspection_itemId = $(this).val();
            if (inspection_itemId) {
                // Lakukan AJAX request untuk mendapatkan data time
                $.ajax({
                    url: '/inspectionitem/' + inspection_itemId,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        // Isi form input dengan data dari response
                        $('#defectGrade_safetyvalve').val(data.defect_grade);
                        $('#sampleNo_safetyvalve').val(data.sample_no_pcs); 
                    }
                });
            } else {
                // Jika tidak ada produk yang dipilih, kosongkan input
                $('#defectGrade_safetyvalve').val('');
                $('#sampleNo_safetyvalve').val('');
            }
        });
    });
</script> --}}

