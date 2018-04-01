@extends('frontend.app')
@section('title','DASHBOARD ADMINISTRATOR')

@section('content')

    <div id="main-slider-swiper" class="main-slider">
        <div class="swiper-wrapper">
            @foreach($data as $value)
            <div class="main-slider__item swiper-slide">
                <div class="main-slider__bg" style="background-image:url('{{ $value->image_url }}');"></div>

                <div class="container">
                    <div class="main-slider__content text-center w-100 w-md-100 mx-auto">
                        <h1 class="main-slider__heading">
                            {{ $value->name }}
                        </h1>
                        <p class="main-slider__lead mb-0">
                            {{ $value->description }}
                        </p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div id="main-slider__pagination" class="swiper-pagination main-slider__pagination"></div>

        <div class="main-slider__nav container">
            <div id="main-slider__next" class="swiper-button-prev main-slider__next"></div>
            <div id="main-slider__prev" class="swiper-button-next main-slider__prev"></div>
        </div>
    </div>
    <div class="tm-strong">
        <div class="container">

            <div class="tm-strong__inner d-flex flex-column flex-md-row">
                <p class="mb-0 mr-3 mb-3 mb-md-0">
                    Tổng số tiền đã được giải ngân :
                </p>

                <div class="d-flex align-items-center">
                    <div class="incremental-counter d-flex mr-10px mr-lg-3" data-value="22426966"></div>
                    <span class="text-uppercase font-secondary">Triệu</span>
                </div>
            </div>

        </div>
    </div>
@stop