@extends('frontend.app')
@section('title','Hỏi đáp')

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
    <div class="tm-faq" style="min-height: 550px;">
        <div class="tm-faq__header d-flex flex-column flex-sm-row justify-content-between align-items-sm-center bg-white border border-gray px-sm-5 px-3 py-3 mb-0">
            <h2 class="tm-faq__title text-uppercase fs-16 fw-6 mb-3 mb-sm-0">Hỏi đáp</h2>
           
        </div>
        <div class="tm-faq__body row no-gutters">
            <div class="col-lg-3 navbar-toggleable-md">
                <div class="bg-white border border-gray border-top-0 hidden-lg-up">
                    <button id="aside-nav-toggle" class="hamburger hamburger--slider main-nav-toggle collapsed ml-sm-3" data-toggle="collapse" data-target="#aside-nav-left" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="hamburger-box d-block">
                    <span class="hamburger-inner"></span>
                    </span>
                    </button>
                </div>
                <nav id="aside-nav-left" class="aside-nav aside-nav--left collapse">
                    <ul class="nav nav-pills flex-column" id="ul-left">
                        @foreach ($listData as $element)
                            <li class="nav-item">
                                <a class="nav-link py-xl-4 py-3 px-5 active" href="{{ route('guide.show', ['id' => $element->id]) }}">{{ $element->question }}</a>
                            </li>
                        @endforeach
                    </ul>
                </nav>
            </div>
            <div class="col-lg-9 border border-gray border-top-0 bg-white">
                <div id="accordion" class="accordion p-sm-5 p-3">
                    <div class="card">
                        <h5>{{ $data->question }}</h5><br>
                        {!! $data->answer !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('frontend.common.service')
@stop