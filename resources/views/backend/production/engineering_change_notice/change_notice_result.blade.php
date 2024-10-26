@extends('admin.admin_dashboard')
@section('admin')
<div class="page-content">
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
             <a href="{{ route('add.ChangeNotice') }}" class="btn btn-inverse-info btn-sm"><i data-feather="plus-square"></i> Add ECN Change Notice Form</a>
        </ol>
    </nav>

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
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($ecn as $key => $production)
                                <tr>
                                    <td>{{ $key+1 }}</td>
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
                                    <td> 
                                        <a href="{{ route('edit.ProcessChangeNotice', $production->id) }}" class="btn btn-inverse-warning btn-xs" title="Edit"><i data-feather="edit"></i></a>
                                        <a href="{{ route('delete.ProcessChangeNotice', $production->id) }}" class="btn btn-inverse-danger btn-sm" title="Delete"><i data-feather="trash-2"></i></a>
                                        <a href="{{ route('file.ProcessChangeNotice', $production->id) }}" class="btn btn-inverse-info btn-xs" title="Detail">
                                            <i data-feather="download"></i>
                                        </a>
                                    </td> 
                                    
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $ecn->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection