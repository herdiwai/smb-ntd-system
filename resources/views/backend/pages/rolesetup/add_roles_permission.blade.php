@extends('admin.admin_dashboard')
@section('admin')

<div class="page-content">

<div class="row">
    <div class="col-md-8 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Add Roles In Permission</h6>
                
                <form method="POST" action="{{ route('store.roles') }}" class="forms-sample"">
                    @method('POST')
                    @csrf

                    <div class="mb-3">
                        <label for="exampleFormControlSelect2" class="form-label">Roles Name</label>
                        <select class="form-select" id="exampleFormControlSelect2" name="role_id">
                            <option selected="" disabled="">---select Role---</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-check mb-2">
                        <input type="checkbox" class="form-check-input" id="checkDefault">
                        <label class="form-check-label" for="checkDefault">Permission All</label>
                    </div>

                    <hr>

                    @foreach ($permission_groups as $group)
                        
                    <div class="row">
                        <div class="col-3">
                            <div class="form-check mb-2">
                                <input type="checkbox" class="form-check-input" id="checkDefault">
                                <label class="form-check-label" for="checkDefault">{{ $group->group_name }}</label>
                            </div>
                        </div>

                    @php
                        $permissions = App\Models\User::getpermissionByGroupName($group->group_name)
                    @endphp

                        <div class="col-9">
                            <div class="form-check mb-2">
                                <input type="checkbox" class="form-check-input" id="checkDefault">
                                <label class="form-check-label" for="checkDefault">Permission All</label>
                            </div>
                        </div>
                    </div>
                
                    @endforeach


                    <button class="btn btn-primary" type="submit">SAVE CHANGES</button>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
@endsection