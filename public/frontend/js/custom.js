$(document).ready(function(){

    //==
    // loading
    //

    // setTimeout(function () {
    //     $(".loader").fadeOut(300, function () {
    //         $(this).remove();
    //     });
    //     $('body').removeClass('inactive');
    //     $('html,body').scrollTop(0);
    // }, 100);


    //==
    // swiper slider
    //

    var main_slider_swiper = new Swiper('#main-slider-swiper', {
        nextButton: '#main-slider__next',
        prevButton: '#main-slider__prev',
        pagination: '#main-slider__pagination',
        paginationClickable: true,
        loop: true
    });

    var tm_feature_swiper = new Swiper('#tm-feature-swiper', {
        nextButton: '#tm-feature__next',
        prevButton: '#tm-feature__prev',
        paginationClickable: true,
        loop: true,
        slidesPerView: 9,
        // spaceBetween: 45,
        breakpoints: {
            1199: {
                slidesPerView: 8
            },
            991: {
                slidesPerView: 6
            },
            767: {
                slidesPerView: 5
            },
            575: {
                slidesPerView: 3
            },
            320: {
                slidesPerView: 2
            }
        }

    });

    var tm_brands_swiper = new Swiper('#tm-brands-swiper', {
        nextButton: '#tm-brands__next',
        prevButton: '#tm-brands__prev',
        paginationClickable: true,
        loop: true,
        slidesPerView: 6,
        spaceBetween: 52,
        breakpoints: {
            1199: {
                slidesPerView: 5
            },
            991: {
                slidesPerView: 4
            },
            767: {
                slidesPerView: 3
            },
            575: {
                slidesPerView: 2
            }
        }
    });

    var tm_brands_swiper_2 = new Swiper('#tm-brands-swiper-2', {
        nextButton: '#tm-brands__next',
        prevButton: '#tm-brands__prev',
        loop: true,
        slidesPerView: 5,
        spaceBetween: 80,
        autoplay: 5000,
        breakpoints: {
            991: {
                slidesPerView: 4
            },
            575: {
                slidesPerView: 3,
                spaceBetween: 60
            }
        }
    });

    var tm_table_swiper = new Swiper('.tm-table-swiper', {
        loop: true,
        slidesPerView: 5,
        direction: 'vertical',
        // centeredSlides: true,
        autoplay: 2500,
        autoplayDisableOnInteraction: false
    });

    var dlapp_slider_swiper = new Swiper('#dlapp-slider-swiper', {
        nextButton: '#dlapp__next',
        prevButton: '#dlapp__prev',
        paginationClickable: true,
        loop: true
    });


    //==
    // button uploadfile - support cursor for chrome
    //

    $(".btn-file").mousemove(function(e) {
        var offL, offT, width_input;
        offL = $(this).offset().left;
        offT = $(this).offset().top;
        width_input = $(this).find("input").width();
        $(this).find("input").css({
            left:e.pageX - offL - (width_input - 30),
            top:e.pageY - offT - 10
        })
    });


    //==
    // bootstrap-slider
    //

    $('.bootstrap-slider').slider();


    //==
    // bootstrap datepicker
    //

    $('.datepicker').datepicker();


    $(".incremental-counter").incrementalCounter();
});