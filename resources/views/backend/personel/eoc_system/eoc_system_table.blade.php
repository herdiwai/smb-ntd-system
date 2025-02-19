@extends('admin.admin_dashboard')
@section('admin')
<meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="page-content">

        {{-- <nav class="page-breadcrumb">
            <ol class="breadcrumb"> 
                 <a href="{{ route('request.bookedmeetingroom') }}" class="btn btn-inverse-info btn-xs"><i data-feather="file-plus" style="width: 16px; height: 16px;"></i> CALENDAR</a>
            </ol>
        </nav> --}}

        <div class="row">
            <div class="col-md-8 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Import EOC File</h6>
                        
                        <form action="{{ route('eocsystem.import') }}" method="POST" enctype="multipart/form-data">
                            @method('POST')
                            @csrf
        
                            <div class="mb-2">
                                <label for="exampleInputEmail3" class="form-label">Xlsx File Import</label>
                                <input type="file" name="file" class="form-control">
                            </div>
                            <button class="btn btn-inverse-warning" type="submit">Upload</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        {{-- <div class="row mb-3">
            <div class="col-md-6">
                <form action="{{ route('eocsystem.import') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="input-group">
                        <input type="file" name="file" required>
                        <button type="submit">Import</button>
                    </div>
                </form>
            </div>
        </div> --}}
    
            <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">EOC System Table</h4>
                                {{-- <a href="" class="btn btn-inverse-primary btn-xs"><i data-feather="calendar" style="width: 16px; height: 16px;"></i> CALENDAR</a> --}}
                            <div class="table-responsive">
                            <table id="table" class="table">
                                {{-- <table id="bookingsTable" class="table table-striped table-bordered"> --}}
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>EmployeeID</th>
                                            <th>EmployeeName</th>
                                            <th>Position</th>
                                            <th>JoinDate</th>
                                            <th>ContractType</th>
                                            <th>ContractStart</th>
                                            <th>ContractEnd</th>
                                            <th>ContractFinish</th>
                                            <th>CurrentLeaveBalance</th>
                                            <th>Absent</th>
                                            <th>Sick</th>
                                            <th>Performance</th>
                                            <th>Remarks</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $key => $dataeoc)
                                            <tr>
                                                <td>{{ $key+1 + ($data->currentPage() - 1) * $data->perPage() }}</td>
                                                <td>{{ $dataeoc->EmployeeID }}</td>
                                                <td>{{ $dataeoc->EmployeeName }}</td>
                                                <td>{{ $dataeoc->Position }}</td>
                                                <td>{{ $dataeoc->JoinDate }}</td>
                                                <td>{{ $dataeoc->ContractType }}</td>
                                                <td>{{ $dataeoc->ContractStart }}</td>
                                                <td>{{ $dataeoc->ContractEnd }}</td>
                                                <td>{{ $dataeoc->ContractFinish }}</td>
                                                <td>{{ $dataeoc->CurrentLeaveBalance }}</td>
                                                <td>{{ $dataeoc->Absent }}</td>
                                                <td>{{ $dataeoc->Sick }}</td>
                                                <td>{{ $dataeoc->Performance }}</td>
                                                <td>{{ $dataeoc->Remarks }}</td>

                                                <td>
                                                    <button class="btn btn-success btn-xs" data-bs-toggle="modal" data-bs-target="#approveEOC"
                                                        data-dataeoc-id="{{ $dataeoc->id }}" onclick="loadEocData({{ $dataeoc->id }})">
                                                        <i data-feather="check-circle" style="width: 16px; height: 20px;"></i> Detail
                                                    </button>

                                                </td>
                                            <tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{ $data->links('pagination::bootstrap-5') }}
                                {{-- {{ $meetingRooms->appends(['search' => request('search')])->links('pagination::bootstrap-5') }} --}}
                            </div>
                        </div>
                    </div>
                </div>

        </div>
    </div>


<div class="modal fade" id="approveEOC" tabindex="-1" aria-labelledby="approveEOCLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="approveEOCModalLabel">DETAIL EOC FORM</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="modalContent">
                <!-- Konten modal akan dimuat di sini -->
            </div>
        </div>
    </div>
</div>

<script>
    function loadEocData(eocid) {
        // Menampilkan loader jika perlu
        $('#modalContent').html('<p>Loading...</p>');

        // Melakukan AJAX request untuk mengambil data detail booking
        $.ajax({
            url: '/add/detaileoc/' + eocid,  // pastikan bookedid berisi ID yang benar
            type: 'get',
            success: function(data) {
                console.log(data); // Periksa data yang diterima
                $('#modalContent').html(`
                    <form id="approveForm" action="/update/request-meetingroom-approval/${data.id}" method="POST">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="_method" value="PATCH">

                        <div class="mb-3">
                            <label class="form-label"><b>Requester EmployeeID:</b></label>
                            <input type="text" class="form-control" value="${data.EmployeeID}" disabled>
                        </div>

                        <div class="mb-3">
                            <label class="form-label"><b>EmployeeName:</b></label>
                            <input type="text" class="form-control" value="${data.EmployeeName}" disabled>
                        </div>

                       <div class="mb-3">
                            <label class="form-label"><b>Position:</b></label>
                            <input type="text" class="form-control" value="${data.Position}" disabled>
                        </div>

                        <div class="mb-3">
                            <label class="form-label"><b>JoinDate:</b></label>
                            <input type="date" class="form-control" name="JoinDate" value="${data.JoinDate}" disabled>
                        </div>

                        <div class="mb-3">
                            <label class="form-label"><b>ContractType:</b></label>
                            <input type="text" class="form-control" value="${data.ContractType}" disabled>
                        </div>

                        <div class="mb-3">
                            <label class="form-label"><b>ContractStart:</b></label>
                            <input type="date" class="form-control" name="ContractStart" value="${data.ContractStart}" disabled>
                        </div>

                        <div class="mb-3">
                            <label class="form-label"><b>ContractEnd:</b></label>
                            <input type="date" class="form-control" name="ContractEnd" value="${data.ContractEnd}" disabled>
                        </div>

                        <div class="mb-3">
                            <label class="form-label"><b>ContractFinish:</b></label>
                            <input type="date" class="form-control" name="ContractFinish" value="${data.ContractFinish}" disabled>
                        </div>

                        <div class="mb-3">
                            <label class="form-label"><b>CurrentLeaveBalance:</b></label>
                            <input type="text" class="form-control" value="${data.CurrentLeaveBalance}" disabled>
                        </div>

                        <div class="mb-3">
                            <label class="form-label"><b>Absent:</b></label>
                            <input type="text" class="form-control" value="${data.Absent}" disabled>
                        </div>

                        <div class="mb-3">
                            <label class="form-label"><b>Sick:</b></label>
                            <input type="text" class="form-control" value="${data.Sick}" disabled>
                        </div>

                        <div class="mb-3">
                            <label class="form-label"><b>Performance:</b></label>
                            <input type="text" class="form-control" value="${data.Performance}" disabled>
                        </div>

                        <div class="mb-3">
                            <label class="form-label"><b>Remarks:</b></label>
                            <textarea class="form-control" rows="2" disabled>${data.Remarks}</textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label"><b>Meeting Room:</b></label>
                            <select name="ContractName" class="form-select" id="CategoryContract">
                                <!-- Options will be dynamically added by JavaScript -->
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label"><b>Date:</b></label>
                            <input type="date" class="form-control" name="DateSubmitContract" value="${data.DateSubmitContract}" required>
                        </div>

                    </form>
                `);
                 // Menambahkan options untuk meeting room
                 var categoryContract = $('#CategoryContract');
                data.categoryContract.forEach(function(room) {
                    var selected = (room.id == data.ContractName) ? 'selected' : '';
                    categoryContract.append(`
                        <option value="${room.id}" ${selected}>
                            ${room.ContractName}
                        </option>
                    `);
                });

                // Cek jika tombol berhasil ditambahkan atau diubah
                feather.replace();
            },
            error: function() {
                $('#modalContent').html('<p>Error loading booking details.</p>');
            }
        });
    }
</script>

@endsection