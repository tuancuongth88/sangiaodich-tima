@extends('frontend.app')
@section('title', 'Tra cứu')

@section('content')

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <div class="container py-5">
        <ul class="nav nav-tabs">
            <li class="nav-item ">
                <a class="nav-link" href="{{ route('data.tax') }}">Doanh nghiệp</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active"  data-toggle="tab" href="#canhan">Cá nhân</a>
            </li>
        </ul>
        <div class="tm-about bg-white py-5 py-md-5 py-xl-6 px-xl-0">
            <div id="tabsJustifiedContent" class="tab-content">
                <div  class="container  ">
                    <div class="px-3 px-md-5 px-xl-8 w-lg-75 mx-auto">
                        {{ Form::open(array('route' => 'data.canhan', 'method'=>'GET', 'class' => 'm-form m-form--fit m-form--label-align-right', 'enctype' => 'multipart/form-data')) }}
                        <form id="frmCheckCIC" class="tima-search mx-auto px-md-12" novalidate="novalidate">
                            <div class="row mb-12 text-gray-light flex-column flex-sm-row">
                                <div class="col-sm-12 form-group mb-10">
                                    <label for="search-fc-1">Số chứng minh thư:</label>
                                    <div class="md-style md-style-icon">
                                        <input type="text" class="form-control" id="masothue" name="masothue" value="{{ old("masothue") }}" placeholder="Nhập chứng minh thư">
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
                        @if(isset($data_canhan))
                            <table class="table-bordered">
                                <tbody>
                                <tr>
                                    <th width="16%">Xếp hạng tính dụng</th>
                                    <td width="20%" colspan="5">
                                        Tốt
                                    </td>
                                </tr>
                                <tr>
                                    <th width="16%">Số chứng minh</th>
                                    <td width="20%" colspan="5">
                                        {{ $data_canhan->masothue }}
                                    </td>

                                </tr>
                                <tr>
                                    <th width="16%">Tên đầy đủ</th>
                                    <td width="80%" colspan="5">
                                        {{ $data_canhan->tenchinhthuc }}
                                    </td>
                                </tr>
                                <tr>
                                    <th width="16%">Số điện thoại</th>
                                    <td width="84%" colspan="5">{{ $data_canhan->phone_company }}</td>
                                </tr>
                                <tr>
                                    <th width="16%">Email</th>
                                    <td width="84%" colspan="5">{{ $data_canhan->email }}</td>
                                </tr>
                                <tr>
                                    <th width="16%">Địa chỉ</th>
                                    <td width="84%" colspan="5">{{ $data_canhan->diachitruso }}</td>
                                </tr>
                                </tbody></table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
@stop