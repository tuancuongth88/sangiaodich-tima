@extends('administrator.app')
@section('title','Danh mục tin')

@section('content')
<div class="m-grid__item m-grid__item--fluid m-wrapper">
	<!-- BEGIN: Subheader -->
	<div class="m-subheader">
	    <div class="d-flex align-items-center">
	        <div class="mr-auto">
	            <h3 class="m-subheader__title m-subheader__title--separator">
	                Danh mục tin
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
				<a href="{{ action('Administrators\News\NewsCategoryController@index') }}" class="btn btn-success">Danh sách danh mục tin</a>
	        	<a href="{{ action('Administrators\News\NewsCategoryController@create') }}" class="btn btn-primary">Thêm danh mục</a>
			</div>
	        <div class="col-md-12">
	        	@include('administrator.errors.messages')
	            <!--begin::Portlet-->
	            <div class="m-portlet m-portlet--tab">
	                <div class="m-portlet__head">
	                    <div class="m-portlet__head-caption">
	                        <div class="m-portlet__head-title">
	                            <span class="m-portlet__head-icon m--hide">
	                                <i class="la la-gear"></i>
	                            </span>
	                            <h3 class="m-portlet__head-text">
	                                Thêm mới danh mục
	                            </h3>
	                        </div>
	                    </div>
	                </div>
	                {{ Form::open(array('action' => 'Administrators\News\NewsCategoryController@store', 'class' => 'm-form m-form--fit m-form--label-align-right')) }}
	                    <div class="m-portlet__body">
	                        <div class="form-group m-form__group">
	                            <label for="name">
	                                Tên
	                            </label>
	                            <input type="name" class="form-control m-input" id="name" placeholder="Tên danh mục tin" name="name">
	                        </div>
	                        {{-- <div class="form-group m-form__group">
								<label for="user_type">
									Nhóm người dùng
								</label>
								<select multiple="" class="form-control m-input" id="user_type" name="user_type[]">
									@foreach ($data as $element)
                                        <option value="{{ $element['id'] }}">
                                            {{ $element['name'] }}
                                        </option>
                                    @endforeach
								</select>
							</div> --}}
	                    </div>
	                    <div class="m-portlet__foot m-portlet__foot--fit">
	                        <div class="m-form__actions">
	                            <button class="btn btn-primary">
	                                Lưu
	                            </button>
	                            <a class="btn btn-secondary" href="{{ action('Administrators\News\NewsCategoryController@index') }}">
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