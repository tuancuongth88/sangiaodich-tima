@extends('frontend.app')
@section('title','Đăng ký')

@section('content')
    <div class="container py-5">
        @include('frontend.alert.messages')
        <div class="tm-reg">
            <div class="row gutter-10px flex-column-reverse flex-md-row">
                <div class="col-main col-md-6 d-flex">
                    <div class="tm-reg__banner w-100" style="background-image:url('{{ asset('/frontend/images/bg-login.jpg')  }}');"></div>
                </div>
                <div class="col-aside col-md-6 d-flex mb-5 mb-md-0">
                    <div class="tm-regform d-flex flex-column justify-content-between w-100 border border-gray bg-white">
                        <div class="fs-13" id="divFormRegister">
                            {{ Form::open(['action' => 'Frontends\Users\UsersController@postRegisterForm', 'method' => 'POST', 'autocomplete' => "off"]) }}
                                @csrf
                                {{-- @method('post') --}}

                                <div class="tm-regform__header d-flex justify-content-between align-items-center p-3">
                                    <h2 class="text-uppercase fs-16 fw-4 mb-0">
                                        Đăng ký tài khoản
                                    </h2>
                                    <a class="text-primary fs-13" href="/User/Login">
                                        <ins>Đăng nhập</ins>
                                    </a>
                                </div>
                                <hr class="border-gray my-0">

                                <div class="px-5 py-3">
                                    <p class="text-center">
                                        Hãy đăng ký ngay bây giờ <br>
                                        để tham gia sàn tài chính Tima.
                                        <span id="sp-message-login"></span>
                                    </p>

                                    <div class="form-group">
                                        {{ Form::text('fullname', null, ['class' => 'form-control form-control-lg fs-13 px-3 rounded', 'placeholder' => 'Họ và tên', 'required', 'autocomplete' => "off"]) }}
                                        <span class="error">{{ $errors->first('fullname') }}</span>
                                    </div>

                                    <div class="form-group">
                                        {{ Form::text('phone', null, ['class' => 'form-control form-control-lg fs-13 px-3 rounded', 'placeholder' => 'Số điện thoại', 'required', 'autocomplete' => "off"]) }}
                                        <span class="error">{{ $errors->first('phone') }}</span>
                                    </div>

                                    <div class="form-group">
                                        {{ Form::password('password', ['class' => 'form-control form-control-lg fs-13 px-3 rounded', 'placeholder' => 'Mật khẩu', 'autocomplete' => "off"]) }}
                                        <span class="error">{{ $errors->first('password') }}</span>
                                    </div>
                                    <div class="form-group">
                                        <select class="selectpicker show-tick form-control input-lg" id="cbCity" name="city" data-live-search="true" title="Chọn thành phố" required>
                                            <option value=""></option>
                                            <option value="1">Hà Nội</option>
                                            <option value="2">Hà Giang</option>
                                            <option value="4">Cao Bằng</option>
                                            <option value="6">Bắc Kạn</option>
                                            <option value="8">Tuyên Quang</option>
                                            <option value="10">Lào Cai</option>
                                            <option value="11">Điện Biên</option>
                                            <option value="12">Lai Châu</option>
                                            <option value="14">Sơn La</option>
                                            <option value="15">Yên Bái</option>
                                            <option value="17">Hòa Bình</option>
                                            <option value="19">Thái Nguyên</option>
                                            <option value="20">Lạng Sơn</option>
                                            <option value="22">Quảng Ninh</option>
                                            <option value="24">Bắc Giang</option>
                                            <option value="25">Phú Thọ</option>
                                            <option value="26">Vĩnh Phúc</option>
                                            <option value="27">Bắc Ninh</option>
                                            <option value="30">Hải Dương</option>
                                            <option value="31">Hải Phòng</option>
                                            <option value="33">Hưng Yên</option>
                                            <option value="34">Thái Bình</option>
                                            <option value="35">Hà Nam</option>
                                            <option value="36">Nam Định</option>
                                            <option value="37">Ninh Bình</option>
                                            <option value="38">Thanh Hóa</option>
                                            <option value="40">Nghệ An</option>
                                            <option value="42">Hà Tĩnh</option>
                                            <option value="44">Quảng Bình</option>
                                            <option value="45">Quảng Trị</option>
                                            <option value="46">Thừa Thiên Huế</option>
                                            <option value="48">Đà Nẵng</option>
                                            <option value="49">Quảng Nam</option>
                                            <option value="51">Quảng Ngãi</option>
                                            <option value="52">Bình Định</option>
                                            <option value="54">Phú Yên</option>
                                            <option value="56">Khánh Hòa</option>
                                            <option value="58">Ninh Thuận</option>
                                            <option value="60">Bình Thuận</option>
                                            <option value="62">Kon Tum</option>
                                            <option value="64">Gia Lai</option>
                                            <option value="66">Đắk Lắk</option>
                                            <option value="67">Đắk Nông</option>
                                            <option value="68">Lâm Đồng</option>
                                            <option value="70">Bình Phước</option>
                                            <option value="72">Tây Ninh</option>
                                            <option value="74">Bình Dương</option>
                                            <option value="75">Đồng Nai</option>
                                            <option value="77">Bà Rịa - Vũng Tàu</option>
                                            <option value="79">Hồ Chí Minh</option>
                                            <option value="80">Long An</option>
                                            <option value="82">Tiền Giang</option>
                                            <option value="83">Bến Tre</option>
                                            <option value="84">Trà Vinh</option>
                                            <option value="86">Vĩnh Long</option>
                                            <option value="87">Đồng Tháp</option>
                                            <option value="89">An Giang</option>
                                            <option value="91">Kiên Giang</option>
                                            <option value="92">Cần Thơ</option>
                                            <option value="93">Hậu Giang</option>
                                            <option value="94">Sóc Trăng</option>
                                            <option value="95">Bạc Liêu</option>
                                            <option value="96">Cà Mau</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <select class="sr-only" id="cbDistrict-hidden">
                                            <option value=""></option>
                                            <option value="1" data-cityid="1">Ba Đình</option>
                                            <option value="2" data-cityid="1">Hoàn Kiếm</option>
                                            <option value="3" data-cityid="1">Tây Hồ</option>
                                            <option value="4" data-cityid="1">Long Biên</option>
                                            <option value="5" data-cityid="1">Cầu Giấy</option>
                                            <option value="6" data-cityid="1">Đống Đa</option>
                                            <option value="7" data-cityid="1">Hai Bà Trưng</option>
                                            <option value="8" data-cityid="1">Hoàng Mai</option>
                                            <option value="9" data-cityid="1">Thanh Xuân</option>
                                            <option value="10" data-cityid="1">Nam Từ Liêm</option>
                                            <option value="11" data-cityid="22">Quảng Yên</option>
                                            <option value="16" data-cityid="1">Sóc Sơn</option>
                                            <option value="17" data-cityid="1">Đông Anh</option>
                                            <option value="18" data-cityid="1">Gia Lâm</option>
                                            <option value="19" data-cityid="1">Bắc Từ Liêm</option>
                                            <option value="20" data-cityid="1">Thanh Trì</option>
                                            <option value="24" data-cityid="2">Hà Giang</option>
                                            <option value="26" data-cityid="2">Đồng Văn</option>
                                            <option value="27" data-cityid="2">Mèo Vạc</option>
                                            <option value="28" data-cityid="2">Yên Minh</option>
                                            <option value="29" data-cityid="2">Quản Bạ</option>
                                            <option value="30" data-cityid="2">Vị Xuyên</option>
                                            <option value="31" data-cityid="2">Bắc Mê</option>
                                            <option value="32" data-cityid="2">Hoàng Su Phì</option>
                                            <option value="33" data-cityid="2">Xín Mần</option>
                                            <option value="34" data-cityid="2">Bắc Quang</option>
                                            <option value="35" data-cityid="2">Quang Bình</option>
                                            <option value="40" data-cityid="4">Cao Bằng</option>
                                            <option value="42" data-cityid="4">Bảo Lâm</option>
                                            <option value="43" data-cityid="4">Bảo Lạc</option>
                                            <option value="44" data-cityid="4">Thông Nông</option>
                                            <option value="45" data-cityid="4">Hà Quảng</option>
                                            <option value="46" data-cityid="4">Trà Lĩnh</option>
                                            <option value="47" data-cityid="4">Trùng Khánh</option>
                                            <option value="48" data-cityid="4">Hạ Lang</option>
                                            <option value="49" data-cityid="4">Quảng Uyên</option>
                                            <option value="50" data-cityid="4">Phục Hoà</option>
                                            <option value="51" data-cityid="4">Hoà An</option>
                                            <option value="52" data-cityid="4">Nguyên Bình</option>
                                            <option value="53" data-cityid="4">Thạch An</option>
                                            <option value="58" data-cityid="6">Bắc Kạn</option>
                                            <option value="60" data-cityid="6">Pác Nặm</option>
                                            <option value="61" data-cityid="6">Ba Bể</option>
                                            <option value="62" data-cityid="6">Ngân Sơn</option>
                                            <option value="63" data-cityid="6">Bạch Thông</option>
                                            <option value="64" data-cityid="6">Chợ Đồn</option>
                                            <option value="65" data-cityid="6">Chợ Mới</option>
                                            <option value="66" data-cityid="6">Na Rì</option>
                                            <option value="70" data-cityid="8">Tuyên Quang</option>
                                            <option value="72" data-cityid="8">Nà Hang</option>
                                            <option value="73" data-cityid="8">Chiêm Hóa</option>
                                            <option value="74" data-cityid="8">Hàm Yên</option>
                                            <option value="75" data-cityid="8">Yên Sơn</option>
                                            <option value="76" data-cityid="8">Sơn Dương</option>
                                            <option value="80" data-cityid="10">Lào Cai</option>
                                            <option value="82" data-cityid="10">Bát Xát</option>
                                            <option value="83" data-cityid="10">Mường Khương</option>
                                            <option value="84" data-cityid="10">Si Ma Cai</option>
                                            <option value="85" data-cityid="10">Bắc Hà</option>
                                            <option value="86" data-cityid="10">Bảo Thắng</option>
                                            <option value="87" data-cityid="10">Bảo Yên</option>
                                            <option value="88" data-cityid="10">Sa Pa</option>
                                            <option value="89" data-cityid="10">Văn Bàn</option>
                                            <option value="94" data-cityid="11">Điện Biên Phủ</option>
                                            <option value="95" data-cityid="11">Mường Lay</option>
                                            <option value="96" data-cityid="11">Mường Nhé</option>
                                            <option value="97" data-cityid="11">Mường Chà</option>
                                            <option value="98" data-cityid="11">Tủa Chùa</option>
                                            <option value="99" data-cityid="11">Tuần Giáo</option>
                                            <option value="100" data-cityid="11">Điện Biên</option>
                                            <option value="101" data-cityid="11">Điện Biên Đông</option>
                                            <option value="102" data-cityid="11">Mường Ảng</option>
                                            <option value="104" data-cityid="12">Lai Châu</option>
                                            <option value="106" data-cityid="12">Tam Đường</option>
                                            <option value="107" data-cityid="12">Mường Tè</option>
                                            <option value="108" data-cityid="12">Sìn Hồ</option>
                                            <option value="109" data-cityid="12">Phong Thổ</option>
                                            <option value="110" data-cityid="12">Than Uyên</option>
                                            <option value="111" data-cityid="12">Tân Uyên</option>
                                            <option value="116" data-cityid="14">Sơn La</option>
                                            <option value="118" data-cityid="14">Quỳnh Nhai</option>
                                            <option value="119" data-cityid="14">Thuận Châu</option>
                                            <option value="120" data-cityid="14">Mường La</option>
                                            <option value="121" data-cityid="14">Bắc Yên</option>
                                            <option value="122" data-cityid="14">Phù Yên</option>
                                            <option value="123" data-cityid="14">Mộc Châu</option>
                                            <option value="124" data-cityid="14">Yên Châu</option>
                                            <option value="125" data-cityid="14">Mai Sơn</option>
                                            <option value="126" data-cityid="14">Sông Mã</option>
                                            <option value="127" data-cityid="14">Sốp Cộp</option>
                                            <option value="132" data-cityid="15">Yên Bái</option>
                                            <option value="133" data-cityid="15">Nghĩa Lộ</option>
                                            <option value="135" data-cityid="15">Lục Yên</option>
                                            <option value="136" data-cityid="15">Văn Yên</option>
                                            <option value="137" data-cityid="15">Mù Cang Chải</option>
                                            <option value="138" data-cityid="15">Trấn Yên</option>
                                            <option value="139" data-cityid="15">Trạm Tấu</option>
                                            <option value="140" data-cityid="15">Văn Chấn</option>
                                            <option value="141" data-cityid="15">Yên Bình</option>
                                            <option value="148" data-cityid="17">Hòa Bình</option>
                                            <option value="150" data-cityid="17">Đà Bắc</option>
                                            <option value="151" data-cityid="17">Kỳ Sơn</option>
                                            <option value="152" data-cityid="17">Lương Sơn</option>
                                            <option value="153" data-cityid="17">Kim Bôi</option>
                                            <option value="154" data-cityid="17">Cao Phong</option>
                                            <option value="155" data-cityid="17">Tân Lạc</option>
                                            <option value="156" data-cityid="17">Mai Châu</option>
                                            <option value="157" data-cityid="17">Lạc Sơn</option>
                                            <option value="158" data-cityid="17">Yên Thủy</option>
                                            <option value="159" data-cityid="17">Lạc Thủy</option>
                                            <option value="164" data-cityid="19">Thái Nguyên</option>
                                            <option value="165" data-cityid="19">Sông Công</option>
                                            <option value="167" data-cityid="19">Định Hóa</option>
                                            <option value="168" data-cityid="19">Phú Lương</option>
                                            <option value="169" data-cityid="19">Đồng Hỷ</option>
                                            <option value="170" data-cityid="19">Võ Nhai</option>
                                            <option value="171" data-cityid="19">Đại Từ</option>
                                            <option value="172" data-cityid="19">Phổ Yên</option>
                                            <option value="173" data-cityid="19">Phú Bình</option>
                                            <option value="178" data-cityid="20">Lạng Sơn</option>
                                            <option value="180" data-cityid="20">Tràng Định</option>
                                            <option value="181" data-cityid="20">Bình Gia</option>
                                            <option value="182" data-cityid="20">Văn Lãng</option>
                                            <option value="183" data-cityid="20">Cao Lộc</option>
                                            <option value="184" data-cityid="20">Văn Quan</option>
                                            <option value="185" data-cityid="20">Bắc Sơn</option>
                                            <option value="186" data-cityid="20">Hữu Lũng</option>
                                            <option value="187" data-cityid="20">Chi Lăng</option>
                                            <option value="188" data-cityid="20">Lộc Bình</option>
                                            <option value="189" data-cityid="20">Đình Lập</option>
                                            <option value="193" data-cityid="22">Hạ Long</option>
                                            <option value="194" data-cityid="22">Móng Cái</option>
                                            <option value="195" data-cityid="22">Cẩm Phả</option>
                                            <option value="196" data-cityid="22">Uông Bí</option>
                                            <option value="198" data-cityid="22">Bình Liêu</option>
                                            <option value="199" data-cityid="22">Tiên Yên</option>
                                            <option value="200" data-cityid="22">Đầm Hà</option>
                                            <option value="201" data-cityid="22">Hải Hà</option>
                                            <option value="202" data-cityid="22">Ba Chẽ</option>
                                            <option value="203" data-cityid="22">Vân Đồn</option>
                                            <option value="204" data-cityid="22">Hoành Bồ</option>
                                            <option value="205" data-cityid="22">Đông Triều</option>
                                            <option value="206" data-cityid="22">Yên Hưng</option>
                                            <option value="207" data-cityid="22">Cô Tô</option>
                                            <option value="213" data-cityid="24">Bắc Giang</option>
                                            <option value="215" data-cityid="24">Yên Thế</option>
                                            <option value="216" data-cityid="24">Tân Yên</option>
                                            <option value="217" data-cityid="24">Lạng Giang</option>
                                            <option value="218" data-cityid="24">Lục Nam</option>
                                            <option value="219" data-cityid="24">Lục Ngạn</option>
                                            <option value="220" data-cityid="24">Sơn Động</option>
                                            <option value="221" data-cityid="24">Yên Dũng</option>
                                            <option value="222" data-cityid="24">Việt Yên</option>
                                            <option value="223" data-cityid="24">Hiệp Hòa</option>
                                            <option value="227" data-cityid="25">Việt Trì</option>
                                            <option value="228" data-cityid="25">Phú Thọ</option>
                                            <option value="230" data-cityid="25">Đoan Hùng</option>
                                            <option value="231" data-cityid="25">Hạ Hoà</option>
                                            <option value="232" data-cityid="25">Thanh Ba</option>
                                            <option value="233" data-cityid="25">Phù Ninh</option>
                                            <option value="234" data-cityid="25">Yên Lập</option>
                                            <option value="235" data-cityid="25">Cẩm Khê</option>
                                            <option value="236" data-cityid="25">Tam Nông</option>
                                            <option value="237" data-cityid="25">Lâm Thao</option>
                                            <option value="238" data-cityid="25">Thanh Sơn</option>
                                            <option value="239" data-cityid="25">Thanh Thuỷ</option>
                                            <option value="240" data-cityid="25">Tân Sơn</option>
                                            <option value="243" data-cityid="26">Vĩnh Yên</option>
                                            <option value="244" data-cityid="26">Phúc Yên</option>
                                            <option value="246" data-cityid="26">Lập Thạch</option>
                                            <option value="247" data-cityid="26">Tam Dương</option>
                                            <option value="248" data-cityid="26">Tam Đảo</option>
                                            <option value="249" data-cityid="26">Bình Xuyên</option>
                                            <option value="250" data-cityid="1">Mê Linh</option>
                                            <option value="251" data-cityid="26">Yên Lạc</option>
                                            <option value="252" data-cityid="26">Vĩnh Tường</option>
                                            <option value="253" data-cityid="26">Sông Lô</option>
                                            <option value="256" data-cityid="27">Bắc Ninh</option>
                                            <option value="258" data-cityid="27">Yên Phong</option>
                                            <option value="259" data-cityid="27">Quế Võ</option>
                                            <option value="260" data-cityid="27">Tiên Du</option>
                                            <option value="261" data-cityid="27">Từ Sơn</option>
                                            <option value="262" data-cityid="27">Thuận Thành</option>
                                            <option value="263" data-cityid="27">Gia Bình</option>
                                            <option value="264" data-cityid="27">Lương Tài</option>
                                            <option value="268" data-cityid="1">Hà Đông</option>
                                            <option value="269" data-cityid="1">Sơn Tây</option>
                                            <option value="271" data-cityid="1">Ba Vì</option>
                                            <option value="272" data-cityid="1">Phúc Thọ</option>
                                            <option value="273" data-cityid="1">Đan Phượng</option>
                                            <option value="274" data-cityid="1">Hoài Đức</option>
                                            <option value="275" data-cityid="1">Quốc Oai</option>
                                            <option value="276" data-cityid="1">Thạch Thất</option>
                                            <option value="277" data-cityid="1">Chương Mỹ</option>
                                            <option value="278" data-cityid="1">Thanh Oai</option>
                                            <option value="279" data-cityid="1">Thường Tín</option>
                                            <option value="280" data-cityid="1">Phú Xuyên</option>
                                            <option value="281" data-cityid="1">Ứng Hòa</option>
                                            <option value="282" data-cityid="1">Mỹ Đức</option>
                                            <option value="288" data-cityid="30">Hải Dương</option>
                                            <option value="290" data-cityid="30">Chí Linh</option>
                                            <option value="291" data-cityid="30">Nam Sách</option>
                                            <option value="292" data-cityid="30">Kinh Môn</option>
                                            <option value="293" data-cityid="30">Kim Thành</option>
                                            <option value="294" data-cityid="30">Thanh Hà</option>
                                            <option value="295" data-cityid="30">Cẩm Giàng</option>
                                            <option value="296" data-cityid="30">Bình Giang</option>
                                            <option value="297" data-cityid="30">Gia Lộc</option>
                                            <option value="298" data-cityid="30">Tứ Kỳ</option>
                                            <option value="299" data-cityid="30">Ninh Giang</option>
                                            <option value="300" data-cityid="30">Thanh Miện</option>
                                            <option value="303" data-cityid="31">Hồng Bàng</option>
                                            <option value="304" data-cityid="31">Ngô Quyền</option>
                                            <option value="305" data-cityid="31">Lê Chân</option>
                                            <option value="306" data-cityid="31">Hải An</option>
                                            <option value="307" data-cityid="31">Kiến An</option>
                                            <option value="308" data-cityid="31">Đồ Sơn</option>
                                            <option value="309" data-cityid="31">Dương Kinh</option>
                                            <option value="311" data-cityid="31">Thuỷ Nguyên</option>
                                            <option value="312" data-cityid="31">An Dương</option>
                                            <option value="313" data-cityid="31">An Lão</option>
                                            <option value="314" data-cityid="31">Kiến Thụy</option>
                                            <option value="315" data-cityid="31">Tiên Lãng</option>
                                            <option value="316" data-cityid="31">Vĩnh Bảo</option>
                                            <option value="317" data-cityid="31">Cát Hải</option>
                                            <option value="318" data-cityid="31">Bạch Long Vĩ</option>
                                            <option value="323" data-cityid="33">Hưng Yên</option>
                                            <option value="325" data-cityid="33">Văn Lâm</option>
                                            <option value="326" data-cityid="33">Văn Giang</option>
                                            <option value="327" data-cityid="33">Yên Mỹ</option>
                                            <option value="328" data-cityid="33">Mỹ Hào</option>
                                            <option value="329" data-cityid="33">Ân Thi</option>
                                            <option value="330" data-cityid="33">Khoái Châu</option>
                                            <option value="331" data-cityid="33">Kim Động</option>
                                            <option value="332" data-cityid="33">Tiên Lữ</option>
                                            <option value="333" data-cityid="33">Phù Cừ</option>
                                            <option value="336" data-cityid="34">Thái Bình</option>
                                            <option value="338" data-cityid="34">Quỳnh Phụ</option>
                                            <option value="339" data-cityid="34">Hưng Hà</option>
                                            <option value="340" data-cityid="34">Đông Hưng</option>
                                            <option value="341" data-cityid="34">Thái Thụy</option>
                                            <option value="342" data-cityid="34">Tiền Hải</option>
                                            <option value="343" data-cityid="34">Kiến Xương</option>
                                            <option value="344" data-cityid="34">Vũ Thư</option>
                                            <option value="347" data-cityid="35">Phủ Lý</option>
                                            <option value="349" data-cityid="35">Duy Tiên</option>
                                            <option value="350" data-cityid="35">Kim Bảng</option>
                                            <option value="351" data-cityid="35">Thanh Liêm</option>
                                            <option value="352" data-cityid="35">Bình Lục</option>
                                            <option value="353" data-cityid="35">Lý Nhân</option>
                                            <option value="356" data-cityid="36">Nam Định</option>
                                            <option value="358" data-cityid="36">Mỹ Lộc</option>
                                            <option value="359" data-cityid="36">Vụ Bản</option>
                                            <option value="360" data-cityid="36">Ý Yên</option>
                                            <option value="361" data-cityid="36">Nghĩa Hưng</option>
                                            <option value="362" data-cityid="36">Nam Trực</option>
                                            <option value="363" data-cityid="36">Trực Ninh</option>
                                            <option value="364" data-cityid="36">Xuân Trường</option>
                                            <option value="365" data-cityid="36">Giao Thủy</option>
                                            <option value="366" data-cityid="36">Hải Hậu</option>
                                            <option value="369" data-cityid="37">Ninh Bình</option>
                                            <option value="370" data-cityid="37">Tam Điệp</option>
                                            <option value="372" data-cityid="37">Nho Quan</option>
                                            <option value="373" data-cityid="37">Gia Viễn</option>
                                            <option value="374" data-cityid="37">Hoa Lư</option>
                                            <option value="375" data-cityid="37">Yên Khánh</option>
                                            <option value="376" data-cityid="37">Kim Sơn</option>
                                            <option value="377" data-cityid="37">Yên Mô</option>
                                            <option value="380" data-cityid="38">Thanh Hóa</option>
                                            <option value="381" data-cityid="38">Bỉm Sơn</option>
                                            <option value="382" data-cityid="38">Sầm Sơn</option>
                                            <option value="384" data-cityid="38">Mường Lát</option>
                                            <option value="385" data-cityid="38">Quan Hóa</option>
                                            <option value="386" data-cityid="38">Bá Thước</option>
                                            <option value="387" data-cityid="38">Quan Sơn</option>
                                            <option value="388" data-cityid="38">Lang Chánh</option>
                                            <option value="389" data-cityid="38">Ngọc Lặc</option>
                                            <option value="390" data-cityid="38">Cẩm Thủy</option>
                                            <option value="391" data-cityid="38">Thạch Thành</option>
                                            <option value="392" data-cityid="38">Hà Trung</option>
                                            <option value="393" data-cityid="38">Vĩnh Lộc</option>
                                            <option value="394" data-cityid="38">Yên Định</option>
                                            <option value="395" data-cityid="38">Thọ Xuân</option>
                                            <option value="396" data-cityid="38">Thường Xuân</option>
                                            <option value="397" data-cityid="38">Triệu Sơn</option>
                                            <option value="398" data-cityid="38">Thiệu Hoá</option>
                                            <option value="399" data-cityid="38">Hoằng Hóa</option>
                                            <option value="400" data-cityid="38">Hậu Lộc</option>
                                            <option value="401" data-cityid="38">Nga Sơn</option>
                                            <option value="402" data-cityid="38">Như Xuân</option>
                                            <option value="403" data-cityid="38">Như Thanh</option>
                                            <option value="404" data-cityid="38">Nông Cống</option>
                                            <option value="405" data-cityid="38">Đông Sơn</option>
                                            <option value="406" data-cityid="38">Quảng Xương</option>
                                            <option value="407" data-cityid="38">Tĩnh Gia</option>
                                            <option value="412" data-cityid="40">Vinh</option>
                                            <option value="413" data-cityid="40">Cửa Lò</option>
                                            <option value="414" data-cityid="40">Thái Hoà</option>
                                            <option value="415" data-cityid="40">Quế Phong</option>
                                            <option value="416" data-cityid="40">Quỳ Châu</option>
                                            <option value="417" data-cityid="40">Kỳ Sơn</option>
                                            <option value="418" data-cityid="40">Tương Dương</option>
                                            <option value="419" data-cityid="40">Nghĩa Đàn</option>
                                            <option value="420" data-cityid="40">Quỳ Hợp</option>
                                            <option value="421" data-cityid="40">Quỳnh Lưu</option>
                                            <option value="422" data-cityid="40">Con Cuông</option>
                                            <option value="423" data-cityid="40">Tân Kỳ</option>
                                            <option value="424" data-cityid="40">Anh Sơn</option>
                                            <option value="425" data-cityid="40">Diễn Châu</option>
                                            <option value="426" data-cityid="40">Yên Thành</option>
                                            <option value="427" data-cityid="40">Đô Lương</option>
                                            <option value="428" data-cityid="40">Thanh Chương</option>
                                            <option value="429" data-cityid="40">Nghi Lộc</option>
                                            <option value="430" data-cityid="40">Nam Đàn</option>
                                            <option value="431" data-cityid="40">Hưng Nguyên</option>
                                            <option value="436" data-cityid="42">Hà Tĩnh</option>
                                            <option value="437" data-cityid="42">Hồng Lĩnh</option>
                                            <option value="439" data-cityid="42">Hương Sơn</option>
                                            <option value="440" data-cityid="42">Đức Thọ</option>
                                            <option value="441" data-cityid="42">Vũ Quang</option>
                                            <option value="442" data-cityid="42">Nghi Xuân</option>
                                            <option value="443" data-cityid="42">Can Lộc</option>
                                            <option value="444" data-cityid="42">Hương Khê</option>
                                            <option value="445" data-cityid="42">Thạch Hà</option>
                                            <option value="446" data-cityid="42">Cẩm Xuyên</option>
                                            <option value="447" data-cityid="42">Kỳ Anh</option>
                                            <option value="448" data-cityid="42">Lộc Hà</option>
                                            <option value="450" data-cityid="44">Đồng Hới</option>
                                            <option value="452" data-cityid="44">Minh Hóa</option>
                                            <option value="453" data-cityid="44">Tuyên Hóa</option>
                                            <option value="454" data-cityid="44">Quảng Trạch</option>
                                            <option value="455" data-cityid="44">Bố Trạch</option>
                                            <option value="456" data-cityid="44">Quảng Ninh</option>
                                            <option value="457" data-cityid="44">Lệ Thủy</option>
                                            <option value="461" data-cityid="45">Đông Hà</option>
                                            <option value="462" data-cityid="45">Quảng Trị</option>
                                            <option value="464" data-cityid="45">Vĩnh Linh</option>
                                            <option value="465" data-cityid="45">Hướng Hóa</option>
                                            <option value="466" data-cityid="45">Gio Linh</option>
                                            <option value="467" data-cityid="45">Đa Krông</option>
                                            <option value="468" data-cityid="45">Cam Lộ</option>
                                            <option value="469" data-cityid="45">Triệu Phong</option>
                                            <option value="470" data-cityid="45">Hải Lăng</option>
                                            <option value="471" data-cityid="45">Cồn Cỏ</option>
                                            <option value="474" data-cityid="46">Huế</option>
                                            <option value="476" data-cityid="46">Phong Điền</option>
                                            <option value="477" data-cityid="46">Quảng Điền</option>
                                            <option value="478" data-cityid="46">Phú Vang</option>
                                            <option value="479" data-cityid="46">Hương Thủy</option>
                                            <option value="480" data-cityid="46">Hương Trà</option>
                                            <option value="481" data-cityid="46">A Lưới</option>
                                            <option value="482" data-cityid="46">Phú Lộc</option>
                                            <option value="483" data-cityid="46">Nam Đông</option>
                                            <option value="490" data-cityid="48">Liên Chiểu</option>
                                            <option value="491" data-cityid="48">Thanh Khê</option>
                                            <option value="492" data-cityid="48">Hải Châu</option>
                                            <option value="493" data-cityid="48">Sơn Trà</option>
                                            <option value="494" data-cityid="48">Ngũ Hành Sơn</option>
                                            <option value="495" data-cityid="48">Cẩm Lệ</option>
                                            <option value="497" data-cityid="48">Hoà Vang</option>
                                            <option value="498" data-cityid="48">Hoàng Sa</option>
                                            <option value="502" data-cityid="49">Tam Kỳ</option>
                                            <option value="503" data-cityid="49">Hội An</option>
                                            <option value="504" data-cityid="49">Tây Giang</option>
                                            <option value="505" data-cityid="49">Đông Giang</option>
                                            <option value="506" data-cityid="49">Đại Lộc</option>
                                            <option value="507" data-cityid="49">Điện Bàn</option>
                                            <option value="508" data-cityid="49">Duy Xuyên</option>
                                            <option value="509" data-cityid="49">Quế Sơn</option>
                                            <option value="510" data-cityid="49">Nam Giang</option>
                                            <option value="511" data-cityid="49">Phước Sơn</option>
                                            <option value="512" data-cityid="49">Hiệp Đức</option>
                                            <option value="513" data-cityid="49">Thăng Bình</option>
                                            <option value="514" data-cityid="49">Tiên Phước</option>
                                            <option value="515" data-cityid="49">Bắc Trà My</option>
                                            <option value="516" data-cityid="49">Nam Trà My</option>
                                            <option value="517" data-cityid="49">Núi Thành</option>
                                            <option value="518" data-cityid="49">Phú Ninh</option>
                                            <option value="519" data-cityid="49">Nông Sơn</option>
                                            <option value="522" data-cityid="51">Quảng Ngãi</option>
                                            <option value="524" data-cityid="51">Bình Sơn</option>
                                            <option value="525" data-cityid="51">Trà Bồng</option>
                                            <option value="526" data-cityid="51">Tây Trà</option>
                                            <option value="527" data-cityid="51">Sơn Tịnh</option>
                                            <option value="528" data-cityid="51">Tư Nghĩa</option>
                                            <option value="529" data-cityid="51">Sơn Hà</option>
                                            <option value="530" data-cityid="51">Sơn Tây</option>
                                            <option value="531" data-cityid="51">Minh Long</option>
                                            <option value="532" data-cityid="51">Nghĩa Hành</option>
                                            <option value="533" data-cityid="51">Mộ Đức</option>
                                            <option value="534" data-cityid="51">Đức Phổ</option>
                                            <option value="535" data-cityid="51">Ba Tơ</option>
                                            <option value="536" data-cityid="51">Lý Sơn</option>
                                            <option value="540" data-cityid="52">Qui Nhơn</option>
                                            <option value="542" data-cityid="52">An Lão</option>
                                            <option value="543" data-cityid="52">Hoài Nhơn</option>
                                            <option value="544" data-cityid="52">Hoài Ân</option>
                                            <option value="545" data-cityid="52">Phù Mỹ</option>
                                            <option value="546" data-cityid="52">Vĩnh Thạnh</option>
                                            <option value="547" data-cityid="52">Tây Sơn</option>
                                            <option value="548" data-cityid="52">Phù Cát</option>
                                            <option value="549" data-cityid="52">An Nhơn</option>
                                            <option value="550" data-cityid="52">Tuy Phước</option>
                                            <option value="551" data-cityid="52">Vân Canh</option>
                                            <option value="555" data-cityid="54">Tuy Hòa</option>
                                            <option value="557" data-cityid="54">Sông Cầu</option>
                                            <option value="558" data-cityid="54">Đồng Xuân</option>
                                            <option value="559" data-cityid="54">Tuy An</option>
                                            <option value="560" data-cityid="54">Sơn Hòa</option>
                                            <option value="561" data-cityid="54">Sông Hinh</option>
                                            <option value="562" data-cityid="54">Tây Hoà</option>
                                            <option value="563" data-cityid="54">Phú Hoà</option>
                                            <option value="564" data-cityid="54">Đông Hoà</option>
                                            <option value="568" data-cityid="56">Nha Trang</option>
                                            <option value="569" data-cityid="56">Cam Ranh</option>
                                            <option value="570" data-cityid="56">Cam Lâm</option>
                                            <option value="571" data-cityid="56">Vạn Ninh</option>
                                            <option value="572" data-cityid="56">Ninh Hòa</option>
                                            <option value="573" data-cityid="56">Khánh Vĩnh</option>
                                            <option value="574" data-cityid="56">Diên Khánh</option>
                                            <option value="575" data-cityid="56">Khánh Sơn</option>
                                            <option value="576" data-cityid="56">Trường Sa</option>
                                            <option value="582" data-cityid="58">Phan Rang-Tháp Chàm</option>
                                            <option value="584" data-cityid="58">Bác Ái</option>
                                            <option value="585" data-cityid="58">Ninh Sơn</option>
                                            <option value="586" data-cityid="58">Ninh Hải</option>
                                            <option value="587" data-cityid="58">Ninh Phước</option>
                                            <option value="588" data-cityid="58">Thuận Bắc</option>
                                            <option value="589" data-cityid="58">Thuận Nam</option>
                                            <option value="593" data-cityid="60">Phan Thiết</option>
                                            <option value="594" data-cityid="60">La Gi</option>
                                            <option value="595" data-cityid="60">Tuy Phong</option>
                                            <option value="596" data-cityid="60">Bắc Bình</option>
                                            <option value="597" data-cityid="60">Hàm Thuận Bắc</option>
                                            <option value="598" data-cityid="60">Hàm Thuận Nam</option>
                                            <option value="599" data-cityid="60">Tánh Linh</option>
                                            <option value="600" data-cityid="60">Đức Linh</option>
                                            <option value="601" data-cityid="60">Hàm Tân</option>
                                            <option value="602" data-cityid="60">Phú Quí</option>
                                            <option value="608" data-cityid="62">Kon Tum</option>
                                            <option value="610" data-cityid="62">Đắk Glei</option>
                                            <option value="611" data-cityid="62">Ngọc Hồi</option>
                                            <option value="612" data-cityid="62">Đắk Tô</option>
                                            <option value="613" data-cityid="62">Kon Plông</option>
                                            <option value="614" data-cityid="62">Kon Rẫy</option>
                                            <option value="615" data-cityid="62">Đắk Hà</option>
                                            <option value="616" data-cityid="62">Sa Thầy</option>
                                            <option value="617" data-cityid="62">Tu Mơ Rông</option>
                                            <option value="622" data-cityid="64">Pleiku</option>
                                            <option value="623" data-cityid="64">An Khê</option>
                                            <option value="624" data-cityid="64">Ayun Pa</option>
                                            <option value="625" data-cityid="64">Kbang</option>
                                            <option value="626" data-cityid="64">Đăk Đoa</option>
                                            <option value="627" data-cityid="64">Chư Păh</option>
                                            <option value="628" data-cityid="64">Ia Grai</option>
                                            <option value="629" data-cityid="64">Mang Yang</option>
                                            <option value="630" data-cityid="64">Kông Chro</option>
                                            <option value="631" data-cityid="64">Đức Cơ</option>
                                            <option value="632" data-cityid="64">Chư Prông</option>
                                            <option value="633" data-cityid="64">Chư Sê</option>
                                            <option value="634" data-cityid="64">Đăk Pơ</option>
                                            <option value="635" data-cityid="64">Ia Pa</option>
                                            <option value="637" data-cityid="64">Krông Pa</option>
                                            <option value="638" data-cityid="64">Phú Thiện</option>
                                            <option value="639" data-cityid="64">Chư Pưh</option>
                                            <option value="643" data-cityid="66">Buôn Ma Thuột</option>
                                            <option value="644" data-cityid="66">Buôn Hồ</option>
                                            <option value="645" data-cityid="66">Ea H'leo</option>
                                            <option value="646" data-cityid="66">Ea Súp</option>
                                            <option value="647" data-cityid="66">Buôn Đôn</option>
                                            <option value="648" data-cityid="66">Cư M'gar</option>
                                            <option value="649" data-cityid="66">Krông Búk</option>
                                            <option value="650" data-cityid="66">Krông Năng</option>
                                            <option value="651" data-cityid="66">Ea Kar</option>
                                            <option value="652" data-cityid="66">M'đrắk</option>
                                            <option value="653" data-cityid="66">Krông Bông</option>
                                            <option value="654" data-cityid="66">Krông Pắc</option>
                                            <option value="655" data-cityid="66">Krông A Na</option>
                                            <option value="656" data-cityid="66">Lắk</option>
                                            <option value="657" data-cityid="66">Cư Kuin</option>
                                            <option value="660" data-cityid="67">Gia Nghĩa</option>
                                            <option value="661" data-cityid="67">Đắk Glong</option>
                                            <option value="662" data-cityid="67">Cư Jút</option>
                                            <option value="663" data-cityid="67">Đắk Mil</option>
                                            <option value="664" data-cityid="67">Krông Nô</option>
                                            <option value="665" data-cityid="67">Đắk Song</option>
                                            <option value="666" data-cityid="67">Đắk R'lấp</option>
                                            <option value="667" data-cityid="67">Tuy Đức</option>
                                            <option value="672" data-cityid="68">Đà Lạt</option>
                                            <option value="673" data-cityid="68">Bảo Lộc</option>
                                            <option value="674" data-cityid="68">Đam Rông</option>
                                            <option value="675" data-cityid="68">Lạc Dương</option>
                                            <option value="676" data-cityid="68">Lâm Hà</option>
                                            <option value="677" data-cityid="68">Đơn Dương</option>
                                            <option value="678" data-cityid="68">Đức Trọng</option>
                                            <option value="679" data-cityid="68">Di Linh</option>
                                            <option value="680" data-cityid="68">Bảo Lâm</option>
                                            <option value="681" data-cityid="68">Đạ Huoai</option>
                                            <option value="682" data-cityid="68">Đạ Tẻh</option>
                                            <option value="683" data-cityid="68">Cát Tiên</option>
                                            <option value="688" data-cityid="70">Phước Long</option>
                                            <option value="689" data-cityid="70">Đồng Xoài</option>
                                            <option value="690" data-cityid="70">Bình Long</option>
                                            <option value="691" data-cityid="70">Bù Gia Mập</option>
                                            <option value="692" data-cityid="70">Lộc Ninh</option>
                                            <option value="693" data-cityid="70">Bù Đốp</option>
                                            <option value="694" data-cityid="70">Hớn Quản</option>
                                            <option value="695" data-cityid="70">Đồng Phù</option>
                                            <option value="696" data-cityid="70">Bù Đăng</option>
                                            <option value="697" data-cityid="70">Chơn Thành</option>
                                            <option value="703" data-cityid="72">Tây Ninh</option>
                                            <option value="705" data-cityid="72">Tân Biên</option>
                                            <option value="706" data-cityid="72">Tân Châu</option>
                                            <option value="707" data-cityid="72">Dương Minh Châu</option>
                                            <option value="708" data-cityid="72">Châu Thành</option>
                                            <option value="709" data-cityid="72">Hòa Thành</option>
                                            <option value="710" data-cityid="72">Gò Dầu</option>
                                            <option value="711" data-cityid="72">Bến Cầu</option>
                                            <option value="712" data-cityid="72">Trảng Bàng</option>
                                            <option value="718" data-cityid="74">Thủ Dầu Một</option>
                                            <option value="720" data-cityid="74">Dầu Tiếng</option>
                                            <option value="721" data-cityid="74">Bến Cát</option>
                                            <option value="722" data-cityid="74">Phú Giáo</option>
                                            <option value="723" data-cityid="74">Tân Uyên</option>
                                            <option value="724" data-cityid="74">Dĩ An</option>
                                            <option value="725" data-cityid="74">Thuận An</option>
                                            <option value="731" data-cityid="75">Biên Hòa</option>
                                            <option value="732" data-cityid="75">Long Khánh</option>
                                            <option value="734" data-cityid="75">Tân Phú</option>
                                            <option value="735" data-cityid="75">Vĩnh Cửu</option>
                                            <option value="736" data-cityid="75">Định Quán</option>
                                            <option value="737" data-cityid="75">Trảng Bom</option>
                                            <option value="738" data-cityid="75">Thống Nhất</option>
                                            <option value="739" data-cityid="75">Cẩm Mỹ</option>
                                            <option value="740" data-cityid="75">Long Thành</option>
                                            <option value="741" data-cityid="75">Xuân Lộc</option>
                                            <option value="742" data-cityid="75">Nhơn Trạch</option>
                                            <option value="747" data-cityid="77">Vũng Tầu</option>
                                            <option value="748" data-cityid="77">Bà Rịa</option>
                                            <option value="750" data-cityid="77">Châu Đức</option>
                                            <option value="751" data-cityid="77">Xuyên Mộc</option>
                                            <option value="752" data-cityid="77">Long Điền</option>
                                            <option value="753" data-cityid="77">Đất Đỏ</option>
                                            <option value="754" data-cityid="77">Tân Thành</option>
                                            <option value="755" data-cityid="77">Côn Đảo</option>
                                            <option value="760" data-cityid="79">Quận 1</option>
                                            <option value="761" data-cityid="79">Quận 12</option>
                                            <option value="762" data-cityid="79">Thủ Đức</option>
                                            <option value="763" data-cityid="79">Quận 9</option>
                                            <option value="764" data-cityid="79">Gò Vấp</option>
                                            <option value="765" data-cityid="79">Bình Thạnh</option>
                                            <option value="766" data-cityid="79">Tân Bình</option>
                                            <option value="767" data-cityid="79">Tân Phú</option>
                                            <option value="768" data-cityid="79">Phú Nhuận</option>
                                            <option value="769" data-cityid="79">Quận 2</option>
                                            <option value="770" data-cityid="79">Quận 3</option>
                                            <option value="771" data-cityid="79">Quận 10</option>
                                            <option value="772" data-cityid="79">Quận 11</option>
                                            <option value="773" data-cityid="79">Quận 4</option>
                                            <option value="774" data-cityid="79">Quận 5</option>
                                            <option value="775" data-cityid="79">Quận 6</option>
                                            <option value="776" data-cityid="79">Quận 8</option>
                                            <option value="777" data-cityid="79">Bình Tân</option>
                                            <option value="778" data-cityid="79">Quận 7</option>
                                            <option value="783" data-cityid="79">Củ Chi</option>
                                            <option value="784" data-cityid="79">Hóc Môn</option>
                                            <option value="785" data-cityid="79">Bình Chánh</option>
                                            <option value="786" data-cityid="79">Nhà Bè</option>
                                            <option value="787" data-cityid="79">Cần Giờ</option>
                                            <option value="794" data-cityid="80">Tân An</option>
                                            <option value="796" data-cityid="80">Tân Hưng</option>
                                            <option value="797" data-cityid="80">Vĩnh Hưng</option>
                                            <option value="798" data-cityid="80">Mộc Hóa</option>
                                            <option value="799" data-cityid="80">Tân Thạnh</option>
                                            <option value="800" data-cityid="80">Thạnh Hóa</option>
                                            <option value="801" data-cityid="80">Đức Huệ</option>
                                            <option value="802" data-cityid="80">Đức Hòa</option>
                                            <option value="803" data-cityid="80">Bến Lức</option>
                                            <option value="804" data-cityid="80">Thủ Thừa</option>
                                            <option value="805" data-cityid="80">Tân Trụ</option>
                                            <option value="806" data-cityid="80">Cần Đước</option>
                                            <option value="807" data-cityid="80">Cần Giuộc</option>
                                            <option value="808" data-cityid="80">Châu Thành</option>
                                            <option value="815" data-cityid="82">Mỹ Tho</option>
                                            <option value="816" data-cityid="82">Gò Công</option>
                                            <option value="818" data-cityid="82">Tân Phước</option>
                                            <option value="819" data-cityid="82">Cái Bè</option>
                                            <option value="820" data-cityid="82">Cai Lậy</option>
                                            <option value="821" data-cityid="82">Châu Thành</option>
                                            <option value="822" data-cityid="82">Chợ Gạo</option>
                                            <option value="823" data-cityid="82">Gò Công Tây</option>
                                            <option value="824" data-cityid="82">Gò Công Đông</option>
                                            <option value="825" data-cityid="82">Tân Phú Đông</option>
                                            <option value="829" data-cityid="83">Bến Tre</option>
                                            <option value="831" data-cityid="83">Châu Thành</option>
                                            <option value="832" data-cityid="83">Chợ Lách</option>
                                            <option value="833" data-cityid="83">Mỏ Cày Nam</option>
                                            <option value="834" data-cityid="83">Giồng Trôm</option>
                                            <option value="835" data-cityid="83">Bình Đại</option>
                                            <option value="836" data-cityid="83">Ba Tri</option>
                                            <option value="837" data-cityid="83">Thạnh Phú</option>
                                            <option value="838" data-cityid="83">Mỏ Cày Bắc</option>
                                            <option value="842" data-cityid="84">Trà Vinh</option>
                                            <option value="844" data-cityid="84">Càng Long</option>
                                            <option value="845" data-cityid="84">Cầu Kè</option>
                                            <option value="846" data-cityid="84">Tiểu Cần</option>
                                            <option value="847" data-cityid="84">Châu Thành</option>
                                            <option value="848" data-cityid="84">Cầu Ngang</option>
                                            <option value="849" data-cityid="84">Trà Cú</option>
                                            <option value="850" data-cityid="84">Duyên Hải</option>
                                            <option value="855" data-cityid="86">Vĩnh Long</option>
                                            <option value="857" data-cityid="86">Long Hồ</option>
                                            <option value="858" data-cityid="86">Mang Thít</option>
                                            <option value="859" data-cityid="86">Vũng Liêm</option>
                                            <option value="860" data-cityid="86">Tam Bình</option>
                                            <option value="861" data-cityid="86">Bình Minh</option>
                                            <option value="862" data-cityid="86">Trà Ôn</option>
                                            <option value="863" data-cityid="86">Bình Tân</option>
                                            <option value="866" data-cityid="87">Cao Lãnh</option>
                                            <option value="867" data-cityid="87">Sa Đéc</option>
                                            <option value="868" data-cityid="87">Hồng Ngự</option>
                                            <option value="869" data-cityid="87">Tân Hồng</option>
                                            <option value="870" data-cityid="87">Hồng Ngự</option>
                                            <option value="871" data-cityid="87">Tam Nông</option>
                                            <option value="872" data-cityid="87">Tháp Mười</option>
                                            <option value="873" data-cityid="87">Cao Lãnh</option>
                                            <option value="874" data-cityid="87">Thanh Bình</option>
                                            <option value="875" data-cityid="87">Lấp Vò</option>
                                            <option value="876" data-cityid="87">Lai Vung</option>
                                            <option value="877" data-cityid="87">Châu Thành</option>
                                            <option value="883" data-cityid="89">Long Xuyên</option>
                                            <option value="884" data-cityid="89">Châu Đốc</option>
                                            <option value="886" data-cityid="89">An Phú</option>
                                            <option value="887" data-cityid="89">Tân Châu</option>
                                            <option value="888" data-cityid="89">Phú Tân</option>
                                            <option value="889" data-cityid="89">Châu Phú</option>
                                            <option value="890" data-cityid="89">Tịnh Biên</option>
                                            <option value="891" data-cityid="89">Tri Tôn</option>
                                            <option value="892" data-cityid="89">Châu Thành</option>
                                            <option value="893" data-cityid="89">Chợ Mới</option>
                                            <option value="894" data-cityid="89">Thoại Sơn</option>
                                            <option value="899" data-cityid="91">Rạch Giá</option>
                                            <option value="900" data-cityid="91">Hà Tiên</option>
                                            <option value="902" data-cityid="91">Kiên Lương</option>
                                            <option value="903" data-cityid="91">Hòn Đất</option>
                                            <option value="904" data-cityid="91">Tân Hiệp</option>
                                            <option value="905" data-cityid="91">Châu Thành</option>
                                            <option value="906" data-cityid="91">Giồng Giềng</option>
                                            <option value="907" data-cityid="91">Gò Quao</option>
                                            <option value="908" data-cityid="91">An Biên</option>
                                            <option value="909" data-cityid="91">An Minh</option>
                                            <option value="910" data-cityid="91">Vĩnh Thuận</option>
                                            <option value="911" data-cityid="91">Phú Quốc</option>
                                            <option value="912" data-cityid="91">Kiên Hải</option>
                                            <option value="913" data-cityid="91">U Minh Thượng</option>
                                            <option value="914" data-cityid="91">Giang Thành</option>
                                            <option value="916" data-cityid="92">Ninh Kiều</option>
                                            <option value="917" data-cityid="92">Ô Môn</option>
                                            <option value="918" data-cityid="92">Bình Thủy</option>
                                            <option value="919" data-cityid="92">Cái Răng</option>
                                            <option value="923" data-cityid="92">Thốt Nốt</option>
                                            <option value="924" data-cityid="92">Vĩnh Thạnh</option>
                                            <option value="925" data-cityid="92">Cờ Đỏ</option>
                                            <option value="926" data-cityid="92">Phong Điền</option>
                                            <option value="927" data-cityid="92">Thới Lai</option>
                                            <option value="930" data-cityid="93">Vị Thanh</option>
                                            <option value="931" data-cityid="93">Ngã Bảy</option>
                                            <option value="932" data-cityid="93">Châu Thành A</option>
                                            <option value="933" data-cityid="93">Châu Thành</option>
                                            <option value="934" data-cityid="93">Phụng Hiệp</option>
                                            <option value="935" data-cityid="93">Vị Thuỷ</option>
                                            <option value="936" data-cityid="93">Long Mỹ</option>
                                            <option value="941" data-cityid="94">Sóc Trăng</option>
                                            <option value="942" data-cityid="94">Châu Thành</option>
                                            <option value="943" data-cityid="94">Kế Sách</option>
                                            <option value="944" data-cityid="94">Mỹ Tú</option>
                                            <option value="945" data-cityid="94">Cù Lao Dung</option>
                                            <option value="946" data-cityid="94">Long Phú</option>
                                            <option value="947" data-cityid="94">Mỹ Xuyên</option>
                                            <option value="948" data-cityid="94">Ngã Năm</option>
                                            <option value="949" data-cityid="94">Thạnh Trị</option>
                                            <option value="950" data-cityid="94">Vĩnh Châu</option>
                                            <option value="951" data-cityid="94">Trần Đề</option>
                                            <option value="954" data-cityid="95">Bạc Liêu</option>
                                            <option value="956" data-cityid="95">Hồng Dân</option>
                                            <option value="957" data-cityid="95">Phước Long</option>
                                            <option value="958" data-cityid="95">Vĩnh Lợi</option>
                                            <option value="959" data-cityid="95">Giá Rai</option>
                                            <option value="960" data-cityid="95">Đông Hải</option>
                                            <option value="961" data-cityid="95">Hoà Bình</option>
                                            <option value="964" data-cityid="96">Cà Mau</option>
                                            <option value="966" data-cityid="96">U Minh</option>
                                            <option value="967" data-cityid="96">Thới Bình</option>
                                            <option value="968" data-cityid="96">Trần Văn Thời</option>
                                            <option value="969" data-cityid="96">Cái Nước</option>
                                            <option value="970" data-cityid="96">Đầm Dơi</option>
                                            <option value="971" data-cityid="96">Năm Căn</option>
                                            <option value="972" data-cityid="96">Phú Tân</option>
                                            <option value="973" data-cityid="96">Ngọc Hiển</option>
                                        </select>
                                        <select class="selectpicker show-tick form-control input-lg" id="cbDistrict" name="district" data-live-search="true" disabled="" title="Chọn quận huyện" required>
                                        </select>
                                    </div>
                                    <style type="text/css">
                                        select#cbDistrict > option{ display: none;  }
                                    </style>

                                    <div class="form-group">
                                        <label class="mb-0 mr-3" for="fc-radio-1">Bạn cần:</label>

                                        <label class="custom-control custom-radio fs-13 mr-4">
                                            <input id="fc-radio-1" value="{{ VAY }}" name="type" type="radio" class="custom-control-input">
                                            <span class="custom-control-indicator"></span>
                                            <span class="custom-control-description">Vay</span>
                                        </label>

                                        <label class="custom-control custom-radio fs-13">
                                            <input id="fc-radio-2" value="{{ CHO_VAY }}" name="type" type="radio" class="custom-control-input" checked>
                                            <span class="custom-control-indicator"></span>
                                            <span class="custom-control-description">Cho vay</span>
                                        </label>
                                    </div>

                                    <button type="submit" class="btn btn-lg btn-block btn-primary text-uppercase fs-13 rounded mt-5">
                                        Đăng Ký
                                    </button>
                                </div>
                            {{ Form::close() }}
                        </div>

                        <div class="fs-13" id="divEnterSMSCode" style="display: none">
                            <form id="ActiveAccountForm" novalidate="novalidate">
                                <div class="tm-regform__header d-flex justify-content-between align-items-center p-3">
                                    <h2 class="text-uppercase fs-16 fw-4 mb-0">
                                        Nhập mã xác nhận
                                    </h2>
                                </div>

                                <hr class="border-gray my-0">

                                <div class="px-5 py-3">
                                    <p class="text-center">
                                        Mã xác nhận đã được gửi đến số <b id="bPhone">0965668369</b> <br>
                                        Vui lòng nhập mã xác nhận vào ô dưới:
                                    </p>

                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-lg fs-13 px-3 rounded" name="txtCodeConfirm" id="txtCodeConfirm" placeholder="xxxx" title="">
                                    </div>

                                    <button class="btn btn-lg btn-block btn-primary text-uppercase fs-13 rounded mt-5">
                                        Tiếp tục
                                    </button>
                                </div>
                            </form>
                        </div>

                        <div>
                            <hr class="border-gray my-0">

                            <div class="text-center fs-13 p-3">
                                Bạn đã có tài khoản?

                                <div class="d-inline-block">
                                    Hãy
                                    <a class="text-primary" href="/User/Login">
                                        <ins>click vào đây để đăng nhập</ins>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop