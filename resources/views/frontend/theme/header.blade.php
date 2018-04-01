<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no"/>
    <title>TIMA - SÀN KẾT NỐI TÀI CHÍNH LỚN NHẤT VIỆT NAM</title>
    <meta name="description" content="abc"/>
    <meta name="keywords" content="acb"/>

    <link href="{{ URL::asset('/frontend/css/select2.css') }}" type="text/css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ URL::asset('/frontend/css/bootstrap.4.0.0-beta.3.min.css') }}" type="text/css"/>
    <link rel="stylesheet" href="{{ URL::asset('/frontend/css/style.css') }}" type="text/css"/>
    {{-- <link rel="stylesheet" href="{{ URL::asset('/frontend/css/bootstrap-select.min.css') }}" type="text/css"/> --}}
    <link rel="stylesheet" href="{{ URL::asset('/frontend/css/custom.css') }}" type="text/css"/>
    <link rel="stylesheet" href="{{ URL::asset('/frontend/css/custom_tan.css') }}" type="text/css"/>

    <script>
        var isMobile = 0;
    </script>

</head>

<body>

<div class="page-wrapper page-home">

    <!--start header-->
    <header id="header" class="header">
        <div class="container d-flex flex-row flex-lg-column">
            <div class="topbar header__topbar hidden-md-down">
                <ul class="topbar-list mb-0">
                    <li class="topbar-list__item">
                        <a class="topbar-list__link" href="/User/Register/">Đăng ký</a>
                    </li>
                    <li class="topbar-list__item">
                        <a class="topbar-list__link" href="/User/Login/">
                            Đăng nhập
                        </a>
                    </li>


                    <li class="topbar-list__item">
                        <a class="topbar-list__link" href="/Home/Notification/">
                            Thông báo
                        </a>
                    </li>
                    <li class="topbar-list__item">
                        <a class="topbar-list__link" href="/huong-dan-giao-dich-tren-san-tima.html">
                            Hỗ trợ
                        </a>
                    </li>

                    <li class="topbar-list__item">
                        <a class="topbar-list__link" href="/Home/InstallApp/">
                            <i class="icon-mobile"></i>
                        </a>
                    </li>


                    <li class="topbar-list__item">
                        <a class="topbar-list__link text-primary fs-16 d-flex align-items-center" href="tel:18006919">
                            <i class="icon-phone-gray mr-1"></i>
                            <strong>1800.6919</strong>
                        </a>
                    </li>
                </ul>
            </div>

            <nav class="navbar navbar-toggleable-md w-100 p-0">

                <button id="main-nav-toggle" class="hamburger hamburger--slider main-nav-toggle collapsed hidden-lg-up"
                        data-toggle="collapse" data-target="#main-nav-collapse" aria-controls="main-nav-collapse"
                        aria-expanded="false" aria-label="Toggle navigation">
                <span class="hamburger-box d-block">
                    <span class="hamburger-inner"></span>
                </span>
                    <span class="fs-11" style="">Menu</span>

                </button>

                <a class="navbar-brand header__logo py-0" href="/">
                    <img class="header__logo-img img-fluid" src="{{ asset('frontend/images/logo1.png') }}" alt="Tima">
                </a>
                <a class="header__call header__call--small media hidden-lg-up ml-3" href="tel:18006919">
                    <i class="header__call-icon align-self-center icon-phone-lg d-flex mr-2"></i>
                    <div class="media-body align-self-center">
                        <div class="header__call-number">
                            1800 6919
                        </div>
                        <div class="header__call-time">
                            07:30 - 18:30, Thứ Hai - CN
                        </div>
                    </div>
                </a>
                <div class="collapse navbar-collapse" id="main-nav-collapse">
                    <ul class="main-nav navbar-nav ml-auto">
                        <li class="nav-item active ">
                            <a class="nav-link" href="/">Trang chủ <span class="sr-only">(current)</span></a>
                        </li>

                        <li class="nav-item  ">
                            <a class="nav-link" href="/Borrower/">Cần một khoản vay</a>
                        </li>

                        <li class="nav-item  ">
                            <a class="nav-link" href="/san-giao-dich.html">SÀN GIAO DỊCH</a>
                        </li>


                        <li class="nav-item  ">
                            <a class="nav-link" href="/Home/About/">VỀ TIMA</a>
                        </li>
                        <li class="nav-item shomb  ">
                            <a class="nav-link" href="/news/">Tin tức</a>
                        </li>

                        <li class="nav-item hidden-md-up  ">
                            <a class="nav-link" href="/Home/Support/">Trung tâm hỗ trợ</a>
                        </li>
                        <li class="nav-item  ">
                            <a class="nav-link" href="/User/Login/">Đăng nhập</a>
                        </li>


                    </ul>
                </div>
            </nav>
        </div>
    </header>
    <div class="main-page">