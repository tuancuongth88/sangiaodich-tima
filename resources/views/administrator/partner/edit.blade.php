@extends('administrator.app')
@section('title',' Thêm mới đối tác')

@section('content')
    <div class="m-grid__item m-grid__item--fluid m-wrapper">
        <!-- BEGIN: Subheader -->
        <div class="m-subheader">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 class="m-subheader__title m-subheader__title--separator">
                        Đối tác
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
                    <a href="{{ route('partner.index') }}" class="btn btn-success">Danh sách đói tác</a>
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
                        {{ Form::open(array('route' => array('partner.update', 'id' => $data['id']), 'method' => 'PUT', 'class' => 'm-form m-form--fit m-form--label-align-right', 'enctype' => 'multipart/form-data')) }}
                        <div class="m-portlet__body">
                            <meta name="csrf-token" content="{{ csrf_token() }}">
                            <div class="form-group m-form__group">
                                <label for="name">
                                    Tên đói tác
                                </label>
                                <input type="text" class="form-control m-input" id="name" value="{{ $data['name'] }}" placeholder="Tên đối tác" name="name">
                            </div>
                            <div class="form-group m-form__group">
                                <label for="category_id">
                                    chọn danh mục
                                </label>
                                <select class="form-control m-input" id="category_id" name="category_id">
                                    @foreach ($category as $element)
                                        <option value="{{ $element['id'] }}" <?php echo $element['id'] == $data['category_id'] ? 'selected' : ''  ?>>
                                            {{ $element['name'] }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group m-form__group">
                                <label for="email">
                                    Email
                                </label>
                                <input type="text" class="form-control m-input" value="{{ $data['email'] }}" placeholder="Email" name="email">
                            </div>
                            <div class="form-group m-form__group">
                                <label for="phone">
                                    Số điện thoại
                                </label>
                                <input type="text" class="form-control m-input" value="{{ $data['phone'] }}" placeholder="Số điện thoại" name="phone">
                            </div>
                            <div class="form-group m-form__group col-md-6">
                                <label for="name">
                                    Ảnh
                                </label>
                                <input type="file" class="form-control m-input" name="image_url">
                            </div>
                            <div class="form-group m-form__group col-md-6">
                                <label for="name">
                                    Ảnh đã chọn
                                </label></br>
                                <img src="{{ $data['image_url'] }}" alt="" height="75px">
                            </div>
                            <div class="form-group m-form__group">
                                <label class="col-form-label">
                                    Nội dung
                                </label>
                                <textarea class="summernote" id="summernote" name="detail">{{ $data['detail'] }}</textarea>
                            </div>
                        </div>
                        <div class="m-portlet__foot m-portlet__foot--fit">
                            <div class="m-form__actions">
                                <button class="btn btn-primary">
                                    Lưu
                                </button>
                                <a class="btn btn-secondary" href="{{ route('partner.index') }}">
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
@stop
