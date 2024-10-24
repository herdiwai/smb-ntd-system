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

                        <form id="myForm" action="" method="POST">
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
                                                    @foreach($modelbrewer as $modelbrewers)
                                                        <option value="{{ $modelbrewers->id }}" {{ $modelbrewers->id ==  old('model', $changeNotice->model) ? 'selected' : '' }}>
                                                            {{ $modelbrewers->model }}
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
                                                <input type="date" name="date" id="date" class="form-control" placeholder="Select date" value="{{ old('date', $changeNotice->date) }}">
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
                                                        <option value="{{ $shifts->id }}" {{ $shifts->id ==  old('shift', $changeNotice->shift) ? 'selected' : '' }}>
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
                                                        <option value="{{ $lines->id }}" {{ $lines->id ==  old('line', $changeNotice->line) ? 'selected' : '' }}>
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
                                                            <option value="{{ $lots->id }}" {{ $lots->id ==  old('lot', $changeNotice->lot) ? 'selected' : '' }}>
                                                                {{ $lots->lot }}
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
                                                <label for="pic" class="col-form-label">PIC</label>
                                            </div>
                                            <div class="col">
                                                <input type="text" name="pic" id="pic" class="form-control" placeholder="" value="{{ old('pic', $changeNotice->pic) }}">
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
                                                <textarea class="form-control" name="change_notice" id="change_notice" rows="2">{{ old('change_notice', $changeNotice->change_notice) }}</textarea>
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
                                                <textarea class="form-control" name="change_from_notice" id="change_from_notice" rows="2">{{ old('change_from_notice', $changeNotice->change_from_notice) }}</textarea>
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
                                                <textarea class="form-control" name="change_to_notice" id="change_to_notice" rows="2">{{ old('change_to_notice', $changeNotice->change_to_notice) }}</textarea>
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
                                                <input type="text" name="so_no" id="so_no" class="form-control" placeholder="" value="{{ old('so_no', $changeNotice->so_no) }}">
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
                                                <input type="text" name="co_no" id="co_no" class="form-control" placeholder="" value="{{ old('co_no', $changeNotice->co_no) }}">
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
                                                <input type="text" name="week" id="week" class="form-control" placeholder="" value="{{ old('week', $changeNotice->week) }}">
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
                                                <input type="text" name="change_datecode" id="change_datecode" class="form-control" placeholder="" value="{{ old('change_datecode', $changeNotice->implement_datecode) }}">
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
                                                <input type="text" name="change_from_datecode" id="change_from_datecode" class="form-control" placeholder="" value="{{ old('change_from_datecode', $changeNotice->change_from_datecode) }}">
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
                                                <input type="text" name="change_to_datecode" id="change_to_datecode" class="form-control" placeholder="" value="{{ old('change_to_datecode', $changeNotice->change_to_datecode) }}">
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
                                                <input type="text" name="con_no" id="con_no" class="form-control" placeholder="" value="{{ old('con_no', $changeNotice->con_no) }}">
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
                                                <input type="text" name="sah_key" id="sah_key" class="form-control" placeholder="" value="{{ old('sah_key', $changeNotice->sah_key) }}">
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
                                                <input type="text" name="con_name" id="con_name" class="form-control" placeholder="" value="{{ old('con_name', $changeNotice->con_name) }}">
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
                                                <input type="text" name="sn_awal" id="sn_awal" class="form-control" placeholder="" value="{{ old('sn_awal', $changeNotice->sn_awal) }}">
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
                                                <input type="text" name="sn_rndm" id="sn_rndm" class="form-control" placeholder="" value="{{ old('sn_rndm', $changeNotice->sn_rndm) }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                             </div>

                             <button class="btn btn-primary btn-sm" type="submit"><i data-feather="save"></i> SAVE CHANGES</button>



                        </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection