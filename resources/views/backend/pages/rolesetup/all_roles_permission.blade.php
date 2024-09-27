@extends('admin.admin_dashboard')
@section('admin')

<div class="page-content">
  
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <a href="{{ route('add.roles') }}" class="btn btn-inverse-info">Add Roles</a>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">All Role Permission</h6>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Action</th>
                                <th>Roles Name</th>
                                <th>Permission</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($roles as $key => $item)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>
                                            <a href="{{ route('admin.edit.roles', $item->id) }}" class="btn btn-inverse-warning" title="Edit"><i data-feather="edit"></i></a>
                                            <a href="{{ route('admin.delete.roles', $item->id) }}" class="btn btn-inverse-danger" title="Delete"><i data-feather="trash-2"></i></a>
                                        </td>
                                        <td>{{ $item->name }}</td>

                                        <td>
                                            @foreach($item->permissions as $permiss )
                                                <span class="badge bg-success"> {{ $permiss->name }}</span>
                                            @endforeach
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection