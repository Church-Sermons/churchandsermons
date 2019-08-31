@if ($paginator->hasPages())
    <nav class="pagination is-centered" role="navigation" aria-label="pagination">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <a href="#" class="pagination-previous" rel="prev" aria-label="@lang('pagination.previous')" disabled>
                Previous
            </a>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class="pagination-previous" rel="prev" aria-label="@lang('pagination.previous')">Previous</a>
        @endif

         {{-- Next Page Link --}}
         @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="pagination-next" rel="next" aria-label="@lang('pagination.next')">Next</a>
        @else
            <a href="#" class="pagination-next" aria-disabled="true" aria-label="@lang('pagination.next')" disabled>Next</a>
        @endif

        <ul class="pagination-list">
            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li disabled aria-disabled="true"><span class="pagination-ellipsis">{{ $element }}</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li aria-current="page"><a class="pagination-link is-current">{{ $page }}</a></li>
                        @else
                            <li><a class="pagination-link" href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach
        </nav>



    </ul>
@endif
