@extends('frontend.main_master')
@section('main')
<!-- Single Page Header start -->
<div class="container-fluid page-header py-5">
    <ol class="breadcrumb justify-content-center mb-0">
        <li class="breadcrumb-item"><a href="{{ url('/')}}">Trang Chủ</a></li>
        <li class="breadcrumb-item">Tài Khoản</li>
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
                    <div class="billing-details">
                        <h3 class="title">Danh Sách Đơn Hàng</h3>
                        <hr>
                        <div class="row">
                            <div class="col-lg-12 col-md-6">
                                <table class="table table-striped-columns">
                                    <thead>
                                        <tr>
                                            <th scope="col">Mã Đơn Hàng</th>
                                            <th scope="col">Hình Ảnh</th>
                                            <th scope="col">Ngày Đặt</th>
                                            <th scope="col">Tổng Tiền</th>
                                            <th scope="col">PT Thanh Toán</th>
                                            <th scope="col">Trạng Thái ĐH</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orders as $item)
                                        <tr>
                                            <th scope="row"><a href="{{route('order.details', $item->code)}}">{{$item->code}}</a></th>
                                            <td>
                                                <img class="rounded-circle p-1 bg-primary" src="{{(!empty($item['order_details']->first()->product->image)) ? url($item['order_details']->first()->product->image) : url('upload/no_image.jpg')}}" width="50">
                                            </td>
                                            <td>{{$item->created_at->format('d/m/Y')}}</td>
                                            <td>{{number_format($item->total_price)}} VND</td>
                                            <td>{{$item->payment_method}}</td>
                                            <td>
                                                @if ($item->status == 0)
                                                    <span class="badge bg-label-danger me-1">Từ Chối ĐH</span>
                                                @elseif($item->status == 1)
                                                    <span class="badge bg-label-primary me-1">Chờ Xác Nhận</span>
                                                @elseif($item->status == 2)
                                                    <span class="badge bg-label-primary me-1">Đang Giao Hàng</span>
                                                @elseif($item->status == 3)
                                                    <span class="badge bg-label-success me-1">Hoàn Thành</span>
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                        
                                        
                                    </tbody>
                                </table>
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