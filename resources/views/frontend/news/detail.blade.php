@extends('frontend.app')
@section('title','DASHBOARD ADMINISTRATOR')

@section('content')
<style>
    #submenu {
        list-style: none;
        display: inline;
        float: left;
        margin: 0;
        padding: 15px;
    }

    #submenu li {
        float: left;
        text-transform: uppercase;
        text-align: center;
        width: 111px;
    }

    #submenu .active {
        border-bottom: 2px solid #ed522e;
    }
</style>
<div class="container py-5">

    <div class="tm-news">
        <div class="row">
            <ul id="submenu">
                <li class="active"><a href="/news">Tin tài chính</a></li>
                <li class=""><a href="/news/tin-tima">Tin Lending</a></li>
                <li class=""><a href="/news/video-tima">Video Lending</a></li>
            </ul>
        </div>

        <div class="row">
            <div class="col-main col-lg-9">
                <div class="border border-gray bg-white p-md-5 p-3">
                    <div class="tm-news__list">
                        <div id="detailItem">
                            <h1> {{ $data->title }}</h1>
                            {!! $data->content !!}
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-aside col-md-3 hidden-md-down">

                <div class="border border-gray bg-white p-5 pt-md-3 mb-5">
                    <h3 class="fs-16 fw-6 text-uppercase text-center">
                        Hướng dẫn cài app
                    </h3>

                    <hr>

                    <div class="d-flex flex-column align-items-center">
                        <div class="mb-3 mr-3 mr-sm-0">
                            <a class="gomobile__link" href="https://itunes.apple.com/WebObjects/MZStore.woa/wa/viewSoftware?id=1291754151&mt=8">
                                <img class="img-responsive" src="files/images/appstore.png" alt="">
                            </a>
                        </div>

                        <div>
                            <a class="gomobile__link" href="https://play.google.com/store/apps/details?id=com.santima">
                                <img class="img-responsive" src="files/images/googleplay.png" alt="">
                            </a>
                        </div>
                    </div>
                </div>




                <div class="border border-gray bg-white p-5 pt-md-3 mb-5 fs-14">
                    <h3 class="fs-16 fw-6 text-uppercase text-center">
                        Hỏi đáp
                    </h3>

                    <hr>

                    <ul class="list-v">
                        @foreach ($listFaqCategory as $element)
                            <li class="list-v__item">
                                <a class="list-v__link" href="{{ action('Frontends\News\NewsController@getDetail', $element->id) }}">
                                    {{ $element->name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>




                <div class="border border-gray bg-white p-5 pt-md-3 mb-5">
                    <h3 class="fs-16 fw-6 text-uppercase text-center">
                        Báo chí nói về chúng tôi
                    </h3>

                    <hr>

                    <div class="tab1-newpr">
                        <div class="news fs-14 mb-4">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <div class="d-flex justify-content-center wf-100 w-100">
                                    <img src="files/images/vietnamnet.png" alt="" height="18px">
                                </div>
                                <div class="news__time text-gray-lighter">
                                    22/12/2017  20:00
                                </div>
                            </div>

                            <div class="media">
                                <div class="wf-100 border d-flex mr-3">
                                    <a target="_blank" rel="nofollow" target="_blank" rel="nofollow" href="http://vietnamnet.vn/vn/kinh-doanh/ra-mat-san-ket-noi-tai-chinh-tima-419421.html">
                                        <img class="img-fluid" src="http://f.imgs.vietnamnet.vn/2017/12/22/18/ra-mat-san-ket-noi-tai-chinh-tima.jpg" alt="">
                                    </a>
                                </div>
                                <div class="media-body">
                                    <h3 class="news__title fw-4 fs-14 mb-0">
                                        <a target="_blank" rel="nofollow" href="http://vietnamnet.vn/vn/kinh-doanh/ra-mat-san-ket-noi-tai-chinh-tima-419421.html">
                                            Ra mắt sàn kết nối tài chính Lending
                                        </a>
                                    </h3>
                                </div>
                            </div>
                        </div>

                        <hr>

                        <div class="news fs-14 mb-4">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <div class="d-flex justify-content-center wf-100 w-100">
                                    <img src="files/images/dantri.png" alt="" height="18px">
                                </div>
                                <div class="news__time text-gray-lighter">
                                    22/12/2017  15:00
                                </div>
                            </div>

                            <div class="media">
                                <div class="wf-100 border d-flex mr-3">
                                    <a target="_blank" rel="nofollow" href="http://dantri.com.vn/kinh-doanh/hon-nua-ty-usd-da-duoc-ket-noi-thanh-cong-qua-san-tai-chinh-20171220105207417.htm">
                                        <img class="img-fluid" src="https://dantricdn.com/2017/photo-3-1513741805163.jpg" alt="">
                                    </a>
                                </div>
                                <div class="media-body">
                                    <h3 class="news__title fw-4 fs-14 mb-0">
                                        <a target="_blank" rel="nofollow" href="http://dantri.com.vn/kinh-doanh/hon-nua-ty-usd-da-duoc-ket-noi-thanh-cong-qua-san-tai-chinh-20171220105207417.htm">
                                            Hơn nửa tỷ USD đã được kết nối thành công qua sàn tài chính
                                        </a>
                                    </h3>
                                </div>
                            </div>
                        </div>

                        <hr>


                        <div class="news fs-14 mb-4">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <div class="d-flex justify-content-center wf-100 w-100">
                                    <img src="files/images/cafebiz.png" alt="" height="18px">
                                </div>
                                <div class="news__time text-gray-lighter">
                                    20/12/2017  04:00
                                </div>
                            </div>

                            <div class="media">
                                <div class="wf-100 border d-flex mr-3">
                                    <a target="_blank" rel="nofollow" href="http://cafebiz.vn/viet-nam-chinh-thuc-co-san-giao-dich-tai-chinh-dung-facebook-danh-gia-tin-nhiem-khach-vay-20171220155903654.chn">
                                        <img class="img-fluid" src="https://cafebiz.cafebizcdn.vn/thumb_w/600/2017/tima-san-giao-dich-1-1513760129777-crop-1513760177766.jpg" alt="">
                                    </a>
                                </div>
                                <div class="media-body">
                                    <h3 class="news__title fw-4 fs-14 mb-0">
                                        <a target="_blank" rel="nofollow" href="http://cafebiz.vn/viet-nam-chinh-thuc-co-san-giao-dich-tai-chinh-dung-facebook-danh-gia-tin-nhiem-khach-vay-20171220155903654.chn">
                                            Việt Nam chính thức có sàn giao dịch tài chính dùng Facebook đánh giá tín nhiệm khách vay
                                        </a>
                                    </h3>
                                </div>
                            </div>
                        </div>

                        <hr>

                        <div class="news fs-14 mb-4">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <div class="d-flex justify-content-center wf-100 w-100">
                                    <img src="files/images/ictnews.png" alt="" height="18px">
                                </div>
                                <div class="news__time text-gray-lighter">
                                    20/12/2017  13:27
                                </div>
                            </div>

                            <div class="media">
                                <div class="wf-100 border d-flex mr-3">
                                    <a target="_blank" rel="nofollow" href="http://ictnews.vn/khoi-nghiep/fintech/gan-700-trieu-usd-da-duoc-ket-noi-thanh-cong-qua-san-tai-chinh-tima-162573.ict">
                                        <img class="img-fluid" src="http://image1.ictnews.vn/_Files/2017/12/20/thay-anh.jpg" alt="">
                                    </a>
                                </div>
                                <div class="media-body">
                                    <h3 class="news__title fw-4 fs-14 mb-0">
                                        <a target="_blank" rel="nofollow" href="http://ictnews.vn/khoi-nghiep/fintech/gan-700-trieu-usd-da-duoc-ket-noi-thanh-cong-qua-san-tai-chinh-tima-162573.ict">
                                            Gần 700 triệu USD đã được kết nối thành công qua sàn tài chính Lending
                                        </a>
                                    </h3>
                                </div>
                            </div>
                        </div>

                        <hr>

                        <div class="news fs-14 mb-4">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <div class="d-flex justify-content-center wf-100 w-100">
                                    <img src="files/images/vne.jpg" alt="" height="18px">
                                </div>
                                <div class="news__time text-gray-lighter">
                                    20/12/2016 13:30
                                </div>
                            </div>

                            <div class="media">
                                <div class="wf-100 border d-flex mr-3">
                                    <a target="_blank" rel="nofollow" href="http://kinhdoanh.vnexpress.net/tin-tuc/ebank/thanh-toan-dien-tu/ung-dung-ket-noi-vay-von-ngang-hang-3515864.html">
                                        <img class="img-fluid" src="files/images/P2P_Lending.jpg" alt="">
                                    </a>
                                </div>
                                <div class="media-body">
                                    <h3 class="news__title fw-4 fs-14 mb-0">
                                        <a target="_blank" rel="nofollow" href="http://kinhdoanh.vnexpress.net/tin-tuc/ebank/thanh-toan-dien-tu/ung-dung-ket-noi-vay-von-ngang-hang-3515864.html">
                                            Ứng dụng kết nối vay vốn ngang hàng
                                        </a>
                                    </h3>
                                </div>
                            </div>
                        </div>





                    </div>
                    <div class="tab2-newpr" style="display:none">

                        <div class="news fs-14 mb-4">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <div class="d-flex justify-content-center wf-100 w-100">
                                    <img src="files/images/cafe.jpg" alt="" height="18px">
                                </div>
                                <div class="news__time text-gray-lighter">
                                    20/12/2016 13:30
                                </div>
                            </div>

                            <div class="media">
                                <div class="wf-100 border d-flex mr-3">
                                    <a target="_blank" rel="nofollow" href="http://cafef.vn/mo-hinh-cho-vay-ngang-hang-bung-no-tai-viet-nam-20161220104900499.chn">
                                        <img class="img-fluid" src="files/images/bao1.jpg" alt="">
                                    </a>
                                </div>
                                <div class="media-body">
                                    <h3 class="news__title fw-4 fs-14 mb-0">
                                        <a target="_blank" rel="nofollow" href="http://cafef.vn/mo-hinh-cho-vay-ngang-hang-bung-no-tai-viet-nam-20161220104900499.chn">
                                            Mô hình cho vay ngang hàng bùng nổ tại Việt Nam
                                        </a>
                                    </h3>
                                </div>
                            </div>
                        </div>


                        <hr>
                        <div class="news fs-14 mb-4">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <div class="d-flex justify-content-center wf-100 w-100">
                                    <img src="http://vneconomictimes.com:8081/images/economic_01.png" alt="" height="18px">
                                </div>
                                <div class="news__time text-gray-lighter">
                                    23/12/2016 15:25
                                </div>
                            </div>

                            <div class="media">
                                <div class="wf-100 border d-flex mr-3">
                                    <a target="_blank" rel="nofollow" href="http://vneconomictimes.com:8081/article/business/more-than-500mn-in-loans-provided-via-tima-financial#">
                                        <img class="img-fluid" src="http://vneconomictimes.com:8081/uploads/media/images/2017/December/_MG_2199.JPG" alt="">
                                    </a>
                                </div>
                                <div class="media-body">
                                    <h3 class="news__title fw-4 fs-14 mb-0">
                                        <a target="_blank" rel="nofollow" href="http://vneconomictimes.com:8081/article/business/more-than-500mn-in-loans-provided-via-tima-financial">
                                            More than $500mn in loans provided via Lending Financial
                                        </a>
                                    </h3>
                                </div>
                            </div>
                        </div>


                        <hr>
                        <div class="news fs-14 mb-4">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <div class="d-flex justify-content-center wf-100 w-100">
                                    <img src="https://static.techinasia.com/assets/e48e1cf01d8dc53f5f977120efbdfe7e/1edc904cfe7c965859a475f15430145b.svg" alt="" height="18px">
                                </div>
                                <div class="news__time text-gray-lighter">
                                    19/12/2016 11:30
                                </div>
                            </div>

                            <div class="media">
                                <div class="wf-100 border d-flex mr-3">
                                    <a target="_blank" rel="nofollow" href="https://www.techinasia.com/tima-vietnam-series-a-funding">
                                        <img class="img-fluid" src="https://cdn.techinasia.com/wp-content/uploads/2016/12/vietnamese-dong.jpg" alt="">
                                    </a>
                                </div>
                                <div class="media-body">
                                    <h3 class="news__title fw-4 fs-14 mb-0">
                                        <a target="_blank" rel="nofollow" href="https://www.techinasia.com/tima-vietnam-series-a-funding">
                                            Vietnamese startup scores series A to give people easy access to loans
                                        </a>
                                    </h3>
                                </div>
                            </div>
                        </div>

                        <hr>
                        <div class="news fs-14 mb-4">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <div class="d-flex justify-content-center wf-100 w-100">
                                    <img src="https://cdn.dealstreetasia.com/wp-content/themes/dealstreetasia/images/dsa_new_logo_200x100.jpg" alt="" height="18px">
                                </div>
                                <div class="news__time text-gray-lighter">
                                    20/12/2016 13:30
                                </div>
                            </div>

                            <div class="media">
                                <div class="wf-100 border d-flex mr-3">
                                    <a target="_blank" rel="nofollow" href="https://www.dealstreetasia.com/stories/vietnams-p2p-platform-tima-grabs-7-digit-funding-from-singapore-fund-60867/">
                                        <img class="img-fluid" src="https://i-kinhdoanh.vnecdn.net/2016/12/20/Image-258067877-ExtractWord-1-3569-9432-1482206174.png" alt="">
                                    </a>
                                </div>
                                <div class="media-body">
                                    <h3 class="news__title fw-4 fs-14 mb-0">
                                        <a target="_blank" rel="nofollow" href="https://www.dealstreetasia.com/stories/vietnams-p2p-platform-tima-grabs-7-digit-funding-from-singapore-fund-60867/">
                                            Vietnam: P2P lending startup Lending gets funding from Singapore investor
                                        </a>
                                    </h3>
                                </div>
                            </div>
                        </div>

                        <hr>
                        <div class="news fs-14 mb-4">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <div class="d-flex justify-content-center wf-100 w-100">
                                    <img src="files/images/ncdt.png" alt="" height="18px">
                                </div>
                                <div class="news__time text-gray-lighter">
                                    19/12/2016 17:02
                                </div>
                            </div>

                            <div class="media">
                                <div class="wf-100 border d-flex mr-3">
                                    <a target="_blank" rel="nofollow" href="http://nhipcaudautu.vn/cong-nghe/ict/startup-fintech-viet-nam-nhan-von-trieu-usd-tu-quy-ngoai-3317281/">
                                        <img class="img-fluid" src="files/images/bao1.jpg" alt="">
                                    </a>
                                </div>
                                <div class="media-body">
                                    <h3 class="news__title fw-4 fs-14 mb-0">
                                        <a target="_blank" rel="nofollow" href="http://nhipcaudautu.vn/cong-nghe/ict/startup-fintech-viet-nam-nhan-von-trieu-usd-tu-quy-ngoai-3317281/">
                                            Startup fintech Việt Nam nhận vốn triệu USD từ quỹ ngoại
                                        </a>
                                    </h3>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div style="float:right" class="d-flex">
                        <nav class="d-flex justify-content-between ml-lg-2" aria-label="Page navigation">
                            <ul style="margin-right:0 !important" class="pagination pagination-sm mb-0 mr-3">
                                <li class="page-item page-item--prev d-flex">
                                    <a class="page-link" href="#">1</a>
                                </li>

                                <li class="page-item page-item--next d-flex">
                                    <a class="page-link" href="#">2</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                    <script>
                        function paged(i) {
                            //$(".page-link:before").css("border-color", " #666");
                            //$("." + $(this).attr("class") + ":before").css("border-color", " #ccc");
                            if (i == 1) {
                                $('.tab2-newpr').hide(); $('.tab1-newpr').show();
                            } else {
                                $('.tab1-newpr').hide(); $('.tab2-newpr').show();
                            }
                        }
                    </script>

                </div>





            </div>

        </div>
    </div>
</div>
@include('frontend.common.service')
@stop