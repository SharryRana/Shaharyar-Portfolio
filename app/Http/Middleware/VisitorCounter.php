<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Stevebauman\Location\Facades\Location;
use App\Models\Visitor;

class VisitorCounter
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */

    public function generateRandomIpV4()
    {
        $octets = [];
        for ($i = 0; $i < 4; $i++) {
            $octets[] = rand(0, 255);
        }
        return implode('.', $octets);
    }


    public function handle(Request $request, Closure $next): Response
    {
       $ip = $this->generateRandomIpV4();
        //$ip = $request->ip();

        $find_ip = Visitor::where('ip', $ip)->first();

        if ($find_ip) {
            if ($find_ip->status !== "active") {
                return response()->json(['error' => "You are not allowed to access my website so get away from my site....."]);
            }
        }

        $userAgent = $request->userAgent();
        $referrer = $request->headers->get('referer');

        // Get location info
        $location = Location::get($ip);

        Visitor::create([
            'ip' => $ip ?? 'Unknown',
            'user_agent' => $userAgent ?? 'Unknown',
            'referrer' => $referrer ?? 'Direct',
            'country' => $location?->countryName ?? 'Unknown',
            'city' => $location?->cityName ?? 'Unknown',
            'status' => 'active',
        ]);

        return $next($request);
    }
}
