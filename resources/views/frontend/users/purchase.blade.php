@extends('frontend.app')
@section('title','Thông tin khách hàng')

@section('content')
{{ Form::open(array('action' => array('Frontends\Users\UsersController@postPurchase'))) }}
    <div class="container py-5">
        <div class="bg-white border border-gray p-3 px-md-5 pb-md-5 pt-md-4">
            <h2 class="text-uppercase fs-16 fw-6 mb-5">
                CHỌN hình thức thanh toán
            </h2>
            <div class="radiolist">
                <!--.radiolist__item-->
                <div class="form-group mb-5">
                    <div class="radiolist__item custom-control custom-radio w-100 mr-0">
                        <input id="httt-rdo-1" value="1" checked="checked" name="radio" type="radio" class="radiolist__control-input custom-control-input">
                        <label for="httt-rdo-1" class="custom-control-indicator"></label>
                        <label for="httt-rdo-1" class="custom-control-description">
                            Thanh toán Online <br>
                            <em class="small form-text text-muted mt-0">
                                Quý khách sử dụng dịch vụ chuyển tiền online để nạp tiền
                            </em>
                        </label>
                        <div class="radiolist__body mt-3">
                            <label for="httt-fc-1">
                                Số tiền cần nạp
                            </label>

                            <input id="txt_Money" name="amount" type="text" class="form-control w-md-50 valid" onkeyup="reformatText(this)" placeholder="Nhập số tiền" aria-required="true" aria-invalid="false">
                        </div>
                    </div>
                </div>
                <!--.radiolist__item-->
                <div class="form-group mb-5">
                    <div class="radiolist__item custom-control custom-radio w-100 mr-0">
                        <input id="httt-rdo-2" name="radio"  value="2" type="radio" class="radiolist__control-input custom-control-input">
                        <label for="httt-rdo-2" class="custom-control-indicator"></label>
                        <label for="httt-rdo-2" class="custom-control-description">
                            Thanh toán bằng tự chuyển khoản <br>
                            <em class="small form-text text-muted mt-0">
                                Quý khách sẽ nạp tiền qua số tài khoản của Công Ty
                            </em>
                        </label>
                        <div class="radiolist__body mt-3">
                            <div class="table-responsive">
                                <table class="table table-bordered table-sm fs-13 fw-6">
                                    <thead>
                                    <tr>
                                        <th class="text-nowrap fw-6">Ngân hàng</th>
                                        <th class="text-nowrap fw-6">Số tài khoản</th>
                                        <th class="text-nowrap text-center fw-6">Chủ tài khoản</th>
                                        <th class="text-nowrap text-center fw-6">Nội dung chuyển khoản</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td scope="row">Vietcombank chi nhánh Thành Công</td>
                                        <td>0301000294851</td>
                                        <td class="align-middle text-center">
                                            <span class="text-uppercase">Nguyễn Văn Thực</span>
                                        </td>
                                        <td rowspan="6" class="align-middle text-center">
                                            <span class="text-uppercase">SNT [phone]</span>
                                            <em class="small form-text text-muted mt-0">
                                                (Thay "[phone]" bằng tài khỏan đăng nhập của bạn)
                                            </em>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td scope="row">VIB chi nhánh Hoàn Kiếm</td>
                                        <td>008704060078964</td>
                                        <td class="align-middle text-center">
                                            <span class="text-uppercase">Nguyễn Văn Thực</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td scope="row">Agribank - Láng Hạ</td>
                                        <td>1400205463545</td>
                                        <td class="align-middle text-center">
                                            <span class="text-uppercase">Vương Thị Hoà</span>
                                        </td>
                                    </tr>

                                    </tbody>
                                </table>
                                <em class="small form-text text-muted mt-0">
                                    *Với hình thức này sau khi nhận được tiền hệ thống sẽ xử lý cộng tiền vào tài khoản của bạn trong thời gian nhanh nhất
                                </em>
                            </div>
                        </div>
                    </div>
                </div>
                <!--.radiolist__item-->
                <div class="form-group mb-5 disable">
                    <div class="radiolist__item custom-control custom-radio w-100 mr-0">
                        <input id="httt-rdo-3" value="3" name="radio" type="radio" class="radiolist__control-input custom-control-input">
                        <label for="httt-rdo-3" class="custom-control-indicator"></label>
                        <label for="httt-rdo-3" class="custom-control-description">
                            Thu tiền tại nhà <br>
                            <em class="small form-text text-muted mt-0">
                                Nhân viên Công Ty sẽ liên hệ với bạn
                            </em>
                        </label>
                        <div class="radiolist__body mt-3">
                            <label for="httt-fc-1">
                                Gửi yêu cầu nạp tiền tại nhà
                            </label>

                            <input id="txt_Money_Request_Note" name="txt_Money_Request_Note" type="text" class="form-control w-md-50 valid"  placeholder="Nhập nội dung ghi chú" aria-required="true" aria-invalid="false">
                        </div>
                    </div>
                </div>
                <!--.radiolist__item-->
                <div class="form-group mb-5 disable">
                    <div class="radiolist__item custom-control custom-radio w-100 mr-0">
                        <input id="httt-rdo-4" name="radio"  value="4" type="radio" class="radiolist__control-input custom-control-input">
                        <label for="httt-rdo-4" class="custom-control-indicator"></label>
                        <label for="httt-rdo-4" class="custom-control-description">
                            Thanh toán tiền bằng thẻ điện thoại <br>
                            <em class="small form-text text-muted mt-0">
                                Quý khách sử dụng mã thẻ điện thoại để nạp tiền
                            </em>
                        </label>
                    </div>
                </div>
                <div class="text-center mt-6 ">
                    <button id="btnNapNgay" type="submit" class="btn btn-lg btn-primary fs-16 text-uppercase mb-2 px-8 cursor-pointer">NẠP TIỀN</button>
                    <em class="small form-text text-muted mt-0">
                        (Xin vui lòng kiểm tra lại thông tin chuyển tiền trước khi nạp tiền)
                    </em>
                </div>
            </div>
        </div>
    </div>
{{ Form::close() }}
@stop