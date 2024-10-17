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

                    
                        <form action="{{ route('update.ProcessPatrol', $data->id) }}" method="POST">
                        @method('POST')
                        @csrf

                        <div class="form-step" id="step1">
                            <div class="row">
                                <div class="col-md-3 mb-3">
                                    <div class="form-group">
                                        <div class="form-row align-items-center">
                                            <div class="col-sm-4">
                                                <label for="model">Model</label>
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" id="model" name="model_id" value="{{ old('model', $data->modelBrewer->model) }}">
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
                                                    name="frequency_of_inspection" value="{{ old('frequency_of_inspection', $data->frequency_of_inspection) }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-4">
                                    <div class="form-group">
                                        <div class="form-row align-items-center">
                                            <div class="col-sm-3">
                                                <label for="date" class="col-form-label">Date</label>
                                            </div>
                                            <div class="col">
                                                <input type="date" name="date" id="date" class="form-control" placeholder="Select date" value="{{ old('date', $data->date) }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- row kedua-->
                            <div class="row">
                                <div class="col-md-3 mb-3">
                                    <div class="form-group">
                                        <div class="form-row align-items-center">
                                            <div class="col-sm-4">
                                                <label for="product_name" class="col-form-label">Product Name</label>
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" id="product_name" placeholder="" name="product_name" value="{{ old('product_name', $data->product_name) }}">
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
                                                <input type="text" class="form-control" id="inspection_standard" placeholder="" name="inspection_standard" value="{{ old('inspection_standard', $data->inspection_standard) }}">
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
                                                <input type="text" class="form-control" id="inspected_by" placeholder="" name="inspected_by" value="{{ old('inspected_by', $data->inspected_by) }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- row ketiga -->
                            <div class="row">
                                <div class="col-md-3 mb-3">
                                    <div class="form-group">
                                        <div class="form-row align-items-center">
                                            <div class="col-sm-4">
                                                <label for="production_unit" class="col-form-label">Production Unit</label>
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" id="production_unit" placeholder="" name="production_unit" value="{{ old('production_unit', $data->production_unit) }}">
                                            </div>
                                        </div>
                                    </div>                                   
                                </div>
                            
                                <div class="col-md-4 mb-4">
                                    <div class="form-group">
                                        <div class="form-row align-items-center">
                                            <div class="col-sm-5">
                                                <label for="shift">Shift</label>
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" id="shift" name="shift_id" value="{{ old('shift', $data->shift) }}">
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
                                                <input type="text" class="form-control" id="reviewed_by" placeholder="" name="reviewed_by" value="{{ old('reviewed_by', $data->reviewed_by) }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- row keempat -->
                            <div class="row">
                                <div class="col-md-3 mb-3">
                                    <div class="form-group">
                                        <div class="form-row align-items-center">
                                            <div class="col-sm-4">
                                                <label for="line">Line</label>
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" id="line" name="line_id" value="{{ old('line', $data->line) }}">
                                            </div>
                                        </div>
                                    </div>                                   
                                </div>

                                <div class="col-md-4 mb-4">
                                    <div class="form-group">
                                        <div class="form-row align-items-center">
                                            <div class="col-sm-5">
                                                <label for="lot">Lot</label>
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" id="lot" name="lot_id" value="{{ old('lot', $data->lot) }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>  
                            </div>
                            <!-- end row-->

                            <hr/>
                            <h6>Inspection Checking Results ( FTH ASSY )</h6>
                            @foreach(array_slice($detaildata->toArray(), 0, 7) as $index => $detail)
                                @if($detail['inspection_item'] !== null || 
                                    $detail['defect_grade'] !== null || 
                                    $detail['sample_no_pcs'] !== null || 
                                    $detail['time'] !== null || 
                                    $detail['result'] !== null || 
                                    $detail['remark_ddca'] !== null)

                                    <div class="row mb-3 d-flex align-items-center">
                                        <!-- Inspection Item -->
                                        @if(!is_null($detail['inspection_item']) && $detail['inspection_item'] !== '')
                                            <div class="col-sm-2">
                                                @if($index === 0)
                                                    <label for="inspection_item_select{{ $index + 1 }}" class="col-form-label">Inspection Item</label>
                                                @endif
                                                <input type="text" class="form-control" id="inspection_item_select{{ $index + 1 }}" 
                                                    name="inspection_item[]" value="{{ old('inspection_item.' . ($index), $detail['inspection_item'] == 20 ? 'N/A' : $detail['inspection_item']) }}">
                                            </div>

                                        @endif

                                        <!-- Defect Grade -->
                                        @if(!is_null($detail['defect_grade']) && $detail['defect_grade'] !== '')
                                        {{-- @if(!is_null($detail['defect_grade']) && $detail['defect_grade'] !== 'NULL') --}}
                                            <div class="col-sm-2">
                                                @if($index === 0)
                                                    <label for="defect_grade_select{{ $index + 1 }}" class="col-form-label">Defect Grade</label>
                                                @endif
                                                <input type="text" class="form-control" id="defect_grade_select{{ $index + 1 }}" 
                                                    name="defect_grade[]" value="{{ old('defect_grade.' . ($index), $detail['defect_grade'] == 20 ? 'N/A' : $detail['defect_grade']) }}">
                                            </div>
                                            
                                            
                                        @endif

                                        <!-- Sample No (PCS) -->
                                        @if(!is_null($detail['sample_no_pcs']) && $detail['sample_no_pcs'] !== '')
                                        {{-- @if(!is_null($detail['sample_no_pcs']) && $detail['sample_no_pcs'] !== 'NULL') --}}
                                            <div class="col-sm-2">
                                                @if($index === 0)
                                                    <label for="sample_no_pcs{{ $index + 1 }}" class="col-form-label">Sample No (PCS)</label>
                                                @endif
                                                <input type="text" class="form-control" id="sample_no_pcs{{ $index + 1 }}" 
                                                    name="sample_no_pcs[]" value="{{ old('sample_no_pcs.' . ($index), $detail['sample_no_pcs'] == 20 ? 'N/A' : $detail['sample_no_pcs']) }}">
                                            </div>
                                            
                                        @endif

                                            <!-- Time -->
                                        @if(!is_null($detail['time']) && $detail['time'] !== '')
                                        {{-- @if(!is_null($detail['time']) && $detail['time'] !== 'NULL') --}}
                                            <div class="col-sm-2">
                                                @if($index === 0)
                                                    <label for="time_{{ $index + 1 }}" class="col-form-label">Time</label>
                                                @endif
                                                <select name="time[]" id="time_waterprobe_select{{ $index + 1 }}" class="form-select">
                                                    <option value="">Select Time</option>
                                                    @foreach($time as $times)
                                                        <option value="{{ $times->id }}" {{ old('time.' . ($index), $detail['time_id'] ?? '') == $times->id ? 'selected' : '' }}>
                                                            {{ $times->time }}
                                                        </option>
                                                    @endforeach
                                                </select> 
                                            </div>
                                        @endif

                                        <!-- Result -->
                                        @if(!is_null($detail['result']) && $detail['result'] !== '')
                                        {{-- @if(!is_null($detail['result'])) --}}
                                            <div class="col-sm-2">
                                                @if($index === 0)
                                                    <label for="result{{ $index + 1 }}" class="col-form-label">Result</label>
                                                @endif
                                                {{-- <select name="result[]" id="result_WaterProbe{{ $index + 1 }}" class="form-select">
                                                    <option value="">Select Result</option>
                                                    <option value="OK" {{ old('result.' . ($index), $detail['result']) == 'OK' ? 'selected' : '' }}>OK</option>
                                                    <option value="NG" {{ old('result.' . ($index), $detail['result']) == 'NG' ? 'selected' : '' }}>NG</option>
                                                </select>  --}}
                                                <select name="result[]" id="result" class="form-select">
                                                    <option value="{{ session('result') }}">Select Result</option>
                                                    <option value="OK">OK</option>
                                                    <option value="NG">NG</option>
                                                    <option value="N/A">N/A</option>                                             
                                                </select>
                                            </div>
                                        @endif

                                        <!-- Remark DDP & CA -->
                                        @if(!is_null($detail['remark_ddca']) && $detail['remark_ddca'] !== '')
                                        {{-- @if(!is_null($detail['remark_ddca'])) --}}
                                            <div class="col-sm-2">
                                                @if($index === 0)
                                                    <label for="remark_ddca{{ $index + 1 }}" class="col-form-label">Remark DDP & CA</label>
                                                @endif
                                                <input type="text" class="form-control" id="remark_ddca{{ $index + 1 }}" name="remark_ddca[]" value="{{ old('remark_ddca.' . ($index), $detail['remark_ddca']) }}">
                                            </div>
                                        @endif

                                    </div>
                                @endif
                            @endforeach
                            <br/>

                            <h6>Check Material Specification Record</h6><br/>
                            @foreach(array_slice($detaildata->toArray(), 0, 7) as $index => $item)
                                @if(is_numeric($index))  <!-- Pastikan index adalah angka -->
                                    <div class="row">

                                        <div class="col-md-4 mb-4">
                                            <div class="form-row align-items-center">
                                                <div class="col-sm-4">
                                                    <label for="material_name{{ $index }}" class="col-form-label">Material Name</label>
                                                </div>
                                                <div class="col">
                                                    <input type="text" class="form-control" id="material_name{{ $index }}" placeholder="Enter Material Name" name="material_name[]" value="{{ old('material_name.' . $index, $item['material_name'] ?? '') }}">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4 mb-4">
                                            <div class="form-row align-items-center">
                                                <div class="col-sm-4">
                                                    <label for="test_result{{ $index }}" class="col-form-label">Test Result</label>
                                                </div>
                                                <div class="col">
                                                    <input type="text" class="form-control" id="test_result{{ $index }}" placeholder="Enter Test Result" name="test_result[]" value="{{ old('test_result.' . $index, $item['test_result'] ?? '') }}">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4 mb-4">
                                            <div class="form-row align-items-center">
                                                <div class="col-sm-4">
                                                    <label for="decision{{ $index }}" class="col-form-label">Decision</label>
                                                </div>
                                                <div class="col">
                                                    <input type="text" class="form-control" id="decision{{ $index }}" placeholder="Enter Decision" name="decision[]" value="{{ old('decision.' . $index, $item['decision'] ?? '') }}">
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                @endif
                            @endforeach
                            <button type="button" class="btn btn-primary" onclick="nextStep(1)">Next</button> 

                           
                        </div>
                        <!-- end step 1 -->


                         <!-- Step 2 -->
                        <div class="form-step" id="step2" style="display:none;">
                            <h6>Inspection Checking Results ( PIVOT PLATE)</h6>
                            @foreach(array_slice($detaildata->toArray(), 7, 5) as $index => $detail)
                                @if($detail['inspection_item'] !== null || 
                                    $detail['defect_grade'] !== null || 
                                    $detail['sample_no_pcs'] !== null || 
                                    $detail['time'] !== null || 
                                    $detail['result'] !== null || 
                                    $detail['remark_ddca'] !== null)

                                    <div class="row mb-3 d-flex align-items-center">

                                        @if(!is_null($detail['inspection_item']) && $detail['inspection_item'] !== '')
                                            <div class="col-sm-2">
                                                @if($index === 0)
                                                    <label for="inspection_item_select{{ $index + 8 }}" class="col-form-label">Inspection Item</label>
                                                @endif
                                                <input type="text" class="form-control" id="inspection_item_select{{ $index + 7 }}" 
                                                    name="inspection_item[]" 
                                                    value="{{ old('inspection_item.' . ($index), $detail['inspection_item'] == 21 ? 'N/A' : $detail['inspection_item']) }}">
                                            </div>
                                        @endif

                                        <!-- Defect Grade -->
                                        @if(!is_null($detail['defect_grade']))
                                            <div class="col-sm-2">
                                                @if($index === 0)
                                                    <label for="defectGrade_PivotPlate{{ $index + 8 }}" class="col-form-label">Defect Grade</label>
                                                @endif
                                                <input type="text" class="form-control" id="defectGrade_PivotPlate{{ $index + 8 }}" 
                                                    name="defect_grade[]" 
                                                    value="{{ old('defect_grade.' . ($index + 7), $detail['defect_grade'] == 21 ? 'N/A' : $detail['defect_grade']) }}">
                                            </div>
                                        @endif

                                        <!-- Sample No (PCS) -->
                                        @if(!is_null($detail['sample_no_pcs']))
                                            <div class="col-sm-2">
                                                @if($index === 0)
                                                    <label for="sampleNo_PivotPlate{{ $index + 8 }}" class="col-form-label">Sample No (PCS)</label>
                                                @endif
                                                <input type="text" class="form-control" id="sampleNo_PivotPlate{{ $index + 8 }}" 
                                                    name="sample_no_pcs[]" 
                                                    value="{{ old('sample_no_pcs.' . ($index + 7), $detail['sample_no_pcs'] == 21 ? 'N/A' : $detail['sample_no_pcs']) }}">
                                            </div>
                                        @endif

                                        <!-- Time -->
                                        @if(!is_null($detail['time']) && $detail['time'] !== '')
                                        {{-- @if(!is_null($detail['time']) && $detail['time'] !== 'NULL') --}}
                                            <div class="col-sm-2">
                                                @if($index === 0)
                                                    <label for="time_{{ $index + 8 }}" class="col-form-label">Time</label>
                                                @endif
                                                <select name="time[]" id="time_PivotPlate_select{{ $index + 8 }}" class="form-select">
                                                    <option value="">Select Time</option>
                                                    @foreach($time as $times)
                                                        <option value="{{ $times->id }}" {{ old('time.' . ($index + 7), $detail['time_id'] ?? '') == $times->id ? 'selected' : '' }}>
                                                            {{ $times->time }}
                                                        </option>
                                                    @endforeach
                                                </select> 
                                                {{-- <select name="time[]" id="time_waterprobe_select{{ $index + 8 }}" class="form-select">
                                                    <option value="">Select Time</option>
                                                    @foreach($time as $times)
                                                        <option value="{{ $times->id }}" 
                                                            {{ old('time.' . $index, $detail['time'] ?? '') == $times->id ? 'selected' : '' }}>
                                                            {{ $times->time }}
                                                        </option>
                                                    @endforeach
                                                </select> --}}
                                            </div>
                                        @endif

                                        <!-- Result -->
                                        @if(!is_null($detail['result']) && $detail['result'] !== '')
                                        {{-- @if(!is_null($detail['result'])) --}}
                                            <div class="col-sm-2">
                                                @if($index === 0)
                                                    <label for="result_PivotPlate{{ $index + 8 }}" class="col-form-label">Select Result</label>
                                                @endif
                                                {{-- <select name="result[]" id="result_WaterProbe{{ $index + 8 }}" class="form-select">
                                                    <option value="">Select Result</option>
                                                    <option value="OK" {{ old('result.' . ($index + 7), $detail['result']) == 'OK' ? 'selected' : '' }}>OK</option>
                                                    <option value="NG" {{ old('result.' . ($index + 7), $detail['result']) == 'NG' ? 'selected' : '' }}>NG</option>
                                                </select>  --}}
                                                <select name="result[]" id="result_PivotPlate" class="form-select">
                                                    <option value="{{ session('result') }}">Select Result</option>
                                                    <option value="OK">OK</option>
                                                    <option value="NG">NG</option>
                                                    <option value="N/A">N/A</option>                                             
                                                </select>
                                                
                                            </div>
                                        @endif

                                        <!-- Remark DDP & CA -->
                                        @if(!is_null($detail['remark_ddca']) && $detail['remark_ddca'] !== '')
                                        {{-- @if(!is_null($detail['remark_ddca'])) --}}
                                            <div class="col-sm-2">
                                                @if($index === 0)
                                                    <label for="remark_ddca{{ $index + 8 }}" class="col-form-label">Remark DDP & CA</label>
                                                @endif
                                                <input type="text" class="form-control" id="remark_ddca{{ $index + 7 }}" name="remark_ddca[]" value="{{ old('remark_ddca.' . ($index), $detail['remark_ddca']) }}">
                                            </div>
                                        @endif

                                    </div>
                                @endif
                            @endforeach
                            <br/>

                            <h6>Check Material Specification Record</h6><br/>
                            @foreach(array_slice($detaildata->toArray(), 7, 5) as $index => $item)
                                @if(is_numeric($index))  <!-- Pastikan index adalah angka -->
                                    <div class="row">

                                        <div class="col-md-4 mb-4">
                                            <div class="form-row align-items-center">
                                                <div class="col-sm-4">
                                                    <label for="material_name{{ $index }}" class="col-form-label">Material Name</label>
                                                </div>
                                                <div class="col">
                                                    <input type="text" class="form-control" id="material_name{{ $index }}" placeholder="Enter Material Name" name="material_name[]" value="{{ old('material_name.' . $index, $item['material_name'] ?? '') }}">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4 mb-4">
                                            <div class="form-row align-items-center">
                                                <div class="col-sm-4">
                                                    <label for="test_result{{ $index }}" class="col-form-label">Test Result</label>
                                                </div>
                                                <div class="col">
                                                    <input type="text" class="form-control" id="test_result{{ $index }}" placeholder="Enter Test Result" name="test_result[]" value="{{ old('test_result.' . $index, $item['test_result'] ?? '') }}">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4 mb-4">
                                            <div class="form-row align-items-center">
                                                <div class="col-sm-4">
                                                    <label for="decision{{ $index }}" class="col-form-label">Decision</label>
                                                </div>
                                                <div class="col">
                                                    <input type="text" class="form-control" id="decision{{ $index }}" placeholder="Enter Decision" name="decision[]" value="{{ old('decision.' . $index, $item['decision'] ?? '') }}">
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                @endif
                            @endforeach

                            <button type="button" class="btn btn-primary" id="prevBtn" onclick="previousStep(1)">Previous</button> 
                            {{-- <button type="button" class="btn btn-primary" id="nextBtn" onclick="nextPrev(2)">Next</button> --}}
                            <button type="button" class="btn btn-primary" onclick="nextStep(2)">Next</button> 
                        </div>

                        <!-- Step 3 -->
                        <div class="form-step" id="step3" style="display:none;">
                            <h6>Inspection Checking Results ( WATER PROBE)</h6>
                            @foreach(array_slice($detaildata->toArray(), 12, 2) as $index => $detail)
                                @if($detail['inspection_item'] !== null || 
                                    $detail['defect_grade'] !== null || 
                                    $detail['sample_no_pcs'] !== null || 
                                    $detail['time'] !== null || 
                                    $detail['result'] !== null || 
                                    $detail['remark_ddca'] !== null)

                                    <div class="row mb-3 d-flex align-items-center">

                                        @if(!is_null($detail['inspection_item']) && $detail['inspection_item'] !== '')
                                            <div class="col-sm-2">
                                                @if($index === 0)
                                                    <label for="inspection_item_select{{ $index + 13 }}" class="col-form-label">Inspection Item</label>
                                                @endif
                                                <input type="text" class="form-control" id="inspection_item_select{{ $index + 12 }}" 
                                                    name="inspection_item[]" value="{{ old('inspection_item.' . ($index), $detail['inspection_item']) }}">
                                            </div>
                                        @endif

                                        <!-- Defect Grade -->
                                        @if(!is_null($detail['defect_grade']) && $detail['defect_grade'] !== 'NULL')
                                            <div class="col-sm-2">
                                                @if($index === 0)
                                                    <label for="defect_grade_select{{ $index + 13 }}" class="col-form-label">Defect Grade</label>
                                                @endif
                                                <input type="text" class="form-control" id="defect_grade_select{{ $index + 12 }}" 
                                                    name="defect_grade[]" value="{{ old('defect_grade.' . ($index), $detail['defect_grade']) }}">
                                            </div>
                                        @endif

                                        <!-- Sample No (PCS) -->
                                        @if(!is_null($detail['sample_no_pcs']) && $detail['sample_no_pcs'] !== 'NULL')
                                            <div class="col-sm-2">
                                                @if($index === 0)
                                                    <label for="sample_no_pcs{{ $index + 13 }}" class="col-form-label">Sample No (PCS)</label>
                                                @endif
                                                <input type="text" class="form-control" id="sample_no_pcs{{ $index + 12 }}" 
                                                    name="sample_no_pcs[]" value="{{ old('sample_no_pcs.' . ($index), $detail['sample_no_pcs']) }}">
                                            </div>
                                        @endif

                                            <!-- Time -->
                                        @if(!is_null($detail['time']) && $detail['time'] !== 'NULL')
                                            <div class="col-sm-2">
                                                @if($index === 0)
                                                    <label for="time_{{ $index + 13 }}" class="col-form-label">Time</label>
                                                @endif
                                                <select name="time[]" id="time_waterprobe_select{{ $index + 13 }}" class="form-select">
                                                    <option value="">Select Time</option>
                                                    @foreach($time as $times)
                                                        <option value="{{ $times->id }}" {{ old('time.' . ($index + 12), $detail['time_id'] ?? '') == $times->id ? 'selected' : '' }}>
                                                            {{ $times->time }}
                                                        </option>
                                                    @endforeach
                                                </select> 
                                            </div>
                                        @endif

                                        <!-- Result -->
                                        @if(!is_null($detail['result']))
                                            <div class="col-sm-2">
                                                @if($index === 0)
                                                    <label for="result{{ $index + 13 }}" class="col-form-label">Result</label>
                                                @endif
                                                {{-- <select name="result[]" id="result_WaterProbe{{ $index + 13 }}" class="form-select">
                                                    <option value="">Select Result</option>
                                                    <option value="OK" {{ old('result.' . ($index + 12), $detail['result']) == 'OK' ? 'selected' : '' }}>OK</option>
                                                    <option value="NG" {{ old('result.' . ($index + 12), $detail['result']) == 'NG' ? 'selected' : '' }}>NG</option>
                                                </select>  --}}
                                                <select name="result[]" id="result_WaterProbe" class="form-select">
                                                    <option value="{{ session('result') }}">Select Result</option>
                                                    <option value="OK">OK</option>
                                                    <option value="NG">NG</option>
                                                    <option value="N/A">N/A</option>                                             
                                                </select>
                                            </div>
                                        @endif

                                        <!-- Remark DDP & CA -->
                                        @if(!is_null($detail['remark_ddca']))
                                            <div class="col-sm-2">
                                                @if($index === 0)
                                                    <label for="remark_ddca{{ $index + 13 }}" class="col-form-label">Remark DDP & CA</label>
                                                @endif
                                                <input type="text" class="form-control" id="remark_ddca{{ $index + 12 }}" name="remark_ddca[]" value="{{ old('remark_ddca.' . ($index), $detail['remark_ddca']) }}">
                                            </div>
                                        @endif

                                    </div>
                                @endif
                            @endforeach
                            <br/>

                            <h6>Check Material Specification Record</h6><br/>
                            @foreach(array_slice($detaildata->toArray(), 12, 2) as $index => $item)
                                @if(is_numeric($index))  <!-- Pastikan index adalah angka -->
                                    <div class="row">

                                        <div class="col-md-4 mb-4">
                                            <div class="form-row align-items-center">
                                                <div class="col-sm-4">
                                                    <label for="material_name{{ $index }}" class="col-form-label">Material Name</label>
                                                </div>
                                                <div class="col">
                                                    <input type="text" class="form-control" id="material_name{{ $index }}" placeholder="Enter Material Name" name="material_name[]" value="{{ old('material_name.' . $index, $item['material_name'] ?? '') }}">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4 mb-4">
                                            <div class="form-row align-items-center">
                                                <div class="col-sm-4">
                                                    <label for="test_result{{ $index }}" class="col-form-label">Test Result</label>
                                                </div>
                                                <div class="col">
                                                    <input type="text" class="form-control" id="test_result{{ $index }}" placeholder="Enter Test Result" name="test_result[]" value="{{ old('test_result.' . $index, $item['test_result'] ?? '') }}">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4 mb-4">
                                            <div class="form-row align-items-center">
                                                <div class="col-sm-4">
                                                    <label for="decision{{ $index }}" class="col-form-label">Decision</label>
                                                </div>
                                                <div class="col">
                                                    <input type="text" class="form-control" id="decision{{ $index }}" placeholder="Enter Decision" name="decision[]" value="{{ old('decision.' . $index, $item['decision'] ?? '') }}">
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                @endif
                            @endforeach



                            <button type="button" class="btn btn-primary" id="prevBtn" onclick="previousStep(2)">Previous</button> 
                            {{-- <button type="button" class="btn btn-primary" id="nextBtn" onclick="nextPrev(2)">Next</button> --}}
                            <button type="button" class="btn btn-primary" onclick="nextStep(3)">Next</button> 
                        </div>

                        <!-- Step 4 -->
                        <div class="form-step" id="step4" style="display:none;">
                            <h6>Inspection Checking Results (PM TRAY & SAFETY VALVE)</h6>
                            @foreach(array_slice($detaildata->toArray(), 14, 2) as $index => $detail)
                                @if($detail['inspection_item'] !== null || 
                                    $detail['defect_grade'] !== null || 
                                    $detail['sample_no_pcs'] !== null || 
                                    $detail['time'] !== null || 
                                    $detail['result'] !== null || 
                                    $detail['remark_ddca'] !== null)

                                    <div class="row mb-3 d-flex align-items-center">

                                        @if(!is_null($detail['inspection_item']) && $detail['inspection_item'] !== '21')
                                            <div class="col-sm-2">
                                                @if($index === 0)
                                                    <label for="inspection_item_select{{ $index + 15 }}" class="col-form-label">Inspection Item</label>
                                                @endif
                                                <input type="text" class="form-control" id="inspection_item_select{{ $index + 14 }}" 
                                                    name="inspection_item[]" value="{{ old('inspection_item.' . ($index), $detail['inspection_item']) }}">
                                            </div>
                                        @endif

                                        <!-- Defect Grade -->
                                        @if(!is_null($detail['defect_grade']) && $detail['defect_grade'] !== 'NULL')
                                            <div class="col-sm-2">
                                                @if($index === 0)
                                                    <label for="defect_grade_select{{ $index + 15 }}" class="col-form-label">Defect Grade</label>
                                                @endif
                                                <input type="text" class="form-control" id="defect_grade_select{{ $index + 14 }}" 
                                                    name="defect_grade[]" value="{{ old('defect_grade.' . ($index), $detail['defect_grade']) }}">
                                            </div>
                                        @endif

                                        <!-- Sample No (PCS) -->
                                        @if(!is_null($detail['sample_no_pcs']) && $detail['sample_no_pcs'] !== 'NULL')
                                            <div class="col-sm-2">
                                                @if($index === 0)
                                                    <label for="sample_no_pcs{{ $index + 15 }}" class="col-form-label">Sample No (PCS)</label>
                                                @endif
                                                <input type="text" class="form-control" id="sample_no_pcs{{ $index + 14 }}" 
                                                    name="sample_no_pcs[]" value="{{ old('sample_no_pcs.' . ($index), $detail['sample_no_pcs']) }}">
                                            </div>
                                        @endif

                                            <!-- Time -->
                                        @if(!is_null($detail['time']) && $detail['time'] !== 'NULL')
                                            <div class="col-sm-2">
                                                @if($index === 0)
                                                    <label for="time_{{ $index + 15 }}" class="col-form-label">Time</label>
                                                @endif
                                               <select name="time[]" id="time_waterprobe_select{{ $index + 15 }}" class="form-select">
                                                    <option value="">Select Time</option>
                                                    @foreach($time as $times)
                                                        <option value="{{ $times->id }}" {{ old('time.' . ($index + 14), $detail['time_id'] ?? '') == $times->id ? 'selected' : '' }}>
                                                            {{ $times->time }}
                                                        </option>
                                                    @endforeach
                                                </select> 
                                            </div>
                                        @endif

                                        <!-- Result -->
                                        @if(!is_null($detail['result']))
                                            <div class="col-sm-2">
                                                @if($index === 0)
                                                    <label for="result{{ $index + 15 }}" class="col-form-label">Result</label>
                                                @endif
                                                {{-- <select name="result[]" id="result_WaterProbe{{ $index + 15 }}" class="form-select">
                                                    <option value="">Select Result</option>
                                                    <option value="OK" {{ old('result.' . ($index + 14), $detail['result']) == 'OK' ? 'selected' : '' }}>OK</option>
                                                    <option value="NG" {{ old('result.' . ($index + 14), $detail['result']) == 'NG' ? 'selected' : '' }}>NG</option>
                                                </select>  --}}
                                                <select name="result[]" id="result_WaterProbe" class="form-select">
                                                    <option value="{{ session('result') }}">Select Result</option>
                                                    <option value="OK">OK</option>
                                                    <option value="NG">NG</option>
                                                    <option value="N/A">N/A</option>                                             
                                                </select>
                                            </div>
                                        @endif

                                        <!-- Remark DDP & CA -->
                                        @if(!is_null($detail['remark_ddca']))
                                            <div class="col-sm-2">
                                                @if($index === 0)
                                                    <label for="remark_ddca{{ $index + 15 }}" class="col-form-label">Remark DDP & CA</label>
                                                @endif
                                                <input type="text" class="form-control" id="remark_ddca{{ $index + 14 }}" name="remark_ddca[]" value="{{ old('remark_ddca.' . ($index), $detail['remark_ddca']) }}">
                                            </div>
                                        @endif

                                    </div>
                                @endif
                            @endforeach
                            <br/>

                            <h6>Check Material Specification Record</h6><br/>
                            @foreach(array_slice($detaildata->toArray(), 14, 2) as $index => $item)
                                @if(is_numeric($index))  <!-- Pastikan index adalah angka -->
                                    <div class="row">

                                        <div class="col-md-4 mb-4">
                                            <div class="form-row align-items-center">
                                                <div class="col-sm-4">
                                                    <label for="material_name{{ $index }}" class="col-form-label">Material Name</label>
                                                </div>
                                                <div class="col">
                                                    <input type="text" class="form-control" id="material_name{{ $index }}" placeholder="Enter Material Name" name="material_name[]" value="{{ old('material_name.' . $index, $item['material_name'] ?? '') }}">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4 mb-4">
                                            <div class="form-row align-items-center">
                                                <div class="col-sm-4">
                                                    <label for="test_result{{ $index }}" class="col-form-label">Test Result</label>
                                                </div>
                                                <div class="col">
                                                    <input type="text" class="form-control" id="test_result{{ $index }}" placeholder="Enter Test Result" name="test_result[]" value="{{ old('test_result.' . $index, $item['test_result'] ?? '') }}">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4 mb-4">
                                            <div class="form-row align-items-center">
                                                <div class="col-sm-4">
                                                    <label for="decision{{ $index }}" class="col-form-label">Decision</label>
                                                </div>
                                                <div class="col">
                                                    <input type="text" class="form-control" id="decision{{ $index }}" placeholder="Enter Decision" name="decision[]" value="{{ old('decision.' . $index, $item['decision'] ?? '') }}">
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                @endif
                            @endforeach



                            <input type="hidden" name="is_final_step" value="1">
                            <button type="button" class="btn btn-primary" id="prevBtn" onclick="previousStep(3)">Previous</button> 
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>


                            

                        
                    

                       

                    </form>



                </div>
            </div>
        </div>
    </div>
</div>

<script>
    let currentStep = 0; // Track the current step

    function showStep(step) {
        // Hide all steps
        const steps = document.getElementsByClassName("form-step");
        for (let i = 0; i < steps.length; i++) {
            steps[i].style.display = "none"; // Sembunyikan semua langkah
        }
        // Show the current step
        steps[step].style.display = "block"; // Tampilkan langkah saat ini
    }

    function nextStep() {
        // Validasi sederhana, misalnya, jika ada input yang harus diisi
        const modelInput = document.getElementById('model'); // Ganti 'model' dengan ID input yang tepat
        if (modelInput && modelInput.value === '') {
            alert('Model harus diisi!');
            return; // Hentikan eksekusi jika validasi gagal
        }

        // Update langkah saat ini
        const steps = document.getElementsByClassName("form-step");
        if (currentStep < steps.length - 1) {
            steps[currentStep].style.display = "none"; // Sembunyikan langkah saat ini
            currentStep++; // Tambah langkah
            showStep(currentStep); // Tampilkan langkah baru
        }
    }

    function previousStep() {
        const steps = document.getElementsByClassName("form-step");
        if (currentStep > 0) {
            steps[currentStep].style.display = "none"; // Sembunyikan langkah saat ini
            currentStep--; // Kurangi langkah
            showStep(currentStep); // Tampilkan langkah baru
        }
    }

    function nextPrev(n) {
        // Navigasi berdasarkan input
        const steps = document.getElementsByClassName("form-step");
        // Hide the current step
        steps[currentStep].style.display = "none"; // Sembunyikan langkah saat ini
        // Update the current step
        currentStep += n; // Perbarui langkah saat ini
        // If you reached the end of the steps, submit the form
        if (currentStep >= steps.length) {
            document.getElementById("myForm").submit(); // Ganti dengan ID form Anda
            return;
        }
        // Show the new current step
        showStep(currentStep);
    }

    // Show the first step
    showStep(currentStep);
</script>





@endsection