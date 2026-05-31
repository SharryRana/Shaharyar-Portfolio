@extends('blog::admin.layout')

@section('title', 'Contact Messages - Creavibe Admin')

@section('content')
@php
    $activeFilterCount = collect($filters ?? [])->filter(fn ($value) => filled($value))->count();
    $selectClass = 'block h-10 w-full appearance-none rounded-lg border border-gray-200 bg-white px-3 py-2 pr-9 text-sm font-semibold text-gray-700 shadow-sm transition focus:border-brand-accent focus:outline-none focus:ring-2 focus:ring-brand-accent/20 dark:border-gray-700 dark:bg-gray-900/60 dark:text-gray-100';
@endphp

<div class="mb-6 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
    <div>
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Contact Messages</h1>
        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">All incoming messages from the contact form.</p>
    </div>
    <div class="flex items-center gap-3">
        @if($unreadTotal > 0)
            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400 border border-red-200 dark:border-red-800">
                {{ $unreadTotal }} Unread
            </span>
        @else
            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400 border border-green-200 dark:border-green-800">
                All Read
            </span>
        @endif
    </div>
</div>

@if(session('success'))
    <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl" role="alert">
        {{ session('success') }}
    </div>
@endif

<div class="bg-white dark:bg-gray-800 shadow-sm rounded-xl border border-gray-200 dark:border-gray-700 overflow-hidden">
    <form action="{{ route('blog-admin.messages.index') }}" method="GET" class="border-b border-gray-200 p-4 dark:border-gray-700">
        <div class="grid gap-3 md:grid-cols-[minmax(220px,1.4fr)_minmax(150px,0.55fr)_auto]">
            <label class="relative min-w-0">
                <span class="sr-only">Search messages</span>
                <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                    <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </span>
                <input type="search" name="search" value="{{ $filters['search'] ?? '' }}"
                    class="block h-10 w-full rounded-lg border border-gray-200 bg-white py-2 pl-10 pr-3 text-sm font-semibold text-gray-700 placeholder-gray-400 shadow-sm transition focus:border-brand-accent focus:outline-none focus:ring-2 focus:ring-brand-accent/20 dark:border-gray-700 dark:bg-gray-900/60 dark:text-gray-100"
                    placeholder="Search sender, subject, message, IP...">
            </label>

            <label class="relative">
                <span class="sr-only">Filter by status</span>
                <select name="status" class="{{ $selectClass }}">
                    <option value="">All statuses</option>
                    <option value="unread" @selected(($filters['status'] ?? '') === 'unread')>Unread</option>
                    <option value="read" @selected(($filters['status'] ?? '') === 'read')>Read</option>
                </select>
                <span class="pointer-events-none absolute inset-y-0 right-3 flex items-center text-brand-accent">
                    <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m6 9 6 6 6-6" />
                    </svg>
                </span>
            </label>

            <div class="flex items-center gap-2">
                <button type="submit" class="inline-flex h-10 items-center justify-center rounded-md border border-transparent bg-brand-accent px-4 text-sm font-semibold text-white transition hover:bg-[#d66c2e] focus:outline-none">
                    Apply
                </button>
                @if($activeFilterCount > 0)
                    <a href="{{ route('blog-admin.messages.index') }}" class="inline-flex h-10 items-center justify-center rounded-md border border-gray-300 bg-white px-3 text-sm font-semibold text-gray-700 transition hover:bg-gray-50 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-200 dark:hover:bg-gray-700">
                        Reset
                    </a>
                @endif
            </div>
        </div>
    </form>

    {{-- Table --}}
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
            <thead class="bg-gray-50 dark:bg-gray-900/50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Status</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Sender</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Subject</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">IP Address</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Preview</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Received</th>
                    <th scope="col" class="relative px-6 py-3"><span class="sr-only">Actions</span></th>
                </tr>
            </thead>
            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                @forelse($messages as $message)
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition {{ !$message->is_read ? 'bg-blue-50/50 dark:bg-blue-900/10' : '' }}">
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if(!$message->is_read)
                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-bold bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400">
                                <span class="w-1.5 h-1.5 rounded-full bg-red-500 mr-1.5 animate-pulse"></span>
                                New
                            </span>
                        @else
                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-500 dark:bg-gray-700 dark:text-gray-400">
                                Read
                            </span>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center gap-3">
                            <div class="h-9 w-9 rounded-full bg-gradient-to-br from-brand-accent/70 to-brand-accent flex items-center justify-center text-white font-bold text-sm shrink-0">
                                {{ strtoupper(substr($message->name, 0, 1)) }}
                            </div>
                            <div>
                                <div class="text-sm font-semibold text-gray-900 dark:text-white {{ !$message->is_read ? 'font-bold' : '' }}">{{ $message->name }}</div>
                                <div class="text-xs text-gray-500 dark:text-gray-400">{{ $message->email }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900 dark:text-gray-200 {{ !$message->is_read ? 'font-semibold' : '' }}">
                            {{ $message->subject ?: '(No subject)' }}
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                        {{ $message->ip_address ?: 'Unknown' }}
                    </td>
                    <td class="px-6 py-4">
                        <div class="text-sm text-gray-500 dark:text-gray-400 max-w-xs truncate">
                            {{ $message->message }}
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                        {{ $message->created_at->format('M d, Y') }}<br>
                        <span class="text-xs">{{ $message->created_at->format('h:i A') }}</span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <div class="flex items-center justify-end gap-3 text-gray-400">
                            <a href="{{ route('blog-admin.messages.show', $message->id) }}" class="hover:text-brand-accent transition" title="View">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                            </a>
                            <form action="{{ route('blog-admin.messages.destroy', $message->id) }}" method="POST" class="inline" data-confirm="This contact message will be permanently deleted." data-confirm-title="Delete message?" data-confirm-button="Delete Message">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="hover:text-red-500 transition" title="Delete">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-6 py-16 text-center">
                        <div class="flex flex-col items-center justify-center text-gray-400 dark:text-gray-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mb-4 opacity-30" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
                            <p class="text-lg font-medium text-gray-500 dark:text-gray-400">No messages found</p>
                            <p class="text-sm text-gray-400 dark:text-gray-500 mt-1">Try changing the search or filters.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @include('blog::admin.components.pagination', ['paginator' => $messages, 'label' => 'messages'])
</div>
@endsection
