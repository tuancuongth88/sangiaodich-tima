@extends('administrator.app')
@section('title',' Trang')

@section('content')
<div class="m-grid__item m-grid__item--fluid m-wrapper">
    <!-- BEGIN: Subheader -->
    <div class="m-subheader">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title m-subheader__title--separator">
                    Trang
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
    <!-- END: Subheader -->
    <div class="m-content">
        <div class="row">
            <div class="col-md-12" style="margin-bottom: 20px">
                <a href="{{ route('pages.index') }}" class="btn btn-success">Danh sách trang</a>
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
                    {{ Form::open(['route' => ($data == null) ? 'pages.store' : ['pages.update', $data->id], 'method' => ($data == null) ? 'POST' : 'PUT', 'class' => 'm-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed', 'files' => true ]) }}
                        @csrf
                        <div class="m-portlet__body">
                            <div class="form-group m-form__group">
                                <label for="name">Tiêu đề</label>
                                {{ Form::text('title', \Common::getObject($data, 'title'), ['class' => 'form-control m-input', 'required' => true]) }}
                            </div>
                            <div class="form-group m-form__group">
                                <div class="form-group">
                                    <label for="name">Mô tả ngắn</label>
                                    {{ Form::textarea('summary', \Common::getObject($data, 'summary'), ['class' => 'form-control m-input', 'rows' => 3]) }}
                                </div>
                                <label for="name">Body</label>
                                {{ Form::textarea('body', \Common::getObject($data, 'body'), ['class' => 'form-control m-input', 'id' => 'summernote', 'rows' => 20]) }}
                            </div>
                            
                            <div class="form-group m-form__group">
                                <div class="form-group">
                                    <label>Thời gian đăng</label>
                                    <div class="input-group date">
                                        <input type="text" class="form-control m-input" id="send_at" name="created_at" value="{{ \Common::getObject($data, 'created_at') }}" readonly/>
                                        <div class="input-group-append">
                                            <span class="input-group-text">
                                                <i class="la la-calendar glyphicon-th"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="name">Machine name</label>
                                    {{ Form::text('machine_name', \Common::getObject($data, 'machine_name'), ['class' => 'form-control m-input m-input--solid']) }}
                                </div>
                                <div class="form-group">
                                    <label>Đường dẫn URL</label>
                                    <input type="text" class="form-control m-input m-input--solid" id="slug" name="slug" value="{{ \Common::getObject($data, 'slug') }}"/>
                                </div>
                            </div>
                            
                        </div>
                        <div class="m-portlet__foot m-portlet__foot--fit">
                            <div class="m-form__actions">
                                <button class="btn btn-primary" type="submit">Lưu</button>
                                <a class="btn btn-secondary" href="{{ route('pages.index') }}">
                                    Trở về danh sách
                                </a>
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
<script type="text/javascript">
    $(document).ready(function() {
        $('#send_at').datetimepicker({
            todayHighlight: true,
            autoclose: true,
            format: 'dd-mm-yyyy hh:ii'
        });
        $('#summernote').summernote({
            callbacks: {
                onImageUpload: function(image) {
                    uploadImage(image[0]);
                }
            },
            height: 300
        });

    });
</script>
@stop
