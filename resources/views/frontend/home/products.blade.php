@php
$categories = App\Models\Category::all();
$products = App\Models\Product::limit(8)->get();
$product_hot_news = App\Models\Product::where('hot_new', 1)->get();
$product_hot_deals = App\Models\Product::where('hot_deal', 1)->get();
@endphp

<div class="container-fluid fruite py-5 mb-5 hero-header">
    <div class="container py-5">
        <div class="tab-class text-center">
            <div class="row g-4">
                <div class="col-lg-4 text-start">
                    <h1>Trái Cây Theo Danh Mục</h1>
                </div>
                <div class="col-lg-8 text-end">
                    <ul class="nav nav-pills d-inline-flex text-center mb-5">
                        <li class="nav-item">
                            <a class="d-flex m-2 py-2 bg-light rounded-pill active" data-bs-toggle="pill" href="#tab-1">
                                <span class="text-dark" style="width: 130px;">Tất Cả Sản Phẩm</span>
                            </a>
                        </li>
                        @foreach ($categories as $cate)
                        <li class="nav-item">
                            <a class="d-flex py-2 m-2 bg-light rounded-pill" data-bs-toggle="pill"
                                href="#tab-{{ $cate->id}}">
                                <span class="text-dark" style="width: 130px;">{{$cate->category_name}}</span>
                            </a>
                        </li>
                        @endforeach


                    </ul>
                </div>
            </div>
            <div class="tab-content">
                <div id="tab-1" class="tab-pane fade show p-0 active">
                    <div class="row g-4">
                        <div class="col-lg-12">
                            <div class="row g-4">
                                @foreach ($products as $product)
                                <div class="col-md-6 col-lg-4 col-xl-3">
                                    <div class="rounded position-relative fruite-item pb-4">
                                        <div class="fruite-img">
                                            <img src="{{!empty($product->image) ? url($product->image) : asset('upload\no_image.jpg')}}"
                                                class="fruite-img w-100 rounded-top" alt="">
                                        </div>
                                        <div class="text-white bg-secondary px-3 py-1 rounded position-absolute"
                                            style="top: 10px; left: 10px;">{{$product->category->category_name}}</div>
                                        <div class="p-4 border-secondary border-top-0 rounded-bottom">
                                            <h5>
                                                <a href="{{route('product.details', $product->product_name_slug)}}">
                                                    {{$product->product_name}}
                                                </a>

                                            </h5>
                                            <p class="text-dark fs-5 fw-bold mb-2 ">Giá: {{$product->price}} VND
                                            </p>
                                        </div>
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
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                @foreach ($categories as $cate)
                <div id="tab-{{$cate->id}}" class="tab-pane fade show p-0">
                    <div class="row g-4">
                        <div class="col-lg-12">
                            <div class="row g-4">
                                @php
                                $product_cate = App\Models\Product::where('category_id', $cate->id)->get();
                                @endphp
                                @foreach ($product_cate as $product)
                                <div class="col-md-6 col-lg-4 col-xl-3">
                                    <div class="rounded position-relative fruite-item pb-3">
                                        <div class="fruite-img">
                                            <img src="{{!empty($product->image) ? url($product->image) : asset('upload\no_image.jpg')}}"
                                                class="fruite-img w-100 rounded-top" alt="">
                                        </div>
                                        <div class="text-white bg-secondary px-3 py-1 rounded position-absolute"
                                            style="top: 10px; left: 10px;">{{$product->category->category_name}}</div>
                                        <div class="p-4 border-secondary border-top-0 rounded-bottom">
                                            <h5>
                                                <a href="{{route('product.details', $product->product_name_slug)}}">
                                                    {{$product->product_name}}
                                                </a>
                                            </h5>

                                            <p class="text-dark fs-5 fw-bold mb-2 ">Giá: {{$product->price}} VND
                                            </p>

                                        </div>
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
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
<!-- Vesitable Shop Start-->
<div class="container-fluid vesitable py-5">
    <div class="container py-5">
        <h1 class="mb-0">Sản Phẩm Tươi Ngon Mỗi Ngày</h1>
        <div class="owl-carousel vegetable-carousel justify-content-center">
            @foreach ($product_hot_news as $item)
            <div class="border border-primary rounded position-relative vesitable-item ">
                <div class="vesitable-img">
                    <img src="{{!empty($item->image) ? url($item->image) : asset('upload\no_image.jpg')}}"
                        class="img-fluid w-100 rounded-top" alt="">
                </div>
                <div class="text-white bg-primary px-3 py-1 rounded position-absolute" style="top: 10px; right: 10px;">
                    {{$item->category->category_name}}
                </div>
                <div class="p-4 rounded-bottom align-content-center">
                    <h5>
                        <a href="{{route('product.details', $product->product_name_slug)}}">
                            {{$product->product_name}}
                        </a>
                    </h5>
                    <p class="text-dark fs-5 fw-bold mb-0">Giá: {{$item->price}} VND</p>
                    <div class="row center pt-2">
                        <button onclick="addCart({{$item->id}})"
                            class="btn border border-secondary rounded-pill text-primary p-2 mb-2">
                            <i class="fa fa-shopping-cart me-2 text-primary"></i>Giỏ Hàng
                        </button>
                        <a href="{{route('product.details', $item->product_name_slug)}}"
                            class="btn border border-secondary rounded-pill text-primary" alt="Thêm Vào Giỏ Hàng"><i
                                class="fa fa-shopping-bag me-2 text-primary">
                            </i>Chi Tiết
                        </a>
                    </div>


                </div>

            </div>
            @endforeach


        </div>
    </div>
</div>
<!-- Vesitable Shop End -->

<!-- Vesitable Shop Start-->
<div class="container-fluid vesitable py-5">
    <div class="container py-5">
        <h1 class="mb-0">Sản Phẩm Bán Chạy</h1>
        <div class="owl-carousel vegetable-carousel justify-content-center">
            @foreach ($product_hot_news as $item)
            <div class="border border-primary rounded position-relative vesitable-item ">
                <div class="vesitable-img">
                    <img src="{{!empty($item->image) ? url($item->image) : asset('upload\no_image.jpg')}}"
                        class="img-fluid w-100 rounded-top" alt="">
                </div>
                <div class="text-white bg-primary px-3 py-1 rounded position-absolute" style="top: 10px; right: 10px;">
                    {{$item->category->category_name}}
                </div>
                <div class="p-4 rounded-bottom align-content-center">
                    <h5>
                        <a href="{{route('product.details', $product->product_name_slug)}}">
                            {{$product->product_name}}
                        </a>
                    </h5>
                    <p class="text-dark fs-5 fw-bold mb-0">Giá: {{$item->price}} VND</p>
                    <div class="row center pt-2">
                        <button onclick=" addCart({{$item->id}})" class="btn border border-secondary rounded-pill
                            text-primary p-2 mb-2">
                            <i class="fa fa-shopping-cart me-2 text-primary"></i>Giỏ Hàng
                        </button>
                        <a href="{{route('product.details', $item->product_name_slug)}}"
                            class="btn border border-secondary rounded-pill text-primary" alt="Thêm Vào Giỏ Hàng"><i
                                class="fa fa-shopping-bag me-2 text-primary">
                            </i>Chi Tiết
                        </a>
                    </div>


                </div>

            </div>
            @endforeach


        </div>
    </div>
</div>
<!-- Vesitable Shop End -->


<!-- Fact Start -->