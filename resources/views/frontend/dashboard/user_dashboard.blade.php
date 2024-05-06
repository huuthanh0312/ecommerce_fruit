@extends('frontend.main_master')
@section('main')

<!-- Single Page Header start -->
<div class="container-fluid page-header py-5">
    <h1 class="text-center text-white display-6">Profile Dashboard</h1>
    <ol class="breadcrumb justify-content-center mb-0">
        <li class="breadcrumb-item"><a href="{{ url('/')}}">Home</a></li>
        <li class="breadcrumb-item"><a href="#">Profile</a></li>
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

                    <div class="col-md-4">
                        <div class="card text-white bg-primary mb-3" style="max-width: 18rem;">
                            <div class="card-header">Total Booking</div>
                            <div class="card-body">
                                <h3>3 Total</h3>

                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card text-white bg-warning mb-3" style="max-width: 18rem;">
                            <div class="card-header">Pending Booking </div>
                            <div class="card-body">
                                <h3>3 Pending</h3>

                            </div>
                        </div>
                    </div>


                    <div class="col-md-4">
                        <div class="card text-white bg-success mb-3" style="max-width: 18rem;">
                            <div class="card-header">Complete Booking</div>
                            <div class="card-body">
                                <h3>3 Complete</h3>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>


    </div>
</div>
<!-- Checkout Page End -->
@endsection