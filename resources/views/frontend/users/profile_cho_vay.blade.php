@extends('frontend.app')
@section('title','Thông tin tài khoản')

@section('content')
    <div class="container pb-5">

        <div class="tm-account bg-white p-md-5 pt-md-4 p-3">

            <div class="tm-dtcv bg-white p-3 px-md-5 pb-md-5 pt-md-4">
                <h2 class="text-uppercase fs-16 fw-6 mb-0">
                    Các gói sản phẩm bạn nhận đơn vay
                </h2>
                <hr class="mb-3">
                <div class="form-group">
                    <div class="row">
                        @foreach( \Common::getListServices() as $key => $value )
                            <label class="custom-control col-md-5">
                                <input value="{{ $key }}" name="chkEditSpice" type="checkbox" class="custom-control-input">
                                <span class="custom-control-indicator"></span>
                                <span class="custom-control-description" style="font-size: 17px">{{ $value }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>
                <div class="form-group">
                    <div class="text-center">
                        <button type="button" class="btn btn-primary" onclick="UpdateSpices()">CẬP NHẬT GÓI SẢN PHẨM MỚI</button>
                    </div>
                </div>
            </div>
            <div class="tm-dtcv bg-white p-3 px-md-5 pb-md-5 pt-md-4" id="editDistrictSpice">
                <h2 class="text-uppercase fs-16 fw-6 mb-0" id="idDistrictShowSpice">
                    Các quận huyện bạn nhận hồ sơ
                </h2>

                <hr class="mb-3">
                <div class="districtDiv form-group row">
                    @foreach( getLocationTree() as $key => $value )
                    <div class="col-sm-3">
                        <label class="custom-control fs-13 mr-5">
                            <input value="16" name="DistrictSpices" type="checkbox" class="custom-control-input">
                            <span class="custom-control-indicator"></span>
                            <span class="custom-control-description" style="font-size: 17px">Sóc Sơn</span>
                        </label>
                    </div>
                    @endforeach
                </div>
                <div class="form-group">
                    <div class="text-center">
                        <button type="button" class="btn btn-primary" onclick="UpdateDistrictSpices()">CẬP NHẬT TỈNH THÀNH</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop