<!DOCTYPE html>
<html lang="vi">
<!-- begin::Head -->
@include('frontend.theme.header')

<div class="main-page">
    @yield('content')
</div>
@include('frontend.theme.footer-bar')

<script src="{{ URL::asset('/frontend/js/jquery.min.js') }}"></script>
<script src="{{ URL::asset('/frontend/js/popper.min.js') }}"></script>
<script src="{{ URL::asset('/frontend/js/bootstrap-4.0.0-beta.3.min.js') }}"></script>
<script src="{{ URL::asset('/frontend/js/tether.min.js') }}"></script>
<script src="{{ URL::asset('/frontend/js/swiper.jquery.min.js') }}"></script>
<script src="{{ URL::asset('/frontend/js/bootstrap-slider.min.js') }}"></script>
{{-- <script src="{{ URL::asset('/frontend/js/bootstrap-select.min.js') }}"></script> --}}
<script src="{{ URL::asset('/frontend/js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ URL::asset('/frontend/js/jquery.incremental-counter.min.js') }}"></script>

<script type="text/javascript" src="{{ URL::asset('/frontend/js/jquery.noty.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('/frontend/js/top.js') }}"></script>



{{-- <script src="{{ URL::asset('/frontend/js/jquery.validate.min.js') }}"></script> --}}
<script src="{{ URL::asset('/frontend/js/select2.min.js') }}"></script>

<script src="{{ URL::asset('/frontend/js/custom.js') }}"></script>
<script src="{{ URL::asset('/frontend/js/common.js') }}"></script>
<script src="{{ URL::asset('/frontend/js/form-control.js') }}"></script>
<script src="{{ URL::asset('/frontend/js/custom_tan.js') }}"></script>

<!--Vào trang con thì bỏ chú thích js 1 dòng dưới này-->
<!--<script src="files/js/scripts.js"></script>-->
{{-- <script>

    // jQuery.validator.addMethod("phone", function(value, element){
    //     var $reg1 = /^01\d{9}$/,
    //         $reg2 = /^09\d{8}$/,
    //         $reg3 = /^08\d{8}$/;
    //     return this.optional(element) || $reg1.test(value) || $reg2.test(value) || $reg3.test(value);
    // }, "Số điện thoại không hợp lệ");

    // jQuery.validator.addMethod("email", function(value, element){
    //     var $reg = /^[a-zA-Z0-9][a-zA-Z0-9\._]{2,62}[a-zA-Z0-9]@[a-z0-9\-]{3,}(\.[a-z]{2,4}){1,2}$/;
    //     return this.optional(element) || $reg.test(value);
    // }, "Email không hợp lệ");

    // $(document).ready(function () {
    //     $('.chatbox-zoom').click(function () {
    //         $('.chatbox-body').toggle();
    //     });

    //     $('.chatbox-form').validate({
    //         rules: {
    //             chat_fullname: {
    //                 required: true,
    //             },
    //             chat_email: {
    //                 required: true,
    //                 email: true
    //             },
    //             chat_content: {
    //                 required: true
    //             }
    //         },
    //         messages: {
    //             chat_fullname: {
    //                 required: 'Chưa nhập Tên',
    //             },
    //             chat_email: {
    //                 required: 'Chưa nhập email',
    //             },
    //             chat_content: {
    //                 required: 'Chưa nhập nội dung',
    //             }
    //         },
    //         errorElement: 'div',
    //         errorPlacement: function (place, element) {
    //             place.addClass('error-message').appendTo(element.closest('div'));
    //         },
    //         highlight: function (element, errorClass, validClass) {
    //             if (element.type === "radio") {
    //                 this.findByName(element.name).addClass(errorClass).removeClass(validClass);
    //             } else if (element.type === "select-one" || element.type === "select-multiple") {
    //                 var $element = $(element);
    //                 $element.addClass(errorClass).removeClass(validClass);
    //                 var $next = $element.next();
    //                 if ($next.length > 0 && $next.hasClass('select2')) {
    //                     $next.addClass(errorClass).removeClass(validClass);
    //                 }
    //             } else {
    //                 $(element).addClass(errorClass).removeClass(validClass);
    //             }
    //         },
    //         unhighlight: function (element, errorClass, validClass) {
    //             if (element.type === "radio") {
    //                 this.findByName(element.name).addClass(validClass).removeClass(errorClass);
    //             } else if (element.type === "select-one" || element.type === "select-multiple") {
    //                 var $element = $(element);
    //                 $element.addClass(validClass).removeClass(errorClass);
    //                 var $next = $element.next();
    //                 if ($next.length > 0 && $next.hasClass('select2')) {
    //                     $next.addClass(validClass).removeClass(errorClass);
    //                 }
    //             } else {
    //                 $(element).addClass(validClass).removeClass(errorClass);
    //             }
    //         },
    //         submitHandler: function (form) {
    //             /*viet xu ly o day*/
    //             return false;
    //         }
    //     });
    // })
</script> --}}


</body>
</html>