<style>
    .dropdown-item:hover{
        /* background-color: #e81e1e; */
    }
</style>

<body class="lazy-background"
    style="background: url({{ asset('assets/storage/theme/background1675523780.png?ver=new_by_hanamweb') }}) 0 / cover fixed;background-repeat: no-repeat;"
    class="hold-transition sidebar-collapse layout-top-nav">
    <!-- Google Tag Manager (noscript) --> <noscript><iframe
            src="https://www.googletagmanager.com/ns.html?id=GTM-KHPMQR8" height="0" width="0"
            style="display:none;visibility:hidden"></iframe></noscript> <!-- End Google Tag Manager (noscript) -->
    <div id="toggle"></div>
    <div class="wrapper">
        <nav class="main-header navbar navbar-expand-md nav-header mb-4 ml-0">
            <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse"
                aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"><i class="fas fa-bars"
                        style="text-shadow: 2px 2px 2px #000000;color: #fff;"></i></span>
            </button>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="{{ route('home') }}" class="nav-link"><img
                            src="{{ asset('assets/storage/theme/logo_dark1673126696.png?ver=new_by_hanamweb') }}"
                            class="img-fluid" style="margin-top: -8px;height: 165%"></a>
                </li>
            </ul>
            <div class="collapse navbar-collapse order-3" id="navbarCollapse">
                <ul class="navbar-nav">

                    <li class="nav-item">
                        <a href="{{ route('home') }}" class="nav-link menu-header shine-active"><i
                                class="ficon fa-lg fa fa-home"></i></a>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                            class="nav-link dropdown-toggle menu-header ">Nạp Tiền</a>
                        <ul class="dropdown-menu border-0 shadow" style="left: 0px; right: inherit;">
                            <li><a href="{{ route('add_card') }}" class="dropdown-item "><i
                                        class="fas fa-money-check-alt mr-1"></i> Nạp bằng thẻ cào</a></li>
                            <li class="dropdown-divider"></li>
                            <li><a href="https://accgamegenshin.com/nap-tien-qua-ngan-hang/" class="dropdown-item"><i
                                        class="fas fa-university mr-1"></i> Nạp bằng bank, Momo</a></li>
                        </ul>
                    </li>
                    <!-- <li class="nav-item">
                                <a href="#recharge_service" class="nav-link menu-header">Nạp Game</a>
                            </li> -->
                    <li class="nav-item">
                        <a href="{{ route('buy_history') }}" class="nav-link menu-header ">Lịch Sử Mua</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link menu-header ">Uy Tín Shop</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link menu-header ">Hướng Dẫn</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link menu-header ">Liên hệ</a>
                    </li>
                    {{-- <li class="nav-item dropdown">
                        <a href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                            class="nav-link dropdown-toggle menu-header "><i class="fas fa-shopping-cart"></i> Giỏ hàng</a>
                        <ul class="dropdown-menu border-0 shadow" style="left: 0px; right: inherit;">
                            <li><a href="https://accgamegenshin.com/nap-the-cao/"  class="dropdown-item "><i
                                        class="fas fa-money-check-alt mr-1"></i> Nạp bằng thẻ cào</a></li>
                            <li class="dropdown-divider"></li>
                            <li><a href="https://accgamegenshin.com/nap-tien-qua-ngan-hang/" class="dropdown-item"><i
                                        class="fas fa-university mr-1"></i> Nạp bằng bank, Momo</a></li>
                        </ul>
                    </li> --}}

                    <li class="nav-item">
                        <a href="{{ route('cart') }}" class="nav-link menu-header "><i class="fas fa-shopping-cart"></i> Giỏ hàng</a>
                    </li>
                </ul>
                @guest
                    <div class=" navbar-nav" style="position: absolute;right: 35px;">
                        @if (Route::has('login'))
                            <li class="nav-item" style="height: 54px">
                                <a href="{{ route('register') }}" class="nav-link "><button class="btn-pretty px-2">Đăng
                                        Ký</button></a>
                            </li>
                        @endif
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a href="{{ route('login') }}" class="nav-link " style="padding-left: unset"><button
                                        class="btn-pretty px-2">Đăng Nhập</button></a>
                            </li>
                    </div>
                    @endif
                @else
                    <div class=" navbar-nav" style="position: absolute;right: 35px;">
                        <li class="nav-item">
                            <span data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                class="dropdown-toggle btn btn-block btn-outline-warning font-weight-bold">
                                <span class="text-light"><i class="fas fa-user"></i> {{ Auth::user()->name }}</span>
                                {{ number_format(Auth::user()->money) }}<sup>đ</sup>
                            </span>
                            <ul class="dropdown-menu border-0 shadow" style="left: 0px; right: inherit;">
                                @if (Auth::user()->role == 1)
                                    <li><a href="{{ route('admin') }}" class="dropdown-item "><i
                                            class="fas fa-history mr-1"></i> Admin</a></li>
                                <li class="dropdown-divider"></li>
                                @endif
                                
                                <li><a href="https://accgamegenshin.com/Auth/Profile" class="dropdown-item "><i
                                            class="fas fa-history mr-1"></i> Thông tin tài khoản</a></li>
                                <li class="dropdown-divider"></li>
                                <li><a href="#" onclick="confirmLogout(event)" class="dropdown-item "><i
                                            class="fas fa-sign-out-alt"></i> Đăng xuất</a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" onclick="confirmLogout(event)" class="nav-link menu-header mr-5"
                                title="Đăng xuất"
                                style="border: 1px solid;border-radius: 5px;text-align: center; margin-left: 3px; background: #000000;"><i
                                    class="fas fa-sign-out-alt"></i> </a>
                        </li>
                    </div>
                @endguest

            </div>

            <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto"
                style="position: absolute;right: 35px;">
            </ul>
        </nav>
