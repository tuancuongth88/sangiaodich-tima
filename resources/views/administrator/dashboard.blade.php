@extends('administrator.app')
@section('title','DASHBOARD ADMINISTRATOR')

@section('content')
<div class="m-grid__item m-grid__item--fluid m-wrapper">
    <!-- BEGIN: Subheader -->
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title ">
                    Dashboard
                </h3>
            </div>
        </div>
    </div>
    <!-- END: Subheader -->
    <div class="m-content">
        <!--Begin::Section-->
        <div class="m-portlet">
            <div class="m-portlet__body  m-portlet__body--no-padding">
                <div class="row m-row--no-padding m-row--col-separator-xl">
                    <div class="col-xl-4">
                        <!--begin:: Widgets/Stats2-1 -->
                        <div class="m-widget1">
                            <div class="m-widget1__item">
                                <div class="row m-row--no-padding align-items-center">
                                    <div class="col">
                                        <h3 class="m-widget1__title">
                                            Member Profit
                                        </h3>
                                        <span class="m-widget1__desc">
                                            Awerage Weekly Profit
                                        </span>
                                    </div>
                                    <div class="col m--align-right">
                                        <span class="m-widget1__number m--font-brand">
                                                        +$17,800
                                                    </span>
                                    </div>
                                </div>
                            </div>
                            <div class="m-widget1__item">
                                <div class="row m-row--no-padding align-items-center">
                                    <div class="col">
                                        <h3 class="m-widget1__title">
                                            Orders
                                        </h3>
                                        <span class="m-widget1__desc">
                                                        Weekly Customer Orders
                                                    </span>
                                    </div>
                                    <div class="col m--align-right">
                                        <span class="m-widget1__number m--font-danger">
                                                        +1,800
                                                    </span>
                                    </div>
                                </div>
                            </div>
                            <div class="m-widget1__item">
                                <div class="row m-row--no-padding align-items-center">
                                    <div class="col">
                                        <h3 class="m-widget1__title">
                                            Issue Reports
                                        </h3>
                                        <span class="m-widget1__desc">
                                                        System bugs and issues
                                                    </span>
                                    </div>
                                    <div class="col m--align-right">
                                        <span class="m-widget1__number m--font-success">
                                                        -27,49%
                                                    </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end:: Widgets/Stats2-1 -->
                    </div>
                    <div class="col-xl-4">
                        <!--begin:: Widgets/Daily Sales-->
                        <div class="m-widget14">
                            <div class="m-widget14__header m--margin-bottom-30">
                                <h3 class="m-widget14__title">
                                    Daily Sales
                                </h3>
                                <span class="m-widget14__desc">
                                                Check out each collumn for more details
                                            </span>
                            </div>
                            <div class="m-widget14__chart" style="height:120px;">
                                <canvas id="m_chart_daily_sales"></canvas>
                            </div>
                        </div>
                        <!--end:: Widgets/Daily Sales-->
                    </div>
                    <div class="col-xl-4">
                        <!--begin:: Widgets/Profit Share-->
                        <div class="m-widget14">
                            <div class="m-widget14__header">
                                <h3 class="m-widget14__title">
                                    Profit Share
                                </h3>
                                <span class="m-widget14__desc">
                                                Profit Share between customers
                                            </span>
                            </div>
                            <div class="row  align-items-center">
                                <div class="col">
                                    <div id="m_chart_profit_share" class="m-widget14__chart" style="height: 160px">
                                        <div class="m-widget14__stat">
                                            45
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="m-widget14__legends">
                                        <div class="m-widget14__legend">
                                            <span class="m-widget14__legend-bullet m--bg-accent"></span>
                                            <span class="m-widget14__legend-text">
                                                            37% Sport Tickets
                                                        </span>
                                        </div>
                                        <div class="m-widget14__legend">
                                            <span class="m-widget14__legend-bullet m--bg-warning"></span>
                                            <span class="m-widget14__legend-text">
                                                            47% Business Events
                                                        </span>
                                        </div>
                                        <div class="m-widget14__legend">
                                            <span class="m-widget14__legend-bullet m--bg-brand"></span>
                                            <span class="m-widget14__legend-text">
                                                            19% Others
                                                        </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end:: Widgets/Profit Share-->
                    </div>
                </div>
            </div>
        </div>
        <!--End::Section-->
        <!--Begin::Section-->
        <div class="row">
            <div class="col-xl-4">
                <!--begin:: Widgets/Sales Stats-->
                <div class="m-portlet m-portlet--bordered-semi m-portlet--full-height ">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <h3 class="m-portlet__head-text">
                                    Sales Stats
                                </h3>
                            </div>
                        </div>
                        <div class="m-portlet__head-tools">
                            <ul class="m-portlet__nav">
                                <li class="m-portlet__nav-item m-portlet__nav-item--last m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push" data-dropdown-toggle="hover">
                                    <a href="#" class="m-portlet__nav-link m-portlet__nav-link--icon m-portlet__nav-link--icon-xl">
                                        <i class="fa fa-genderless m--font-brand"></i>
                                    </a>
                                    <div class="m-dropdown__wrapper">
                                        <span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
                                        <div class="m-dropdown__inner">
                                            <div class="m-dropdown__body">
                                                <div class="m-dropdown__content">
                                                    <ul class="m-nav">
                                                        <li class="m-nav__section m-nav__section--first">
                                                            <span class="m-nav__section-text">
                                                                            Quick Actions
                                                                        </span>
                                                        </li>
                                                        <li class="m-nav__item">
                                                            <a href="" class="m-nav__link">
                                                                <i class="m-nav__link-icon flaticon-share"></i>
                                                                <span class="m-nav__link-text">
                                                                                Activity
                                                                            </span>
                                                            </a>
                                                        </li>
                                                        <li class="m-nav__item">
                                                            <a href="" class="m-nav__link">
                                                                <i class="m-nav__link-icon flaticon-chat-1"></i>
                                                                <span class="m-nav__link-text">
                                                                                Messages
                                                                            </span>
                                                            </a>
                                                        </li>
                                                        <li class="m-nav__item">
                                                            <a href="" class="m-nav__link">
                                                                <i class="m-nav__link-icon flaticon-info"></i>
                                                                <span class="m-nav__link-text">
                                                                                FAQ
                                                                            </span>
                                                            </a>
                                                        </li>
                                                        <li class="m-nav__item">
                                                            <a href="" class="m-nav__link">
                                                                <i class="m-nav__link-icon flaticon-lifebuoy"></i>
                                                                <span class="m-nav__link-text">
                                                                                Support
                                                                            </span>
                                                            </a>
                                                        </li>
                                                        <li class="m-nav__separator m-nav__separator--fit"></li>
                                                        <li class="m-nav__item">
                                                            <a href="#" class="btn btn-outline-danger m-btn m-btn--pill m-btn--wide btn-sm">
                                                                            Cancel
                                                                        </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        <!--begin::Widget 6-->
                        <div class="m-widget15">
                            <div class="m-widget15__chart" style="height:180px;">
                                <canvas id="m_chart_sales_stats"></canvas>
                            </div>
                            <div class="m-widget15__items">
                                <div class="row">
                                    <div class="col">
                                        <div class="m-widget15__item">
                                            <span class="m-widget15__stats">
                                                            63%
                                                        </span>
                                            <span class="m-widget15__text">
                                                            Sales Grow
                                                        </span>
                                            <div class="m--space-10"></div>
                                            <div class="progress m-progress--sm">
                                                <div class="progress-bar bg-danger" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="m-widget15__item">
                                            <span class="m-widget15__stats">
                                                            54%
                                                        </span>
                                            <span class="m-widget15__text">
                                                            Orders Grow
                                                        </span>
                                            <div class="m--space-10"></div>
                                            <div class="progress m-progress--sm">
                                                <div class="progress-bar bg-warning" role="progressbar" style="width: 40%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="m-widget15__item">
                                            <span class="m-widget15__stats">
                                                            41%
                                                        </span>
                                            <span class="m-widget15__text">
                                                            Profit Grow
                                                        </span>
                                            <div class="m--space-10"></div>
                                            <div class="progress m-progress--sm">
                                                <div class="progress-bar bg-success" role="progressbar" style="width: 55%;" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="m-widget15__item">
                                            <span class="m-widget15__stats">
                                                            79%
                                                        </span>
                                            <span class="m-widget15__text">
                                                            Member Grow
                                                        </span>
                                            <div class="m--space-10"></div>
                                            <div class="progress m-progress--sm">
                                                <div class="progress-bar bg-primary" role="progressbar" style="width: 60%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="m-widget15__desc">
                                * lorem ipsum dolor sit amet consectetuer sediat elit
                            </div>
                        </div>
                        <!--end::Widget 6-->
                    </div>
                </div>
                <!--end:: Widgets/Sales Stats-->
            </div>
            <div class="col-xl-4">
                <!--begin:: Widgets/Inbound Bandwidth-->
                <div class="m-portlet m-portlet--bordered-semi m-portlet--half-height m-portlet--fit " style="min-height: 300px">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <h3 class="m-portlet__head-text">
                                    Inbound Bandwidth
                                </h3>
                            </div>
                        </div>
                        <div class="m-portlet__head-tools">
                            <ul class="m-portlet__nav">
                                <li class="m-portlet__nav-item m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push" data-dropdown-toggle="hover" aria-expanded="true">
                                    <a href="#" class="m-portlet__nav-link m-dropdown__toggle dropdown-toggle btn btn--sm m-btn--pill btn-secondary m-btn m-btn--label-brand">
                                                    Today
                                                </a>
                                    <div class="m-dropdown__wrapper">
                                        <span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust" style="left: auto; right: 36.5px;"></span>
                                        <div class="m-dropdown__inner">
                                            <div class="m-dropdown__body">
                                                <div class="m-dropdown__content">
                                                    <ul class="m-nav">
                                                        <li class="m-nav__item">
                                                            <a href="" class="m-nav__link">
                                                                <i class="m-nav__link-icon flaticon-share"></i>
                                                                <span class="m-nav__link-text">
                                                                                Activity
                                                                            </span>
                                                            </a>
                                                        </li>
                                                        <li class="m-nav__item">
                                                            <a href="" class="m-nav__link">
                                                                <i class="m-nav__link-icon flaticon-chat-1"></i>
                                                                <span class="m-nav__link-text">
                                                                                Messages
                                                                            </span>
                                                            </a>
                                                        </li>
                                                        <li class="m-nav__item">
                                                            <a href="" class="m-nav__link">
                                                                <i class="m-nav__link-icon flaticon-info"></i>
                                                                <span class="m-nav__link-text">
                                                                                FAQ
                                                                            </span>
                                                            </a>
                                                        </li>
                                                        <li class="m-nav__item">
                                                            <a href="" class="m-nav__link">
                                                                <i class="m-nav__link-icon flaticon-lifebuoy"></i>
                                                                <span class="m-nav__link-text">
                                                                                Support
                                                                            </span>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        <!--begin::Widget5-->
                        <div class="m-widget20">
                            <div class="m-widget20__number m--font-success">
                                670
                            </div>
                            <div class="m-widget20__chart" style="height:160px;">
                                <canvas id="m_chart_bandwidth1"></canvas>
                            </div>
                        </div>
                        <!--end::Widget 5-->
                    </div>
                </div>
                <!--end:: Widgets/Inbound Bandwidth-->
                <div class="m--space-30"></div>
                <!--begin:: Widgets/Outbound Bandwidth-->
                <div class="m-portlet m-portlet--bordered-semi m-portlet--half-height m-portlet--fit " style="min-height: 300px">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <h3 class="m-portlet__head-text">
                                    Outbound Bandwidth
                                </h3>
                            </div>
                        </div>
                        <div class="m-portlet__head-tools">
                            <ul class="m-portlet__nav">
                                <li class="m-portlet__nav-item m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push" data-dropdown-toggle="hover" aria-expanded="true">
                                    <a href="#" class="m-portlet__nav-link m-dropdown__toggle dropdown-toggle btn btn--sm m-btn--pill btn-secondary m-btn m-btn--label-brand">
                                                    Today
                                                </a>
                                    <div class="m-dropdown__wrapper">
                                        <span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust" style="left: auto; right: 36.5px;"></span>
                                        <div class="m-dropdown__inner">
                                            <div class="m-dropdown__body">
                                                <div class="m-dropdown__content">
                                                    <ul class="m-nav">
                                                        <li class="m-nav__item">
                                                            <a href="" class="m-nav__link">
                                                                <i class="m-nav__link-icon flaticon-share"></i>
                                                                <span class="m-nav__link-text">
                                                                                Activity
                                                                            </span>
                                                            </a>
                                                        </li>
                                                        <li class="m-nav__item">
                                                            <a href="" class="m-nav__link">
                                                                <i class="m-nav__link-icon flaticon-chat-1"></i>
                                                                <span class="m-nav__link-text">
                                                                                Messages
                                                                            </span>
                                                            </a>
                                                        </li>
                                                        <li class="m-nav__item">
                                                            <a href="" class="m-nav__link">
                                                                <i class="m-nav__link-icon flaticon-info"></i>
                                                                <span class="m-nav__link-text">
                                                                                FAQ
                                                                            </span>
                                                            </a>
                                                        </li>
                                                        <li class="m-nav__item">
                                                            <a href="" class="m-nav__link">
                                                                <i class="m-nav__link-icon flaticon-lifebuoy"></i>
                                                                <span class="m-nav__link-text">
                                                                                Support
                                                                            </span>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        <!--begin::Widget5-->
                        <div class="m-widget20">
                            <div class="m-widget20__number m--font-warning">
                                340
                            </div>
                            <div class="m-widget20__chart" style="height:160px;">
                                <canvas id="m_chart_bandwidth2"></canvas>
                            </div>
                        </div>
                        <!--end::Widget 5-->
                    </div>
                </div>
                <!--end:: Widgets/Outbound Bandwidth-->
            </div>
            <div class="col-xl-4">
                <!--begin:: Widgets/Top Products-->
                <div class="m-portlet m-portlet--full-height m-portlet--fit ">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <h3 class="m-portlet__head-text">
                                    Top Products
                                </h3>
                            </div>
                        </div>
                        <div class="m-portlet__head-tools">
                            <ul class="m-portlet__nav">
                                <li class="m-portlet__nav-item m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push" data-dropdown-toggle="hover" aria-expanded="true">
                                    <a href="#" class="m-portlet__nav-link m-dropdown__toggle dropdown-toggle btn btn--sm m-btn--pill btn-secondary m-btn m-btn--label-brand">
                                                    All
                                                </a>
                                    <div class="m-dropdown__wrapper">
                                        <span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust" style="left: auto; right: 36.5px;"></span>
                                        <div class="m-dropdown__inner">
                                            <div class="m-dropdown__body">
                                                <div class="m-dropdown__content">
                                                    <ul class="m-nav">
                                                        <li class="m-nav__item">
                                                            <a href="" class="m-nav__link">
                                                                <i class="m-nav__link-icon flaticon-share"></i>
                                                                <span class="m-nav__link-text">
                                                                                Activity
                                                                            </span>
                                                            </a>
                                                        </li>
                                                        <li class="m-nav__item">
                                                            <a href="" class="m-nav__link">
                                                                <i class="m-nav__link-icon flaticon-chat-1"></i>
                                                                <span class="m-nav__link-text">
                                                                                Messages
                                                                            </span>
                                                            </a>
                                                        </li>
                                                        <li class="m-nav__item">
                                                            <a href="" class="m-nav__link">
                                                                <i class="m-nav__link-icon flaticon-info"></i>
                                                                <span class="m-nav__link-text">
                                                                                FAQ
                                                                            </span>
                                                            </a>
                                                        </li>
                                                        <li class="m-nav__item">
                                                            <a href="" class="m-nav__link">
                                                                <i class="m-nav__link-icon flaticon-lifebuoy"></i>
                                                                <span class="m-nav__link-text">
                                                                                Support
                                                                            </span>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        <!--begin::Widget5-->
                        <div class="m-widget4 m-widget4--chart-bottom" style="min-height: 480px">
                            <div class="m-widget4__item">
                                <div class="m-widget4__img m-widget4__img--logo">
                                    <img src="assets/app/media/img/client-logos/logo3.png" alt="">
                                </div>
                                <div class="m-widget4__info">
                                    <span class="m-widget4__title">
                                                    Phyton
                                                </span>
                                    <br>
                                    <span class="m-widget4__sub">
                                                    A Programming Language
                                                </span>
                                </div>
                                <span class="m-widget4__ext">
                                                <span class="m-widget4__number m--font-brand">
                                                    +$17
                                                </span>
                                </span>
                            </div>
                            <div class="m-widget4__item">
                                <div class="m-widget4__img m-widget4__img--logo">
                                    <img src="assets/app/media/img/client-logos/logo1.png" alt="">
                                </div>
                                <div class="m-widget4__info">
                                    <span class="m-widget4__title">
                                                    FlyThemes
                                                </span>
                                    <br>
                                    <span class="m-widget4__sub">
                                                    A Let's Fly Fast Again Language
                                                </span>
                                </div>
                                <span class="m-widget4__ext">
                                                <span class="m-widget4__number m--font-brand">
                                                    +$300
                                                </span>
                                </span>
                            </div>
                            <div class="m-widget4__item">
                                <div class="m-widget4__img m-widget4__img--logo">
                                    <img src="assets/app/media/img/client-logos/logo4.png" alt="">
                                </div>
                                <div class="m-widget4__info">
                                    <span class="m-widget4__title">
                                                    Starbucks
                                                </span>
                                    <br>
                                    <span class="m-widget4__sub">
                                                    Good Coffee & Snacks
                                                </span>
                                </div>
                                <span class="m-widget4__ext">
                                                <span class="m-widget4__number m--font-brand">
                                                    +$300
                                                </span>
                                </span>
                            </div>
                            <div class="m-widget4__chart m-portlet-fit--sides m--margin-top-20" style="height:260px;">
                                <canvas id="m_chart_trends_stats_2"></canvas>
                            </div>
                        </div>
                        <!--end::Widget 5-->
                    </div>
                </div>
                <!--end:: Widgets/Top Products-->
            </div>
        </div>
        <!--End::Section-->

    </div>
</div>
@stop