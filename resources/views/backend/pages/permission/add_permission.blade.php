@extends('admin.admin_dashboard')
@section('admin')

<div class="page-content">

<div class="row">
    <div class="col-md-8 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Add Permission</h6>
                
                <form method="POST" action="{{ route('store.permission') }}" class="forms-sample"">
                    @method('POST')
                    @csrf

                    <div class="mb-3">
                        <label for="exampleInputEmail3" class="form-label">Permission Name</label>
                        <input type="text" name="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror">
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="exampleFormControlSelect2" class="form-label">Group Name</label>
                        <select class="form-select" id="exampleFormControlSelect2" name="group_name">
                            <option selected="" disabled="">---select Group---</option>
                            <option value="HourlyOutput">Production Hourly Output</option>
                            <option value="Qc">QC </option>
                            <option value="Ntd">NTD</option>
                            <option value="Fty">Facility</option>

                        </select>
                    </div>


                    <button class="btn btn-primary" type="submit">SAVE CHANGES</button>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
@endsection