@extends('frontend.app')
@section('title','DASHBOARD ADMINISTRATOR')

@section('content')

    <div class="container py-5">

        <div class="row mb-5">
            <div class="col-xl-9 mb-3 mb-xl-0">
                <div class="bg-white border border-gray p-3 px-md-5 pb-md-5 pt-md-4">
                    <h2 class="tm-account__header text-uppercase fs-16 fw-6 mb-0">
                        Thống kê trên toàn hệ thống
                    </h2>

                    <hr class="mb-3 mb-md-5">

                    <div class="row" id="divStatics">
                        <div class="col-md-4 d-flex mb-3 mb-md-0">
                            <div class="media w-100">
                                <div class="icon-vnd-circle d-flex mr-3 align-self-center"></div>
                                <div class="media-body align-self-center">
                                    <h3 class="fs-14 fs-lg-16 fw-6 text-gray-light mb-0 mt-1">
                                        Tổng tiền cho vay
                                    </h3>
                                    <p class="fs-16 fs-lg-20 fw-6 text-gray mb-0">
                                        22,432,602,000,000
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 d-flex mb-3 mb-md-0">
                            <div class="media w-100">
                                <div class="icon-users-circle d-flex mr-3 align-self-center"></div>
                                <div class="media-body align-self-center">
                                    <h3 class="fs-14 fs-lg-16 fw-6 text-gray-light mb-0 mt-1">
                                        Tổng số người vay
                                    </h3>
                                    <p class="fs-16 fs-lg-20 fw-6 text-gray mb-0">
                                        1,105,112
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 d-flex">
                            <div class="media w-100">
                                <div class="icon-growth-circle d-flex mr-3 align-self-center"></div>
                                <div class="media-body align-self-center">
                                    <h3 class="fs-14 fs-lg-16 fw-6 text-gray-light mb-0 mt-1">
                                        Tổng số người cho vay
                                    </h3>
                                    <p class="fs-16 fs-lg-20 fw-6 text-gray mb-0">
                                        9,729
                                    </p>
                                </div>
                            </div>
                        </div></div>
                </div>
            </div>

            <div class="col-xl-3 d-flex">
                <div class="d-flex align-items-center justify-content-center w-100 bg-white border border-gray p-3 p-md-5">
                    {{ isUser() }}
                    <a class="btn btn-primary text-uppercase text-white fs-16 fs-lg-20" href="{{ route('frontend.user.register') }}">
                        Tham gia cho vay
                    </a>

                </div>
            </div>
        </div>


    </div>
@stop