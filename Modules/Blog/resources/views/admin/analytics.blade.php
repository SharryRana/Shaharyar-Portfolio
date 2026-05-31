@extends('blog::admin.layout')

@section('title', 'Analytics & Reports')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Analytics & Reports</h1>
    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Track visitor behavior, article performance, and engagement metrics.</p>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-8">
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 p-5">
        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Visits</p>
        <p class="text-3xl font-bold text-gray-900 dark:text-white mt-2">{{ number_format($stats['total_visits']) }}</p>
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 p-5">
        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Unique Visitors</p>
        <p class="text-3xl font-bold text-gray-900 dark:text-white mt-2">{{ number_format($stats['unique_visitors']) }}</p>
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 p-5">
        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Article Views</p>
        <p class="text-3xl font-bold text-gray-900 dark:text-white mt-2">{{ number_format($stats['article_visits']) }}</p>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-8">
    <div class="bg-gradient-to-br from-orange-500 to-orange-600 rounded-xl shadow-lg p-6 text-white">
        <h3 class="text-sm font-semibold uppercase tracking-wide opacity-90 mb-3">Today</h3>
        <p class="text-4xl font-black mb-2">{{ number_format($stats['today_visits']) }}</p>
        <p class="text-sm opacity-75">visits</p>
    </div>

    <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl shadow-lg p-6 text-white">
        <h3 class="text-sm font-semibold uppercase tracking-wide opacity-90 mb-3">This Week</h3>
        <p class="text-4xl font-black mb-2">{{ number_format($stats['this_week_visits']) }}</p>
        <p class="text-sm opacity-75">visits</p>
    </div>

    <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl shadow-lg p-6 text-white">
        <h3 class="text-sm font-semibold uppercase tracking-wide opacity-90 mb-3">This Month</h3>
        <p class="text-4xl font-black mb-2">{{ number_format($stats['this_month_visits']) }}</p>
        <p class="text-sm opacity-75">visits</p>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 p-6">
        <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">Top 10 Articles by Views</h3>
        <div class="space-y-3">
            @forelse($topArticles as $index => $article)
                <div class="flex items-start gap-3 p-3 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700/50 transition">
                    <span class="flex-shrink-0 w-8 h-8 rounded-full bg-brand-accent text-white flex items-center justify-center font-bold text-sm">
                        {{ $index + 1 }}
                    </span>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $article->title }}</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">{{ number_format($article->view_count) }} views</p>
                    </div>
                    <a href="{{ route('blog-admin.articles.edit', $article->id) }}" class="flex-shrink-0 text-brand-accent hover:text-orange-600 transition">
                        <span class="sr-only">Edit article</span>
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                        </svg>
                    </a>
                </div>
            @empty
                <p class="text-center text-gray-400 py-8">No articles found</p>
            @endforelse
        </div>
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 p-6">
        <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-6">Device & Platform Analytics</h3>
        @php
            $totalDeviceVisits = $stats['mobile_visits'] + $stats['desktop_visits'] + $stats['tablet_visits'];
            $mobilePercent = $totalDeviceVisits > 0 ? round(($stats['mobile_visits'] / $totalDeviceVisits) * 100, 1) : 0;
            $desktopPercent = $totalDeviceVisits > 0 ? round(($stats['desktop_visits'] / $totalDeviceVisits) * 100, 1) : 0;
            $tabletPercent = $totalDeviceVisits > 0 ? round(($stats['tablet_visits'] / $totalDeviceVisits) * 100, 1) : 0;
        @endphp

        <div class="space-y-5">
            <div>
                <div class="flex justify-between text-sm font-semibold text-gray-700 dark:text-gray-300">
                    <span>Mobile</span>
                    <span>{{ number_format($stats['mobile_visits']) }} ({{ $mobilePercent }}%)</span>
                </div>
                <div class="mt-2 h-2 rounded-full bg-gray-200 dark:bg-gray-700">
                    <div class="h-2 rounded-full bg-brand-accent" style="width: {{ $mobilePercent }}%"></div>
                </div>
            </div>

            <div>
                <div class="flex justify-between text-sm font-semibold text-gray-700 dark:text-gray-300">
                    <span>Desktop</span>
                    <span>{{ number_format($stats['desktop_visits']) }} ({{ $desktopPercent }}%)</span>
                </div>
                <div class="mt-2 h-2 rounded-full bg-gray-200 dark:bg-gray-700">
                    <div class="h-2 rounded-full bg-blue-500" style="width: {{ $desktopPercent }}%"></div>
                </div>
            </div>

            <div>
                <div class="flex justify-between text-sm font-semibold text-gray-700 dark:text-gray-300">
                    <span>Tablet</span>
                    <span>{{ number_format($stats['tablet_visits']) }} ({{ $tabletPercent }}%)</span>
                </div>
                <div class="mt-2 h-2 rounded-full bg-gray-200 dark:bg-gray-700">
                    <div class="h-2 rounded-full bg-purple-500" style="width: {{ $tabletPercent }}%"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
    <div class="p-6 pb-4">
        <h3 class="text-lg font-bold text-gray-900 dark:text-white">Recent Visits</h3>
    </div>
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
            <thead class="bg-gray-50 dark:bg-gray-900">
                <tr>
                    <th class="px-4 py-3 text-left text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Visitor</th>
                    <th class="px-4 py-3 text-left text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Content Viewed</th>
                    <th class="px-4 py-3 text-left text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Device</th>
                    <th class="px-4 py-3 text-left text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Referer</th>
                    <th class="px-4 py-3 text-right text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Time</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                @forelse($recentVisits as $visit)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition">
                        <td class="px-4 py-4">
                            <div class="text-sm font-medium text-gray-900 dark:text-white">{{ $visit->ip_address }}</div>
                            <div class="text-xs text-gray-500 dark:text-gray-400">
                                {{ $visit->city ?: 'Unknown' }}{{ $visit->city && $visit->country ? ', ' : '' }}{{ $visit->country ?: '' }}
                            </div>
                        </td>
                        <td class="px-4 py-4">
                            @if($visit->article)
                                <div class="text-sm font-medium text-gray-900 dark:text-white">{{ Str::limit($visit->article->title, 40) }}</div>
                                <div class="text-xs text-gray-500">Article</div>
                            @else
                                <div class="text-sm text-gray-500 dark:text-gray-400">{{ Str::limit(str_replace(url('/'), '', $visit->url) ?: '/', 50) }}</div>
                            @endif
                        </td>
                        <td class="px-4 py-4 text-sm text-gray-700 dark:text-gray-300">{{ ucfirst($visit->device_type ?: 'desktop') }}</td>
                        <td class="px-4 py-4">
                            <div class="text-xs text-gray-500 dark:text-gray-400 max-w-[200px] truncate">
                                {{ $visit->referer ? parse_url($visit->referer, PHP_URL_HOST) : '-' }}
                            </div>
                        </td>
                        <td class="px-4 py-4 text-right">
                            <div class="text-xs text-gray-500 dark:text-gray-400">{{ $visit->created_at->format('M d, Y') }}</div>
                            <div class="text-xs text-gray-400">{{ $visit->created_at->format('h:i A') }}</div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-4 py-10 text-center text-gray-400">No visits recorded yet</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @include('blog::admin.components.pagination', ['paginator' => $recentVisits, 'label' => 'visits'])
</div>
@endsection
