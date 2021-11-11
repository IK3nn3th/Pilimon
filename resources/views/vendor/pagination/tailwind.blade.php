@if ($paginator->hasPages())
    <nav class="pagination is-centered " role="navigation" aria-label="pagination">
   
        {{-- Pagination Elements --}}
        <ul class="pagination-list ">
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li><span class="pagination-ellipsis">&hellip;</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <li><a class="pagination-link is-current " aria-label="Goto page {{ $page }}">{{ $page }}</a></li>
                            @else
                                <li><a href="{{ $url }}" class="pagination-link has-background-white" aria-label="Goto page {{ $page }}">{{ $page }}</a></li>
                            @endif
                        @endforeach
                @endif
            @endforeach
        </ul>

    </nav>
@endif