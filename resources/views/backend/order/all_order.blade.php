@extends('admin.admin_dashboard')
@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<style>
    .large-checkbox {
        transform: scale(1.5);
    }
</style>
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
    <div class="card " id="orderList">
        <div class="card-body">
            <h4><span class="text-primary">Danh Sách Đơn Hàng</span></h4>
            <hr>
            <div class="table-responsive" >
                <table class="exampleData table table-striped table-bordered text-center" style="width:100%">
                    <thead>
                        <tr class="center">
                            <th>Code</th>
                            <th>Customer</th>
                            <th>Total Price</th>
                            <th>Order Time</th>
                            <th>Payment</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $key => $item)

                        <tr>
                            <td>
                                <a href="{{route('order.get', $item->code)}}">{{$item->code}}</a>
                            </td>
                            <td>{{$item->user->name}}</td>
                            {{-- <td>
                                <img class="rounded-circle p-1 bg-primary" src="{{ (!empty($item['order_details']->first()->product->image)) ? 
                                url($item['order_details']->first()->product->image) : url('upload/no_image.jpg')}}" width="50">
                            </td> --}}
                            <td>{{number_format($item->total_price)}} VND</td>
                            <td>
                                {{$item->created_at->format('d/m/Y')}}
                            </td>
                            <td>{{$item->payment_method}}</td>
                            <td class="p-1">
                                @if ($item->status == 0)
                                <span class="badge bg-label-danger me-1">Từ Chối ĐH</span>
                                @elseif($item->status == 1)
                                <span class="badge bg-label-warning me-1">Chờ Xác Nhận</span>
                                @elseif($item->status == 2)
                                <span class="badge bg-label-primary me-1">Đang Giao Hàng</span>
                                @elseif($item->status == 3)
                                <span class="badge bg-label-success me-1">Hoàn Thành</span>
                                @endif
            
                            </td>
                            <td>
                                <a href="{{route('order.get', $item->code)}}" class="btn btn-outline-primary radius-30 p-2" title="Xem Đơn Hàng">
                                    <i class="bx bx-doughnut-chart"></i>
                                </a>
                                @if ($item->status == 1)
                                    <button onclick="Accept({{$item->id}}, {{$item->code}})" class="btn btn-outline-primary radius-30 p-2" title="Chấp Nhận Đơn Hàng">
                                        <i class="bx bx-chevron-down-circle"></i>
                                    </button>
                                    <button onclick="Decline({{$item->id}}, {{$item->code}})" class="btn btn-outline-danger radius-30 p-2" title="Từ Chối Đơn Hàng">
                                        <i class="bx bx-trash" ></i>
                                    </button>
                                @elseif($item->status == 0)
                                    <button onclick="Restore({{$item->id}}, {{$item->code}})" class="btn btn-outline-warning radius-30 p-2" title="Khôi Phục Đơn Hàng">
                                        <i class="bx bx-bot" ></i>
                                    </button>
                                @else
                                    <button onclick="Success({{$item->id}}, {{$item->code}})" class="btn btn-outline-success radius-30 p-2 {{$item->status == 3 ? 'disabled' : ''}}" title="Hoàn Thành Đơn Hàng">
                                        <i class="bx bx-like"></i>
                                    </button>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
        </div>
        <hr />
        <div class="card">
            <div class="card-body">
                <h4><span class="text-danger">Đơn Hàng Bị Từ Chối</span></h4>
                <hr>
                <div class="table-responsive">
                    <table class="exampleData table table-striped table-bordered text-center" style="width:100%">
                        <thead>
                            <tr>
                                <th>Code</th>
                                <th>Customer</th>
                                <th>Total Price</th>
                                <th>Order Time</th>
                                <th>Payment</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders_decline as $key => $item)
                            <tr>
                                <td>
                                    <a href="{{route('order.get', $item->code)}}">{{$item->code}}</a>
                                </td>
                                <td>{{$item->user->name}}</td>
                                {{-- <td>
                                    <img class="rounded-circle p-1 bg-primary" src="{{ (!empty($item['order_details']->first()->product->image)) ? 
                                    url($item['order_details']->first()->product->image) : url('upload/no_image.jpg')}}" width="50">
                                </td> --}}
                                <td>{{number_format($item->total_price)}} VND</td>
                                <td>
                                    {{$item->created_at->format('d/m/Y')}}
                                </td>
                                <td>{{$item->payment_method}}</td>
                                <td class="p-0">
                                    @if ($item->status == 0)
                                    <span class="badge bg-label-danger me-1">Từ Chối ĐH</span>
                                    @elseif($item->status == 1)
                                    <span class="badge bg-label-warning me-1">Chờ Xác Nhận</span>
                                    @elseif($item->status == 2)
                                    <span class="badge bg-label-primary me-1">Đang Giao Hàng</span>
                                    @elseif($item->status == 3)
                                    <span class="badge bg-label-success me-1">Hoàn Thành</span>
                                    @endif
                
                                </td>
                                <td class="p-1">
                                    <a href="{{route('order.get', $item->code)}}" class="btn btn-outline-primary radius-30 p-2" title="Xem Đơn Hàng">
                                        <i class="bx bx-doughnut-chart"></i>
                                    </a>
                                    @if ($item->status == 1)
                                        <button onclick="Accept({{$item->id}}, {{$item->code}})" class="btn btn-outline-primary radius-30 p-2" title="Chấp Nhận Đơn Hàng">
                                            <i class="bx bx-chevron-down-circle"></i>
                                        </button>
                                        <button onclick="Decline({{$item->id}}, {{$item->code}})" class="btn btn-outline-danger radius-30 p-2" title="Từ Chối Đơn Hàng">
                                            <i class="bx bx-trash" ></i>
                                        </button>
                                    @elseif($item->status == 0)
                                        <button onclick="Restore({{$item->id}}, {{$item->code}})" class="btn btn-outline-warning radius-30 p-2" title="Khôi Phục Đơn Hàng">
                                            <i class="bx bx-bot" ></i>
                                        </button>
                                    @else
                                        <button onclick="Success({{$item->id}}, {{$item->code}})" class="btn btn-outline-success radius-30 p-2 {{$item->status == 3 ? 'disabled' : ''}}" title="Hoàn Thành Đơn Hàng">
                                            <i class="bx bx-like"></i>
                                        </button>
                                        
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
<script>
    function Accept(id, code){  
        Swal.fire({
            title: 'Are you sure?',
            text: "You are sure you want to accept this order?",
            icon: 'primary',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: `Yes, Accept Order ID : ${code}!`
        }).then((result) => {
            if (result.isConfirmed) {
                var status = 2; 
                $.ajax({
                    url: "{{route('order.update.status')}}",
                    method: 'POST',
                    data: {
                        order_id: id,
                        status : status,
                        _token: "{{csrf_token()}}"
                    },
                    success: function(data){
                        $('#orderList').html(data);
                        Swal.fire(
                        'Success Accept Order!',
                        `You Accept Order ID: ${code} .`,
                        'success'
                    )
                    },
                    error: function(response){
                        toastr.error(response.message);
                    }
                })
            
            }
        })   
        
    }
        
    function Decline(id, code){ 
        Swal.fire({
            title: 'Are you sure?',
            text: "You are sure you want to decline this order?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: `Yes, Decline Order ID : ${code}!`
        }).then((result) => {
            if (result.isConfirmed) {
                var status = 0;   
                $.ajax({
                    url: "{{route('order.update.status')}}",
                    method: 'POST',
                    data: {
                        order_id: id,
                        status : status,
                        _token: "{{csrf_token()}}"
                    },
                    success: function(data){
                        $('#orderList').html(data);
                        Swal.fire(
                            'Decline!',
                            'Your file has been decline.',
                            'warning'
                        )
                    },
                    error: function(response){
                        toastr.error(response.message);
                    }
                })
            
            }
        })  
        
    }

    function Success(id, code){ 
        Swal.fire({
            title: 'Are you sure?',
            text: "You are sure you want to success this order?",
            icon: 'success',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: `Yes, Success Order ID : ${code}!`
        }).then((result) => {
            if (result.isConfirmed) {
                var status = 3; 
                $.ajax({
                    url: "{{route('order.update.status')}}",
                    method: 'POST',
                    data: {
                        order_id: id,
                        status : status,
                        _token: "{{csrf_token()}}"
                    },
                    success: function(data){
                        $('#orderList').html(data);
                        Swal.fire(
                        'Order Successfully!',
                        `You Accept Order ID: ${code} .`,
                        'success'
                    )
                    },
                    error: function(response){
                        toastr.error(response.message);
                    }
                })
            }
        })    
        
    }

    function Restore(id, code){ 
        Swal.fire({
            title: 'Are you sure?',
            text: "You are sure you want to restore this order?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: `Yes, Restore Order ID : ${code}!`
        }).then((result) => {
            if (result.isConfirmed) {
                var status = 1; 
                $.ajax({
                    url: "{{route('order.update.status')}}",
                    method: 'POST',
                    data: {
                        order_id: id,
                        status : status,
                        _token: "{{csrf_token()}}"
                    },
                    success: function(data){
                        $('#orderList').html(data);
                        Swal.fire(
                        'Success Restore Order!',
                        `You Accept Order ID: ${code} .`,
                        'success'
                    )
                    },
                    error: function(response){
                        toastr.error(response.message);
                    }
                })
            
            }
        })   
        
    }
</script>

@endsection