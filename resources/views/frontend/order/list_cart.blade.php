@extends('frontend.main_master')
@section('main')
<!-- Single Page Header start -->
<div class="container-fluid page-header py-5">
    
</div>
<!-- Single Page Header End -->

 <!-- Cart Page Start -->
 <div class="container-fluid py-5">
    
    <div class="container py-5">       
        <div class="row g-4 justify-content-end">
            <h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="/"><i class="fas fa-home me-1"></i>Trang Chủ</a>
                        </li>
                        <li class="breadcrumb-item">
                            <span><i class="fas fa-shopping-cart me-1"> Giỏ Hàng</i></span>
                        </li>
                    </ol>
                </nav>
            </h4>
            <hr>
            <div class="col-12">    
                <div class="table-responsive myTable" >
                    @if ($carts->count() > 0)
                    <table class="table " >
                        <thead>
                            <tr>
                                <th scope="col">Hình Ảnh</th>
                                <th scope="col">Tên Sản Phẩm</th>
                                <th scope="col">Giá</th>
                                <th scope="col">Số Lượng</th>
                                <th scope="col">Thành Tiền</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($carts as $cart)
                            <tr id="listCart">
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
                                    <p class="mb-0 mt-4">{{number_format($cart->price, 0, '.', ',')}} VND</p>
                                </td>
                                <td>
                                    <div class="input-group quantity mt-4" style="width: 100px;">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-minus rounded-circle bg-light border" data-product-id="{{$cart->id}}" data-comment-id="{{$cart->rowId}}">
                                                <i class="fa fa-minus"></i>
                                            </button>
                                        </div>
                                        <input type="text" class="form-control form-control-sm text-center border-0 number_cart{{$cart->id}}"
                                            value="{{$cart->qty}}" >
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-plus rounded-circle bg-light border" data-product-id="{{$cart->id}}" data-comment-id="{{$cart->rowId}}">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <p class="mb-0 mt-4">
                                        <span class="total_price_product{{$cart->id}}">{{number_format($cart->subtotal, 0, '.', ',')}}</span> VND
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
                    </table>
                    @else
                    <div class="alert alert-danger" role="alert">
                        <h5>Không có sản phẩm trong giỏ hàng</h5>                   
                    </div>
                    <a href='{{route('products')}}' class="btn btn-outline-primary">Mua Hàng Ngay</a>
                    @endif
        
                </div>
            </div>
            @if ($carts->count() > 0)
            <div class="col-sm-12 col-md-7 col-lg-6 col-xl-4" id="total">
                <div class="bg-light rounded">                 
                    @php
                        $subtotal = Cart::subtotal();
                    @endphp
                    <div class="py-4 mb-4 border-top border-bottom d-flex justify-content-between">
                        <h5 class="mb-0 ps-4 me-4">Tổng Tiền</h5>
                        <p class="mb-0 pe-4 text-danger"><span class="sub_total">{{number_format($subtotal, 0)}}</span> VND</p>
                    </div>
                    <div class="center justify-content-between">
                        <ul>
                            <li>Phí vận chuyển sẽ được tính ở trang thanh toán.</li>
                            <li>Bạn cũng có thể nhập mã giảm giá ở trang thanh toán.</li>  
                          </ul>
                    </div>
                    <a href="{{route('checkout')}}" class="btn border-secondary rounded-pill px-4 py-3 text-primary text-uppercase mb-4 ms-4" type="button">Thanh Toán</a>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
<!-- Cart Page End -->


@endsection