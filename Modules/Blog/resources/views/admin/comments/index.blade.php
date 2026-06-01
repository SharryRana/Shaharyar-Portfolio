@extends('blog::admin.layout')

@section('title', 'Blog Comments - Creavibe Admin')

@section('content')
@php
    $activeFilterCount = collect($filters ?? [])->filter(fn ($value) => filled($value))->count();
@endphp

<div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
    <div>
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Blog Comments</h1>
        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Accept, reject, or delete reader comments before they appear publicly.</p>
    </div>
    <span class="inline-flex items-center rounded-full border border-yellow-200 bg-yellow-50 px-4 py-2 text-sm font-bold text-yellow-700 dark:border-yellow-800 dark:bg-yellow-900/20 dark:text-yellow-300">
        {{ $pendingTotal }} Pending
    </span>
</div>

@if(session('success'))
    <div class="mb-4 rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-sm font-semibold text-green-700 dark:border-green-800 dark:bg-green-900/20 dark:text-green-300">
        {{ session('success') }}
    </div>
@endif

<div class="overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-800">
    <form action="{{ route('blog-admin.comments.index') }}" method="GET" class="border-b border-gray-200 p-4 dark:border-gray-700">
        <div class="grid gap-3 md:grid-cols-[minmax(220px,1fr)_180px_auto]">
            <input type="search" name="search" value="{{ $filters['search'] ?? '' }}"
                class="h-10 rounded-lg border border-gray-200 bg-white px-3 text-sm font-semibold text-gray-700 shadow-sm focus:border-brand-accent focus:outline-none focus:ring-2 focus:ring-brand-accent/20 dark:border-gray-700 dark:bg-gray-900/60 dark:text-gray-100"
                placeholder="Search name, email, comment, article">
            <select name="status" class="h-10 rounded-lg border border-gray-200 bg-white px-3 text-sm font-semibold text-gray-700 shadow-sm focus:border-brand-accent focus:outline-none focus:ring-2 focus:ring-brand-accent/20 dark:border-gray-700 dark:bg-gray-900/60 dark:text-gray-100">
                <option value="">All statuses</option>
                <option value="pending" @selected(($filters['status'] ?? '') === 'pending')>Pending</option>
                <option value="approved" @selected(($filters['status'] ?? '') === 'approved')>Approved</option>
                <option value="rejected" @selected(($filters['status'] ?? '') === 'rejected')>Rejected</option>
            </select>
            <div class="flex gap-2">
                <button class="inline-flex h-10 items-center rounded-md bg-brand-accent px-4 text-sm font-semibold text-white hover:bg-[#3f22b8]">Filter</button>
                @if($activeFilterCount)
                    <a href="{{ route('blog-admin.comments.index') }}" class="inline-flex h-10 items-center rounded-md border border-gray-300 px-3 text-sm font-semibold text-gray-700 dark:border-gray-600 dark:text-gray-200">Reset</a>
                @endif
            </div>
        </div>
    </form>

    <div class="divide-y divide-gray-200 dark:divide-gray-700">
        @forelse($comments as $comment)
            <article class="p-6 transition hover:bg-gray-50 dark:hover:bg-gray-700/40">
                <div class="flex flex-col gap-4 lg:flex-row lg:items-start lg:justify-between">
                    <div class="min-w-0">
                        <div class="flex flex-wrap items-center gap-2">
                            <h2 class="text-base font-bold text-gray-900 dark:text-white">{{ $comment->name }}</h2>
                            <span class="rounded-full px-2 py-1 text-xs font-bold {{ $comment->status === 'approved' ? 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-300' : ($comment->status === 'rejected' ? 'bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-300' : 'bg-yellow-100 text-yellow-700 dark:bg-yellow-900/30 dark:text-yellow-300') }}">
                                {{ ucfirst($comment->status) }}
                            </span>
                        </div>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">{{ $comment->email }} • {{ $comment->created_at->format('M d, Y h:i A') }}</p>
                        <p class="mt-2 text-sm font-semibold text-brand-accent">{{ $comment->article?->title ?: 'Deleted article' }}</p>
                        <p class="mt-3 max-w-4xl text-sm leading-6 text-gray-700 dark:text-gray-200">{{ $comment->message }}</p>
                    </div>
                    <div class="flex shrink-0 flex-wrap gap-2">
                        @if($comment->status !== 'approved')
                            <form action="{{ route('blog-admin.comments.approve', $comment) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button class="admin-accept-button" type="submit">Accept</button>
                            </form>
                        @endif
                        @if($comment->status !== 'rejected')
                            <form action="{{ route('blog-admin.comments.reject', $comment) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button class="rounded-md border border-gray-300 px-3 py-2 text-xs font-bold text-gray-700 hover:bg-gray-50 dark:border-gray-600 dark:text-gray-200 dark:hover:bg-gray-700">Reject</button>
                            </form>
                        @endif
                        <form action="{{ route('blog-admin.comments.destroy', $comment) }}" method="POST" data-confirm="This comment will be permanently deleted." data-confirm-title="Delete comment?" data-confirm-button="Delete Comment">
                            @csrf
                            @method('DELETE')
                            <button class="rounded-md bg-red-50 px-3 py-2 text-xs font-bold text-red-600 hover:bg-red-100 dark:bg-red-900/20 dark:text-red-300">Delete</button>
                        </form>
                    </div>
                </div>
            </article>
        @empty
            <div class="px-6 py-16 text-center text-gray-500">No comments found.</div>
        @endforelse
    </div>

    @include('blog::admin.components.pagination', ['paginator' => $comments, 'label' => 'comments'])
</div>
@endsection
