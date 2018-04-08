@extends('frontend.app')
@section('title','DASHBOARD ADMINISTRATOR')

@section('content')

    <div id="main-slider-swiper" class="main-slider">
        <div class="swiper-wrapper">
            @foreach($data as $value)
            <div class="main-slider__item swiper-slide">
                <div class="main-slider__bg" style="background-image:url('{{ $value->image_url }}');"></div>

                <div class="container">
                    <div class="main-slider__content text-center w-100 w-md-100 mx-auto">
                        <h1 class="main-slider__heading">
                            {{ $value->name }}
                        </h1>
                        <p class="main-slider__lead mb-0">
                            {{ $value->description }}
                        </p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div id="main-slider__pagination" class="swiper-pagination main-slider__pagination"></div>

        <div class="main-slider__nav container">
            <div id="main-slider__next" class="swiper-button-prev main-slider__next"></div>
            <div id="main-slider__prev" class="swiper-button-next main-slider__prev"></div>
        </div>
    </div>
    <div class="tm-strong">
        <div class="container">

            <div class="tm-strong__inner d-flex flex-column flex-md-row">
                <p class="mb-0 mr-3 mb-3 mb-md-0">
                    Tổng số tiền đã được giải ngân :
                </p>

                <div class="d-flex align-items-center">
                    <div class="incremental-counter d-flex mr-10px mr-lg-3" data-value="{{ $totalmoney }}"></div>
                    <span class="text-uppercase font-secondary">Triệu</span>
                </div>
            </div>

        </div>
    </div>
    @include('frontend.theme.service')
    <!--Danh sách đơn vay mới nhất & thống kê-->
    <div class="tm-list-dxv mb-5">
        <div class="container">
            <div class="rounded bg-white p-3 pt-4">
            <div class="row">
                <div class="col-main col-xl-9 border-right mb-6 mb-xl-0">
                    <div class="tm-card">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h2 class="tm-card__heading--2 text-uppercase mb-0">
                                DANH SÁCH ĐƠN XIN VAY MỚI Nhất
                            </h2>

                            <div class="tm-card__filter dropdown">
                                <a class="d-flex align-items-center line-height-heading" aria-expanded="false"
                                   href="/Lender/">
                                    Xem tất cả <i class="icon-angle-down ml-3"></i>
                                </a>
                            </div>
                        </div>

                        <hr class="my-0">

                        <div class="tm-table-wrap table-responsive">
                            <div class="tm-table tm-table-swiper swiper-container">
                                <div class="swiper-wrapper">
                                    @foreach($list_transaction as $listTransaction)
                                    <div class="tm-table__row swiper-slide">
                                        <div class="tm-table__col tm-table__col--1">
                                            <div class="tm-table__item-td media">
                                                <div class="icon-male-circle wf-38 d-flex align-self-center mr-3"></div>
                                                <div class="media-body align-self-center text-ellipsis">
                                                    <div class="tm-table__para fw-6 text-primary">
                                                        {{ $listTransaction->userVay->fullname }}
                                                    </div>
                                                    <div class="tm-table__para text-gray-light">
                                                        {{ substrPhone($listTransaction->userVay->phone) }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="tm-table__col tm-table__col--3">
                                            <div class="tm-table__item-td">
                                                {{ getLocation($listTransaction->district_id)['name'] }}
                                                <hr class="my-0">
                                                {{ getLocation($listTransaction->city_id)['name'] }}
                                            </div>
                                        </div>


                                        <div class="tm-table__col tm-table__col--5">
                                            <div class="tm-table__item-td">
                                                <span class="text-primary">{{ number_format($listTransaction->amount) }} VNĐ</span>
                                                <hr class="my-0">
                                                {{ $listTransaction->service->service_name }}
                                            </div>
                                        </div>

                                        <div class="tm-table__col tm-table__col--4">
                                            <div class="tm-table__item-td">
                                                <div class="tm-table__para fw-6">
                                                    {{ minusDay($listTransaction->payment_day, $listTransaction->created_at) }}
                                                </div>
                                                <div class="tm-table__para text-gray-light">
                                                    Ngày
                                                </div>
                                            </div>
                                        </div>

                                        <div class="tm-table__col tm-table__col--6">
                                            <div class="d-inline-block text-left">
                                                <div class="tm-table__para fw-6">
                                                    <?php
                                                    $date = strtotime($listTransaction->created_at);
                                                    ?>
                                                    {{ date('H:i:s', $date) }}
                                                </div>
                                                <div class="tm-table__para text-gray-light">
                                                    {{ date('Y/m/d', $date) }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <hr class="mt-0 mb-3">

                        <div class="d-flex flex-column flex-md-row align-items-center justify-content-between">
                            <div class="text-center text-md-left mb-3 mb-md-0">
                                Chúng tôi có hàng nghìn đơn xin vay mỗi ngày!
                            </div>
                            <a class="btn btn-lg btn-success px-5 text-white fs-16" href="{{ action('Frontends\Users\UsersController@getRegisterForm') }}">
                                ĐĂNG KÝ VAY NGAY
                            </a>
                            <a class="btn btn-lg btn-primary px-5 text-white fs-16" href="{{ action('Frontends\Users\UsersController@getRegisterForm') }}">
                                THAM GIA CHO VAY
                            </a>
                        </div>
                    </div>
                </div>


                <div class="col-aside col-xl-3" id="Statistical">
                    <div class="tm-card">
                        <h2 class="tm-card__heading--2 text-uppercase mb-3">
                            Thống kê
                        </h2>

                        <hr class="mt-0 mb-5">


                        <div class="tm-card__body tm-stats" id="divStaticsForLoanNew">
                            <div class="row">


                                <div class="col-xl-12 col-md-3 col-6">
                                    <div class="tm-stats__item media flex-column flex-lg-row mb-5">
                                        <div class="tm-stats__thumb d-flex justify-content-center mr-lg-3 mb-3 mb-lg-0">
                                            <i class="icon-survey "></i>
                                        </div>
                                        <div class="media-body text-center text-lg-left">
                                            <p class="tm-stats__heading mb-0">
                                                Đơn vay mới trong ngày
                                            </p>
                                            <p class="tm-stats__num mb-0">
                                                {{ $total_bill_on_day }}
                                            </p>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-xl-12 col-md-3 col-6">
                                    <div class="tm-stats__item media flex-column flex-lg-row mb-5">
                                        <div class="tm-stats__thumb d-flex justify-content-center mr-lg-3 mb-3 mb-lg-0">
                                            <i class="icon-monitor "></i>
                                        </div>
                                        <div class="media-body text-center text-lg-left">
                                            <p class="tm-stats__heading mb-0">
                                                Tổng đơn vay trên hệ thống
                                            </p>
                                            <p class="tm-stats__num mb-0">
                                                {{ $total_bill_system }}
                                            </p>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-xl-12 col-md-3 col-6">
                                    <div class="tm-stats__item media flex-column flex-lg-row mb-5">
                                        <div class="tm-stats__thumb d-flex justify-content-center mr-lg-3 mb-3 mb-lg-0">
                                            <i class="icon-call-center "></i>
                                        </div>
                                        <div class="media-body text-center text-lg-left">
                                            <p class="tm-stats__heading mb-0">
                                                Tổng đơn đã được tư vấn
                                            </p>
                                            <p class="tm-stats__num mb-0">
                                                0
                                            </p>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-xl-12 col-md-3 col-6">
                                    <div class="tm-stats__item media flex-column flex-lg-row mb-5">
                                        <div class="tm-stats__thumb d-flex justify-content-center mr-lg-3 mb-3 mb-lg-0">
                                            <i class="icon-coin "></i>
                                        </div>
                                        <div class="media-body text-center text-lg-left">
                                            <p class="tm-stats__heading mb-0">
                                                Tổng tiền giải ngân
                                            </p>

                                            <p class="tm-stats__num mb-0">
                                                {{ number_format($totalmoney )}}
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-12 col-md-3 col-6">
                                    <div class="tm-stats__item media flex-column flex-lg-row mb-5">
                                        <div class="tm-stats__thumb d-flex justify-content-center mr-lg-3 mb-3 mb-lg-0">
                                            <i class="icon-call-center "></i>
                                        </div>
                                        <div class="media-body text-center text-lg-left">
                                            <p class="tm-stats__heading mb-0">
                                                Số người đăng ký vay
                                            </p>
                                            <p class="tm-stats__num mb-0">
                                                {{ number_format($total_reg_borrow) }}
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-12 col-md-3 col-6">
                                    <div class="tm-stats__item media flex-column flex-lg-row mb-5">
                                        <div class="tm-stats__thumb d-flex justify-content-center mr-lg-3 mb-3 mb-lg-0">
                                            <i class="icon-call-center "></i>
                                        </div>
                                        <div class="media-body text-center text-lg-left">
                                            <p class="tm-stats__heading mb-0">
                                                Số người tham gia cho vay
                                            </p>
                                            <p class="tm-stats__num mb-0">
                                                {{ number_format($total_reg_loan) }}
                                            </p>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
    </div>

    <!--Mô hình hoạt động-->

    <div class="tm-card bg-white py-5 mb-md-2">
        <div class="container of-hidden">
            <h2 class="tm-card__heading text-center mb-6">
                Mô hình hoạt động sàn <span class="hidden-sm-down">Tima</span>
            </h2>

            <div class="tm-card__body tm-steps">


                <div class="row">

                    <div class="tm-steps__item col-md-3">
                        <div class="tm-steps__thumb mb-4 hidden-sm-down">
                            <img class="tm-steps__img img-responsive mx-auto" src="frontend/images/1s.png"
                                 alt="Đăng ký vay">
                        </div>

                        <div class="tm-steps__body media">
                            <div class="tm-steps__num mr-10px">
                                1
                            </div>
                            <div class="media-body">
                                <h3 class="tm-steps__heading text-primary mb-1">
                                    Đăng ký vay
                                </h3>
                                <div class="tm-steps__lead">
                                    Hoàn tất điền thông tin trong 1 phút
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="tm-steps__item col-md-3">
                        <div class="tm-steps__thumb mb-4 hidden-sm-down">
                            <img class="tm-steps__img img-responsive mx-auto"
                                 src="frontend/images/2s.png"
                                 alt="Kết nối ">
                        </div>

                        <div class="tm-steps__body media">
                            <div class="tm-steps__num mr-10px">
                                2
                            </div>
                            <div class="media-body">
                                <h3 class="tm-steps__heading text-primary mb-1">
                                    Kết nối
                                </h3>
                                <div class="tm-steps__lead">
                                    Ngay lập tức người cho vay sẽ nhận được đơn xin vay của bạn
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="tm-steps__item col-md-3">
                        <div class="tm-steps__thumb mb-4 hidden-sm-down">
                            <img class="tm-steps__img img-responsive mx-auto"
                                 src="frontend/images/3s.png"
                                 alt="Xét duyệt">
                        </div>

                        <div class="tm-steps__body media">
                            <div class="tm-steps__num mr-10px">
                                3
                            </div>
                            <div class="media-body">
                                <h3 class="tm-steps__heading text-primary mb-1">
                                    Xét duyệt
                                </h3>
                                <div class="tm-steps__lead">
                                    Nhận kết quả nhanh chóng sau khi gửi hồ sơ
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="tm-steps__item col-md-3">
                        <div class="tm-steps__thumb mb-4 hidden-sm-down">
                            <img class="tm-steps__img img-responsive mx-auto"
                                 src="frontend/images/4s.png"
                                 alt="Nhận tiền">
                        </div>

                        <div class="tm-steps__body media" style="margin-bottom:0px;">
                            <div class="tm-steps__num mr-10px">
                                4
                            </div>
                            <div class="media-body">
                                <h3 class="tm-steps__heading text-primary mb-1">
                                    Nhận tiền
                                </h3>
                                <div class="tm-steps__lead">
                                    Tiền sẽ được chuyển vào tài khoản của bạn hoặc nhận tiền mặt
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
    <div class="tm-card py-4 py-md-0">
        <div class="container">
            <div class="tm-card__body tm-support d-flex justify-content-between align-items-center">

                <h3 class="tm-support__heading d-flex align-items-center mb-0 hidden-sm-down">
                    <img class="align-self-end mx-4" src="frontend/images/callcenter-g.png"
                         alt="Tổng đài tư vấn miễn phí">
                    <span class="hidden-sm-down">Tổng đài tư vấn miễn phí</span>
                </h3>

                <a class="tm-support__number d-flex align-items-center" href="tel:18006919">
                    <i class="icon-phone mr-1 mr-md-3"></i>
                    1800 6919
                </a>

                <a class="d-flex align-items-center" href="/Home/Support/">
                    <i class="icon-faq mr-md-3"></i>
                    <span class="hidden-md-down">Câu hỏi thường gặp</span>
                </a>

                <a class="d-flex align-items-center" href="/User/Register/">
                    <i class="icon-accounts mr-md-3"></i>
                    <span class="hidden-md-down">Đăng ký</span>
                </a>

            </div>
        </div>
    </div>

    <!--Báo chí nói về Tima-->
    <!--Tin tức-->
    <div class="tm-card mb-5">
        <div class="container" id="topnewsinhomepage">

        </div>
    </div>
    <!-- end tin tuc -->

    <!--Tổng đài-->
@stop