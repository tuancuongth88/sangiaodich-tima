@extends('frontend.app')
@section('title','Thông tin tài khoản')

@section('content')
    <div class="container py-5">
        <div class="tm-account bg-white p-md-5 pt-md-4 p-3">
            <div class="profilecard media bg-gray-lighter p-sm-4 p-3" style="margin-bottom: 50px;">
                <img class="profilecard__img wf-80 wf-md-126 mr-md-5 mr-3" style="cursor: pointer;" src="files/images/avatar-default-2.svg" alt="avatar-san-tai-chinh-Thanh Lam" id="imgAvatar" onclick="CallUploadFile()" title="Đổi ảnh đại diện khác">
                <input type="file" name="uploadAvatar" id="uploadAvatar" multiple="" style="display: none;" accept="image/*">
                <input type="hidden" id="hddImgDomain" value="http://rs.tima.vn/staticFile">
                <input type="hidden" id="UserID" value="11424">
                <div class="profilecard__body media-body align-self-center">
                    <p class="fs-13 text-gray-light mb-0">
                        <span>Thông tin tài khoản</span>
                        <span style="position: absolute; right: 68px;margin-top:-7px" class="hidden-xs-down">
                        <a class="btn btn-primary text-uppercase text-white fs-15 fs-lg-15 btn-sm" href="/Lender/ListLoan/">
                            Quản lý đơn vay
                        </a>
                            <a href='/nap-tien.html' class="btn btn-primary text-uppercase text-white fs-15 fs-lg-15 btn-sm">
                                <i class="fa fa-usd" aria-hidden="true"></i> Nạp tiền
                            </a>
                    </span>
                    </p>

                    <hr class="mt-2 border-gray">
                    <div class="row  mb-4">
                        <div class="col-md-6">
                            <div class="row">
                                <label class="col-sm-4 fs-13">Tên đăng nhập :</label>
                                <label class="col-sm-4 fs-13"><b>0978985525</b></label>
                            </div>
                            <div class="row">
                                <label class="col-sm-4 fs-13">Loại tài khoản<span style="margin-left: 8px">:</span></label>
                                <label class="col-sm-4 fs-13"><b>Nh&#224; đầu tư</b></label>
                            </div>

                            <div  class="row">
                                <label class="col-sm-4 fs-13">Số dư<span style="margin-left: 8px">:</span></label>
                                <label class="col-sm-4 fs-13"><b><a href='/lich-su-giao-dich.html' class="btn btn-primary text-uppercase text-white fs-15 fs-lg-15 btn-sm">20,000</a></b> </label>

                            </div>


                        </div>
                    </div>
                    <div class="row">

                        <div class="col-xl-6">
                            <div class="profilecard__progress">
                                <p class="mb-0 text-gray-light fs-13">Mức độ hoàn thành hồ sơ</p>
                                <div class="progress mb-2">
                                    <div class="progress-bar" role="progressbar" style="width: 71%;" aria-valuenow="71" aria-valuemin="0" aria-valuemax="100">
                                        <span class="progress-tooltip">71%</span>
                                    </div>
                                </div>
                                <p class="mb-0 text-gray-light fs-13">Bạn vui l&#242;ng cập nhật đầy đủ hồ sơ để kh&#225;ch h&#224;ng c&#243; thể kết nối được với bạn.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="accinfo-2">
                <div class="row mb-3">

                    <input type="hidden" id="hddLenderId" value="11424" />

                    <div class="row col-xl-12">
                        <div class="col-xl-6">
                            <div class="form-group row">
                                <label for="slTypeLenderRegister" class="col-sm-4 col-form-label text-sm-right">Bạn là:</label>
                                <div class="col-xl-8 col-sm-7">
                                    <select class="form-control" id="slTypeLenderRegister" disabled="disabled">
                                        <option value="0" ></option>
                                        <option value="1" selected>Tín dụng cá nhân</option>
                                        <option value="2" >Nhân Viên Ngân Hàng</option>

                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="row col-xl-12">
                        <div class="col-xl-6">
                            <div class="form-group row">
                                <label for="txtFullName" class="col-sm-4 col-form-label text-sm-right">Họ & Tên:</label>
                                <div class="col-xl-8 col-sm-7">
                                    <input type="text" class="form-control" id="txtFullName" placeholder="" disabled="disabled" value="Đỗ C&#244;ng Tuyến">
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-6">
                            <div class="form-group row">
                                <label for="txtPhone" class="col-sm-4 col-form-label text-sm-right">Điện thoại:</label>
                                <div class="col-xl-8 col-sm-7">
                                    <input type="tel" class="form-control" id="txtPhone" placeholder="" disabled="disabled" value="0978985525">
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="row col-xl-12">
                        <div class="col-xl-6">
                            <div class="form-group row">
                                <label for="slGender" class="col-sm-4 col-form-label text-sm-right">Giới tính:</label>
                                <div class="col-xl-8 col-sm-7">
                                    <select class="form-control" id="slGender" disabled="disabled">
                                        <option value="0" selected>Nam</option>
                                        <option value="1" >Nữ</option>
                                        <option value="2" >Khác</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-6">
                            <div class="form-group row">
                                <label for="cbCity" class="col-sm-4 col-form-label text-sm-right">Thành phố:</label>
                                <div class="col-xl-8 col-sm-7">
                                    <select class="form-control" id="cbCity" disabled="disabled">
                                    </select>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="row col-xl-12">

                        <div class="col-xl-6">
                            <div class="form-group row">
                                <label for="cbDistrict" class="col-sm-4 col-form-label text-sm-right">Quận/Huyện:</label>
                                <div class="col-xl-8 col-sm-7">
                                    <select class="form-control" id="cbDistrict" disabled="disabled">
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-6">
                            <div class="form-group row">
                                <label for="cbWard" class="col-sm-4 col-form-label text-sm-right">Phường/Xã:</label>
                                <div class="col-xl-8 col-sm-7">
                                    <select class="form-control" id="cbWard" disabled="disabled">
                                        <option value=""></option>
                                        <option value="157" > Nghĩa Đ&#244; </option>
                                        <option value="160" > Nghĩa T&#226;n </option>
                                        <option value="163" > Mai Dịch </option>
                                        <option value="166" > Dịch Vọng </option>
                                        <option value="167" > Dịch Vọng Hậu </option>
                                        <option value="169" > Quan Hoa </option>
                                        <option value="172" > Y&#234;n Ho&#224; </option>
                                        <option value="175" > Trung Ho&#224; </option>
                                    </select>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="row col-xl-12">
                        <div class="col-xl-12">
                            <div class="form-group row">
                                <label for="txtAddress" class="col-xl-2 col-sm-4 col-form-label text-sm-right">Địa chỉ:</label>
                                <div class="col-xl-10 col-sm-7">
                                    <input type="text" class="form-control" id="txtAddress" placeholder="" disabled="disabled">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="text-center">
                    <input type="button" id="btnUpdateInfoLender" data-id="11424" data-cmd="enable-form" class="btn btn-primary mx-auto text-uppercase" value="Thay đổi thông tin">
                </div>
            </div>
        </div>
    </div>
@stop