<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="{{route('admin.dashboard')}}" class="app-brand-link">
            <h3 class=" demo menu-text fw-bolder ms-2">Thanh Fruit</h3>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboard -->
        <li class="menu-item {{ Request::is('admin/*') ? 'active' : '' }}">
            <a href="{{route('admin.dashboard')}}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
            </a>
        </li>
        
        
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Manage Product</span>
        </li>
        <!-- Product -->
        @if (Auth::user()->can('category.menu'))
        <li class="menu-item {{ Request::is('category/*') ? 'active' : '' }}">
            <a href="{{route('category.all')}}" class="menu-link ">
                <i class="menu-icon tf-icons bx bx-category-alt"></i>
                <div data-i18n="Layouts">Manage Category</div>
            </a>
        </li>
        @endif
        
        @if (Auth::user()->can('product.menu'))
        <li class="menu-item {{ Request::is('product/*') ? 'active open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle ">
                <i class="menu-icon tf-icons bx bxl-product-hunt"></i>
                <div data-i18n="Authentications">Manage Product</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ Request::is('product/all') ? 'active' : '' }}">
                    <a href="{{route('product.all')}}" class="menu-link">
                        <div data-i18n="Basic">All Product</div>
                    </a>
                </li>
                <li class="menu-item {{ Request::is('product/add') ? 'active' : '' }}">
                    <a href="{{route('product.add')}}" class="menu-link">
                        <div data-i18n="Basic">Add Product</div>
                    </a>
                </li>

            </ul>
        </li>
        @endif
        <!-- Order -->
        @if (Auth::user()->can('order.menu'))
        <li class="menu-header small text-uppercase"><span class="menu-header-text">Manage Order</span></li>
        <!-- All Order -->
        <li class="menu-item {{ Request::is('order/*') ? 'active' : '' }}">
            <a href="{{route('order.all')}}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-cart"></i>
                <div data-i18n="Basic">All Order</div>
            </a>
            
        </li>
        {{-- <li class="menu-item">
            <a href="{{route('tracking')}}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-collection"></i>
                <div data-i18n="Basic">Tracking</div>
            </a>
        </li>  --}}
        @endif
        <!-- Components -->
        @if (Auth::user()->can('customer.menu'))
        <li class="menu-header small text-uppercase"><span class="menu-header-text">Manage Customers</span></li>
        <!-- Cards -->
        <li class="menu-item {{ Request::is('customer/*') ? 'active' : '' }}">
            <a href="{{route('customer.all')}}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-news"></i>
                <div data-i18n="Form Layouts">Manage Customers</div>
            </a>
        </li>
        @endif
        
        <!-- Components -->
        <li class="menu-header small text-uppercase"><span class="menu-header-text">Manage Others</span></li>
        <!-- Cards -->
        @if (Auth::user()->can('post.menu'))
        <li class="menu-item {{ Request::is('post/*') ? 'active' : '' }}">
            <a href="{{route('post.all')}}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-podcast"></i>
                <div data-i18n="Form Layouts">Manage Post</div>
            </a>
        </li>
        @endif
        
        @if (Auth::user()->can('contact.menu'))
        <li class="menu-item {{ Request::is('contact/*') ? 'active' : '' }}">
            <a href="{{route('contact.all')}}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-message-detail"></i>
                <div data-i18n="Form Layouts">Manage Contact</div>
            </a>
        </li>
        @endif
        
        <!-- Misc -->
        <li class="menu-header small text-uppercase"><span class="menu-header-text">Settings</span></li>
        @if (Auth::user()->can('role.permission.menu'))
        <li class="menu-item {{ (Request::is('permission/*') || Request::is('role/*') || Request::is('role-permission/*')) ? 'active open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-user-pin"></i>
                <div data-i18n="Form Layouts">Role In Permissions</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ Request::is('permission/all') ? 'active' : '' }}">
                    <a href="{{route('permission.all')}}" class="menu-link">
                        <div data-i18n="Vertical Form">Permissions</div>
                    </a>
                </li>
                <li class="menu-item {{ Request::is('role/all') ? 'active' : '' }}">
                    <a href="{{route('role.all')}}" class="menu-link">
                        <div data-i18n="Vertical Form">Roles</div>
                    </a>
                </li>
                <li class="menu-item {{ Request::is('role-permission/all') ? 'active' : '' }}">
                    <a href="{{route('role.permission.all')}}" class="menu-link">
                        <div data-i18n="Vertical Form">Role In Permission</div>
                    </a>
                </li>
                
            </ul>
        </li>
        @endif
        
        @if (Auth::user()->can('admin.user.menu'))
        <li class="menu-item {{ Request::is('admin-setup-user/*') ? 'active' : '' }}">
            <a href="{{route('admin.user.all')}}" class="menu-link ">
                <i class="menu-icon tf-icons bx bxs-user-account"></i>
                <div data-i18n="Form Layouts">Manage Admin User Setup</div>
            </a>
            
        </li>
        @endif
        
        @if (Auth::user()->can('site.setting.menu'))
        <li class="menu-item {{ Request::is('site-setting/*') ? 'active' : '' }}">
            <a href="{{route('site.setting.show')}}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-message-alt-edit"></i>
                <div data-i18n="Form Layouts">Site Settings</div>
            </a>
        </li>
        @endif
        @if (Auth::user()->can('smtp.setting.menu'))
        <li class="menu-item {{ Request::is('smtp-setting') ? 'active' : '' }}">
            <a href="{{route('smtp.setting')}}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-detail"></i>
                <div data-i18n="Form Layouts">SMTP Setting</div>
            </a>
        </li>
        @endif
    </ul>
    <br>
    <br>
</aside>