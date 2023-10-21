@if($totalCount > $limitOnPage)
    @for($i = 0; $i < $totalCount; $i += $limitOnPage)
        <a href="{{ route('posts', ['page' => $i/$limitOnPage]) }}">
            {{ ($i/$limitOnPage) + 1 }}
        </a>
    @endfor
@endif