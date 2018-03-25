@extends('administrator.app')
@section('title','Danh sách contact')

@section('content')
<div class="m-grid__item m-grid__item--fluid m-wrapper">
    <!-- BEGIN: Subheader -->
    <div class="m-subheader">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title m-subheader__title--separator">
                    Danh sách
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
                                Tên
                            </th>
                            <th>
                                Email
                            </th>
                            <th>
                                Số điện thoại
                            </th>
                            <th>Đia chỉ</th>
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
                                {{ $value['email'] }}
                            </td>
                            <td>
                                {{ $value['phone'] }}
                            </td>
                            <td>
                                {{ $value['address'] }}
                            </td>
                            <td>
                                <a href="{{ route('contact.show', $value->id) }}" class="btn btn-accent m-btn m-btn--icon m-btn--icon-only">
                                    <i class="fa fa-eye"></i>
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