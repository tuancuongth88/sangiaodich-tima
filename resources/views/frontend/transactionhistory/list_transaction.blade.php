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
                                        {{ number_format($totalmoney )}}
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
                                        {{ $total_reg_borrow }}
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
                                        {{ $total_reg_loan }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 d-flex">
                <div class="d-flex align-items-center justify-content-center w-100 bg-white border border-gray p-3 p-md-5">
                    @if(Auth::check())
                        <a class="btn btn-primary text-uppercase text-white fs-16 fs-lg-20"
                           href="{{ route('frontends.manager') }}">
                            Quản lý đơn vay
                        </a>
                    @else
                        <a class="btn btn-primary text-uppercase text-white fs-16 fs-lg-20"
                           href="{{ route('frontend.user.register') }}">
                            Tham gia cho vay
                        </a>
                    @endif
                </div>
            </div>
        </div>

        <div class="tm-dtcv bg-white border border-gray p-3 px-md-5 pb-md-5 pt-md-4">
            <h2 class="text-uppercase fs-16 fw-6 mb-0">
                Danh sách đơn xin vay mới trên toàn hệ thống
            </h2>

            <hr class="mb-3">

            <div class="row gutter-2 gutter-lg-3 mb-4">
                <div class="col-md-3 col-sm-6 mb-3 mb-md-0">
                    {{ Form::select('service_code', [0 => 'Tất cả']+App\Models\Services\Service::list_type_service(), null, ['class' => 'form-control border-primary rounded-0 fs-15', 'id' => 'cbPrice']) }}
                </div>

                <div class="col-md-3 col-sm-6 mb-3 mb-md-0">
                    {{ Form::select('service_code', $list_service->pluck('service_name', 'id'), null, ['class' => 'form-control border-primary rounded-0 fs-15', 'id' => 'cbProduct']) }}
                </div>

                <div class="col-md-3 col-sm-6 mb-3 mb-sm-0">
                    {{ Form::select( 'city_id', ['' => 'Chọn thành phố...']+getCityList(), null, ['class' => 'selectpicker form-control input-lg', 'id' => "cbCity", 'required'] ) }}

                </div>

                <div class="col-md-3 col-sm-6">
                    {{ Form::select( 'district_id', ['' => 'Chọn quận huyện ...']+getDistrictList(), null, ['class' => 'selectpicker form-control input-lg', 'id' => "cbDistrict", 'required'] ) }}

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
                                <div class="border-right">STT</div>
                            </th>
                            <th class="text-center ">
                                <div class="border-right">Khách hàng</div>
                            </th>
                            <th class="text-center hidden-xs-down">
                                <div class="border-right">Khu vực</div>
                            </th>
                            <th class="text-center hidden-xs-down">
                                <div rel="-1" field="1" class="sort border-right">Số tiền
                                    <i class="fa fa-sort" aria-hidden="true"></i>
                                </div>
                            </th>
                            <th class="text-center hidden-xs-down">
                                <div rel="-1" field="2" class="sort border-right">Thời gian tạo
                                    <i class="fa fa-sort" aria-hidden="true"></i>
                                </div>
                            </th>
                            <th class="text-center">
                                <div rel="-1" field="3" class="sort border-right">Giá bán
                                    <i class="fa fa-sort" aria-hidden="true"></i>
                                </div>
                            </th>
                            <th class="text-center">
                                <div class="border-right"></div>
                            </th>
                        </tr>
                        @foreach($data as $key => $value)
                        <tr>
                            <td class="h-100 hidden-xs-down">
                                <div class="td-inner d-flex justify-content-center h-100">
                                    <ul class="list-h-1 align-self-start mt-3">
                                        <li class="list-h-1__item">
                                            {{ $key +1 }}
                                        </li>
                                    </ul>
                                </div>
                            </td>
                            <td>
                                <div class="td-inner media">
                                    <div class="icon-male-circle wf-38 d-flex align-self-center mr-3 hidden-xs-down"></div>
                                    <div class="media-body align-self-center text-ellipsis">
                                        <div class="tm-table__para fw-6 line-height-heading mb-1">
                                            {{ $value->user->fullname }}
                                        </div>
                                        <div class="text-gray-lighter">
                                            {{ substrPhone($value->user->phone) }}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="hidden-xs-down">
                                <div class="td-inner d-flex justify-content-center text-center">
                                    <div class="text-nowrap">
                                        {{ isset($value->district_id) ? getLocation($value->district_id)['name'] : "" }}
                                        <hr class="my-0">
                                        {{ isset($value->city_id) ? getLocation($value->city_id)['name'] : "" }}
                                    </div>
                                </div>
                            </td>
                            <td class="hidden-xs-down">
                                <div class="td-inner d-flex justify-content-center text-center">
                                    <div class="text-nowrap">
                                        <span class="text-primary">{{ number_format($value->amount) }} Triệu - {{ $value->amount_day }} Ngày</span>
                                        <hr class="my-0">
                                       {{-- {{ $value->service->service_name }} --}}
                                    </div>
                                </div>
                            </td>


                            <td class="h-100 hidden-xs-down">
                                <div class="td-inner d-flex justify-content-center h-100">
                                    <ul class="list-h-1 align-self-start mt-3">
                                        <?php
$date = strtotime($value->created_at);
?>
                                        <li class="list-h-1__item text-primary">
                                            {{ date('H:i:s', $date) }}
                                        </li>
                                        <li class="list-h-1__item">
                                            {{ date('Y/m/d', $date) }}
                                        </li>
                                    </ul>
                                </div>
                            </td>
                            <td>
                                <div class="td-inner media d-flex justify-content-center text-center">
                                    <div class="text-nowrap">
                                        <div class="text-nowrap">
                                            <span class="text-primary">
                                                11,000 ₫
                                            </span>
                                            <hr class="my-0">
                                            <span style="text-decoration:line-through;font-size:12px;color:#9e9e9e">22,000 ₫ </span>
                                            <span style="font-size:12px;color:black;margin-left:5px;">-50%</span>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="">
                                <div id="277548"
                                     class="td-inner d-flex flex-column align-items-center text-center btnbuy">
                                    <ul class="list-h-1 align-self-start mt-3">
                                        <li class="list-h-1__item">
                                            {{ Form::open(array('method'=>'PUT', 'action' => array('Frontends\TransactionHistory\TransactionHistoryController@putStatusTransaction', $value->id), 'style' => 'display: inline-block;')) }}
                                            <button type="submit" class="btn btn-outline-success btn-sm mr-2"
                                                    onclick="return confirm('Bạn muốn nhận đơn này?');" title="Nhận đơn"><i
                                                        class="fa fa-shopping-cart" aria-hidden="true"></i> Nhận đơn
                                            </button>
                                            {{ Form::close() }}
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
                        {{ $data->links() }}
                        Tổng số {{ $data->total() }} bản ghi
                    </nav>
                </div>
            </div>
        </div>
    </div>
    @include('frontend.common.mohinh')
    @include('frontend.common.tongdai')
    @include('frontend.common.service')
@stop