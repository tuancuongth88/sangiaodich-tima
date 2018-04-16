@extends('frontend.app')
@section('title','About Us')

@section('content')

@section('content')
    <div class="container py-5">
        <div class="tm-about bg-white p-md-5 pt-md-4 p-3">
            <h2 class="text-uppercase fs-16 fw-6 mb-0">
                {{$data['title']}}
            </h2>
            {{$data['description']}}
        </div>
    </div>
@stop
