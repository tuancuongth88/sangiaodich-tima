@extends('frontend.app')
@section('title','DASHBOARD ADMINISTRATOR')

@section('content')
    <div class="main-page">
        <div class="container py-5">
            <!-- THỐNG KÊ --->
            <div class="row mb-5">
                <div class="col-xl-12 mb-3 mb-xl-0">
                    <div class="bg-white border border-gray p-3 px-md-5 pb-md-5 pt-md-4">
                        <h2 class="tm-account__header text-uppercase fs-16 fw-6 mb-0">
                            Thống kê
                        </h2>

                        <hr class="mb-3 mb-md-5">

                        <div class="row" id="divStatics">
                            <div class="col-md-3 d-flex mb-3 mb-md-0">
                                <div class="media w-100">
                                    <div class="icon-vnd-circle d-flex mr-3 align-self-center"></div>
                                    <div class="media-body align-self-center">
                                        <h3 class="fs-14 fs-lg-16 fw-6 text-gray-light mb-0 mt-1">
                                            Đơn chờ bạn nhận
                                        </h3>
                                        <p class="fs-16 fs-lg-20 fw-6 text-gray mb-0">
                                            0
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3 d-flex mb-3 mb-md-0">
                                <div class="media w-100">
                                    <div class="icon-users-circle d-flex mr-3 align-self-center"></div>
                                    <div class="media-body align-self-center">
                                        <h3 class="fs-14 fs-lg-16 fw-6 text-gray-light mb-0 mt-1">
                                            Đơn chờ bạn tư vấn
                                        </h3>
                                        <p class="fs-16 fs-lg-20 fw-6 text-gray mb-0">
                                            0
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3 d-flex">
                                <div class="media w-100">
                                    <div class="icon-growth-circle d-flex mr-3 align-self-center"></div>
                                    <div class="media-body align-self-center">
                                        <h3 class="fs-14 fs-lg-16 fw-6 text-gray-light mb-0 mt-1">
                                            Đơn đang vay
                                        </h3>
                                        <p class="fs-16 fs-lg-20 fw-6 text-gray mb-0">
                                            0
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 d-flex mb-3 mb-md-0">
                                <div class="media w-100">
                                    <div class="icon-vnd-circle d-flex mr-3 align-self-center"></div>
                                    <div class="media-body align-self-center">
                                        <h3 class="fs-14 fs-lg-16 fw-6 text-gray-light mb-0 mt-1">
                                            Tổng tiền đang cho vay
                                        </h3>
                                        <p class="fs-16 fs-lg-20 fw-6 text-gray mb-0">
                                            0
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>

            <!-- DANH SÁCH ĐƠN VAY-->
            <div class="tm-dtcv bg-white border border-gray p-3 px-md-5 pb-md-5 pt-md-4">
                <h2 class="text-uppercase fs-16 fw-6 mb-0">
                    Danh sách đơn vay được chuyển đến bạn
                </h2>

                <hr class="mb-3">

                <div class="row gutter-2 gutter-lg-3 mb-4">
                    <div class="col-md-3 col-sm-6 mb-3 mb-md-0">
                        <select class="form-control border-primary rounded-0 fs-15" id="cbProduct">
                            <option value="-10">Chọn Gói Sản Phẩm...</option>
                            @foreach ($services as $key_sv=>$val_sv)
                                <option value="{{ $key_sv['id'] }}">
                                    {{ $val_sv['service_name'] }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3 col-sm-6 mb-3 mb-md-0">
                        <select class="form-control border-primary rounded-0 fs-15" id="cbStatus">
                            <option selected value="-10">Tất cả trạng thái</option>
                            @foreach ($list_status as $key_stt=>$val_stt)
                                <option value="{{ $key_stt }}">
                                    {{ $val_stt }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3 col-sm-6 mb-3 mb-md-0">
                        <a class="btn btn-primary text-uppercase text-white fs-16" href="#">
                            Tìm kiếm
                        </a>
                    </div>
                </div>

                <div id="divLoanAllNew">
                    <style>
                        .addtocart:hover {
                            border-bottom: 2px solid #ccc;
                            border-bottom-right-radius: 10px;
                            border-bottom-left-radius: 10px;
                            margin-top: 5px;
                        }

                        .addtocart:hover {
                            cursor: pointer;
                        }

                        .sort {
                            cursor: pointer;
                        }
                    </style>
                    <div class="table-responsive">
                        <table class="tm-table-1 table text-gray-light" style="min-width:unset">
                            <tbody>
                            <tr>
                                <th class="text-center hidden-xs-down">
                                    <div class="border-right">
                                        STT
                                    </div>
                                </th>
                                <th class="text-center ">
                                    <div class="border-right">
                                        Mã hợp đồng
                                    </div>
                                </th>
                                <th class="text-center hidden-xs-down">
                                    <div class="border-right">
                                        Thời gian tạo
                                    </div>
                                </th>
                                <th class="text-center hidden-xs-down">
                                    <div rel="-1" field="1" class="sort border-right">
                                        Gói vay
                                        <i class="fa fa-sort" aria-hidden="true"></i>
                                    </div>
                                </th>
                                <th class="text-center hidden-xs-down">
                                    <div rel="-1" field="2" class="sort border-right">
                                        Thời gian vay
                                        <i class="fa fa-sort" aria-hidden="true"></i>
                                    </div>
                                </th>
                                <th class="text-center">
                                    <div rel="-1" field="3" class="sort border-right">
                                        Số tiền
                                        <i class="fa fa-sort" aria-hidden="true"></i>
                                    </div>
                                </th>
                                <th class="text-center">
                                    <div rel="-1" field="3" class="sort border-right">
                                        Nhận đơn
                                        <i class="fa fa-sort" aria-hidden="true"></i>
                                    </div>
                                </th>
                                <th class="text-center">
                                    <div class="border-right">
                                        Trạng thái
                                    </div>
                                </th>
                            </tr>
                            @foreach ($data as $key_data=>$data_val)
                                <tr>
                                    <td class="h-100 hidden-xs-down">
                                        <div class="td-inner d-flex justify-content-center h-100">
                                            <ul class="list-h-1 align-self-start mt-3">
                                                <li class="list-h-1__item">
                                                    {{$key_data +1}}
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="td-inner media">
                                            <div class="media-body align-self-center text-ellipsis">
                                                <div class="tm-table__para fw-6 line-height-heading mb-1">
                                                    HD-{{$data_val['id']}}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="hidden-xs-down">
                                        <div class="td-inner d-flex justify-content-center text-center">
                                            <div class="text-nowrap">
                                                {{$data_val['created_at']}}
                                            </div>
                                        </div>
                                    </td>
                                    <td class="hidden-xs-down">
                                        <div class="td-inner d-flex justify-content-center text-center">
                                            <div class="text-nowrap">
                                                {{$data_val->service->service_name}}
                                            </div>
                                        </div>
                                    </td>
                                    <td class="h-100 hidden-xs-down">
                                        <div class="td-inner d-flex justify-content-center h-100">
                                            <ul class="list-h-1 align-self-start mt-3">
                                                <li class="list-h-1__item text-primary">
                                                    {{$data_val['created_at']}}
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="td-inner media d-flex justify-content-center text-center">
                                            <div class="text-nowrap">
                                                <div class="text-nowrap">
                                                    {{$data_val['fee']}}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="td-inner media d-flex justify-content-center text-center">
                                            <div class="text-nowrap">
                                                <div class="text-nowrap">
                                                    {{$data_val['fee']}}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="">
                                        <div id="277548"
                                             class="td-inner d-flex flex-column align-items-center text-center btnbuy">
                                            <ul class="list-h-1 align-self-start mt-3">
                                                <li class="list-h-1__item">
                                                    <button type="button" class="btn btn-outline-success btn-sm mr-2"
                                                            data-toggle="modal" data-target="#myModal" title="Nhận đơn">
                                                        <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                                        {{isset($list_status[$data_val['status']])?
                                                        $list_status[$data_val['status']]:'Đã hủy'
                                                        }}
                                                    </button>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    <hr>


                    <div class="d-flex">
                        <nav class="d-flex justify-content-between ml-lg-2" aria-label="Page navigation">
                            <ul class="pagination pagination-sm mb-0 mr-3">
                                <li class="page-item page-item--prev d-flex">
                                    <a class="page-link" href="#">Prev</a>
                                </li>
                                <li class="page-item d-flex align-items-center">
                                    <div class="px-3 text-nowrap"><span id="lblCurrentPage">1</span> of 1368</div>
                                </li>
                                <li class="page-item page-item--next d-flex">
                                    <a class="page-link" href="#">Next</a>
                                </li>
                            </ul>
                        </nav>
                    </div>

                </div>
            </div>
        </div>

        <div class="tm-card bg-white py-5 mb-5">
            <div class="container">
                <h2 class="tm-card__heading text-center mb-6">
                    Các gói sản phẩm vay
                </h2>

                <div class="tm-card__body tm-feature">
                    <div id="tm-feature-swiper" class="swiper-container">
                        <div class="swiper-wrapper">
                            <div class="tm-feature__item swiper-slide text-center">
                                <a href="/vay-theo-cam-co-tai-san.html">
                                    <div class="tm-feature__thumb mb-2 mx-auto">
                                        <img src="files/images/11.png" alt="cam-co-tai-san"
                                             style="width:88px"/>
                                    </div>
                                </a>
                                <h3 class="tm-feature__title">
                                    <a href="/vay-theo-cam-co-tai-san.html">
                                        Vay cầm cố tài sản
                                    </a>
                                </h3>
                            </div>
                            <div class="tm-feature__item swiper-slide text-center">
                                <a href="/vay-tin-chap.html">
                                    <div class="tm-feature__thumb mb-2 mx-auto">

                                        <img src="files/images/1.png" style="width:88px"/>
                                    </div>
                                </a>

                                <h3 class="tm-feature__title">
                                    <a href="/vay-tin-chap.html">
                                        Vay tín chấp <br> theo lương
                                    </a>
                                </h3>
                            </div>

                            <div class="tm-feature__item swiper-slide text-center">
                                <a href="/vay-qua-so-ho-khau.html">
                                    <div class="tm-feature__thumb mb-2 mx-auto">

                                        <img src="files/images/3.png" style="width:88px"/>
                                    </div>
                                </a>

                                <h3 class="tm-feature__title">
                                    <a href="/vay-qua-so-ho-khau.html">
                                        Vay theo sổ <br> hộ khẩu
                                    </a>
                                </h3>
                            </div>
                            <div class="tm-feature__item swiper-slide text-center">
                                <a href="/vay-theo-hoa-don-dien-nuoc.html">
                                    <div class="tm-feature__thumb mb-2 mx-auto">

                                        <img src="files/images/9.png" style="width:88px"/>
                                    </div>
                                </a>
                                <h3 class="tm-feature__title">
                                    <a href="/vay-theo-hoa-don-dien-nuoc.html">
                                        Vay theo hóa<br/> đơn điện nước
                                    </a>
                                </h3>
                            </div>
                            <div class="tm-feature__item swiper-slide text-center">
                                <a href="/vay-tra-gop.html">
                                    <div class="tm-feature__thumb mb-2 mx-auto">

                                        <img src="files/images/5.png" style="width:88px"/>
                                    </div>
                                </a>

                                <h3 class="tm-feature__title">
                                    <a href="/vay-tra-gop.html">
                                        Vay trả góp <br> theo ngày
                                    </a>
                                </h3>
                            </div>
                            <div class="tm-feature__item swiper-slide text-center">
                                <a href="/cam-dang-ky-xe.html">
                                    <div class="tm-feature__thumb mb-2 mx-auto">

                                        <img src="files/images/2.png" style="width:88px"/>
                                    </div>
                                </a>
                                <h3 class="tm-feature__title">
                                    <a href="/cam-dang-ky-xe.html">
                                        Vay theo đăng <br> ký xe máy
                                    </a>
                                </h3>
                            </div>

                            <div class="tm-feature__item swiper-slide text-center">
                                <a href="/cam-dang-ky-o-to.html">
                                    <div class="tm-feature__thumb mb-2 mx-auto">

                                        <img src="files/images/4.png" style="width:88px"/>
                                    </div>
                                </a>

                                <h3 class="tm-feature__title">
                                    <a href="/cam-dang-ky-o-to.html">
                                        Cầm đăng ký ô tô
                                    </a>
                                </h3>
                            </div>


                            <div class="tm-feature__item swiper-slide text-center">
                                <a href="/cam-o-to.html">
                                    <div class="tm-feature__thumb mb-2 mx-auto">
                                        <img src="files/images/7.png" style="width:88px"/>
                                    </div>
                                </a>
                                <h3 class="tm-feature__title">
                                    <a href="/cam-o-to.html">
                                        Cầm ô tô
                                    </a>
                                </h3>
                            </div>

                            <div class="tm-feature__item swiper-slide text-center">
                                <a href="/vay-mua-o-to-tra-gop.html">
                                    <div class="tm-feature__thumb mb-2 mx-auto">
                                        <img src="files/images/8.png" style="width:88px"/>
                                    </div>
                                </a>
                                <h3 class="tm-feature__title">
                                    <a href="/vay-mua-o-to-tra-gop.html">
                                        Vay mua <br> ô tô trả góp
                                    </a>
                                </h3>
                            </div>
                            <div class="tm-feature__item swiper-slide text-center">
                                <a href="vay-mua-nha-tra-gop.html">
                                    <div class="tm-feature__thumb mb-2 mx-auto">
                                        <img src="files/images/6.png" style="width:88px"/>
                                    </div>
                                </a>
                                <h3 class="tm-feature__title">
                                    <a href="vay-mua-nha-tra-gop.html">
                                        Vay mua <br> nhà trả góp
                                    </a>
                                </h3>
                            </div>


                        </div>
                    </div>
                    <div class="tm-feature__nav container stick-center">
                        <div id="tm-feature__next" class="swiper-button-prev tm-feature__next"></div>
                        <div id="tm-feature__prev" class="swiper-button-next tm-feature__prev"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop