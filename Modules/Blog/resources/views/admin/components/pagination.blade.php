@php
    $label = $label ?? 'records';
@endphp

@if ($paginator->hasPages() || $paginator->total() > 0)
    <div class="border-t border-gray-200 bg-gray-50 px-4 py-4 dark:border-gray-700 dark:bg-gray-900/30">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <p class="text-sm text-gray-600 dark:text-gray-400">
                Showing
                <span class="font-semibold text-gray-900 dark:text-white">{{ $paginator->firstItem() ?? 0 }}</span>
                to
                <span class="font-semibold text-gray-900 dark:text-white">{{ $paginator->lastItem() ?? 0 }}</span>
                of
                <span class="font-semibold text-gray-900 dark:text-white">{{ $paginator->total() }}</span>
                {{ $label }}
            </p>

            @if ($paginator->hasPages())
                <nav class="flex items-center gap-1" aria-label="Pagination">
                    @if ($paginator->onFirstPage())
                        <span class="inline-flex h-9 w-9 cursor-not-allowed items-center justify-center rounded-lg border border-gray-200 bg-white text-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-600">
                            <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                        </span>
                    @else
                        <a href="{{ $paginator->previousPageUrl() }}" class="inline-flex h-9 w-9 items-center justify-center rounded-lg border border-gray-200 bg-white text-gray-600 transition hover:border-brand-accent hover:text-brand-accent dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 dark:hover:border-brand-accent dark:hover:text-brand-accent" aria-label="Previous page">
                            <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                        </a>
                    @endif

                    @foreach ($paginator->getUrlRange(max(1, $paginator->currentPage() - 2), min($paginator->lastPage(), $paginator->currentPage() + 2)) as $page => $url)
                        @if ($page === $paginator->currentPage())
                            <span class="inline-flex h-9 min-w-9 items-center justify-center rounded-lg border border-brand-accent bg-brand-accent px-3 text-sm font-bold text-white shadow-sm shadow-orange-500/20">{{ $page }}</span>
                        @else
                            <a href="{{ $url }}" class="inline-flex h-9 min-w-9 items-center justify-center rounded-lg border border-gray-200 bg-white px-3 text-sm font-semibold text-gray-600 transition hover:border-brand-accent hover:text-brand-accent dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 dark:hover:border-brand-accent dark:hover:text-brand-accent">{{ $page }}</a>
                        @endif
                    @endforeach

                    @if ($paginator->hasMorePages())
                        <a href="{{ $paginator->nextPageUrl() }}" class="inline-flex h-9 w-9 items-center justify-center rounded-lg border border-gray-200 bg-white text-gray-600 transition hover:border-brand-accent hover:text-brand-accent dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 dark:hover:border-brand-accent dark:hover:text-brand-accent" aria-label="Next page">
                            <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                            </svg>
                        </a>
                    @else
                        <span class="inline-flex h-9 w-9 cursor-not-allowed items-center justify-center rounded-lg border border-gray-200 bg-white text-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-600">
                            <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                            </svg>
                        </span>
                    @endif
                </nav>
            @endif
        </div>
    </div>
@endif
