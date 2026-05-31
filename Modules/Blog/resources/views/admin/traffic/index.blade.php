@extends('blog::admin.layout')

@section('title', 'Traffic History')

@section('content')
@php
    $activeFilterCount = collect($filters ?? [])->filter(fn ($value) => filled($value))->count();
    $selectClass = 'block h-10 w-full appearance-none rounded-lg border border-gray-200 bg-white px-3 py-2 pr-9 text-sm font-semibold text-gray-700 shadow-sm transition focus:border-brand-accent focus:outline-none focus:ring-2 focus:ring-brand-accent/20 dark:border-gray-700 dark:bg-gray-900/60 dark:text-gray-100';
@endphp

<div class="px-4 sm:px-6 lg:px-8 py-8">
    <div class="md:flex md:items-center md:justify-between mb-8">
        <div class="flex-1 min-w-0">
            <h2 class="text-2xl font-bold leading-7 text-gray-900 dark:text-white sm:text-3xl sm:truncate">Visitor Traffic History</h2>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Real-time overview of users visiting your platform.</p>
        </div>
    </div>

    <div class="bg-white dark:bg-gray-800 shadow-sm rounded-2xl border border-gray-100 dark:border-gray-700 overflow-hidden">
        <form action="{{ route('blog-admin.traffic.index') }}" method="GET" class="border-b border-gray-200 p-4 dark:border-gray-700">
            <div class="grid gap-3 lg:grid-cols-[minmax(220px,1.4fr)_minmax(130px,0.55fr)_minmax(150px,0.65fr)_auto]">
                <label class="relative min-w-0">
                    <span class="sr-only">Search traffic</span>
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                        <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </span>
                    <input type="search" name="search" value="{{ $filters['search'] ?? '' }}"
                        class="block h-10 w-full rounded-lg border border-gray-200 bg-white py-2 pl-10 pr-3 text-sm font-semibold text-gray-700 placeholder-gray-400 shadow-sm transition focus:border-brand-accent focus:outline-none focus:ring-2 focus:ring-brand-accent/20 dark:border-gray-700 dark:bg-gray-900/60 dark:text-gray-100"
                        placeholder="Search IP, URL, location, browser...">
                </label>

                <label class="relative">
                    <span class="sr-only">Filter by method</span>
                    <select name="method" class="{{ $selectClass }}">
                        <option value="">All methods</option>
                        @foreach(['GET', 'POST', 'PUT', 'PATCH', 'DELETE'] as $method)
                            <option value="{{ $method }}" @selected(($filters['method'] ?? '') === $method)>{{ $method }}</option>
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
                    <span class="sr-only">Filter by device</span>
                    <select name="device_type" class="{{ $selectClass }}">
                        <option value="">All devices</option>
                        @foreach($deviceTypes as $deviceType)
                            <option value="{{ $deviceType }}" @selected(($filters['device_type'] ?? '') === $deviceType)>{{ ucfirst($deviceType) }}</option>
                        @endforeach
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
                        <a href="{{ route('blog-admin.traffic.index') }}" class="inline-flex h-10 items-center justify-center rounded-md border border-gray-300 bg-white px-3 text-sm font-semibold text-gray-700 transition hover:bg-gray-50 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-200 dark:hover:bg-gray-700">
                            Reset
                        </a>
                    @endif
                </div>
            </div>
        </form>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-50 dark:bg-gray-700/50">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Time</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Visitor / IP</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Location</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Page Visited</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Device / Browser</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-100 dark:divide-gray-700">
                    @forelse($visits as $visit)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/30 transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                            {{ $visit->created_at->format('M d, Y') }}
                            <div class="text-xs text-gray-400">{{ $visit->created_at->format('H:i:s') }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-semibold text-gray-900 dark:text-white">{{ $visit->ip_address }}</div>
                            <div class="text-xs text-gray-500">Method: <span class="uppercase font-bold text-brand-accent">{{ $visit->method }}</span></div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center gap-2">
                                <div class="text-sm text-gray-900 dark:text-white">{{ $visit->city }}, {{ $visit->region }}</div>
                            </div>
                            <div class="text-xs text-gray-500 font-medium">{{ $visit->country }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-600 dark:text-gray-300 truncate max-w-xs">
                                <a href="{{ $visit->url }}" target="_blank" class="hover:text-brand-accent hover:underline">
                                    {{ str_replace(url('/'), '', $visit->url) ?: '/' }}
                                </a>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-xs text-gray-500 line-clamp-2 max-w-xs" title="{{ $visit->user_agent }}">
                                {{ $visit->user_agent }}
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center">
                            <p class="text-sm font-semibold text-gray-900 dark:text-white">No traffic records found</p>
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Try changing the search or filters.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @include('blog::admin.components.pagination', ['paginator' => $visits, 'label' => 'visits'])
    </div>
</div>
@endsection
