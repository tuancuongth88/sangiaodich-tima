@extends('frontend.app')
@section('title','Thông tin khách hàng')

@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="container py-5">
        <div class="tm-account bg-white p-md-5 pt-md-4 p-3">
            <div class="profilecard media bg-gray-lighter p-sm-4 p-3" style="margin-bottom: 50px;">
                <img class="profilecard__img wf-80 wf-md-126 mr-md-5 mr-3" style="cursor: pointer;"
                     src="./Thông tin chi tiết người dùng_files/avatar-default-2.svg"
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
                              href="http://tima.vn/Lender/ListLoan/">
                           Quản lý đơn vay
                           </a>
                           <a href="http://tima.vn/nap-tien.html"
                              class="btn btn-primary text-uppercase text-white fs-15 fs-lg-15 btn-sm">
                           <i class="fa fa-usd" aria-hidden="true"></i> Nạp tiền
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
            <input type="hidden" id="hddUserID" value="{{$data['id']}}">
            <input type="hidden" id="hddCityID" value="1">
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
                                           disabled="disabled" value="{{$data['phone']}}">
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
                                    <select class="form-control" id="slGender">
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
                                      null,
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
                                    ['' => 'Chọn quận huyện ...'],
                                     null,
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
                                    'district_id',
                                    ['' => 'Chọn phường xã...'],
                                     null,
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
                                    <input type="text" class="form-control" id="txtAddress" placeholder="" value="{{$data['address']}}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-center">
                    <input type="button" id="btnUpdateInfoLender" data-id="11386" data-cmd="enable-form"
                           class="btn btn-primary mx-auto text-uppercase" value="Cập nhật">
                </div>
            </div>
        </div>
    </div>
    <div class="container pb-5">
        <div class="tm-account bg-white p-md-5 pt-md-4 p-3">
            <script src="./Thông tin chi tiết người dùng_files/jquery.min.js.download"></script>
            <script src="./Thông tin chi tiết người dùng_files/spicesLender.js.download"></script>
            <div class="tm-dtcv bg-white p-3 px-md-5 pb-md-5 pt-md-4">
                <h2 class="text-uppercase fs-16 fw-6 mb-0">
                    Các gói sản phẩm bạn nhận đơn vay
                </h2>
                <hr class="mb-3">
                <div class="form-group">
                    <div class="row">
                        <label class="custom-control col-md-5">
                            <input value="1" name="chkEditSpice" type="checkbox" checked="&#39;checked&#39;"
                                   class="custom-control-input" onclick="updateProductSpice(1,1)">
                            <span class="custom-control-indicator"></span>
                            <span class="custom-control-description"
                                  style="font-size: 17px">Vay tín chấp theo lương</span>
                        </label>
                        <label class="custom-control col-md-5">
                            <input value="2" name="chkEditSpice" type="checkbox" checked="&#39;checked&#39;"
                                   class="custom-control-input" onclick="updateProductSpice(2,1)">
                            <span class="custom-control-indicator"></span>
                            <span class="custom-control-description"
                                  style="font-size: 17px">Vay theo đăng ký xe máy</span>
                        </label>
                        <label class="custom-control col-md-5">
                            <input value="4" name="chkEditSpice" type="checkbox" class="custom-control-input"
                                   onclick="updateProductSpice(4,0)">
                            <span class="custom-control-indicator"></span>
                            <span class="custom-control-description"
                                  style="font-size: 17px">Vay theo sổ hộ khẩu</span>
                        </label>
                        <label class="custom-control col-md-5">
                            <input value="7" name="chkEditSpice" type="checkbox" class="custom-control-input"
                                   onclick="updateProductSpice(7,0)">
                            <span class="custom-control-indicator"></span>
                            <span class="custom-control-description"
                                  style="font-size: 17px">Vay theo đăng ký xe ô tô</span>
                        </label>
                        <label class="custom-control col-md-5">
                            <input value="8" name="chkEditSpice" type="checkbox" class="custom-control-input"
                                   onclick="updateProductSpice(8,0)">
                            <span class="custom-control-indicator"></span>
                            <span class="custom-control-description"
                                  style="font-size: 17px">Vay trả góp theo ngày</span>
                        </label>
                        <label class="custom-control col-md-5">
                            <input value="11" name="chkEditSpice" type="checkbox" class="custom-control-input"
                                   onclick="updateProductSpice(11,0)">
                            <span class="custom-control-indicator"></span>
                            <span class="custom-control-description"
                                  style="font-size: 17px">Vay mua ô tô trả góp</span>
                        </label>
                        <label class="custom-control col-md-5">
                            <input value="12" name="chkEditSpice" type="checkbox" class="custom-control-input"
                                   onclick="updateProductSpice(12,0)">
                            <span class="custom-control-indicator"></span>
                            <span class="custom-control-description"
                                  style="font-size: 17px">Vay theo hóa đơn điện nước</span>
                        </label>
                        <label class="custom-control col-md-5">
                            <input value="15" name="chkEditSpice" type="checkbox" class="custom-control-input"
                                   onclick="updateProductSpice(15,0)">
                            <span class="custom-control-indicator"></span>
                            <span class="custom-control-description"
                                  style="font-size: 17px">Vay mua nhà trả góp</span>
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <div class="text-center">
                        <button type="button" class="btn btn-primary" onclick="UpdateSpices()">CẬP NHẬT GÓI SẢN PHẨM
                            MỚI
                        </button>
                    </div>
                </div>
            </div>
            <div class="tm-dtcv bg-white p-3 px-md-5 pb-md-5 pt-md-4" id="editDistrictSpice">
                <h2 class="text-uppercase fs-16 fw-6 mb-0" id="idDistrictShowSpice">CÁC QUẬN HUYỆN BẠN NHẬN HỒ SƠ Ở
                    Hà Nội
                </h2>
                <hr class="mb-3">
                <div class="districtDiv form-group row">
                    <div class="col-sm-3"><label class="custom-control fs-13 mr-5"> <input value="16"
                                                                                           name="DistrictSpices"
                                                                                           type="checkbox"
                                                                                           class="custom-control-input"
                                                                                           checked="checked" "=""
                            onclick="SelectDistrict(16,1,1)"><span class="custom-control-indicator"></span><span
                                    class="custom-control-description" style="font-size: 17px">  Sóc Sơn</span></label>
                    </div>
                    <div class="col-sm-3"><label class="custom-control fs-13 mr-5"> <input value="17"
                                                                                           name="DistrictSpices"
                                                                                           type="checkbox"
                                                                                           class="custom-control-input"
                            "="" onclick="SelectDistrict(17,1,0)"><span class="custom-control-indicator"></span><span
                                    class="custom-control-description" style="font-size: 17px">  Đông Anh</span></label>
                    </div>
                    <div class="col-sm-3"><label class="custom-control fs-13 mr-5"> <input value="18"
                                                                                           name="DistrictSpices"
                                                                                           type="checkbox"
                                                                                           class="custom-control-input"
                            "="" onclick="SelectDistrict(18,1,0)"><span class="custom-control-indicator"></span><span
                                    class="custom-control-description" style="font-size: 17px">  Gia Lâm</span></label>
                    </div>
                    <div class="col-sm-3"><label class="custom-control fs-13 mr-5"> <input value="20"
                                                                                           name="DistrictSpices"
                                                                                           type="checkbox"
                                                                                           class="custom-control-input"
                            "="" onclick="SelectDistrict(20,1,0)"><span class="custom-control-indicator"></span><span
                                    class="custom-control-description"
                                    style="font-size: 17px">  Thanh Trì</span></label></div>
                    <div class="col-sm-3"><label class="custom-control fs-13 mr-5"> <input value="250"
                                                                                           name="DistrictSpices"
                                                                                           type="checkbox"
                                                                                           class="custom-control-input"
                            "="" onclick="SelectDistrict(250,1,0)"><span class="custom-control-indicator"></span><span
                                    class="custom-control-description" style="font-size: 17px">  Mê Linh</span></label>
                    </div>
                    <div class="col-sm-3"><label class="custom-control fs-13 mr-5"> <input value="271"
                                                                                           name="DistrictSpices"
                                                                                           type="checkbox"
                                                                                           class="custom-control-input"
                            "="" onclick="SelectDistrict(271,1,0)"><span class="custom-control-indicator"></span><span
                                    class="custom-control-description" style="font-size: 17px">  Ba Vì</span></label>
                    </div>
                    <div class="col-sm-3"><label class="custom-control fs-13 mr-5"> <input value="272"
                                                                                           name="DistrictSpices"
                                                                                           type="checkbox"
                                                                                           class="custom-control-input"
                            "="" onclick="SelectDistrict(272,1,0)"><span class="custom-control-indicator"></span><span
                                    class="custom-control-description" style="font-size: 17px">  Phúc Thọ</span></label>
                    </div>
                    <div class="col-sm-3"><label class="custom-control fs-13 mr-5"> <input value="273"
                                                                                           name="DistrictSpices"
                                                                                           type="checkbox"
                                                                                           class="custom-control-input"
                            "="" onclick="SelectDistrict(273,1,0)"><span class="custom-control-indicator"></span><span
                                    class="custom-control-description"
                                    style="font-size: 17px">  Đan Phượng</span></label></div>
                    <div class="col-sm-3"><label class="custom-control fs-13 mr-5"> <input value="274"
                                                                                           name="DistrictSpices"
                                                                                           type="checkbox"
                                                                                           class="custom-control-input"
                            "="" onclick="SelectDistrict(274,1,0)"><span class="custom-control-indicator"></span><span
                                    class="custom-control-description" style="font-size: 17px">  Hoài Đức</span></label>
                    </div>
                    <div class="col-sm-3"><label class="custom-control fs-13 mr-5"> <input value="275"
                                                                                           name="DistrictSpices"
                                                                                           type="checkbox"
                                                                                           class="custom-control-input"
                            "="" onclick="SelectDistrict(275,1,0)"><span class="custom-control-indicator"></span><span
                                    class="custom-control-description" style="font-size: 17px">  Quốc Oai</span></label>
                    </div>
                    <div class="col-sm-3"><label class="custom-control fs-13 mr-5"> <input value="276"
                                                                                           name="DistrictSpices"
                                                                                           type="checkbox"
                                                                                           class="custom-control-input"
                            "="" onclick="SelectDistrict(276,1,0)"><span class="custom-control-indicator"></span><span
                                    class="custom-control-description"
                                    style="font-size: 17px">  Thạch Thất</span></label></div>
                    <div class="col-sm-3"><label class="custom-control fs-13 mr-5"> <input value="277"
                                                                                           name="DistrictSpices"
                                                                                           type="checkbox"
                                                                                           class="custom-control-input"
                            "="" onclick="SelectDistrict(277,1,0)"><span class="custom-control-indicator"></span><span
                                    class="custom-control-description"
                                    style="font-size: 17px">  Chương Mỹ</span></label></div>
                    <div class="col-sm-3"><label class="custom-control fs-13 mr-5"> <input value="278"
                                                                                           name="DistrictSpices"
                                                                                           type="checkbox"
                                                                                           class="custom-control-input"
                            "="" onclick="SelectDistrict(278,1,0)"><span class="custom-control-indicator"></span><span
                                    class="custom-control-description"
                                    style="font-size: 17px">  Thanh Oai</span></label></div>
                    <div class="col-sm-3"><label class="custom-control fs-13 mr-5"> <input value="279"
                                                                                           name="DistrictSpices"
                                                                                           type="checkbox"
                                                                                           class="custom-control-input"
                            "="" onclick="SelectDistrict(279,1,0)"><span class="custom-control-indicator"></span><span
                                    class="custom-control-description"
                                    style="font-size: 17px">  Thường Tín</span></label></div>
                    <div class="col-sm-3"><label class="custom-control fs-13 mr-5"> <input value="280"
                                                                                           name="DistrictSpices"
                                                                                           type="checkbox"
                                                                                           class="custom-control-input"
                            "="" onclick="SelectDistrict(280,1,0)"><span class="custom-control-indicator"></span><span
                                    class="custom-control-description"
                                    style="font-size: 17px">  Phú Xuyên</span></label></div>
                    <div class="col-sm-3"><label class="custom-control fs-13 mr-5"> <input value="281"
                                                                                           name="DistrictSpices"
                                                                                           type="checkbox"
                                                                                           class="custom-control-input"
                            "="" onclick="SelectDistrict(281,1,0)"><span class="custom-control-indicator"></span><span
                                    class="custom-control-description" style="font-size: 17px">  Ứng Hòa</span></label>
                    </div>
                    <div class="col-sm-3"><label class="custom-control fs-13 mr-5"> <input value="282"
                                                                                           name="DistrictSpices"
                                                                                           type="checkbox"
                                                                                           class="custom-control-input"
                            "="" onclick="SelectDistrict(282,1,0)"><span class="custom-control-indicator"></span><span
                                    class="custom-control-description" style="font-size: 17px">  Mỹ Đức</span></label>
                    </div>
                    <div class="col-sm-3"><label class="custom-control fs-13 mr-5"> <input value="268"
                                                                                           name="DistrictSpices"
                                                                                           type="checkbox"
                                                                                           class="custom-control-input"
                            "="" onclick="SelectDistrict(268,1,0)"><span class="custom-control-indicator"></span><span
                                    class="custom-control-description" style="font-size: 17px">  Hà Đông</span></label>
                    </div>
                    <div class="col-sm-3"><label class="custom-control fs-13 mr-5"> <input value="19"
                                                                                           name="DistrictSpices"
                                                                                           type="checkbox"
                                                                                           class="custom-control-input"
                            "="" onclick="SelectDistrict(19,1,0)"><span class="custom-control-indicator"></span><span
                                    class="custom-control-description"
                                    style="font-size: 17px">  Bắc Từ Liêm</span></label></div>
                    <div class="col-sm-3"><label class="custom-control fs-13 mr-5"> <input value="1"
                                                                                           name="DistrictSpices"
                                                                                           type="checkbox"
                                                                                           class="custom-control-input"
                            "="" onclick="SelectDistrict(1,1,0)"><span class="custom-control-indicator"></span><span
                                    class="custom-control-description" style="font-size: 17px">  Ba Đình</span></label>
                    </div>
                    <div class="col-sm-3"><label class="custom-control fs-13 mr-5"> <input value="2"
                                                                                           name="DistrictSpices"
                                                                                           type="checkbox"
                                                                                           class="custom-control-input"
                            "="" onclick="SelectDistrict(2,1,0)"><span class="custom-control-indicator"></span><span
                                    class="custom-control-description"
                                    style="font-size: 17px">  Hoàn Kiếm</span></label></div>
                    <div class="col-sm-3"><label class="custom-control fs-13 mr-5"> <input value="3"
                                                                                           name="DistrictSpices"
                                                                                           type="checkbox"
                                                                                           class="custom-control-input"
                            "="" onclick="SelectDistrict(3,1,0)"><span class="custom-control-indicator"></span><span
                                    class="custom-control-description" style="font-size: 17px">  Tây Hồ</span></label>
                    </div>
                    <div class="col-sm-3"><label class="custom-control fs-13 mr-5"> <input value="4"
                                                                                           name="DistrictSpices"
                                                                                           type="checkbox"
                                                                                           class="custom-control-input"
                            "="" onclick="SelectDistrict(4,1,0)"><span class="custom-control-indicator"></span><span
                                    class="custom-control-description"
                                    style="font-size: 17px">  Long Biên</span></label></div>
                    <div class="col-sm-3"><label class="custom-control fs-13 mr-5"> <input value="5"
                                                                                           name="DistrictSpices"
                                                                                           type="checkbox"
                                                                                           class="custom-control-input"
                            "="" onclick="SelectDistrict(5,1,0)"><span class="custom-control-indicator"></span><span
                                    class="custom-control-description" style="font-size: 17px">  Cầu Giấy</span></label>
                    </div>
                    <div class="col-sm-3"><label class="custom-control fs-13 mr-5"> <input value="6"
                                                                                           name="DistrictSpices"
                                                                                           type="checkbox"
                                                                                           class="custom-control-input"
                            "="" onclick="SelectDistrict(6,1,0)"><span class="custom-control-indicator"></span><span
                                    class="custom-control-description" style="font-size: 17px">  Đống Đa</span></label>
                    </div>
                    <div class="col-sm-3"><label class="custom-control fs-13 mr-5"> <input value="7"
                                                                                           name="DistrictSpices"
                                                                                           type="checkbox"
                                                                                           class="custom-control-input"
                            "="" onclick="SelectDistrict(7,1,0)"><span class="custom-control-indicator"></span><span
                                    class="custom-control-description"
                                    style="font-size: 17px">  Hai Bà Trưng</span></label></div>
                    <div class="col-sm-3"><label class="custom-control fs-13 mr-5"> <input value="8"
                                                                                           name="DistrictSpices"
                                                                                           type="checkbox"
                                                                                           class="custom-control-input"
                            "="" onclick="SelectDistrict(8,1,0)"><span class="custom-control-indicator"></span><span
                                    class="custom-control-description"
                                    style="font-size: 17px">  Hoàng Mai</span></label></div>
                    <div class="col-sm-3"><label class="custom-control fs-13 mr-5"> <input value="9"
                                                                                           name="DistrictSpices"
                                                                                           type="checkbox"
                                                                                           class="custom-control-input"
                            "="" onclick="SelectDistrict(9,1,0)"><span class="custom-control-indicator"></span><span
                                    class="custom-control-description"
                                    style="font-size: 17px">  Thanh Xuân</span></label></div>
                    <div class="col-sm-3"><label class="custom-control fs-13 mr-5"> <input value="10"
                                                                                           name="DistrictSpices"
                                                                                           type="checkbox"
                                                                                           class="custom-control-input"
                            "="" onclick="SelectDistrict(10,1,0)"><span class="custom-control-indicator"></span><span
                                    class="custom-control-description"
                                    style="font-size: 17px">  Nam Từ Liêm</span></label></div>
                    <div class="col-sm-3"><label class="custom-control fs-13 mr-5"> <input value="269"
                                                                                           name="DistrictSpices"
                                                                                           type="checkbox"
                                                                                           class="custom-control-input"
                            "="" onclick="SelectDistrict(269,1,0)"><span class="custom-control-indicator"></span><span
                                    class="custom-control-description" style="font-size: 17px">  Sơn Tây</span></label>
                    </div>
                </div>
                <div class="form-group">
                    <div class="text-center">
                        <button type="button" class="btn btn-primary" onclick="UpdateDistrictSpices()">CẬP NHẬT TỈNH
                            THÀNH
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop