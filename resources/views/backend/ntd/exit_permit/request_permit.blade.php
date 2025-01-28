@extends('admin.admin_dashboard')
@section('admin')
<div class="page-content">
    <div class="row justify-content-center">
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title"><b>COMPANY EXIT PERMIT FORM </b></h6>
                    <form id="myForm" action="" method="POST">
                        @method('POST')
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection