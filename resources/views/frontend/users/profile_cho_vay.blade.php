@extends('frontend.app')
@section('title','Thông tin tài khoản')

@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="container py-5">
        <div class="tm-account bg-white p-md-5 pt-md-4 p-3">
            <div class="profilecard media bg-gray-lighter p-sm-4 p-3" style="margin-bottom: 50px;">
                <img class="profilecard__img wf-80 wf-md-126 mr-md-5 mr-3" style="cursor: pointer;"
                     src="{{ ($data['avatar']!='') ? $data['avatar']:asset('frontend/images/avatar-default-2.svg')}}"
                     alt="avatar-san-tai-chinh-Thanh Lam" id="imgAvatar" onclick="CallUploadFile()"
                     title="Đổi ảnh đại diện khác">
                <input type="file" name="uploadAvatar" id="uploadAvatar" multiple="" style="display: none;"
                       accept="image/*">
                <input type="hidden" id="hddImgDomain" value="http://rs.tima.vn/staticFile">
                <input type="hidden" id="UserID" value="11386">
                <div class="profilecard__body media-body align-self-center">
                    <p class="fs-13 text-gray-light mb-0">
                        <span>Thông tin tài khoản</span>
                        <span style="position: absolute; right: 68px;margin-top:-7px" class="hidden-xs-down">
                           <a class="btn btn-primary text-uppercase text-white fs-15 fs-lg-15 btn-sm"
                              href="{{action('Frontends\TransactionHistory\TransactionHistoryController@index')}}">
                           Quản lý đơn vay
                           </a>
                           </span>
                    </p>
                    <hr class="mt-2 border-gray">
                    <div class="row  mb-4">
                        <div class="col-md-6">
                            <div class="row">
                                <label class="col-sm-4 fs-13">Tên đăng nhập :</label>
                                <label class="col-sm-4 fs-13">
                                    <b>{{$data['phone']}}</b>
                                </label>
                            </div>
                            <div class="row">
                                <label class="col-sm-4 fs-13">Loại tài khoản<span
                                            style="margin-left: 8px">:</span></label>
                                <label class="col-sm-4 fs-13"><b>Nhà đầu tư</b></label>
                            </div>
                            <div class="row">
                                <label class="col-sm-4 fs-13">Số dư<span style="margin-left: 8px">:</span></label>
                                <label class="col-sm-4 fs-13">
                                    <b>
                                        <a href="http://tima.vn/lich-su-giao-dich.html"
                                           class="btn btn-primary text-uppercase text-white fs-15 fs-lg-15 btn-sm">
                                            9,000
                                        </a>
                                    </b>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-6">
                            <div class="profilecard__progress">
                                <p class="mb-0 text-gray-light fs-13">Mức độ hoàn thành hồ sơ</p>
                                <div class="progress mb-2">
                                    <div class="progress-bar" role="progressbar" style="width: 86%;"
                                         aria-valuenow="86" aria-valuemin="0" aria-valuemax="100">
                                        <span class="progress-tooltip">86%</span>
                                    </div>
                                </div>
                                <p class="mb-0 text-gray-light fs-13">
                                    Bạn vui lòng cập nhật đầy đủ hồ sơ để khách hàng có thể kết nối được với bạn.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{ Form::open(['route' => ['frontend.user.update-user-info-lender', $data->id], 'method' => 'POST']) }}
            <input type="hidden" id="hddUserID" name="id" value="{{$data['id']}}">
            <input type="hidden" id="hddCityID" value="{{$data['city_id']}}">
            <input type="hidden" id="hddCityName" value="Hà Nội">
            <div class="accinfo-2">
                <div class="row mb-3">
                    <input type="hidden" id="hddLenderId" value="11386">
                    <div class="row col-xl-12">
                        <div class="col-xl-6">
                            <div class="form-group row">
                                <label for="txtFullName" class="col-sm-4 col-form-label text-sm-right">
                                    Họ &amp;Tên:</label>
                                <div class="col-xl-8 col-sm-7">
                                    <input type="text" class="form-control" id="txtFullName" placeholder=""
                                           name="fullname"
                                           value="{{$data['fullname']}}">
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="form-group row">
                                <label for="txtPhone" class="col-sm-4 col-form-label text-sm-right">
                                    Điện thoại:
                                </label>
                                <div class="col-xl-8 col-sm-7">
                                    <input type="tel" class="form-control" id="txtPhone" placeholder=""
                                           readonly name="phone"
                                           value="{{$data['phone']}}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row col-xl-12">
                        <div class="col-xl-6">
                            <div class="form-group row">
                                <label for="slGender" class="col-sm-4 col-form-label text-sm-right">
                                    Giới tính:
                                </label>
                                <div class="col-xl-8 col-sm-7">
                                    <select class="form-control" id="slGender" name="sex">
                                        <option value="0" {{($data['sex']==0) ? 'selected':''}}>Nam</option>
                                        <option value="1" {{($data['sex']==1) ? 'selected':''}} >Nữ</option>
                                        <option value="2" {{($data['sex']==2) ? 'selected':''}} >Khác</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="form-group row">
                                <label for="cbCity" class="col-sm-4 col-form-label text-sm-right">Thành phố:</label>
                                <div class="col-xl-8 col-sm-7">
                                    {{ Form::select(
                                    'city_id',
                                     ['' => 'Chọn thành phố...']+getCityList(),
                                      $data['city_id'],
                                       ['class' => 'selectpicker form-control input-lg',
                                        'id' => "cbCity",
                                         'required']
                                         ) }}
                                    <span class="error text-primary">{{ $errors->first('city') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row col-xl-12">
                        <div class="col-xl-6">
                            <div class="form-group row">
                                <label for="cbDistrict"
                                       class="col-sm-4 col-form-label text-sm-right">Quận/Huyện:</label>
                                <div class="col-xl-8 col-sm-7">
                                    {{ Form::select(
                                    'district_id',
                                    ['' => 'Chọn quận huyện ...']+getDistrictList($data['city_id']),
                                     $data['district_id'],
                                      ['class' => 'selectpicker form-control input-lg',
                                      'id' => "cbDistrict", 'required']
                                      ) }}
                                    <span class="error text-primary">{{ $errors->first('district') }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="form-group row">
                                <label for="cbWard" class="col-sm-4 col-form-label text-sm-right">Phường/Xã:</label>
                                <div class="col-xl-8 col-sm-7">
                                    {{ Form::select(
                                    'ward_id',
                                    ['' => 'Chọn phường xã...']+getWardList($data['district_id']),
                                      $data['ward_id'],
                                      ['class' => 'selectpicker form-control input-lg',
                                      'id' => "cbWard", 'required']
                                      ) }}
                                    <span class="error text-primary">{{ $errors->first('ward') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row col-xl-12">
                        <div class="col-xl-12">
                            <div class="form-group row">
                                <label for="txtAddress" class="col-xl-2 col-sm-4 col-form-label text-sm-right">Địa
                                    chỉ:</label>
                                <div class="col-xl-10 col-sm-7">
                                    <input type="text" class="form-control" id="txtAddress" placeholder=""
                                           name="address" value="{{$data['address']}}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-center">
                    <input type="submit" id="btnUpdateInfoLender" data-id="11386" data-cmd="enable-form"
                           class="btn btn-primary mx-auto text-uppercase" value="Cập nhật">
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
    <div class="container pb-5">

        <div class="tm-account bg-white p-md-5 pt-md-4 p-3">

            <div class="tm-dtcv bg-white p-3 px-md-5 pb-md-5 pt-md-4">
                <h2 class="text-uppercase fs-16 fw-6 mb-0">
                    Các gói sản phẩm bạn nhận đơn vay
                </h2>
                <hr class="mb-3">
                {{ Form::open(['route' => ['frontend.user.save_service', $data->id], 'method' => 'POST']) }}
                @csrf
                <div class="form-group">
                    <div class="row">
                        @foreach( \Common::getListServices() as $key => $value )
                            <label class="custom-control col-md-5">
                                <input value="{{ $key }}" name="servies[]"
                                       {{ in_array($key, $data->services()) ? 'checked' : '' }} type="checkbox"
                                       class="custom-control-input">
                                <span class="custom-control-indicator"></span>
                                <span class="custom-control-description" style="font-size: 17px">{{ $value }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>
                <div class="form-group">
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary" onclick="UpdateSpices()">CẬP NHẬT GÓI SẢN PHẨM
                            MỚI
                        </button>
                    </div>
                </div>
                {{ Form::close() }}
            </div>

            @if( $data->city_id != '' )
                <div class="tm-dtcv bg-white p-3 px-md-5 pb-md-5 pt-md-4" id="editDistrictSpice">
                    <h2 class="text-uppercase fs-16 fw-6 mb-0" id="idDistrictShowSpice">
                        Các quận huyện bạn nhận hồ sơ
                    </h2>

                    <hr class="mb-3">
                    {{ Form::open(['route' => ['frontend.user.save_location', $data->id], 'method' => 'POST']) }}
                        @csrf
                        <div class="districtDiv form-group row">
                            @foreach( getLocationTree($data->city_id) as $key => $value )
                                <div class="col-sm-3">
                                    <label class="custom-control fs-13 mr-5">
                                        <input value="{{ $value['tid'] }}" name="districts[]"
                                               {{ in_array($value['tid'], $data->locations()) ? 'checked' : '' }} type="checkbox"
                                               class="custom-control-input">
                                        <span class="custom-control-indicator"></span>
                                        <span class="custom-control-description"
                                              style="font-size: 17px">{{ $value['name'] }}</span>
                                    </label>
                                </div>
                            @endforeach
                        </div>
                        <div class="form-group">
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary" onclick="UpdateDistrictSpices()">CẬP NHẬT TỈNH
                                    THÀNH
                                </button>
                            </div>
                        </div>
                    {{ Form::close() }}
                </div>
            @endif

        </div>
    </div>
@stop