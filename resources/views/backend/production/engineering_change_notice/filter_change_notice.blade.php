@extends('admin.admin_dashboard')
@section('admin')
    <style>
        .table .form-control,
        .table .form-select {
        width: auto; /* Agar input dan select tidak memakan seluruh lebar */
        margin-right: 10px; /* Jarak antara elemen */
        }
    </style>

<div class="page-content">
    <div class="row">
        <form action="{{ route('filter.ProcessChangeNotice') }}" method="GET" class="mb-3">
            @csrf
            @method('GET')

            <div class="row">
                <!-- Filter by Date -->
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="date">from date:</label>
                        <input type="date" name="from_date" id="date" class="form-control form-control-xs">
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        <label for="date">to date:</label>
                        <input type="date" name="to_date" id="date" class="form-control form-control-xs">
                    </div>
                </div>

                <!-- Filter by Model -->
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="model">Model:</label>
                        <select name="model_id" id="model" class="form-select form-select-xs">
                            <option value="">--select model--</option>
                            @foreach($modelbrewer as $models)
                                <option value="{{ $models->id }}" {{ old('modelbrewer') == $models->id ? 'selected' : '' }}>{{ $models->model }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Filter by Lot -->
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="lot">Lot:</label>
                        <select name="lot_id" id="lot" class="form-select form-select-xs">
                            <option value="">--select lot--</option>
                            @foreach($lot as $lots)
                                <option value="{{ $lots->id }}" {{ old('lot_id') == $lots->id ? 'selected' : '' }}>{{ $lots->lot }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Filter by Line -->
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="lot">Line:</label>
                        <select name="line_id" id="line" class="form-select form-select-xs">
                            <option value="">--select line--</option>
                            @foreach($line as $lines)
                                <option value="{{ $lines->id }}" {{ old('line_id') == $lines->id ? 'selected' : '' }}>{{ $lines->line }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Filter by shift -->
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="shift">shift:</label>
                        <select name="shift_id" id="shift" class="form-select form-select-xs">
                            <option value="">--select shift--</option>
                            @foreach($shift as $shifts)
                                <option value="{{ $shifts->id }}" {{ old('shift_id') == $shifts->id ? 'selected' : '' }}>{{ $shifts->shift }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                
                <div class="col-md-2 align-self-end mt-3"> <!-- Tambahkan kelas 'mt-3' di sini -->
                    <button type="submit" class="btn btn-info btn-xs">
                        <i data-feather="search" style="width: 16px; height: 16px;"></i> Search..
                    </button>
                    <a href="{{ route('filter.ProcessChangeNotice') }}" class="btn btn-light btn-xs" style="position: absolute; margin-left:1%;">
                        <i data-feather="refresh-ccw" style="width: 16px; height: 16px;"></i> Refresh
                    </a>
                </div>

            </div>
        </form>
    </div>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title"> ENGINEERING CHANGE NOTICE RECORD FORM</h6>
                    <div class="table-responsive">
                        <table id="" class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>DATE</th>
                                    <th>MODEL</th>
                                    <th>CHANGE NOTICE</th>
                                    <th>LINE</th>
                                    <th>SHIFT</th>
                                    <th>LOT</th>
                                    <th>SO NO.</th>
                                    <th>CO NO.</th>
                                    <th>WEEK</th>
                                    <th>IMPLEMENT DATECODE</th>
                                    <th>CON NO.</th>
                                    <th>SAH KEY</th>
                                    <th>CON NAME</th>
                                    <th>SN FIRST</th>
                                    <th>PIC</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($engineeringchangenotice->isEmpty())
                                        <tr>
                                            <td colspan="3" style="color: red;">No data found, please filter data first</td>
                                        </tr>
                                    @else
                                @foreach ($engineeringchangenotice as $key => $production)
                                    <tr>
                                        <td>{{ $loop->iteration + ($engineeringchangenotice->currentPage() - 1) * $engineeringchangenotice->perPage() }}</td>
                                        <td>{{ $production->date }}</td>
                                    <td>{{ $production->modelBrewer->model }}</td>
                                    <td>
                                        {{ $production->change_notice }}<br>
                                        Dari: {{ $production->change_from_notice }}<br>
                                        To: {{ $production->change_to_notice }}
                                    </td>
                                    <td>{{ $production->lines->line }}</td>
                                    <td>{{ $production->shifts->shift }}</td>
                                    <td>{{ $production->lots->lot }}</td>
                                    <td>{{ $production->so_no }}</td>
                                    <td>{{ $production->co_no }}</td>
                                    <td>{{ $production->week }}</td>
                                    <td>
                                        {{ $production->implement_datecode }}<br>
                                        Dari: {{ $production->change_from_datecode }}<br>
                                        To: {{ $production->change_to_datecode }}
                                    </td>
                                    <td>{{ $production->con_no }}</td>
                                    <td>{{ $production->sah_key }}</td>
                                    <td>{{ $production->con_name }}</td>
                                    <td>{{ $production->sn_awal }}<br>
                                        {{ $production->sn_rndm }}
                                    </td>
                                    <td>{{ $production->pic }}</td>
                                        
                                    </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                        {{ $engineeringchangenotice->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection