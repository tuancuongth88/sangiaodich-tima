@extends('frontend.app')
@section('title','Khởi tạo đơn vay thành công')

@section('content')
<div class="container py-5">

    <div class="tm-reg">
        <div class="row gutter-10px flex-column-reverse flex-md-row">
            <div class="offset-md-2 col-md-10 d-flex mb-5 mb-md-0">
                <div class="tm-regform d-flex flex-column justify-content-between w-100 border border-gray bg-white">
                    <div class="fs-13" id="divFormRegister">

                        {{ Form::open(['route' => ['transaction.site.post_updateform', $service, $transaction], 'method' => 'POST']) }}
                            <div class="tm-regform__header justify-content-between align-items-center p-3">
                                <h2 class="text-uppercase fs-18 fw-4 mb-0 text-center">
                                    <i class="fa fa-check-circle fs-20 mr-1" aria-hidden="true" style="color:#5cb85c"></i> <b> Khởi tạo đơn vay thành công </b>
                                </h2>
                            </div>

                            <hr class="border-gray my-0">

                            <div class="px-5 py-3">
                                <p class="text-center">
                                    Vui lòng bổ sung thêm thông tin bên dưới để đơn vay của bạn được duyệt nhanh hơn
                                </p>

                                @foreach($form as $name => $value)
                                    <div class="form-group row col-md-12">
                                        <label for="txtCardNumber" class="col-md-2 col-form-label text-sm-right mr-5">{{ $value['label'] }}</label>
                                        @if( $value['type'] == 'select' )
                                            {{ Form::select($name, ['' => '-- Chọn --']+$value['data'], (!empty($value['value']) ? $value['value'] : ''), ['class' => 'col-md-9 select optional form-control input-lg valDropdownlist fs-14']) }}
                                        @elseif( $value['type'] == 'radio' )
                                            @foreach($value['data'] as $key => $value2)
                                                <label class="custom-control custom-radio fs-14 mr-5">
                                                    <input id="fc-radio-{{ $key }}" value="{{ $key }}" name="{{ $name }}" type="radio" class="custom-control-input" {{ ($value['value'] == $key) ? 'checked readonly' : '' }}>
                                                    <span class="custom-control-indicator"></span>
                                                    <span class="custom-control-description">{{ $value2 }}</span>
                                                </label>
                                            @endforeach
                                        @else
                                            <input name="{{ $name }}" value="{{ !empty($value['value']) ? $value['value'] : '' }}" {{ !empty($value['value']) ? 'disabled' : '' }} type="text" class="col-md-9 col-sm-7 form-control form-control-lg fs-14 px-3 rounded valid">
                                        @endif
                                    </div>
                                @endforeach

                                <div class="form-group row col-md-12">
                                    <label class="col-md-2 mr-5"></label>
                                    <button type="submit" class="col-md-9 btn btn-lg btn-block btn-primary text-uppercase fs-13 rounded mt-5 mb-3">
                                        Hoàn thành hồ sơ
                                    </button>
                                </div>

                            </div>
                        {{ Form::close() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@stop