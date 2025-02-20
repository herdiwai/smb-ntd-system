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
                                    <i data-feather="file-text" ></i> Import Result Data
                                </h2>
                                <button class="btn btn-inverse-warning btn-xs mb-3" data-bs-toggle="modal" data-bs-target="#uploadModal">
                                    <i data-feather="upload" style="width: 16px; height: 20px;"></i> Upload File
                                </button>
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
                                            <th>ContractEnd</th>
                                            <th>ContractFinish</th>
                                            <th>CurrentLeaveBalance</th>
                                            <th>Absent</th>
                                            <th>Sick</th>
                                            <th>Performance</th>
                                            <th>Remarks/Extend/Not Extend</th>
                                            <th>Date Submitted</th>
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
                                                <td>
                                                    @if($dataeoc->ExtendOptions)
                                                        {{ $dataeoc->ExtendOptions }}
                                                    @else
                                                    {{ $dataeoc->categoryContract->ContractName ?? '-' }}
                                                    @endif
                                                </td>
                                                <td>{{ $dataeoc->DateSubmitContract }}</td>

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

<!-- Modal untuk upload -->
<div class="modal fade" id="uploadModal" tabindex="-1" aria-labelledby="uploadModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold text-primary" id="uploadModalLabel">
                    <i class="fas fa-file-upload"></i> Import EOC File
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
                                <i class="fas fa-folder-open"></i>
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

<!-- Modal Detail -->
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
                <form id="deleteForm" method="POST">
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

// Delete confirmation modal
document.addEventListener("DOMContentLoaded", function () {
    const deleteButtons = document.querySelectorAll(".delete-btn");
    deleteButtons.forEach(button => {
        button.addEventListener("click", function (event) {
            event.preventDefault(); // Mencegah navigasi default
            let deleteUrl = this.getAttribute("data-id");
            document.getElementById("deleteForm").setAttribute("action", deleteUrl);
            new bootstrap.Modal(document.getElementById("deleteModal")).show();
        });
    });
});
// End Delete confirmation modal

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
                                    <label class="form-label fw-bold">Contract Type</label>
                                    <input type="text" class="form-control" value="${data.ContractType}" disabled>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-bold">Contract Start</label>
                                    <input type="text" class="form-control" name="ContractStart" value="${data.ContractStart}" disabled>
                                </div>
                            </div>

                            <!-- Kolom Kanan -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Contract End</label>
                                    <input type="text" class="form-control" name="ContractEnd" value="${data.ContractEnd}" disabled>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-bold">Contract Finish</label>
                                    <input type="text" class="form-control" name="ContractFinish" value="${data.ContractFinish}" disabled>
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
                            </div>
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

                        <!-- Tombol Submit -->
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-xs btn-primary">
                                <i data-feather="send" style="width 16px; height: 20px;"></i> Submit
                            </button>
                        </div>
                    </form>
                `);
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

