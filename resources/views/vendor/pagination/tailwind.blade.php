@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="flex items-center justify-between">

            <div>
                <span class="relative z-0 inline-flex shadow-sm rounded-md">
                    {{-- Previous Page Link --}}
                    @if ($paginator->onFirstPage())
                        <span aria-disabled="true" aria-label="{{ __('pagination.previous') }}">
                            <span class="relative inline-flex items-center px-2 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default rounded-l-md leading-5" aria-hidden="true">
                            </span>
                        </span>
                    @else
                        <li class="page-nav__item"><a href="{{ $paginator->previousPageUrl() }}" class="page-nav__item__link"><i class="fa fa-angle-double-left"></i></a></li>
                        <a href="{{ $paginator->previousPageUrl() }}" >

                        </a>
                    @endif

                    {{-- Pagination Elements --}}
                    @foreach ($elements as $element)
                        {{-- Array Of Links --}}
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    <li class="page-nav__item"><a href="#" class="page-nav__item__link" style="color: rebeccapurple">{{ $page }}</a></li>
                                @else
                                    <li class="page-nav__item"><a href="{{ $url }}" class="page-nav__item__link">{{$page}}</a></li>
                                @endif
                            @endforeach
                        @endif
                    @endforeach

                    {{-- Next Page Link --}}
                    @if ($paginator->hasMorePages())
                        <li class="page-nav__item"><a href="{{ $paginator->nextPageUrl() }}" class="page-nav__item__link"><i class="fa fa-angle-double-right"></i></a></li>
                    @else
                        </span>
                    @endif
                </span>
            </div>
        </div>
    </nav>
@endif
