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
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
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
                                <span class="badge bg-label-primary me-1">Chờ Xác Nhận</span>
                                @elseif($item->status == 2)
                                <span class="badge bg-label-primary me-1">Đang Giao Hàng</span>
                                @elseif($item->status == 3)
                                <span class="badge bg-label-success me-1">Hoàn Thành</span>
                                @endif
            
                            </td>
                            <td>
                                <button onclick="accept({{$item->id}})" class="btn btn-outline-success radius-30" title="Chấp Nhận Đơn Hàng">
                                    <i class="bx bx-chevron-down-circle"></i>
                                </button>
                                <button onclick="decline({{$item->id}})" class="btn btn-outline-danger radius-30" title="Từ Chối Đơn Hàng">
                                    <i class="bx bx-trash" ></i>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
        </div>
    </div>



</div>
<script>
    function accept(id){     
        $.ajax({
            url: "{{route('order.update.status')}}",
            method: 'POST',
            data: {
                order_id: id,
                _token: "{{csrf_token()}}"
            },
            success: function(response){
                toastr.success(response.message);
            },
            error: function(response){
                toastr.error(response.message);
            }
        })
    }
        
    function decline(id){ 
        Swal.fire({
            title: 'Are you sure?',
            text: "You are sure you want to decline this order?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Decline it!'
        }).then((result) => {
            if (result.isConfirmed) {
                alert('Decline');   
                // $.ajax({
                //     url: "{{route('order.update.status')}}",
                //     method: 'POST',
                //     data: {
                //         order_id: id,
                //         _token: "{{csrf_token()}}"
                //     },
                //     success: function(response){
                //         toastr.success(response.message);
                //     },
                //     error: function(response){
                //         toastr.error(response.message);
                //     }
                // })
            Swal.fire(
                'Decline!',
                'Your file has been decline.',
                'success'
            )
            }
        })  
        
    }
</script>

@endsection