@extends('admin.admin_dashboard')
@section('admin')
    <div class="page-content">

        {{-- <nav class="page-breadcrumb">
            <ol class="breadcrumb"> 
                 <a href="{{ route('request.bookedmeetingroom') }}" class="btn btn-inverse-info btn-xs"><i data-feather="file-plus" style="width: 16px; height: 16px;"></i> CALENDAR</a>
            </ol>
        </nav> --}}

        {{-- <div class="row mb-3">
            <div class="col-md-6">
                <form action="" method="GET">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Search..." value="{{ request('search') }}"/>
                        <button type="submit" class="btn btn-primary">
                            Search
                        </button>
                    </div>
                </form>
            </div>
        </div>
     --}}
            <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">EMPLOYEE LOG OUT IN</h4>
                                {{-- <a href="" class="btn btn-inverse-primary btn-xs"><i data-feather="calendar" style="width: 16px; height: 16px;"></i> CALENDAR</a> --}}
                            <div class="table-responsive">
                            <table id="table" class="table">
                                {{-- <table id="bookingsTable" class="table table-striped table-bordered"> --}}
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Card No</th>
                                            <th>Code</th>
                                            <th>Name</th>
                                            <th>Company Structure</th>
                                            <th>Date</th>
                                            <th>Time Out</th>
                                            <th>Time In</th>
                                            {{-- <th>Action</th> --}}
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($all_employee as $key => $employee)
                                        <tr>
                                            <td>{{ $key+1 + ($all_employee->currentPage() - 1) * $all_employee->perPage() }}</td>
                                            {{-- <td>{{ $key+1 }}</td> --}}
                                            <td>{{ $employee->Cardno }}</td>
                                            <td>{{ $employee->Code }}</td>
                                            <td>{{ $employee->Name }}</td>
                                            <td>{{ $employee->CompanyStructure }}</td>
                                            <td>{{ $employee->Date }}</td>
                                            <td>{{ $employee->TimeOut }}</td>
                                            <td>{{ $employee->TimeIn }}</td>
                                            {{-- <td>
                                                <a href="{{ route('delete.booked', $booked->id ) }}" class="btn btn-inverse-danger btn-xs" title="Delete Mrr"><i data-feather="trash-2" style="width: 16px; height: 16px;"></i></a>
                                            </td> --}}
                                        <tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{ $all_employee->links('pagination::bootstrap-5') }}
                                {{-- {{ $meetingRooms->appends(['search' => request('search')])->links('pagination::bootstrap-5') }} --}}
                            </div>
                        </div>
                    </div>
                </div>

        </div>
    </div>

@endsection