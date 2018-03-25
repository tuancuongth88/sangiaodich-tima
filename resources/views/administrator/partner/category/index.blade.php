@extends('administrator.app')
@section('title','Danh mục đối tác')

@section('content')
<div class="m-grid__item m-grid__item--fluid m-wrapper">
    <!-- BEGIN: Subheader -->
    <div class="m-subheader">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title m-subheader__title--separator">
                    Danh mục đối tác
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
    <!-- END: Subheader -->
    <div class="m-content">
        <!--begin::Section-->
        <div class="col-xs-12" style="margin-bottom: 20px">
            <a href="{{ action('Administrators\Partner\PartnerCategoryController@create') }}" class="btn btn-primary m-btn m-btn--icon">
                <span>
                    <i class="fa flaticon-pie-chart"></i>
                    <span>
                        Thêm mới
                    </span>
                </span>
            </a>
        </div>
        <div class="m-section">
            <div class="m-section__content">
                <table class="table m-table m-table--head-bg-success">
                    <thead>
                        <tr>
                            <th>
                                #
                            </th>
                            <th>
                                Tên
                            </th>
                            <th>
                                Số lượng
                            </th>
                            <th>
                                Tùy chọn
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $key => $value)
                        <tr>
                            <th scope="row">
                                {{ $key + 1 }}
                            </th>
                            <td>
                                {{ $value['name'] }}
                            </td>
                            <td>
                                {{ $value->partner()->count() }}
                            </td>
                            <td>
                                {{ Form::open(array('method'=>'DELETE', 'action' => array('Administrators\Partner\PartnerCategoryController@destroy', $value->id), 'style' => 'display: inline-block;')) }}
                                <button onclick="return confirm('Bạn có chắc chắn muốn xóa danh mục và {{ $value->partner()->count() }} đối tác?');" class="btn btn-danger m-btn m-btn--icon m-btn--icon-only">
                                    <i class="fa flaticon-cogwheel-1"></i>
                                </button>
                                {{ Form::close() }}
                                <a href="{{ action('Administrators\Partner\PartnerCategoryController@edit', $value->id) }}" class="btn btn-accent m-btn m-btn--icon m-btn--icon-only">
                                    <i class="fa flaticon-clock"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{ $data->links() }}
        </div>
        <!--end::Section-->
    </div>
</div>
@stop