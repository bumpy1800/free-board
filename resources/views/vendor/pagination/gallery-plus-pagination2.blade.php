@if ($paginator->hasPages())
    <nav style="display: inline-block; margin-right: 10px;">
        <ul class="pagination" style="margin-bottom: 0px;">
            &nbsp;
            <li><b><a class="lg-next" href="{{ $paginator->nextPageUrl() }}" onclick="return false;">
                {{ $paginator->firstItem() + 10 }}위 - {{ $paginator->lastItem() + 10 }}위
            </a></b></li>&nbsp;
        </ul>
    </nav>
@endif
