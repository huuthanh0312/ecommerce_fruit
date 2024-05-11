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
                    <li class="breadcrumb-item active p-1" aria-current="page">Site Settings</li>
                </ol>
            </nav>
        </div>

    </div>
    <!--end breadcrumb-->

    <hr />
    <div class="card">
        <div class="card-header">
            <h3>Site Settings</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('site.setting.update')}}" method="post" id="myForm" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{$site_setting->id}}">
                <div class="modal-body row">
                    <div class="col-md-12">
                        <label for="phone" class="form-label text-dark">Phone</label>
                        <input type="text" name="phone" id="phone" class="form-control"
                            value="{{$site_setting->phone}}" />
                    </div>
                    <div class="col-md-12">
                        <label for="email" class="form-label text-dark">Email</label>
                        <input type="email" name="email" id="email" class="form-control"
                            value="{{$site_setting->email}}" />
                    </div>
                    <div class="col-md-12">
                        <label for="address" class="form-label text-dark">Address</label>
                        <input type="address" name="address" id="address" class="form-control"
                            value="{{$site_setting->address}}" />
                    </div>
                    <div class="col-md-12">
                        <label for="short_desc" class="form-label text-dark">Short Description</label>
                        <textarea type="text" name="short_desc" rows="4" class="form-control">
                            {{$site_setting->short_desc}}</textarea>
                    </div>
                    <div class="col-md-12">
                        <label for="youtube" class="form-label text-dark">Youtube</label>
                        <input type="text" name="youtube" id="youtube" class="form-control"
                            value="{{$site_setting->youtube}}" />
                    </div>
                    <div class="col-md-12">
                        <label for="facebook" class="form-label text-dark">Facebook</label>
                        <input type="text" name="facebook" id="facebook" class="form-control"
                            value="{{$site_setting->facebook}}" />
                    </div>
                    <div class="col-md-12">
                        <label for="instagram" class="form-label text-dark">Instagram</label>
                        <input type="text" name="instagram" id="instagram" class="form-control"
                            value="{{$site_setting->instagram}}" />
                    </div>
                </div>
                <div class="">
                    <button type="submit" class="btn btn-primary px-3">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>


@endsection