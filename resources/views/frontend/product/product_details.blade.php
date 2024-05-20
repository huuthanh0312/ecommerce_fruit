@extends('frontend.main_master')
@section('main')

<!-- Single Page Header start -->
<div class="container-fluid page-header py-5">
    <ol class="breadcrumb justify-content-center mb-0">
        <li class="breadcrumb-item">
            <h5><a href="{{url('/')}}">Trang Chủ</a></h5>
        </li>
        <li class="breadcrumb-item active text-white">Trái Ngon: {{$product->product_name}}</li>
    </ol>
</div>
<!-- Single Page Header End -->
<!-- Single Product Start -->
<div class="container-fluid py-5 mt-5">
    <div class="container py-5">
        <div class="row g-4 mb-5">
            <div class="col-lg-12 col-xl-12">
                <div class="row g-4">
                    <div class="col-lg-6">
                        <div class=" rounded">

                            <img src="{{!empty($product->image) ? url($product->image) : asset('upload/no_image.jpg')}}"
                                class="img-fluid rounded border" alt="Image">

                        </div>
                    </div>
                    <div class="col-lg-6 ">
                        <h4 class="fw-bold mb-3">{{$product->product_name}}</h4>
                        <div class="flex row">
                            <div class="col-md-6">
                                <p class="mb-3">Danh Mục: <a
                                        href="{{route('category.product', $product->category->category_name_slug)}}">{{$product->category->category_name}}</a>
                                </p>
                            </div>
                            <div class="col-md-6">
                                <p class="mb-3">Mã Sản Phẩm: <span class="text-secondary">
                                        {{$product->code}}</span></p>
                            </div>

                        </div>

                        <p class="fw-bold mb-3">Giá: {{$product->price}} VND</p>
                        <div class="d-flex align-content-center mb-2">

                            <p class="mb-4">{{$product->short_desc}}</p>

                        </div>
                        </form>
                        <div class="d-flex align-content-center mb-4">
                            <form action="{{route('cart.store')}}" method="post">
                                @csrf
                                <input type="hidden" name="id" value="{{$product->id}}">
                                <div class="input-group quantity " style="width: 100px;">
                                    <div class="input-group-btn">
                                        <button type="button"
                                            class="btn btn-sm btn-minus rounded-circle bg-light border">
                                            <i class="fa fa-minus"></i>
                                        </button>
                                    </div>
                                    <input type="text" class="form-control form-control-sm text-center border-0"
                                        value="1" name="qty" min="1">
                                    <div class="input-group-btn">
                                        <button type="button"
                                            class="btn btn-sm btn-plus rounded-circle bg-light border">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                        </div>
                        <button type="submit"
                            class="btn border border-secondary rounded-pill px-4 py-2 mb-4 text-primary"><i
                                class="fa fa-shopping-cart me-2 text-primary"></i> Mua Ngay</button>
                        </form>

                    </div>
                    <div class="col-lg-12">
                        <nav>
                            <div class="nav nav-tabs mb-3">
                                <button class="nav-link active border-white border-bottom-0" type="button" role="tab"
                                    id="nav-about-tab" data-bs-toggle="tab" data-bs-target="#nav-about"
                                    aria-controls="nav-about" aria-selected="true">Chi Tiết Thông Tin Sản Phẩm</button>

                            </div>
                        </nav>
                        <div class="tab-content mb-5">
                            {!! $product->description!!}
                        </div>
                    </div>

                </div>
            </div>

        </div>
        <hr>
        <h1 class="fw-bold mb-0">Sản Phẩm Bán Chạy</h1>
        <div class="vesitable">
            <div class="owl-carousel vegetable-carousel justify-content-center ">
                @foreach ($product_hot_deals as $product)
                <div class="border border-primary rounded position-relative vesitable-item pb-4">
                    <div class="vesitable-img">
                        <img src="{{!empty($product->image) ? url($product->image) : asset('upload/no_image.jpg')}}"
                            class="img-fluid w-100 rounded-top" alt="">
                    </div>
                    <div class="text-white bg-primary px-3 py-1 rounded position-absolute"
                        style="top: 10px; right: 10px;">{{$product->category->category_name}}</div>
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
                            class="btn border border-secondary rounded-pill text-primary" alt="Thêm Vào Giỏ Hàng"><i
                                class="fa fa-shopping-bag me-2 text-primary">
                            </i>Chi Tiết
                        </a>
                    </div>
                </div>
                @endforeach
                <div class="vesitable-img">
                    <img src="img/vegetable-item-1.jpg" class="img-fluid w-100 rounded-top" alt="">
                </div>
                <div class="text-white bg-primary px-3 py-1 rounded position-absolute" style="top: 10px; right: 10px;">
                    Vegetable</div>
                <div class="p-4 pb-0 rounded-bottom">
                    <h4>Parsely</h4>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod te incididunt</p>
                    <div class="d-flex justify-content-between flex-lg-wrap">
                        <p class="text-dark fs-5 fw-bold">$4.99 / kg</p>
                        <a href="#" class="btn border border-secondary rounded-pill px-3 py-1 mb-4 text-primary"><i
                                class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<!-- Single Product End -->

@endsection