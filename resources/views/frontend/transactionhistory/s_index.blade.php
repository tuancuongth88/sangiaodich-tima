@extends('frontend.app')
@section('title','DASHBOARD ADMINISTRATOR')

@section('content')
    <div class="container py-5">
        <div class="tm-about bg-white py-5 py-md-5 py-xl-6 px-xl-0">
            <div class="px-3 px-md-5 px-xl-8 w-lg-75 mx-auto">
                <h3 class="text-center fw-3 fs-30 mb-3">
                    Chức năng tra cứu lịch sử vay nợ
                </h3>
                <div class="text-gray-light mb-2 fs-14">
                    Tính năng này giúp cho bạn biết được KH đã vay mượn ở đâu hay chưa? Tình trạng của các khoản vay đó
                    như thế nào?
                    Từ đó, giúp cho Bạn và Người Đang Cho Vay tránh được rủi ro nợ xấu không đáng có
                </div>
                <div class="text-gray-light mb-5 fs-14 text-center">
                    Phí <span class="badge badge-success fs-12">2.000đ</span> cho mỗi lần kiểm tra không có kết quả,
                    <span class="badge badge-success fs-12">10.000đ</span> cho mỗi lần kiểm tra thành công!
                </div>

                <form id="frmCheckCIC" class="tima-search mx-auto px-md-6" novalidate="novalidate">
                    <div class="row mb-5 text-gray-light flex-column flex-sm-row">
                        <div class="col-sm-5 form-group mb-10">
                            <label for="search-fc-1">Số điện thoại:</label>
                            <div class="md-style md-style-icon">
                                <input type="tel" class="form-control" id="txtPhone" name="txtPhone"
                                       placeholder="Nhập số điện thoại" value="">
                                <i class="form-control-icon icon-phone-gray-sm"></i>
                            </div>
                        </div>
                        <div class="col-sm-2 hidden-xs-down d-flex align-items-center justify-content-center px-4 py-5 pb-sm-0">
                            Hoặc
                        </div>
                        <div class="col-sm-5 form-group mb-10">
                            <label for="search-fc-2">Số CMND:</label>
                            <div class="md-style md-style-icon">
                                <input type="number" class="form-control" name="txtCardNumber" id="txtCardNumber"
                                       placeholder="Nhập số CMND" value="">
                                <i class="form-control-icon icon-card-gray-sm"></i>
                            </div>
                        </div>
                    </div>
                    <button type="button"
                            class="btn btn-lg btn-block btn-primary justify-content-center align-items-center d-flex btn-search-tran">
                        Tìm kiếm
                        <i class="icon-search-white ml-3"></i>
                    </button>
                </form>
            </div>
            <hr class="my-6">
            <div class="px-3 px-md-5 px-xl-8" id="CICResult">

            </div>
        </div>
    </div>

    <script type="text/javascript">
        jQuery(document).ready(function () {
            paginationInit();
            $('.btn-search-tran').click(function () {
                var txtPhone = $('#txtPhone').val();
                var txtCardNumber = $('#txtCardNumber').val();
                if (txtPhone == '' && txtCardNumber == '') {
                    return;
                }
                $.ajax(
                    {
                        url: "tra-cuu-lich-su-vay-no?phone=" + txtPhone + "&cardnumber=" + txtCardNumber,
                        type: "get",
                        datatype: "html"
                    })
                    .done(function (data) {
                        $("#CICResult").empty();
                        $("#CICResult").append(data.html);
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
                    var txtPhone = $('#txtPhone').val();
                    var txtCardNumber = $('#txtCardNumber').val();
                    if (txtPhone == '' && txtCardNumber == '') {
                        return;
                    }
                    $.ajax(
                        {
                            url: url_href + "&phone=" + txtPhone + "&cardnumber=" + txtCardNumber,
                            type: "get",
                            datatype: "html"
                        })
                        .done(function (data) {
                            $("#CICResult").empty();
                            $("#CICResult").append(data.html);
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
@stop