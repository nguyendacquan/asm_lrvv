<div class="app-sidebar-menu">
    <div class="h-100" data-simplebar>

        <!--- Sidemenu -->
        <div id="sidebar-menu">

            <div class="logo-box">
                <a class='logo logo-light' href='index.html'>
                    <span class="logo-sm">
                        <img src="{{ asset('assets/admin/images/logo-sm.png') }}" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ asset('assets/admin/images/logo-light.png') }}" alt="" height="24">
                    </span>
                </a>
                <a class='logo logo-dark' href='{{route('admins.dashboard')}}'>
                    <span class="logo-sm">
                        <img src="{{ asset('assets/admin/images/logo-sm.png') }}" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        {{-- <img src="{{ asset('assets/admin/images/Wardiere-removebg-preview.png') }}" alt="" width="80px"> --}}
                    </span>
                </a>
            </div>

            <ul id="side-menu">

                <li class="menu-title"></li>

                <li>
                    <a class='tp-link' href='{{route('admins.dashboard')}}'>
                        <i data-feather="home"></i>
                        <span> Dashboard </span>

                    </a>
                </li>
                <li>
                    <a class='tp-link' href={{route('admins.users.index')}}>
                        <i data-feather="users"></i>
                        <span> Quản lý tải khoản </span>

                    </a>
                </li>
           

                <li class="menu-title">Kinh Doanh</li>

                <li>
                    <a class='tp-link' href='{{route('admins.danhmucs.index')}}'>
                        <i data-feather="home"></i>
                        <span> Danh mục sản phẩm </span>

                    </a>
                </li>
                <li>
                    <a class='tp-link' href='{{route('admins.sanphams.index')}}'>
                        <i data-feather="shopping-bag"></i>
                        <span>Sản phẩm </span>

                    </a>
                </li>
                <li>
                    <a class='tp-link' href='{{route('admins.donhangs.index')}}'>
                        <i data-feather="truck"></i>
                        <span> Đơn hàng </span>
                        
                    </a>
                </li>
                <li>
                    <a class='tp-link' href='{{route('admins.coupons.index')}}'>
                        <i data-feather="truck"></i>
                        <span> Mã giảm giá </span>
                        
                    </a>
                </li>
                <li class="menu-title">Content</li>
                
                <li>
                    <a class='tp-link' href='{{route('admins.baiviet.index')}}'>
                        <i data-feather="list"></i>
                        <span> Quản lí bài viết </span>
                    </a>
                </li>
                <li>
                    <a class='tp-link' href='{{route('admins.slider.index')}}'>
                        <i data-feather="sliders"></i>
                        <span> Quản lí Slider </span>
                    </a>
                </li>

            </ul>

        </div>
        <!-- End Sidebar -->

        <div class="clearfix"></div>

    </div>
</div>
