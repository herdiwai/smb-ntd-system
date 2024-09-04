@extends('admin.admin_dashboard')
@section('admin')

<div class="page-content">

    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <a href="{{ route('export') }}" class="btn btn-inverse-info">Download Xlsx</a>
    </nav>

<div class="row">
    <div class="col-md-8 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Import Permission</h6>
                
                <form method="POST" action="{{ route('store.permission') }}" class="forms-sample"">
                    @method('POST')
                    @csrf

                    <div class="mb-3">
                        <label for="exampleInputEmail3" class="form-label">Xlsx File Import</label>
                        <input type="file" name="import_file" class="form-control">
                    </div>

                    <button class="btn btn-inverse-warning" type="submit">Upload</button>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
@endsection