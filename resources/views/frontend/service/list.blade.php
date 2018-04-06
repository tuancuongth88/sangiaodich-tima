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
    <div class="tm-card bg-white py-6 bg-gray-lightest">
        <div class="container">
            <h2 class="tm-card__heading text-center text-gray-dark mb-6">
                Chọn gói sản phẩm bạn muốn vay
            </h2>

            <div class="tm-card__body d-flex justify-content-center">

                <div class="w-xl-85">
                    <div class="row justify-content-center">
                        @foreach($data as $service)
                            <div class="col col-4 col-sm-6 col-md-4 col-lg-3 col-xl-auto w-xl-20 text-center fs-14 mb-5">
                                <a href="{{ route('services.site.form', ['service' => $service->slug]) }}" title="Cầm đồ">
                                    <div class="mb-3 mx-auto product_borrow">
                                        <img src="{{ !empty($service->icon_url) ? asset($service->icon_url) : NO_IMG }}"  width="130px" height="130px" />
                                    </div>
                                </a>
                                <h3 class="fw-4 text-uppercase product_borrow fw-6 mb-0">
                                    <a href="{{ route('services.site.form', ['service' => $service->slug]) }}">
                                        Vay cầm cố tài sản
                                    </a>
                                </h3>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--5 bước để nhận và thanh toán khoản vay-->

    <div class="tm-card bg-white py-6">
        <div class="container">
            <h2 class="tm-card__heading text-center text-primary mb-6">
                4 bước để nhận khoản vay
            </h2>

            <div class="tm-card__body tm-steps2">

                <div class="row justify-content-center">

                    <div class="tm-steps2__item col col-12 col-sm-6 col-lg-4 col-xl-auto w-xl-20 text-center fs-14 mb-5 mb-xl-0">
                        <div class="tm-steps2__thumb mb-2 mx-auto">
                            <i class="tm-steps2__icon icon-monitor-file"></i>
                        </div>
                        <h3 class="tm-steps2__title fw-4 text-uppercase fs-14 mb-1">
                            <a class="tm-steps2__btn btn fw-6" href="#">
                                Đăng ký vay
                            </a>
                        </h3>
                        <p class="mb-0 px-xl-3">
                            Hoàn tất điền thông tin trong 5 phút
                        </p>
                    </div>

                    <div class="tm-steps2__item col col-12 col-sm-6 col-lg-4 col-xl-auto w-xl-20 text-center fs-14 mb-5 mb-xl-0">
                        <div class="tm-steps2__thumb mb-2 mx-auto">
                            <i class="tm-steps2__icon icon-user-switch"></i>
                        </div>
                        <h3 class="tm-steps2__title fw-4 text-uppercase fs-14 mb-1">
                            <a class="tm-steps2__btn btn fw-6" href="#">
                                Kết nối
                            </a>
                        </h3>
                        <p class="mb-0 px-xl-3">
                            Ngay lập tức người cho vay sẽ nhận được đơn xin vay của bạn
                        </p>
                    </div>

                    <div class="tm-steps2__item col col-12 col-sm-6 col-lg-4 col-xl-auto w-xl-20 text-center fs-14 mb-5 mb-xl-0">
                        <div class="tm-steps2__thumb mb-2 mx-auto">
                            <i class="tm-steps2__icon icon-note-edit"></i>
                        </div>
                        <h3 class="tm-steps2__title fw-4 text-uppercase fs-14 mb-1">
                            <a class="tm-steps2__btn btn fw-6" href="#">
                                Xét duyệt
                            </a>
                        </h3>
                        <p class="mb-0 px-xl-3">
                            Nhận kết quả nhanh chóng sau khi gửi hồ sơ
                        </p>
                    </div>

                    <div class="tm-steps2__item col col-12 col-sm-6 col-lg-4 col-xl-auto w-xl-20 text-center fs-14 mb-5 mb-xl-0">
                        <div class="tm-steps2__thumb mb-2 mx-auto">
                            <i class="tm-steps2__icon icon-hand-dollar"></i>
                        </div>
                        <h3 class="tm-steps2__title fw-4 text-uppercase fs-14 mb-1">
                            <a class="tm-steps2__btn btn fw-6" href="#">
                                Nhận khoản vay
                            </a>
                        </h3>
                        <p class="mb-0 px-xl-3">
                            Nhận tiền vào tài khoản hoặc tại cửa hàng Viettel Post trên toàn quốc
                        </p>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!--Vì sao nên chọn Tima -->
    <div class="tm-card bg-white bg-gray-lighter">
        <div class="container">
            <div class="row">
                <div class="col-md-7 d-flex flex-column align-items-end justify-content-end py-5">
                    <div class="tm-reg__banner w-100" style="background-image:url({{ asset('frontend/images/bg-login.jpg')  }});min-height:443px"></div>
                </div>

                <div class="col-md-5 d-flex flex-column align-items-center py-6">
                    <h2 class="tm-card__heading text-center text-primary mb-4">
                        <span class="text-gray-dark h2 fw-3">Vì sao nên chọn Tima ?</span>
                    </h2>

                    <div class="tm-card__body tm-steps2">
                        <div class="media mb-10px">
                            <div class="circle d-flex bg-white mr-4 align-self-center">
                                <i class="icon-device-touch-gray"></i>
                            </div>
                            <div class="media-body align-self-center">
                                Đăng ký vay online đơn giản
                            </div>
                        </div>
                        <div class="media mb-10px">
                            <div class="circle d-flex bg-white mr-4 align-self-center">
                                <i class="icon-call-center-gray"></i>
                            </div>
                            <div class="media-body align-self-center">
                                Duyệt thông tin đăng ký nhanh qua ĐIỆN THOẠI
                            </div>
                        </div>
                        <div class="media mb-10px">
                            <div class="circle d-flex bg-white mr-4 align-self-center">
                                <i class="icon-file-edit-gray"></i>
                            </div>
                            <div class="media-body align-self-center">
                                Ký hợp đồng tại địa điểm khách hàng CHỈ ĐỊNH
                            </div>
                        </div>
                        <div class="media mb-10px">
                            <div class="circle d-flex bg-white mr-4 align-self-center">
                                <i class="icon-24h-gray"></i>
                            </div>
                            <div class="media-body align-self-center">
                                Giải ngân TRONG NGÀY
                            </div>
                        </div>
                        <div class="media mb-10px">
                            <div class="circle d-flex bg-white mr-4 align-self-center">
                                <i class="icon-security-gray"></i>
                            </div>
                            <div class="media-body align-self-center">
                                Bảo mật khoản vay TUYỆT ĐỐI
                            </div>
                        </div>
                        <div class="media mb-10px">
                            <div class="circle d-flex bg-white mr-4 align-self-center">
                                <i class="icon-security-gray"></i>
                            </div>
                            <div class="media-body align-self-center">
                                Không giữ tài sản
                            </div>
                        </div>

                        <div class="text-center mt-4">
                            <a class="btn btn-primary text-white text-uppercase px-5" href="#">
                                ĐĂNG KÝ VAY NGAY
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@stop