<div class="m-list-search__results">
    @if ($total == 0)
        <span class="m-list-search__result-message m--hide">
            Không tìm thấy kết quả
        </span>
    @else
        @foreach ($data as $element)
        <a href="{{ $element['url'] }}" class="m-list-search__result-category m-list-search__result-category--first">
            {{ $element['name'] }}
        </a>
            @if ($element['sub_name'] || $element['sub_name'] != '')
                <label class="m-list-search__result-item">
                    <span class="m-list-search__result-item-icon"><i class="flaticon-share m--font-success"></i></span>
                    <span class="m-list-search__result-item-text">{{ $element['sub_name'] }}</span>
                </label>
            @endif
            @if ($element['description'] || $element['description'] != '')
            <label class="m-list-search__result-item">
                <span class="m-list-search__result-item-icon"><i class="flaticon-paper-plane m--font-info"></i></span>
                <span class="m-list-search__result-item-text">{{ $element['description'] }}</span>
            </label>
            @endif
        @endforeach
    @endif
</div>
