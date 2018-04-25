@extends('frontend.app')
@section('title', $data['title'])

@section('content')

@section('content')
    <div class="container py-5">
        <div class="tm-about bg-white p-md-5 pt-md-4 p-3">
            <h1 class="fs-16 fw-6 mb-0">
                {{$data['title']}}
            </h1>
            {!! $data['body'] !!}
        </div>
    </div>
@stop