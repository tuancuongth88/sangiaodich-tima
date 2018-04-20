@extends('frontend.app')
@section('title', !empty($title) ? $title : 'Có lỗi xảy ra!')

@section('content')
    <div class="container py-5">
        <div class="tm-noti bg-white p-md-5 pt-md-4 p-3" style="min-height:50vh;">
            <h1 style="text-align:center;color:#f05123;font-size:36px;">{{ !empty($title) ? $title : 'Có lỗi xảy ra!' }}</h1>
            <br>
            <h3 style="color:#808080;text-align:center;font-size:26px;padding:0px 50px">
                {{ !empty($message) ? $message : '' }}
            </h3>
        </div>
    </div>
@stop