@extends('blog::admin.layout')

@section('title', 'Message from ' . $message->name . ' - Creavibe Admin')

@section('content')
<div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
    <div class="flex min-w-0 items-center gap-3">
        <a href="{{ route('blog-admin.messages.index') }}" class="inline-flex min-w-0 items-center text-sm font-medium text-gray-500 transition hover:text-brand-accent dark:text-gray-400 dark:hover:text-brand-accent">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" /></svg>
            <span class="truncate">Back to Messages</span>
        </a>
    </div>
    <form action="{{ route('blog-admin.messages.destroy', $message->id) }}" method="POST" data-confirm="This contact message will be permanently deleted." data-confirm-title="Delete message?" data-confirm-button="Delete Message">
        @csrf
        @method('DELETE')
        <button type="submit" class="inline-flex w-full items-center justify-center rounded-lg border border-red-200 bg-white px-4 py-2 text-sm font-medium text-red-600 transition hover:bg-red-50 dark:border-red-800 dark:bg-gray-800 dark:text-red-400 dark:hover:bg-red-900/20 sm:w-auto">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
            Delete Message
        </button>
    </form>
</div>

<div class="mx-auto max-w-3xl">
    {{-- Metadata Card --}}
    <div class="mb-6 overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-800">
        <div class="flex flex-col gap-4 border-b border-gray-100 px-4 py-5 dark:border-gray-700 sm:flex-row sm:items-start sm:justify-between sm:px-6">
            <div class="flex min-w-0 items-center gap-4">
                <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-full bg-gradient-to-br from-brand-accent/70 to-brand-accent text-lg font-bold text-white">
                    {{ strtoupper(substr($message->name, 0, 1)) }}
                </div>
                <div class="min-w-0">
                    <div class="truncate text-base font-bold text-gray-900 dark:text-white">{{ $message->name }}</div>
                    <a href="mailto:{{ $message->email }}" class="block break-all text-sm text-brand-accent hover:underline">{{ $message->email }}</a>
                </div>
            </div>
            <div class="shrink-0 text-left sm:text-right">
                <div class="text-sm text-gray-500 dark:text-gray-400">{{ $message->created_at->format('F j, Y') }}</div>
                <div class="text-xs text-gray-400 dark:text-gray-500 mt-0.5">{{ $message->created_at->format('g:i A') }}</div>
                <div class="mt-2">
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $message->is_read ? 'bg-gray-100 text-gray-600 dark:bg-gray-700 dark:text-gray-400' : 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400' }}">
                        {{ $message->is_read ? 'Read' : 'Marked as Read' }}
                    </span>
                </div>
            </div>
        </div>

        {{-- Subject --}}
        <div class="border-b border-gray-100 bg-gray-50 px-4 py-4 dark:border-gray-700 dark:bg-gray-900/30 sm:px-6">
            <p class="text-xs font-semibold text-gray-400 dark:text-gray-500 uppercase tracking-wider mb-1">Subject</p>
            <p class="break-words text-base font-semibold text-gray-900 dark:text-white">{{ $message->subject ?: '(No subject provided)' }}</p>
        </div>

        {{-- Tracking --}}
        <div class="border-b border-gray-100 px-4 py-4 dark:border-gray-700 sm:px-6">
            <p class="text-xs font-semibold text-gray-400 dark:text-gray-500 uppercase tracking-wider mb-3">Tracking</p>
            <dl class="grid gap-4 sm:grid-cols-2">
                <div class="min-w-0">
                    <dt class="text-xs font-semibold text-gray-500 dark:text-gray-400">IP Address</dt>
                    <dd class="mt-1 break-all text-sm font-medium text-gray-900 dark:text-white">{{ $message->ip_address ?: 'Unknown' }}</dd>
                </div>
                <div class="min-w-0">
                    <dt class="text-xs font-semibold text-gray-500 dark:text-gray-400">Referrer</dt>
                    <dd class="mt-1 break-all text-sm font-medium text-gray-900 dark:text-white">{{ $message->referrer ?: 'Direct / unknown' }}</dd>
                </div>
                <div class="min-w-0 sm:col-span-2">
                    <dt class="text-xs font-semibold text-gray-500 dark:text-gray-400">User Agent</dt>
                    <dd class="mt-1 break-all text-sm font-medium text-gray-900 dark:text-white">{{ $message->user_agent ?: 'Unknown' }}</dd>
                </div>
            </dl>
        </div>

        {{-- Message Body --}}
        <div class="px-4 py-6 sm:px-6">
            <p class="text-xs font-semibold text-gray-400 dark:text-gray-500 uppercase tracking-wider mb-3">Message</p>
            <div class="whitespace-pre-wrap break-words text-base leading-relaxed text-gray-700 dark:text-gray-300">{{ $message->message }}</div>
        </div>
    </div>

    {{-- Reply CTA --}}
    <div class="flex flex-col items-start justify-between gap-4 rounded-xl border border-gray-200 bg-white px-4 py-5 shadow-sm dark:border-gray-700 dark:bg-gray-800 sm:flex-row sm:items-center sm:px-6">
        <div class="min-w-0">
            <p class="text-sm font-semibold text-gray-900 dark:text-white">Reply to {{ $message->name }}</p>
            <p class="mt-0.5 text-sm text-gray-500 dark:text-gray-400">Send a reply directly to <span class="break-all text-brand-accent">{{ $message->email }}</span></p>
        </div>
        <a href="mailto:{{ $message->email }}?subject=Re: {{ $message->subject }}" class="inline-flex w-full shrink-0 items-center justify-center rounded-lg border border-transparent bg-brand-accent px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-[#d66c2e] sm:w-auto">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6" /></svg>
            Reply via Email
        </a>
    </div>
</div>
@endsection
