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
                @foreach ($listCategory as $element)
                    <li class="{{ Request::input('id') == $element->id ? 'active' : '' }}"><a href="{{ route('category.detail', ['id' => $element->id]) }}">{{ $element->name }}</a></li>
                @endforeach
            </ul>
        </div>
        <div class="row">
            <div class="col-main col-lg-9">
                <div class="border border-gray bg-white p-md-5 p-3">
                    <div class="row gutter-2 gutter-md-3 mb-5" id="topnewsinlistpage1">
                        <div class="col-sm-8 mb-5 mb-md-0">
                            @if (isset($listHot[0]))
                            <div class="news">
                                <div class="news__thumbnail border mb-4">
                                    <a href="{{ action('Frontends\News\NewsController@getDetail', $listHot[0]->slug) }}">
                                        <img class="img-fluid" src="{{ $listHot[0]->image_url }}" alt="">
                                    </a>
                                </div>
                                <h3 class="news__title fs-16">
                                    <a href="{{ action('Frontends\News\NewsController@getDetail', $listHot[0]->slug) }}">
                                        {{ $listHot[0]->title }}
                                    </a>
                                </h3>
                                <p class="news__lead fs-14 text-gray-light mb-0">
                                    {{ $listHot[0]->description }}
                                </p>

                            </div>
                            @endif
                        </div>
                        <div class="col-sm-4">
                            @if (isset($listHot[1]))
                                <div class="news mb-5">
                                    <div class="news__thumbnail border mb-2">
                                        <a href="/tin-tuc/nguon-goc-ngay-than-tai-nhung-viec-can-lam-trong-ngay-than-tai-de-duoc-may-man-60.html">
                                            <img class="img-fluid" src="{{ $listHot[1]->image_url }}" alt="">
                                        </a>
                                    </div>

                                    <h3 class="news__title fs-14 fw-4 mb-0">
                                        <a href="{{ action('Frontends\News\NewsController@getDetail', $listHot[1]->slug) }}">
                                            {{ $listHot[1]->title }}
                                        </a>
                                    </h3>
                                </div>
                            @endif
                            @if (isset($listHot[2]))
                                <div class="news mb-5">
                                    <div class="news__thumbnail border mb-2">
                                        <a href="{{ action('Frontends\News\NewsController@getDetail', $listHot[2]->slug) }}">
                                            <img class="img-fluid" src="{{ $listHot[2]->image_url }}" alt="">
                                        </a>
                                    </div>

                                    <h3 class="news__title fs-14 fw-4 mb-0">
                                        <a href="/tin-tuc/8-cach-chi-tieu-tet-tuom-tat-du-day-ma-khong-bi-tham-hut-tai-chinh-55.html">
                                            {{ $listHot[2]->title }}
                                        </a>
                                    </h3>
                                </div>
                            @endif


                        </div>
                    </div>
                    <hr class="my-5">
                    <div class="tm-news__list">
                        <div id="listitemnews">
                            @foreach ($data as $element)
                            <div class="news media flex-column flex-sm-row fs-14 mb-5">
                                <a class="wf-md-200 w-100 w-sm-auto border d-flex align-items-start mr-md-5 mr-sm-3 mb-3 mb-sm-0" href="/tin-tuc/top-nhung-mon-qua-hot-tang-tet-mau-tuat-2018-53.html">
                                    <img class="img-fluid" src="{{ $element->image_url }}" alt="">
                                </a>
                                <div class="media-body">
                                    <h3 class="news__title fw-4 fs-16">
                                        <a class="" href="{{ action('Frontends\News\NewsController@getDetail', $element->slug) }}">
                                            {{ $element->title }}
                                        </a>
                                    </h3>
                                    <p class="news__time text-gray-lighter fw-3 mb-2">
                                        {{ $element->send_at }}
                                    </p>
                                    <p class="news__lead text-gray-light mb-0">
                                        {{ $element->description }}
                                    </p>
                                </div>
                            </div>
                            <hr class="my-5">
                            @endforeach
                        </div>

                        <nav aria-label="Page navigation">


                            {{ $data->links() }}

                            <input name="numberItem" id="numberItem" value="8" type="hidden" />
                            <input name="currentPage" id="currentPage" value="1" type="hidden"/>
                            <input name="totalPage" id="totalPage" value="4" type="hidden" />


                        </nav>
                    </div>
                </div>
            </div>

            <div class="col-aside col-md-3 hidden-md-down">

                <div class="border border-gray bg-white p-5 pt-md-3 mb-5 fs-14">
                    <h3 class="fs-16 fw-6 text-uppercase text-center">
                        Hỏi đáp
                    </h3>

                    <hr>

                    <ul class="list-v">
                        @foreach ($listFaqCategory as $element)
                            <li class="list-v__item">
                                <a class="list-v__link" href="{{ route('question.show', ['id' => $element->id]) }}">
                                    {{ $element->name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>









            </div>

        </div>
    </div>
</div>
@stop