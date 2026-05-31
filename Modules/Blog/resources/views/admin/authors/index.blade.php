@extends('blog::admin.layout')

@section('title', 'Authors - Creavibe Admin')

@section('content')
@php
    $activeFilterCount = collect($filters ?? [])->filter(fn ($value) => filled($value))->count();
    $selectClass = 'block h-10 w-full appearance-none rounded-lg border border-gray-200 bg-white px-3 py-2 pr-9 text-sm font-semibold text-gray-700 shadow-sm transition focus:border-brand-accent focus:outline-none focus:ring-2 focus:ring-brand-accent/20 dark:border-gray-700 dark:bg-gray-900/60 dark:text-gray-100';
@endphp

<div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
    <div>
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Authors</h1>
        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Manage blog writer profiles used across articles.</p>
    </div>
    <a href="{{ route('blog-admin.authors.create') }}" class="inline-flex items-center justify-center rounded-md border border-transparent bg-brand-accent px-4 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-[#d66c2e]">
        Add Author
    </a>
</div>

<div class="overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-800">
    <form action="{{ route('blog-admin.authors.index') }}" method="GET" class="border-b border-gray-200 p-4 dark:border-gray-700">
        <div class="grid gap-3 md:grid-cols-[minmax(220px,1.4fr)_minmax(150px,0.55fr)_auto]">
            <label class="relative min-w-0">
                <span class="sr-only">Search authors</span>
                <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                    <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </span>
                <input type="search" name="search" value="{{ $filters['search'] ?? '' }}"
                    class="block h-10 w-full rounded-lg border border-gray-200 bg-white py-2 pl-10 pr-3 text-sm font-semibold text-gray-700 placeholder-gray-400 shadow-sm transition focus:border-brand-accent focus:outline-none focus:ring-2 focus:ring-brand-accent/20 dark:border-gray-700 dark:bg-gray-900/60 dark:text-gray-100"
                    placeholder="Search name, role, bio...">
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
                    <a href="{{ route('blog-admin.authors.index') }}"
                        class="inline-flex h-10 items-center justify-center rounded-md border border-gray-300 bg-white px-3 text-sm font-semibold text-gray-700 transition hover:bg-gray-50 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-200 dark:hover:bg-gray-700">
                        Reset
                    </a>
                @endif
            </div>
        </div>
    </form>

    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
            <thead class="bg-gray-50 dark:bg-gray-900/40">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">Author</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">Role</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">Articles</th>
                    <th class="px-6 py-3 text-right text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 bg-white dark:divide-gray-700 dark:bg-gray-800">
                @forelse($authors as $author)
                    <tr class="transition hover:bg-gray-50 dark:hover:bg-gray-700/40">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                @if($author->avatar)
                                    <img src="{{ $author->avatar }}" alt="{{ $author->name }}" class="h-11 w-11 rounded-full border-2 border-brand-accent object-cover">
                                @else
                                    <span class="flex h-11 w-11 items-center justify-center rounded-full border-2 border-brand-accent bg-brand-accent/10 text-sm font-bold text-brand-accent">
                                        {{ \Illuminate\Support\Str::upper(\Illuminate\Support\Str::substr($author->name, 0, 1)) }}
                                    </span>
                                @endif
                                <div>
                                    <p class="font-semibold text-gray-900 dark:text-white">{{ $author->name }}</p>
                                    <p class="max-w-md truncate text-sm text-gray-500 dark:text-gray-400">{{ $author->bio ?: 'No bio added yet.' }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-300">{{ $author->designation ?: 'Not set' }}</td>
                        <td class="px-6 py-4">
                            <span class="inline-flex rounded-full px-2.5 py-1 text-xs font-bold {{ $author->is_active ? 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-300' : 'bg-gray-100 text-gray-600 dark:bg-gray-700 dark:text-gray-300' }}">
                                {{ $author->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-300">{{ $author->articles_count }}</td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex flex-wrap justify-end gap-2">
                                <form action="{{ route('blog-admin.authors.toggle-status', $author) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="rounded-md border border-gray-300 px-3 py-1.5 text-xs font-semibold text-gray-700 transition hover:border-brand-accent hover:text-brand-accent dark:border-gray-600 dark:text-gray-300">
                                        {{ $author->is_active ? 'Deactivate' : 'Activate' }}
                                    </button>
                                </form>
                                <a href="{{ route('blog-admin.authors.edit', $author) }}" class="rounded-md border border-gray-300 px-3 py-1.5 text-xs font-semibold text-gray-700 transition hover:border-brand-accent hover:text-brand-accent dark:border-gray-600 dark:text-gray-300">
                                    Edit
                                </a>
                                <form action="{{ route('blog-admin.authors.destroy', $author) }}" method="POST" data-confirm="Delete author? Existing blogs will keep working, but this author will no longer appear in author management.">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="rounded-md border border-red-200 px-3 py-1.5 text-xs font-semibold text-red-600 transition hover:bg-red-50 dark:border-red-900/50 dark:text-red-400 dark:hover:bg-red-950/30">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center">
                            <p class="text-sm font-semibold text-gray-900 dark:text-white">No authors found</p>
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Try changing the search or filters.</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @include('blog::admin.components.pagination', ['paginator' => $authors, 'label' => 'authors'])
</div>
@endsection
