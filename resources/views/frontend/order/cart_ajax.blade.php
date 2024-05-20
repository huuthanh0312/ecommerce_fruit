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
        <tr id="listCart">
            <th scope="row">
                <div class="d-flex align-items-center">
                    <img src="{{asset($cart->options->image)}}" class="img-fluid me-5 rounded-circle"
                        style="width: 80px; height: 80px;" alt="">
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
                        <button class="btn btn-sm btn-minus rounded-circle bg-light border">
                            <i class="fa fa-minus"></i>
                        </button>
                    </div>
                    <input type="text" class="form-control form-control-sm text-center border-0" value="{{$cart->qty}}">
                    <div class="input-group-btn">
                        <button class="btn btn-sm btn-plus rounded-circle bg-light border">
                            <i class="fa fa-plus"></i>
                        </button>
                    </div>
                </div>
            </td>
            <td>
                <p class="mb-0 mt-4">{{number_format($cart->subtotal, 0)}} VND</p>
            </td>
            <td>
                <button id="deleteCart" data-product-id="{{$cart->id}}" data-comment-id="{{$cart->rowId}}"
                    class="btn btn-md rounded-circle bg-light border mt-4">
                    <i class="fa fa-times text-danger"></i>
                </button>
            </td>

        </tr>
        
        @endforeach
        <p >Tổng Tiền : <span class="text-primary sub_total">{{number_format($totalPrice, 0)}}</span> VND</p>
    </tbody>
    
</table>
@else
<div class="alert alert-danger" role="alert">
    <h5>Không có sản phẩm trong giỏ hàng</h5>

</div>
<a href='{{route('products')}}' class="btn btn-outline-primary">Mua Hàng Ngay</a>
@endif


@if ($countCart > 0)
<script>
    
    $("#countCart").html({{$countCart}});
    $(".sub_total").html({{$totalPrice}});

</script>
@else
<script> 
        $("#countCart").text({{$countCart}});
        $("#total").remove();      
        $(".sub_total").text('0');  
</script>
@endif