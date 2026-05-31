<?php

use Modules\Blog\Models\Article;
use Modules\Blog\Models\Visit;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

if (! function_exists('visitorClientIp')) {
    function visitorClientIp(): ?string
    {
        $request = request();

        foreach (['CF-Connecting-IP', 'True-Client-IP', 'X-Real-IP'] as $header) {
            $ip = $request->headers->get($header);

            if ($ip && filter_var($ip, FILTER_VALIDATE_IP)) {
                return $ip;
            }
        }

        $forwardedFor = $request->headers->get('X-Forwarded-For');

        if ($forwardedFor) {
            foreach (explode(',', $forwardedFor) as $ip) {
                $ip = trim($ip);

                if (filter_var($ip, FILTER_VALIDATE_IP)) {
                    return $ip;
                }
            }
        }

        return $request->ip();
    }
}

if (! function_exists('visitorDeviceType')) {
    function visitorDeviceType(?string $userAgent): string
    {
        if (preg_match('/tablet|ipad/i', $userAgent ?? '')) {
            return 'tablet';
        }

        if (preg_match('/mobile|android|iphone|ipod/i', $userAgent ?? '')) {
            return 'mobile';
        }

        return 'desktop';
    }
}

if (! function_exists('visitorLocationForIp')) {
    function visitorLocationForIp(?string $ip): array
    {
        $empty = [
            'country' => null,
            'region' => null,
            'city' => null,
        ];

        if (! $ip) {
            return $empty;
        }

        if (! filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE)) {
            return [
                'country' => 'Local Network',
                'region' => null,
                'city' => null,
            ];
        }

        return Cache::remember("visitor_location:{$ip}", now()->addDays(7), function () use ($ip, $empty) {
            try {
                $response = Http::timeout(2)
                    ->acceptJson()
                    ->get("http://ip-api.com/json/{$ip}", [
                        'fields' => 'status,message,country,regionName,city,query',
                    ]);

                if (! $response->ok() || $response->json('status') !== 'success') {
                    return $empty;
                }

                return [
                    'country' => $response->json('country'),
                    'region' => $response->json('regionName'),
                    'city' => $response->json('city'),
                ];
            } catch (\Throwable $exception) {
                Log::debug('Visitor geolocation lookup failed', [
                    'ip' => $ip,
                    'message' => $exception->getMessage(),
                ]);

                return $empty;
            }
        });
    }
}

if (! function_exists('trackVisit')) {
    function trackVisit(string $type = 'page', ?int $id = null): void
    {
        $request = request();
        $userAgent = $request->userAgent();
        $ip = visitorClientIp();
        $location = visitorLocationForIp($ip);

        $data = [
            'ip_address' => $ip,
            'user_agent' => $userAgent,
            'url' => $request->fullUrl(),
            'method' => $request->method(),
            'country' => $location['country'],
            'region' => $location['region'],
            'city' => $location['city'],
            'referer' => $request->header('referer'),
            'device_type' => visitorDeviceType($userAgent),
        ];

        if ($type === 'article' && $id) {
            $data['article_id'] = $id;
        }

        Visit::create($data);
    }
}

if (! function_exists('getVisitsStats')) {
    function getVisitsStats(): array
    {
        return [
            'total_visits' => Visit::count(),
            'today_visits' => Visit::whereDate('created_at', today())->count(),
            'this_week_visits' => Visit::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->count(),
            'this_month_visits' => Visit::whereMonth('created_at', now()->month)->count(),
            'article_visits' => Visit::whereNotNull('article_id')->count(),
            'unique_visitors' => Visit::distinct('ip_address')->count('ip_address'),
            'mobile_visits' => Visit::where('device_type', 'mobile')->count(),
            'desktop_visits' => Visit::where('device_type', 'desktop')->count(),
            'tablet_visits' => Visit::where('device_type', 'tablet')->count(),
        ];
    }
}

if (! function_exists('getMostViewedArticles')) {
    function getMostViewedArticles(int $limit = 10)
    {
        return Article::orderBy('view_count', 'desc')->limit($limit)->get();
    }
}
