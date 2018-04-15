@foreach ($data as $element)
    <li class="list-v__item">
        <a class="list-v__link" href="{{ action('Frontends\News\NewsController@getDetail', $element->id) }}">
            {{ $element->question }}
        </a>
    </li>
@endforeach
