@extends('admin.admin_dashboard')
@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<div class="container-xxl flex-grow-1 container-p-y">

    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item">
                        <a href="{{route('admin.dashboard')}}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active p-1" aria-current="page">Orders</li>
                </ol>
            </nav>
        </div>

    </div>
    <!--end breadcrumb-->

    <hr />
    <div class="card">
        <div class="card-body">       
            <h3>Thông Tin Đơn Hàng : <span class="text-primary">{{$order->name}}</span></h3>      
            <hr>
            <div class="card-body row">
                
                <div class="col">
                    <p>Mã Đơn Hàng ID: <span class="text-warning">{{$order->code}}</span></p>        
                </div>
                <div class="col">                  
                    <p>Tổng Tiền: <span class="text-warning">{{number_format($order->total_price, 0)}} VND</span></p>
                </div>
            </div>

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
                        <span class="badge bg-label-danger me-1">Từ Chối ĐH</span>
                        @elseif($order->status == 1)
                        <span class="badge bg-label-primary me-1">Chờ Xác Nhận</span>
                        @elseif($order->status == 2)
                        <span class="badge bg-label-primary me-1">Đang Giao Hàng</span>
                        @elseif($order->status == 3)
                        <span class="badge bg-label-success me-1">Hoàn Thành</span>
                        @endif
                    </div>
                </div>

            </div>


            <hr>
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered text-center" style="width:100%">
                    <thead>
                        <tr>
                            <th scope="col">Image</th>
                            <th scope="col">Product Name</th>
                            <th scope="col">Price</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Total Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order_details as $item)
                        <tr id="listCart">
                            <th>
                                <div class="d-flex align-items-center">
                                    <img class="rounded-circle p-1 bg-primary"
                                        src="{{(!empty($item->product->image)) ? url($item->product->image) : url('upload/no_image.jpg')}}"
                                        width="50px">

                                </div>
                            </th>
                            <td>
                                <p class="mb-0 mt-4">{{$item->product_name}}</p>
                            </td>
                            <td>
                                <p class="mb-0 mt-4">{{number_format($item->price, 0, )}} VND</p>
                            </td>
                            <td>
                                {{$item->quantity}}
                            </td>
                            <td>
                                <p class="mb-0 mt-4">{{number_format($item->total_price, 0, '.', ',')}}
                                    VND</p>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <hr>
            <a href="{{route('order.all')}}" class="btn btn-warning" data-abc="true"> 
                Back to orders</a>
        </div>
    </div>



</div>



@endsection