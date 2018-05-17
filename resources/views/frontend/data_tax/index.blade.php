@extends('frontend.app')
@section('title', 'Tra cứu')

@section('content')

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <div class="container py-5">
        {{--<ul id="tabsJustified" class="nav nav-tabs">--}}
            {{--<li class="nav-item"><a href="" data-target="#doanhnghiep" data-toggle="tab" class="nav-link small text-uppercase active">Doanh nghiệp</a></li>--}}
            {{--<li class="nav-item"><a href="" data-target="#canhan" data-toggle="tab" class="nav-link small text-uppercase ">Cá nhân</a></li>--}}
        {{--</ul>--}}
        <ul class="nav nav-tabs">
            <li class="nav-item ">
                <a class="nav-link active"  data-toggle="tab" href="">Doanh nghiệp</a>
            </li>
            <li class="nav-item">
                <a class="nav-link"  href="{{ route('data.canhan') }}">Cá nhân</a>
            </li>

        </ul>
        <div class="tm-about bg-white py-5 py-md-5 py-xl-6 px-xl-0">
            <div id="tabsJustifiedContent" class="tab-content">
                <div class="container"><br>
                    <div class="px-3 px-md-5 px-xl-8 w-lg-75 mx-auto">
                        {{ Form::open(array('route' => 'data.tax', 'method'=>'GET', 'class' => 'm-form m-form--fit m-form--label-align-right', 'enctype' => 'multipart/form-data')) }}
                        <form id="frmCheckCIC" class="tima-search mx-auto px-md-12" novalidate="novalidate">
                            <div class="row mb-12 text-gray-light flex-column flex-sm-row">
                                <div class="col-sm-12 form-group mb-10">
                                    <label for="search-fc-1">Mã số thuế:</label>
                                    <div class="md-style md-style-icon">
                                        <input type="text" class="form-control" id="masothue" name="masothue" value="{{ old("masothue") }}" placeholder="Nhập mã số thuế">
                                    </div>
                                    <label for="search-fc-1">Loại hình:</label>
                                    <div class="md-style md-style-icon">
                                        {{ Form::select('type', [null => "---Lựa chọn---"] + \App\Models\DataTax\DataTax::$listType, old('type'), ['class' => 'form-control', 'required' => 'true' ]) }}
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-lg btn-block btn-primary justify-content-center align-items-center d-flex btn-search-tran">
                                Tìm kiếm
                                <i class="icon-search-white ml-3"></i>
                            </button>
                        </form>
                    </div>
                <hr class="my-6">
                <div class="px-3 px-md-5 px-xl-8" id="CICResult">
                    @if(isset($data))
                        <table class="table-bordered">
                            <tbody>
                            <tr>
                                <th width="16%">Xếp hạng tính dụng</th>
                                <td width="20%" colspan="5">
                                    {{ $data->checkEnterpriseLevel($_REQUEST['type']) }}
                                </td>

                            </tr>
                            <tr>
                                <th width="16%">Mã số doanh nghiệp</th>
                                <td width="20%" colspan="5">
                                    {{ $data->masothue }}
                                </td>

                            </tr>
                            <tr>
                                <th width="16%">Tên DTNT</th>
                                <td width="80%" colspan="5">
                                    {{ $data->tenchinhthuc }}
                                </td>
                            </tr>

                            <tr>
                                <th width="16%">Tên cơ quan thuế</th>
                                <td width="20%" colspan="5">{{ $data->noidangkyquanly }}</td>
                            </tr>

                            <tr>
                                <th width="16%">Địa chỉ trụ sở</th>
                                <td width="84%" colspan="5">{{ $data->diachitruso }}</td>
                            </tr>
                            <tr>
                                <th width="16%">Email</th>
                                <td width="84%" colspan="5">{{ $data->email }}</td>
                            </tr>
                            <tr>
                                <th width="16%">Số điện thoại</th>
                                <td width="84%" colspan="5">{{ $data->phone_company }}</td>
                            </tr>
                            <tr>
                                <th width="16%">Tên giám đốc</th>
                                <td width="20%" colspan="5">{{ $data->tengiamdoc }}</td>
                            </tr>
                            <tr>
                                <th width="16%">Kế toán trưởng</th>
                                <td width="20%" colspan="5">{{ $data->ketoantruong }}</td>
                            </tr>
                            </tbody></table>
                    @endif
                </div>
            </div>
        </div>
    </div>
@stop