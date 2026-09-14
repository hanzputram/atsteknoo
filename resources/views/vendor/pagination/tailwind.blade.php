@if ($paginator->total() > 0)
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="flex flex-col lg:flex-row items-center justify-between gap-4 w-full py-2">
        <!-- Left: Summary Info & Per-Page Selector -->
        <div class="flex flex-wrap items-center justify-center sm:justify-start gap-3.5 text-xs sm:text-sm text-slate-600 font-medium">
            <div>
                <span class="ats-lang-en">Showing <span class="font-bold text-slate-900">{{ $paginator->firstItem() ?? 0 }}</span> to <span class="font-bold text-slate-900">{{ $paginator->lastItem() ?? 0 }}</span> of <span class="font-bold text-slate-900">{{ number_format($paginator->total(), 0, ',', '.') }}</span> results</span>
                <span class="ats-lang-id">Menampilkan <span class="font-bold text-slate-900">{{ $paginator->firstItem() ?? 0 }}</span> - <span class="font-bold text-slate-900">{{ $paginator->lastItem() ?? 0 }}</span> dari <span class="font-bold text-slate-900">{{ number_format($paginator->total(), 0, ',', '.') }}</span> hasil</span>
            </div>

            <!-- Per Page Dropdown -->
            <div class="flex items-center gap-2 pl-3 border-l border-slate-200">
                <label for="atsPerPageSelect" class="text-xs font-bold text-slate-600 uppercase tracking-wider text-[11px]">
                    <span class="ats-lang-en">Show:</span>
                    <span class="ats-lang-id">Tampilkan:</span>
                </label>
                <div class="relative inline-block">
                    <select id="atsPerPageSelect" onchange="atsUpdatePerPage(this.value)" class="appearance-none bg-white text-xs font-bold text-slate-800 border border-slate-200/90 rounded-xl pl-3 pr-8 py-1.5 hover:border-slate-300 focus:ring-2 focus:ring-rose-500/20 focus:border-rose-500 transition cursor-pointer shadow-2xs">
                        @php
                            $currentPer = (int) request('per_page', $paginator->perPage());
                            if (request()->routeIs('articles.*')) {
                                $perOptions = [9, 18, 27, 50, 100];
                            } elseif (request()->routeIs('projects.*')) {
                                $perOptions = [12, 24, 48, 100];
                            } else {
                                $perOptions = [10, 25, 50, 100];
                            }
                            if (!in_array($currentPer, $perOptions)) {
                                $perOptions[] = $currentPer;
                                sort($perOptions);
                            }
                        @endphp
                        @foreach($perOptions as $opt)
                            <option value="{{ $opt }}" {{ $currentPer === $opt ? 'selected' : '' }}>{{ $opt }}</option>
                        @endforeach
                    </select>
                    <svg class="w-3.5 h-3.5 text-slate-400 absolute right-2.5 top-2 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </div>
            </div>
        </div>

        <!-- Right: Pagination Buttons -->
        @if ($paginator->hasPages())
        <div class="flex items-center gap-1 sm:gap-1.5 flex-wrap justify-center">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <span class="w-9 h-9 sm:w-10 sm:h-10 rounded-xl flex items-center justify-center text-slate-300 bg-slate-50 border border-slate-200/60 cursor-not-allowed select-none transition" aria-hidden="true" title="Previous Page">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="w-9 h-9 sm:w-10 sm:h-10 rounded-xl flex items-center justify-center text-slate-700 bg-white border border-slate-200 shadow-2xs hover:bg-rose-50 hover:text-rose-600 hover:border-rose-200 transition-all duration-150" aria-label="{{ __('pagination.previous') }}" title="Previous Page">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                </a>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <span class="w-6 sm:w-7 h-9 sm:h-10 flex items-center justify-center text-slate-400 font-bold text-xs select-none" aria-disabled="true">{{ $element }}</span>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span class="w-9 h-9 sm:w-10 sm:h-10 rounded-xl flex items-center justify-center font-bold text-xs sm:text-sm text-white bg-rose-600 border border-rose-600 shadow-xs ring-2 ring-rose-500/20 select-none" aria-current="page">{{ $page }}</span>
                        @else
                            <a href="{{ $url }}" class="w-9 h-9 sm:w-10 sm:h-10 rounded-xl flex items-center justify-center font-semibold text-xs sm:text-sm text-slate-700 bg-white border border-slate-200 shadow-2xs hover:bg-rose-50 hover:text-rose-600 hover:border-rose-200 transition-all duration-150" aria-label="{{ __('Go to page :page', ['page' => $page]) }}">{{ $page }}</a>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="w-9 h-9 sm:w-10 sm:h-10 rounded-xl flex items-center justify-center text-slate-700 bg-white border border-slate-200 shadow-2xs hover:bg-rose-50 hover:text-rose-600 hover:border-rose-200 transition-all duration-150" aria-label="{{ __('pagination.next') }}" title="Next Page">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>
            @else
                <span class="w-9 h-9 sm:w-10 sm:h-10 rounded-xl flex items-center justify-center text-slate-300 bg-slate-50 border border-slate-200/60 cursor-not-allowed select-none transition" aria-hidden="true" title="Next Page">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </span>
            @endif
        </div>
        @endif
    </nav>

    @once
    <script>
    function atsUpdatePerPage(val) {
        const url = new URL(window.location.href);
        url.searchParams.set('per_page', val);
        url.searchParams.set('page', '1');
        window.location.href = url.toString();
    }
    </script>
    @endonce
@endif
