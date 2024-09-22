@extends('admin.admin_dashboard')
@section('admin')

<div class="page-content">

<div class="row">
    <div class="col-md-8 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">FORM EDIT PROCESS & MODEL</h6>
                
                <form method="post" action="{{ route('update.hourlyoutput') }}" class="forms-sample"">
                    @method('POST')
                    @csrf

                    <input type="hidden" name="id" value="{{ $pm->id }}">

                    <div class="mb-3">
                        <label for="exampleInputEmail3" class="form-label">PROCESS</label>
                        <input type="text" name="process" value="{{ $pm->process }}" class="form-control @error('process') is-invalid @enderror">
                        @error('process')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="exampleInputEmail4" class="form-label">PIC</label>
                        <input type="text" name="model" value="{{ $pm->model }}" class="form-control @error('model') is-invalid @enderror">
                        @error('model')
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