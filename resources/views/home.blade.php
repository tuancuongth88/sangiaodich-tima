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
    @include('frontend.common.service')
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
                                                {{ isset($listTransaction->district_id) ? getLocation($listTransaction->district_id)['name'] : "" }}
                                                <hr class="my-0">
                                                {{ isset($listTransaction->city_id) ? getLocation($listTransaction->city_id)['name'] : "" }}
                                            </div>
                                        </div>


                                        <div class="tm-table__col tm-table__col--5">
                                            <div class="tm-table__item-td">
                                                <span class="text-primary">{{ number_format($listTransaction->amount) }} VNĐ</span>
                                                <hr class="my-0">
                                                {{  isset($listTransaction->service) ? $listTransaction->service->service_name : "" }}
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
    @include('frontend.common.mohinh')

    @include('frontend.common.tongdai')

    <!--Báo chí nói về Tima-->
    <!--Tin tức-->
    <div class="tm-card mb-5">
        <div class="container" id="topnewsinhomepage">

        </div>
    </div>
    <!-- end tin tuc -->

    <!--Tổng đài-->
@stop