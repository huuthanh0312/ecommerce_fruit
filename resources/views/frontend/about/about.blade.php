@extends('frontend.main_master')
@section('main')
<!-- Single Page Header start -->
<div class="container-fluid page-header py-5">
    <ol class="breadcrumb justify-content-center mb-0">
        <li class="breadcrumb-item">
            <h5><a href="{{url('/')}}">Trang Chủ</a></h5>
        </li>
        <li class="breadcrumb-item active text-white">Thông Tin Thương Hiệu</li>
    </ol>
</div>
<!-- Single Page Header End -->


<!-- Fruits Shop Start-->
<div class="container-fluid fruite py-5">
    <div class="container py-5">

        <div class="row g-4">
            <div class="col-md-12 center">
                <h3>Câu chuyện thương hiệu</h3>
            </div>
            <hr>
            <div class="col-lg-12">
                <div class="row g-4">
                    <div class="col-lg-3">
                        <div class="row g-4">
                            <div class="col-lg-12">
                                <h4 class="mb-3">Chính Sách Công Ty</h4>
                                @foreach ($posts as $item)
                                <div class="d-flex align-items-center justify-content-start mb-4">
                                    <div>                                  
                                        <a href="{{ route('policy', $item->title_slug)}}" class="mb-2">
                                            <i class="fas fa-newspaper"></i>{{$item->title}}
                                        </a>                                   
                                    </div>
                                </div>
                                @endforeach

                            </div>
                          
                        </div>
                    </div>
                    <div class="col-lg-9">
                        <div class="row g-4 justify-content-center">
                            <h1>{{$about->title}}</h1>
                            <div class="container">
                                {!! $about->description !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection