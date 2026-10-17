<?php

namespace App\Http\Controllers;

use App\Models\MarketTrend;
use Illuminate\Http\Request;

class TrendController extends Controller
{
    public function index(Request $request)
    {
        $heroTrend = MarketTrend::where('stage', 'Early Stage')->first() ?: MarketTrend::first();
        $trendingItems = MarketTrend::where('id', '!=', $heroTrend ? $heroTrend->id : 0)->get();

        return view('pages.trend_hunter', compact('heroTrend', 'trendingItems'));
    }
}
