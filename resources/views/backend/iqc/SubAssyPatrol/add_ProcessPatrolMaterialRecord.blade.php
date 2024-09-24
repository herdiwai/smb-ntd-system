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

                        /* .hidden {
                            display: none;
                        } */

                    </style>

                    <form action="{{ route('add.ProcessPatrol') }}" method="POST">
                        @csrf
                        @if ($currentPage == 1)
                            <div id="page1">
                                <div class="row">
                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <div class="form-row align-items-center">
                                                <div class="col-sm-4">
                                                    <label for="model">Model</label>
                                                </div>
                                                <div class="col">
                                                    <select name="model" id="model" class="form-select">
                                                        <option value="">--Select Model--</option>
                                                        {{-- @foreach($model_products as $model)
                                                            <option value="{{ $model->id }}" {{ old('model') == $model->id ? 'selected' : '' }}>
                                                                {{ $model->model_products}}
                                                            </option>
                                                        @endforeach --}}
                                                    </select>
                                                </div>
                                            </div>
                                        </div>                                   
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <div class="form-group">
                                            <div class="form-row align-items-center">
                                                <div class="col-sm-5">
                                                    <label for="frequency" class="col-form-label">Frequency of Inspection</label>
                                                </div>
                                                <div class="col">
                                                    <input type="text" class="form-control" id="frequency" placeholder="" name="frequency" value="{{ old('frequency', session('formData.frequency', '')) }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <div class="form-group">
                                            <div class="form-row align-items-center">
                                                <div class="col-sm-3">
                                                    <label for="sampleSubmittedDate" class="col-form-label">Date</label>
                                                </div>
                                                <div class="col">
                                                    <input type="date" name="sampleSubmittedDate" id="sampleSubmittedDate" class="form-control" placeholder="Select date" value="{{ old('sampleSubmittedDate', session('formData.sampleSubmittedDate', '')) }}">
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
                                                    <label for="productName" class="col-form-label">Product Name</label>
                                                </div>
                                                <div class="col">
                                                    <input type="text" class="form-control" id="productName" placeholder="" name="productName" value="{{ old('productName', $formData['productName'] ?? '') }}">
                                                </div>
                                            </div>
                                        </div>                                   
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <div class="form-group">
                                            <div class="form-row align-items-center">
                                                <div class="col-sm-5">
                                                    <label for="inspectionStandard" class="col-form-label">Inspection Standard</label>
                                                </div>
                                                <div class="col">
                                                    <input type="text" class="form-control" id="inspectionStandard" placeholder="" name="inspectionStandard" value="{{ old('inspectionStandard', $formData['inspectionStandard'] ?? '') }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <div class="form-group">
                                            <div class="form-row align-items-center">
                                                <div class="col-sm-3">
                                                    <label for="inspectedBy" class="col-form-label">Inspected By</label>
                                                </div>
                                                <div class="col">
                                                    <input type="text" class="form-control" id="inspectedBy" placeholder="" name="inspectedBy" value="{{ old('inspectedBy', $formData['inspectedBy'] ?? '') }}">
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
                                                    <label for="productionUnit" class="col-form-label">Production Unit</label>
                                                </div>
                                                <div class="col">
                                                    <input type="text" class="form-control" id="productionUnit" placeholder="" name="productionUnit" value="{{ old('productionUnit', $formData['productionUnit'] ?? '') }}">
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
                                                    <input type="text" class="form-control" id="shift" placeholder="" name="shift" value="{{ old('shift', $formData['shift'] ?? '') }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <div class="form-group">
                                            <div class="form-row align-items-center">
                                                <div class="col-sm-3">
                                                    <label for="reviewBy" class="col-form-label">Reviewed By</label>
                                                </div>
                                                <div class="col">
                                                    <input type="text" class="form-control" id="reviewBy" placeholder="" name="reviewBy" value="{{ old('reviewBy', $formData['reviewBy'] ?? '') }}">
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
                                                    <input type="text" class="form-control" id="line" placeholder="" name="line" value="{{ old('line', $formData['line'] ?? '') }}">
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
                                                    <input type="text" class="form-control" id="lot" placeholder="" name="lot" value="{{ old('lot', $formData['lot'] ?? '') }}">
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
                                            <label for="inspectionItem" class="col-form-label">Inspection Item</label>
                                            <input type="text" class="form-control" id="inspectionItem" placeholder="" name="inspectionItem" value="{{ old('inspectionItem', $formData['inspectionItem'] ?? '') }}">
                                        </div>
                                    
                                        <div class="col-sm-2">
                                            <label for="defectGrade" class="col-form-label">Defect Grade</label>
                                            <input type="text" class="form-control" id="defectGrade" placeholder="" name="defectGrade" value="{{ old('defectGrade', $formData['defectGrade'] ?? '') }}">
                                        </div>
                                    
                                        <div class="col-sm-2">
                                            <label for="sampleNo" class="col-form-label">Sample No (PCS)</label>
                                            <input type="text" class="form-control" id="sampleNo" placeholder="" name="sampleNo" value="{{ old('sampleNo', $formData['sampleNo'] ?? '') }}">
                                        </div>
                                    
                                        <div class="col-sm-2">
                                            <label for="time" class="col-form-label">Time</label>
                                            <input type="text" class="form-control" id="time" placeholder="" name="time" value="{{ old('time', $formData['time'] ?? '') }}">
                                        </div>
                                    
                                        <div class="col-sm-2">
                                            <label for="result" class="col-form-label">Result</label>
                                            <input type="text" class="form-control" id="result" placeholder="" name="result" value="{{ old('result', $formData['result'] ?? '') }}">
                                        </div>
                                    
                                        <div class="col-sm-2">
                                            <label for="remark" class="col-form-label">Remark DDP & CA</label>
                                            <input type="text" class="form-control" id="remark" placeholder="" name="remark" value="{{ old('remark', $formData['remark'] ?? '') }}">
                                        </div>
                                    </div>
                                </div>
                                <br/>

                                <div class="row">
                                    <div class="row d-flex align-items-center">
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" id="inspectionItem1" placeholder="" name="inspectionItem1" value="{{ old('inspectionItem1', $formData['inspectionItem1'] ?? '') }}">
                                        </div>
                                    
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" id="defectGrade1" placeholder="" name="defectGrade1" value="{{ old('defectGrade1', $formData['defectGrade1'] ?? '') }}">
                                        </div>
                                    
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" id="sampleNo1" placeholder="" name="sampleNo1" value="{{ old('sampleNo1', $formData['sampleNo1'] ?? '') }}">
                                        </div>
                                    
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" id="time1 placeholder="" name="time1" value="{{ old('time1', $formData['time1'] ?? '') }}">
                                        </div>
                                    
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" id="result1" placeholder="" name="result1" value="{{ old('result1', $formData['result1'] ?? '') }}">
                                        </div>
                                    
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" id="remark1" placeholder="" name="remark1" value="{{ old('remark1', $formData['remark1'] ?? '') }}">
                                        </div>
                                    </div>
                                </div>
                                <br/>

                                <div class="row">
                                    <div class="row d-flex align-items-center">
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" id="inspectionItem2" placeholder="" name="inspectionItem2" value="{{ old('inspectionItem2', $formData['inspectionItem2'] ?? '') }}">
                                        </div>
                                    
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" id="defectGrade2" placeholder="" name="defectGrade2" value="{{ old('defectGrade2', $formData['defectGrade2'] ?? '') }}">
                                        </div>
                                    
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" id="sampleNo2" placeholder="" name="sampleNo2" value="{{ old('sampleNo2', $formData['sampleNo2'] ?? '') }}">
                                        </div>
                                    
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" id="time2" placeholder="" name="time2" value="{{ old('time2', $formData['time2'] ?? '') }}">
                                        </div>
                                    
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" id="result2" placeholder="" name="result2" value="{{ old('result2', $formData['result2'] ?? '') }}">
                                        </div>
                                    
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" id="remark2" placeholder="" name="remark2" value="{{ old('remark2', $formData['remark2'] ?? '') }}">
                                        </div>
                                    </div>
                                </div>
                                <br/>

                                <div class="row">
                                    <div class="row d-flex align-items-center">
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" id="inspectionItem3" placeholder="" name="inspectionItem3" value="{{ old('inspectionItem3', $formData['inspectionItem3'] ?? '') }}">
                                        </div>
                                    
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" id="defectGrade3" placeholder="" name="defectGrade3" value="{{ old('defectGrade3', $formData['defectGrade3'] ?? '') }}">
                                        </div>
                                    
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" id="sampleNo3" placeholder="" name="sampleNo3" value="{{ old('sampleNo3', $formData['sampleNo3'] ?? '') }}">
                                        </div>
                                    
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" id="time3" placeholder="" name="time3" value="{{ old('time3', $formData['time3'] ?? '') }}">
                                        </div>
                                    
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" id="result3" placeholder="" name="result3" value="{{ old('result3', $formData['result3'] ?? '') }}">
                                        </div>
                                    
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" id="remark3" placeholder="" name="remark3" value="{{ old('remark3', $formData['remark3'] ?? '') }}">
                                        </div>
                                    </div>
                                </div>
                                <br/>

                                <div class="row">
                                    <div class="row d-flex align-items-center">
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" id="inspectionItem4" placeholder="" name="inspectionItem4" value="{{ old('inspectionItem4', $formData['inspectionItem4'] ?? '') }}">
                                        </div>
                                    
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" id="defectGrade4" placeholder="" name="defectGrade4" value="{{ old('defectGrade4', $formData['defectGrade4'] ?? '') }}">
                                        </div>
                                    
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" id="sampleNo4" placeholder="" name="sampleNo4" value="{{ old('sampleNo4', $formData['sampleNo4'] ?? '') }}">
                                        </div>
                                    
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" id="time4" placeholder="" name="time4" value="{{ old('time4', $formData['time4'] ?? '') }}">
                                        </div>
                                    
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" id="result4" placeholder="" name="result4" value="{{ old('result4', $formData['result4'] ?? '') }}">
                                        </div>
                                    
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" id="remark4" placeholder="" name="remark4" value="{{ old('remark4', $formData['remark4'] ?? '') }}" >
                                        </div>
                                    </div>
                                </div>
                                <br/>

                                <div class="row">
                                    <div class="row d-flex align-items-center">
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" id="inspectionItem5" placeholder="" name="inspectionItem5" value="{{ old('inspectionItem5', $formData['inspectionItem5'] ?? '') }}">
                                        </div>
                                    
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" id="defectGrade5" placeholder="" name="defectGrade5" value="{{ old('defectGrade5', $formData['defectGrade5'] ?? '') }}">
                                        </div>
                                    
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" id="sampleNo5" placeholder="" name="sampleNo5" value="{{ old('sampleNo5', $formData['sampleNo5'] ?? '') }}">
                                        </div>
                                    
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" id="time5" placeholder="" name="time5" value="{{ old('time5', $formData['time5'] ?? '') }}">
                                        </div>
                                    
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" id="result5" placeholder="" name="result5" value="{{ old('result5', $formData['result5'] ?? '') }}">
                                        </div>
                                    
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" id="remark5" placeholder="" name="remark5" value="{{ old('remark5', $formData['remark5'] ?? '') }}">
                                        </div>
                                    </div>
                                </div>
                                <br/>

                                <div class="row">
                                    <div class="row d-flex align-items-center">
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" id="inspectionItem6" placeholder="" name="inspectionItem6" value="{{ old('inspectionItem6', $formData['inspectionItem6'] ?? '') }}">
                                        </div>
                                    
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" id="defectGrade6" placeholder="" name="defectGrade6" value="{{ old('defectGrade6', $formData['defectGrade6'] ?? '') }}">
                                        </div>
                                    
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" id="sampleNo6" placeholder="" name="sampleNo6" value="{{ old('sampleNo6', $formData['sampleNo6'] ?? '') }}">
                                        </div>
                                    
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" id="time6" placeholder="" name="time6" value="{{ old('time6', $formData['time6'] ?? '') }}">
                                        </div>
                                    
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" id="result6" placeholder="" name="result6" value="{{ old('result6', $formData['result6'] ?? '') }}">
                                        </div>
                                    
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" id="remark6" placeholder="" name="remark6" value="{{ old('remark6', $formData['remark6'] ?? '') }}">
                                        </div>
                                    </div>
                                </div><br/>
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
                                                <input type="text" class="form-control" id="material_name" placeholder="" name="material_name" value="{{ old('material_name', $formData['material_name'] ?? '') }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <div class="form-row align-items-center">
                                            <div class="col-sm-4">
                                                <label for="test_result" class="col-form-label">Test Result</label>
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" id="test_result" placeholder="" name="test_result" value="{{ old('test_result', $formData['test_result'] ?? '') }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <div class="form-row align-items-center">
                                            <div class="col-sm-4">
                                                <label for="decision" class="col-form-label">Decision</label>
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" id="decision" placeholder="" name="decision" value="{{ old('decision', $formData['decision'] ?? '') }}">
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
                                                <label class="col-form-label" style="visibility: hidden;">Material Name</label>
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" id="material_name_2" placeholder="" name="material_name_2" value="{{ old('material_name_2', $formData['material_name_2'] ?? '') }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <div class="form-row align-items-center">
                                            <div class="col-sm-4">
                                                <label class="col-form-label" style="visibility: hidden;">Test Result</label>
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" id="test_result_2" placeholder="" name="test_result_2" value="{{ old('test_result_2', $formData['test_result_2'] ?? '') }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <div class="form-row align-items-center">
                                            <div class="col-sm-4">
                                                <label class="col-form-label" style="visibility: hidden;">Decision</label>
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" id="decision_2" placeholder="" name="decision_2" value="{{ old('decision_2', $formData['decision_2'] ?? '') }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end row kedua -->

                                <div class="row">
                                    <div class="col-md-4 mb-4">
                                        <div class="form-row align-items-center">
                                            <div class="col-sm-4">
                                                <label class="col-form-label" style="visibility: hidden;">Material Name</label>
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" id="material_name_3" placeholder="" name="material_name_3" value="{{ old('material_name_3', $formData['material_name_3'] ?? '') }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <div class="form-row align-items-center">
                                            <div class="col-sm-4">
                                                <label class="col-form-label" style="visibility: hidden;">Test Result</label>
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" id="test_result_3" placeholder="" name="test_result_3" value="{{ old('test_result_3', $formData['test_result_3'] ?? '') }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <div class="form-row align-items-center">
                                            <div class="col-sm-4">
                                                <label class="col-form-label" style="visibility: hidden;">Decision</label>
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" id="decision_3" placeholder="" name="decision_3" value="{{ old('decision_3', $formData['decision_3'] ?? '') }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4 mb-4">
                                        <div class="form-row align-items-center">
                                            <div class="col-sm-4">
                                                <label class="col-form-label" style="visibility: hidden;">Material Name</label>
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" id="material_name_4" placeholder="" name="material_name_4" value="{{ old('material_name_4', $formData['material_name_4'] ?? '') }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <div class="form-row align-items-center">
                                            <div class="col-sm-4">
                                                <label class="col-form-label" style="visibility: hidden;">Test Result</label>
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" id="test_result_4" placeholder="" name="test_result_4" value="{{ old('test_result_4', $formData['test_result_4'] ?? '') }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <div class="form-row align-items-center">
                                            <div class="col-sm-4">
                                                <label class="col-form-label" style="visibility: hidden;">Decision</label>
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" id="decision_4" placeholder="" name="decision_4" value="{{ old('decision_4', $formData['decision_4'] ?? '') }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4 mb-4">
                                        <div class="form-row align-items-center">
                                            <div class="col-sm-4">
                                                <label class="col-form-label" style="visibility: hidden;">Material Name</label>
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" id="material_name_5" placeholder="" name="material_name_5" value="{{ old('material_name_5', $formData['material_name_5'] ?? '') }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <div class="form-row align-items-center">
                                            <div class="col-sm-4">
                                                <label class="col-form-label" style="visibility: hidden;">Test Result</label>
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" id="test_result_5" placeholder="" name="test_result_5" value="{{ old('test_result_5', $formData['test_result_5'] ?? '') }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <div class="form-row align-items-center">
                                            <div class="col-sm-4">
                                                <label class="col-form-label" style="visibility: hidden;">Decision</label>
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" id="decision_5" placeholder="" name="decision_5" value="{{ old('decision_5', $formData['decision_5'] ?? '') }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4 mb-4">
                                        <div class="form-row align-items-center">
                                            <div class="col-sm-4">
                                                <label class="col-form-label" style="visibility: hidden;">Material Name</label>
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" id="material_name_6" placeholder="" name="material_name_6" value="{{ old('material_name_6', $formData['material_name_6'] ?? '') }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <div class="form-row align-items-center">
                                            <div class="col-sm-4">
                                                <label class="col-form-label" style="visibility: hidden;">Test Result</label>
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" id="test_result_6" placeholder="" name="test_result_6" value="{{ old('test_result_6', $formData['test_result_6'] ?? '') }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <div class="form-row align-items-center">
                                            <div class="col-sm-4">
                                                <label class="col-form-label" style="visibility: hidden;">Decision</label>
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" id="decision_6" placeholder="" name="decision_6" value="{{ old('decision_6', $formData['decision_6'] ?? '') }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4 mb-4">
                                        <div class="form-row align-items-center">
                                            <div class="col-sm-4">
                                                <label class="col-form-label" style="visibility: hidden;">Material Name</label>
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" id="material_name_7" placeholder="" name="material_name_7" value="{{ old('material_name_7', $formData['material_name_7'] ?? '') }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <div class="form-row align-items-center">
                                            <div class="col-sm-4">
                                                <label class="col-form-label" style="visibility: hidden;">Test Result</label>
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" id="test_result_7" placeholder="" name="test_result_7" value="{{ old('test_result_7', $formData['test_result_7'] ?? '') }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <div class="form-row align-items-center">
                                            <div class="col-sm-4">
                                                <label class="col-form-label" style="visibility: hidden;">Decision</label>
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" id="decision_7" placeholder="" name="decision_7" value="{{ old('decision_7', $formData['decision_7'] ?? '') }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" formaction="{{ route('add.ProcessPatrol', ['page' => 2]) }}" class="btn btn-outline-primary">Next</button>
                            </div>
                        
                    @elseif ($currentPage == 2) 
                        <!-- pivot form -->
                            <div id="page2">
                                <h6>Inspection Checking Results ( PIVOT PLATE )</h6>
                                <div class="row">
                                    <div class="row d-flex align-items-center">
                                        <div class="col-sm-2">
                                            <label for="inspectionItem_PivotPlate" class="col-form-label">Inspection Item</label>
                                            <input type="text" class="form-control" id="inspectionItem_PivotPlate" name="inspectionItem_PivotPlate" value="{{ old('inspectionItem_PivotPlate', session('formData.inspectionItem_PivotPlate', '')) }}">
                                        </div>
                                        
                                        <div class="col-sm-2">
                                            <label for="defectGrade_PivotPlate" class="col-form-label">Defect Grade</label>
                                            <input type="text" class="form-control" id="defectGrade_PivotPlate" name="defectGrade_PivotPlate" value="{{ old('defectGrade_PivotPlate', session('formData.defectGrade_PivotPlate', '')) }}">
                                        </div>
                                        <div class="col-sm-2">
                                            <label for="sampleNo_PivotPlate" class="col-form-label">Sample No (PCS)</label>
                                            <input type="text" class="form-control" id="sampleNo_PivotPlate" name="sampleNo_PivotPlate" value="{{ old('sampleNo_PivotPlate', session('formData.sampleNo_PivotPlate', '')) }}">
                                        </div>
                                        
                                        <div class="col-sm-2">
                                            <label for="time_PivotPlate" class="col-form-label">Time</label>
                                            <input type="text" class="form-control" id="time_PivotPlate" name="time_PivotPlate" value="{{ old('time_PivotPlate', session('formData.time_PivotPlate', '')) }}">
                                        </div>
                                        <div class="col-sm-2">
                                            <label for="result_PivotPlate" class="col-form-label">Result</label>
                                            <input type="text" class="form-control" id="result_PivotPlate" name="result_PivotPlate" value="{{ old('result_PivotPlate', session('formData.result_PivotPlate', '')) }}">
                                        </div>
                                        
                                        <div class="col-sm-2">
                                            <label for="remark_PivotPlate" class="col-form-label">Remark DDP & CA</label>
                                            <input type="text" class="form-control" id="remark_PivotPlate" name="remark_PivotPlate" value="{{ old('remark_PivotPlate', session('formData.remark_PivotPlate', '')) }}">
                                        </div>
                                    </div>
                                </div>
                                    
                                <br/>

                                <div class="row">
                                    <div class="row d-flex align-items-center">
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" id="inspectionItem_PivotPlate1" placeholder="" name="inspectionItem_PivotPlate1">
                                        </div>
                                    
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" id="defectGrade_PivotPlate1" placeholder="" name="defectGrade_PivotPlate1">
                                        </div>
                                    
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" id="sampleNo_PivotPlate1" placeholder="" name="sampleNo_PivotPlate1">
                                        </div>
                                    
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" id="time_PivotPlate1" placeholder="" name="time_PivotPlate1">
                                        </div>
                                    
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" id="result_PivotPlate1" placeholder="" name="result_PivotPlate1">
                                        </div>
                                    
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" id="remark_PivotPlate1" placeholder="" name="remark_PivotPlate1">
                                        </div>
                                    </div>
                                </div>
                                <br/>

                                <div class="row">
                                    <div class="row d-flex align-items-center">
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" id="inspectionItem_PivotPlate2" placeholder="" name="inspectionItem_PivotPlate2">
                                        </div>
                                    
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" id="defectGrade_PivotPlate2" placeholder="" name="defectGrade_PivotPlate2">
                                        </div>
                                    
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" id="sampleNo_PivotPlate2" placeholder="" name="sampleNo_PivotPlate2">
                                        </div>
                                    
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" id="time_PivotPlate2" placeholder="" name="time_PivotPlate2">
                                        </div>
                                    
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" id="result_PivotPlate2" placeholder="" name="result_PivotPlate2">
                                        </div>
                                    
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" id="remark_PivotPlate2" placeholder="" name="remark_PivotPlate2">
                                        </div>
                                    </div>
                                </div>
                                <br/>

                                <div class="row">
                                    <div class="row d-flex align-items-center">
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" id="inspectionItem_PivotPlate3" placeholder="" name="inspectionItem_PivotPlate3">
                                        </div>
                                    
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" id="defectGrade_PivotPlate3" placeholder="" name="defectGrade_PivotPlate3">
                                        </div>
                                    
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" id="sampleNo_PivotPlate3" placeholder="" name="sampleNo_PivotPlate3">
                                        </div>
                                    
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" id="time_PivotPlate3" placeholder="" name="time_PivotPlate3">
                                        </div>
                                    
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" id="result_PivotPlate3" placeholder="" name="result_PivotPlate3">
                                        </div>
                                    
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" id="remark_PivotPlate3" placeholder="" name="remark_PivotPlate3">
                                        </div>
                                    </div>
                                </div>
                                <br/>

                                <div class="row">
                                    <div class="row d-flex align-items-center">
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" id="inspectionItem_PivotPlate4" placeholder="" name="inspectionItem_PivotPlate4">
                                        </div>
                                    
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" id="defectGrade_PivotPlate4" placeholder="" name="defectGrade_PivotPlate4">
                                        </div>
                                    
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" id="sampleNo_PivotPlate4" placeholder="" name="sampleNo_PivotPlate4">
                                        </div>
                                    
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" id="time_PivotPlate4" placeholder="" name="time_PivotPlate4">
                                        </div>
                                    
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" id="result_PivotPlate4" placeholder="" name="result_PivotPlate4">
                                        </div>
                                    
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" id="remark_PivotPlate4" placeholder="" name="remark_PivotPlate4">
                                        </div>
                                    </div>
                                </div>
                                <br/>

                                <div class="row">
                                    <div class="row d-flex align-items-center">
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" id="inspectionItem_PivotPlate5" placeholder="" name="inspectionItem_PivotPlate5">
                                        </div>
                                    
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" id="defectGrade_PivotPlate5" placeholder="" name="defectGrade_PivotPlate5">
                                        </div>
                                    
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" id="sampleNo_PivotPlate5" placeholder="" name="sampleNo_PivotPlate5">
                                        </div>
                                    
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" id="time_PivotPlate5" placeholder="" name="time_PivotPlate5">
                                        </div>
                                    
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" id="result_PivotPlate5" placeholder="" name="result_PivotPlate5">
                                        </div>
                                    
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" id="remark_PivotPlate5" placeholder="" name="remark_PivotPlate5">
                                        </div>
                                    </div>
                                </div>
                                <br/>
                                <div class="row">
                                    <div class="row d-flex align-items-center">
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" id="inspectionItem_PivotPlate6" placeholder="" name="inspectionItem_PivotPlate6">
                                        </div>
                                    
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" id="defectGrade_PivotPlate6" placeholder="" name="defectGrade_PivotPlate6">
                                        </div>
                                    
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" id="sampleNo_PivotPlate6" placeholder="" name="sampleNo_PivotPlate6">
                                        </div>
                                    
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" id="time_PivotPlate6" placeholder="" name="time_PivotPlate6">
                                        </div>
                                    
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" id="result_PivotPlate6" placeholder="" name="result_PivotPlate6">
                                        </div>
                                    
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" id="remark_PivotPlate6" placeholder="" name="remark_PivotPlate6">
                                        </div>
                                    </div>
                                </div><br/>
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
                                                <input type="text" class="form-control" id="material_name" placeholder="" name="material_name">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <div class="form-row align-items-center">
                                            <div class="col-sm-4">
                                                <label for="test_result" class="col-form-label">Test Result</label>
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" id="test_result" placeholder="" name="test_result">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <div class="form-row align-items-center">
                                            <div class="col-sm-4">
                                                <label for="decision" class="col-form-label">Decision</label>
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" id="decision" placeholder="" name="decision">
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
                                                <label class="col-form-label" style="visibility: hidden;">Material Name</label>
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" id="material_name_2" placeholder="" name="material_name_2">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <div class="form-row align-items-center">
                                            <div class="col-sm-4">
                                                <label class="col-form-label" style="visibility: hidden;">Test Result</label>
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" id="test_result_2" placeholder="" name="test_result_2">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <div class="form-row align-items-center">
                                            <div class="col-sm-4">
                                                <label class="col-form-label" style="visibility: hidden;">Decision</label>
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" id="decision_2" placeholder="" name="decision_2">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end row kedua -->

                                <!-- row kedua -->
                                <div class="row">
                                    <div class="col-md-4 mb-4">
                                        <div class="form-row align-items-center">
                                            <div class="col-sm-4">
                                                <label class="col-form-label" style="visibility: hidden;">Material Name</label>
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" id="material_name_2" placeholder="" name="material_name_2">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <div class="form-row align-items-center">
                                            <div class="col-sm-4">
                                                <label class="col-form-label" style="visibility: hidden;">Test Result</label>
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" id="test_result_2" placeholder="" name="test_result_2">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <div class="form-row align-items-center">
                                            <div class="col-sm-4">
                                                <label class="col-form-label" style="visibility: hidden;">Decision</label>
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" id="decision_2" placeholder="" name="decision_2">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end row kedua -->

                                <!-- row kedua -->
                                <div class="row">
                                    <div class="col-md-4 mb-4">
                                        <div class="form-row align-items-center">
                                            <div class="col-sm-4">
                                                <label class="col-form-label" style="visibility: hidden;">Material Name</label>
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" id="material_name_2" placeholder="" name="material_name_2">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <div class="form-row align-items-center">
                                            <div class="col-sm-4">
                                                <label class="col-form-label" style="visibility: hidden;">Test Result</label>
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" id="test_result_2" placeholder="" name="test_result_2">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <div class="form-row align-items-center">
                                            <div class="col-sm-4">
                                                <label class="col-form-label" style="visibility: hidden;">Decision</label>
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" id="decision_2" placeholder="" name="decision_2">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end row kedua -->

                                <!-- row kedua -->
                                <div class="row">
                                    <div class="col-md-4 mb-4">
                                        <div class="form-row align-items-center">
                                            <div class="col-sm-4">
                                                <label class="col-form-label" style="visibility: hidden;">Material Name</label>
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" id="material_name_2" placeholder="" name="material_name_2">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <div class="form-row align-items-center">
                                            <div class="col-sm-4">
                                                <label class="col-form-label" style="visibility: hidden;">Test Result</label>
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" id="test_result_2" placeholder="" name="test_result_2">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <div class="form-row align-items-center">
                                            <div class="col-sm-4">
                                                <label class="col-form-label" style="visibility: hidden;">Decision</label>
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" id="decision_2" placeholder="" name="decision_2">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end row kedua -->

                                <!-- row kedua -->
                                <div class="row">
                                    <div class="col-md-4 mb-4">
                                        <div class="form-row align-items-center">
                                            <div class="col-sm-4">
                                                <label class="col-form-label" style="visibility: hidden;">Material Name</label>
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" id="material_name_2" placeholder="" name="material_name_2">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <div class="form-row align-items-center">
                                            <div class="col-sm-4">
                                                <label class="col-form-label" style="visibility: hidden;">Test Result</label>
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" id="test_result_2" placeholder="" name="test_result_2">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <div class="form-row align-items-center">
                                            <div class="col-sm-4">
                                                <label class="col-form-label" style="visibility: hidden;">Decision</label>
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" id="decision_2" placeholder="" name="decision_2">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end row kedua -->

                                <!-- row kedua -->
                                <div class="row">
                                    <div class="col-md-4 mb-4">
                                        <div class="form-row align-items-center">
                                            <div class="col-sm-4">
                                                <label class="col-form-label" style="visibility: hidden;">Material Name</label>
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" id="material_name_2" placeholder="" name="material_name_2">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <div class="form-row align-items-center">
                                            <div class="col-sm-4">
                                                <label class="col-form-label" style="visibility: hidden;">Test Result</label>
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" id="test_result_2" placeholder="" name="test_result_2">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <div class="form-row align-items-center">
                                            <div class="col-sm-4">
                                                <label class="col-form-label" style="visibility: hidden;">Decision</label>
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" id="decision_2" placeholder="" name="decision_2">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end row kedua -->
                                <button type="submit" formaction="{{ route('add.ProcessPatrol', ['page' => 1]) }}" class="btn btn-outline-primary" >Previous</button>
                                <button type="submit" formaction="{{ route('add.ProcessPatrol', ['page' => 3]) }}" class="btn btn-outline-primary">Next</button>
                            </div>

                            @elseif ($currentPage == 3) 
                            <!-- water probe -->
                            <div id="page3">
                                <h6>Inspection Checking Results ( WATER PROBE )</h6>
                                <br/>
                                <div class="row">
                                    <div class="row d-flex align-items-center">
                                        <div class="col-sm-2">
                                            <label for="inspectionItem_WaterProbe" class="col-form-label">Inspection Item</label>
                                            <input type="text" class="form-control" id="inspectionItem_WaterProbe" name="inspectionItem_WaterProbe" value="{{ old('inspectionItem_WaterProbe', session('formData.inspectionItem_WaterProbe', '')) }}">
                                        </div>
                                        
                                        <div class="col-sm-2">
                                            <label for="defectGrade_WaterProbe" class="col-form-label">Defect Grade</label>
                                            <input type="text" class="form-control" id="defectGrade_WaterProbe" name="defectGrade_WaterProbe" value="{{ old('defectGrade_WaterProbe', session('formData.defectGrade_WaterProbe', '')) }}">
                                        </div>
                                        <div class="col-sm-2">
                                            <label for="sampleNo_WaterProbe" class="col-form-label">Sample No (PCS)</label>
                                            <input type="text" class="form-control" id="sampleNo_WaterProbe" name="sampleNo_WaterProbe" value="{{ old('sampleNo_WaterProbe', session('formData.sampleNo_WaterProbe', '')) }}">
                                        </div>
                                        
                                        <div class="col-sm-2">
                                            <label for="time_WaterProbe" class="col-form-label">Time</label>
                                            <input type="text" class="form-control" id="time_WaterProbe" name="time_WaterProbe" value="{{ old('time_WaterProbe', session('formData.time_WaterProbe', '')) }}">
                                        </div>
                                        <div class="col-sm-2">
                                            <label for="result_WaterProbe" class="col-form-label">Result</label>
                                            <input type="text" class="form-control" id="result_WaterProbe" name="result_WaterProbe" value="{{ old('result_WaterProbe', session('formData.result_WaterProbe', '')) }}">
                                        </div>
                                        
                                        <div class="col-sm-2">
                                            <label for="remark_WaterProbe" class="col-form-label">Remark DDP & CA</label>
                                            <input type="text" class="form-control" id="remark_WaterProbe" name="remark_WaterProbe" value="{{ old('remark_WaterProbe', session('formData.remark_WaterProbe', '')) }}">
                                        </div>
                                    </div>
                                </div>
                                   
                                <br/>
                                <div class="row">
                                    <div class="row d-flex align-items-center">
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" id="inspectionItem_WaterProbe2" placeholder="" name="inspectionItem_WaterProbe2">
                                        </div>
                                    
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" id="defectGrade_WaterProbe2" placeholder="" name="defectGrade_WaterProbe2">
                                        </div>
                                    
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" id="sampleNo_WaterProbe2" placeholder="" name="sampleNo_WaterProbe2">
                                        </div>
                                    
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" id="time_WaterProbe2" placeholder="" name="time_WaterProbe2">
                                        </div>
                                    
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" id="result_WaterProbe2" placeholder="" name="result_WaterProbe2">
                                        </div>
                                    
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" id="remark_WaterProbe2" placeholder="" name="remark_WaterProbe2">
                                        </div>
                                    </div>
                                </div>

                                <br/>
                                <div class="row">
                                    <div class="row d-flex align-items-center">
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" id="inspectionItem_WaterProbe3" placeholder="" name="inspectionItem_WaterProbe3">
                                        </div>
                                    
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" id="defectGrade_WaterProbe3" placeholder="" name="defectGrade_WaterProbe3">
                                        </div>
                                    
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" id="sampleNo_WaterProbe3" placeholder="" name="sampleNo_WaterProbe3">
                                        </div>
                                    
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" id="time_WaterProbe3" placeholder="" name="time_WaterProbe3">
                                        </div>
                                    
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" id="result_WaterProbe3" placeholder="" name="result_WaterProbe3">
                                        </div>
                                    
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" id="remark_WaterProbe3" placeholder="" name="remark_WaterProbe3">
                                        </div>
                                    </div>
                                </div>

                                <br/>
                                <div class="row">
                                    <div class="row d-flex align-items-center">
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" id="inspectionItem_WaterProbe4" placeholder="" name="inspectionItem_WaterProbe4">
                                        </div>
                                    
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" id="defectGrade_WaterProbe4" placeholder="" name="defectGrade_WaterProbe4">
                                        </div>
                                    
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" id="sampleNo_WaterProbe4" placeholder="" name="sampleNo_WaterProbe4">
                                        </div>
                                    
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" id="time_WaterProbe4" placeholder="" name="time_WaterProbe4">
                                        </div>
                                    
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" id="result_WaterProbe4" placeholder="" name="result_WaterProbe4">
                                        </div>
                                    
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" id="remark_WaterProbe4" placeholder="" name="remark_WaterProbe4">
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
                                                <label for="material_name" class="col-form-label">Material Name</label>
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" id="material_name_WaterProbe1" placeholder="" name="material_name_WaterProbe1">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <div class="form-row align-items-center">
                                            <div class="col-sm-4">
                                                <label for="test_result_WaterProbe1" class="col-form-label">Test Result</label>
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" id="test_result_WaterProbe1" placeholder="" name="test_result_WaterProbe1">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <div class="form-row align-items-center">
                                            <div class="col-sm-4">
                                                <label for="decision_WaterProbe2" class="col-form-label">Decision</label>
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" id="decision_WaterProbe2" placeholder="" name="decision_WaterProbe2">
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
                                                <label class="col-form-label" style="visibility: hidden;">Material Name</label>
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" id="material_name_WaterProbe2" placeholder="" name="material_name_WaterProbe2">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <div class="form-row align-items-center">
                                            <div class="col-sm-4">
                                                <label class="col-form-label" style="visibility: hidden;">Test Result</label>
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" id="test_result_WaterProbe2" placeholder="" name="test_result_WaterProbe2">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <div class="form-row align-items-center">
                                            <div class="col-sm-4">
                                                <label class="col-form-label" style="visibility: hidden;">Decision</label>
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" id="decision_WaterProbe2" placeholder="" name="decision_WaterProbe2">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end row kedua -->

                                <!-- row kedua -->
                                <div class="row">
                                    <div class="col-md-4 mb-4">
                                        <div class="form-row align-items-center">
                                            <div class="col-sm-4">
                                                <label class="col-form-label" style="visibility: hidden;">Material Name</label>
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" id="material_name_WaterProbe3" placeholder="" name="material_name_WaterProbe3">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <div class="form-row align-items-center">
                                            <div class="col-sm-4">
                                                <label class="col-form-label" style="visibility: hidden;">Test Result</label>
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" id="test_result_WaterProbe3"" placeholder="" name="test_result_WaterProbe3"">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <div class="form-row align-items-center">
                                            <div class="col-sm-4">
                                                <label class="col-form-label" style="visibility: hidden;">Decision</label>
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" id="decision_WaterProbe3"" placeholder="" name="decisio_WaterProbe3">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end row kedua -->

                                <!-- row kedua -->
                                <div class="row">
                                    <div class="col-md-4 mb-4">
                                        <div class="form-row align-items-center">
                                            <div class="col-sm-4">
                                                <label class="col-form-label" style="visibility: hidden;">Material Name</label>
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" id="material_name_WaterProbe4" placeholder="" name="material_name_WaterProbe4">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <div class="form-row align-items-center">
                                            <div class="col-sm-4">
                                                <label class="col-form-label" style="visibility: hidden;">Test Result</label>
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" id="test_result_WaterProbe4" placeholder="" name="test_result_WaterProbe4">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <div class="form-row align-items-center">
                                            <div class="col-sm-4">
                                                <label class="col-form-label" style="visibility: hidden;">Decision</label>
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" id="decision_WaterProbe4" placeholder="" name="decision_WaterProbe4">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end row kedua -->
                                <button type="submit" formaction="{{ route('add.ProcessPatrol', ['page' => 2]) }}" class="btn btn-outline-primary">Previous</button>
                                <button type="submit" formaction="{{ route('add.ProcessPatrol', ['page' => 4]) }}" class="btn btn-outline-primary">Next</button>
                            </div>

                            @elseif ($currentPage == 4) 
                            <!-- water probe -->
                            <div id="page3">
                                <h6>Inspection Checking Results ( PM TRAY )</h6>
                                <br/>
                               <div class="row">
                                    <div class="row d-flex align-items-center">
                                        <div class="col-sm-2">
                                            <label for="inspectionItem_WaterProbe" class="col-form-label">Inspection Item</label>
                                            <input type="text" class="form-control" id="inspectionItem_WaterProbe" name="inspectionItem_WaterProbe" value="{{ old('inspectionItem_WaterProbe', session('formData.inspectionItem_WaterProbe', '')) }}">
                                        </div>
                                        
                                        <div class="col-sm-2">
                                            <label for="defectGrade_WaterProbe" class="col-form-label">Defect Grade</label>
                                            <input type="text" class="form-control" id="defectGrade_WaterProbe" name="defectGrade_WaterProbe" value="{{ old('defectGrade_WaterProbe', session('formData.defectGrade_WaterProbe', '')) }}">
                                        </div>
                                        <div class="col-sm-2">
                                            <label for="sampleNo_WaterProbe" class="col-form-label">Sample No (PCS)</label>
                                            <input type="text" class="form-control" id="sampleNo_WaterProbe" name="sampleNo_WaterProbe" value="{{ old('sampleNo_WaterProbe', session('formData.sampleNo_WaterProbe', '')) }}">
                                        </div>
                                        
                                        <div class="col-sm-2">
                                            <label for="time_WaterProbe" class="col-form-label">Time</label>
                                            <input type="text" class="form-control" id="time_WaterProbe" name="time_WaterProbe" value="{{ old('time_WaterProbe', session('formData.time_WaterProbe', '')) }}">
                                        </div>
                                        <div class="col-sm-2">
                                            <label for="result_WaterProbe" class="col-form-label">Result</label>
                                            <input type="text" class="form-control" id="result_WaterProbe" name="result_WaterProbe" value="{{ old('result_WaterProbe', session('formData.result_WaterProbe', '')) }}">
                                        </div>
                                        
                                        <div class="col-sm-2">
                                            <label for="remark_WaterProbe" class="col-form-label">Remark DDP & CA</label>
                                            <input type="text" class="form-control" id="remark_WaterProbe" name="remark_WaterProbe" value="{{ old('remark_WaterProbe', session('formData.remark_WaterProbe', '')) }}">
                                        </div>
                                    </div>
                                </div>
                                    
                                <br/>
                                <div class="row">
                                    <div class="row d-flex align-items-center">
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" id="inspectionItem_WaterProbe5" placeholder="" name="inspectionItem_WaterProbe5">
                                        </div>
                                    
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" id="defectGrade_WaterProbe5" placeholder="" name="defectGrade_WaterProbe5">
                                        </div>
                                    
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" id="sampleNo_WaterProbe5" placeholder="" name="sampleNo_WaterProbe5">
                                        </div>
                                    
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" id="time_WaterProbe5" placeholder="" name="time_WaterProbe5">
                                        </div>
                                    
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" id="result_WaterProbe5" placeholder="" name="result_WaterProbe5">
                                        </div>
                                    
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" id="remark_WaterProbe5" placeholder="" name="remark_WaterProbe5">
                                        </div>
                                    </div>
                                </div>

                                <br/>
                                <div class="row">
                                    <div class="row d-flex align-items-center">
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" id="inspectionItem_WaterProbe5" placeholder="" name="inspectionItem_WaterProbe5">
                                        </div>
                                    
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" id="defectGrade_WaterProbe5" placeholder="" name="defectGrade_WaterProbe5">
                                        </div>
                                    
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" id="sampleNo_WaterProbe5" placeholder="" name="sampleNo_WaterProbe5">
                                        </div>
                                    
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" id="time_WaterProbe5" placeholder="" name="time_WaterProbe5">
                                        </div>
                                    
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" id="result_WaterProbe5" placeholder="" name="result_WaterProbe5">
                                        </div>
                                    
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" id="remark_WaterProbe5" placeholder="" name="remark_WaterProbe5">
                                        </div>
                                    </div>
                                </div>

                                <br/>
                                <div class="row">
                                    <div class="row d-flex align-items-center">
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" id="inspectionItem_WaterProbe5" placeholder="" name="inspectionItem_WaterProbe5">
                                        </div>
                                    
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" id="defectGrade_WaterProbe5" placeholder="" name="defectGrade_WaterProbe5">
                                        </div>
                                    
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" id="sampleNo_WaterProbe5" placeholder="" name="sampleNo_WaterProbe5">
                                        </div>
                                    
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" id="time_WaterProbe5" placeholder="" name="time_WaterProbe5">
                                        </div>
                                    
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" id="result_WaterProbe5" placeholder="" name="result_WaterProbe5">
                                        </div>
                                    
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" id="remark_WaterProbe5" placeholder="" name="remark_WaterProbe5">
                                        </div>
                                    </div>
                                </div>

                                <br/>
                                <div class="row">
                                    <div class="row d-flex align-items-center">
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" id="inspectionItem_WaterProbe5" placeholder="" name="inspectionItem_WaterProbe5">
                                        </div>
                                    
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" id="defectGrade_WaterProbe5" placeholder="" name="defectGrade_WaterProbe5">
                                        </div>
                                    
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" id="sampleNo_WaterProbe5" placeholder="" name="sampleNo_WaterProbe5">
                                        </div>
                                    
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" id="time_WaterProbe5" placeholder="" name="time_WaterProbe5">
                                        </div>
                                    
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" id="result_WaterProbe5" placeholder="" name="result_WaterProbe5">
                                        </div>
                                    
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" id="remark_WaterProbe5" placeholder="" name="remark_WaterProbe5">
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
                                                <label for="material_name" class="col-form-label">Material Name</label>
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" id="material_name" placeholder="" name="material_name">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <div class="form-row align-items-center">
                                            <div class="col-sm-4">
                                                <label for="test_result" class="col-form-label">Test Result</label>
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" id="test_result" placeholder="" name="test_result">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <div class="form-row align-items-center">
                                            <div class="col-sm-4">
                                                <label for="decision" class="col-form-label">Decision</label>
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" id="decision" placeholder="" name="decision">
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
                                                <label class="col-form-label" style="visibility: hidden;">Material Name</label>
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" id="material_name_2" placeholder="" name="material_name_2">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <div class="form-row align-items-center">
                                            <div class="col-sm-4">
                                                <label class="col-form-label" style="visibility: hidden;">Test Result</label>
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" id="test_result_2" placeholder="" name="test_result_2">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <div class="form-row align-items-center">
                                            <div class="col-sm-4">
                                                <label class="col-form-label" style="visibility: hidden;">Decision</label>
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" id="decision_2" placeholder="" name="decision_2">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end row kedua -->

                                <!-- row kedua -->
                                <div class="row">
                                    <div class="col-md-4 mb-4">
                                        <div class="form-row align-items-center">
                                            <div class="col-sm-4">
                                                <label class="col-form-label" style="visibility: hidden;">Material Name</label>
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" id="material_name_2" placeholder="" name="material_name_2">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <div class="form-row align-items-center">
                                            <div class="col-sm-4">
                                                <label class="col-form-label" style="visibility: hidden;">Test Result</label>
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" id="test_result_2" placeholder="" name="test_result_2">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <div class="form-row align-items-center">
                                            <div class="col-sm-4">
                                                <label class="col-form-label" style="visibility: hidden;">Decision</label>
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" id="decision_2" placeholder="" name="decision_2">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end row kedua -->

                                <!-- row kedua -->
                                <div class="row">
                                    <div class="col-md-4 mb-4">
                                        <div class="form-row align-items-center">
                                            <div class="col-sm-4">
                                                <label class="col-form-label" style="visibility: hidden;">Material Name</label>
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" id="material_name_2" placeholder="" name="material_name_2">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <div class="form-row align-items-center">
                                            <div class="col-sm-4">
                                                <label class="col-form-label" style="visibility: hidden;">Test Result</label>
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" id="test_result_2" placeholder="" name="test_result_2">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <div class="form-row align-items-center">
                                            <div class="col-sm-4">
                                                <label class="col-form-label" style="visibility: hidden;">Decision</label>
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" id="decision_2" placeholder="" name="decision_2">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end row kedua -->

                                <div class="row">
                                    <div class="col-md-4 mb-4">
                                        <div class="form-row align-items-center">
                                            <div class="col-sm-4">
                                                <label class="col-form-label" style="visibility: hidden;">Material Name</label>
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" id="material_name_2" placeholder="" name="material_name_2">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <div class="form-row align-items-center">
                                            <div class="col-sm-4">
                                                <label class="col-form-label" style="visibility: hidden;">Test Result</label>
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" id="test_result_2" placeholder="" name="test_result_2">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <div class="form-row align-items-center">
                                            <div class="col-sm-4">
                                                <label class="col-form-label" style="visibility: hidden;">Decision</label>
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" id="decision_2" placeholder="" name="decision_2">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" formaction="{{ route('add.ProcessPatrol', ['page' => 3]) }}" class="btn btn-outline-primary">Previous</button>
                                <button type="submit" formaction="{{ route('add.ProcessPatrol', ['page' => 5]) }}" class="btn btn-outline-primary">Next</button>
                            </div>
                                    
                            
                            @elseif ($currentPage == 5) 
                            <!-- water probe -->
                            <div id="page3">
                                <h6>Inspection Checking Results ( SAFETY VALVE )</h6>
                                <br/>
                                <div class="row">
                                    <div class="row d-flex align-items-center">
                                        <div class="col-sm-2">
                                            <label for="inspectionItem_WaterProbe" class="col-form-label">Inspection Item</label>
                                            <input type="text" class="form-control" id="inspectionItem_WaterProbe" name="inspectionItem_WaterProbe" value="{{ old('inspectionItem_WaterProbe', session('formData.inspectionItem_WaterProbe', '')) }}">
                                        </div>
                                        
                                        <div class="col-sm-2">
                                            <label for="defectGrade_WaterProbe" class="col-form-label">Defect Grade</label>
                                            <input type="text" class="form-control" id="defectGrade_WaterProbe" name="defectGrade_WaterProbe" value="{{ old('defectGrade_WaterProbe', session('formData.defectGrade_WaterProbe', '')) }}">
                                        </div>
                                        <div class="col-sm-2">
                                            <label for="sampleNo_WaterProbe" class="col-form-label">Sample No (PCS)</label>
                                            <input type="text" class="form-control" id="sampleNo_WaterProbe" name="sampleNo_WaterProbe" value="{{ old('sampleNo_WaterProbe', session('formData.sampleNo_WaterProbe', '')) }}">
                                        </div>
                                        
                                        <div class="col-sm-2">
                                            <label for="time_WaterProbe" class="col-form-label">Time</label>
                                            <input type="text" class="form-control" id="time_WaterProbe" name="time_WaterProbe" value="{{ old('time_WaterProbe', session('formData.time_WaterProbe', '')) }}">
                                        </div>
                                        <div class="col-sm-2">
                                            <label for="result_WaterProbe" class="col-form-label">Result</label>
                                            <input type="text" class="form-control" id="result_WaterProbe" name="result_WaterProbe" value="{{ old('result_WaterProbe', session('formData.result_WaterProbe', '')) }}">
                                        </div>
                                        
                                        <div class="col-sm-2">
                                            <label for="remark_WaterProbe" class="col-form-label">Remark DDP & CA</label>
                                            <input type="text" class="form-control" id="remark_WaterProbe" name="remark_WaterProbe" value="{{ old('remark_WaterProbe', session('formData.remark_WaterProbe', '')) }}">
                                        </div>
                                    </div>
                                </div>
                                <br/>
                                <div class="row">
                                    <div class="row d-flex align-items-center">
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" id="inspectionItem_WaterProbe5" placeholder="" name="inspectionItem_WaterProbe5">
                                        </div>
                                    
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" id="defectGrade_WaterProbe5" placeholder="" name="defectGrade_WaterProbe5">
                                        </div>
                                    
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" id="sampleNo_WaterProbe5" placeholder="" name="sampleNo_WaterProbe5">
                                        </div>
                                    
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" id="time_WaterProbe5" placeholder="" name="time_WaterProbe5">
                                        </div>
                                    
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" id="result_WaterProbe5" placeholder="" name="result_WaterProbe5">
                                        </div>
                                    
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" id="remark_WaterProbe5" placeholder="" name="remark_WaterProbe5">
                                        </div>
                                    </div>
                                </div>

                                <br/>
                                <div class="row">
                                    <div class="row d-flex align-items-center">
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" id="inspectionItem_WaterProbe5" placeholder="" name="inspectionItem_WaterProbe5">
                                        </div>
                                    
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" id="defectGrade_WaterProbe5" placeholder="" name="defectGrade_WaterProbe5">
                                        </div>
                                    
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" id="sampleNo_WaterProbe5" placeholder="" name="sampleNo_WaterProbe5">
                                        </div>
                                    
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" id="time_WaterProbe5" placeholder="" name="time_WaterProbe5">
                                        </div>
                                    
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" id="result_WaterProbe5" placeholder="" name="result_WaterProbe5">
                                        </div>
                                    
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" id="remark_WaterProbe5" placeholder="" name="remark_WaterProbe5">
                                        </div>
                                    </div>
                                </div>

                                <br/>
                                <div class="row">
                                    <div class="row d-flex align-items-center">
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" id="inspectionItem_WaterProbe5" placeholder="" name="inspectionItem_WaterProbe5">
                                        </div>
                                    
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" id="defectGrade_WaterProbe5" placeholder="" name="defectGrade_WaterProbe5">
                                        </div>
                                    
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" id="sampleNo_WaterProbe5" placeholder="" name="sampleNo_WaterProbe5">
                                        </div>
                                    
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" id="time_WaterProbe5" placeholder="" name="time_WaterProbe5">
                                        </div>
                                    
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" id="result_WaterProbe5" placeholder="" name="result_WaterProbe5">
                                        </div>
                                    
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" id="remark_WaterProbe5" placeholder="" name="remark_WaterProbe5">
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
                                                <label for="material_name" class="col-form-label">Material Name</label>
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" id="material_name" placeholder="" name="material_name">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <div class="form-row align-items-center">
                                            <div class="col-sm-4">
                                                <label for="test_result" class="col-form-label">Test Result</label>
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" id="test_result" placeholder="" name="test_result">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <div class="form-row align-items-center">
                                            <div class="col-sm-4">
                                                <label for="decision" class="col-form-label">Decision</label>
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" id="decision" placeholder="" name="decision">
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
                                                <label class="col-form-label" style="visibility: hidden;">Material Name</label>
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" id="material_name_2" placeholder="" name="material_name_2">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <div class="form-row align-items-center">
                                            <div class="col-sm-4">
                                                <label class="col-form-label" style="visibility: hidden;">Test Result</label>
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" id="test_result_2" placeholder="" name="test_result_2">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <div class="form-row align-items-center">
                                            <div class="col-sm-4">
                                                <label class="col-form-label" style="visibility: hidden;">Decision</label>
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" id="decision_2" placeholder="" name="decision_2">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end row kedua -->

                                <!-- row kedua -->
                                <div class="row">
                                    <div class="col-md-4 mb-4">
                                        <div class="form-row align-items-center">
                                            <div class="col-sm-4">
                                                <label class="col-form-label" style="visibility: hidden;">Material Name</label>
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" id="material_name_2" placeholder="" name="material_name_2">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <div class="form-row align-items-center">
                                            <div class="col-sm-4">
                                                <label class="col-form-label" style="visibility: hidden;">Test Result</label>
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" id="test_result_2" placeholder="" name="test_result_2">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <div class="form-row align-items-center">
                                            <div class="col-sm-4">
                                                <label class="col-form-label" style="visibility: hidden;">Decision</label>
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" id="decision_2" placeholder="" name="decision_2">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end row kedua -->

                                <!-- row kedua -->
                                <div class="row">
                                    <div class="col-md-4 mb-4">
                                        <div class="form-row align-items-center">
                                            <div class="col-sm-4">
                                                <label class="col-form-label" style="visibility: hidden;">Material Name</label>
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" id="material_name_2" placeholder="" name="material_name_2">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <div class="form-row align-items-center">
                                            <div class="col-sm-4">
                                                <label class="col-form-label" style="visibility: hidden;">Test Result</label>
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" id="test_result_2" placeholder="" name="test_result_2">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <div class="form-row align-items-center">
                                            <div class="col-sm-4">
                                                <label class="col-form-label" style="visibility: hidden;">Decision</label>
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" id="decision_2" placeholder="" name="decision_2">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end row kedua -->

                                <button type="submit" formaction="{{ route('add.ProcessPatrol', ['page' => 4]) }}" class="btn btn-outline-primary">Previous</button>
                                <button type="submit" formaction="" class="btn btn-outline-primary">Submit</button>
                            </div>
                        @endif
                    </form>
                    @if (session('success'))
                        <p>{{ session('success') }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>



@endsection