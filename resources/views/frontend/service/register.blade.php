@extends('frontend.app')
@section('title','Đăng ký vay')

@section('js_footer')
<script type="text/javascript">
	$(document).ready(function () {
		initSlider(4);
	});
</script>
@stop

@section('content')
{{ Form::open(['action' => 'Frontends\Services\ServicesController@postRegisterForm', 'method' => 'POST']) }}
    <div class="tm-card tm-cv flex-column bg-white py-6" style="background-image: url('{{ asset('frontend/images/bg-hk.jpg') }}');">
        <div class="container d-flex flex-column align-items-end px-0">
            <div class="w-100 w-xl-66 relative px-3">

                <div class="tm-cv__body bg-white fs-14">
                    <div class="p-lg-5 p-3">
                        <div class="row">
                            <div class="col-md-8 mb-3 mb-md-0">
                                <div class="text-gray mb-3">
                                    <div>
                                        Tôi cần vay
                                        <span class="text-gray-dark spanAmount">10,000,000</span>
                                        VNĐ
                                    </div>
                                    <input style="display: none" class="bootstrap-slider" type="text" data-slider-min="0" data-slider-max="100" data-slider-step="1" data-slider-value="10000000" id="application_amount" name="application_amount"/>
                                    <div class="d-flex justify-content-between"></div>
                                </div>

                                <div class="text-gray mb-3">
                                    <div>
                                        trong
                                        <span class="text-gray-dark" id="spanTerm">30</span>
                                        <span id="spanTextDay">Ngày</span>
                                    </div>
                                    <input style="display: none" class="bootstrap-slider" type="text" data-slider-min="0" data-slider-max="100" data-slider-step="1" data-slider-value="30" id="application_term" name="application_term"/>
                                    <div class="d-flex justify-content-between"></div>
                                </div>

                                <p class="text-gray mb-0 fs-12">
                                    Tima tư vấn gói vay theo sổ hộ khẩu, khoản vay đến 50 triệu. Kỳ hạn vay 90
                                    ngày. Kỳ thanh toán 10, 15 hoặc 30 ngày. Chi tiết liên hệ
                                    <a class="text-gray" href="tel:18006919">1800 6919</a>
                                </p>

                                <div class="text-gray mb-3">
                                    <input type="checkbox" name="chkDieuKhoan" id="chkDieuKhoan" checked="">
                                    <label for="chkDieuKhoan"> <a href="/Dieu-Khoan-Nguoi-Vay.html" target="_blank"> Điều khoản </a> đăng ký khoản
                                        vay </label>
                                </div>

                            </div>

                            <div class="col-md-4 d-flex flex-column">
                                <div class="form-group mb-2">
                                    <input class="form-control fs-14" type="text" placeholder="Họ và tên" name="application_full_name" id="application_full_name" value="">
                                </div>

                                <div class="form-group mb-2">
                                    <input class="form-control fs-14" type="tel" placeholder="Số điện thoại" id="application_mobile_phone" name="application_mobile_phone" value="">
                                </div>

                                <div class="form-group mb-2">
                                    {{ Form::select( 'city', ['' => 'Chọn thành phố...']+getCityList(), null, ['class' => 'selectpicker form-control input-lg', 'id' => "cbCity", 'required'] ) }}
                                    <span class="error text-primary">{{ $errors->first('city') }}</span>
                                </div>

                                <div class="form-group mb-2">
                                    {{ Form::select( 'district', ['' => 'Chọn quận huyện ...']+getDistrictList(), null, ['class' => 'selectpicker form-control input-lg', 'id' => "cbDistrict", 'required'] ) }}
                                    <span class="error text-primary">{{ $errors->first('district') }}</span>
                                </div>

                                <div class="input-group mb-0">
                                    <button class="btn btn-lg btn-block btn-primary rounded text-uppercase fs-14 py-3">
                                    <span class="d-flex align-items-center justify-content-between">
                                        <i></i>
                                        <span>Vay ngay</span>
                                        <i class="icon-angle-right"></i>
                                    </span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-gray-lightest text-gray-light">
                        <div class="row no-gutters border-top">
                            <div class="col-sm-6 text-center border-right py-10px">
                                Khoản vay
                                <div class="fs-18 fw-6">
                                    <span class="text-gray-dark spanAmount">10,000,000</span>
                                    VNĐ
                                </div>
                            </div>

                            <div class="col-sm-6 text-center border-right py-10px">
                                Ngày thanh toán
                                <div class="fs-18 fw-6">
                                    <span class="text-gray-dark" id="payDate">02.05.2018</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
</form>
@stop