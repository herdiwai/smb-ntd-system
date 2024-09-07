@extends('admin.admin_dashboard')
@section('admin')

<script src="{{ asset('backend/assets/vendors/jquery-ajax/jquery.min.js') }}"></script>

<style type="text/css">
    .form-check-label{
        text-transform: capitalize;
    }
</style>

<div class="page-content">

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Edit Roles In Permission</h6>
                
                <form method="POST" action="{{ route('admin.roles.update', $role->id) }}" class="forms-sample"">
                    @method('POST')
                    @csrf

                    <div class="mb-3">
                        <label for="exampleFormControlSelect2" class="form-label">Roles Name</label>
                        <h3>{{ $role->name }}</h3>
                    </div>

                    <div class="form-check mb-2">
                        <input type="checkbox" class="form-check-input" id="checkDefaultmain">
                        <label class="form-check-label" for="checkDefaultmain">Permission All</label>
                    </div>

                    <hr>

                    @foreach ($permission_groups as $group)
                        
                    <div class="row">
                        <div class="col-3">
                    
                        @php
                            $permissions = App\Models\User::getpermissionByGroupName($group->group_name)
                        @endphp

                            <div class="form-check mb-2">
                                <input type="checkbox" class="form-check-input" id="checkDefault"{{ App\Models\User::roleHasPermissions($role, $permissions) ? 'checked' :'' }}>
                                <label class="form-check-label" for="checkDefault">{{ $group->group_name }}</label>
                            </div>
                        </div>

                        

                        <div class="col-9">
                            @foreach ($permissions as $permission)
                            <div class="form-check mb-2">
                                <input type="checkbox" class="form-check-input permission-checkbox" name="permission[]" id="checkDefault{{ $permission->id }}" value="{{ $permission->name }}" {{ $role->hasPermissionTo($permission->name) ? 'checked' : '' }}>
                                <label class="form-check-label" for="checkDefault{{ $permission->id }}">{{ $permission->name }}</label>
                            </div>
                            @endforeach
                            <br>
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

<script type="text/javascript">
    $('#checkDefaultmain').click(function(){
        if($(this).is(':checked')){
            $('input[ type=checkbox ]').prop('checked', true);
        }else{
            $('input[ type=checkbox ]').prop('checked', false);
        }
    });
</script>


@endsection