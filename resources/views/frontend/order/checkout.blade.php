@extends('frontend.main_master')
@section('main')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<!-- Replace "test" with your own sandbox Business account app client ID -->
<script
    src="https://www.paypal.com/sdk/js?client-id=AaRCcQR38NoX_3a_rBIM1XwpgCmB__z8VSRiQ14H1CEHMBwT_Eq9CWY4_I3QEF-GidMzD1zofm8BH93O&currency=USD">
</script>
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
        {{-- role="form" class="stripe_form require-validation"
        data-cc-on-file="false" data-stripe-publishable-key="{{ env('STRIPE_KEY') }}" --}}
        <form method="post" action="{{ route('checkout.store')}}" class="require-validation" id="myForm">
            @csrf
            <div class="row g-5">
                <div class=" col-lg-5 col-xl-6">
                    <div class="row">
                        <div class="form-item ">
                            <label class="form-label my-3">Name<sup>*</sup></label>
                            <input type="text" name="name" class="form-control" value="{{$customer->name}}">
                            @if ($errors->has('name'))
                            <p class="text-danger">{{$errors->first('name')}}</p>
                            @endif
                        </div>
                        <div class="form-item">
                            <label class="form-label my-3">Email<sup>*</sup></label>
                            <input type="text" name="email" class="form-control" value="{{$customer->email}}">
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
                                <input type="text" name="country" class="form-control">
                                @if ($errors->has('country'))
                                <p class="text-danger">{{$errors->first('country')}}</p>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-6">
                            <div class="form-item w-100">
                                <label class="form-label my-3">State<sup>*</sup></label>
                                <input type="text" name="state" class="form-control">
                                @if ($errors->has('state'))
                                <p class="text-danger">{{$errors->first('state')}}</p>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-6">
                            <div class="form-item w-100">
                                <label class="form-label my-3">Zip Code<sup>*</sup></label>
                                <input type="text" name="zip_code" class="form-control">
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
                    <a href='{{route(' products')}}' class="btn btn-outline-primary">Mua Hàng Ngay</a>
                    @endif

                    <div class="row g-4 text-center align-items-center justify-content-center border-bottom py-3">
                        <h4 class="form-check-label" for="Transfer-1">Tổng Tiền : <span
                                class="text-primary">{{number_format(Cart::Subtotal(), 0)}}</span> VNĐ
                        </h4>
                        <div class="col-12">
                            <div class="form-check text-start my-1">
                                <input type="radio" class="form-check-input bg-primary border-0 pay_method"
                                    name="payment_method" value="COD">
                                <label class="form-check-label" for="Delivery-1">Cash On Delivery</label>
                            </div>
                            <div class="form-check text-start my-3">
                                <input type="radio" class="form-check-input bg-primary border-0 pay_method"
                                    name="payment_method" value="Paypal" id="paypal">
                                <label class="form-check-label" for="Paypal-1">Paypal</label>
                            </div>
                            <div class="form-check text-start my-3 d-none" id="paypal_pay">
                                <input type="hidden" name="transaction_id" id="transaction_id">
                                <div class="container">

                                    <!-- Set up a container element for the button -->
                                    <div id="paypal-button-container"></div>
                                </div>
                            </div>
                            {{-- <div class="form-check text-start my-3">
                                <input type="radio" class="form-check-input bg-primary border-0 pay_method"
                                    name="payment_method" value="Stripe" id="stripe">
                                <label class="form-check-label" for="Paypal-1">Stripe</label>
                            </div>
                            <div class="form-check text-start my-3 d-none" id="stripe_pay">

                                <br>
                                <div class="form-row row">
                                    <div class="col-xs-12 form-group required">
                                        <label class="control-label">Name on Card</label>
                                        <input class="form-control customer" size="4" type="text" />
                                    </div>
                                </div>
                                <div class="form-row row">
                                    <div class="col-xs-12 form-group  required">
                                        <label class="control-label">Card Number</label>
                                        <input autocomplete="off" class="form-control card-number" size="20"
                                            type="text" />
                                    </div>
                                </div>
                                <div class="form-row row">
                                    <div class="col-xs-12 col-md-4 form-group cvc required"><label
                                            class="control-label">CVC</label><input autocomplete="off"
                                            class="form-control card-cvc" placeholder="ex. 311" size="4" type="text" />
                                    </div>
                                    <div class="col-xs-12 col-md-4 form-group expiration required"><label
                                            class="control-label">Expiration Month</label><input
                                            class="form-control card-expiry-month" placeholder="MM" size="2"
                                            type="text" /></div>
                                    <div class="col-xs-12 col-md-4 form-group expiration required"><label
                                            class="control-label">Expiration Year</label><input
                                            class="form-control card-expiry-year" placeholder="YYYY" size="4"
                                            type="text" /></div>
                                </div>
                                <div class="form-row row">
                                    <div class="col-md-12 error form-group hide">
                                        <div class="alert-danger alert">Please correct the errors and try again.
                                        </div>
                                    </div>
                                </div>

                            </div> --}}
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

<style>
    .hide {
        display: none
    }
</style>
<script type="text/javascript">
    $(document).ready(function (){
        $("#myForm").validate({
            rules: {
                name: {
                    required : true,
                },
                email: {
                    required : true,
                },
                phone: {
                    required : true,
                }, 
                country: {
                    required : true,
                },
                state: {
                    required : true,
                },
                zip_code: {
                    required : true,
                },
                address: {
                    required : true,
                },                              
            },
            messages :{
                name: {
                    required : 'Please Enter Name',
                }, 
                email: {
                    required : 'Please Enter Email',
                },
                phone: {
                    required : 'Please Enter Phone',
                }, 
                country: {
                    required : 'Please Enter Country',
                },
                state: {
                    required : 'Please Enter State',
                },
                zip_code: {
                    required : 'Please Enter Zip Code',
                },
                address: {
                    required : 'Please Enter Address',
                },        
            },
            errorElement : 'span', 
            errorPlacement: function (error,element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight : function(element, errorClass, validClass){
                $(element).addClass('is-invalid');
            },
            unhighlight : function(element, errorClass, validClass){
                $(element).removeClass('is-invalid');
                
            },
        });
        
    });

</script>
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script>
    paypal.Buttons({
        
        // Sets up the transaction when a payment button is clicked
        createOrder: (data, actions) => {
            return actions.order.create({
                purchase_units: [{
                    amount: {
                        value: '{{round((Cart::subtotal() / 25000), 2)}}' // Can also reference a variable or function
                    }
                }]
            });
        },
        // Finalize the transaction after payer approval
        onApprove: (data, actions) => {
            return actions.order.capture().then(function(orderData) {
                $('#transaction_id').val(orderData.id);
                $('#myForm').submit();
            });
        }
    }).render('#paypal-button-container');
</script>
<script type="text/javascript">

    $(document).ready(function () {

    $(".pay_method").on('click', function () {
          var payment_method = $(this).val();
          if (payment_method == 'Stripe'){
                $("#stripe_pay").removeClass('d-none');
          }else{
                $("#stripe_pay").addClass('d-none');
          }
          if (payment_method == 'Paypal'){
            if($("#myForm").valid() === true){
                
                $("#paypal_pay").removeClass('d-none');
            }else{
                document.getElementById("paypal").checked = false;
                toastr.error('Please Select Information from Paypal');
            }      
            
        }else{
            $("#paypal_pay").addClass('d-none');
        }
    });

});

$(function() {
    var $form = $(".require-validation");
    $('form.require-validation').bind('submit', function(e) {

          var pay_method = $('input[name="payment_method"]:checked').val();
          if (pay_method == undefined){
                toastr.error('Please Select A Payment Method');
                return false;
          }
        //   else 
        //   }
    });
//     if(pay_method == 'COD'){

// }else{
//       document.getElementById('myButton').disabled = true;

//       var $form         = $(".require-validation"),
//               inputSelector = ['input[type=email]', 'input[type=password]',
//                     'input[type=text]', 'input[type=file]',
//                     'textarea'].join(', '),
//               $inputs       = $form.find('.required').find(inputSelector),
//               $errorMessage = $form.find('div.error'),
//               valid         = true;
//       $errorMessage.addClass('hide');

//       $('.has-error').removeClass('has-error');
//       $inputs.each(function(i, el) {
//             var $input = $(el);
//             if ($input.val() === '') {
//                   $input.parent().addClass('has-error');
//                   $errorMessage.removeClass('hide');
//                   e.preventDefault();
//             }
//       });

//       if (!$form.data('cc-on-file')) {

//             e.preventDefault();
//             Stripe.setPublishableKey($form.data('stripe-publishable-key'));
//             Stripe.createToken({                          
//                   number: $('.card-number').val(),
//                   cvc: $('.card-cvc').val(),
//                   exp_month: $('.card-expiry-month').val(),
//                   exp_year: $('.card-expiry-year').val()
//             }, stripeResponseHandler);
//       }
    // function stripeResponseHandler(status, response) {
    //       if (response.error) {

    //             document.getElementById('myButton').disabled = false;

    //             $('.error')
    //                     .removeClass('hide')
    //                     .find('.alert')
    //                     .text(response.error.message);
    //       } else {

    //             document.getElementById('myButton').disabled = true;
    //             document.getElementById('myButton').value = 'Please Wait...';

    //             // token contains id, last4, and card type
    //             var token = response['id'];
    //             // insert the token into the form so it gets submitted to the server
    //             $form.find('input[type=text]').empty();
    //             $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
    //             $form.get(0).submit();
    //       }
    // }

});
</script>
@endsection