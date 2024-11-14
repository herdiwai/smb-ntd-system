@extends('admin.admin_dashboard')
@section('admin')

<div class="page-content">
    
   
{{-- <nav class="page-breadcrumb">
        <ol class="breadcrumb">
             <a href="" class="btn btn-inverse-info btn-sm"><i data-feather="plus-square"></i> Add Report Form</a>
        </ol>
    </nav> --}}
    {{-- <div class="row"> --}}

        <div class="col-md-4 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Form Input Equipment</h6>
                    
                    <form action="{{ route('add.equipment') }}" method="POST">
                        @csrf
                        <div class="row">
                                
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <div class="form-row align-items-center">
                                        <div class="col-sm">
                                            <label for="to_department" class="col-form-label col-form-label-sm"><b>Equipment Name</b></label>
                                        </div>
                                        <div class="col">
                                            <input type="text" class="form-control form-control-sm" id="noOfSample" name="Equipment_Name">
                                        </div>
                                    </div>
                                    <br>
                                    <button class="btn btn-primary btn-sm" type="submit"><i data-feather="save" style="width: 16px; height: 16px;"></i> SAVE</button>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <div class="form-row align-items-center">
                                        <div class="col-sm">
                                            <label for="lot" class="col-form-label col-form-label-sm"><b>Equipment Number</b></label>
                                        </div>
                                        <div class="col">
                                            <input type="text" class="form-control form-control-sm" id="noOfSample" name="Equipment_Number">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>    
                    </form>

                </div>
            </div>
        </div>

    <div class="row">
        <div class="col-sm-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Table Equipment NTD</h6>
                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                            <tr>
                                    <th>No</th>
                                    <th>Equipment Name</th>
                                    <th>Equipment Number</th>
                                    <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($equipmentName as $key => $items)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $items->Equipment_Name }}</td>
                                        <td>{{ $items->Equipment_Number }}</td>
                                        <td> 
                                            <a href="" class="btn btn-inverse-warning btn-xs" title="Edit"><i data-feather="edit"></i></a>
                                            <a href="" class="btn btn-inverse-danger btn-sm" title="Delete"><i data-feather="trash-2"></i></a>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                        {{-- {{ $equipmentName->links('pagination::bootstrap-5') }} --}}
                    </div>
                </div>
            </div>
        </div>

    </div>



</div>

<script type="text/javascript">

    // Mode QC Accepted
    function openQcAccepted(itemId) {
        // Set the form action dynamically based on the item ID
        var actionUrl = "{{ route('update.qc', ':id') }}";
        actionUrl = actionUrl.replace(':id', itemId);
        $('#qcFormAccepted').attr('action', actionUrl);
        // Optionally reset the form fields when modal is opened
        // $('#approval_status').val('approved'); // default status
        // $('#notes').val('');
        
        // Show the modal
        $('#qcAccepted').modal('show');
    }

</script>


@endsection