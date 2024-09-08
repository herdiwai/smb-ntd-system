@extends('admin.admin_dashboard')
@section('admin')

<script src="{{ asset('backend/assets/vendors/jquery-ajax/jquery.min.js') }}"></script>

<div class="page-content">

<div class="row">
    <div class="col-md-8 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">FORM INPUT HOURLY OUTPUT</h6>
                
                <form id="myForm" method="POST" action="{{ route('store.hourlyoutput') }}" class="forms-sample"">
                    @method('POST')
                    @csrf

                    <div class="form-group mb-3">
                        <label for="exampleFormControlSelect1" class="form-label">PROCESS</label>
                        <select class="form-select" id="exampleFormControlSelect1" name="process">
                            <option value="">---select process---</option>
                                @foreach($process as $processs)
                                    <option value="{{ $processs }}" {{ old('process') == $processs ? 'selected' : '' }}>{{ $processs }}</option>
                                @endforeach
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label for="exampleFormControlSelect2" class="form-label">MODEL</label>
                        <select class="form-select" id="exampleFormControlSelect2" name="model">
                            <option value="">---select model---</option>
                                @foreach($model as $models)
                                    <option value="{{ $models }}" {{ old('model') == $models ? 'selected' : '' }}>{{ $models }}</option>
                                @endforeach
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label for="exampleFormControlSelect3" class="form-label">LOT</label>
                        <select class="form-select" id="exampleFormControlSelect3" name="lot">
                            <option value="">---select lot---</option>
                                @foreach($lot as $lots)
                                    <option value="{{ $lots }}" {{ old('lot') == $lots ? 'selected' : '' }}>{{ $lots }}</option>
                                @endforeach
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label for="exampleFormControlSelect4" class="form-label">SHIFT</label>
                        <select class="form-select" id="exampleFormControlSelect4" name="shift">
                            <option value="">---select shift---</option>
                                @foreach($shift as $shifts)
                                    <option value="{{ $shifts }}" {{ old('shift') == $shifts ? 'selected' : '' }}>{{ $shifts }}</option>
                                @endforeach
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label for="exampleFormControlSelect5" class="form-label">LINE</label>
                        <select class="form-select" id="exampleFormControlSelect5" name="line">
                            <option value="">---select line---</option>
                                @foreach($line as $lines)
                                    <option value="{{ $lines }}" {{ old('line') == $lines ? 'selected' : '' }}>{{ $lines }}</option>
                                @endforeach
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label for="exampleFormControlSelect6" class="form-label">TIME</label>
                        <select class="form-select" id="exampleFormControlSelect1" name="time">
                            <option value="">--select time--</option>
                                @foreach($time as $times)
                                    <option value="{{ $times }}" {{ old('time') == $times ? 'selected' : '' }}>{{ $times }}</option>
                                @endforeach
                        </select>
                    </div>

                    <h6 class="card-title">DATE</h6>
                        <div class="form-group input-group flatpickr" id="flatpickr-date">
                            <input type="date" value="{{ old('date') }}" name="date" class="form-control" placeholder="Select date" data-input>
                        <span class="input-group-text input-group-addon" data-toggle><i data-feather="calendar"></i></span>
                    </div>

                    <div class="form-group mb-3">
                        <label for="exampleInputText1" class="form-label">TARGET</label>
                        <input type="number" name="target" value="{{ old('target') }}" class="form-control" id="exampleInputText1">
                    </div>

                    <div class="form-group mb-3">
                        <label for="exampleInputText1" class="form-label">OUTPUT</label>
                        <input type="number" name="output" value="{{ old('output') }}" class="form-control" id="exampleInputText1">
                    </div>

                    <div class="form-group mb-3">
                        <label for="exampleInputText1" class="form-label">ACCM</label>
                        <input type="number" name="accm" value="{{ old('accm') }}" class="form-control" id="exampleInputText1">
                    </div>

                    <div class="form-group mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">DESCRIPTION</label>
                        <textarea class="form-control" value="{{ old('deskription') }}" name="deskription" id="exampleFormControlTextarea1" rows="5"></textarea>
                    </div>

                    <div class="form-group mb-3">
                        <label for="exampleInputEmail3" class="form-label">PIC</label>
                        <input type="text" name="name" value="{{ old('name') }}" class="form-control">
                    </div>

                    <button class="btn btn-primary btn-sm" type="submit"><i data-feather="save"></i> SAVE CHANGES</button>
                </form>
            </div>
        </div>
    </div>
</div>
</div>

<script type="text/javascript">
    $(document).ready(function (){
        $('#myForm').validate({
            rules: {
                process: {
                    required : true,
                }, 
                model: {
                    required : true,
                }, 
                lot: {
                    required : true,
                }, 
                shift: {
                    required : true,
                }, 
                line: {
                    required : true,
                }, 
                time: {
                    required : true,
                }, 
                date: {
                    required : true,
                }, 
                target: {
                    required : true,
                }, 
                output: {
                    required : true,
                }, 
                accm: {
                    required : true,
                },
                name: {
                    required : true,
                },
                
            },
            messages :{
                process: {
                    required : 'Please Enter Process Name',
                }, 
                model: {
                    required : 'Please Enter Model Name',
                }, 
                lot: {
                    required : 'Please Enter Lot Name',
                }, 
                shift: {
                    required : 'Please Enter Shift Name',
                }, 
                line: {
                    required : 'Please Enter Line Name',
                }, 
                time: {
                    required : 'Please Enter Time',
                }, 
                date: {
                    required : 'Please Enter Date',
                }, 
                target: {
                    required : 'Please Enter Target',
                }, 
                output: {
                    required : 'Please Enter Output',
                }, 
                accm: {
                    required : 'Please Enter Accm',
                }, 
                name: {
                    required : 'Please Enter Name/PIC',
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
    
</script>

@endsection