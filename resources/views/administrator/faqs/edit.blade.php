@extends('administrator.app')
@section('title','Faq')

@section('content')
<div class="m-grid__item m-grid__item--fluid m-wrapper">
    <!-- BEGIN: Subheader -->
    <div class="m-subheader">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title m-subheader__title--separator">
                    Faq
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
                <a href="{{ action('Administrators\Faqs\FaqController@index') }}" class="btn btn-success">Danh sách</a>
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
                                    Cập nhật
                                </h3>
                            </div>
                        </div>
                    </div>
                    {{ Form::open(array('action' => array('Administrators\Faqs\FaqController@update', 'id' => $data['id']), 'method' => 'PUT', 'class' => 'm-form m-form--fit m-form--label-align-right', 'enctype' => 'multipart/form-data')) }}
                        <div class="m-portlet__body">
                            <meta name="csrf-token" content="{{ csrf_token() }}">
                            <div class="form-group m-form__group">
                                <label for="name">
                                    Tiêu đề
                                </label>
                                <input type="text" class="form-control m-input" id="question" placeholder="Tiêu đề tin" name="question" value="{{ $data['question'] }}">
                            </div>
                            <div class="form-group m-form__group">
                                <label class="col-form-label">
                                    Nội dung
                                </label>
                                <textarea class="summernote" id="summernote" name="answer">{{ $data['answer'] }}</textarea>
                            </div>
                        </div>
                        <div class="m-portlet__foot m-portlet__foot--fit">
                            <div class="m-form__actions">
                                <button class="btn btn-primary">
                                    Lưu
                                </button>
                                <a class="btn btn-secondary" href="{{ action('Administrators\Faqs\FaqController@index') }}">
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
        $('#send_at').datetimepicker({
            todayHighlight: true,
            autoclose: true,
            format: 'dd/mm/yyyy hh:ii'
        });
        $('#summernote').summernote({
            callbacks: {
                onImageUpload: function(image) {
                    uploadImage(image[0]);
                }
            },
            height: 400
        });
        $("#author").select2({
            placeholder: "Tìm kiếm người dùng",
            allowClear: true,
            ajax: {
                url: "/administrator/user/search",
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
