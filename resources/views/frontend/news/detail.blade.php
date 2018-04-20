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

            </div>

        </div>
    </div>
</div>
@include('frontend.common.service')
@stop