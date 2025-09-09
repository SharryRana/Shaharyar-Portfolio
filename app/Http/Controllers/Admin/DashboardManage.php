<?php

namespace App\Http\Controllers\Admin;

use App\Models\Visitor;
use Illuminate\Http\Request;
use App\Models\Contact\Contactus;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class DashboardManage extends Controller
{
    public function dashboard(Request $request)
    {

        // Stats
        $totalVisitors   = Visitor::count();
        $activeVisitors  = Visitor::where('status', 'active')->count();
        $totalMessages   = Contactus::count();
        $unreadMessages  = Contactus::where('read_or_not', 'unread')->count();

        $visitorStatsRaw = Visitor::select(
            DB::raw('MONTH(created_at) as month'),
            DB::raw('COUNT(*) as total')
        )
            ->groupBy('month')
            ->pluck('total', 'month')
            ->toArray();

        // Fill all 12 months
        $visitorStats = [];
        for ($i = 1; $i <= 12; $i++) {
            $visitorStats[$i] = $visitorStatsRaw[$i] ?? 0;
        }

        // Messages per month
        $messageStatsRaw = Contactus::select(
            DB::raw('MONTH(created_at) as month'),
            DB::raw('COUNT(*) as total')
        )
            ->groupBy('month')
            ->pluck('total', 'month')
            ->toArray();

        $messageStats = [];
        for ($i = 1; $i <= 12; $i++) {
            $messageStats[$i] = $messageStatsRaw[$i] ?? 0;
        }


        // Recent Messages
        $recentMessages = Contactus::latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalVisitors',
            'activeVisitors',
            'totalMessages',
            'unreadMessages',
            'visitorStats',
            'messageStats',
            'recentMessages'
        ));
    }
}
