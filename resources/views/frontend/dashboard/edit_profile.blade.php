@extends('frontend.main_master')
@section('main')

@php
$id = Auth::user()->id;
$profileData = App\Models\User::find($id);
@endphp
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<!-- Single Page Header start -->
<div class="container-fluid page-header py-5">
    <ol class="breadcrumb justify-content-center mb-0">
        <li class="breadcrumb-item">
            <h5><a href="{{url('/')}}">Trang Chủ</a></h5>
        </li>
        <li class="breadcrumb-item active text-white">Tài Khoản</li>
    </ol>
</div>
<!-- Single Page Header End -->


<!-- Checkout Page Start -->
<div class="container-fluid py-5">
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-4">
                @include('frontend.dashboard.user_menu')
            </div>
            <div class="col-lg-8">
                <section class="checkout-area pb-70">
                    <div class="container">
                        <form action="{{ route('profile.store')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-lg-12 col-md-12">
                                    <div class="billing-details">
                                        <h3 class="title">User Profile </h3>
                                        <div class="row">
                                            <div class="col-md-6 mb-2">
                                                <div class="form-group">
                                                    <label> Name <span class="required">*</span></label>
                                                    <input type="text" name="name" class="form-control"
                                                        value="{{ $profileData->name}}">
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-2">
                                                <div class="form-group">
                                                    <label>Email <span class="required">*</span></label>
                                                    <input type="email" name="email" class="form-control"
                                                        value="{{ $profileData->email}}" disabled>
                                                </div>
                                            </div>

                                            <div class="col-md-6 mb-2">
                                                <div class="form-group">
                                                    <label>Address <span class="required">*</span></label>
                                                    <input type="text" name="address" class="form-control"
                                                        value="{{ $profileData->address}}">
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-2">
                                                <div class="form-group">
                                                    <label>Phone<span class="required">*</span></label>
                                                    <input type="text" name="phone" class="form-control"
                                                        value="{{ $profileData->phone}}">
                                                </div>
                                            </div>

                                            <div class="col-md-12 mb-2">
                                                <div class="form-group">
                                                    <label>User Profile <span class="required">*</span></label>
                                                    <input type="file" class="form-control" name="photo" id="image">
                                                </div>
                                            </div>
                                            <div class="col-md-12 mb-2">
                                                <img id="showImage"
                                                    src="{{(!empty($profileData->photo)) ? url($profileData->photo) : url('upload/no_image.jpg')}}"
                                                    alt="Admin" class="rounded-circle p-1 bg-primary" width="80">
                                            </div>
                                            <div class="col-md-12 mb-2">
                                                <button type="submit" name="submit" class="btn btn-danger">Save Changes
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>
<!-- Checkout Page End -->
<!-- Service Details Area End -->
<script type="text/javascript">
    // ajax call image upload change img profile
    $(document).ready(function(){
        $('#image').change(function(e){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#showImage').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });
</script>
@endsection