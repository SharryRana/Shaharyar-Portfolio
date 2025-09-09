<?php

namespace App\Http\Controllers\Visotors;

use App\Models\Visitor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VisitorController extends Controller
{
    public function index()
    {
        $data = Visitor::orderBy('created_at', 'desc')->latest()->paginate(5);

        // Get stats
        $totalCountries = Visitor::select('country')
            ->whereNotNull('country')
            ->distinct()
            ->count();

        $mobileVisitors = Visitor::where('user_agent', 'like', '%Mobile%')->count();
        $webVisitors = Visitor::where('user_agent', 'not like', '%Mobile%')->count();

        // Country distribution for chart
        $countryStats = Visitor::selectRaw('country, COUNT(*) as total')
            ->whereNotNull('country')
            ->groupBy('country')
            ->orderByDesc('total')
            ->get();

        return view('admin.visitors.index', compact(
            'data',
            'totalCountries',
            'mobileVisitors',
            'webVisitors',
            'countryStats'
        ));
    }


    public function toggleStatus(Request $request)
    {
        if ($request->id) {
            $visitor = Visitor::find($request->id);

            $ip_adresses = Visitor::where('ip', $visitor->ip)->get();
            foreach ($ip_adresses as $ip) {
                $ip->status = $ip->status === 'active' ? 'blocked' : 'active';
                $ip->save();
            }

            return response()->json(['message' => 'Visitor status updated successfully.', 'newStatus' => $visitor->status]);
        }

        return response()->json(['error' => 'Visitor ID is required.'], 400);
    }

    public function destroy(Request $request)
    {

        if ($request->id) {
            $data = Visitor::find($request->id);
            $data->delete();

            return response()->json(['message' => 'Visitor deleted successfully...']);
        }

        return response()->json(['error' => 'Message ID is required.'], 400);
    }
}
