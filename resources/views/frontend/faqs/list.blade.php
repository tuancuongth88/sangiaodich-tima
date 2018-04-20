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
                        @foreach ($listCategory as $element)
                            <li class="nav-item">
                                <a class="nav-link py-xl-4 py-3 px-5 active" href="{{ route('question.show', ['id' => $element->id]) }}">{{ $element->name }}</a>
                            </li>
                        @endforeach
                    </ul>
                </nav>
            </div>
            <div class="col-lg-9 border border-gray border-top-0 bg-white">
                <div class="accordion p-sm-5 p-3">
                    @foreach ($listData as $key => $item)
                        <div class="card">
                            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                                <div class="panel panel-default">
                                    <div class="panel-heading" role="tab" id="headingOne{{ $item->id }}">
                                        <h5 class="mb-0">
                                            <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne{{ $item->id }}" aria-expanded="true" aria-controls="collapseOne{{ $item->id }}" class="card-header d-block fs-14">
                                            {{ $item->question }}
                                            </a>
                                        </h5>
                                    </div>
                                    <div id="collapseOne{{ $item->id }}" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne{{ $item->id }}">
                                        <div class="panel-body">
                                            {!! $item->answer !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
        </div>
    </div>
</div>
@include('frontend.common.service')
@stop