@extends('administrator.app')
@section('title','Danh sách user')

@section('content')
<div class="m-grid__item m-grid__item--fluid m-wrapper">
    <!-- BEGIN: Subheader -->
    <div class="m-subheader">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title m-subheader__title--separator">
                    Danh sách tài khoản
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
                <a href="{{ action('Administrators\Users\UserController@index') }}" class="btn btn-success">Danh sách tài khoản</a>
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
                                    Nạp tiền cho tài khoản
                                </h3>
                            </div>
                        </div>
                    </div>
                    {{ Form::open(array('action' => 'Administrators\Users\UserController@postPurchase', 'class' => 'm-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed', 'enctype' => 'multipart/form-data')) }}
                        <div class="m-portlet__body">
                            <div class="form-group m-form__group row">
                                <div class="col-lg-4">
                                    <label>
                                        Tài khoản:
                                    </label>
                                    <div class="input-group m-input-group m-input-group--square">
                                        <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="la la-user"></i>
                                                </span>
                                        </div>
                                        <input type="email" class="form-control m-input" placeholder="Email" name="email" disabled value="{{ \App\Models\Users\User::find($id)->email }}">
                                    </div>
                                    <input type="hidden" name="user_id" value="{{ \App\Models\Users\User::find($id)->id }}">
                                </div>
                                <div class="col-lg-4">
                                    <label class="">
                                        Nhập số tiền:
                                    </label>
                                    <input type="text" class="form-control m-input" placeholder="Nhập số tiền" name="amount">
                                    <span class="m-form__help">
                                        Nhập số tiền
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="m-portlet__foot m-portlet__foot--fit">
                            <div class="m-form__actions">
                                <button class="btn btn-primary">
                                    Lưu
                                </button>
                                <a class="btn btn-secondary" href="{{ action('Administrators\Users\UserController@index') }}">
                                    Trở về danh sách
                                </a>
                            </div>
                        </div>
                    {{-- </form> --}}
                    {{ Form::close() }}
                </div>
                <!--end::Portlet-->
            </div>
            <!--end::Form-->
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('#birthday').datepicker({
            todayHighlight: true,
            format: 'dd-mm-yyyy',
            autoclose: true,
            orientation: "bottom left",
            templates: {
                leftArrow: '<i class="la la-angle-left"></i>',
                rightArrow: '<i class="la la-angle-right"></i>'
            }
        });
    });
</script>
@stop