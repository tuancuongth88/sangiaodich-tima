@extends('administrator.app')
@section('title',' Thêm mới dịch vụ')

@section('content')
    <div class="m-grid__item m-grid__item--fluid m-wrapper">
        <!-- BEGIN: Subheader -->
        <div class="m-subheader">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 class="m-subheader__title m-subheader__title--separator">
                        Dịch vụ
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
                    <a href="{{ route('service.index') }}" class="btn btn-success">Danh sách dịch vụ</a>
                </div>
                <div class="col-md-12">
                    <!--begin::Portlet-->
                    <div class="m-portlet m-portlet--tab">
                        <div class="m-portlet__head">
                            <div class="m-portlet__head-caption">
                                <div class="m-portlet__head-title">
                                <span class="m-portlet__head-icon m--hide">
                                    <i class="la la-gear"></i>
                                </span>
                                    <h3 class="m-portlet__head-text">
                                        Thêm mới
                                    </h3>
                                </div>
                            </div>
                        </div>
                        {{ Form::open(array('route' => 'service.store', 'class' => 'm-form m-form--fit m-form--label-align-right', 'files' => true)) }}
                            <div class="m-portlet__body">
                                @csrf
                                <div class="form-group m-form__group">
                                    <label for="name">Tên danh mục dịch vụ</label>
                                    <input type="text" class="form-control m-input" id="service_name" placeholder="Tên dịch vụ" name="service_name" required>
                                </div>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group m-form__group">
                                            <label>Giá dịch vụ</label>
                                            <div class="input-group">
                                                {{ Form::number('fee', '', ['class' => 'form-control m-input', 'placeholder' => 'Giá dịch vụ', 'min' => 0]) }}
                                                <div class="input-group-append">
                                                    <span class="input-group-text">VNĐ</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group m-form__group">
                                            <label>Giảm giá</label>
                                            <div class="input-group">
                                                {{ Form::number('discount', '', ['class' => 'form-control m-input', 'placeholder' => 'Giảm giá', 'min' => 0, 'max' => 100]) }}
                                                <div class="input-group-append">
                                                    <span class="input-group-text">%</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group m-form__group">
                                    <label for="day_detail">Khoảng thời gian</label>
                                    {{ Form::text('day_detail', Common::SERVICE_DAY_DETAIL, ['class' => 'form-control m-input', 'placeholder' => '1weeks, 10days, 1months, 1years', 'required']) }}
                                    <p><i>Mỗi mốc thời gian ngăn cách bằng dấu phẩy ","  Chỉ sử dụng <b>1 đơn vị duy nhất.</b> Các đơn vị khả dụng: days, weeks, months, years.</i>
                                        <br>VD: 10days, 20days, 30days
                                    </p>
                                </div>
                                <div class="form-group m-form__group">
                                    <label for="amount_detail">Khoảng tiền cho vay</label>
                                    {{ Form::text('amount_detail', Common::SERVICE_AMOUNT_DETAIL, ['class' => 'form-control m-input', 'placeholder' => '5, 10, 15, 20', 'required']) }}
                                    <p><i>Mỗi đơn vị (x 1.000.000) ngăn cách bằng dấu phẩy "," 1 triệu <=> 1 ; 1 tỷ <=> 1000</i>
                                        <br>VD: 100, 200, 500, 1000, 10000 <=> 100tr, 200tr, 500tr, 1tỷ, 10tỷ
                                    </p>
                                </div>
                                <div class="form-group m-form__group col-md-6">
                                    <label for="name">Ảnh icon</label>
                                    <input type="file" class="form-control m-input" name="icon_url"><br>
                                </div>
                                <div class="form-group m-form__group col-md-6">
                                    <label for="name">Ảnh banner</label>
                                    <input type="file" class="form-control m-input" name="image_url">
                                </div>
                            </div>
                            <div class="m-portlet__foot m-portlet__foot--fit">
                                <div class="m-form__actions">
                                    <button class="btn btn-primary">Lưu</button>
                                    <a class="btn btn-secondary" href="{{ route('service.index') }}">Trở về danh sách</a>
                                </div>
                            </div>
                        {{ Form::close() }}
                    </div>
                    <!--end::Portlet-->
                </div>
                <!--end::Form-->
            </div>
        </div>
    </div>
@stop
