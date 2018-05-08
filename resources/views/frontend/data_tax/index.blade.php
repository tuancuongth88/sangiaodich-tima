@extends('frontend.app')
@section('title', $data['title'])

@section('content')

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="container py-5">
        <div class="tm-about bg-white py-5 py-md-5 py-xl-6 px-xl-0">
            <div class="px-3 px-md-5 px-xl-8 w-lg-75 mx-auto">
                <h3 class="text-center fw-3 fs-30 mb-3">
                    Chức năng tra cứu thuế
                </h3>
                {{ Form::open(array('route' => 'data.tax', 'method'=>'GET', 'class' => 'm-form m-form--fit m-form--label-align-right', 'enctype' => 'multipart/form-data')) }}
                <form id="frmCheckCIC" class="tima-search mx-auto px-md-12" novalidate="novalidate">
                    <div class="row mb-12 text-gray-light flex-column flex-sm-row">
                        <div class="col-sm-12 form-group mb-10">
                            <label for="search-fc-1">Mã số thuế:</label>
                            <div class="md-style md-style-icon">
                                <input type="tel" class="form-control" id="masothue" name="masothue" value="{{ old("masothue") }}" placeholder="Nhập mã số thuế" value="">
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
                @if($data)
                <table class="table-bordered">
                    <tbody><tr>
                        <th width="16%">Mã số doanh nghiệp</th>
                        <td width="20%">
                            {{ $data->masothue }}
                        </td>
                        <th width="16%">Ngày cấp
                        </th><td width="16%">{{ $data->ngaycap }}</td>
                        <th width="16%">Ngày đóng MST</th>
                        <td width="16%"></td>
                    </tr>
                    <tr>
                        <th width="16%">Tên chính thức</th>
                        <td width="20%">
                            {{ $data->tenchinhthuc }}
                        </td>
                        <th width="16%">Tên giao dịch
                        </th><td width="48%" colspan="3"></td>
                    </tr>

                    <tr>
                        <th width="16%">Nơi đăng ký quản lý thuế</th>
                        <td width="20%" colspan="5">{{ $data->noidangkyquanly }}</td>
                    </tr>

                    <tr>
                        <th width="16%">Địa chỉ trụ sở</th>
                        <td width="84%" colspan="5">{{ $data->diachitruso }}</td>
                    </tr>
                    <tr>
                        <th width="16%">Nơi đăng ký nộp thuế</th>
                        <td width="20%" colspan="5">{{ $data->noidangkynopthue }}</td>
                    </tr>
                    <tr>
                        <th width="16%">Địa chỉ nhận thông báo thuế</th>
                        <td width="84%" colspan="5">{{ $data->diachinhanthongbaothe }}</td>
                    </tr>
                    <tr>
                        <th width="16%">QĐTL-Ngày cấp</th>
                        <td width="20%">{{ $data->qdtlngaycap }}</td>
                        <th width="16%">Cơ quan ra quyết định</th>
                        <td width="48%" colspan="3">{{ $data->coquanraquyetdinh }}</td>
                    </tr>
                    <tr>
                        <th width="16%">GPKD-Ngày cấp</th>
                        <td width="20%">&nbsp;{{ $data->gpkdngaycap }}&nbsp;</td>
                        <th width="16%">Cơ quan cấp</th>
                        <td width="16%">{{ $data->coquancap }}</td>
                        <th width="16%">Ngày nhận tờ khai</th>
                        <td width="16%">{{ $data->ngaynhantokhai }}</td>
                    </tr>

                    <tr>
                        <th width="16%">Ngày/tháng bắt đầu <br>năm tài chính</th>
                        <td width="20%">{{ $data->ngaybatdautaichinh }}</td>
                        <th width="16%">Ngày/tháng kết thúc <br>năm tài chính</th>
                        <td width="16%">{{ $data->ngayketthuctaichinh }}</td>
                        <th width="16%">Mã số hiện thời</th>
                        <td width="16%">{{ $data->masohientai }}</td>

                    </tr>
                    <tr>
                        <th width="16%">Ngày bắt đầu HĐ</th>
                        <td width="20" colspan="5"></td>
                    </tr>
                    <tr>
                        <th width="16%">Chương – Khoản</th>

                        <td width="20">{{ $data->chuong }}</td>
                        <th width="16%">Hình thức h.toán</th>
                        <td width="16%">
                            {{ $data->hinhthuchtoan }}
                        </td>
                        <th width="16%">PP tính thuế GTGT</th>
                        <td width="16%">
                            {{ $data->pptinhthuegtgt }}
                        </td>
                    </tr>
                    <tr>
                        <th width="16%">Chủ sở hữu/Người đại diện pháp luật</th>
                        <td width="20%">{{ $data->chusohuu_nguoidaidien }}</td>
                        <th width="16%">Địa chỉ chủ sở hữu/người đại diện pháp luật</th>
                        <td width="48%" colspan="3">
                            {{ $data->diachi_chusohuu_nguoidaidien }}
                        </td>
                    </tr>
                    <tr>
                        <th width="16%">Tên giám đốc</th>
                        <td width="20%">{{ $data->tengiamdoc }}</td>
                        <th width="16%">Địa Chỉ</th>
                        <td width="48%" colspan="3">{{ $data->diachigiamdoc }}</td>
                    </tr>
                    <tr>
                        <th width="16%">Kế toán trưởng</th>
                        <td width="20%">{{ $data->ketoantruong }}</td>
                        <th width="16%">Địa Chỉ</th>
                        <td width="48%" colspan="3">{{ $data->diachiketoantruong }}</td>
                    </tr>
                    </tbody></table>
                @endif
            </div>
        </div>
    </div>
@stop