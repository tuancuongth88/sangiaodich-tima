<div class="tm-card bg-white py-5 mb-5">
    <div class="container">
        <h2 class="tm-card__heading text-center mb-6">
            Các gói sản phẩm vay
        </h2>

        <div class="tm-card__body tm-feature">
            <div id="tm-feature-swiper" class="swiper-container">
                <div class="swiper-wrapper">
                    @foreach($list_service as $value)
                    <div class="tm-feature__item swiper-slide text-center">
                        <a href="/dang-ky-vay/{{ $value->slug }}">
                            <div class="tm-feature__thumb mb-2 mx-auto">
                                <img src="{{ $value->icon_url }}"
                                     style="width:88px"/>
                            </div>
                        </a>
                        <h3 class="tm-feature__title">
                            <a href="/services/{{ $value->id }}">
                                {{ $value->service_name }}
                            </a>
                        </h3>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="tm-feature__nav container stick-center">
                <div id="tm-feature__next" class="swiper-button-prev tm-feature__next"></div>
                <div id="tm-feature__prev" class="swiper-button-next tm-feature__prev"></div>
            </div>
        </div>
    </div>
</div>