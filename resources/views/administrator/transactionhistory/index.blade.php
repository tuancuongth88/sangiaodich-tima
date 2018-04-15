@extends('administrator.app')
@section('title','Danh sách giao dịch chờ duyệt')

@section('content')
    <div class="m-grid__item m-grid__item--fluid m-wrapper">
        <!-- BEGIN: Subheader -->
        <div class="m-subheader">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 class="m-subheader__title m-subheader__title--separator">
                        Danh sách giao dịch chờ duyệt
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
                                Khách hàng
                            </th>
                            <th>
                                Số điện thoại
                            </th>
                            <th>
                                Dịch vụ
                            </th>
                            <th>
                                Khu vực
                            </th>
                            <th>
                                Số tiền
                            </th>
                            <th>
                                Thời gian tạo
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
                                    {{ $value->user->fullname }}
                                </td>
                                <td>
                                    {{ $value->user->phone }}
                                </td>
                                <td>
                                    {{ $value->service->service_name }}
                                </td>
                                <td>
                                    {{ isset($value->district_id) ? getLocation($value->district_id)['name'] : "" }}
                                    <br>
                                    {{ isset($value->city_id) ? getLocation($value->city_id)['name'] : "" }}
                                </td>
                                <td>
                                    {{ number_format($value->amount) }}
                                </td>
                                <td>
                                    {{ $value->created_at }}
                                </td>
                                <td>
                                    {{ Form::open(array('method'=>'PUT', 'route' => array('admin.transaction.approve', $value->id), 'style' => 'display: inline-block;')) }}
                                    <button class="btn btn-success ">
                                        Duyệt
                                    </button>
                                    {{ Form::close() }}
                                    {{ Form::open(array('method'=>'PUT', 'route' => array('admin.transaction.reject', $value->id), 'style' => 'display: inline-block;')) }}
                                    <button onclick="return confirm('Bạn có chắc chắn muốn hủy giao dịch này?');" class="btn btn-danger ">
                                        Hủy
                                    </button>
                                    <a href="{{ action('Administrators\News\NewsController@show', $value->id) }}" class="btn btn-accent ">
                                        Chi tiết
                                    </a>
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