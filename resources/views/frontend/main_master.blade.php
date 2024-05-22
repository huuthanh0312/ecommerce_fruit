<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Thanh Fruit</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Raleway:wght@600;800&display=swap"
        rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{asset('frontend/lib/lightbox/css/lightbox.min.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/lib/owlcarousel/assets/owl.carousel.min.css')}}" rel="stylesheet">


    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{asset('frontend/css/bootstrap.min.css')}}" rel="stylesheet">
    {{-- Toastr --}}
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">

    <!-- Template Stylesheet -->
    <link href="{{asset('frontend/css/style.css')}}" rel="stylesheet">
</head>

<body>

    <!-- Spinner Start -->
    <div id="spinner"
        class="show w-100 vh-100 bg-white position-fixed translate-middle top-50 start-50  d-flex align-items-center justify-content-center">
        <div class="spinner-grow text-primary" role="status"></div>
    </div>
    <!-- Spinner End -->


    <!-- Navbar start -->
    @include('frontend.body.navbar')
    <!-- Navbar End -->



    @yield('main')


    <!-- Footer Start -->
    @include('frontend.body.footer')
    <!-- Footer End -->

    <!-- Copyright Start -->

    <!-- Copyright End -->



    <!-- Back to Top -->
    <a href="#" class="btn btn-primary border-3 border-primary rounded-circle back-to-top"><i
            class="fa fa-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{asset('frontend/lib/easing/easing.min.js')}}"></script>
    <script src="{{asset('frontend/lib/waypoints/waypoints.min.js')}}"></script>
    <script src="{{asset('frontend/lib/lightbox/js/lightbox.min.js')}}"></script>
    <script src="{{asset('frontend/lib/owlcarousel/owl.carousel.min.js')}}"></script>

    <!-- Template Javascript -->
    <script src="{{asset('frontend/js/main.js')}}"></script>
    <script src="{{ asset('backend/assets/js/validate.min.js') }}"></script>
    <!--Notification-->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        toastr.options = {
            "closeButton": true,
            "positionClass": "toast-bottom-right",
        }
        @if(Session::has('message'))
            var type = "{{ Session::get('alert-type','info') }}"
            switch(type){
                case 'info':
                toastr.info(" {{ Session::get('message') }} ");
                break;
            
                case 'success':
                toastr.success(" {{ Session::get('message') }} ");
                break;
            
                case 'warning':
                toastr.warning(" {{ Session::get('message') }} ");
                break;
            
                case 'error':
                toastr.error(" {{ Session::get('message') }} ");
                break; 
            }
	    @endif 
    </script>

    <script>
        function addCart(id){
                var qty = $('#qtyProduct').val();
                if(qty == null){
                    qty = 1;
                }
                
                $.ajax({
                    url: "{{route('cart.add.js')}}",
                    method: 'POST',
                    data: {id: id, qty: qty, _token: "{{csrf_token()}}"},
                    success: function(data){
                        toastr.success('Add Product Successfully');
                        $(".myTable").html(data);   
                          
                    },
                    error: function(error){
                        toastr.error('Error Add Product Faild');
                    }

                }); //call ajax method check room
                
                
        }
        $(document).delegate("#deleteCart","click",function(){
            var rowId = $(this).data('comment-id');
            var id = $(this).data('product-id');         
            $.ajax({
                url: "{{route('cart.delete.js')}}",
                method: 'POST',
                data: {id: id, rowId: rowId, _token: "{{csrf_token()}}"},
                success: function(data){
                    toastr.warning('Deleted Product Successfully');                     
                    $(".myTable").html(data);
                                              
                },
                error: function(error){
                    toastr.error('Error Deleted Product Faild');
                }
            })
                
        });

        // Product Quantity
        $(document).delegate(".quantity button","click",function(){
            var button = $(this);
            var oldValue = button.parent().parent().find('input').val();
            var valueMax = $(this).data('max-id');
            if(oldValue >= valueMax) {  
                button.parent().parent().find('input').val(valueMax);
                toastr.error('Product Quatity Maximun');
                return false;
            }else{
                if (button.hasClass('btn-plus')) {
                    var newVal = parseFloat(oldValue) + 1;
                } else {
                    if (oldValue > 1) {
                        var newVal = parseFloat(oldValue) - 1;
                    } else {
                        newVal = 0;
                    }
                }
            }
           
            var rowId = $(this).data('comment-id');
            var id = $(this).data('product-id');
            if(rowId != null && id != null) {
                if(newVal > 0){
                    $.ajax({
                    url: "{{route('cart.update.js')}}",
                    method: 'POST',
                    data: {id: id, rowId: rowId, qty: newVal, _token: "{{csrf_token()}}"},
                    success: function(data){

                        var number_cart_product = '.number_cart'+id; 
                        $(number_cart_product).val(newVal);  

                        $("#countCart").html(data['countCart']);
                        $(".sub_total").html(data['sub_total']);

                        var name_total_price_product = '.total_price_product'+id;    
                        $(name_total_price_product).html(data['total_price']);         
                        button.parent().parent().find('input').val(newVal);               
                    },
                    error: function(error){
                        toastr.error('Error Update Product Faild');
                    }
                    })
                }else{
                    button.parent().parent().find('input').val(1);
                    toastr.warning('Can not update product!');
                }
            } else{
                if(newVal == 0){
                    button.parent().parent().find('input').val(1);
                }else{
                    button.parent().parent().find('input').val(newVal);
                }
                
            }
            
            
        });

    </script>
</body>

</html>