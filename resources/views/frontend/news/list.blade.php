@extends('frontend.app')
@section('title','Danh sách tin')

@section('content')
<div class="px-content">
    <div class="page-header p-y-4 text-xs-center">
        <h1 class="font-weight-bold">TIN TỨC THỊ TRƯỜNG</h1>
        <ul class="hero-area-tree">
            <li><a href="index.html">Trang chủ</a></li>
            <li>Tin tức thị trường</li>
        </ul>
    </div>
    <!-- Post -->
    <div class="col-md-8 col-lg-9">
        <div id="list-news">
            @foreach ($data as $element)
                <div class="panel page-blog-posts-item">
                    <div class="panel-body p-b-0">
                        <h2 class="font-weight-bold text-default m-a-0"><a href="{{ action('Frontends\News\NewsController@getDetail', $element->slug) }}">{{ $element->title }}</a></h2>
                        <div class="m-t-1"><span class="text-muted">Đăng bởi</span> <a href="#">{{ $element->getAuthor->fullname }}</a><span class="text-muted">&nbsp;&nbsp;·&nbsp;&nbsp;{{ $element->send_at }}</span></div>
                    </div>
                    <div class="page-blog-posts-image">
                        <img src="{{ $element->image_url }}" alt="" width="100%">
                    </div>
                    <div class="page-blog-posts-content panel-body">
                        <p>
                            {{ $element->description }}
                        </p>
                    </div>
                    <div class="panel-body p-y-0">
                        <a href="{{ action('Frontends\News\NewsController@getDetail', $element->slug) }}">Xem thêm...</a>
                    </div>
                    <div class="panel-body clearfix">
                        <div class="pull-md-left">
                            @foreach ($element->tags as $val)
                                <a href="#" class="label label-outline">{{ $val->tag }}</a>
                            @endforeach
                        </div>
                        <!-- Spacing -->
                        <div class="m-t-1"></div>
                        <div class="pull-md-right text-muted">
                            <a href="#"><i class="fa fa-comment-o"></i> 7</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        {{-- {{ $data->links('frontend.pagination.paginate') }} --}}
        <!-- / Post -->

        <input type="hidden" id="current-page" name="page" value="{{ $data->currentPage() }}">
        <input type="hidden" id="category" name="category" value="{{ Request::segment(3) }}">
        <input type="hidden" id="last-page" name="last-page" value="{{ $data->lastPage() }}">
        @if ($data->total() > 0)
            <a id="view-more" class="widget-more-link b-a-1 font-size-14 font-weight-normal">Xem thêm</a>
        @endif
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
<script type="text/javascript">
    $(document).ready(function() {
        $('#view-more').click(function() {
            var currentPage = parseInt($('#current-page').val());
            currentPage += 1;
            var category = $('#category').val();
            $.ajax({
                method: "GET",
                url: '/news/view-more?next-page=' + currentPage + '&category=' + category,
            })
            .done(function(data) {
                var lastPage = parseInt($('#last-page').val());
                $(data).appendTo('#list-news');
                $('#current-page').attr("value", currentPage);
                if (currentPage >= lastPage) {
                    $( "#view-more" ).hide();
                }
            });
        });
    });
</script>
@stop