@extends('frontend.main_master')
@section('main')

{{-- Banner --}}
@include('frontend.home.banner')
{{-- end banner --}}

<!-- Fruits Shop Start-->
@include('frontend.home.products')
<!-- Fruits Shop End-->

<!-- Bestsaler Product Start -->
@include('frontend.home.services')
<!-- Bestsaler Product End -->

@endsection