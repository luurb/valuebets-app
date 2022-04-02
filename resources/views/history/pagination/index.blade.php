 @if ($paginator->hasPages())
    <span class="pagination__nav">
        @if ($paginator->onFirstPage())
            <span class="pagination__nav-angle">
                <i class="fa-solid fa-angle-left"></i>
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}">
                <span class="pagination__nav-angle">
                    <i class="fa-solid fa-angle-left"></i>
                </span>
            </a>
        @endif
        <span class="pagination__nav-current">{{ $paginator->currentPage() }}</span>
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}">
                <span class="pagination__nav-angle">
                    <i class="fa-solid fa-angle-right"></i>
                </span>
            </a>
        @else
            <span class="pagination__nav-angle">
                <i class="fa-solid fa-angle-right"></i>
            </span>
        @endif
    </span>
 @endif