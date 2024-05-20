@extends('frontend.main_master')
@section('main')
<!-- Single Page Header start -->
<div class="container-fluid page-header py-5">

</div>
<!-- Single Page Header End -->

<!-- Checkout Page Start -->
<div class="container-fluid py-5">
    <div class="container py-5">
        <h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="/"><i class="fas fa-home me-1"></i>Trang Chủ</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{route('cart')}}"><i class="fas fa-shopping-cart me-1"> Giỏ Hàng</i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        <span>Thanh Toán</span>
                    </li>
                </ol>
            </nav>
        </h4>
        <hr>
        <form method="post" action="{{ route('checkout.store')}}">
            @csrf
            <div class="row g-5">
                <div class=" col-lg-5 col-xl-6">
                    <div class="row">
                        <div class="form-item ">
                            <label class="form-label my-3">Name<sup>*</sup></label>
                            <input type="text" name="name" class="form-control" value="{{$customer->name}}" required>
                            @if ($errors->has('name'))
                            <p class="text-danger">{{$errors->first('name')}}</p>
                            @endif
                        </div>
                        <div class="form-item">
                            <label class="form-label my-3">Email<sup>*</sup></label>
                            <input type="text" name="email" class="form-control" value="{{$customer->email}}" required>
                            @if ($errors->has('email'))
                            <p class="text-danger">{{$errors->first('email')}}</p>
                            @endif
                        </div>
                        <div class="col-md-12 col-lg-6">
                            <div class="form-item w-100">
                                <label class="form-label my-3">Phone<sup>*</sup></label>
                                <input type="text" name="phone" class="form-control" value="{{$customer->phone}}"
                                    required>
                                @if ($errors->has('phone'))
                                <p class="text-danger">{{$errors->first('phone')}}</p>
                                @endif
                            </div>

                        </div>
                        <div class="col-md-12 col-lg-6">
                            <div class="form-item w-100">
                                <label class="form-label my-3">Country<sup>*</sup></label>
                                <input type="text" name="country" class="form-control" required>
                                @if ($errors->has('country'))
                                <p class="text-danger">{{$errors->first('country')}}</p>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-6">
                            <div class="form-item w-100">
                                <label class="form-label my-3">State<sup>*</sup></label>
                                <input type="text" name="state" class="form-control" required>
                                @if ($errors->has('state'))
                                <p class="text-danger">{{$errors->first('state')}}</p>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-6">
                            <div class="form-item w-100">
                                <label class="form-label my-3">Zip Code<sup>*</sup></label>
                                <input type="text" name="zip_code" class="form-control" required>
                                @if ($errors->has('zip_code'))
                                <p class="text-danger">{{$errors->first('zip_code')}}</p>
                                @endif
                            </div>
                        </div>
                        <div class="form-item">
                            <label class="form-label my-3">Address<sup>*</sup></label>
                            <textarea type="text" name="address" class="form-control">{{$customer->address}}</textarea>
                            @if ($errors->has('address'))
                            <p class="text-danger">{{$errors->first('address')}}</p>
                            @endif
                        </div>
                    </div>
                </div>

                <div class=" col-lg-7 col-xl-6">
                    @if ($carts->count() > 0)
                    <table class="table" id="myTable">
                        <thead>
                            <tr>
                                <th scope="col">Hình Ảnh</th>
                                <th scope="col">Tên SP</th>
                                <th scope="col">Giá</th>
                                <th scope="col">SL</th>
                                <th scope="col">Thành Tiền</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($carts as $cart)
                            <tr id="listCart">
                                <th scope="row">
                                    <div class="d-flex align-items-center">
                                        <img src="{{asset($cart->options->image)}}"
                                            class="img-fluid me-5 rounded-circle" width="50px" alt="">
                                    </div>
                                </th>
                                <td>
                                    <p class="mb-0 mt-4">{{$cart->name}}</p>
                                </td>
                                <td>
                                    <p class="mb-0 mt-4">{{$cart->price}}VND</p>
                                </td>
                                <td>
                                    <p class="mb-0 mt-4">{{$cart->qty}}</p>
                                </td>
                                <td>
                                    <p class="mb-0 mt-4"><span class="text-primary">{{number_format($cart->subtotal,
                                            0)}}</span> VND</p>
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

                    <div class="row g-4 text-center align-items-center justify-content-center border-bottom py-3">
                        <h4 class="form-check-label" for="Transfer-1">Tổng Tiền : <span
                                class="text-primary">{{number_format(Cart::Subtotal(), 0)}}</span> VNĐ
                        </h4>
                        <div class="col-12">
                            <div class="form-check text-start my-1">
                                <input type="radio" class="form-check-input bg-primary border-0" name="payment_method"
                                    value="COD">
                                <label class="form-check-label" for="Delivery-1">Cash On Delivery</label>
                            </div>
                            <div class="form-check text-start my-3">
                                <input type="radio" class="form-check-input bg-primary border-0" name="payment_method"
                                    value="Paypal">
                                <label class="form-check-label" for="Paypal-1">Paypal</label>
                            </div>
                            <div class="form-check text-start my-3">
                                <input type="radio" class="form-check-input bg-primary border-0" name="payment_method"
                                    value="Stripe">
                                <label class="form-check-label" for="Paypal-1">Stripe</label>
                            </div>
                        </div>

                    </div>
                    <div class="row g-4 text-center align-items-center justify-content-center pt-4">
                        <button type="submit" class="btn border-secondary py-3 px-4 text-uppercase w-100 text-primary">
                            Đặt Hàng
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- Checkout Page End -->


@endsection