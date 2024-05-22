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
                    <th></th>
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
                    <td class="">
                        <a href="{{route('order.get', $item->code)}}" class="btn btn-outline-primary radius-30 p-2" title="Xem Đơn Hàng">
                            <i class="bx bx-doughnut-chart"></i>
                        </a>
                        @if ($item->status == 1)
                            <button onclick="Accept({{$item->id}}, {{$item->code}})" class="btn btn-outline-primary radius-30 p-2" title="Chấp Nhận Đơn Hàng">
                                <i class="bx bx-chevron-down-circle"></i>
                            </button>
                            <button onclick="Decline({{$item->id}}, {{$item->code}})" class="btn btn-outline-warning radius-30 p-2" title="Từ Chối Đơn Hàng">
                                <i class="bx bx-trash" ></i>
                            </button>
                        @elseif($item->status == 0)
                            <button onclick="Restore({{$item->id}}, {{$item->code}})" class="btn btn-outline-danger radius-30 p-2" title="Khôi Phục Đơn Hàng">
                                <i class="bx bx-bot" ></i>
                            </button>
                        @else
                            <button onclick="Success({{$item->id}}, {{$item->code}})" class="btn btn-outline-success radius-30 p-2 {{$item->status == 3 ? 'disabled' : ''}}"" title="Hoàn Thành Đơn Hàng">
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
        <div class="table-responsive" id="orderList">
            <table id="example" class="table table-striped table-bordered text-center" style="width:100%">
                <thead>
                    <tr>
                        <th>Code</th>
                        <th>Customer</th>
                        <th>Total Price</th>
                        <th>Order Time</th>
                        <th>Payment</th>
                        <th>Status</th>
                        <th></th>
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
                        <td>
                            <a href="{{route('order.get', $item->code)}}" class="btn btn-outline-primary radius-30 p-2" title="Xem Đơn Hàng">
                                <i class="bx--doughnut-chart"></i>
                            </a>
                            @if ($item->status == 1)
                                <button onclick="Accept({{$item->id}}, {{$item->code}})" class="btn btn-outline-primary radius-30 p-2" title="Chấp Nhận Đơn Hàng">
                                    <i class="bx bx-chevron-down-circle"></i>
                                </button>
                                <button onclick="Decline({{$item->id}}, {{$item->code}})" class="btn btn-outline-warning radius-30 p-2" title="Từ Chối Đơn Hàng">
                                    <i class="bx bx-trash" ></i>
                                </button>
                            @elseif($item->status == 0)
                                <button onclick="Restore({{$item->id}}, {{$item->code}})" class="btn btn-outline-danger radius-30 p-2" title="Khôi Phục Đơn Hàng">
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