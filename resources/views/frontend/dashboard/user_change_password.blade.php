@extends('frontend.main_master')
@section('main')

<!-- Single Page Header start -->
<div class="container-fluid page-header py-5">
    <ol class="breadcrumb justify-content-center mb-0">
        <li class="breadcrumb-item"><a href="{{ url('/')}}"><h2>Trang Chủ</h2></a></li>
        <li class="breadcrumb-item">Tài Khoản</li>
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
                <div class="row">
                    <section class="checkout-area pb-70">
                        <div class="container">
                            <form action="{{ route('password.change.store')}}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 m-2">
                                        <div class="billing-details">
                                            <h3 class="title">User Change Password</h3>
                                            <div class="row">
                                                <div class=" col-md-12 m-2">
                                                    <div class="form-group">
                                                        <label> Old Password <span class="required">*</span></label>
                                                        <input type="password" name="old_password" class="form-control">
                                                        @error('old_password')
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-12 m-2">
                                                    <div class="form-group">
                                                        <label> New Password <span class="required">*</span></label>
                                                        <input type="password" name="new_password" class="form-control">
                                                        @error('new_password')
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-12 m-2">
                                                    <div class="form-group">
                                                        <label>Confirm New Password <span
                                                                class="required">*</span></label>
                                                        <input type="password" name="new_password_confirmation"
                                                            class="form-control">
                                                        @error('new_password_confirmation')
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-12 m-2">
                                                    <button type="submit" name="submit" class="btn btn-danger">Save
                                                        Changes </button>
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
</div>
<!-- Checkout Page End -->
@endsection