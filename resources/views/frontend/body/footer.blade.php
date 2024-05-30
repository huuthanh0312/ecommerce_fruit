@php
    $site = App\Models\SiteSetting::find(1);
@endphp

<div class="container-fluid bg-dark text-white-50 footer pt-5 mt-5">
    <div class="container py-5">
        <div class="pb-4 mb-4" style="border-bottom: 1px solid rgba(226, 175, 24, 0.5) ;">
            <div class="row g-4">
                <div class="col-lg-6 center">
                    <a href="{{route('products')}}">
                        <h1 class="text-primary mb-0">Thanh Fruit</h1>
                        <p class="text-secondary mb-0">Trái Cây Ngon Mỗi Ngày</p>
                    </a>
                </div>
               
                <div class="col-lg-6">
                    <div class="d-flex justify-content-end pt-3">
                        <a class="btn btn-outline-secondary me-2 btn-md-square rounded-circle" href=""><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-outline-secondary me-2 btn-md-square rounded-circle" href=""><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row g-5">
            <div class="col-lg-6 col-md-6">
                <div class="footer-item">
                    <h4 class="text-light mb-3">Thông Tin Thương Hiệu</h4>
                    <p class="mb-4">{{$site->short_desc}}</p>
                    <a href="{{route('about')}}" class="btn border-secondary py-2 px-4 rounded-pill text-primary">Đọc Tiếp</a>
                </div>
            </div>
         
            <div class="col-lg-6 col-md-6">
                <div class="footer-item justify-content-end">
                    <h4 class="text-light mb-3">Thông Tin Liên Hệ</h4>
                    <p>Địa Chỉ: {{$site->address}}</p>
                    <p>Email: {{$site->email}}</p>
                    <p>Phone: {{$site->phone}}</p>
                    <p>Payment Accepted</p>
                    <img src="{{asset('frontend/img/payment.png')}}" class="img-fluid" alt="">
                </div>
            </div>
            
        </div>
    </div>
</div>

 <!-- Copyright Start -->
 <div class="container-fluid copyright bg-dark py-4">
    <div class="container">
        <div class="row">
            <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                <span class="text-light"><a href="#"><i class="fas fa-copyright text-light me-2"></i>Huu Thanh Nguyen</a>, All right reserved.</span>
            </div>
           
        </div>
    </div>
</div>
<!-- Copyright End -->