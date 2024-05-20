@if ($paginator->hasPages())

@if ($paginator->onFirstPage())
<a class="rounded disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
    &laquo;</span>
</a>
@else

<a href="{{ $paginator->previousPageUrl() }}" class="rounded" rel="prev"
    aria-label="@lang('pagination.previous')">
    &laquo;
</a>

@endif

{{-- Pagination Elements --}}
@foreach ($elements as $element)
{{-- "Three Dots" Separator --}}
@if (is_string($element))

<span class="active rounded" aria-current="page">{{ $element }}</span>

@endif

{{-- Array Of Links --}}
@if (is_array($element))
@foreach ($element as $page => $url)
@if ($page == $paginator->currentPage())
<a href="#" class="active rounded disabled" aria-current="page">{{ $page }}</a>
@else

<a href="{{ $url }}" class="rounded">{{ $page }}</a>
@endif
@endforeach
@endif
@endforeach

{{-- Next Page Link --}}
@if ($paginator->hasMorePages())
<a href="{{ $paginator->nextPageUrl() }}" class="rounded" rel="next" aria-label="@lang('pagination.next')">
    &raquo;
</a>

@else
<a class="rounded disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
    &raquo;
</a>

@endif
@endif
