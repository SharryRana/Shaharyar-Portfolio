@extends('blog::admin.layout')

@section('title', 'Blog Categories - Creavibe Admin')

@section('content')
<div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
    <div>
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Blog Categories</h1>
        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Manage selectable categories for editorial articles.</p>
    </div>
    <a href="{{ route('blog-admin.blog-categories.create') }}" class="inline-flex items-center justify-center rounded-md border border-transparent bg-brand-accent px-4 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-[#d66c2e]">
        Add Category
    </a>
</div>

<div class="overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-800">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
            <thead class="bg-gray-50 dark:bg-gray-900/40">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">Category</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">Slug</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">Articles</th>
                    <th class="px-6 py-3 text-right text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 bg-white dark:divide-gray-700 dark:bg-gray-800">
                @forelse($categories as $category)
                    <tr class="transition hover:bg-gray-50 dark:hover:bg-gray-700/40">
                        <td class="px-6 py-4">
                            <p class="font-semibold text-gray-900 dark:text-white">{{ $category->name }}</p>
                            <p class="max-w-lg truncate text-sm text-gray-500 dark:text-gray-400">{{ $category->description ?: 'No description added yet.' }}</p>
                        </td>
                        <td class="px-6 py-4 text-sm font-semibold text-gray-600 dark:text-gray-300">/{{ $category->slug }}</td>
                        <td class="px-6 py-4">
                            <span class="inline-flex rounded-full px-2.5 py-1 text-xs font-bold {{ $category->is_active ? 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-300' : 'bg-gray-100 text-gray-600 dark:bg-gray-700 dark:text-gray-300' }}">
                                {{ $category->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-300">{{ $category->articles()->count() }}</td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex flex-wrap justify-end gap-2">
                                <form action="{{ route('blog-admin.blog-categories.toggle-status', $category) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="rounded-md border border-gray-300 px-3 py-1.5 text-xs font-semibold text-gray-700 transition hover:border-brand-accent hover:text-brand-accent dark:border-gray-600 dark:text-gray-300">
                                        {{ $category->is_active ? 'Deactivate' : 'Activate' }}
                                    </button>
                                </form>
                                <a href="{{ route('blog-admin.blog-categories.edit', $category) }}" class="rounded-md border border-gray-300 px-3 py-1.5 text-xs font-semibold text-gray-700 transition hover:border-brand-accent hover:text-brand-accent dark:border-gray-600 dark:text-gray-300">Edit</a>
                                <form action="{{ route('blog-admin.blog-categories.destroy', $category) }}" method="POST" data-confirm="Delete category? Existing blogs will keep working, but this category will no longer appear in category management.">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="rounded-md border border-red-200 px-3 py-1.5 text-xs font-semibold text-red-600 transition hover:bg-red-50 dark:border-red-900/50 dark:text-red-400 dark:hover:bg-red-950/30">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center text-sm text-gray-500 dark:text-gray-400">No blog categories yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @include('blog::admin.components.pagination', ['paginator' => $categories, 'label' => 'categories'])
</div>
@endsection
