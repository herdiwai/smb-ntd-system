@extends('admin.admin_dashboard')
@section('admin')
<div class="page-content">
    <div class="row justify-content-center">
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title"><b>MEETING ROOM RESERVATION FORM </b></h6>
                    <form id="myForm" action="{{ route('store.request.meetingroom') }}" method="POST">
                        @method('POST')
                        @csrf

                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <div class="form-group">
                                    <div class="row align-items-center">
                                        <div class="col-4">
                                            <label for="request_name" class="col-form-label col-form-label-sm"><b>NAME:</b></label>
                                        </div>
                                        <div class="col-8">
                                            <input type="text" class="form-control form-control-sm" id="request_name" name="Name">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <div class="form-group">
                                    <div class="row align-items-center">
                                        <div class="col-4">
                                            <label for="request_dept" class="col-form-label col-form-label-sm"><b>DEPARTMENT:</b></label>
                                        </div>
                                        <div class="col-8">
                                            <select id="department" name="Department" class="form-select form-select-sm">
                                                <option value="">--select department--</option>
                                                @foreach($department as $departments)
                                                    <option value="{{ $departments }}" {{ old('department') == $departments ? 'selected' : '' }}>{{ $departments }}</option>
                                                @endforeach
                                            </select>
                                            {{-- <input type="text" class="form-control form-control-sm" id="request_dept" name="Department"> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-4">
                                            <label for="description" class="col-form-label col-form-label-sm"><b>MEETING DESCRIPTION:</b></label>
                                        </div>
                                        <div class="col-8">
                                            <textarea class="form-control form-control-sm" name="Description" id="description" rows="2"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <div class="form-group">
                                    <div class="row align-items-center">
                                        <div class="col-4">
                                            <label for="date_booking" class="col-form-label col-form-label-sm"><b>DATE BOOKING:</b></label>
                                        </div>
                                        <div class="col-8">
                                            <div class="input-group flatpickr" id="flatpickr-date">
                                                <input type="text" name="Date_booking" class="form-control" placeholder="--select date--" data-input>
                                                <span class="input-group-text input-group-addon" data-toggle><i data-feather="calendar"></i></span>
                                              </div>
                                            {{-- <input type="date" class="form-control form-control-sm" id="request_dept" name="Date_booking"> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <div class="form-group">
                                    <div class="row align-items-center">
                                        <div class="col-4">
                                            <label for="start_time" class="col-form-label col-form-label-sm"><b>Time:</b></label>
                                        </div>
                                        <div class="col input-group flatpickr" id="flatpickr-time">
                                            <input type="text" class="form-control form-control-sm" name="Start_time" placeholder="Select time" data-input>
                                            <span class="input-group-text input-group-addon" data-toggle><i data-feather="clock"></i></span>
                                            {{-- <input type="time" class="form-control form-control-sm" id="start_time" name="Start_time" min="08:00" max="17:00">
                                            <small class="text-muted">Start: Only 08:00 - 17:00</small> --}}
                                        </div>
                                        <div class="col input-group flatpickr" id="flatpickr-time">
                                            <input type="text" class="form-control form-control-sm" name="End_time" placeholder="Select time" data-input>
                                            <span class="input-group-text input-group-addon" data-toggle><i data-feather="clock"></i></span>
                                            {{-- <input type="time" class="form-control form-control-sm" id="end_time" name="End_time" min="08:00" max="17:00">
                                            <small class="text-muted">End: Only 08:00 - 17:00</small> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <style>
                            .text-danger {
                                color: red;
                                font-weight: bold;
                            }
                        </style>

                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <div class="form-group">
                                    <div class="row align-items-center mt-3">
                                        <div class="col-4">
                                            <label class="col-form-label col-form-label-sm"><b>Choose Meeting Room:</b></label>
                                        </div>
                                        <div class="col-8">
                                            <select id="Meeting_room" name="choose_meeting_room" class="form-select form-select-sm">
                                                <option value="">--select meeting room--</option>
                                                @foreach($room_list as $room_meeting_list)
                                                    <option value="{{ $room_meeting_list->id }}">{{ $room_meeting_list->Lot }} | {{ $room_meeting_list->Room_no }} | {{ $room_meeting_list->Location }} | {{ $room_meeting_list->Usage }}</option>
                                                @endforeach
                                            </select>                 
                                
                                        </div>
                                        
                                    </div>
                                    
                                </div>
                                
                            </div>
                            <div class="d-flex justify-content-right">
                                <button class="btn btn-primary btn-sm" type="submit">
                                    <i data-feather="send" style="width: 16px; height: 16px;"></i> Booking Submit
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
                
            </div>
        </div>
    </div>
</div>


<!-- Modal notifikasi -->
<div id="notificationModal" class="modal">
    <div class="modal-content">
        <span id="closeModal" class="close">&times;</span>
        <p id="modalMessage">
            The room is already booked at that time. Please choose another time or room</p>
    </div>
</div>


<script>
    // Function to show modal
    function openModal(message) {
        document.getElementById('modalMessage').innerText = message;
        document.getElementById('notificationModal').style.display = "block"; // Show modal
    }

    // Close modal
    document.getElementById("closeModal").onclick = function() {
        document.getElementById('notificationModal').style.display = "none"; // Hide modal
    }

    // Close modal when clicking outside of it
    window.onclick = function(event) {
        if (event.target == document.getElementById('notificationModal')) {
            document.getElementById('notificationModal').style.display = "none"; // Hide modal
        }
    }

    // jQuery validation script
    $(document).ready(function () {
    $('#myForm').validate({
        rules: {
            Name: { required: true },
            Department: { required: true },
            Description: { required: true },
            Date_booking: { required: true },
            Start_time: { required: true },
            End_time: { required: true },
            choose_meeting_room: { required: true },
        },
        messages: {
            Name: { required: 'Please Enter Name' },
            Department: { required: 'Please Enter Dept' },
            Description: { required: 'Please Enter Description' },
            Date_booking: { required: 'Please Enter Booking Date' },
            Start_time: { required: 'Please Enter Time' },
            End_time: { required: '' },
            choose_meeting_room: { required: 'Please Select Room' },
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            error.css('font-size', '12px');  // Menambahkan ukuran font
            element.closest('.form-group').after(error);;
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        },
        submitHandler: function(form) {
            // Prevent the default form submission to handle custom logic first
            const formData = new FormData(form);

            // Send AJAX request to check if the room is already booked
            fetch("{{ route('check.booking') }}", {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'error') {
                    // If there's a conflict, show the modal and prevent form submission
                    openModal(data.message);
                } else {
                    // If no conflict, submit the form
                    form.submit();
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }
    });
});
</script>
<!-- CSS Modal -->
<style>
    .modal {
        display: none;
        position: fixed;
        z-index: 1;
        left: 0;
        top: 0;
        width: 115%;
        height: 115%;
        background-color: rgba(0, 0, 0, 0.5);
        overflow: auto;
    }

    .modal-content {
        background-color: #18284e;
        margin: 10% auto;  /* Kurangi margin agar modal lebih mendekati tengah */
        padding: 15px;     /* Kurangi padding agar ukuran modal lebih kompak */
        border: 1px solid #888;
        width: 35%;        /* Ukuran modal lebih kecil, bisa disesuaikan */
        text-align: center;
        border-radius: 5px;
    }

    .close {
        color: #aaa;
        font-size: 18px;   /* Kecilkan ukuran font untuk tombol close */
        font-weight: bold;
        position: absolute;
        top: 5px;          /* Posisikan lebih dekat dengan pojok */
        right: 10px;       /* Posisikan lebih dekat dengan pojok */
    }

    .close:hover,
    .close:focus {
        color: white;      /* Ubah warna saat hover menjadi putih */
        text-decoration: none;
        cursor: pointer;
    }
</style>

{{-- <script>
    const modal = document.getElementById("notificationModal");
    const closeModalButton = document.getElementById("closeModal");
    const bookingForm = document.getElementById("myForm");
    
    // Function to show modal
    function openModal(message) {
        document.getElementById('modalMessage').innerText = message;
        modal.style.display = "block";
        return false; // Menghindari form submission jika modal terbuka
    }

    // Close modal
    closeModalButton.onclick = function() {
        modal.style.display = "none";
    }

    // Close modal when clicking outside of it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }

    // Handle form submission with validation
    bookingForm.addEventListener("submit", function(event) {
        event.preventDefault();  // Mencegah pengiriman form langsung

        const formData = new FormData(bookingForm);

        // Kirim permintaan AJAX untuk pengecekan booking
        fetch("{{ route('check.booking') }}", {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'error') {
                // Jika ada konflik, tampilkan modal dan jangan submit form
                openModal(data.message);
            } else {
                // Jika tidak ada konflik, submit form
                bookingForm.submit();  // Ini hanya akan dipanggil jika tidak ada konflik
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    });
</script> --}}



{{-- <script type="text/javascript">
    $(document).ready(function (){
        $('#myForm').validate({
            rules: {
                Name: {
                    required : true,
                }, 
                Department: {
                    required : true,
                }, 
                Description: {
                    required : true,
                }, 
                Date_booking: {
                    required : true,
                }, 
                Start_time: {
                    required : true,
                }, 
                End_time: {
                    required : true,
                }, 
                choose_meeting_room: {
                    required : true,
                }, 
                
                
            },
            messages :{
                Name: {
                    required : 'Please Enter Name',
                },
                Department: {
                    required : 'Please Enter Dept',
                },
                Description: {
                    required : 'Please Enter Description',
                },
                Date_booking: {
                    required : 'Please Enter Booking_date',
                },
                Start_time: {
                    required : 'Please Enter Time',
                },
                End_time: {
                    required : '',
                },
                choose_meeting_room: {
                    required : 'Please Enter Choose_meeting_room',
                },
                
                
            },
            errorElement : 'span', 
            errorPlacement: function (error,element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight : function(element, errorClass, validClass){
                $(element).addClass('is-invalid');
            },
            unhighlight : function(element, errorClass, validClass){
                $(element).removeClass('is-invalid');
            },
        });
    });
</script> --}}



@endsection