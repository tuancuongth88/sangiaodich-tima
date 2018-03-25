@extends('administrator.app')
@section('title','Danh sách tin')

@section('content')
<div class="m-grid__item m-grid__item--fluid m-wrapper">
    <!-- BEGIN: Subheader -->
    <div class="m-subheader">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title m-subheader__title--separator">
                    Danh sách tin
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
            <a href="{{ action('Administrators\News\NewsController@create') }}" class="btn btn-primary m-btn m-btn--icon">
                <span>
                    <i class="fa flaticon-pie-chart"></i>
                    <span>
                        Thêm mới
                    </span>
                </span>
            </a>
        </div>
        @include('administrator.errors.info-search')
        <div class="m-section">
        	@include('administrator.errors.messages')
            <div class="m-section__content">
                <table class="table m-table m-table--head-bg-success">
                    <thead>
                        <tr>
                            <th>
                                #
                            </th>
                            <th>
                                Tiêu đề
                            </th>
                            <th>
                                Trạng thái
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
                                {{ $value['title'] }}
                            </td>
                            <td>
                                {{ ($value['is_approve'] == APPROVE) ? 'Đã duyệt' : 'Chưa duyệt' }}
                            </td>
                            <td>
                                {{ Form::open(array('method'=>'PUT', 'action' => array('Administrators\News\NewsController@putApprove', $value->id), 'style' => 'display: inline-block;')) }}
                                <button class="btn btn-success  m-btn m-btn--icon m-btn--icon-only">
                                    <i class="fa fa-sort"></i>
                                </button>
                                {{ Form::close() }}
                                <a href="{{ action('Administrators\News\NewsController@edit', $value->id) }}" class="btn btn-accent m-btn m-btn--icon m-btn--icon-only">
                                    <i class="fa fa-pencil"></i>
                                </a>
                                {{ Form::open(array('method'=>'DELETE', 'action' => array('Administrators\News\NewsController@destroy', $value->id), 'style' => 'display: inline-block;')) }}
                                <button onclick="return confirm('Bạn có chắc chắn muốn xóa?');" class="btn btn-danger m-btn m-btn--icon m-btn--icon-only">
                                    <i class="fa fa-close"></i>
                                </button>
                                {{ Form::close() }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{ $data->links() }}
            Tổng số {{ $data->total() }} bản ghi
        </div>
        <!--end::Section-->
    </div>
</div>
@stop