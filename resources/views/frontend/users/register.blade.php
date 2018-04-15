@extends('frontend.app')
@section('title','Đăng ký')

@section('content')
    <div class="container py-5">
        @include('frontend.alert.messages')
        <div class="tm-reg">
            <div class="row gutter-10px flex-column-reverse flex-md-row">
                <div class="col-main col-md-6 d-flex">
                    <div class="tm-reg__banner w-100" style="background-image:url('{{ asset('/frontend/images/bg-login.jpg')  }}');"></div>
                </div>
                <div class="col-aside col-md-6 d-flex mb-5 mb-md-0">
                    <div class="tm-regform d-flex flex-column justify-content-between w-100 border border-gray bg-white">
                        @if( !session('OTP') )
                            @if( !session('errorOTP') && !session('register_success') )
                                {{-- Form đăng ký --}}
                                <div class="fs-13" id="divFormRegister">
                                    {{ Form::open(['action' => 'Frontends\Users\UsersController@postRegisterForm', 'method' => 'POST']) }}
                                        @csrf

                                        <div class="tm-regform__header d-flex justify-content-between align-items-center p-3">
                                            <h2 class="text-uppercase fs-16 fw-4 mb-0">
                                                Đăng ký tài khoản
                                            </h2>
                                            <a class="text-primary fs-13" href="{{ route('frontend.user.login') }}">
                                                <ins>Đăng nhập</ins>
                                            </a>
                                        </div>
                                        <hr class="border-gray my-0">

                                        <div class="px-5 py-3">
                                            <p class="text-center">
                                                Hãy đăng ký ngay bây giờ <br>
                                                để tham gia sàn tài chính Tima.
                                                <span id="sp-message-login"></span>
                                            </p>

                                            <div class="form-group">
                                                {{ Form::text('fullname', null, ['class' => 'form-control form-control-lg fs-13 px-3 rounded', 'placeholder' => 'Họ và tên', 'required', 'autocomplete' => "off"]) }}
                                                <span class="error">{{ $errors->first('fullname') }}</span>
                                            </div>

                                            <div class="form-group">
                                                {{ Form::number('phone', null, ['class' => 'form-control form-control-lg fs-13 px-3 rounded', 'maxlength ' => '11', 'placeholder' => 'Số điện thoại', 'required', 'autocomplete' => "off"]) }}
                                                <span class="error">{{ $errors->first('phone') }}</span>
                                            </div>

                                            <div class="form-group">
                                                {{ Form::password('password', ['class' => 'form-control form-control-lg fs-13 px-3 rounded', 'placeholder' => 'Mật khẩu', 'autocomplete' => "off"]) }}
                                                <span class="error">{{ $errors->first('password') }}</span>
                                            </div>
                                            <div class="form-group">
                                                {{ Form::select( 'city_id', ['' => 'Chọn thành phố...']+getCityList(), null, ['class' => 'selectpicker form-control input-lg', 'id' => "cbCity", 'required'] ) }}
                                                <span class="error text-primary">{{ $errors->first('city') }}</span>
                                            </div>
                                            <div class="form-group">
                                                {{ Form::select( 'district_id', ['' => 'Chọn quận huyện ...']+getDistrictList(), null, ['class' => 'selectpicker form-control input-lg', 'id' => "cbDistrict", 'required'] ) }}
                                                </select>
                                                <span class="error text-primary">{{ $errors->first('district') }}</span>
                                            </div>

                                            <div class="form-group">
                                                <label class="mb-0 mr-3" for="fc-radio-1">Bạn cần:</label>

                                                <label class="custom-control custom-radio fs-13 mr-4">
                                                    <input id="fc-radio-1" value="{{ \PermissionCommon::VAY }}" name="type" type="radio" class="custom-control-input">
                                                    <span class="custom-control-indicator"></span>
                                                    <span class="custom-control-description">Vay</span>
                                                </label>

                                                <label class="custom-control custom-radio fs-13">
                                                    <input id="fc-radio-2" value="{{ \PermissionCommon::CHO_VAY }}" name="type" type="radio" class="custom-control-input" checked>
                                                    <span class="custom-control-indicator"></span>
                                                    <span class="custom-control-description">Cho vay</span>
                                                </label>
                                            </div>

                                            <button type="submit" class="btn btn-lg btn-block btn-primary text-uppercase fs-13 rounded mt-5">
                                                Đăng Ký
                                            </button>
                                        </div>
                                    {{ Form::close() }}
                                </div>
                            @elseif( session('errorOTP') )
                                {{-- Sai mã xác nhận --}}
                                <div class="fs-13" id="formSucessNewPass" style="">
                                    <div class="px-5 py-3">
                                        <div class="text-center" style="margin:30px 0px 25px 0px;">
                                            <img src="{{ asset('frontend/images/error.png') }}" class="radius_logo" id="imgSucces">
                                        </div>

                                        <h3 class="mb-3 mb-md-4 fs-16 text-center" id="TitleResetPassword">Mã xác nhận không đúng, vui lòng đăng ký lại</h3>
                                        <p class="text-center" id="ContentResetPassword">Bạn đã hết phiên đăng ký, vui lòng đăng ký lại</p>

                                        <a class="btn btn-lg btn-block btn-primary text-uppercase fs-13 rounded mt-5" href="{{ route('frontend.user.register') }}">Quay lại màn hình đăng ký</a>
                                    </div>
                                </div>
                            @else
                                {{-- Đăng ký thành công --}}
                                <div class="fs-13" id="formSucessNewPass" style="">
                                    <div class="px-5 py-3">
                                        <div class="text-center" style="margin:30px 0px 25px 0px;">
                                            <img src="{{ asset('frontend/images/thanhcong.png') }}" class="radius_logo" id="imgSucces">
                                        </div>

                                        <h3 class="mb-3 mb-md-4 fs-16 text-center" id="TitleResetPassword">Chúc mừng bạn đã đăng ký thành công!</h3>
                                        <p class="text-center" id="ContentResetPassword">Chúng tôi sẽ liên lạc lại với bạn để xác nhận thông tin đăng ký.</p>

                                        <a class="btn btn-lg btn-block btn-primary text-uppercase fs-13 rounded mt-5" href="{{ route('frontend.user.login') }}">Đăng nhập ngay</a>
                                    </div>
                                </div>
                            @endif
                        @else
                            <div class="fs-13" id="divEnterSMSCode">
                            {{ Form::open(['action' => 'Frontends\Users\UsersController@validateOTP', 'method' => 'POST']) }}
                                <div class="tm-regform__header d-flex justify-content-between align-items-center p-3">
                                    <h2 class="text-uppercase fs-16 fw-4 mb-0">
                                        Nhập mã xác nhận
                                    </h2>
                                </div>

                                <hr class="border-gray my-0">

                                <div class="px-5 py-3">
                                    <p class="text-center">
                                        Mã xác nhận đã được gửi đến số <b id="bPhone">{{ session('input')['phone'] }}</b> <br>
                                        Vui lòng nhập mã xác nhận vào ô dưới:
                                    </p>

                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-lg fs-13 px-3 rounded" name="txtCodeConfirm" id="txtCodeConfirm" placeholder="xxxx" title="" required>
                                    </div>

                                    <button type="submit" class="btn btn-lg btn-block btn-primary text-uppercase fs-13 rounded mt-5">Tiếp tục</button>
                                </div>
                            {{ Form::close() }}
                            </div>
                        @endif

                        <div>
                            <hr class="border-gray my-0">

                            <div class="text-center fs-13 p-3">
                                Bạn đã có tài khoản?

                                <div class="d-inline-block">
                                    Hãy
                                    <a class="text-primary" href="/User/Login">
                                        <ins>click vào đây để đăng nhập</ins>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop