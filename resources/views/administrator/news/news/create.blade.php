@extends('administrator.app')
@section('title',' tin')

@section('content')
<div class="m-grid__item m-grid__item--fluid m-wrapper">
    <!-- BEGIN: Subheader -->
    <div class="m-subheader">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title m-subheader__title--separator">
                    Tin tức
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
                <a href="{{ action('Administrators\News\NewsController@index') }}" class="btn btn-success">Danh sách tin</a>
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
                    {{ Form::open(array('action' => 'Administrators\News\NewsController@store', 'class' => 'm-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed', 'enctype' => 'multipart/form-data')) }}
                        <div class="m-portlet__body">
                            <meta name="csrf-token" content="{{ csrf_token() }}">
                            <div class="form-group m-form__group">
                                <label for="name">
                                    Tiêu đề
                                </label>
                                <input type="text" class="form-control m-input m-input--solid" id="title" placeholder="Tiêu đề tin" name="title">
                            </div>
                            <div class="form-group m-form__group">
                                <label for="name">
                                    Mô tả
                                </label>
                                <textarea class="form-control m-input m-input--solid" id="exampleTextarea" rows="3" name="description"></textarea>
                            </div>
                            <div class="form-group m-form__group">
                                <label class="col-form-label">
                                    Nội dung
                                </label>
                                <textarea class="summernote" id="summernote" name="content"></textarea>
                            </div>
                            <div class="form-group m-form__group row">
                                <div class="col-lg-4">
                                    <label for="category_id">
                                    Danh mục
                                    </label>
                                    <select class="form-control m-input m-input--solid" id="category_id" name="category_id">
                                        @foreach ($category as $element)
                                            <option value="{{ $element['id'] }}">
                                                {{ $element['name'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-4">
                                    <label class="">
                                        Keyword meta
                                    </label>
                                    <input type="text" class="form-control m-input m-input--solid" placeholder="" name="keyword_meta">
                                    <span class="m-form__help">

                                    </span>
                                </div>
                                <div class="col-lg-4">
                                    <label class="">
                                        Tags
                                    </label>
                                    <input type="text" class="form-control m-input m-input--solid" placeholder="" name="tags" data-role="tagsinput">
                                    <span class="m-form__help">

                                    </span>
                                </div>
                            </div>
                            <div class="form-group m-form__group row">
                                <div class="col-lg-4">
                                    <label>
                                        Title meta
                                    </label>
                                    <input class="form-control m-input m-input--solid" placeholder="Title meta" name="title_meta">
                                </div>
                                <div class="col-lg-4">
                                    <label class="">
                                        Description meta
                                    </label>
                                    <input type="text" class="form-control m-input m-input--solid" placeholder="Enter Description meta" name="description_meta">
                                    <span class="m-form__help">

                                    </span>
                                </div>
                                <div class="col-lg-4">
                                    <label class="col-form-label">
                                        Người đăng
                                    </label>
                                    <select class="form-control m-select2" id="author" name="author">
                                    </select>
                                </div>
                            </div>
                            <div class="form-group m-form__group row">
                                <div class="col-lg-4">
                                    <label>
                                        Thời gian đăng
                                    </label>
                                    <div class="input-group date">
                                        <input type="text" class="form-control m-input m-input--solid" id="send_at" name="send_at"/>
                                        <div class="input-group-append">
                                            <span class="input-group-text">
                                                <i class="la la-calendar glyphicon-th"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <label class="">
                                        Ảnh đại diện
                                    </label>
                                    <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="customFile" name="image_url">
                                        <label class="custom-file-label" for="customFile">
                                            Chọn ảnh
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <label>
                                        Bình luận
                                    </label>
                                    <div class="col-3">
                                        <span class="m-switch m-switch--icon m-switch--success">
                                            <label>
                                                <input type="checkbox"  name="is_comment" value="1">
                                                <span></span>
                                            </label>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="m-portlet__foot m-portlet__foot--fit">
                            <div class="m-form__actions">
                                <button class="btn btn-primary">
                                    Lưu
                                </button>
                                <a class="btn btn-secondary" href="{{ action('Administrators\News\NewsController@index') }}">
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
            height: 150
        });
        $("#author").select2({
            placeholder: "Tìm kiếm tài khoản",
            allowClear: true,
            ajax: {
                url: "/admin/user/search-data",
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        keyword: params.term, // search term
                        page: params.page
                    };
                },
                processResults: function(data, params) {
                    // parse the results into the format expected by Select2
                    // since we are using custom formatting functions we do not need to
                    // alter the remote JSON data, except to indicate that infinite
                    // scrolling can be used
                    params.page = params.page || 1;

                    return {
                        results: data.data,
                        pagination: {
                            more: (params.page * 30) < data.total_count
                        }
                    };
                },
                cache: true
            },
            escapeMarkup: function(markup) {
                return markup;
            }, // let our custom formatter work
            minimumInputLength: 1,
            templateResult: formatRepo, // omitted for brevity, see the source of this page
            templateSelection: formatRepoSelection // omitted for brevity, see the source of this page
        });

    });
</script>
@stop
