@php
$categories = App\Models\Category::orderBy('id', 'asc')->get();
$carts = Cart::content();
$countCart = 0;
foreach($carts as $cart){
$countCart += $cart->qty;
}
@endphp


<div class="container-fluid fixed-top">
    <div class="container topbar bg-primary d-none d-lg-block">
        <div class="d-flex justify-content-between">
            <div class="top-info ps-2">
                <small class="me-3"><i class="fas fa-map-marker-alt me-2 text-secondary"></i> <a href="#"
                        class="text-white">127 Trường Chinh, Thành Phố Huế, Thừa Thiên Huế</a></small>
            </div>
            <div class="top-link pe-2">
                <small class="me-3"><i class="fas fa-envelope me-2 text-secondary"></i><a href="#"
                        class="text-white">huuthanhnguyen0312@gmail.com</a></small>

            </div>
        </div>
    </div>
    <div class="container px-0">
        <nav class="navbar navbar-light bg-white navbar-expand-xl">
            <a href="{{url('/')}}" class="navbar-brand">
                <h3 class="text-primary display-6">Thanh Fruit</h3>
            </a>
            <button class="navbar-toggler py-2 px-3" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarCollapse">
                <span class="fa fa-bars text-primary"></span>
            </button>
            <div class="collapse navbar-collapse bg-white" id="navbarCollapse">
                <div class="navbar-nav mx-auto">
                    <a href="{{url('/')}}" class="nav-item nav-link active">Trang chủ</a>
                    <a href="{{route('products')}}" class="nav-item nav-link">Trái ngon hôm nay</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle " data-bs-toggle="dropdown">Danh Mục</a>
                        <div class="dropdown-menu m-0 bg-secondary rounded-0 ">
                            @foreach ($categories as $category)
                            <a href="{{route('category.product', $category->category_name_slug)}}"
                                class="dropdown-item">{{$category->category_name}}</a>
                            @endforeach



                        </div>
                    </div>
                    <a href="contact.html" class="nav-item nav-link">Thuơng Hiệu</a>
                    <a href="contact.html" class="nav-item nav-link">Liên Hệ</a>
                </div>
                <div class="d-flex m-3 me-0">
                    <button class="btn-search btn border border-secondary btn-md-square rounded-circle bg-white me-4"
                        data-bs-toggle="modal" data-bs-target="#searchModal"><i
                            class="fas fa-search text-primary"></i></button>
                    <a class="position-relative me-4 my-auto" data-bs-toggle="modal" data-bs-target="#cartModal">
                        {{-- href="{{route('cart')}}" --}}
                        <i class="fa fa-shopping-bag" style="font-size: 1.5rem;"></i>

                        <span class="position-absolute bg-secondary rounded-circle d-flex align-items-center justify-content-center text-dark px-1"
                            style="top: -5px; left: 15px; height: 20px; min-width: 20px;"
                            id="countCart">{{$countCart}}
                        </span>

                    </a>
                    @if (Auth::check())
                    <div class="position-relative me-4 my-auto">
                        <div class="nav-item dropdown ">
                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                                <i class="fas fa-user " style="font-size: 1.5rem;"></i> </a>
                            <div class="dropdown-menu m-0 bg-secondary rounded-0">
                                <h5 class="dropdown-item">{{Auth::user()->name}}</h5>
                                <a href="{{route('dashboard')}}" class="dropdown-item">Dashboard
                                </a>
                                <a href="{{route('user.logout')}}" class="dropdown-item">Logout</a>
                            </div>
                        </div>
                    </div>
                    @else
                    <div class="position-relative me-4 my-auto">
                        <div class="nav-item dropdown ">
                            <a href="#" class="nav-link " data-bs-toggle="dropdown">
                                <i class="fas fa-user " style="font-size: 1.5rem;"></i></a>
                            <div class="dropdown-menu m-0 bg-secondary rounded-0">
                                <a href="{{route('login')}}" class="dropdown-item">Login</a>
                                <a href="{{route('register')}}" class="dropdown-item">Register</a>
                            </div>
                        </div>
                    </div>
                    @endif

                </div>
            </div>
        </nav>
    </div>
</div>

<!-- Modal Search Start -->
<div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content rounded-0">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Search by keyword</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body d-flex align-items-center">
                <div class="input-group w-75 mx-auto d-flex">
                    <input type="search" class="form-control p-3" placeholder="keywords"
                        aria-describedby="search-icon-1">
                    <span id="search-icon-1" class="input-group-text p-3"><i class="fa fa-search"></i></span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal Search End -->

<!-- Modal Cart Start -->
<div class="modal fade" id="cartModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content rounded-0">
            <div class="modal-header">
                <button type="button" class="btn-close-cart btn btn-outline-danger m-2" data-bs-dismiss="modal"
                    aria-label="Close">
                    <span class="" aria-hidden="true">&times;</span></button>
                <div>
                    <h5 class="text-uppercase btn btn-outline-warning"><a href="{{route('cart')}}">Đến Giỏ Hàng</a></h5>
                    <h5 class="text-uppercase btn btn-outline-primary"><a href="{{route('checkout')}}">Thanh Toán</a>
                    </h5>
                </div>

            </div>
            <div class="modal-body align-items-center">
                <div class="table-responsive myTable" >
                    @if ($carts->count() > 0)
                    <table class="table " >
                        <thead>
                            <tr>
                                <th scope="col">Hình Ảnh</th>
                                <th scope="col">Tên SP</th>
                                <th scope="col">Giá</th>
                                <th scope="col">Số Lượng</th>
                                <th scope="col">Thành Tiền</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($carts as $cart)
                            <tr>
                                <th scope="row">
                                    <div class="d-flex align-items-center">
                                        <img src="{{asset($cart->options->image)}}"
                                            class="img-fluid me-5 rounded-circle" style="width: 80px; height: 80px;"
                                            alt="">
                                    </div>
                                </th>
                                <td>
                                    <p class="mb-0 mt-4">{{$cart->name}}</p>
                                </td>
                                <td>
                                    <p class="mb-0 mt-4">{{$cart->price}}VND</p>
                                </td>
                                <td>
                                    <div class="input-group quantity mt-4" style="width: 100px;">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-minus rounded-circle bg-light border" data-product-id="{{$cart->id}}" data-comment-id="{{$cart->rowId}}">
                                                <i class="fa fa-minus"></i>
                                            </button>
                                        </div>
                                        <input type="text" class="form-control form-control-sm text-center border-0"
                                            value="{{$cart->qty}}">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-plus rounded-circle bg-light border" data-product-id="{{$cart->id}}" data-comment-id="{{$cart->rowId}}">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <p>
                                        <span class="mb-0 mt-4 total_price_product{{$cart->id}}">{{number_format($cart->subtotal, 0, '.', ',')}}</span> VND
                                    </p>
                                </td>
                                <td>
                                    <button id="deleteCart" data-product-id="{{$cart->id}}" data-comment-id="{{$cart->rowId}}"
                                        class="btn btn-md rounded-circle bg-light border mt-4">
                                        <i class="fa fa-times text-danger"></i>
                                    </button>
                                </td>

                            </tr>
                            @endforeach     
                        </tbody>
                        <p>Tổng Tiền : <span class="text-primary sub_total" >{{number_format(Cart::subtotal(), 0)}}</span> VND
                        </p>
                    </table>
                    @else
                    <div class="alert alert-danger" role="alert">
                        <h5>Không có sản phẩm trong giỏ hàng</h5>

                    </div>
                    <a href='{{route('products')}}' class="btn btn-outline-primary">Mua Hàng Ngay</a>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal Cart End -->