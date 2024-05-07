<div class="container-fluid fixed-top">
    <div class="container topbar bg-primary d-none d-lg-block">
        <div class="d-flex justify-content-between">
            <div class="top-info ps-2">
                <small class="me-3"><i class="fas fa-map-marker-alt me-2 text-secondary"></i> <a href="#"
                        class="text-white">127 Trường Chinh, Thành Phố Huế, Thừa Thiên Huế</a></small>
            </div>
            <div class="top-link pe-2">
                <small class="me-3"><i class="fas fa-envelope me-2 text-secondary"></i><a href="#"
                        class="text-white">huuthanhnguyen0312@gmail.com</a></small>

            </div>
        </div>
    </div>
    <div class="container px-0">
        <nav class="navbar navbar-light bg-white navbar-expand-xl">
            <a href="{{url('/')}}" class="navbar-brand">
                <h3 class="text-primary display-6">Thanh Fruit</h3>
            </a>
            <button class="navbar-toggler py-2 px-3" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarCollapse">
                <span class="fa fa-bars text-primary"></span>
            </button>
            <div class="collapse navbar-collapse bg-white" id="navbarCollapse">
                <div class="navbar-nav mx-auto">
                    <a href="{{url('/')}}" class="nav-item nav-link active">Trang chủ</a>
                    <a href="shop.html" class="nav-item nav-link">Trái Ngon Hôm Nay</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle " data-bs-toggle="dropdown">Danh Mục</a>
                        <div class="dropdown-menu m-0 bg-secondary rounded-0 ">
                            <a href="cart.html" class="dropdown-item">Trái cây Việt Nam</a>
                            <a href="chackout.html" class="dropdown-item">Trái cây nhập khẩu</a>

                        </div>
                    </div>
                    <a href="shop-detail.html" class="nav-item nav-link">Thương Hiệu</a>
                    <a href="contact.html" class="nav-item nav-link">Liên Hệ</a>
                </div>
                <div class="d-flex m-3 me-0">
                    <button class="btn-search btn border border-secondary btn-md-square rounded-circle bg-white me-4"
                        data-bs-toggle="modal" data-bs-target="#searchModal"><i
                            class="fas fa-search text-primary"></i></button>
                    <a href="#" class="position-relative me-4 my-auto">
                        <i class="fa fa-shopping-bag" style="font-size: 1.5rem;"></i>
                        <span
                            class="position-absolute bg-secondary rounded-circle d-flex align-items-center justify-content-center text-dark px-1"
                            style="top: -5px; left: 15px; height: 20px; min-width: 20px;">3</span>
                    </a>
                    @if (Auth::check())
                    <div class="position-relative me-4 my-auto">
                        <div class="nav-item dropdown ">
                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                                <i class="fas fa-user " style="font-size: 1.5rem;"></i> {{Auth::user()->name}}</a>
                            <div class="dropdown-menu m-0 bg-secondary rounded-0">
                                <a href="{{route('dashboard')}}" class="dropdown-item">Dashboard
                                </a>
                                <a href="{{route('user.logout')}}" class="dropdown-item">Logout</a>
                            </div>
                        </div>
                    </div>
                    @else
                    <div class="position-relative me-4 my-auto">
                        <div class="nav-item dropdown ">
                            <a href="#" class="nav-link " data-bs-toggle="dropdown">
                                <i class="fas fa-user " style="font-size: 1.5rem;"></i></a>
                            <div class="dropdown-menu m-0 bg-secondary rounded-0">
                                <a href="{{route('login')}}" class="dropdown-item">Login</a>
                                <a href="{{route('register')}}" class="dropdown-item">Register</a>
                            </div>
                        </div>
                    </div>


                    @endif


                </div>
            </div>
        </nav>
    </div>
</div>

<!-- Modal Search Start -->
<div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content rounded-0">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Search by keyword</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body d-flex align-items-center">
                <div class="input-group w-75 mx-auto d-flex">
                    <input type="search" class="form-control p-3" placeholder="keywords"
                        aria-describedby="search-icon-1">
                    <span id="search-icon-1" class="input-group-text p-3"><i class="fa fa-search"></i></span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal Search End -->