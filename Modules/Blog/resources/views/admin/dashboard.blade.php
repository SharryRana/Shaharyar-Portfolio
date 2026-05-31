@extends('blog::admin.layout')

@section('title', 'Admin Dashboard')

@section('content')
    <div class="mb-6 flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Dashboard Overview</h1>
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Welcome back, Admin. Here's what's happening today.</p>
        </div>
        <div>
            <a href="{{ route('blog-admin.articles.create') }}"
                class="inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-brand-accent hover:bg-[#d66c2e] focus:outline-none transition">
                <svg class="mr-2 -ml-1 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
                Add New Article
            </a>
        </div>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4 mb-8">

        <!-- Stat Card 1 -->
        <div
            class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-xl border border-gray-100 dark:border-gray-700 p-5 group">
            <div class="flex items-center">
                <div
                    class="flex-shrink-0 bg-brand-accent/10 dark:bg-brand-accent/20 rounded-lg p-3 group-hover:scale-110 transition-transform">
                    <svg class="h-6 w-6 text-brand-accent" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                    </svg>
                </div>
                <div class="ml-4 w-0 flex-1">
                    <dl>
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 truncate">Articles</dt>
                        <dd class="flex items-baseline">
                            <div class="text-2xl font-bold text-gray-900 dark:text-white">{{ $articlesCount }}</div>
                        </dd>
                    </dl>
                </div>
            </div>
        </div>

        <!-- Stat Card 2 -->
        <div
            class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-xl border border-gray-100 dark:border-gray-700 p-5 group">
            <div class="flex items-center">
                <div
                    class="flex-shrink-0 bg-blue-100 dark:bg-blue-900/30 rounded-lg p-3 group-hover:scale-110 transition-transform">
                    <svg class="h-6 w-6 text-blue-600 dark:text-blue-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                </div>
                <div class="ml-4 w-0 flex-1">
                    <dl>
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 truncate">Active Users</dt>
                        <dd class="flex items-baseline">
                            <div class="text-2xl font-bold text-gray-900 dark:text-white">{{ $usersCount }}</div>
                        </dd>
                    </dl>
                </div>
            </div>
        </div>

        <!-- Stat Card 3 -->
        <div
            class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-xl border border-gray-100 dark:border-gray-700 p-5 group">
            <div class="flex items-center">
                <div
                    class="flex-shrink-0 bg-green-100 dark:bg-green-900/30 rounded-lg p-3 group-hover:scale-110 transition-transform">
                    <svg class="h-6 w-6 text-green-600 dark:text-green-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div class="ml-4 w-0 flex-1">
                    <dl>
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 truncate">FAQs</dt>
                        <dd class="flex items-baseline">
                            <div class="text-2xl font-bold text-gray-900 dark:text-white">{{ $faqsCount }}</div>
                        </dd>
                    </dl>
                </div>
            </div>
        </div>

        <!-- Stat Card 4 -->
        <div
            class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-xl border border-gray-100 dark:border-gray-700 p-5 group">
            <div class="flex items-center">
                <div
                    class="flex-shrink-0 bg-purple-100 dark:bg-purple-900/30 rounded-lg p-3 group-hover:scale-110 transition-transform">
                    <svg class="h-6 w-6 text-purple-600 dark:text-purple-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                </div>
                <div class="ml-4 w-0 flex-1">
                    <dl>
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 truncate">Total Visits</dt>
                        <dd class="flex items-baseline">
                            <div class="text-2xl font-bold text-gray-900 dark:text-white">{{ number_format($totalVisits) }}
                            </div>
                        </dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>

    <!-- Visitor Analytics -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-5 mb-8">
        <div class="bg-gradient-to-br from-brand-accent to-orange-600 rounded-xl shadow-lg p-6 text-white">
            <div class="flex items-center justify-between mb-2">
                <h3 class="text-sm font-semibold uppercase tracking-wide opacity-90">Today's Visitors</h3>
                <svg class="h-6 w-6 opacity-75" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
            </div>
            <p class="text-4xl font-black">{{ number_format($todayVisits) }}</p>
            <p class="text-sm opacity-75 mt-2">Unique:
                {{ number_format(\Modules\Blog\Models\Visit::whereDate('created_at', today())->distinct('ip_address')->count('ip_address')) }}
            </p>
        </div>

        <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl shadow-lg p-6 text-white">
            <div class="flex items-center justify-between mb-2">
                <h3 class="text-sm font-semibold uppercase tracking-wide opacity-90">This Week</h3>
                <svg class="h-6 w-6 opacity-75" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                </svg>
            </div>
            <p class="text-4xl font-black">{{ number_format($thisWeekVisits) }}</p>
            <p class="text-sm opacity-75 mt-2">{{ number_format($articleVisits) }} article views this week</p>
        </div>

        <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl shadow-lg p-6 text-white">
            <div class="flex items-center justify-between mb-2">
                <h3 class="text-sm font-semibold uppercase tracking-wide opacity-90">This Month</h3>
                <svg class="h-6 w-6 opacity-75" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                </svg>
            </div>
            <p class="text-4xl font-black">{{ number_format($thisMonthVisits) }}</p>
            <p class="text-sm opacity-75 mt-2">{{ number_format($uniqueVisitors) }} unique visitors total</p>
        </div>
    </div>

    <!-- Device & Content Analytics -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
        <!-- Device Breakdown -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 p-6">
            <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4 flex items-center gap-2">
                <svg class="h-6 w-6 text-brand-accent" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z" />
                </svg>
                Device Breakdown
            </h3>
            <div class="space-y-4">
                @php
                    $totalDeviceVisits = $mobileVisits + $desktopVisits + $tabletVisits;
                    $mobilePercent = $totalDeviceVisits > 0 ? round(($mobileVisits / $totalDeviceVisits) * 100) : 0;
                    $desktopPercent = $totalDeviceVisits > 0 ? round(($desktopVisits / $totalDeviceVisits) * 100) : 0;
                    $tabletPercent = $totalDeviceVisits > 0 ? round(($tabletVisits / $totalDeviceVisits) * 100) : 0;
                @endphp

                <div>
                    <div class="flex items-center justify-between mb-1">
                        <span class="text-sm font-medium text-gray-700 dark:text-gray-300 flex items-center gap-2">
                            <svg class="h-4 w-4 text-brand-accent" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z" />
                            </svg>
                            Mobile
                        </span>
                        <span class="text-sm font-bold text-gray-900 dark:text-white">{{ number_format($mobileVisits) }}
                            ({{ $mobilePercent }}%)</span>
                    </div>
                    <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2">
                        <div class="bg-brand-accent rounded-full h-2" style="width: {{ $mobilePercent }}%"></div>
                    </div>
                </div>

                <div>
                    <div class="flex items-center justify-between mb-1">
                        <span class="text-sm font-medium text-gray-700 dark:text-gray-300 flex items-center gap-2">
                            <svg class="h-4 w-4 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            Desktop
                        </span>
                        <span class="text-sm font-bold text-gray-900 dark:text-white">{{ number_format($desktopVisits) }}
                            ({{ $desktopPercent }}%)</span>
                    </div>
                    <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2">
                        <div class="bg-blue-500 rounded-full h-2" style="width: {{ $desktopPercent }}%"></div>
                    </div>
                </div>

                <div>
                    <div class="flex items-center justify-between mb-1">
                        <span class="text-sm font-medium text-gray-700 dark:text-gray-300 flex items-center gap-2">
                            <svg class="h-4 w-4 text-purple-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 18h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                            </svg>
                            Tablet
                        </span>
                        <span class="text-sm font-bold text-gray-900 dark:text-white">{{ number_format($tabletVisits) }}
                            ({{ $tabletPercent }}%)</span>
                    </div>
                    <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2">
                        <div class="bg-purple-500 rounded-full h-2" style="width: {{ $tabletPercent }}%"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Most Viewed Articles -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 p-6">
            <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4 flex items-center gap-2">
                <svg class="h-6 w-6 text-brand-accent" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                Most Viewed Articles
            </h3>
            <div class="space-y-3">
                @forelse($mostViewedArticles as $article)
                    <div
                        class="flex items-center justify-between py-2 border-b border-gray-100 dark:border-gray-700 last:border-0">
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-gray-900 dark:text-white truncate">{{ $article->title }}</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">{{ $article->status }}</p>
                        </div>
                        <div class="flex items-center gap-2 ml-4">
                            <span
                                class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-bold bg-brand-accent/10 text-brand-accent">
                                <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                {{ number_format($article->view_count) }}
                            </span>
                        </div>
                    </div>
                @empty
                    <p class="text-sm text-gray-400 text-center py-8">No articles yet</p>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Extra Sections -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-bold text-gray-900 dark:text-white">Recent Traffic</h3>
                <a href="{{ route('blog-admin.traffic.index') }}"
                    class="text-brand-accent text-sm font-semibold hover:underline">View All</a>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-100 dark:divide-gray-700">
                    <thead>
                        <tr>
                            <th
                                class="px-3 py-2 text-left text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                Visitor</th>
                            <th
                                class="px-3 py-2 text-left text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                Content</th>
                            <th
                                class="px-3 py-2 text-left text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                Device</th>
                            <th
                                class="px-3 py-2 text-right text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                Time</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50 dark:divide-gray-800">
                        @forelse($recentVisits as $visit)
                            <tr>
                                <td class="px-3 py-3 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900 dark:text-white">{{ $visit->ip_address }}
                                    </div>
                                    <div class="text-xs text-gray-500">
                                        {{ $visit->city ?: 'Unknown' }}{{ $visit->city && $visit->country ? ', ' : '' }}{{ $visit->country ?: '' }}
                                    </div>
                                </td>
                                <td class="px-3 py-3">
                                    @if($visit->article)
                                        <div class="flex items-center gap-2">
                                            <svg class="h-4 w-4 text-blue-500 flex-shrink-0" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                            </svg>
                                            <div>
                                                <div class="text-sm text-gray-900 dark:text-white">
                                                    {{ Str::limit($visit->article->title, 30) }}</div>
                                                <div class="text-xs text-gray-500">Article</div>
                                            </div>
                                        </div>
                                    @else
                                        <div class="text-sm text-gray-500 dark:text-gray-400 truncate max-w-[150px]">
                                            {{ str_replace(url('/'), '', $visit->url) ?: '/' }}
                                        </div>
                                    @endif
                                </td>
                                <td class="px-3 py-3 whitespace-nowrap">
                                    <span class="inline-flex items-center gap-1.5 text-xs">
                                        @if($visit->device_type === 'mobile')
                                            <svg class="h-3.5 w-3.5 text-brand-accent" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                            </svg>
                                        @elseif($visit->device_type === 'tablet')
                                            <svg class="h-3.5 w-3.5 text-purple-500" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 18h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                            </svg>
                                        @else
                                            <svg class="h-3.5 w-3.5 text-blue-500" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                            </svg>
                                        @endif
                                        <span
                                            class="text-gray-600 dark:text-gray-400">{{ ucfirst($visit->device_type ?: 'desktop') }}</span>
                                    </span>
                                </td>
                                <td class="px-3 py-3 whitespace-nowrap text-right text-xs text-gray-400">
                                    {{ $visit->created_at->diffForHumans() }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-3 py-10 text-center text-gray-400">No visits recorded yet.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div
            class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 p-6 overflow-hidden">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-bold text-gray-900 dark:text-white">Recent Messages</h3>
                <a href="{{ route('blog-admin.messages.index') }}"
                    class="text-brand-accent text-sm font-semibold hover:underline">View All</a>
            </div>
            <div class="space-y-4">
                @forelse($recentMessages as $message)
                    <a href="{{ route('blog-admin.messages.show', $message->id) }}"
                        class="block rounded-lg border border-gray-100 dark:border-gray-700 px-4 py-3 hover:border-brand-accent/40 hover:bg-gray-50 dark:hover:bg-gray-700/40 transition">
                        <div class="flex items-start justify-between gap-3">
                            <div class="min-w-0">
                                <div class="flex items-center gap-2">
                                    @if(!$message->is_read)
                                        <span class="h-2 w-2 rounded-full bg-red-500 shrink-0"></span>
                                    @endif
                                    <p class="truncate text-sm font-semibold text-gray-900 dark:text-white">{{ $message->name }}
                                    </p>
                                </div>
                                <p class="mt-1 truncate text-xs text-gray-500 dark:text-gray-400">{{ $message->email }}</p>
                                <p class="mt-2 truncate text-sm text-gray-700 dark:text-gray-300">
                                    {{ $message->subject ?: $message->message }}</p>
                                <p class="mt-2 text-xs text-gray-400 dark:text-gray-500">IP:
                                    {{ $message->ip_address ?: 'Unknown' }}</p>
                            </div>
                            <span
                                class="shrink-0 text-xs text-gray-400 dark:text-gray-500">{{ $message->created_at->diffForHumans() }}</span>
                        </div>
                    </a>
                @empty
                    <div class="py-10 text-center text-gray-400">
                        <p class="text-sm font-medium">No messages yet.</p>
                        <p class="mt-1 text-xs">Contact form submissions will appear here.</p>
                    </div>
                @endforelse
            </div>
        </div>

        <div
            class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 p-6 overflow-hidden">
            <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">Recent Activity</h3>
            <div class="flow-root">
                <ul role="list" class="-mb-8">
                    @forelse($recentActivities as $activity)
                        <li>
                            <div class="relative pb-8">
                                @if(!$loop->last)
                                    <span class="absolute top-4 left-4 -ml-px h-full w-0.5 bg-gray-200 dark:bg-gray-700"
                                        aria-hidden="true"></span>
                                @endif
                                <div class="relative flex space-x-3">
                                    <div>
                                        @php
                                            $bgColor = 'bg-gray-400';
                                            $icon = '<svg class="h-4 w-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>';

                                            if (str_contains($activity->type, 'created')) {
                                                $bgColor = 'bg-green-500';
                                                $icon = '<svg class="h-4 w-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" /></svg>';
                                            } elseif (str_contains($activity->type, 'updated')) {
                                                $bgColor = 'bg-blue-500';
                                                $icon = '<svg class="h-4 w-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" /></svg>';
                                            } elseif (str_contains($activity->type, 'deleted')) {
                                                $bgColor = 'bg-red-500';
                                                $icon = '<svg class="h-4 w-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>';
                                            }
                                        @endphp
                                        <span
                                            class="h-8 w-8 rounded-full {{ $bgColor }} flex items-center justify-center ring-8 ring-white dark:ring-gray-800">
                                            {!! $icon !!}
                                        </span>
                                    </div>
                                    <div class="min-w-0 flex-1 pt-1.5 flex justify-between space-x-4">
                                        <div>
                                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                                {{ $activity->description }}
                                                @if($activity->user)
                                                    <span class="text-xs text-gray-400">by {{ $activity->user->name }}</span>
                                                @endif
                                            </p>
                                        </div>
                                        <div class="text-right text-sm whitespace-nowrap text-gray-500 dark:text-gray-400">
                                            <time>{{ $activity->created_at->diffForHumans() }}</time>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    @empty
                        <li class="py-10 text-center text-gray-400">No activity logged yet.</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
@endsection
