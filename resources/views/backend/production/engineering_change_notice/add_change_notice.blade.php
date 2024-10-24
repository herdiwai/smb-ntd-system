@extends('admin.admin_dashboard')
@section('admin')

<script src="{{ asset('backend/assets/vendors/jquery-ajax/jquery.min.js') }}"></script>

<div class="page-content">
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">ENGINEERING CHANGE NOTICE RECORD FORM </h6>
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

                        <form id="myForm" action="{{ route('post.ChangeNotice') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-4 mb-4">
                                    <div class="form-group">
                                        <div class="form-row align-items-center">
                                            <div class="col-sm-3">
                                                <label for="model">Model</label>
                                            </div>
                                            <div class="col">
                                                <select id="model" name="model_id" class="form-select" required />
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
                                            <div class="col-sm-3">
                                                <label for="" class="col-form-label">Date</label>
                                            </div>
                                            <div class="col">
                                                <input type="date" name="date" id="" class="form-control" placeholder="Select date" value="{{ old('date', session('date')) }}" required />
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4 mb-4">
                                    <div class="form-group">
                                        <div class="form-row align-items-center">
                                            <div class="col-sm-3">
                                                <label for="shift" class="col-form-label">Shift</label>
                                            </div>
                                            <div class="col">
                                                <select id="shift" name="shift_id" class="form-select" required />
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
                            </div>
                            <!-- end row pertama -->


                             <div class="row">
                                <div class="col-md-4 mb-4">
                                    <div class="form-group">
                                        <div class="form-row align-items-center">
                                            <div class="col-sm-3">
                                                <label for="line" class="col-form-label">Line</label>
                                            </div>
                                            <div class="col">
                                                <select id="line" name="line_id" class="form-select" required />
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
                                            <div class="col-sm-3">
                                                <label for="lot" class="col-form-label">Lot</label>
                                            </div>
                                            <div class="col">
                                                <select id="lot" name="lot_id" class="form-select" required />
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

                                <div class="col-md-4 mb-4">
                                    <div class="form-group">
                                        <div class="form-row align-items-center">
                                            <div class="col-sm-3">
                                                <label for="pic" class="col-form-label">PIC</label>
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" id="pic" placeholder="" name="pic" value="{{ old('pic', session('pic')) }}" required />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                             </div>
                             <hr/><br/>
                             <!-- end row kedua -->

                            

                             <div class="row">
                                <div class="col-md-4 mb-4">
                                    <div class="form-group">
                                        <div class="form-row align-items-center">
                                            <div class="col-sm-3">
                                                <label for="change_notice" class="col-form-label">Change Notice</label>
                                            </div>
                                            <div class="col">
                                                <textarea class="form-control" value="{{ old('change_notice') }}" name="change_notice" id="exampleFormControlTextarea1" rows="2"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4 mb-4">
                                    <div class="form-group">
                                        <div class="form-row align-items-center">
                                            <div class="col-sm-3">
                                                <label for="change_from_notice" class="col-form-label">Change From</label>
                                            </div>
                                            <div class="col">
                                                <textarea class="form-control" value="{{ old('change_from_notice') }}" name="change_from_notice" id="exampleFormControlTextarea1" rows="2"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4 mb-4">
                                    <div class="form-group">
                                        <div class="form-row align-items-center">
                                            <div class="col-sm-3">
                                                <label for="change_to_notice" class="col-form-label">Change To</label>
                                            </div>
                                            <div class="col">
                                                <textarea class="form-control" value="{{ old('change_to_notice') }}" name="change_to_notice" id="exampleFormControlTextarea1" rows="2"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                             </div>
                             <!-- end row ketiga -->

                             <div class="row">
                                <div class="col-md-4 mb-4">
                                    <div class="form-group">
                                        <div class="form-row align-items-center">
                                            <div class="col-sm-3">
                                                <label for="so_no" class="col-form-label">SO No.</label>
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" id="so_no" placeholder="" name="so_no" value="{{ old('so_no', session('so_no')) }}" required />
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4 mb-4">
                                    <div class="form-group">
                                        <div class="form-row align-items-center">
                                            <div class="col-sm-3">
                                                <label for="co_no" class="col-form-label">CO No.</label>
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" id="co_no" placeholder="" name="co_no" value="{{ old('co_no', session('co_no')) }}" required />
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4 mb-4">
                                    <div class="form-group">
                                        <div class="form-row align-items-center">
                                            <div class="col-sm-3">
                                                <label for="week" class="col-form-label">Week</label>
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" id="week" placeholder="" name="week" value="{{ old('week', session('week')) }}" required />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                             </div>
                            <!-- end row keempat -->

                            <div class="row">
                                <div class="col-md-4 mb-4">
                                    <div class="form-group">
                                        <div class="form-row align-items-center">
                                            <div class="col-sm-3">
                                                <label for="change_datecode" class="col-form-label">DateCode Implement</label>
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" id="change_datecode" placeholder="" name="change_datecode" value="{{ old('change_datecode', session('change_datecode')) }}" required />
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4 mb-4">
                                    <div class="form-group">
                                        <div class="form-row align-items-center">
                                            <div class="col-sm-3">
                                                <label for="change_from_datecode" class="col-form-label">Change From </label>
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" id="change_from_datecode" placeholder="" name="change_from_datecode" value="{{ old('change_from_datecode', session('change_from_datecode')) }}" required />
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4 mb-4">
                                    <div class="form-group">
                                        <div class="form-row align-items-center">
                                            <div class="col-sm-3">
                                                <label for="change_to_datecode" class="col-form-label">Change To</label>
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" id="change_to_datecode" placeholder="" name="change_to_datecode" value="{{ old('change_to_datecode', session('change_to_datecode')) }}" required />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                             </div>
                             <!-- end row kelima -->

                             <div class="row">
                                <div class="col-md-4 mb-4">
                                    <div class="form-group">
                                        <div class="form-row align-items-center">
                                            <div class="col-sm-3">
                                                <label for="con_no" class="col-form-label">CoN No.</label>
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" id="con_no" placeholder="" name="con_no" value="{{ old('con_no', session('con_no')) }}" required />
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4 mb-4">
                                    <div class="form-group">
                                        <div class="form-row align-items-center">
                                            <div class="col-sm-3">
                                                <label for="sah_key" class="col-form-label">Sah Key</label>
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" id="sah_key" placeholder="" name="sah_key" value="{{ old('sah_key', session('sah_key')) }}" required />
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4 mb-4">
                                    <div class="form-group">
                                        <div class="form-row align-items-center">
                                            <div class="col-sm-3">
                                                <label for="con_name" class="col-form-label">CoN Name</label>
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" id="con_name" placeholder="" name="con_name" value="{{ old('con_name', session('con_name')) }}" required />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                             </div>
                             <!-- end row keenam -->

                             <div class="row">
                                <div class="col-md-4 mb-4">
                                    <div class="form-group">
                                        <div class="form-row align-items-center">
                                            <div class="col-sm-3">
                                                <label for="sn_awal" class="col-form-label">SN First</label>
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" id="sn_awal" placeholder="" name="sn_awal" value="{{ old('sn_awal', session('sn_awal')) }}" required />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-4">
                                    <div class="form-group">
                                        <div class="form-row align-items-center">
                                            <div class="col-sm-3">
                                                <label for="sn_rndm" class="col-form-label">SN Random</label>
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" id="sn_rndm" placeholder="" name="sn_rndm" value="{{ old('sn_rndm', session('sn_rndm')) }}" required />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                             </div>

                             <button class="btn btn-primary btn-sm" type="submit"><i data-feather="save"></i> SAVE</button>

                        </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection