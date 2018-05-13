@extends('administrator.app')
@section('title','Danh sách giao dịch của users')

@section('content')
    <div class="m-grid__item m-grid__item--fluid m-wrapper">
        <!-- BEGIN: Subheader -->
        <div class="m-subheader">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 class="m-subheader__title m-subheader__title--separator">
                        Danh sách tất cả các giao dịch của users
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
                <a href="{{ action('Administrators\Users\UserController@allTranHistoryExport') }}"
                   class="btn btn-primary m-btn m-btn--icon">
                <span>
                    <i class="fa flaticon-pie-chart"></i>
                    <span>
                        Xuất file
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
                                Số điện thoại
                            </th>
                            <th>
                                Số tiền phí
                            </th>
                            <th>
                                Loại doanh thu
                            </th>
                            <th>
                                Ngày phát sinh
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
                                    {{ $value->user->phone }}
                                </td>
                                <td>
                                    {{ $value->amount }}
                                </td>
                                <td>
                                    {{ $lis_type[$value->type] }}
                                </td>
                                <td>
                                    {{ $value->created_at }}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!--end::Section-->
        </div>
    </div>
@stop