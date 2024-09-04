@extends('admin.admin_dashboard')
@section('admin')

<div class="page-content">

<div class="row">
    <div class="col-md-8 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Permission Edit</h6>
                
                <form method="post" action="{{ route('update.permission') }}" class="forms-sample"">
                    @method('POST')
                    @csrf
                    
                    <input type="hidden" name="id" value="{{ $permission->id }}">

                    <div class="mb-3">
                        <label for="exampleInputEmail3" class="form-label">Permission Name</label>
                        <input type="text" name="name" value="{{ $permission->name }}" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label for="exampleFormControlSelect2" class="form-label">Group Name</label>
                        <select class="form-select" id="exampleFormControlSelect2" name="group_name">
                            <option selected="" disabled="">---select Group---</option>
                            <option value="HourlyOutput" {{ $permission->group_name == 'HourlyOutput' ? 'selected' : '' }}>Production Hourly Output</option>
                            <option value="Qc" {{ $permission->group_name == 'Qc' ? 'selected' : '' }}>QC </option>
                            <option value="Ntd" {{ $permission->group_name == 'Ntd' ? 'selected' : '' }}>NTD</option>
                            <option value="Fty" {{ $permission->group_name == 'Fty' ? 'selected' : '' }}>Facility</option>
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