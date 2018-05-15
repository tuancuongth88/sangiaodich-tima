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

            {{ Form::open(array('action' => 'Administrators\Users\UserController@allTranHistory',
                 'class' => 'm-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed frmReport ',
                  'enctype' => 'multipart/form-data',
                  'method' => 'GET'
                  ))
                  }}
            <div class="row gutter-2 gutter-lg-3 mb-4">
                <div class="col-md-3 col-sm-6 mb-3 mb-md-0">
                    {{ Form::select('type',
                     [0 => 'Tất cả']+ $lis_type,
                      isset($input['type'])? $input['type']:null,
                       ['class' => 'form-control border-primary rounded-0 fs-15', 'id' => 'cbType']) }}
                </div>
                <div class="col-md-3 col-sm-6 mb-3 mb-md-0">
                    {{ Form::text('from', '',
                    array(
                    'class' => 'form-control border-primary rounded-0 fs-15 datepicker',
                    'placeholder'=>'Từ ngày',
                    'data-date-format'=>"dd-mm-yyyy"
                    )) }}
                </div>
                <div class="col-md-3 col-sm-6 mb-3 mb-md-0">
                    {{ Form::text('to', '',
                    array(
                    'class' => 'form-control border-primary rounded-0 fs-15 datepicker',
                    'placeholder'=>'Đến ngày',
                    'data-date-format'=>"dd-mm-yyyy"
                    )) }}
                </div>
                <div class="col-md-3 col-sm-6 mb-3 mb-md-0" style="margin-top:  5px;">
                    {{ Form::text('phone', '',
                    array(
                    'class' => 'form-control border-primary rounded-0 fs-15',
                    'placeholder'=>'Số điện thoại'
                    )) }}
                </div>


                <input type="hidden" class="txtisDownload" name="download"
                       value="{{isset($input['download'])? $input['download']:0}}"/>

                <div class="col-md-3 col-sm-6" style="margin-top:  5px;">
                    <button type="submit" class="btn btn-primary">Tìm kiếm</button>
                    &nbsp;
                    <button type="button" class="btn btn-primary btnDownload">Tải về báo cáo</button>

                </div>
            </div>
            {{ Form::close() }}
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
    <script type="text/javascript">
        $(document).ready(function () {
            $('.btnDownload').click(function () {
                $('.txtisDownload').val(1);
                $('.frmReport').submit();
            });
        });
    </script>
@stop