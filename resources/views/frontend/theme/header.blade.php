<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no"/>
    <title>@yield('title') </title>
    <meta name="description" content="abc"/>
    <meta name="keywords" content="acb"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="{{ URL::asset('/frontend/css/select2.css') }}" type="text/css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ URL::asset('/frontend/css/bootstrap.4.0.0-beta.3.min.css') }}" type="text/css"/>
    <link rel="stylesheet" href="{{ URL::asset('/frontend/css/style.css') }}" type="text/css"/>
    <link rel="stylesheet" href="{{ URL::asset('/frontend/css/custom.css') }}" type="text/css"/>
    <link rel="stylesheet" href="{{ URL::asset('/frontend/css/custom_tan.css') }}" type="text/css"/>
    @yield('css_header')

    <script>
        var isMobile = 0;
    </script>
    <script src="{{ URL::asset('/frontend/js/jquery.min.js') }}"></script>
    <script src="{{ URL::asset('/frontend/js/tether.min.js') }}"></script>
    <script src="{{ URL::asset('/frontend/js/bootstrap.min.js') }}"></script>
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        });
    </script>
    @yield('js_header')
</head>

<body>

<div class="page-wrapper page-home">

    <!--start header-->
    <header id="header" class="header">
        <div class="container d-flex flex-row flex-lg-column">
            <div class="topbar header__topbar hidden-md-down">
                <ul class="topbar-list mb-0">
                    @guest
                        <li class="topbar-list__item">
                            <a class="topbar-list__link" href="{{ route('frontend.user.register') }}">Đăng ký</a>
                        </li>
                        <li class="topbar-list__item">
                            <a class="topbar-list__link" href="{{ route('frontend.user.login') }}">Đăng nhập</a>
                        </li>
                    @endguest
                    @auth
                        <li class="topbar-list__item">
                            <a class="topbar-list__link" href="{{ route('frontend.user.edit', [\Auth::user()->id]) }}">{{ \Common::getDisplayNameUser() }}</a>
                        </li>
                        <li class="topbar-list__item">
                            <a class="topbar-list__link" href="{{ route('frontend.user.logout') }}">Đăng xuất</a>
                        </li>
                    @endauth

                    <li class="topbar-list__item">
                        <a class="topbar-list__link" href="/Home/Notification/">Thông báo</a>
                    </li>
                    <li class="topbar-list__item">
                        <a class="topbar-list__link" href="/huong-dan-giao-dich-tren-san-tima.html">Hỗ trợ</a>
                    </li>
                  <!--   <li class="topbar-list__item">
                        <a class="topbar-list__link" href="/Home/InstallApp/"><i class="icon-mobile"></i></a>
                    </li> -->
                    <li class="topbar-list__item">
                       <!--  <a class="topbar-list__link text-primary fs-16 d-flex align-items-center" href="tel:{{ HOTLINE }}">
                            <i class="icon-phone-gray mr-1"></i><strong>{{ HOTLINE }}</strong>
                        </a> -->
                    </li>
                </ul>
            </div>

            <nav class="navbar navbar-toggleable-md w-100 p-0">

                <button id="main-nav-toggle" class="hamburger hamburger--slider main-nav-toggle collapsed hidden-lg-up"
                        data-toggle="collapse" data-target="#main-nav-collapse" aria-controls="main-nav-collapse"
                        aria-expanded="false" aria-label="Toggle navigation">
                    <span class="hamburger-box d-block"><span class="hamburger-inner"></span></span>
                    <span class="fs-11" style="">Menu</span>
                </button>

                <a class="navbar-brand header__logo py-0" href="/">
{{--                    <img class="header__logo-img img-fluid" src="{{ asset('frontend/images/logo1.png') }}" alt="Lending">--}}
                </a>
                <a class="header__call header__call--small media hidden-lg-up ml-3" href="tel:{{ HOTLINE }}">
                    <i class="header__call-icon align-self-center icon-phone-lg d-flex mr-2"></i>
                    <div class="media-body align-self-center">
                        <div class="header__call-number">{{ HOTLINE }}</div>
                        <div class="header__call-time">07:30 - 18:30, Thứ Hai - CN</div>
                    </div>
                </a>
                <div class="collapse navbar-collapse" id="main-nav-collapse">
                    <ul class="main-nav navbar-nav ml-auto">
                        <li class="nav-item active ">
                            <a class="nav-link" href="{{ action('Frontends\Homes\HomeController@index') }}">Trang chủ</a>
                        </li>
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('services.site.list') }}">Cần một khoản vay</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('frontend.listtransaction.site') }}">Sàn giao dịch</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('frontend.page.show', 'about-us') }}">Về Lending</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('category.detail') }}">Tin tức</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('frontend.user.login') }}">Đăng nhập</a>
                            </li>
                        @endguest
                        @auth
                            @if( Auth::user()->type == \PermissionCommon::CHO_VAY )
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('frontend.listtransaction.site') }}">Sàn giao dịch</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ action('Frontends\TransactionHistory\TransactionHistoryController@manage') }}">Quản lý đơn vay</a>
                                </li>
                                <li class="nav-item">
                                    <span class="badge" style="color:white;font-size:9px;background-color:red;position:absolute;top:2px;right:2px">Hot</span>
                                    <a class="nav-link" href="{{ action('Frontends\TransactionHistory\TransactionHistoryController@searchTranByPhoneAndIdCard') }}">
                                        Tra cứu lịch sử vay nợ
                                    </a>
                                </li>
                            @elseif( Auth::user()->type == \PermissionCommon::VAY )
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('services.site.list') }}">Cần một khoản vay</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ action('Frontends\TransactionHistory\TransactionHistoryController@index') }}">Lịch sử đơn vay</a>
                                </li>
                            @endif
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('frontend.user.edit', [\Auth::user()->id]) }}">Tài khoản</a>
                            </li>
                        @endauth
                    </ul>
                </div>
            </nav>
        </div>
    </header>
    <div class="main-page">