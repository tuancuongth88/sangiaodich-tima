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
                    <a href="{{ action('Administrators\Faqs\FaqController@index') }}" class="btn btn-success">
                        Danh sách
                    </a>
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
                        {{ Form::open(array('action' => 'Administrators\Faqs\FaqController@store',
                         'class' => 'm-form m-form--fit m-form--label-align-right', 'enctype' => 'multipart/form-data')) }}
                        <div class="m-portlet__body">
                            <meta name="csrf-token" content="{{ csrf_token() }}">
                            <div class="form-group m-form__group">
                                <label for="name">
                                    Tiêu đề
                                </label>
                                <input type="text" class="form-control m-input" id="title" placeholder="Tiêu đề"
                                       name="question">
                            </div>
                            <div class="form-group m-form__group">
                                <label class="col-form-label">
                                    Nội dung
                                </label>
                                <textarea class="summernote" id="summernote" name="answer"></textarea>
                            </div>
                            <div class="form-group m-form__group">
                                <label for="category_id">
                                    Danh mục
                                </label>
                                <select class="form-control m-input m-input--solid" id="category_id"
                                        name="category_id">
                                    @foreach ($category as $element)
                                        <option value="{{ $element['id'] }}">
                                            {{ $element['name'] }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="m-portlet__foot m-portlet__foot--fit">
                            <div class="m-form__actions">
                                <button class="btn btn-primary">
                                    Lưu
                                </button>
                                <a class="btn btn-secondary"
                                   href="{{ action('Administrators\Faqs\FaqController@index') }}">
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
        $(document).ready(function () {
            $('#summernote').summernote({
                callbacks: {
                    onImageUpload: function (image) {
                        uploadImage(image[0]);
                    }
                },
                height: 400
            });
        });
    </script>
@stop
