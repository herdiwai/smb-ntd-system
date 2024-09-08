@extends('admin.admin_dashboard')
@section('admin')

<div class="page-content">

<div class="row">
    <div class="col-md-8 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">FORM EDIT HOURLY OUTPUT</h6>
                
                <form method="post" action="{{ route('update.hourlyoutput') }}" class="forms-sample"">
                    @method('POST')
                    @csrf

                    <input type="hidden" name="id" value="{{ $hourlyoutput->id }}">

                    <div class="mb-3">
                        <label for="exampleFormControlSelect1" class="form-label">PROCESS</label>
                        <select class="form-select" id="exampleFormControlSelect1" name="process">
                            <option value="">---select process---</option>
                                @foreach($process as $processs)
                                    <option value="{{ $processs }}" {{ $processs == $hourlyoutput->process ? 'selected' : '' }}>
                                        {{ $processs }}
                                    </option>
                                @endforeach
                        </select>
                        @error('process')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="exampleFormControlSelect2" class="form-label">MODEL</label>
                        <select class="form-select" id="exampleFormControlSelect2" name="model">
                            <option value="">---select model---</option>
                            @foreach($model as $models)
                                <option value="{{ $models }}" {{ $models == $hourlyoutput->model ? 'selected' : '' }}>
                                    {{ $models }}
                                </option>
                            @endforeach
                        </select>
                        @error('model')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="exampleFormControlSelect3" class="form-label">LOT</label>
                        <select class="form-select" id="exampleFormControlSelect3" name="lot">
                            <option value="">---select lot---</option>
                            @foreach($lot as $lots)
                                <option value="{{ $lots }}" {{ $lots == $hourlyoutput->lot ? 'selected' : '' }}>
                                    {{ $lots }}
                                </option>
                            @endforeach
                        </select>
                        @error('lot')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="exampleFormControlSelect4" class="form-label">SHIFT</label>
                        <select class="form-select" id="exampleFormControlSelect4" name="shift">
                            <option value="">---select shift---</option>
                            @foreach($shift as $shifts)
                                <option value="{{ $shifts }}" {{ $shifts == $hourlyoutput->shift ? 'selected' : '' }}>
                                    {{ $shifts }}
                                </option>
                            @endforeach
                        </select>
                        @error('shift')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="exampleFormControlSelect5" class="form-label">LINE</label>
                        <select class="form-select" id="exampleFormControlSelect5" name="line">
                            <option value="">---select line---</option>
                            @foreach($line as $lines)
                                <option value="{{ $lines }}" {{ $lines == $hourlyoutput->line ? 'selected' : '' }}>
                                    {{ $lines }}
                                </option>
                            @endforeach
                        </select>
                        @error('line')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="exampleFormControlSelect1" class="form-label">TIME</label>
                        <select class="form-select" id="exampleFormControlSelect1" name="time">
                            <option value="">--select time--</option>
                                @foreach($time as $times)
                                    <option value="{{ $times }}" {{ $times == $hourlyoutput->time ? 'selected' : '' }}>
                                        {{ $times }}</option>
                                @endforeach
                        </select>
                    </div>

                        <h6 class="card-title">DATE</h6><div class="input-group flatpickr" id="flatpickr-date">
                            <input type="date" value="{{ $hourlyoutput->date }}" name="date" class="form-control @error('date') is-invalid @enderror" placeholder="Select date" data-input>
                        <span class="input-group-text input-group-addon" data-toggle><i data-feather="calendar"></i></span>
                        @error('date')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="exampleInputText1" class="form-label">TARGET</label>
                        <input type="text" name="target" value="{{ $hourlyoutput->target }}" class="form-control @error('target') is-invalid @enderror" id="exampleInputText1">
                        @error('target')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="exampleInputText1" class="form-label">OUTPUT</label>
                        <input type="text" name="output" value="{{ $hourlyoutput->output }}" class="form-control @error('output') is-invalid @enderror" id="exampleInputText1">
                        @error('output')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="exampleInputText1" class="form-label">ACCM</label>
                        <input type="text" name="accm" value="{{ $hourlyoutput->accm }}" class="form-control @error('accm') is-invalid @enderror" id="exampleInputText1">
                        @error('accm')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">DESCRIPTION</label>
                        <textarea class="form-control" name="deskription" id="exampleFormControlTextarea1" rows="5">{{ $hourlyoutput->deskription }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="exampleInputEmail3" class="form-label">PIC</label>
                        <input type="text" name="name" value="{{ $hourlyoutput->name }}" class="form-control @error('name') is-invalid @enderror">
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <button class="btn btn-primary" type="submit">SAVE CHANGES</button>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
@endsection