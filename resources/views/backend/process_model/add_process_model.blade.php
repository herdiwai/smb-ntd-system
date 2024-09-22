@extends('admin.admin_dashboard')
@section('admin')

<script src="{{ asset('backend/assets/vendors/jquery-ajax/jquery.min.js') }}"></script>

<div class="page-content">

<div class="row">
    <div class="col-md-8 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">FORM INPUT PROCESS & MODEL</h6>
                
                <form id="myForm" method="POST" action="{{ route('store.processmodel') }}" class="forms-sample"">
                    @method('POST')
                    @csrf

                    <div class="form-group mb-3">
                        <label for="exampleInputEmail1" class="form-label">PROCESS</label>
                        <input type="text" name="process" value="{{ old('process') }}" class="form-control">
                    </div>

                    <div class="form-group mb-3">
                        <label for="exampleInputEmail2" class="form-label">MODEL</label>
                        <input type="text" name="model" value="{{ old('model') }}" class="form-control">
                    </div>

                    <button class="btn btn-primary btn-sm" type="submit"><i data-feather="save"></i> SAVE CHANGES</button>
                </form>
            </div>
        </div>
    </div>
</div>
</div>

<script type="text/javascript">
    $(document).ready(function (){
        $('#myForm').validate({
            rules: {
                process: {
                    required : true,
                }, 
                model: {
                    required : true,
                },
                
            },
            messages :{
                process: {
                    required : 'Please Enter Process Name',
                }, 
                model: {
                    required : 'Please Enter Model Name',
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
    
</script>

@endsection