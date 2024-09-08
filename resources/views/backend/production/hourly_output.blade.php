@extends('admin.admin_dashboard')
@section('admin')

<div class="page-content">
  
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <a href="{{ route('add.hourlyoutput') }}" class="btn btn-inverse-info btn-sm""><i data-feather="plus-square"></i> Add Hourly Output</a>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
                <div class="btn-group">

                    <form action="{{ route('excel.export.file') }}" method="GET">

                        <label for="start_date" >Start Date:</label>
                        <input type="date" class="btn btn-secondary btn-sm" name="start_date" id="start_date" required>
                    
                        <label for="end_date">End Date:</label>
                        <input type="date" class="btn btn-secondary btn-sm" name="end_date" id="end_date" required>
                        &nbsp;

                        <select class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="inlineFormCustomSelect" name="model">
                            <option value="">MODEL</option>
                            @foreach($model as $models)
                                <option value="{{ $models }}" {{ old('model') == $models ? 'selected' : '' }}>{{ $models }}</option>
                        @endforeach
                        </select>
                        &nbsp;

                        <select class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="inlineFormCustomSelect" name="process">
                            <option value="">PROCESS</option>
                            @foreach($process as $process)
                                <option value="{{ $process }}" {{ old('process') == $process ? 'selected' : '' }}>{{ $process }}</option>
                        @endforeach
                        </select>
                        &nbsp;

                        <select class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="inlineFormCustomSelect" name="lot">
                            <option value="">LOT</option>
                            @foreach($lot as $lot)
                                <option value="{{ $lot }}" {{ old('lot') == $lot ? 'selected' : '' }}>{{ $lot }}</option>
                        @endforeach
                        </select>
                        &nbsp;
            
                        <select class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="inlineFormCustomSelect" name="shift">
                            <option value="">SHIFT</option>
                            @foreach($shift as $shift)
                                <option value="{{ $shift }}" {{ old('shift') == $shift ? 'selected' : '' }}>{{ $shift }}</option>
                        @endforeach
                        </select>
                        &nbsp;

                        <select class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="inlineFormCustomSelect" name="line">
                            <option value="">LINE</option>
                            @foreach($line as $line)
                                <option value="{{ $line }}" {{ old('line') == $line ? 'selected' : '' }}>{{ $line }}</option>
                        @endforeach
                        </select>
                        &nbsp;

                        <button type="submit" class="btn btn-inverse-success btn-sm" ><i data-feather="download"></i> Export Excel</button>
                        &nbsp;
                        <a href="{{ url('/production/hourlyoutput') }}" class="btn btn-inverse-warning btn-sm" title="Refresh"><i data-feather="refresh-ccw"></i></a>
                        
                    </form>

            </div>
          </div>
        </div>
      </div>

      {{-- // filter  --}}
      {{-- <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
                <div class="btn-group">

                    <form action="{{ route('filter.hourlyoutput') }}" method="GET">

                        <label for="start_date" >Start Date:</label>
                        <input type="date" class="btn btn-secondary btn-sm" name="start_date" id="start_date" required>
                    
                        <label for="end_date">End Date:</label>
                        <input type="date" class="btn btn-secondary btn-sm" name="end_date" id="end_date" required>
                        &nbsp;

                        {{-- <select class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="inlineFormCustomSelect" name="model">
                            <option value="">MODEL</option>
                            @foreach($models as $model)
                                <option value="{{ $model }}" {{ old('models') == $model ? 'selected' : '' }}>{{ $model }}</option>
                        @endforeach
                        </select>
                        &nbsp; --}}

                        {{-- <select class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="inlineFormCustomSelect" name="model">
                            <option value="">MODEL</option>
                            @foreach($a as $bbb)
                                <option value="{{ $bbb }}" {{ old('a') == $bbb ? 'selected' : '' }}>{{ $bbb }}</option>
                        @endforeach
                        </select>
                        &nbsp; --}}

                        {{-- <select class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="inlineFormCustomSelect" name="process">
                            <option value="">PROCESS</option>
                            @foreach($processs as $process)
                                <option value="{{ $process }}" {{ old('processs') == $process ? 'selected' : '' }}>{{ $process }}</option>
                        @endforeach
                        </select>
                        &nbsp;

                        <select class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="inlineFormCustomSelect" name="lot">
                            <option value="">LOT</option>
                            @foreach($lots as $lot)
                                <option value="{{ $lot }}" {{ old('lots') == $lot ? 'selected' : '' }}>{{ $lot }}</option>
                        @endforeach
                        </select>
                        &nbsp;
            
                        <select class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="inlineFormCustomSelect" name="shift">
                            <option value="">SHIFT</option>
                            @foreach($shifts as $shift)
                                <option value="{{ $shift }}" {{ old('shifts') == $shift ? 'selected' : '' }}>{{ $shift }}</option>
                        @endforeach
                        </select>
                        &nbsp;

                        <select class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="inlineFormCustomSelect" name="line">
                            <option value="">LINE</option>
                            @foreach($lines as $line)
                                <option value="{{ $line }}" {{ old('lines') == $line ? 'selected' : '' }}>{{ $line }}</option>
                        @endforeach
                        </select>
                        &nbsp;

                        <button type="submit" class="btn btn-inverse-success btn-sm" ><i data-feather="filter"></i> Filter</button>
                        &nbsp;
                        <a href="{{ url('/production/hourlyoutput') }}" class="btn btn-inverse-warning btn-sm" title="Refresh"><i data-feather="refresh-ccw"></i></a>
                        
                    </form> --}}

            {{-- </div>
          </div>
        </div>
      </div> --}} 
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Production Hourly Output</h6>
                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                            <tr>
                                    <th>No</th>
                                    <th>DATE</th>
                                    <th>PROCESS</th>
                                    <th>MODEL</th>
                                    <th>LOT</th>
                                    <th>SHIFT</th>
                                    <th>LINE</th>
                                    <th>TIME</th>
                                    <th>TARGET</th> 
                                    <th>OUTPUT</th>
                                    <th>ACCM</th>
                                    <th>DESCRIPTION</th>
                                    <th>PIC</th>
                                    <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($pd as $key => $production)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $production->date }}</td>
                                        <td>{{ $production->process }}</td>
                                        <td>{{ $production->model }}</td>
                                        <td>{{ $production->lot }}</td>
                                        <td>{{ $production->shift }}</td>
                                        <td>{{ $production->line }}</td>
                                        <td>{{ $production->time }}</td>
                                        <td>{{ $production->target }}</td>
                                        <td>{{ $production->output }}</td>
                                        <td>{{ $production->accm }}</td>
                                        <td>{{ $production->deskription }}</td>
                                        <td>{{ $production->name }}</td>
                                        <td>
                                            @if(Auth::user()->can('hourlyoutput.edit'))
                                                <a href="{{ route('edit.hourlyoutput', $production->id) }}" class="btn btn-inverse-warning" title="Edit"><i data-feather="edit"></i></a>
                                            @endif
                                            <a href="{{ route('delete.hourlyoutput', $production->id) }}" class="btn btn-inverse-danger" title="Delete"><i data-feather="trash-2"></i></a>
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