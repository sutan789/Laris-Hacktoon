<?php

namespace App\Http\Controllers;

use App\Models\OpportunityPrediction;
use App\Models\Store;
use App\Services\AiService;
use Illuminate\Http\Request;

class PredictController extends Controller
{
    protected AiService $aiService;

    public function __construct(AiService $aiService)
    {
        $this->aiService = $aiService;
    }

    public function index(Request $request)
    {
        $latestPrediction = OpportunityPrediction::latest()->first();

        // Support prefill dari Trend Hunter
        $prefill = [
            'product_name' => $request->query('product_name', 'Pensil Labubu Premium Edition'),
            'category' => $request->query('category', 'Stationery & Toys'),
            'cost_price' => $request->query('cost_price', 8500),
            'selling_price' => $request->query('selling_price', 18000),
        ];

        return view('pages.predict', compact('latestPrediction', 'prefill'));
    }

    public function simulate(Request $request)
    {
        $request->validate([
            'product_name' => 'required|string',
            'cost_price' => 'required|numeric|min:0',
            'selling_price' => 'required|numeric|min:0',
            'batch_size' => 'nullable|integer',
        ]);

        $cost = (float) $request->cost_price;
        $sell = (float) $request->selling_price;
        $batch = (int) ($request->batch_size ?: 50);
        $category = $request->category ?: 'Stationery & Toys';

        $aiResult = $this->aiService->predictOpportunity(
            $request->product_name,
            $category,
            $cost,
            $sell,
            $batch
        );

        $store = Store::first();
        $prediction = OpportunityPrediction::create([
            'store_id' => $store ? $store->id : 1,
            'product_name' => $request->product_name,
            'category' => $category,
            'cost_price' => $cost,
            'selling_price' => $sell,
            'gross_margin_pct' => $aiResult['gross_margin_pct'],
            'opportunity_score' => $aiResult['opportunity_score'],
            'confidence_pct' => $aiResult['confidence_pct'],
            'estimated_demand_range' => $aiResult['estimated_demand_range'],
            'projected_revenue' => $aiResult['projected_revenue'],
            'projected_net_profit' => $aiResult['projected_net_profit'],
            'key_insights' => $aiResult['key_insights'],
        ]);

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'status' => 'success',
                'data' => $prediction,
                'profit_per_unit' => max(0, $sell - $cost),
            ]);
        }

        return redirect()->route('predict.index')->with('prediction', $prediction)->with('success', 'Simulasi berhasil dihitung oleh LARIS AI!');
    }

    public function addToInventory(Request $request)
    {
        $request->validate([
            'prediction_id' => 'required|exists:opportunity_predictions,id',
        ]);

        $prediction = OpportunityPrediction::findOrFail($request->prediction_id);
        $store = Store::first();

        // Buat SKU acak unik
        $prefix = strtoupper(substr(preg_replace('/[^A-Za-z]/', '', $prediction->category), 0, 3));
        $sku = ($prefix ?: 'PRD') . '-' . strtoupper(substr(uniqid(), -5));

        $product = \App\Models\Product::create([
            'store_id' => $store ? $store->id : 1,
            'name' => $prediction->product_name,
            'sku' => $sku,
            'category' => $prediction->category,
            'cost_price' => $prediction->cost_price,
            'selling_price' => $prediction->selling_price,
            'current_stock' => 50, // Trial batch awal masuk ke inventaris
            'min_threshold' => 20,
            'health_status' => 'Healthy',
            'ai_velocity' => 3.5,
            'stock_runway_days' => 14,
            'supplier_name' => 'Distributor Rekanan Terverifikasi',
            'supplier_lead_time_days' => 2,
            'is_dead_stock' => false,
            'dead_stock_days' => 0,
        ]);

        return redirect()->route('inventory.index')->with('success', "Produk baru '{$product->name}' (SKU: {$product->sku}) berhasil didaftarkan ke Smart Inventory dengan stok awal 50 unit!");
    }
}
