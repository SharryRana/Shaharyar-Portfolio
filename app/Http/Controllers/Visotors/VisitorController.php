<?php

namespace App\Http\Controllers\Visotors;

use App\Models\Visitor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VisitorController extends Controller
{
    public function index(Request $request)
    {
        $filters = $request->only(['search', 'country', 'device', 'status', 'date_from', 'date_to']);

        $filteredVisitors = Visitor::query();
        $this->applyFilters($filteredVisitors, $filters);

        $data = (clone $filteredVisitors)
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $totalCountries = Visitor::whereNotNull('country')
            ->where('country', '!=', '')
            ->distinct('country')
            ->count('country');

        $mobileVisitors = Visitor::where('user_agent', 'like', '%Mobile%')->count();
        $webVisitors = Visitor::where('user_agent', 'not like', '%Mobile%')->count();

        $countryOptions = Visitor::whereNotNull('country')
            ->where('country', '!=', '')
            ->distinct()
            ->orderBy('country')
            ->pluck('country');

        $countryStats = (clone $filteredVisitors)
            ->selectRaw('country, COUNT(*) as total')
            ->whereNotNull('country')
            ->where('country', '!=', '')
            ->groupBy('country')
            ->orderByDesc('total')
            ->limit(12)
            ->get();

        return view('admin.visitors.index', compact(
            'data',
            'totalCountries',
            'mobileVisitors',
            'webVisitors',
            'countryOptions',
            'countryStats',
            'filters'
        ));
    }


    public function toggleStatus(Request $request)
    {
        if ($request->id) {
            $visitor = Visitor::findOrFail($request->id);
            $newStatus = $visitor->status === 'active' ? 'blocked' : 'active';

            Visitor::where('ip', $visitor->ip)->update(['status' => $newStatus]);

            return response()->json([
                'message' => 'Visitor status updated successfully.',
                'newStatus' => $newStatus,
            ]);
        }

        return response()->json(['error' => 'Visitor ID is required.'], 400);
    }

    public function destroy(Request $request)
    {

        if ($request->id) {
            $data = Visitor::findOrFail($request->id);
            $data->delete();

            return response()->json(['message' => 'Visitor deleted successfully...']);
        }

        return response()->json(['error' => 'Visitor ID is required.'], 400);
    }

    private function applyFilters($query, array $filters): void
    {
        if (!empty($filters['search'])) {
            $search = trim($filters['search']);

            $query->where(function ($query) use ($search) {
                $query->where('ip', 'like', "%{$search}%")
                    ->orWhere('country', 'like', "%{$search}%")
                    ->orWhere('city', 'like', "%{$search}%")
                    ->orWhere('user_agent', 'like', "%{$search}%")
                    ->orWhere('referrer', 'like', "%{$search}%");
            });
        }

        if (!empty($filters['country'])) {
            $query->where('country', $filters['country']);
        }

        if (!empty($filters['status']) && in_array($filters['status'], ['active', 'blocked'], true)) {
            $query->where('status', $filters['status']);
        }

        if (($filters['device'] ?? null) === 'mobile') {
            $query->where('user_agent', 'like', '%Mobile%');
        }

        if (($filters['device'] ?? null) === 'desktop') {
            $query->where(function ($query) {
                $query->where('user_agent', 'not like', '%Mobile%')
                    ->orWhereNull('user_agent');
            });
        }

        if (!empty($filters['date_from'])) {
            $query->whereDate('created_at', '>=', $filters['date_from']);
        }

        if (!empty($filters['date_to'])) {
            $query->whereDate('created_at', '<=', $filters['date_to']);
        }
    }
}
