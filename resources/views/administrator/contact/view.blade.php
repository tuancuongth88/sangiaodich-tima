@extends('administrator.app')
@section('title',' Contact')

@section('content')
    <div class="m-grid__item m-grid__item--fluid m-wrapper">
        <!-- BEGIN: Subheader -->
        <div class="m-subheader">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 class="m-subheader__title m-subheader__title--separator">
                        Contact
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
    <!-- END: Subheader -->
        <div class="m-content">
            <div class="row">
                <div class="col-md-12" style="margin-bottom: 20px">
                    <a href="{{ route('contact.index') }}" class="btn btn-success">Danh sách contact</a>
                </div>
                <div class="col-md-12">
                    <!--begin::Portlet-->
                        <div class="m-portlet__body">
                            <meta name="csrf-token" content="{{ csrf_token() }}">
                            <div class="form-group m-form__group">
                                <label for="name">
                                    Tên đầy đủ
                                </label>
                                <input type="text" class="form-control m-input" id="title" readonly="true" name="name" value="{{ $data['name'] }}">
                            </div>
                            <div class="form-group m-form__group">
                                <label for="phone">
                                    Số điện thoại
                                </label>
                                <input type="text" class="form-control m-input" readonly="true" name="phone" value="{{ $data['phone'] }}">
                            </div>
                            <div class="form-group m-form__group">
                                <label for="email">
                                    Email
                                </label>
                                <input type="text" class="form-control m-input" readonly="true" name="email" value="{{ $data['email'] }}">
                            </div>
                            <div class="form-group m-form__group">
                                <label for="email">
                                    Địa chỉ
                                </label>
                                <input type="text" class="form-control m-input" readonly="true" name="address" value="{{ $data['address'] }}">
                            </div>
                            <div class="form-group m-form__group">
                                <label class="col-form-label">
                                    Nội dung
                                </label>
                                <textarea class="summernote" name="description">{{ $data['description'] }}</textarea>
                            </div>

                        </div>
                        <div class="m-portlet__foot m-portlet__foot--fit">
                            <div class="m-form__actions">
                                <a class="btn btn-secondary" href="{{ route('contact.index') }}">
                                    Trở về danh sách
                                </a>
                            </div>
                        </div>
                    <!--end::Portlet-->
                </div>
                <!--end::Form-->
            </div>
        </div>
    </div>
@stop
