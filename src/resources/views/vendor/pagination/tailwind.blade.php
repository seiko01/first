@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="flex items-center justify-center space-x-1">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span class="px-3 py-1 text-gray-400 bg-gray-100 border border-gray-300 rounded cursor-default">&laquo;</span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="px-3 py-1 text-gray-700 bg-white border border-gray-300 rounded hover:bg-gray-100">&laquo;</a>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <span class="px-3 py-1 text-gray-400 bg-gray-100 border border-gray-300 rounded cursor-default">{{ $element }}</span>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span class="px-3 py-1 text-white bg-gray-600 border border-gray-300 rounded cursor-default">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}" class="px-3 py-1 text-gray-700 bg-white border border-gray-300 rounded hover:bg-gray-100">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="px-3 py-1 text-gray-700 bg-white border border-gray-300 rounded hover:bg-gray-100">&raquo;</a>
        @else
            <span class="px-3 py-1 text-gray-400 bg-gray-100 border border-gray-300 rounded cursor-default">&raquo;</span>
        @endif
    </nav>
@endif
