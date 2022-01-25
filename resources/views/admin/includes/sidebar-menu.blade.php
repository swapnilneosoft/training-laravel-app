<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
           with font-awesome or any other icon font library -->

        {{-- Getting sidebar values from pages with the following manner
                 ["sidebarLink"=>["main"=>'   ',"active"=>'dashboard']]
                 main = to define which manue should be opened
                 active = to define which sidebar link should be acyive

                 matching parameteres  by their name --}}
        <li class="nav-item">
            <a href="{{ route('admin-dashboard') }}"
                class="nav-link {{ $sidebarLink['active'] == 'dashboard' ? 'active' : '' }}">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                    Dashboard
                </p>
            </a>
        </li>

        <li class="nav-item {{ $sidebarLink['main'] == 'user' ? 'menu-open' : '' }}">
            <a href="#" class="nav-link">
                <i class="fas fa-users m-1"></i>
                <p>
                    Users
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('user-list') }}"
                        class="nav-link {{ $sidebarLink['active'] == 'list' ? 'active' : '' }}">
                        <i class="far fa-address-card m-1"></i>
                        <p>List</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('add-user') }}"
                        class="nav-link {{ $sidebarLink['active'] == 'add' ? 'active' : '' }}">
                        <i class="fas fa-user-plus m-1"></i>
                        <p>Add user</p>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item {{ $sidebarLink['main'] == 'order' ? 'menu-open' : '' }}">
            <a href="#" class="nav-link">
                <i class="fab fa-first-order m-1"></i>
                <p>
                    Orders
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">

                <li class="nav-item">
                    <a href="{{ route('all-order-list') }}"
                        class="nav-link {{ $sidebarLink['active'] == 'all' ? 'active' : '' }}">
                        <i class="far fa-address-card m-1"></i>
                        <p>All Orders</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('pending-order-list') }}"
                        class="nav-link {{ $sidebarLink['active'] == 'pending' ? 'active' : '' }}">
                        <i class="far fa-clock m-1"></i>
                        <p>Pending Orders</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('delivered-order-list') }}"
                        class="nav-link {{ $sidebarLink['active'] == 'delivered' ? 'active' : '' }}">
                        <i class="far fa-check-circle m-1"></i>
                        <p>Delivered Orders</p>
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-item {{ $sidebarLink['main'] == 'banner' ? 'menu-open' : '' }}">
            <a href="#" class="nav-link">
                <i class="far fa-images m-1"></i>
                <p>
                    Banners
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('banner-list') }}"
                        class="nav-link {{ $sidebarLink['active'] == 'listBanner' ? 'active' : '' }}">
                        <i class="fas fa-list m-1"></i>
                        <p>Banner List</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('add-banner') }}"
                        class="nav-link {{ $sidebarLink['active'] == 'addBanner' ? 'active' : '' }}">
                        <i class="fas fa-plus-circle m-1"></i>
                        <p>Add Banner</p>
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-item {{ $sidebarLink['main'] == 'category' ? 'menu-open' : '' }}">
            <a href="#" class="nav-link">
                <i class="fas fa-anchor m-1"></i>
                <p>
                    Categories
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('category-list') }}"
                        class="nav-link {{ $sidebarLink['active'] == 'listCategory' ? 'active' : '' }}">
                        <i class="fas fa-list m-1"></i>
                        <p>Category List</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('sub-category-list') }}"
                        class="nav-link {{ $sidebarLink['active'] == 'listSubCategory' ? 'active' : '' }}">
                        <i class="fas fa-list m-1"></i>
                        <p>Sub Category List</p>
                    </a>
                </li>

            </ul>
        </li>
        <li class="nav-item {{ $sidebarLink['main'] == 'product' ? 'menu-open' : '' }}">
            <a href="#" class="nav-link">
                <i class="fab fa-product-hunt m-1"></i>
                <p>
                    Products
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('product-list') }}"
                        class="nav-link {{ $sidebarLink['active'] == 'listProduct' ? 'active' : '' }}">
                        <i class="fas fa-clipboard-list m-1"></i>
                        <p>Product List</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('product-add') }}"
                        class="nav-link {{ $sidebarLink['active'] == 'addProduct' ? 'active' : '' }}">
                        <i class="far fa-plus-square m-1"></i>
                        <p>Add Product</p>
                    </a>
                </li>

            </ul>
        </li>
        <li class="nav-item {{ $sidebarLink['main'] == 'coupon' ? 'menu-open' : '' }}">
            <a href="#" class="nav-link">
                <i class="fas fa-book-medical m-1"></i>
                <p>
                    Coupons
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('coupon-list') }}"
                        class="nav-link {{ $sidebarLink['active'] == 'listCoupon' ? 'active' : '' }}">
                        <i class="fas fa-clipboard-list m-1"></i>
                        <p>Coupon List</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('add-coupon') }}"
                        class="nav-link {{ $sidebarLink['active'] == 'addCoupon' ? 'active' : '' }}">
                        <i class="far fa-plus-square m-1"></i>
                        <p>Add coupon</p>
                    </a>
                </li>

            </ul>
        </li>
        <li class="nav-item">
            <a href="{{ route('contact-list') }}"
                class="nav-link {{ $sidebarLink['active'] == 'listContact' ? 'active' : '' }}">
                <i class="nav-icon far fa-envelope"></i>
                <p>
                    Contact / Feedback
                </p>
            </a>
        </li>

    </ul>
</nav>
