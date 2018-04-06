@extends('administrator.app')
@section('title','Danh sách dịch vụ')

@section('content')
    <div class="m-grid__item m-grid__item--fluid m-wrapper">
        <!-- BEGIN: Subheader -->
        <div class="m-subheader">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 class="m-subheader__title m-subheader__title--separator">
                        Danh sách dịch vụ
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
                <a href="{{ route('service.create') }}" class="btn btn-primary m-btn m-btn--icon">
                <span>
                    <i class="fa fa-plus"></i>
                    <span>
                        Thêm mới
                    </span>
                </span>
                </a>
            </div>
            <div class="m-section">
                @include('administrator.errors.messages')
                <div class="m-section__content">
                    <table class="table m-table m-table--head-bg-success">
                        <thead>
                            <tr>
                                <th width="50px">STT</th>
                                <th>Tên</th>
                                <th>Icon</th>
                                <th>Ngày tạo</th>
                                <th width="120px">Tùy chọn</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $key => $value)
                                <tr>
                                    <th scope="row">
                                        {{ $key + 1 }}
                                    </th>
                                    <td>{{ $value['service_name'] }}</td>
                                    <td><img src="{{ ($value->icon_url) ? $value->icon_url : NO_IMG }}" style="width: 50px"></td>
                                    <td>{{ $value->created_at }}</td>
                                    <td>
                                        <a title="Sửa" href="{{ route('service.edit', $value->id) }}" class="btn btn-accent m-btn m-btn--icon m-btn--icon-only">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                        {{ Form::open(array('method'=>'DELETE', 'route' => array('service.destroy', $value->id), 'style' => 'display: inline-block;')) }}
                                        <button title="Xóa" onclick="return confirm('Bạn có chắc chắn muốn xóa?');" class="btn btn-danger m-btn m-btn--icon m-btn--icon-only">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                        {{ Form::close() }}
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