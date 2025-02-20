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
        
        <div class="row">
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
        </div>

        <br>

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
                            <h4 class="card-title">EOC System Table</h4>
                            <h5 class="card-title fw-bold text-success"><i class="fas fa-table"></i> Import Result Data</h5>
                                {{-- <a href="" class="btn btn-inverse-primary btn-xs"><i data-feather="calendar" style="width: 16px; height: 16px;"></i> CALENDAR</a> --}}
                            <div class="table-responsive">
                            <table id="eocTable" class="table table-striped table-hover">
                                {{-- <table id="bookingsTable" class="table table-striped table-bordered"> --}}
                                    <thead class="table-dark">
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
                                                            <i data-feather="check-circle" style="width: 16px; height: 20px;"></i> CHECK
                                                        </button>
                                                    @else
                                                        <button class="btn btn-primary btn-xs" data-bs-toggle="modal" data-bs-target="#approveEOC"
                                                            data-dataeoc-id="{{ $dataeoc->id }}" onclick="loadEocData({{ $dataeoc->id }})">
                                                            <i data-feather="check-circle" style="width: 16px; height: 20px;"></i> CHECK
                                                        </button>
                                                    @endif
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

   // Menangani form submit
    $('#uploadForm').on('submit', function (event) {
        event.preventDefault(); // Mencegah form untuk submit secara default

        // Mengambil file dari input
        var fileInput = $('#fileInput')[0].files;

        // Jika tidak ada file yang dipilih
        if (fileInput.length === 0) {
            // Tampilkan pesan error
            $('#fileError').removeClass('d-none');
        } else {
            // Sembunyikan pesan error jika file sudah dipilih
            $('#fileError').addClass('d-none');

            // Kirim form jika valid
            this.submit();
        }
    });

    // Menangani perubahan pada input file
    $('#fileInput').on('change', function () {
        var fileInput = $(this)[0].files;

        // Jika file dipilih, sembunyikan pesan error
        if (fileInput.length > 0) {
            $('#fileError').addClass('d-none');
        }
    });


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
                            <input type="text" class="form-control" value="${data.JoinDate}" disabled>
                        </div>

                        <div class="mb-3">
                            <label class="form-label"><b>ContractType:</b></label>
                            <input type="text" class="form-control" value="${data.ContractType}" disabled>
                        </div>

                        <div class="mb-3">
                            <label class="form-label"><b>ContractStart:</b></label>
                            <input type="text" class="form-control" name="ContractStart" value="${data.ContractStart}" disabled>
                        </div>

                        <div class="mb-3">
                            <label class="form-label"><b>ContractEnd:</b></label>
                            <input type="text" class="form-control" name="ContractEnd" value="${data.ContractEnd}" disabled>
                        </div>

                        <div class="mb-3">
                            <label class="form-label"><b>ContractFinish:</b></label>
                            <input type="text" class="form-control" name="ContractFinish" value="${data.ContractFinish}" disabled>
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

                       <!-- <div class="mb-3">
                            <label class="form-label"><b>Performance:</b></label>
                            <input type="text" class="form-control" value="${data.Performance}" disabled>
                        </div>

                        <div class="mb-3">
                            <label class="form-label"><b>Remarks:</b></label>
                            <textarea class="form-control" rows="2" disabled>${data.Remarks}</textarea>
                        </div> -->

                        <div class="mb-3">
                            <label class="form-label"><b>Category Contracts:</b></label>
                            <select name="category_contract_id" class="form-select" id="CategoryContracts">
                                <!-- Options will be dynamically added by JavaScript -->
                            </select>
                        </div>

                        <div class="mb-3" id="extendOptions" style="display: none;">
                            <label class="form-label"><b>Extend Duration:</b></label>
                            <select name="ExtendOptions" class="form-select">
                                <option value="3 Months">3 Months</option>
                                <option value="6 Months">6 Months</option>
                                <option value="9 Months">9 Months</option>
                                <option value="12 Months">12 Months</option>
                                <option value="15 Months">15 Months</option>
                                <option value="18 Months">18 Months</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label"><b>Date:</b></label>
                            <input type="date" class="form-control" name="DateSubmitContract" value="${data.DateSubmitContract}" required>
                        </div>

                        <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary me-2">
                                    <i data-feather="check-circle"></i> Submit
                                </button>
                            
                        </div>

                    </form>
                `);
                 // Menambahkan options untuk meeting room
                //  var categoryContracts = $('#CategoryContracts');
                // data.category.forEach(function(categories) {
                //     var selected = (categories.id == data.CategoryContract) ? 'selected' : '';
                //     categoryContracts.append(`
                //         <option value="${categories.id}" ${selected}>
                //             ${categories.ContractName}
                //         </option>
                //     `);
                // });
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
                $('#CategoryContracts').on('change', function () {
                    if ($(this).val() === 'extend') {  // Periksa jika value adalah "extend"
                        $('#extendOptions').show();  // Tampilkan opsi perpanjangan
                    } else {
                        $('#extendOptions').hide();  // Sembunyikan jika bukan Extend
                    }
                });
            },
            error: function() {
                $('#modalContent').html('<p>Error loading booking details.</p>');
            }
        });
    }

</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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