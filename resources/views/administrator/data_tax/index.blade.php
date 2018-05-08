@extends('administrator.app')
@section('title','Danh sách')

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
            <div class="col-xs-12" style="margin-bottom: 20px">
                <button type="button" class="btn btn-focus" data-toggle="modal" data-target="#m_modal_4">
                    Import File
                </button>
            </div>
            <div class="m-section">
                @include('administrator.errors.messages')
                <div class="m-section__content">
                    <table class="table m-table m-table--head-bg-success">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Mã số thuế </th>
                            <th>Tên DTNT </th>
                            <th>Cơ quan thuế </th>
                            <th>Email </th>
                            <th>Điện thoại CTY</th>
                            <th>Kê toán</th>
                            <th>Điện thoại KT</th>
                            <th>Giám đốc</th>
                            <th>Điện thoại GĐ</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $key => $value)
                            <tr>
                                <th scope="row">
                                    {{ $key + 1 }}
                                </th>
                                <td>{{ $value['masothue'] }}</td>
                                <td>{{ $value['tenchinhthuc'] }}</td>
                                <td>{{ $value['noidangkynopthue'] }}</td>
                                <td>{{ $value['email'] }}</td>
                                <td>{{ $value['phone_company'] }}</td>
                                <td>{{ $value['ketoantruong'] }}</td>
                                <td>{{ $value['sodienthoaiketoantruong'] }}</td>
                                <td>{{ $value['tengiamdoc'] }}</td>
                                <td>{{ $value['sodienthoaigiamdoc'] }}</td>

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
    <div class="modal fade" id="m_modal_4" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        Import File Excel
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">
                            ×
                        </span>
                    </button>
                </div>
                <div class="modal-body">
                    {{ Form::open(array('route' => 'upload.tax.file', 'class' => 'm-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed m-form--state', 'id' => 'create-news', 'enctype' => 'multipart/form-data')) }}
{{--                    <form action="{{ url('admin/import-tax/file') }}" enctype="multipart/form-data" method="POST">--}}
                        <div class="form-group">
                            <label for="recipient-name" class="form-control-label">
                                Upload File:
                            </label>
                            <input type="file" name="file_data" required="true" class="form-control">
                        </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            Close
                        </button>
                        <button type="submit" class="btn btn-primary">
                            Upload File
                        </button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop