@extends('frontend.app')
@section('title','Chi tiết bài viết')

@section('content')
<div class="px-content" style="">
    <div class="col-md-8 col-lg-9">
        <div class="page-blog-post-image page-header">
            <img src="{{ $data->image_url }}" alt="" width="100%">
        </div>
        <!-- Post -->
        <div class="page-blog-post-content panel page-block m-b-0 p-x-4 p-b-4 b-a-0 border-radius-0 clearfix">
			{!! $data->content !!}
        </div>
        <!-- / Post -->
        <!-- Post footer -->
        <!-- panel page-block p-x-4 m-b-0  clearfix -->
        <div class="panel page-wide-block p-x-4 p-b-3 b-x-0 b-t-0 border-radius-0 clearfix">
            <a href="#" class="label label-outline">Webdesign</a>
            <a href="#" class="label label-outline">UI / UX</a>
            <a href="#" class="label label-outline">Coding</a>
            <div class="blog-share">
                <h4>Share This Post:</h4>
                <a href="#" class="facebook"><i class="fa fa-facebook"></i></a>
                <a href="#" class="twitter"><i class="fa fa-twitter"></i></a>
                <a href="#" class="google-plus"><i class="fa fa-google-plus"></i></a>
            </div>
            <hr class="page-wide-block m-y-3">
            <div class="row">
                <div class="col-xs-9 col-md-10">
                    <div class="box m-a-0 b-a-0">
                        <div class="box-row valign-middle">
                            <div class="box-cell" style="width: 40px">
                                <img src="{{ $data->getAuthor->avatar }}" alt="" class="border-round" style="width: 100%;">
                            </div>
                            <div class="box-cell p-l-2">
                                <span class="text-muted">Đăng bởi</span> <a href="#">{{ $data->getAuthor->fullname }}</a>
                                <div class="text-muted font-size-11"><strong>{{ $data->send_at }}</strong></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-3 col-md-2 p-t-1 text-xs-right font-size-14 text-muted">
                    <a href="#"><i class="fa fa-heart-o"></i> 45</a>
                </div>
            </div>
        </div>
        <!-- / Post footer -->
        <h4 class="page-block m-t-4 p-x-4">8 comments</h4>
        <hr class="m-b-1">
        <!-- Comments -->

        <!-- / Comments -->
    </div>
    <div class="col-md-4 col-lg-3">
        <div class="panel">
            <div class="panel-heading">
                <span class="panel-title">TIN TỨC MỚI</span>
            </div>
            @foreach ($latest as $value)
                <div class="widget-threads-item">
                    <img src="{{ $value->image_url }}" alt="" class="widget-threads-avatar">
                    <a href="#" class="widget-threads-title">{{ $value->title }}</a>
                </div>
            @endforeach
        </div>
    </div>
</div>
@stop