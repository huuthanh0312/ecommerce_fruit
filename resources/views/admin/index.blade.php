@extends('admin.admin_dashboard')
@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@php
    $orders = App\Models\Order::whereNotIn('status', [0])->get();
    $complete = App\Models\Order::where('status', 3)->get();
    $pending = App\Models\Order::where('status', 0)->get();

    $total_price = App\Models\Order::sum('total_price');

    $today = Carbon\Carbon::now()->toDateString();
    $todayPrice = App\Models\Order::whereDate('created_at', $today)->sum('total_price');

@endphp
<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">


    <div class="row">
        <div class="card">
            <div class="card-body">
                <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">
                    <div class="col">
                        <div class="card radius-10 border-start border-0 border-4 border-info">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <a href="{{route('order.all')}}">
                                        <div>
                                            <p class="mb-0 text-secondary">Total Order</p>
                                            <h4 class="my-1 text-info">{{count($orders)}} Order</h4>
                                            
                                        </div>
                                        <div class="widgets-icons-2 rounded-circle bg-gradient-blues text-white ms-auto"><i
                                                class='bx bxs-cart'></i>
                                        </div>
                                    </a>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card radius-10 border-start border-0 border-4 border-danger">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <a href="{{route('order.all')}}">
                                        <div>
                                            <p class="mb-0 text-secondary">Today Order</p>
                                            <h4 class="my-1 text-danger">{{$todayPrice}}</h4>
                                            
                                        </div>
                                        <div class="widgets-icons-2 rounded-circle bg-gradient-burning text-white ms-auto"><i
                                                class='bx bxs-wallet'></i>
                                        </div>
                                    </a>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card radius-10 border-start border-0 border-4 border-success">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <a href="{{route('order.all')}}">
                                        <div>
                                            <p class="mb-0 text-secondary">Complete Order</p>
                                            <h4 class="my-1 text-success">{{count($complete)}}</h4>
                                        </div>
                                        <div class="widgets-icons-2 rounded-circle bg-gradient-ohhappiness text-white ms-auto"><i
                                                class='bx bxs-bar-chart-alt-2'></i>
                                        </div>
                                    </a>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card radius-10 border-start border-0 border-4 border-warning">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <a href="{{route('order.all')}}">
                                        <div>
                                            <p class="mb-0 text-secondary">Total Price</p>
                                            <h4 class="my-1 text-warning">{{$total_price}} VND</h4>
                                        </div>
                                        <div class="widgets-icons-2 rounded-circle bg-gradient-orange text-white ms-auto"><i
                                                class='bx bxs-group'></i>
                                        </div>
                                    </a>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end row-->
                <hr>
                <div class="col-12 col-lg-12 d-flex">
                    <div class="card radius-10 w-100">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <div>
                                    <h6 class="mb-0">Sales Overview</h6>
                                </div>
        
                            </div>
                        </div>
        
                        <div class="row row-cols-1 row-cols-md-3 row-cols-xl-3 g-0 row-group text-center border-top">
                            <canvas id="orderChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      

    </div>
    <!--end row-->

    <div class="row">
        <div class="card">
            <div class="card-body">
                <h4><span class="text-primary">Danh Sách Đơn Hàng</span></h4>
                <hr>
                <div class="table-responsive" >
                    <table id="example" class="table table-striped table-bordered text-center" style="width:100%">
                        <thead>
                            <tr>
                                <th>Code</th>
                                <th>Customer</th>
                                <th>Total Price</th>
                                <th>Order Time</th>
                                <th>Payment</th>
                                <th>Status</th>
                                
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
                                <td>
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
                                
                            </tr>
                            @endforeach
                        </tbody>
    
                    </table>
                </div>
            </div>
        </div>
        

    </div>
    <!--end row-->
    
</div>
<!-- / Content -->


<script>
    var ctx = document.getElementById('orderChart').getContext('2d');
    var orders = @json($orders);

    // Extract the required data from the orders
    var labels = orders.map(function(order) {
        return order.created_at; 
    });

    var data = orders.map(function(order) {
        return order.total_price;
    });

    var orderChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Order Data',
                data: data,
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
@endsection