@extends('blog::admin.layout')

@section('title', 'Manage FAQs')

@section('content')
@php
    $activeFilterCount = collect($filters ?? [])->filter(fn ($value) => filled($value))->count();
    $selectClass = 'block h-10 w-full appearance-none rounded-lg border border-gray-200 bg-white px-3 py-2 pr-9 text-sm font-semibold text-gray-700 shadow-sm transition focus:border-brand-accent focus:outline-none focus:ring-2 focus:ring-brand-accent/20 dark:border-gray-700 dark:bg-gray-900/60 dark:text-gray-100';
@endphp

<div class="mb-6 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
    <div>
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">FAQs</h1>
        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Manage frequently asked questions displayed on the FAQ page.</p>
    </div>
    <div>
        <a href="{{ route('blog-admin.faqs.create') }}" class="inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-brand-accent hover:bg-[#d66c2e] focus:outline-none transition">
            <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Add FAQ
        </a>
    </div>
</div>

@if(session('success'))
<div class="mb-4 p-4 bg-green-100 dark:bg-green-900/40 text-green-800 dark:text-green-300 rounded-lg border border-green-200 dark:border-green-800">
    {{ session('success') }}
</div>
@endif

<div class="bg-white dark:bg-gray-800 shadow-sm rounded-xl border border-gray-200 dark:border-gray-700 overflow-hidden">
    <form action="{{ route('blog-admin.faqs.index') }}" method="GET" class="border-b border-gray-200 p-4 dark:border-gray-700">
        <div class="grid gap-3 md:grid-cols-[minmax(220px,1.4fr)_minmax(160px,0.8fr)_minmax(140px,0.7fr)_auto]">
            <label class="relative min-w-0">
                <span class="sr-only">Search FAQs</span>
                <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                    <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </span>
                <input type="search" name="search" value="{{ $filters['search'] ?? '' }}"
                    class="block h-10 w-full rounded-lg border border-gray-200 bg-white py-2 pl-10 pr-3 text-sm font-semibold text-gray-700 placeholder-gray-400 shadow-sm transition focus:border-brand-accent focus:outline-none focus:ring-2 focus:ring-brand-accent/20 dark:border-gray-700 dark:bg-gray-900/60 dark:text-gray-100"
                    placeholder="Search question or answer...">
            </label>

            <label class="relative">
                <span class="sr-only">Filter by category</span>
                <select name="category" class="{{ $selectClass }}">
                    <option value="">All categories</option>
                    @foreach ($categories as $category => $label)
                        <option value="{{ $category }}" @selected(($filters['category'] ?? '') === $category)>{{ $label }}</option>
                    @endforeach
                </select>
                <span class="pointer-events-none absolute inset-y-0 right-3 flex items-center text-brand-accent">
                    <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m6 9 6 6 6-6" />
                    </svg>
                </span>
            </label>

            <label class="relative">
                <span class="sr-only">Filter by status</span>
                <select name="status" class="{{ $selectClass }}">
                    <option value="">All statuses</option>
                    <option value="active" @selected(($filters['status'] ?? '') === 'active')>Active</option>
                    <option value="inactive" @selected(($filters['status'] ?? '') === 'inactive')>Inactive</option>
                </select>
                <span class="pointer-events-none absolute inset-y-0 right-3 flex items-center text-brand-accent">
                    <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m6 9 6 6 6-6" />
                    </svg>
                </span>
            </label>

            <div class="flex items-center gap-2">
                <button type="submit"
                    class="inline-flex h-10 items-center justify-center rounded-md border border-transparent bg-brand-accent px-4 text-sm font-semibold text-white transition hover:bg-[#d66c2e] focus:outline-none">
                    Apply
                </button>
                @if ($activeFilterCount > 0)
                    <a href="{{ route('blog-admin.faqs.index') }}"
                        class="inline-flex h-10 items-center justify-center rounded-md border border-gray-300 bg-white px-3 text-sm font-semibold text-gray-700 transition hover:bg-gray-50 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-200 dark:hover:bg-gray-700">
                        Reset
                    </a>
                @endif
            </div>
        </div>
    </form>

    <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">
        @forelse($faqs as $faq)
        <li class="px-6 py-4 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition">
            <div class="flex items-start justify-between">
                <div class="flex-1">
                    <div class="flex items-center gap-3 mb-2">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-brand-accent/10 text-brand-accent">
                            {{ \Modules\Blog\Models\Faq::categories()[$faq->category] ?? 'General' }}
                        </span>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200">
                            Order: {{ $faq->order }}
                        </span>
                        @if($faq->is_active)
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 dark:bg-green-900/40 text-green-800 dark:text-green-300">
                                Active
                            </span>
                        @else
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 dark:bg-red-900/40 text-red-800 dark:text-red-300">
                                Inactive
                            </span>
                        @endif
                    </div>
                    <h4 class="text-md font-semibold text-gray-900 dark:text-white mb-1">{{ $faq->question }}</h4>
                    <p class="text-sm text-gray-600 dark:text-gray-400 line-clamp-2">{{ $faq->answer }}</p>
                </div>
                <div class="flex items-center gap-3 ml-4">
                    <a href="{{ route('blog-admin.faqs.edit', $faq->id) }}" class="text-gray-400 hover:text-brand-accent transition" title="Edit">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                        </svg>
                    </a>
                    <form action="{{ route('blog-admin.faqs.destroy', $faq->id) }}" method="POST" data-confirm="This FAQ will be permanently deleted from the FAQ page." data-confirm-title="Delete FAQ?" data-confirm-button="Delete FAQ">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-gray-400 hover:text-red-500 transition" title="Delete">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
        </li>
        @empty
        <li class="px-6 py-12 text-center">
            <p class="text-sm font-semibold text-gray-900 dark:text-white">No FAQs found</p>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Try changing the search or filters.</p>
        </li>
        @endforelse
    </ul>

    @include('blog::admin.components.pagination', ['paginator' => $faqs, 'label' => 'FAQs'])
</div>
@endsection
