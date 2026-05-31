@extends('blog::admin.layout')

@section('title', 'Manage Articles - Creavibe')

@section('content')
    @php
        $activeFilterCount = collect($filters ?? [])->filter(fn ($value) => filled($value))->count();
        $selectClass = 'block h-10 w-full appearance-none rounded-lg border border-gray-200 bg-white px-3 py-2 pr-9 text-sm font-semibold text-gray-700 shadow-sm transition focus:border-brand-accent focus:outline-none focus:ring-2 focus:ring-brand-accent/20 dark:border-gray-700 dark:bg-gray-900/60 dark:text-gray-100';
    @endphp

    <div class="mb-6 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Editorial Articles</h1>
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Manage and publish blog posts and marketing guides.</p>
        </div>
        <div>
            <a href="{{ route('blog-admin.articles.create') }}"
                class="inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-brand-accent hover:bg-[#d66c2e] focus:outline-none transition">
                <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                </svg>
                Write Article
            </a>
        </div>
    </div>

    <div class="bg-white dark:bg-gray-800 shadow-sm rounded-xl border border-gray-200 dark:border-gray-700 overflow-hidden">
        <!-- Toolbar -->
        <form action="{{ route('blog-admin.articles.index') }}" method="GET"
            class="border-b border-gray-200 p-4 dark:border-gray-700">
            <div class="grid gap-3 lg:grid-cols-[minmax(220px,1.4fr)_repeat(5,minmax(130px,1fr))_auto]">
                <label class="relative min-w-0">
                    <span class="sr-only">Search articles</span>
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                        <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </span>
                    <input type="search" name="search" value="{{ $filters['search'] ?? '' }}"
                        class="block h-10 w-full rounded-md border border-gray-300 bg-white py-2 pl-10 pr-3 text-sm text-gray-900 placeholder-gray-500 transition focus:border-brand-accent focus:outline-none focus:ring-1 focus:ring-brand-accent dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                        placeholder="Search title, slug, author...">
                </label>

                <label class="relative">
                    <span class="sr-only">Filter by status</span>
                    <select name="status" class="{{ $selectClass }}">
                        <option value="">All statuses</option>
                        <option value="Published" @selected(($filters['status'] ?? '') === 'Published')>Published</option>
                        <option value="Draft" @selected(($filters['status'] ?? '') === 'Draft')>Draft</option>
                    </select>
                    <span class="pointer-events-none absolute inset-y-0 right-3 flex items-center text-brand-accent">
                        <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m6 9 6 6 6-6" />
                        </svg>
                    </span>
                </label>

                <label class="relative">
                    <span class="sr-only">Filter by category</span>
                    <select name="category" class="{{ $selectClass }}">
                        <option value="">All categories</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->name }}" @selected(($filters['category'] ?? '') === $category->name)>{{ $category->name }}{{ $category->trashed() || ! $category->is_active ? ' (Inactive)' : '' }}</option>
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
                    <span class="sr-only">Filter by author</span>
                    <select name="author_id" class="{{ $selectClass }}">
                        <option value="">All authors</option>
                        @foreach ($authors as $author)
                            <option value="{{ $author->id }}" @selected((string) ($filters['author_id'] ?? '') === (string) $author->id)>
                                {{ $author->name }}{{ $author->trashed() ? ' (Inactive)' : '' }}
                            </option>
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
                    <span class="sr-only">Filter by visibility</span>
                    <select name="visibility" class="{{ $selectClass }}">
                        <option value="">All visibility</option>
                        <option value="listed" @selected(($filters['visibility'] ?? '') === 'listed')>Blog listing</option>
                        <option value="hidden" @selected(($filters['visibility'] ?? '') === 'hidden')>Hidden SEO</option>
                    </select>
                    <span class="pointer-events-none absolute inset-y-0 right-3 flex items-center text-brand-accent">
                        <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m6 9 6 6 6-6" />
                        </svg>
                    </span>
                </label>

                <label class="relative">
                    <span class="sr-only">Filter by trending</span>
                    <select name="trending" class="{{ $selectClass }}">
                        <option value="">All trending</option>
                        <option value="yes" @selected(($filters['trending'] ?? '') === 'yes')>Trending</option>
                        <option value="no" @selected(($filters['trending'] ?? '') === 'no')>Not trending</option>
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
                        <a href="{{ route('blog-admin.articles.index') }}"
                            class="inline-flex h-10 items-center justify-center rounded-md border border-gray-300 bg-white px-3 text-sm font-semibold text-gray-700 transition hover:bg-gray-50 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-200 dark:hover:bg-gray-700">
                            Reset
                        </a>
                    @endif
                </div>
            </div>
        </form>

        <!-- Data Table -->
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-50 dark:bg-gray-900/50">
                    <tr>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                            Title</th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                            Category</th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                            Author</th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                            Status</th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                            Views</th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                            Published Date</th>
                        <th scope="col" class="relative px-6 py-3">
                            <span class="sr-only">Actions</span>
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse ($articles as $article)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    @if ($article->image)
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <img class="h-10 w-10 rounded-md object-cover" src="{{ $article->image }}"
                                                alt="">
                                        </div>
                                    @else
                                        <div
                                            class="flex-shrink-0 h-10 w-10 bg-gray-200 dark:bg-gray-700 rounded-md flex items-center justify-center">
                                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                </path>
                                            </svg>
                                        </div>
                                    @endif
                                    <div class="ml-4 max-w-sm">
                                        <div class="text-sm font-semibold text-gray-900 dark:text-white truncate"
                                            title="{{ $article->title }}">
                                            {{ $article->title }}
                                        </div>
                                        <div class="text-xs text-gray-500 dark:text-gray-400 truncate">
                                            /{{ $article->slug }}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="inline-flex rounded-full bg-brand-accent/10 px-2.5 py-0.5 text-xs font-semibold text-brand-accent">
                                    {{ $article->display_category }}
                                </span>
                                @if ($article->is_trending)
                                    <span
                                        class="ml-2 inline-flex rounded-full bg-orange-100 px-2.5 py-0.5 text-xs font-semibold text-orange-700 dark:bg-orange-900/30 dark:text-orange-300">
                                        Trending
                                    </span>
                                @endif
                                @unless ($article->show_on_blog)
                                    <span
                                        class="ml-2 inline-flex rounded-full bg-gray-100 px-2.5 py-0.5 text-xs font-semibold text-gray-700 dark:bg-gray-700 dark:text-gray-200">
                                        Hidden SEO
                                    </span>
                                @endunless
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900 dark:text-gray-300">{{ $article->author?->name ?: $article->author_name }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if ($article->status === 'Published')
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800 dark:bg-green-900/40 dark:text-green-400 border border-green-200 dark:border-green-800 tracking-wide">
                                        Published
                                    </span>
                                @else
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800 dark:bg-yellow-900/40 dark:text-yellow-400 border border-yellow-200 dark:border-yellow-800 tracking-wide">
                                        Draft
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                {{ $article->view_count }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                {{ $article->published_at ? \Carbon\Carbon::parse($article->published_at)->format('M d, Y') : '-' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex items-center justify-end gap-3 text-gray-400">
                                    <a href="{{ route('blog.articles.seo.show', $article->slug) }}"
                                        target="_blank" class="hover:text-blue-500 transition" title="Preview">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </a>
                                    <a href="{{ route('blog-admin.articles.edit', $article->id) }}"
                                        class="hover:text-brand-accent transition" title="Edit">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                        </svg>
                                    </a>
                                    <form action="{{ route('blog-admin.articles.destroy', $article->id) }}" method="POST"
                                        class="inline"
                                        data-confirm="This article will be permanently deleted. This action cannot be undone."
                                        data-confirm-title="Delete article?" data-confirm-button="Delete Article">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="hover:text-red-500 transition" title="Delete">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-12 text-center">
                                <p class="text-sm font-semibold text-gray-900 dark:text-white">No articles found</p>
                                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Try changing the search or filters.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @include('blog::admin.components.pagination', ['paginator' => $articles, 'label' => 'articles'])
    </div>
@endsection
