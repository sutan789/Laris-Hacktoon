<?php

namespace App\Http\Controllers;

use App\Models\MarketTrend;
use Illuminate\Http\Request;

class TrendController extends Controller
{
    public function index(Request $request)
    {
        $query = MarketTrend::query();

        if ($request->filled('q')) {
            $keyword = trim($request->input('q'));
            $query->where('trend_name', 'like', "%{$keyword}%");
        }

        if ($request->filled('category') && $request->input('category') !== 'all') {
            $cat = $request->input('category');
            $query->where(function ($q) use ($cat) {
                $q->where('category', 'like', "%{$cat}%")
                  ->orWhere('trend_name', 'like', "%{$cat}%");
            });
        }

        $allMatching = $query->orderByDesc('signal_strength')->get();

        if ($allMatching->isEmpty() && $request->filled('q')) {
            $allMatching = MarketTrend::all();
        }

        $heroTrend = $allMatching->first() ?: MarketTrend::first();
        $trendingItems = $allMatching->where('id', '!=', $heroTrend ? $heroTrend->id : 0);

        if ($request->ajax()) {
            return response()->json([
                'status' => 'success',
                'hero' => $heroTrend,
                'items' => $trendingItems->values(),
                'total' => $allMatching->count(),
            ]);
        }

        return view('pages.trend_hunter', compact('heroTrend', 'trendingItems'));
    }
}
