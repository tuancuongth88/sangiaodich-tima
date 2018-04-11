@extends('frontend.app')
@section('title','Đăng ký vay')

<?php
$amountConfig = $data->amount_config();
$amountTicks = $amountLabels = $amountPositions = [];
foreach ($amountConfig as $key => $value) {
    $amountTicks[] = $value['number'];
    $amountLabels[] = '"'.$value['text'].'"';
    $amountPositions[] = (count($amountConfig)-1 > 0) ? $key*(100/(count($amountConfig)-1)) : 100;
}

$dayConfig = $data->day_config();
$dayTicks = $dayLabels = $dayPositions = [];
foreach ($dayConfig as $key => $value) {
    $dayTicks[] = $value['number'];
    $dayLabels[] = '"'.$value['number'].'"';
    $dayPositions[] = (count($dayConfig)-1 > 0) ? $key*(100/(count($dayConfig)-1)) : 100;
}
?>

@section('content')
{{ Form::open(['route' => ['services.site.register', $data->slug], 'method' => 'POST']) }}
    <div class="tm-card tm-cv flex-column bg-white py-6" style="background-image: url('{{ asset('frontend/images/bg-hk.jpg') }}');">
        <div class="container d-flex flex-column align-items-end px-0">
            <div class="w-100 w-xl-66 relative px-3">

                <div class="tm-cv__body bg-white fs-14">
                    <div class="p-lg-5 p-3">
                        <div class="row">
                            <div class="col-md-8 mb-3 mb-md-0">

                                @if( count($amountConfig) > 1 && count($dayConfig) > 1 )
                                    <div class="text-gray mb-3">
                                        <div>Tôi cần vay <span class="text-gray-dark spanAmount">10,000,000</span> VNĐ</div>
                                        <input type="hidden" 
                                            data-slider-ticks="[{{ implode(',', $amountTicks) }}]"
                                            data-slider-ticks-labels='[{{ implode(',', $amountLabels) }}]' 
                                            ticks_positions="[{{ implode(',', $amountPositions) }}]"
                                            data-slider-step="{{ $amountConfig[1]['number'] - $amountConfig[0]['number'] }}"
                                            id="application_amount" name="amount" value=""/>
                                    </div>
                                    <div class="text-gray mb-3">
                                        <div>trong <span class="text-gray-dark" id="spanTerm">30</span> <span id="spanTextDay">{{ $dayConfig[0]['text'] }}</span></div>
                                        <input type="hidden" id="application_term" name="amount_day"
                                            data-slider-ticks="[{{ implode(',', $dayTicks) }}]"
                                            data-slider-ticks-labels='[{{ implode(',', $dayLabels) }}]' 
                                            ticks_positions="[{{ implode(',', $dayPositions) }}]"
                                            data-slider-step="{{ $dayConfig[1]['number'] - $dayConfig[0]['number'] }}"/>
                                    </div>
                                @endif

                                <p class="text-gray mb-0 fs-12">
                                    Tima tư vấn gói vay theo sổ hộ khẩu, khoản vay đến 50 triệu. Kỳ hạn vay 90
                                    ngày. Kỳ thanh toán 10, 15 hoặc 30 ngày. Chi tiết liên hệ
                                    <a class="text-gray" href="tel:18006919">1800 6919</a>
                                </p>

                                <div class="text-gray mb-3">
                                    <input type="checkbox" name="agree_term" checked>
                                    <labels> <a href="~/" target="_blank"> Điều khoản </a> đăng ký khoản vay </label>
                                </div>

                            </div>
                            <div class="col-md-4 d-flex flex-column">
                                <div class="form-group mb-2">
                                    <input class="form-control fs-14" type="text" placeholder="Họ và tên" name="" id="" value="{{ $user->fullname }}" {{ ($user->id != null) ? 'disabled' : '' }}>
                                </div>

                                <div class="form-group mb-2">
                                    <input class="form-control fs-14" type="tel" placeholder="Số điện thoại" id="" name="" value="{{ $user->phone }}" {{ ($user->id != null) ? 'disabled' : '' }}>
                                </div>

                                <div class="form-group mb-2">
                                    {{ Form::select( 'city_id', ['' => 'Chọn thành phố...']+getCityList(), $user->city_id, ['class' => 'selectpicker form-control input-lg', 'id' => "cbCity", 'required'] ) }}
                                    <span class="error text-primary">{{ $errors->first('city') }}</span>
                                </div>

                                <div class="form-group mb-2">
                                    {{ Form::select('district_id', ['' => 'Chọn quận huyện ...']+getDistrictList(), $user->district_id, ['class' => 'selectpicker form-control input-lg', 'id' => "cbDistrict", 'required'] ) }}
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

@if( count($amountConfig) > 1 && count($dayConfig) > 1 )
    @section('js_footer')
    <script type="text/javascript">
        $('#application_amount').slider({
            value: {{ $amountConfig[1]['number'] }},
            formatter: function (b) {
                $('.spanAmount').text(b.toLocaleString("en"));
            }
        });

        $('#application_term').slider({
            value: {{ $dayConfig[1]['number'] }},
            formatter: function (b) {
                $('#payDate').text(moment().add( b, '{{ $dayConfig[0]['unit'] }}' ).format("DD.MM.YYYY"));
                $('#spanTerm').text(b);
                //_countCalcValues(producttype);
            }
        });
    </script>
    @stop
@endif