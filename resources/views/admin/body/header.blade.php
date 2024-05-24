@php
$id = Auth::user()->id;
$profileData = App\Models\User::find($id)

@endphp

<nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
    id="layout-navbar">
    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
            <i class="bx bx-menu bx-sm"></i>
        </a>
    </div>

    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
        <!-- Search -->
        <div class="navbar-nav align-items-center">
            <div class="nav-item d-flex align-items-center">
                <i class="bx bx-search fs-4 lh-0"></i>
                <input type="text" class="form-control border-0 shadow-none" placeholder="Search..."
                    aria-label="Search..." />
            </div>
        </div>
        <!-- /Search -->

        <ul class="navbar-nav flex-row align-items-center ms-auto">
            {{--<li class="nav-item dropdown dropdown-large ">
                <a class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative text-warning" href="#" role="button"
                    data-bs-toggle="dropdown" aria-expanded="false"> 
                    <span class="alert-count">8</span> 
                    <i class='bx bx-shopping-bag'></i>
                </a>
                 <div class="dropdown-menu dropdown-menu-end p-3">
                    <div class="header-message-list p-3">
                        <a class="dropdown-item" href="javascript:;">
                            <div class="d-flex align-items-center gap-3">
                                <div class="position-relative">
                                    <div class="cart-product rounded-circle bg-light">
                                        <img src="{{asset('backend/assets/images/products/11.png')}}" class="" alt="product image">
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="cart-product-title mb-0"></h6>
                                    <p class="cart-product-price mb-0"></p>
                                </div>
                                <div class="">
                                    <p class="cart-price mb-0">$250</p>
                                </div>
                                <div class="cart-product-cancel"><i class="bx bx-x"></i>
                                </div>
                            </div>
                        </a>
                    </div>
                    <a href="javascript:;">
                        <div class="text-center msg-footer ">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <h5 class="mb-0">Total</h5>
                                <h5 class="mb-0 ms-auto">$489.00</h5>
                            </div>
                            <button class="btn btn-primary w-100">Checkout</button>
                        </div>
                    </a>
                </div> 
            </li>--}}

            <!-- User -->
            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <div class="avatar avatar-online">
                        <img class="rounded-circle  bg-primary"
                            src="{{ !empty($profileData->photo) ? url($profileData->photo) : url('upload/no_image.jpg')}}"
                            alt class="w-px-40 h-auto rounded-circle" />
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <a class="dropdown-item" href="#">
                            <div class="d-flex">
                                <div class="flex-shrink-0 me-3">
                                    <div class="avatar avatar-online">
                                        <img class="rounded-circle bg-primary"
                                            src="{{ !empty($profileData->photo) ? url($profileData->photo) : url('upload/no_image.jpg')}}"
                                            alt class="w-px-40 h-auto rounded-circle" />
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <span class="fw-semibold d-block">{{$profileData->name}}</span>
                                    <small class="text-muted">{{$profileData->role}}</small>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <div class="dropdown-divider"></div>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{route('admin.profile')}}">
                            <i class="bx bx-user me-2"></i>
                            <span class="align-middle">My Profile</span>
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{route('admin.change.password')}}">
                            <i class="bx bx-cog me-2"></i>
                            <span class="align-middle">Change Password</span>
                        </a>
                    </li>
                    {{-- <li>
                        <a class="dropdown-item" href="#">
                            <span class="d-flex align-items-center align-middle">
                                <i class="flex-shrink-0 bx bx-credit-card me-2"></i>
                                <span class="flex-grow-1 align-middle">Billing</span>
                                <span
                                    class="flex-shrink-0 badge badge-center rounded-pill bg-danger w-px-20 h-px-20">4</span>
                            </span>
                        </a>
                    </li> --}}
                    <li>
                        <div class="dropdown-divider"></div>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{route('admin.logout')}}">
                            <i class="bx bx-power-off me-2"></i>
                            <span class="align-middle">Log Out</span>
                        </a>
                    </li>
                </ul>
            </li>
            <!--/ User -->
        </ul>
    </div>
</nav>