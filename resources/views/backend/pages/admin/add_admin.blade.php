@extends('admin.admin_dashboard')
@section('admin')

<div class="page-content">

<div class="row">
    <div class="col-md-8 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Add Admin</h6>
                
                <form method="POST" action="{{ route('store.admin') }}" class="forms-sample"">
                    @method('POST')
                    @csrf

                    <div class="mb-3">
                        <label for="exampleInputEmail3" class="form-label">Admin User Name</label>
                        <input type="text" name="username" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label for="exampleInputEmail3" class="form-label">Admin Name</label>
                        <input type="text" name="name" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label for="exampleInputEmail3" class="form-label">Admin Email</label>
                        <input type="email" name="email" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label for="exampleInputEmail3" class="form-label">Admin Phone</label>
                        <input type="number" name="phone" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label for="exampleInputEmail3" class="form-label">Admin Address</label>
                        <input type="text" name="address" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label for="exampleInputEmail3" class="form-label">Admin Password</label>
                        <input type="password" name="password" class="form-control">
                    </div>
                    
                    <div class="mb-3">
                        <label for="exampleInputEmail3" class="form-label">Role Name</label>
                        <select value="{{ old('roles') }}" class="form-select" id="exampleFormControlSelect2" name="roles">
                            <option selected="" disabled="">-select Role-</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role->name }}">{{ $role->name }}</option>
                            @endforeach
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