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
    <div class="tm-faq" style="min-height: 550px;">
        <div class="tm-faq__header d-flex flex-column flex-sm-row justify-content-between align-items-sm-center bg-white border border-gray px-sm-5 px-3 py-3 mb-0">
            <h2 class="tm-faq__title text-uppercase fs-16 fw-6 mb-3 mb-sm-0">Trung tâm trợ giúp</h2>
            <div class="tm-faq__header-search search__input-group input-group">
                <input type="text" class="search__form-control form-control fs-14" id="txtSearch" placeholder="Nhập từ khóa tìm kiếm">
                <span class="search__group-btn input-group-btn">
                <button class="search__btn btn" type="button" onclick="Search()">
                <i class="search__icon-search icon-search"></i>
                </button>
                </span>
            </div>
            <div class="d-flex align-items-center fs-14 hidden-md-down">
                Tìm kiếm phổ biến:
                <ul class="list-h-1 mb-0 ml-3">
                    <li class="list-h-1__item">
                        <a class="list-h-1__link text-primary" href="javascript:void(0)" onclick="SearchTop('vay tín chấp')">
                        vay tín chấp
                        </a>
                    </li>
                    <li class="list-h-1__item">
                        <a class="list-h-1__link text-primary" href="javascript:void(0)" onclick="SearchTop('giải ngân')">
                        giải ngân
                        </a>
                    </li>
                    <li class="list-h-1__item">
                        <a class="list-h-1__link text-primary" href="javascript:void(0)" onclick="SearchTop('đăng ký vay')">
                        đăng ký vay
                        </a>
                    </li>
                </ul>
            </div>
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
                        @foreach ($data as $element)
                            <li class="nav-item">
                                <a class="nav-link py-xl-4 py-3 px-5 active" href="javascript:void(0)" onclick="GetQuestionAnswer(this,1)" id="1">{{ $element->name }}</a>
                            </li>
                        @endforeach
                    </ul>
                </nav>
            </div>
            <div class="col-lg-9 border border-gray border-top-0 bg-white">
                @foreach ($data as $element)
                <div id="accordion" class="accordion p-sm-5 p-3" role="tablist" aria-multiselectable="true">
                    @if (isset($element->list))
                        @foreach ($element->list as $key => $item)
                            <div class="card">
                                <h5 class="mb-0">
                                    <a class="card-header d-block fs-14 " role="tab" data-toggle="collapse" data-parent="#accordion" href="#faq-accordion-0" aria-expanded="true" aria-controls="collapseOne">
                                    {{ $key + 1 }}. {{ $item->question }}
                                    </a>
                                </h5>
                                <div id="faq-accordion-0" class="collapse" role="tabpanel" aria-labelledby="">
                                    <div class="card-block fs-14">
                                        <meta charset="utf-8">
                                        {!! $item->answer !!}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@include('frontend.common.service')
@stop