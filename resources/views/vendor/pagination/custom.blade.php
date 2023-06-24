@foreach ($elements as $element)
    <nav class="mt-4 d-flex paginate">
        <ul class="pagination">
            <!-- Array Of Links -->

            @foreach ($element as $page => $url)
                <!--  Use three dots when current page is greater than 4.  -->
                @if ($paginator->currentPage() > 4 && $page === 2)
                    <li class="page-item disabled"><a href="#" class="page-link">...</a></li>
                @endif

                <!--  Show active page else show the first and last two pages from current page.  -->
                @if ($page == $paginator->currentPage())
                    <li class="page-item active"><a href="{{ $url }}" class="page-link">{{ $page }}</a>
                    </li>
                @elseif (
                    $page === $paginator->currentPage() + 1 ||
                        $page === $paginator->currentPage() + 2 ||
                        $page === $paginator->currentPage() - 1 ||
                        $page === $paginator->currentPage() - 5 ||
                        $page === $paginator->lastPage() ||
                        $page === 1)
                    <li class="disabled"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                @endif
                <!--  Use three dots when current page is away from end.  -->
                @if ($paginator->currentPage() < $paginator->lastPage() - 3 && $page === $paginator->lastPage() - 1)
                    <li class="disabled"><a href="#" class="page-link">...</a></li>
                @endif
            @endforeach

        </ul>
    </nav>
@endforeach
{{-- @foreach ($elements as $element)
    <nav class="mt-4 d-flex paginate">
        <ul class="pagination">
            @foreach ($element as $page => $url)
                @if ($paginator->currentPage() > 4 && $page === 2)
                    <li class="page-item disabled"><a href="#" class="page-link">...</a></li>
                @endif

                @if ($page == $paginator->currentPage())
                    <li class="page-item active"><a href="{{ $url }}" class="page-link">{{ $page }}</a>
                    </li>
                @elseif ($page >= $paginator->currentPage() - 2 && $page <= $paginator->currentPage() + 2)
                    <li><a href="{{ $url }}" class="page-link">{{ $page }}</a></li>
                @elseif ($page === $paginator->currentPage() + 3 || $page === $paginator->lastPage() - 1)
                <li class="disabled"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>

                @endif

                @if ($paginator->currentPage() < $paginator->lastPage() - 3 && $page === $paginator->lastPage() - 1)
                    <li class="disabled"><a href="#" class="page-link">...</a></li>
                @endif
            @endforeach
        </ul>
    </nav>
@endforeach --}}
