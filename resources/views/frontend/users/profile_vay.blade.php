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
                <input type="hidden" id="hddImgDomain" value="">
                <input type="hidden" id="UserID" value="643463">
                <div class="profilecard__body media-body align-self-center">
                    <p class="fs-13 text-gray-light mb-0">
                        <span>Thông tin tài khoản</span>
                        <span style="position: absolute; right: 68px;margin-top:-7px" class="hidden-xs-down">
                            <a class="btn btn-primary text-uppercase text-white fs-15 fs-lg-15 btn-sm"
                               href="{{action('Frontends\TransactionHistory\TransactionHistoryController@index')}}">
                                Lịch sử đơn vay
                            </a>
                        </span>
                    </p>

                    <hr class="mt-2 border-gray">
                    <div class="row  mb-4">
                        <div class="col-md-6">
                            <div class="row">
                                <label class="col-sm-4 fs-13">Tên đăng nhập :</label>
                                <label class="col-sm-4 fs-13"><b><b>{{$data['phone']}}</b></b></label>
                            </div>
                            <div class="row">
                                <label class="col-sm-4 fs-13">Loại tài khoản<span
                                            style="margin-left: 8px">:</span></label>
                                <label class="col-sm-4 fs-13"><b>Người vay</b></label>
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-xl-6">
                            <div class="profilecard__progress">
                                <p class="mb-0 text-gray-light fs-13">
                                    Bạn vui lòng cập nhật đầy đủ thông tin để đơn vay của bạn được duyệt nhanh hơn.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{ Form::open(['route' => ['frontend.user.update-user-info-lender', $data->id], 'method' => 'POST']) }}
            <input type="hidden" id="hddUserID" name="id" value="{{$data['id']}}">
            <input type="hidden" id="hddCityID" value="{{$data['city_id']}}">
            <input type="hidden" id="hddCityName" value="Hải Dương">
            <div class="accinfo-2">
                <div class="row mb-3">
                    <input type="hidden" id="hddLenderId" value="643463">
                    <div class="row col-xl-12">
                        <div class="col-xl-6">
                            <div class="form-group row">
                                <label for="txtFullName" class="col-sm-4 col-form-label text-sm-right">
                                    Họ &amp;Tên</label>
                                <div class="col-xl-8 col-sm-7">
                                    <input type="text" class="form-control" id="txtFullName" placeholder=""
                                           name="fullname" value="{{$data['fullname']}}">
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-6">
                            <div class="form-group row">
                                <label for="txtPhone" class="col-sm-4 col-form-label text-sm-right">
                                    Điện thoại
                                </label>
                                <div class="col-xl-8 col-sm-7">
                                    <input type="tel" class="form-control" id="txtPhone" placeholder=""
                                           name="phone" readonly value="{{$data['phone']}}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row col-xl-12">
                        <div class="col-xl-6">
                            <div class="form-group row">
                                <label for="txtCardNumber"
                                       class="col-sm-4 col-form-label text-sm-right">CMND</label>
                                <div class="col-xl-8 col-sm-7">
                                    <input type="text" class="form-control" id="txtCardNumber" placeholder=""
                                           name="card_number" value="{{$data['card_number']}}">
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-6">
                            <div class="form-group row">
                                <label for="txtBirthDay" class="col-sm-4 col-form-label text-sm-right">
                                    Ngày sinh
                                </label>
                                <div class="col-xl-8 col-sm-7">
                                    <input type="text" class="form-control datepicker" data-date-format="dd-mm-yyyy"
                                           id="txtBirthDay" placeholder="" name="birthday"
                                           value="{{$data['birthday']}}">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row col-xl-12">
                        <div class="col-xl-6">
                            <div class="form-group row">
                                <label for="slSex" class="col-sm-4 col-form-label text-sm-right">
                                    Giới tính
                                </label>
                                <div class="col-xl-8 col-sm-7">
                                    <select class="form-control" id="slSex" name="sex">
                                        <option value="0" {{($data['sex']==0) ? 'selected':''}}>Nam</option>
                                        <option value="1" {{($data['sex']==1) ? 'selected':''}} >Nữ</option>
                                        <option value="2" {{($data['sex']==2) ? 'selected':''}} >Khác</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-6">
                            <div class="form-group row">
                                <label for="txtEmail" class="col-sm-4 col-form-label text-sm-right">Email</label>
                                <div class="col-xl-8 col-sm-7">
                                    <input type="text" class="form-control" id="txtEmail" placeholder="" name="email"
                                           value="{{ $data['email'] }}"
                                    >
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row col-xl-12">
                        <div class="col-xl-6">
                            <div class="form-group row">
                                <label for="cbCity" class="col-sm-4 col-form-label text-sm-right">Thành phố</label>
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

                        <div class="col-xl-6">
                            <div class="form-group row">
                                <label for="cbDistrict"
                                       class="col-sm-4 col-form-label text-sm-right">Quận/Huyện</label>
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

                    </div>

                    <div class="row col-xl-12">
                        <div class="col-xl-6">
                            <div class="form-group row">
                                <label for="cbWard" class="col-sm-4 col-form-label text-sm-right">Phường/Xã</label>
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

                        <div class="col-xl-6">
                            <div class="form-group row">
                                <label for="txtAddress" class="col-sm-4 col-form-label text-sm-right">
                                    Địa chỉ nơi ở
                                </label>
                                <div class="col-xl-8 col-sm-7">
                                    <input type="text" class="form-control" id="txtAddress" placeholder=""
                                           name="address" value="{{$data['address']}}">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row col-xl-12">
                        <div class="col-xl-6">
                            <div class="form-group row">
                                <label for="slJob" class="col-sm-4 col-form-label text-sm-right">Nghề nghiệp</label>
                                <div class="col-xl-8 col-sm-7">
                                    <select class="form-control" id="slJob" name="job">
                                        @foreach ($listJob as $key_j=>$val_j)
                                            <option {{($data['job'] == $key_j)? 'selected':'' }}
                                                    value="{{ $key_j }}">
                                                {{ $val_j }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-6">
                            <div class="form-group row">
                                <label for="txtCompanyName" class="col-sm-4 col-form-label text-sm-right">Công
                                    ty</label>
                                <div class="col-xl-8 col-sm-7">
                                    <input type="text" class="form-control" id="txtCompanyName" placeholder=""
                                           name="company_name"
                                           value="{{$data['company_name']}}">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row col-xl-12">
                        <div class="col-xl-6">
                            <div class="form-group row">
                                <label for="txtCompanyAddress" class="col-sm-4 col-form-label text-sm-right">Địa chỉ
                                    công ty</label>
                                <div class="col-xl-8 col-sm-7">
                                    <input type="text" class="form-control" id="txtCompanyAddress" placeholder=""
                                           name="company_address"
                                           value="{{$data['company_address']}}">
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-6">
                            <div class="form-group row">
                                <label for="txtCompanyPhone" class="col-sm-4 col-form-label text-sm-right">
                                    ĐT công ty
                                </label>
                                <div class="col-xl-8 col-sm-7">
                                    <input type="text" class="form-control" id="txtCompanyPhone" placeholder=""
                                           name="company_phone"
                                           value="{{$data['company_phone']}}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-center">
                    <input type="submit" id="btnUpdateInfoLoaner" data-id="643463" data-cmd="enable-form"
                           class="btn btn-primary mx-auto text-uppercase" value="Cập nhật">
                </div>
            </div>
            {{Form::close()}}
        </div>
    </div>
    <div class="container pb-5">

        <div class="tm-account bg-white p-md-5 pt-md-4 p-3">


            <input type="hidden" id="hddTypeImg" value="0">
            <input type="file" name="uploadImg" id="uploadImg" multiple="" style="display: none;" accept="image/*">

            <div class="uploadct bg-white p-md-5 pt-md-4 p-3">
                <h2 class="text-uppercase fs-16 fw-6 mb-0">
                    Upload chứng từ
                </h2>

                <hr class="border-gray mt-md-4 mt-3 mb-0">

                <div class="uploadct-item">
                    <div class="uploadct-item__header" onclick="UploadImg(1)">
                        <div class="upload btn-file mb-2">
                            <div class="upload__icon">
                    <span class="icon-id-card">
                        <span class="upload__icon-plus"></span>
                    </span>
                            </div>
                            <div class="upload__text">
                                Nhân thân
                            </div>

                        </div>

                        <em class="text-gray-light fs-13">
                            CMND, Hộ chiếu, Thẻ căn cước
                        </em>
                    </div>

                    <div class="uploadct-item__body" id="divImgCardNumber">
                        @if($data['personal_records'])
                            <div class="uploadct-item__img mr-5">
                                <img class="img-fluid" src="{{$data['personal_records']}}" alt="">
                            </div>
                        @endif
                    </div>
                </div>

                <div class="uploadct-item">
                    <div class="uploadct-item__header" onclick="UploadImg(2)">
                        <div class="upload btn-file mb-2">
                            <div class="upload__icon">
                    <span class="icon-house">
                        <span class="upload__icon-plus"></span>
                    </span>
                            </div>
                            <div class="upload__text">
                                Cư trú
                            </div>

                        </div>

                        <em class="text-gray-light fs-13">
                            Sổ hộ khẩu, KT3, Tạm trú tạm vắng
                        </em>
                    </div>

                    <div class="uploadct-item__body" id="divImgLocation">
                        @if($data['personal_records'])
                            <div class="uploadct-item__img mr-5">
                                <img class="img-fluid" src="{{$data['profile_residence']}}" alt="">
                            </div>
                        @endif
                    </div>
                </div>

                <div class="uploadct-item">
                    <div class="uploadct-item__header" onclick="UploadImg(3)">
                        <div class="upload btn-file mb-2">
                            <div class="upload__icon">
                    <span class="icon-wallet-gray">
                        <span class="upload__icon-plus"></span>
                    </span>
                            </div>
                            <div class="upload__text">
                                Thu nhập
                            </div>

                        </div>

                        <em class="text-gray-light fs-13">
                            Sao kê bảng lương. HĐLĐ, BHXH ...
                        </em>
                    </div>

                    <div class="uploadct-item__body" id="divImgContractAndSalary">
                        @if($data['income_records'])
                            <div class="uploadct-item__img mr-5">
                                <img class="img-fluid" src="{{$data['income_records']}}" alt="">
                            </div>
                        @endif
                    </div>
                </div>
            </div>


        </div>
    </div>
@stop