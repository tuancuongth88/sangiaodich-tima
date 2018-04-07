@extends('frontend.app')
@section('title','Đăng ký')

@section('content')
    <div class="container py-5">
        @include('frontend.alert.messages')
        @include('frontend.alert.errors-validate')
        <div class="tm-reg">
            <div class="row gutter-10px flex-column-reverse flex-md-row">
                <div class="col-main col-md-6 d-flex">
                    <div class="tm-reg__banner w-100" style="background-image:url('{{ asset('/frontend/images/bg-login.jpg')  }}');"></div>
                </div>
                <div class="col-aside col-md-6 d-flex mb-5 mb-md-0">
                    <div class="tm-regform d-flex flex-column justify-content-between w-100 border border-gray bg-white">
                        
                        <div class="fs-13" id="formLogin">
                            <div class="tm-regform__header d-flex justify-content-between align-items-center p-3">
                                <h2 class="text-uppercase fs-16 fw-4 mb-0">
                                    Đăng Nhập
                                </h2>
                                <a class="text-primary fs-13" href="{{ route('frontend.user.register') }}">
                                    <ins>Đăng ký tài khoản</ins>
                                </a>
                            </div>

                            {{ Form::open(['route' => 'frontend.user.dologin', 'method' => 'POST']) }}
                                <hr class="border-gray my-0">
                                <div class="px-5 py-3">
                                    <p class="text-center">
                                        Chào bạn <br>
                                        đăng nhập để xem và quản lý khoản vay
                                        <br />
                                        <span id="sp-message-login"></span>
                                    </p>

                                    <div class="form-group">
                                        {{ Form::text('phone', null, ['class' => 'form-control form-control-lg fs-13 px-3 rounded', 'placeholder' => "Nhập số điện thoại"]) }}
                                    </div>

                                    <div class="form-group">
                                        {{ Form::password('password', ['class' => 'form-control form-control-lg fs-13 px-3 rounded', 'placeholder' => "Nhập mật khẩu"]) }}
                                    </div>

                                    <div class="form-group d-flex justify-content-between align-items-center">
                                        <label class="custom-control custom-checkbox fs-13 mb-0">
                                            <input name="agree" type="checkbox" class="custom-control-input">
                                            <span class="custom-control-indicator"></span>
                                            <span class="custom-control-description">Nhớ tài khoản</span>
                                        </label>
                                        <a class="text-primary fs-13" href="#">
                                            Quên mật khẩu
                                        </a>
                                    </div>

                                    <button class="btn btn-lg btn-block btn-primary text-uppercase fs-13 rounded mt-5">
                                        Đăng nhập ngay
                                    </button>
                                </div>
                            {{ Form::close() }}

                        </div>

                        <div>
                            <hr class="border-gray my-0">
                            <div class="text-center fs-13 p-3">
                                Bạn chưa có tài khoản?
                                <div class="d-inline-block">
                                    Hãy
                                    <a class="text-primary" href="{{ route('frontend.user.register') }}">
                                        <ins>đăng kí ngay bây giờ</ins>
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