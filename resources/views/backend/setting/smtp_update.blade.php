@extends('admin.admin_dashboard')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<div class="container-xxl flex-grow-1 container-p-y">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item active">
                        <a href="{{route('admin.dashboard')}}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active p-1" aria-current="page">SMTP Settings</li>
                </ol>
            </nav>
        </div>

    </div>
    <!--end breadcrumb-->

    <hr />
    <div class="card">
        <div class="card-header">
            <h3>SMTP Settings</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('smtp.update')}}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{ $smtp->id}}">
                <div class="row mb-3">
                    <div class="col-sm-3">
                        <h6 class="mb-0">Mailler</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                        <input type="text" name="mailer" class="form-control" value="{{$smtp->mailer}}" />
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-3">
                        <h6 class="mb-0">Host</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                        <input type="text" name="host" class="form-control" value="{{$smtp->host}}" />
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-3">
                        <h6 class="mb-0">Port</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                        <input type="text" name="port" class="form-control" value="{{$smtp->port}}" />
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-3">
                        <h6 class="mb-0">Username</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                        <input type="text" name="username" class="form-control" value="{{$smtp->username}}" />
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-3">
                        <h6 class="mb-0">Password</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                        <input type="text" name="password" class="form-control" value="{{$smtp->password}}" />
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-3">
                        <h6 class="mb-0">Encryption</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                        <input type="text" name="encryption" class="form-control" value="{{$smtp->encryption}}" />
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-3">
                        <h6 class="mb-0">From Address</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                        <input type="text" name="from_address" class="form-control" value="{{$smtp->from_address}}" />
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-3"></div>
                    <div class="col-sm-9 text-secondary">
                        <input type="submit" class="btn btn-primary px-4" value="Update" />
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection