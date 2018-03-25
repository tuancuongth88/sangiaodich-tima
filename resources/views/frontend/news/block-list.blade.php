@foreach ($data as $element)
    <div class="panel page-blog-posts-item">
        <div class="panel-body p-b-0">
            <h2 class="font-weight-bold text-default m-a-0"><a href="{{ action('Frontends\News\NewsController@getDetail', $element->id) }}">{{ $element->title }}</a></h2>
            <div class="m-t-1"><span class="text-muted">Đăng bởi</span> <a href="#">{{ $element->getAuthor->fullname }}</a><span class="text-muted">&nbsp;&nbsp;·&nbsp;&nbsp;{{ $element->send_at }}</span></div>
        </div>
        <div class="page-blog-posts-image">
            <img src="{{ $element->image_url }}" alt="">
        </div>
        <div class="page-blog-posts-content panel-body">
            <p>
                {{ $element->description }}
            </p>
        </div>
        <div class="panel-body p-y-0">
            <a href="{{ action('Frontends\News\NewsController@getDetail', $element->id) }}">Xem thêm...</a>
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