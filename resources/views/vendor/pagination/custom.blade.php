@if ($paginator->hasPages())
    <div class="flex items-center justify-center py-6">
        <div class="w-full flex items-center justify-between border-t border-gray-200 pt-3">

            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <div class="flex items-center text-gray-500 cursor-not-allowed">
                    <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                        <path d="M14.707 5.293a1 1 0 00-1.414 0l-4 4a1 1 0 000 1.414l4 4a1 1 0 001.414-1.414L11.414 10l3.293-3.293a1 1 0 000-1.414z" />
                    </svg>
                    <p class="text-base ml-3 font-medium">Précédent</p>  
                </div>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" class="flex items-center text-gray-600 hover:text-indigo-700 cursor-pointer">
                    <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                        <path d="M14.707 5.293a1 1 0 00-1.414 0l-4 4a1 1 0 000 1.414l4 4a1 1 0 001.414-1.414L11.414 10l3.293-3.293a1 1 0 000-1.414z" />
                    </svg>
                    <p class="text-base ml-3 font-medium">Précédent</p>
                </a>
            @endif

            {{-- Pagination Elements --}}
            <div class="sm:flex hidden space-x-4">
                @foreach ($elements as $element)
                    {{-- "Three Dots" Separator --}}
                    @if (is_string($element))
                        <span class="px-2 py-1 text-base font-medium text-gray-700">{{ $element }}</span>
                    @endif

                    {{-- Array Of Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <span class="px-2 py-1 text-base font-bold text-indigo-700 border-t border-indigo-400">{{ $page }}</span>
                            @else
                                <a href="{{ $url }}" class="px-2 py-1 text-base font-medium text-gray-600 hover:text-indigo-700 border-t border-transparent hover:border-indigo-400">{{ $page }}</a>
                            @endif
                        @endforeach
                    @endif
                @endforeach
            </div>

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" class="flex items-center text-gray-600 hover:text-indigo-700 cursor-pointer">
                    <p class="text-base font-medium mr-3">Suivant</p>
                    <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                        <path d="M5.293 14.707a1 1 0 001.414 0l4-4a1 1 0 000-1.414l-4-4a1 1 0 00-1.414 1.414L8.586 10 5.293 13.293a1 1 0 000 1.414z" />
                    </svg>
                </a>
            @else
                <div class="flex items-center text-gray-500 cursor-not-allowed">
                    <p class="text-base font-medium mr-3">Suivant</p>
                    <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                        <path d="M5.293 14.707a1 1 0 001.414 0l4-4a1 1 0 000-1.414l-4-4a1 1 0 00-1.414 1.414L8.586 10 5.293 13.293a1 1 0 000 1.414z" />
                    </svg>
                </div>
            @endif
        </div>
    </div>
@endif
