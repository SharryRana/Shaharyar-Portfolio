<?php

namespace Modules\Blog\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\Blog\Models\NewsletterSubscriber;

class NewsletterSubscriberController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        $request->merge([
            'email' => strtolower(trim((string) $request->input('email'))),
        ]);

        $validated = $request->validate([
            'email' => ['required', 'email', 'max:255', 'unique:newsletter_subscribers,email'],
        ], [
            'email.unique' => 'This email is already subscribed.',
        ]);

        NewsletterSubscriber::create([
            'email' => strtolower($validated['email']),
            'status' => 'active',
            'ip_address' => $this->clientIp($request),
            'user_agent' => $request->userAgent(),
        ]);

        return response()->json([
            'message' => 'Thanks for subscribing. You are on the Creavibe list now.',
        ]);
    }

    private function clientIp(Request $request): ?string
    {
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
