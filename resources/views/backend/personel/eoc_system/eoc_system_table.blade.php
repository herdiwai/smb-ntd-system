@extends('admin.admin_dashboard')
@section('admin')
<meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="page-content">
<!-- Tambahkan Font Awesome CDN -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
        {{-- <nav class="page-breadcrumb">
            <ol class="breadcrumb"> 
                 <a href="{{ route('request.bookedmeetingroom') }}" class="btn btn-inverse-info btn-xs"><i data-feather="file-plus" style="width: 16px; height: 16px;"></i> CALENDAR</a>
            </ol>
        </nav> --}}

        {{-- <div class="row">
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
        </div> --}}
        
        {{-- <div class="row">
            <div class="col-md-12 mx-auto">
                <div class="card shadow-lg">
                    <div class="card-body">
                        <h5 class="card-title fw-bold text-primary"><i class="fas fa-file-upload"></i> Import EOC File</h5>
                        <p class="text-muted">Upload file dalam format <strong>.xlsx</strong> atau <strong>.xls</strong></p>
        
                        <form id="uploadForm" action="{{ route('eocsystem.import') }}" method="POST" enctype="multipart/form-data">
                            @csrf
        
                            <div class="mb-3">
                                <label class="form-label fw-bold">Xlsx File Import</label>
                                <div class="input-group">
                                    <input type="file" name="file" class="form-control" id="fileInput" accept=".xlsx,.xls">
                                    <label class="input-group-text bg-primary text-white" for="fileInput">
                                        <i class="fas fa-folder-open"></i>
                                    </label>
                                </div>
                                <small class="text-danger d-none" id="fileError">Please select files before uploading.</small>
                            </div>
        
                            <div class="d-flex justify-content-end">
                                <button class="btn btn-primary px-4" type="submit" id="uploadButton">
                                    <i class="fas fa-upload"></i> Upload
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div> --}}


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
                    <div class="card shadow-lg">
                        <div class="card-body">
                            {{-- <div class="d-flex align-items-center"> --}}
                                <h2 class="card-title fw-bold text-success me-3">
                                    <i data-feather="file-text" ></i> End Of Contract Table
                                </h2>
                                 <!-- Filter Section -->
                                    <div class="row align-items-center g-3 mb-3">
                                        <!-- Filter Date -->
                                        <div class="col-md-3">
                                            <label for="filterDateFrom" class="form-label fw-bold">From</label>
                                            <input type="date" id="filterDateFrom" name="filterDateFrom" class="form-control">
                                        </div>
                                        <div class="col-md-3">
                                            <label for="filterDateTo" class="form-label fw-bold">To</label>
                                            <input type="date" id="filterDateTo" name="filterDateTo" class="form-control">
                                        </div>

                                        <!-- Filter Status -->
                                        <div class="col-md-3">
                                            <label for="filterStatus" class="form-label fw-bold">Status</label>
                                            <select id="filterStatus" class="form-select">
                                                <option value="">-- Select Status --</option>
                                                <option value="Extend">Extend</option>
                                                <option value="Not Extend">Not Extend</option>
                                                <option value="Permanent">Permanent</option>
                                                <option value="End Of Contract">End Of Contract</option>
                                                <option value="Absconded">Absconded</option>
                                                <option value="Resign">Resign</option>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Buttons -->
                                    <div class="d-flex justify-content-start gap-2">
                                        <button type="button" class="btn btn-inverse-warning btn-xs mb-3" data-bs-toggle="modal" data-bs-target="#uploadModal">
                                            <i data-feather="upload" style="width: 16px; height: 16px;"></i> Upload File
                                        </button>
                                        <button type="button" id="applyDateFilter" class="btn btn-inverse-primary btn-xs mb-3">
                                            <i data-feather="filter" style="width: 16px; height: 16px;"></i> Apply Filter
                                        </button>
                                        <button id="resetFilter" class="btn btn-inverse-secondary btn-xs mb-3">
                                            <i data-feather="refresh-ccw" style="width: 16px; height: 16px;"></i> Reset Filter
                                        </button>
                                        <button id="exportExcel" class="btn btn-inverse-success btn-xs mb-3"> 
                                            <i data-feather="download" style="width: 16px; height: 16px;"></i> Export Excel
                                        </button>
                                    </div>
                                <br>
                            {{-- </div> --}}
                                {{-- <a href="" class="btn btn-inverse-primary btn-xs"><i data-feather="calendar" style="width: 16px; height: 16px;"></i> CALENDAR</a> --}}
                            <div class="table-responsive">
                            <table id="eocTable" class="table">
                                {{-- <table id="bookingsTable" class="table table-striped table-bordered"> --}}
                                    <thead class="table">
                                        <tr>
                                            <th>No</th>
                                            <th>EmployeeID</th>
                                            <th>EmployeeName</th>
                                            <th>Position</th>
                                            <th>JoinDate</th>
                                            <th>ContractType</th>
                                            <th>ContractStart</th>
                                            <th>ContractFinish</th>
                                            <th>CurrentLeaveBalance</th>
                                            <th>Absent</th>
                                            <th>Sick</th>
                                            <th hidden>Performance</th>
                                            <th hidden>Remarks/Extend/Not Extend</th>
                                            <th>Extend Duration</th>
                                            <th>Date Submitted</th>
                                            <th>View Detail</th>
                                            <th>Export to PDF</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- @foreach ($data as $key => $dataeoc)
                                            <tr>
                                                <td>{{ $key+1 + ($data->currentPage() - 1) * $data->perPage() }}</td>
                                                <td class="employeeid">{{ $dataeoc->EmployeeID }}</td>
                                                <td class="employeeName">{{ $dataeoc->EmployeeName }}</td>
                                                <td class="position">{{ $dataeoc->Position }}</td>
                                                <td class="joinDate">{{ $dataeoc->JoinDate }}</td>
                                                <td class="contractType">{{ $dataeoc->ContractType }}</td>
                                                <td class="contractStart">{{ $dataeoc->ContractStart }}</td>
                                                <td class="contractEnd">{{ $dataeoc->ContractEnd }}</td>
                                                <td class="contractFinish">{{ $dataeoc->ContractFinish }}</td>
                                                <td class="currentLeaveBalance">{{ $dataeoc->CurrentLeaveBalance }}</td>
                                                <td class="absent">{{ $dataeoc->Absent }}</td>
                                                <td class="sick">{{ $dataeoc->Sick }}</td>
                                                <td class="extendOptions">
                                                    @if($dataeoc->ExtendOptions)
                                                        {{ $dataeoc->ExtendOptions }}
                                                    @else
                                                        {{ $dataeoc->categoryContract->ContractName ?? '-' }}
                                                    @endif
                                                </td>
                                                <td class="dateSubmitContract">{{ $dataeoc->DateSubmitContract }}</td>
                                                <td>
                                                    <button type="button" class="btn btn-inverse-primary btn-xs view-details" data-bs-toggle="modal" data-bs-target="#varyingModal" data-id="'.$mrr->id.'" title="View Detail"><i data-feather="eye" style="width: 16px; height: 16px;"></i></button>
                                                </td>
                                                <td>
                                                    @if ($dataeoc->DateSubmitContract)
                                                        <a href="{{ route('eoc.export-pdf', $dataeoc->id) }}" class="btn btn-inverse-success btn-xs" title="Export-PDF"><i data-feather="download" style="width: 16px; height: 16px;"></i> PDF</a>
                                                    @else
                                                        <p class="text-secondary">submit form not complete</p>
                                                    @endif
                                                </td>
                                                <td class="performance" hidden>{{ $dataeoc->Performance }}</td>
                                                <td class="remarks" hidden>{{ $dataeoc->Remarks }}</td>
                                                <td class="extendDuration" hidden>{{ $dataeoc->ExtendOptions }}</td>
                                                <td class="category" hidden>{{ $dataeoc->categoryContract->ContractName ?? 'contract extended' }}</td>
                                                <td>
                                                    @if ($dataeoc->DateSubmitContract)
                                                        <button class="btn btn-primary btn-xs" disabled data-bs-toggle="modal" data-bs-target="#approveEOC"
                                                            data-dataeoc-id="{{ $dataeoc->id }}" onclick="loadEocData({{ $dataeoc->id }})">
                                                            <i data-feather="arrow-right-circle" style="width: 16px; height: 16px;"></i> Submit
                                                        </button>
                                                    @else
                                                        <button class="btn btn-primary btn-xs" data-bs-toggle="modal" data-bs-target="#approveEOC"
                                                            data-dataeoc-id="{{ $dataeoc->id }}" onclick="loadEocData({{ $dataeoc->id }})">
                                                            <i data-feather="arrow-right-circle" style="width: 16px; height: 16px;"></i> Submit
                                                        </button>
                                                    @endif
                                                        <a href="#" class="btn btn-danger btn-xs delete-btn" data-id="{{ route('delete.eoc', $dataeoc->id ) }}" title="Delete EOC">
                                                            <i data-feather="trash-2" style="width: 16px; height: 18px;"></i>
                                                        </a>
                                                </td>
                                            <tr>
                                        @endforeach --}}
                                    </tbody>
                                </table>
                                {{-- {{ $data->links('pagination::bootstrap-5') }} --}}
                                {{-- {{ $meetingRooms->appends(['search' => request('search')])->links('pagination::bootstrap-5') }} --}}
                            </div>
                        </div>
                    </div>
                </div>

        </div>
    </div>

<!-- Modal untuk upload -->
<div class="modal fade" id="uploadModal" tabindex="-1" aria-labelledby="uploadModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold text-primary" id="uploadModalLabel">
                    <i data-feather="folder-plus" style="width: 16px; height: 16px;"></i> Import EOC File
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="text-muted">Upload file dalam format <strong>.xlsx</strong> atau <strong>.xls</strong></p>

                <form id="uploadForm" action="{{ route('eocsystem.import') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label fw-bold">Xlsx File Import</label>
                        <div class="input-group">
                            <input type="file" name="file" class="form-control" id="fileInput" accept=".xlsx,.xls">
                            <label class="input-group-text bg-primary text-white" for="fileInput">
                                <i data-feather="folder" style="width: 16px; height: 16px;"></i>
                            </label>
                        </div>
                        <small class="text-danger d-none" id="fileError">Please select files before uploading.</small>
                    </div>

                    <div class="d-flex justify-content-end">
                        <button class="btn btn-primary btn-xs" type="submit" id="uploadButton">
                            <i data-feather="upload" style="width: 16px; height: 16px;"></i> Upload
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Submit -->
<div class="modal fade" id="approveEOC" tabindex="-1" aria-labelledby="approveEOCLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-primary" id="approveEOCModalLabel"><i data-feather="file-text"></i>DETAIL EOC FORM</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="modalContent">
                <!-- Konten modal akan dimuat di sini -->
            </div>
        </div>
    </div>
</div>
{{-- End --}}

<!-- Modal View Detail -->
<div class="modal fade" id="varyingModal" tabindex="-1" aria-labelledby="varyingModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-primary" id="varyingModalLabel"><i data-feather="file-text"></i>DETAIL EOC FORM</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="" action="">
                <div class="modal-body">
                    <div class="row">
                        <!-- Kolom Kiri -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold employeeid">EmployeeID</label>
                                <input type="text" class="form-control employeeid" id="employeeid" disabled>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold employeeName">Employee Name</label>
                                <input type="text" class="form-control employeeName" disabled>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold position">Position</label>
                                <input type="text" class="form-control position" disabled>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold joinDate">Join Date</label>
                                <input type="text" class="form-control joinDate" disabled>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold contractStart">Contract Start</label>
                                <input type="text" class="form-control contractStart" disabled>
                            </div>

                        </div>

                        <!-- Kolom Kanan -->
                        <div class="col-md-6">
                            {{-- <div class="mb-3">
                                <label class="form-label fw-bold contractEnd">Contract End</label>
                                <input type="text" class="form-control contractEnd" disabled>
                            </div> --}}

                            <div class="mb-3">
                                <label class="form-label fw-bold contractType">Contract Type</label>
                                <input type="text" class="form-control contractType" disabled>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold currentLeaveBalance">Current Leave Balance</label>
                                <input type="text" class="form-control currentLeaveBalance" disabled>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold absent">Absent</label>
                                <input type="text" class="form-control absent" disabled>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold sick">Sick</label>
                                <input type="text" class="form-control sick" disabled>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold contractFinish">Contract Finish</label>
                                <input type="text" class="form-control contractFinish" disabled>
                            </div>

                        </div>
                    </div>

                    <b><hr></b>
                        <h6 style="text-align: center;" class="text-success">SUBMITTED FORM BY EACH DEPARTMENT</h6>
                    <b><hr></b>

                    <div class="row">

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold performance">Performance</label>
                                <input type="text" class="form-control performance" disabled>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold category">Category</label>
                                <input type="text" class="form-control category" disabled>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold extendDuration">Extend Duration</label>
                                <input type="text" class="form-control extendDuration" disabled>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold dateSubmitContract">Date Submitted</label>
                                <input type="text" class="form-control dateSubmitContract" disabled>
                            </div>
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label class="form-label fw-bold remarks">Remarks</label>
                        <textarea class="form-control remarks" id="remarks" rows="2" placeholder="" disabled></textarea>
                    </div>

                    <!-- Tombol Submit -->
                    {{-- <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-xs btn-primary">
                            <i data-feather="send" style="width 16px; height: 20px;"></i> Submit
                        </button>
                    </div> --}}
                </form>
            </div>
        </div>
    </div>
</div>
{{-- End --}}

<!-- Modal Konfirmasi Delete -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-danger" id="deleteModalLabel"><i data-feather="trash-2" style="width: 16px; height: 16px;"></i> Confirm Delete</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this data?</p>
            </div>
            <div class="modal-footer">
                <form id="deleteForm"  method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-xs btn-secondary" data-bs-dismiss="modal"><i data-feather="corner-down-left" style="width: 16px; height: 16px;"></i> Cancel</button>
                    <button type="submit" class="btn btn-xs btn-danger"><i data-feather="trash-2" style="width: 16px; height: 16px;"></i> Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
{{-- End --}}

<script>

// Coba with dataTable
$(document).ready(function() {
    var table = $('#eocTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "{{ route('eocsystem.data') }}",
            data: function(d) {
                d.status = $('#filterStatus').val(); // Mengirim status filter ke server
                d.date_from = $('#filterDateFrom').val(); // Mengirim filter tanggal dari
                d.date_to = $('#filterDateTo').val(); // Mengirim filter tanggal ke
                console.log("Data yang dikirim ke server:", d);
            }
        },
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'EmployeeID', name: 'EmployeeID' },
            { data: 'EmployeeName', name: 'EmployeeName' },
            { data: 'Position', name: 'Position' },
            { data: 'JoinDate', name: 'JoinDate' },
            { data: 'ContractType', name: 'ContractType' },
            { data: 'ContractStart', name: 'ContractStart' },
            { data: 'ContractFinish', name: 'ContractFinish' },
            { data: 'CurrentLeaveBalance', name: 'CurrentLeaveBalance' },
            { data: 'Absent', name: 'Absent' },
            { data: 'Sick', name: 'Sick' },
            { data: 'ExtendOptions', name: 'ExtendOptions' },
            { data: 'DateSubmitContract', name: 'DateSubmitContract' },
            { data: 'view-button', name: 'view-button' },
            { data: 'export-pdf', name: 'export-pdf' },
            { data: 'action', name: 'action', orderable: false, searchable: false }
        ],
            drawCallback: function(settings) {
            feather.replace(); // Inisialisasi ulang ikon setelah redraw
        }
    });
    // Event listener untuk dropdown filter
    $('#filterStatus').change(function() {
        table.ajax.reload(); // Reload DataTables setelah filter berubah
    });
    // Event listener untuk filter berdasarkan tanggal
    $('#applyDateFilter').click(function() {
        console.log("Date From:", $('#filterDateFrom').val());
        console.log("Date To:", $('#filterDateTo').val());
        table.ajax.reload(); // Reload DataTables setelah filter tanggal berubah
    });
    // Tombol reset filter untuk mengembalikan semua data
    $('#resetFilter').click(function() {
        $('#filterStatus').val(''); // Reset dropdown status
        $('#filterDateFrom').val(''); // Reset tanggal dari
        $('#filterDateTo').val(''); // Reset tanggal sampai
        // table.ajax.reload(null, false); // Reload tanpa reset pagination
        location.reload();
    });
    $('#exportExcel').click(function() {
        var status = $('#filterStatus').val(); // Ambil status dari filter
        window.location.href = "{{ route('eoc.export-excel') }}?status=" + status;
    });
});

// View Detail tanpap datatable
// $(document).on('click','.view-details', function(){
//     var _this = $(this).parents('tr');
//         $('.employeeid').val(_this.find('.employeeid').text());
//         $('.employeeName').val(_this.find('.employeeName').text());
//         $('.position').val(_this.find('.position').text());
//         $('.joinDate').val(_this.find('.joinDate').text());
//         $('.contractType').val(_this.find('.contractType').text());
//         $('.contractStart').val(_this.find('.contractStart').text());
//         $('.contractEnd').val(_this.find('.contractEnd').text());
//         $('.contractFinish').val(_this.find('.contractFinish').text());
//         $('.currentLeaveBalance').val(_this.find('.currentLeaveBalance').text());
//         $('.absent').val(_this.find('.absent').text());
//         $('.sick').val(_this.find('.sick').text());
//         $('.performance').val(_this.find('.performance').text());
//         $('.remarks').val(_this.find('.remarks').text());
//         $('.category').val(_this.find('.category').text());
//         $('.extendDuration').val(_this.find('.extendDuration').text());
//         $('.dateSubmitContract').val(_this.find('.dateSubmitContract').text());
// });

// View Detail dengan DataTable
$(document).on('click', '.view-details', function () {
    // Ambil data dari atribut tombol
    var employeeID = $(this).data('employeeid');
    var employeeName = $(this).data('employeename');
    var position = $(this).data('position');
    var joinDate = $(this).data('joindate');
    var contractType = $(this).data('contracttype');
    var contractStart = $(this).data('contractstart');
    var contractFinish = $(this).data('contractfinish');
    var currentLeaveBalance = $(this).data('currentleavebalance');
    var absent = $(this).data('absent');
    var sick = $(this).data('sick');
    var performance = $(this).data('performance');
    var remarks = $(this).data('remarks');
    var category = $(this).data('category');
    var extendDuration = $(this).data('extendduration');
    var dateSubmitContract = $(this).data('datesubmitcontract');

    // Isi data ke dalam modal atau form
    $('.employeeid').val(employeeID);
    $('.employeeName').val(employeeName);
    $('.position').val(position);
    $('.joinDate').val(joinDate);
    $('.contractType').val(contractType);
    $('.contractStart').val(contractStart);
    $('.contractFinish').val(contractFinish);
    $('.currentLeaveBalance').val(currentLeaveBalance);
    $('.absent').val(absent);
    $('.sick').val(sick);
    $('.performance').val(performance);
    $('.remarks').val(remarks);
    $('.category').val(category);
    $('.extendDuration').val(extendDuration);
    $('.dateSubmitContract').val(dateSubmitContract);

    // Tampilkan modal
    $('#varyingModal').modal('show');
});


$(document).ready(function () {
    // Validasi sebelum submit form
    $('#uploadButton').on('click', function (event) {
        var fileInput = $('#fileInput')[0].files.length;

        if (fileInput === 0) {
            event.preventDefault(); // Mencegah form submit
            $('#fileError').removeClass('d-none'); // Menampilkan pesan error
        } else {
            $('#fileError').addClass('d-none'); // Sembunyikan pesan error jika file dipilih
        }
    });

    // Hilangkan error saat file dipilih
    $('#fileInput').on('change', function () {
        if (this.files.length > 0) {
            $('#fileError').addClass('d-none'); // Sembunyikan error jika ada file
        }
    });
});

// Delete confirmation modal tanpa DataTable
// document.addEventListener("DOMContentLoaded", function () {
//     const deleteButtons = document.querySelectorAll(".delete-btn");
//     deleteButtons.forEach(button => {
//         button.addEventListener("click", function (event) {
//             event.preventDefault(); // Mencegah navigasi default
//             let deleteUrl = this.getAttribute("data-id");
//             document.getElementById("deleteForm").setAttribute("action", deleteUrl);
//             new bootstrap.Modal(document.getElementById("deleteModal")).show();
//         });
//     });
// });
// End Delete confirmation modal

// Delete Dengan Datatables

$(document).ready(function() {
    var deleteUrl = ''; // Variable untuk menyimpan URL delete

    // Ketika tombol delete diklik
    $(document).on('click', '.delete-btn', function() {
        deleteUrl = $(this).data('id'); // Mendapatkan URL delete dari atribut data-id
        $('#deleteForm').attr('action', deleteUrl); // Mengatur action pada form di dalam modal
        $('#deleteModal').modal('show'); // Menampilkan modal konfirmasi delete
    });

    // Submit form delete saat tombol delete diklik
    $('#deleteForm').on('submit', function(event) {
        event.preventDefault(); // Mencegah submit default

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: $(this).attr('action'), // Menggunakan URL yang telah diset
            type: 'POST', // Laravel DELETE method tetap butuh POST dengan _method
            data: $(this).serialize(),
            success: function(response) {
                if (response.success) {
                    $('#deleteModal').modal('hide'); // Tutup modal jika sukses
                    toastr.success(response.message);
                    $('#eocTable').DataTable().ajax.reload(null, false); // Reload DataTables
                } else {
                    toastr.error(response.message);
                }
            },
            error: function(xhr, status, error) {
                toastr.error('Error deleting data: ' + error);
            }
        });
    });
});

//End


// $(document).ready(function () {
//     $('#approveForm').validate({
//         rules: {
//             Performance: { required: true },
//             Remarks: { required: true },
//             // "facilities[]": { required: true, minlength: 1 }, // Validasi array 
//         },
//         messages: {
//             Performance: { required: 'Please Enter Performance' },
//             Remarks: { required: 'Please Enter Remarks' },
//             // "facilities[]": { required: 'Please select at least one' }, // Tambahkan pesan error\
//         },
//         errorElement: 'span',
//         errorPlacement: function (error, element) {
//             error.addClass('invalid-feedback');
//             error.css('font-size', '12px');  // Menambahkan ukuran font
//             element.closest('.form-group').after(error);;
//         },
//         highlight: function (element, errorClass, validClass) {
//             $(element).addClass('is-invalid');
//         },
//         unhighlight: function (element, errorClass, validClass) {
//             $(element).removeClass('is-invalid');
//         },
//     });
// });

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
                    <form id="approveForm" action="/submit-eoc-form/${data.id}" method="POST">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="_method" value="PATCH">

                        <div class="row">
                            <!-- Kolom Kiri -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label fw-bold">EmployeeID</label>
                                    <input type="text" class="form-control" value="${data.EmployeeID}" disabled>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-bold">Employee Name</label>
                                    <input type="text" class="form-control" value="${data.EmployeeName}" disabled>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-bold">Position</label>
                                    <input type="text" class="form-control" value="${data.Position}" disabled>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-bold">Join Date</label>
                                    <input type="text" class="form-control" value="${data.JoinDate}" disabled>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-bold">Contract Start</label>
                                    <input type="text" class="form-control" name="ContractStart" value="${data.ContractStart}" disabled>
                                </div>

                               

                            </div>

                            <!-- Kolom Kanan -->
                            <div class="col-md-6">
                                <!-- <div class="mb-3">
                                    <label class="form-label fw-bold">Contract End</label>
                                    <input type="text" class="form-control" name="ContractEnd" value="${data.ContractEnd}" disabled>
                                </div> -->

                                 <div class="mb-3">
                                    <label class="form-label fw-bold">Contract Type</label>
                                    <input type="text" class="form-control" value="${data.ContractType}" disabled>
                                </div>
                        
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Current Leave Balance</label>
                                    <input type="text" class="form-control" value="${data.CurrentLeaveBalance}" disabled>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-bold">Absent</label>
                                    <input type="text" class="form-control" value="${data.Absent}" disabled>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-bold">Sick</label>
                                    <input type="text" class="form-control" value="${data.Sick}" disabled>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-bold">Contract Finish</label>
                                    <input type="text" class="form-control" name="ContractFinish" value="${data.ContractFinish}" disabled>
                                </div>
                                
                            </div>
                        </div>

                        <b><hr></b>
                            <h6 style="text-align: center;" class="text-success">SUBMIT FORM BY EACH DEPARTMENT</h6>
                        <b><hr></b>

                         <div class="form-group mb-3">
                            <label class="form-label fw-bold">Performance</label>
                            <input name="Performance" class="form-control" id="performance">
                        </div>

                        <!-- Category Contracts -->
                        <div class="mb-3">
                            <label class="form-label fw-bold">Category Contracts</label>
                            <select name="category_contract_id" class="form-select" id="CategoryContracts">
                                <!-- Options will be dynamically added by JavaScript -->
                            </select>
                        </div>

                        <!-- Extend Options -->
                        <div class="mb-3" id="extendOptions" style="display none;">
                            <label class="form-label fw-bold">Extend Duration</label>
                            <select name="ExtendOptions" class="form-select">
                                <option value="3 Months">3 Months</option>
                                <option value="6 Months">6 Months</option>
                                <option value="9 Months">9 Months</option>
                                <option value="12 Months">12 Months</option>
                                <option value="15 Months">15 Months</option>
                                <option value="18 Months">18 Months</option>
                            </select>
                        </div>

                        <!-- Date Input -->
                        <div class="mb-3">
                            <label class="form-label fw-bold">Date</label>
                            <input type="date" class="form-control" name="DateSubmitContract" value="${data.DateSubmitContract}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold remarks">Remarks</label>
                            <textarea class="form-control" rows="2" name="Remarks" required></textarea>
                        </div>

                        <!-- Tombol Submit -->
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-xs btn-primary">
                                <i data-feather="send" style="width 16px; height: 20px;"></i> Submit
                            </button>
                        </div>
                    </form>
                `);

// Validation form submiited with jquery
$('#approveForm').validate({
        rules: {
            Performance: { required: true },
            Remarks: { required: true },
            category_contract_id: { required: true },
            ExtendOptions: { required: true },
        },
        messages: {
            Performance: { required: 'Please Enter Performance' },
            Remarks: { required: 'Please Enter Remarks' },
            category_contract_id: { required: 'Please Enter Category Contract' },
            ExtendOptions: { required: 'Please Enter Extend Duration' },
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            error.css('font-size', '12px');
            element.closest('.form-group').append(error);
        },
        highlight: function (element) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element) {
            $(element).removeClass('is-invalid');
        },
    });
                
                var categoryContracts = $('#CategoryContracts');
                    categoryContracts.empty(); // Kosongkan select agar tidak ada duplikasi

                    // Tambahkan opsi dinamis dari data.category
                    data.category.forEach(function(categories) {
                        var selected = (categories.id == data.CategoryContract) ? 'selected' : '';
                        categoryContracts.append(`
                            <option value="${categories.id}" ${selected}>
                                ${categories.ContractName}
                            </option>
                        `);
                    });

                    // Tambahkan opsi "Extend" hanya jika belum ada
                    // if (categoryContracts.find('option[value="Extend"]').length === 0) {
                    //     categoryContracts.prepend('<option value="Extend">Extend</option>'); // Tambahkan di atas
                    // }

                    if ($('#CategoryContracts').find('option[value="extend"]').length === 0) {
                        $('#CategoryContracts').prepend('<option value="extend">Extend</option>'); // Tambahkan Extend dengan value kosong
                    }

                // Cek jika tombol berhasil ditambahkan atau diubah
                feather.replace();
                // Event listener ketika CategoryContract dipilih
                function checkExtendOptions() {
                    if ($('#CategoryContracts').val() === 'extend') {
                        $('#extendOptions').show();
                    } else {
                        $('#extendOptions').hide();
                    }
                }

                // Panggil fungsi langsung setelah select diisi
                checkExtendOptions();

                // Tambahkan event listener agar tetap berjalan saat user mengubah pilihan
                $('#CategoryContracts').on('change', function () {
                    checkExtendOptions();
                });
            },
            error: function() {
                $('#modalContent').html('<p>Error loading booking details.</p>');
            }
        });
    }
</script>

{{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
<script>
    $(document).on("click", ".approve-btn", function() {
    var eocID = $(this).attr("data-eocid"); 
    // var dateSubmit = $(this).attr("data-DateSubmitContract"); 

    console.log("eocID:", eocID); // Debugging

    if (!eocID) {
        alert("Error: ID tidak ditemukan!");
        return;
    }

    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
        }
    });

    $.ajax({
        url: `/submit-eoc-form/${eocID}`,
        type: "POST",
        data: {
            _method: "PATCH", 
            // DateSubmitContract: dateSubmit,
        },
        success: function(response) {
            console.log("Success:", response);

            // Menonaktifkan tombol setelah submit berhasil
            $(".approve-btn").prop("disabled", true);  // Disable tombol submit
            $(".approve-btn").text("Submitted");  // Ganti teks tombol untuk menandakan form sudah disubmit

            window.location.reload();
        },
        error: function(xhr) {
            alert("Failed to submit form. Please try again.");
            console.log("Status Code:", xhr.status);
            console.log(xhr.responseText);
        }
    });
});

$('#approveForm').on('submit', function (event) {
    event.preventDefault(); // Mencegah reload halaman

    let formData = $(this).serializeArray(); // Ambil semua data dalam form
    let selectedCategory = $('#CategoryContracts').val();

    // Jika bukan "Extend", hapus ExtendOptions dari data yang dikirim
    if (selectedCategory !== 'Extend') {
        formData = formData.filter(field => field.name !== 'ExtendOptions');
    }

    $.ajax({
        url: $(this).attr('action'),
        type: "POST",
        data: formData,
        success: function (response) {
            console.log("Success:", response);
            window.location.reload(); // Refresh halaman setelah sukses
        },
        error: function (xhr) {
            alert("Failed to submit form. Please try again.");
            console.log("Status Code:", xhr.status);
            console.log(xhr.responseText);
        }
    });
});

</script>


@endsection

