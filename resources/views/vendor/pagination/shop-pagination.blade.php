@if ($paginator->hasPages())
    <div class="shop__last__option">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="shop__pagination">
                    {{-- Previous Page Link --}}
                    @if ($paginator->onFirstPage())
                        <a href="#" class="disabled" aria-disabled="true"><span class="arrow_carrot-left"></span></a>
                    @else
                        <a href="{{ $paginator->previousPageUrl() }}" rel="prev"><span class="arrow_carrot-left"></span></a>
                    @endif

                    {{-- Pagination Elements --}}
                    @foreach ($elements as $element)
                        {{-- "Three Dots" Separator --}}
                        @if (is_string($element))
                            <a href="#" class="disabled" aria-disabled="true">{{ $element }}</a>
                        @endif

                        {{-- Array Of Links --}}
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    <a href="#" style="color: white; background-color: black" aria-current="page">{{ $page }}</a>
                                @else
                                    <a href="{{ $url }}">{{ $page }}</a>
                                @endif
                            @endforeach
                        @endif
                    @endforeach

                    {{-- Next Page Link --}}
                    @if ($paginator->hasMorePages())
                        <a href="{{ $paginator->nextPageUrl() }}" rel="next"><span class="arrow_carrot-right"></span></a>
                    @else
                        <a href="#" class="disabled" aria-disabled="true"><span class="arrow_carrot-right"></span></a>
                    @endif
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="shop__last__text">
                    <p>Showing {{ ($paginator->currentPage() - 1) * $paginator->perPage() + 1 }}-{{ min($paginator->currentPage() * $paginator->perPage(), $paginator->total()) }} of {{ $paginator->total() }} results</p>
                </div>
            </div>
        </div>
    </div>
@endif
