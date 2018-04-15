@extends('administrator.app')
@section('title','About Us')

@section('content')
    <div class="m-grid__item m-grid__item--fluid m-wrapper">
        <!-- BEGIN: Subheader -->
        <div class="m-subheader">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 class="m-subheader__title m-subheader__title--separator">
                        About Us
                    </h3>
                </div>
            </div>
        </div>
    @include('administrator.errors.errors-validate')
    <!-- END: Subheader -->
        <div class="m-content">
            <div class="row">
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
                        @if(!empty($data))
                            {{ Form::open(array('action' => array('Administrators\AboutUs\AboutUsController@update',
                             'id' => $data['id']),
                              'method' => 'PUT',
                               'class' => 'm-form m-form--fit m-form--label-align-right', 'enctype' => 'multipart/form-data')) }}
                            <div class="m-portlet__body">
                                <meta name="csrf-token" content="{{ csrf_token() }}">
                                <div class="form-group m-form__group">
                                    <label for="name">
                                        Tiêu đề
                                    </label>
                                    <input type="text" class="form-control m-input" id="title" placeholder="Tiêu đề"
                                           name="title" value="{{$data['title']}}">
                                </div>
                                <div class="form-group m-form__group">
                                    <label class="col-form-label">
                                        Nội dung
                                    </label>
                                    <textarea class="summernote" id="summernote" name="description">
                                        {{$data['description']}}
                                    </textarea>
                                </div>
                            </div>
                            <div class="m-portlet__foot m-portlet__foot--fit">
                                <div class="m-form__actions">
                                    <button class="btn btn-primary">
                                        Lưu
                                    </button>
                                </div>
                            </div>
                            {{-- </form> --}}
                            {{ Form::close() }}
                        @else
                            {{ Form::open(array('action' => 'Administrators\AboutUs\AboutUsController@store',
                            'class' => 'm-form m-form--fit m-form--label-align-right', 'enctype' =>
                            'multipart/form-data')) }}
                            <div class="m-portlet__body">
                                <meta name="csrf-token" content="{{ csrf_token() }}">
                                <div class="form-group m-form__group">
                                    <label for="name">
                                        Tiêu đề
                                    </label>
                                    <input type="text" class="form-control m-input" id="title" placeholder="Tiêu đề"
                                           name="title">
                                </div>
                                <div class="form-group m-form__group">
                                    <label class="col-form-label">
                                        Nội dung
                                    </label>
                                    <textarea class="summernote" id="summernote" name="description"></textarea>
                                </div>
                            </div>
                            <div class="m-portlet__foot m-portlet__foot--fit">
                                <div class="m-form__actions">
                                    <button class="btn btn-primary">
                                        Lưu
                                    </button>
                                </div>
                            </div>
                            {{-- </form> --}}
                            {{ Form::close() }}
                        @endif
                    </div>
                    <!--end::Portlet-->
                </div>
                <!--end::Form-->
            </div>
        </div>
    </div>
@stop
