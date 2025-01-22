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

                                            {{-- <select id="lot" name="lot_id" class="form-select form-select-sm">
                                                <option value="">--select lot--</option>
                                                @foreach($lot as $lots)
                                                    <option value="{{ $lots->id }}">{{ $lots->lot }}</option>
                                                @endforeach
                                            </select> --}}
                                            <select id="Meeting_room" name="choose_meeting_room" class="form-select form-select-sm">
                                                <option value="">--select meeting room--</option>
                                                @foreach ($rooms as $room)
                                                    <option value="{{ $room->id }}" 
                                                        {{ in_array($room->id, $unavailableRoomIds) ? 'disabled' : '' }}>
                                                        {{ $room->Lot }} | {{ $room->Room_no }} | {{ $room->Location }} | {{ $room->Usage }} {{ in_array($room->id, $unavailableRoomIds) ? '(Unavailable)' : '' }}
                                                    </option>
                                                @endforeach
                                             </select>
                                            {{-- @foreach ($rooms as $room)
                                                <option value="{{ $room->id }}" 
                                                    {{ in_array($room->id, $unavailableRoomIds) ? 'disabled' : '' }}>
                                                    {{ $room->name }} {{ in_array($room->id, $unavailableRoomIds) ? '(Unavailable)' : '' }}
                                                </option>
                                            @endforeach --}}


                                            {{-- <select id="Meeting_room" name="choose_meeting_room" class="form-select form-select-sm">
                                                <option value="">--select meeting room--</option>
                                                @foreach($room_list as $room_meeting_list)
                                                    <option value="{{ $room_meeting_list->id }}">{{ $room_meeting_list->Lot }} | {{ $room_meeting_list->Room_no }} | {{ $room_meeting_list->Location }} | {{ $room_meeting_list->Usage }}</option>
                                                @endforeach
                                            </select>                  --}}
                                
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

                        {{-- <div class="row">
                            <div class="col-md-12 mb-3">
                                <div class="form-group">
                                    <div class="row align-items-center mt-3">
                                        <div class="col-4">
                                            <label class="col-form-label col-form-label-sm"><b>Choose Meeting Room:</b></label>
                                        </div>
                                        <div class="col-8">
                                            <div class="form-check mb-2">
                                                <input class="form-check-input" type="checkbox" value="option1" id="option1" name="options[]">
                                                <label class="form-check-label" for="option1">B | Room 1 | GF | Internal & External</label>
                                            </div>
                                            <div class="form-check mb-2">
                                                <input class="form-check-input" type="checkbox" value="option2" id="option2" name="options[]">
                                                <label class="form-check-label" for="option2">C | Room 1 | GF | Internal & External</label>
                                            </div>
                                            <div class="form-check mb-2">
                                                <input class="form-check-input" type="checkbox" value="option3" id="option3" name="options[]">
                                                <label class="form-check-label" for="option3">C | Room 2 | GF | Internal & External</label>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> --}}

                        


                        
                        
                        

                        

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection