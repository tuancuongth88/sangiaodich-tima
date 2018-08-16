@extends('administrator.app')
@section('title','Cấu hình Mail hệ thống')

@section('content')
    <div class="m-grid__item m-grid__item--fluid m-wrapper">
        <!-- BEGIN: Subheader -->
        <div class="m-subheader">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 class="m-subheader__title m-subheader__title--separator">
                        Email hệ thống
                    </h3>
                    <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                        <li class="m-nav__item m-nav__item--home">
                            <a href="#" class="m-nav__link m-nav__link--icon">
                                <i class="m-nav__link-icon la la-home"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        @include('administrator.errors.errors-validate')
        @include('administrator.errors.messages')
        <div class="m-content">
            <div class="row">
                <div class="col-md-12">
                    <div class="m-portlet m-portlet--tab">
                        {{ Form::open(array('route' => array('email.update', 'id' => $data['id']), 'method' => 'PUT', 'class' => 'm-form m-form--fit m-form--label-align-right', 'enctype' => 'multipart/form-data')) }}
                        <div class="m-portlet__body">
                            <meta name="csrf-token" content="{{ csrf_token() }}">
                            <div class="form-group m-form__group">
                                <label for="email_sender">
                                    Email gửi
                                </label>
                                <input type="text" class="form-control m-input" placeholder="Email gửi" name="email_sender" value="{{ $data['email_sender'] }}">
                            </div>
                            <div class="form-group m-form__group">
                                <label for="fullname">
                                    Tên email
                                </label>
                                <input type="text" class="form-control m-input" placeholder="Tên email" name="fullname" value="{{ $data['fullname'] }}">
                            </div>
                            <div class="form-group m-form__group">
                                <label for="password">
                                    Mật khẩu
                                </label>
                                <input type="text" class="form-control m-input" placeholder="Mật khẩu" name="password" value="{{ $data['password'] }}">
                            </div>
                            <div class="form-group m-form__group">
                                <label for="email_to">
                                    Email nhận
                                </label>
                                <input type="text" class="form-control m-input" placeholder="Email nhận VD: a@gmail.com,b@gmail.com" name="email_to" value="{{ $data['email_to'] }}">
                            </div>
                            <div class="form-group m-form__group">
                                <label for="host">
                                    Host
                                </label>
                                <input type="text" class="form-control m-input" placeholder="Host VD: smtp.gmail.com" name="host" value="{{ $data['host'] }}">
                            </div>
                            <div class="form-group m-form__group">
                                <label for="port">
                                    Port
                                </label>
                                <input type="text" class="form-control m-input" placeholder="Port VD: 25 or 587" name="port" value="{{ $data['port'] }}">
                            </div>
                        </div>
                        <div class="m-portlet__foot m-portlet__foot--fit">
                            <div class="m-form__actions">
                                <button class="btn btn-primary">
                                    Lưu
                                </button>
                            </div>
                        </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
