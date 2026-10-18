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
        $historyPredictions = OpportunityPrediction::latest()->take(8)->get();

        $productName = $request->query('product_name', 'Pensil Labubu Blind Box');
        $category = $request->query('category', 'Stationery & Giftware');
        $customImage = $request->query('image_url');
        $imageUrl = self::resolveProductImage($productName, $category, $customImage);

        // Support prefill dinamis dari Trend Hunter & Dashboard Radar Spotlight
        $costQuery = $request->query('cost_price') ?? $request->query('cost') ?? 22000;
        $sellQuery = $request->query('selling_price') ?? $request->query('price') ?? 35000;

        $prefill = [
            'product_name' => $productName,
            'category' => $category,
            'cost_price' => (float) $costQuery,
            'selling_price' => (float) $sellQuery,
            'image_url' => $imageUrl,
        ];

        return view('pages.predict', compact('latestPrediction', 'historyPredictions', 'prefill'));
    }

    public static function resolveProductImage(string $name, string $category, ?string $customUrl = null): string
    {
        if (!empty($customUrl) && filter_var($customUrl, FILTER_VALIDATE_URL)) {
            return $customUrl;
        }

        $lower = strtolower($name . ' ' . $category);

        if (str_contains($lower, 'labubu') || str_contains($lower, 'pensil') || str_contains($lower, 'pencil') || str_contains($lower, 'stationery')) {
            return 'https://images.unsplash.com/photo-1563245372-f21724e3856d?w=300&auto=format&fit=crop&q=80';
        }
        if (str_contains($lower, 'kopi') || str_contains($lower, 'coffee') || str_contains($lower, 'espresso') || str_contains($lower, 'drip') || str_contains($lower, 'gayo')) {
            return 'https://images.unsplash.com/photo-1514432324607-a09d9b4aefdd?w=300&auto=format&fit=crop&q=80';
        }
        if (str_contains($lower, 'tumbler') || str_contains($lower, 'botol') || str_contains($lower, 'bottle') || str_contains($lower, 'cup') || str_contains($lower, 'drinkware')) {
            return 'https://images.unsplash.com/photo-1517256064527-09c73fc73e38?w=300&auto=format&fit=crop&q=80';
        }
        if (str_contains($lower, 'kabel') || str_contains($lower, 'cable') || str_contains($lower, 'charger') || str_contains($lower, 'gadget') || str_contains($lower, 'type-c')) {
            return 'https://images.unsplash.com/photo-1583863788434-e58a36330cf0?w=300&auto=format&fit=crop&q=80';
        }
        if (str_contains($lower, 'beras') || str_contains($lower, 'rice') || str_contains($lower, 'sembako') || str_contains($lower, 'minyak') || str_contains($lower, 'telur')) {
            return 'https://images.unsplash.com/photo-1586201375761-83865001e31c?w=300&auto=format&fit=crop&q=80';
        }
        if (str_contains($lower, 'geprek') || str_contains($lower, 'ayam') || str_contains($lower, 'chicken') || str_contains($lower, 'kuliner') || str_contains($lower, 'makan')) {
            return 'https://images.unsplash.com/photo-1626082927389-6cd097cdc6ec?w=300&auto=format&fit=crop&q=80';
        }
        if (str_contains($lower, 'roti') || str_contains($lower, 'bread') || str_contains($lower, 'pastry') || str_contains($lower, 'cromboloni') || str_contains($lower, 'croissant')) {
            return 'https://images.unsplash.com/photo-1509440159596-0249088772ff?w=300&auto=format&fit=crop&q=80';
        }
        if (str_contains($lower, 'rendang') || str_contains($lower, 'daging') || str_contains($lower, 'beef')) {
            return 'https://images.unsplash.com/photo-1544025162-d76694265947?w=300&auto=format&fit=crop&q=80';
        }
        if (str_contains($lower, 'batik') || str_contains($lower, 'kemeja') || str_contains($lower, 'baju') || str_contains($lower, 'fashion') || str_contains($lower, 'pakaian')) {
            return 'https://images.unsplash.com/photo-1598033129183-c4f50c736f10?w=300&auto=format&fit=crop&q=80';
        }
        if (str_contains($lower, 'hijab') || str_contains($lower, 'jilbab') || str_contains($lower, 'scarf') || str_contains($lower, 'voal')) {
            return 'https://images.unsplash.com/photo-1584917865442-de89df76afd3?w=300&auto=format&fit=crop&q=80';
        }
        if (str_contains($lower, 'rotan') || str_contains($lower, 'kerajinan') || str_contains($lower, 'craft') || str_contains($lower, 'kriya')) {
            return 'https://images.unsplash.com/photo-1616046229478-9901c5536a45?w=300&auto=format&fit=crop&q=80';
        }
        if (str_contains($lower, 'laundry') || str_contains($lower, 'cuci') || str_contains($lower, 'jasa')) {
            return 'https://images.unsplash.com/photo-1517677208171-0bc6725a3e60?w=300&auto=format&fit=crop&q=80';
        }

        return 'https://images.unsplash.com/photo-1559056199-641a0ac8b55e?w=300&auto=format&fit=crop&q=80';
    }

    public function simulate(Request $request)
    {
        $request->validate([
            'product_name' => 'required|string',
            'cost_price' => 'required|numeric|min:0',
            'selling_price' => 'required|numeric|min:0',
            'batch_size' => 'nullable|integer',
            'image_url' => 'nullable|string',
        ]);

        $cost = (float) $request->cost_price;
        $sell = (float) $request->selling_price;
        $batch = (int) ($request->batch_size ?: 50);
        $category = $request->category ?: 'Stationery & Giftware';
        $imageUrl = self::resolveProductImage($request->product_name, $category, $request->image_url);

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
            'image_url' => $imageUrl,
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
                'image_url' => $imageUrl,
                'profit_per_unit' => max(0, $sell - $cost),
                'bep_day' => $aiResult['bep_day'] ?? 14,
                'rating_label' => $aiResult['rating_label'] ?? 'Peluang Sangat Tinggi',
                'rating_desc' => $aiResult['rating_desc'] ?? '',
                'is_live_ai' => $aiResult['is_live_ai'] ?? false,
            ]);
        }

        return redirect()->route('predict.index')->with('prediction', $prediction)->with('success', 'Simulasi berhasil dihitung oleh Juragan AI!');
    }

    public function analyzeImage(Request $request)
    {
        $request->validate([
            'image' => 'nullable|file|image|mimes:jpeg,png,jpg,webp|max:5120',
            'image_url' => 'nullable|string|max:1000',
        ]);

        $uploadedPath = null;
        $imageUrl = $request->input('image_url');
        $originalName = null;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $originalName = $file->getClientOriginalName();
            $filename = 'predict_' . time() . '_' . \Illuminate\Support\Str::random(6) . '.' . $file->getClientOriginalExtension();
            $destination = public_path('uploads/predict');
            if (!file_exists($destination)) {
                mkdir($destination, 0755, true);
            }
            $file->move($destination, $filename);
            $uploadedPath = $destination . DIRECTORY_SEPARATOR . $filename;
            $imageUrl = asset('uploads/predict/' . $filename);
        }

        $analysis = $this->aiService->analyzeProductImage($uploadedPath, $imageUrl, $originalName);

        return response()->json($analysis);
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

        $imageUrl = $prediction->image_url ?: self::resolveProductImage($prediction->product_name, $prediction->category);

        $product = \App\Models\Product::create([
            'store_id' => $store ? $store->id : 1,
            'name' => $prediction->product_name,
            'sku' => $sku,
            'category' => $prediction->category,
            'image_url' => $imageUrl,
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
