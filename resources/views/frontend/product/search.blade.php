@extends('frontend.main_master')
@section('main')
<!-- Single Page Header start -->
<div class="container-fluid page-header py-5">
    <ol class="breadcrumb justify-content-center mb-0">
        <li class="breadcrumb-item">
            <h5><a href="{{url('/')}}">Trang Chủ</a></h5>
        </li>
        <li class="breadcrumb-item active text-white">Trái Ngon Hôm Nay</li>
    </ol>
</div>
<!-- Single Page Header End -->


<!-- Fruits Shop Start-->
<div class="container-fluid fruite py-5">
    <div class="container py-5">
        <h2>Bạn Đang Tìm Kiếm : "{{$search}}"</h2>
        <hr>
        <div class="row g-4">
            <div class="col-lg-12">

                <div class="row g-4">
                    <div class="col-lg-3">
                        <div class="row g-4">
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <h4>Danh Mục</h4>
                                    <ul class="list-unstyled fruite-categorie">
                                        @foreach ($categories as $cate)
                                        @php
                                        $coutProduct = App\Models\Product::where('category_id',$cate->id)->count();
                                        @endphp
                                        <li>
                                            <div class="d-flex justify-content-between fruite-name">
                                                <a href="{{route('category.product', $cate->category_name_slug)}}"><i
                                                        class="fas fa-apple-alt me-2"></i>{{$cate->category_name}}</a>
                                                <span class="text-secondary">({{$coutProduct}})</span>
                                            </div>
                                        </li>
                                        @endforeach


                                    </ul>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <h4 class="mb-3">Trái Cây Bán Chạy</h4>
                                @foreach ($product_hot_deals as $item)
                                <div class="d-flex align-items-center justify-content-start">
                                    <div class="rounded me-4" style="width: 100px; height: 100px;">
                                        <img src="{{!empty($item->image) ? url($item->image) : asset('upload/no_image.jpg')}}"
                                            class="img-fluid rounded" alt="">
                                    </div>
                                    <div>
                                        <h6 class="mb-2">{{$item->product_name}}</h6>

                                        <div class="d-flex mb-2">
                                            <h6 class="fw-bold me-2">{{$item->price}}VND</h6>
                                            {{-- <h5 class="text-danger text-decoration-line-through">4.11 $</h5> --}}
                                        </div>
                                    </div>
                                </div>
                                @endforeach

                            </div>
                            <div class="col-lg-12">
                                <h4 class="mb-3">Trái Cây Mới Mỗi Ngày</h4>
                                @foreach ($product_hot_news as $item)
                                <div class="d-flex align-items-center justify-content-start">
                                    <div class="rounded me-4" style="width: 100px; height: 100px;">
                                        <img src="{{!empty($item->image) ? url($item->image) : asset('upload/no_image.jpg')}}"
                                            class="img-fluid rounded" alt="">
                                    </div>
                                    <div>
                                        <h6 class="mb-2">{{$item->product_name}}</h6>

                                        <div class="d-flex mb-2">
                                            <h6 class="fw-bold me-2">{{$item->price}}VND</h6>
                                            {{-- <h5 class="text-danger text-decoration-line-through">4.11 $</h5> --}}
                                        </div>
                                    </div>
                                </div>
                                @endforeach

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-9">
                     
                        @if($results->count() > 0)
                        <div class="row g-4 justify-content-center">
                            @foreach ($results as $product)
                            <div class="col-md-6 col-lg-6 col-xl-4">
                                <div class="rounded position-relative fruite-item pb-4 ">
                                    <div class="fruite-img">
                                        <img src="{{!empty($product->image) ? url($product->image) : asset('upload/no_image.jpg')}}"
                                            class="img-fluid w-100 rounded-top" alt="">
                                    </div>
                                    <div class="text-white bg-secondary px-3 py-1 rounded position-absolute"
                                        style="top: 10px; left: 10px;">{{$product->category->category_name}}</div>
                                    <div class="p-4 border-top-0 rounded-bottom">
                                        <h5>
                                            <a href="{{route('product.details', $product->product_name_slug)}}">
                                                {{$product->product_name}}
                                            </a>
                                        </h5>
                                        {{-- <p></p> --}}
                                        <p class=" mb-0">Giá: {{$product->price}} VND</p>

                                    </div>
                                    <div class="text-center ">
                                        <button onclick="addCart({{$product->id}})"
                                            class="btn border border-secondary rounded-pill text-primary p-2">
                                            <i class="fa fa-shopping-cart me-2 text-primary"></i>Giỏ Hàng
                                        </button>
                                        <a href="{{route('product.details', $product->product_name_slug)}}"
                                            class="btn border border-secondary rounded-pill text-primary"
                                            alt="Thêm Vào Giỏ Hàng"><i class="fa fa-shopping-bag me-2 text-primary">
                                            </i>Chi Tiết
                                        </a>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        
                        @else
                        <div class="card">
                            <div class="card-body">
                                
                                <div class="alert alert-danger" role="alert">
                                    <h5>Không có sản phẩm bạn đang tìm kiếm !!!</h5>
                                </div>
                                <hr>
                                <a href='{{route('products')}}' class="btn btn-outline-primary">Mua Hàng Ngay</a>
                            </div>
                        </div>
                        @endif
                        <div class="col-12">
                            <div class="pagination d-flex justify-content-center mt-5">
                                {{$results->links('vendor.pagination.custom')}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Fruits Shop End-->
@endsection