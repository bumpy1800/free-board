@if ($paginator->hasPages())
    <nav style="display: inline-block;">
        <ul class="pagination" style="margin-bottom: 0px;">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="disabled" aria-disabled="true"><span><i class="fa fa-arrow-left" aria-hidden="true"></i></span></li>
            @else
                <li class=".prev"><a id="m-prev" href="{{ $paginator->previousPageUrl() }}" rel="prev"><i class="fa fa-arrow-left" aria-hidden="true"></i></a></li>
            @endif

            &nbsp;<li class="currentPage">{{ $paginator->currentPage() }}/{{ $paginator->lastPage() }}</li>&nbsp;

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class=".next"><a id="m-next" href="{{ $paginator->nextPageUrl() }}" rel="next"><i class="fa fa-arrow-right" aria-hidden="true"></i></a></li>
            @else
                <li class="disabled" aria-disabled="true"><span><i class="fa fa-arrow-right" aria-hidden="true"></i></span></li>
            @endif
        </ul>
    </nav>
@endif
