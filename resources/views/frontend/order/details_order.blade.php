@extends('frontend.main_master')
@section('main')
<!-- Single Page Header start -->
<div class="container-fluid page-header py-5">
    <ol class="breadcrumb justify-content-center mb-0">
        <li class="breadcrumb-item">
            <h5><a href="{{url('/')}}">Trang Chủ</a></h5>
        </li>
        <li class="breadcrumb-item active text-white">Chi Tiết Đơn Hàng : <span class="text-warning">{{$order->code}}</li>
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
                <div class="col-lg-12 col-md-12">
                    <div class="card">
                        <header class="card-header"> Đơn Đặt Hàng Của Tôi / Theo Dõi </header>
                        <div class="card-body">
                            <p>Mã Đơn Hàng ID: <span class="text-warning">{{$order->code}}</span></p>
                            <p>Tổng Tiền: <span class="text-warning">{{number_format($order->total_price, 0)}} VND</span></p>
                            <div class="card">
                                <div class="card-body row">
                                    <div class="col">
                                        <strong>Thông Tin Giao Hàng:
                                        </strong>
                                        <br>
                                        <p>Họ Và Tên : {{$order->name}}</p>
                                        <p>Số Điện Thoại : {{$order->phone}}</p>
                                        <p>Địa Chỉ : {{$order->address}}</p>
                                    </div>
                                    <div class="col">
                                        <strong>Thời Gian Đặt Hàng: </strong> <br>
                                        <span class="badge bg-success">{{$order->created_at->format('d-m-Y')}}</span>
                                    </div>
                                    <div class="col"> <strong>Trạng Thái Đơn Hàng:</strong> <br>
                                        @if ($order->status == 0)
                                            <span class="badge bg-danger me-1">Từ Chối ĐH</span>
                                        @elseif($order->status == 1)
                                            <span class="badge bg-warning me-1">Chờ Xác Nhận</span>
                                        @elseif($order->status == 2)
                                            <span class="badge bg-primary me-1">Đang Giao Hàng</span>
                                        @elseif($order->status == 3)
                                            <span class="badge bg-success me-1">Hoàn Thành</span>
                                        @endif
                                    </div>
                                </div>
                                
                            </div>

                            <div class="track">
                                <div class="step active"> <span class="icon"> <i class="fa fa-check"></i> </span> <span
                                        class="text">Đã Thanh Toán</span> </div>
                                <div class="step {{$order->status == 1 ? 'active' : ''}}"> <span class="icon"> <i class="fa fa-user"></i> </span> <span
                                        class="text"> Chờ Xác Nhận</span> </div>
                                <div class="step {{$order->status == 2 ? 'active' : ''}}"> <span class="icon"> <i class="fa fa-truck"></i> </span> <span
                                        class="text"> Đang Giao Hàng </span> </div>
                                <div class="step {{$order->status == 3 ? 'active' : ''}}"> <span class="icon"> <i class="fa fa-box"></i> </span> <span
                                        class="text">Đơn Hàng Thành Công</span> </div>
                            </div>
                            <hr>
                            <ul class="row">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Hình Ảnh</th>
                                            <th scope="col">Tên Sản Phẩm</th>
                                            <th scope="col">Giá</th>
                                            <th scope="col">Số Lượng</th>
                                            <th scope="col">Thành Tiền</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($order_details as $item)
                                        <tr id="listCart">
                                            <th>
                                                <img class="rounded-circle p-1 bg-primary"
                                                        src="{{(!empty($item->product->image)) ? url($item->product->image) : url('upload/no_image.jpg')}}"
                                                        width="50px">
                                            </th>
                                            <td>
                                                <p class="mb-0 mt-4">{{$item->product_name}}</p>
                                            </td>
                                            <td>
                                                <p class="mb-0 mt-4">{{number_format($item->price, 0, )}} VND</p>
                                            </td>
                                            <td>
                                                <p class="mb-0 mt-4 ">{{$item->quantity}}</p>
                                            </td>
                                            <td>
                                                <p class="mb-0 mt-4">{{number_format($item->total_price, 0, '.', ',')}} VND</p>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </ul>
                            <hr>
                            <a href="{{route('order')}}" class="btn btn-warning" data-abc="true"> <i class="fa fa-chevron-left"></i> Back
                                to orders</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
</div>
<!-- Checkout Page End -->


@endsection