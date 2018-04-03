@extends('frontend.app')
@section('title','DASHBOARD ADMINISTRATOR')

@section('content')
    <div class="main-page">
        <div class="container py-5">
            <!-- THỐNG KÊ --->
            <div class="row mb-5">
                <div class="col-xl-9 mb-3 mb-xl-0">
                    <div class="bg-white border border-gray p-3 px-md-5 pb-md-5 pt-md-4">
                        <h2 class="tm-account__header text-uppercase fs-16 fw-6 mb-0">
                            Thống kê
                        </h2>
                        <hr class="mb-3 mb-md-5">
                        <div class="row" id="divStatics">
                            <div class="col-md-4 d-flex mb-3 mb-md-0">
                                <div class="media w-100">
                                    <div class="icon-vnd-circle d-flex mr-3 align-self-center"></div>
                                    <div class="media-body align-self-center">
                                        <h3 class="fs-14 fs-lg-16 fw-6 text-gray-light mb-0 mt-1">
                                            Tổng đơn đăng ký
                                        </h3>
                                        <p class="fs-16 fs-lg-20 fw-6 text-gray mb-0">
                                            {{$count_all_tran}}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 d-flex mb-3 mb-md-0">
                                <div class="media w-100">
                                    <div class="icon-users-circle d-flex mr-3 align-self-center"></div>
                                    <div class="media-body align-self-center">
                                        <h3 class="fs-14 fs-lg-16 fw-6 text-gray-light mb-0 mt-1">
                                            Tổng đơn chờ nhận
                                        </h3>
                                        <p class="fs-16 fs-lg-20 fw-6 text-gray mb-0">
                                            {{$count_tran_wait}}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 d-flex">
                                <div class="media w-100">
                                    <div class="icon-growth-circle d-flex mr-3 align-self-center"></div>
                                    <div class="media-body align-self-center">
                                        <h3 class="fs-14 fs-lg-16 fw-6 text-gray-light mb-0 mt-1">
                                            Tổng đơn hủy
                                        </h3>
                                        <p class="fs-16 fs-lg-20 fw-6 text-gray mb-0">
                                            {{$count_tran_cancel}}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 d-flex">
                    <div class="d-flex align-items-center justify-content-center w-100 bg-white border border-gray p-3 p-md-5">
                        <a class="btn btn-primary text-uppercase text-white fs-16 fs-lg-20"
                           href="http://tima.vn/Borrower/">
                            Đăng ký vay ngay
                        </a>
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
                                <option value="{{ $val_sv['id'] }}">
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
                            <tr class="header-table-tran">
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
                                <th class="text-center">
                                    <div class="border-right">
                                        &nbsp;
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
                                    <td>
                                        <div class="td-inner media d-flex justify-content-center text-center">
                                            <div class="text-nowrap">
                                                <div class="text-nowrap">
                                                    <span class="badge badge-danger align-self-center">
                                                        {{isset($list_status[$data_val['status']])?
                                                        $list_status[$data_val['status']]:'Đã hủy'
                                                        }}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="">
                                        <div id="277548"
                                             class="td-inner d-flex flex-column align-items-center text-center btnbuy">
                                            <ul class="list-h-1 align-self-start mt-3">
                                                <li class="list-h-1__item">
                                                    @if($data_val['status']==1)
                                                        <button type="button"
                                                                class="btn btn-outline-danger btn-sm updatestatus"
                                                                data-toggle="modal" data-target="#myModal"
                                                                title="Hủy đơn vay"
                                                                onclick="showModal(4, '', '{{$data_val['id']}}', '5,000,000' )">
                                                            Hủy
                                                        </button>
                                                    @else
                                                        &nbsp;&nbsp;
                                                    @endif
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
                        <nav class="d-flex justify-content-between ml-lg-2 navigation-tran "
                             aria-label="Page navigation">
                            {{ $data->links() }}
                        </nav>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div id="myModal" class="modal fade" role="dialog" style="display: none;" aria-hidden="true">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content" style="width:110%">
                <div class="modal-header">

                    <h6 class="modal-title" id="title"></h6>
                    <button type="button" class="close" data-dismiss="modal">×</button>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"
                            id="btnLoanerAccept" onclick="LoanerCancelLoanCredit(289730);">Đồng ý
                    </button>
                    <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Hủy</button>

                </div>
            </div>

        </div>
    </div>

    <script type="text/javascript">
        jQuery(document).ready(function () {
            paginationInit();
            $('#cbProduct').change(function () {
                var product = $(this).val();
                var status = $('#cbStatus').val();
                $.ajax(
                    {
                        url: "transactionhistory/search?product=" + product + "&status=" + status,
                        type: "get",
                        datatype: "html"
                    })
                    .done(function (data) {
                        $("table tr").not('.header-table-tran').remove();
                        $("table tbody").append(data.html);
                        $(".navigation-tran").empty();
                        $(".navigation-tran").append(data.pagination);
                        paginationInit();
                    })
                    .fail(function (jqXHR, ajaxOptions, thrownError) {
                        alert('No response from server');
                    });
                return false;
            });

            $('#cbStatus').change(function () {
                var product = $('#cbProduct').val();
                var status = $(this).val();
                $.ajax(
                    {
                        url: "transactionhistory/search?product=" + product + "&status=" + status,
                        type: "get",
                        datatype: "html"
                    })
                    .done(function (data) {
                        $("table tr").not('.header-table-tran').remove();
                        $("table tbody").append(data.html);
                        $(".navigation-tran").empty();
                        $(".navigation-tran").append(data.pagination);
                        paginationInit();
                    })
                    .fail(function (jqXHR, ajaxOptions, thrownError) {
                        alert('No response from server');
                    });
                return false;
            });

            function paginationInit() {
                $('ul.pagination .page-link').click(function (e) {
                    e.preventDefault();
                    var url_href = $(this).attr('href');
                    if (url_href === undefined) {
                        return;
                    }
                    var product = $('#cbProduct').val();
                    var status = $('#cbStatus').val();
                    $.ajax(
                        {
                            url: url_href + "&product=" + product + "&status=" + status,
                            type: "get",
                            datatype: "html"
                        })
                        .done(function (data) {
                            $("table tr").not('.header-table-tran').remove();
                            $("table tbody").append(data.html);
                            $(".navigation-tran").empty();
                            $(".navigation-tran").append(data.pagination);
                            paginationInit();
                        })
                        .fail(function (jqXHR, ajaxOptions, thrownError) {
                            alert('No response from server');
                        });
                    return false;
                });
            }

        });
    </script>

    <script>
        function showModal(typeId, name, loanCreditId, totalMoney) {
            // switch (typeId) {
            //     case 4:
            //         $("#title").text('Bạn đồng ý hủy hồ sơ hd-' + loanCreditId + ' với số tiền ' + totalMoney + ' vnđ');
            //         $("#btnLoanerAccept").attr("onclick", "LoanerCancelLoanCredit(" + loanCreditId + ");");
            //         break;
            // }


            $.ajax(
                {
                    url: "lich-su-don-vay/updatestatus" + "?loanCreditId=" + loanCreditId + "&status=" + 5,
                    type: "get",
                    datatype: "html"
                })
                .done(function (data) {

                    //todo
                })
                .fail(function (jqXHR, ajaxOptions, thrownError) {
                    alert('No response from server');
                });
            return false;
        }


    </script>
@stop