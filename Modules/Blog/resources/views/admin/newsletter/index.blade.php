@extends('blog::admin.layout')

@section('title', 'Newsletter Subscribers - Creavibe Admin')

@section('content')
@php
    $activeFilterCount = collect($filters ?? [])->filter(fn ($value) => filled($value))->count();
@endphp

<div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
    <div>
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Newsletter Subscribers</h1>
        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">People who subscribed from the blog newsletter forms.</p>
    </div>
    <span class="inline-flex items-center rounded-full border border-brand-accent/20 bg-brand-accent/10 px-4 py-2 text-sm font-bold text-brand-accent">
        {{ $activeTotal }} Active
    </span>
</div>

@if(session('success'))
    <div class="mb-4 rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-sm font-semibold text-green-700 dark:border-green-800 dark:bg-green-900/20 dark:text-green-300">
        {{ session('success') }}
    </div>
@endif

<div class="overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-800">
    <form action="{{ route('blog-admin.newsletter.index') }}" method="GET" class="border-b border-gray-200 p-4 dark:border-gray-700">
        <div class="grid gap-3 md:grid-cols-[minmax(220px,1fr)_180px_auto]">
            <input type="search" name="search" value="{{ $filters['search'] ?? '' }}"
                class="h-10 rounded-lg border border-gray-200 bg-white px-3 text-sm font-semibold text-gray-700 shadow-sm focus:border-brand-accent focus:outline-none focus:ring-2 focus:ring-brand-accent/20 dark:border-gray-700 dark:bg-gray-900/60 dark:text-gray-100"
                placeholder="Search email address">
            <select name="status" class="h-10 rounded-lg border border-gray-200 bg-white px-3 text-sm font-semibold text-gray-700 shadow-sm focus:border-brand-accent focus:outline-none focus:ring-2 focus:ring-brand-accent/20 dark:border-gray-700 dark:bg-gray-900/60 dark:text-gray-100">
                <option value="">All statuses</option>
                <option value="active" @selected(($filters['status'] ?? '') === 'active')>Active</option>
                <option value="inactive" @selected(($filters['status'] ?? '') === 'inactive')>Inactive</option>
            </select>
            <div class="flex gap-2">
                <button class="inline-flex h-10 items-center rounded-md bg-brand-accent px-4 text-sm font-semibold text-white hover:bg-[#3f22b8]">Filter</button>
                @if($activeFilterCount)
                    <a href="{{ route('blog-admin.newsletter.index') }}" class="inline-flex h-10 items-center rounded-md border border-gray-300 px-3 text-sm font-semibold text-gray-700 dark:border-gray-600 dark:text-gray-200">Reset</a>
                @endif
            </div>
        </div>
    </form>

    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
            <thead class="bg-gray-50 dark:bg-gray-900/50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">Email</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">IP</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">Subscribed</th>
                    <th class="px-6 py-3 text-right text-xs font-semibold uppercase tracking-wider text-gray-500">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 bg-white dark:divide-gray-700 dark:bg-gray-800">
                @forelse($subscribers as $subscriber)
                    <tr class="transition hover:bg-gray-50 dark:hover:bg-gray-700/50">
                        <td class="px-6 py-4 text-sm font-semibold text-gray-900 dark:text-white">{{ $subscriber->email }}</td>
                        <td class="px-6 py-4">
                            <span class="inline-flex rounded-full px-2 py-1 text-xs font-bold {{ $subscriber->status === 'active' ? 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-300' : 'bg-gray-100 text-gray-600 dark:bg-gray-700 dark:text-gray-300' }}">
                                {{ ucfirst($subscriber->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-500 dark:text-gray-400">{{ $subscriber->ip_address ?: 'Unknown' }}</td>
                        <td class="px-6 py-4 text-sm text-gray-500 dark:text-gray-400">{{ $subscriber->created_at->format('M d, Y h:i A') }}</td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex justify-end gap-2">
                                <form action="{{ route('blog-admin.newsletter.toggle-status', $subscriber) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button class="rounded-md border border-gray-300 px-3 py-1.5 text-xs font-bold text-gray-700 hover:bg-gray-50 dark:border-gray-600 dark:text-gray-200 dark:hover:bg-gray-700" type="submit">
                                        {{ $subscriber->status === 'active' ? 'Deactivate' : 'Activate' }}
                                    </button>
                                </form>
                                <form action="{{ route('blog-admin.newsletter.destroy', $subscriber) }}" method="POST" data-confirm="This subscriber will be permanently deleted." data-confirm-title="Delete subscriber?" data-confirm-button="Delete Subscriber">
                                    @csrf
                                    @method('DELETE')
                                    <button class="rounded-md bg-red-50 px-3 py-1.5 text-xs font-bold text-red-600 hover:bg-red-100 dark:bg-red-900/20 dark:text-red-300" type="submit">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-16 text-center text-gray-500">No subscribers found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @include('blog::admin.components.pagination', ['paginator' => $subscribers, 'label' => 'subscribers'])
</div>
@endsection
