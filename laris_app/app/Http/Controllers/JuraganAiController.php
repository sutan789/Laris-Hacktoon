<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Store;
use App\Services\AiService;
use Illuminate\Http\Request;

class JuraganAiController extends Controller
{
    protected AiService $aiService;

    public function __construct(AiService $aiService)
    {
        $this->aiService = $aiService;
    }

    public function index()
    {
        $store = Store::first();
        $criticalProducts = Product::where('health_status', 'Critical')->get();
        $deadStockProducts = Product::where('is_dead_stock', true)->get();

        return view('pages.juragan_ai', compact('store', 'criticalProducts', 'deadStockProducts'));
    }

    public function chat(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        $message = $request->input('message');
        $chatResult = $this->aiService->juraganChat($message);

        if (is_array($chatResult)) {
            $reply = $chatResult['reply'] ?? '';
            $action = $chatResult['action'] ?? null;
            $suggestions = $chatResult['suggestions'] ?? [];
        } else {
            $reply = (string) $chatResult;
            $action = null;
            $suggestions = [];
        }

        return response()->json([
            'status' => 'success',
            'reply' => $reply,
            'action' => $action,
            'suggestions' => $suggestions,
            'timestamp' => now()->format('H:i'),
        ]);
    }

    public function executeAction(Request $request)
    {
        $action = $request->input('action');
        $store = Store::first() ?? Store::create(['name' => 'Toko Berkah Utama']);

        if ($action === 'add_masker_50') {
            $product = Product::where('store_id', $store->id)
                ->where('name', 'like', '%Masker%')
                ->first();

            if (!$product) {
                $product = Product::create([
                    'store_id' => $store->id,
                    'sku' => 'MSK-KN95-001',
                    'name' => 'Masker KN95 Anti-Asap PM2.5',
                    'category' => 'Kesehatan & Proteksi Darurat',
                    'cost_price' => 20000,
                    'selling_price' => 42000,
                    'current_stock' => 50,
                    'min_threshold' => 20,
                    'ai_velocity' => 15,
                    'health_status' => 'Healthy',
                    'image_url' => 'https://images.unsplash.com/photo-1584634731339-252c581abfc5?w=400&auto=format&fit=crop&q=80',
                    'supplier_name' => 'PT Mitra Medika Sentosa',
                    'supplier_lead_time_days' => 2,
                    'stock_runway_days' => 7,
                ]);
            } else {
                $product->increment('current_stock', 50);
                $product->refresh();
            }

            return response()->json([
                'status' => 'success',
                'message' => "Berhasil menambahkan +50 box {$product->name}! Total stok gudang sekarang: {$product->current_stock} unit.",
                'product' => [
                    'name' => $product->name,
                    'current_stock' => $product->current_stock,
                    'unit' => $product->unit ?? 'unit'
                ]
            ]);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Aksi tidak dikenal.'
        ], 400);
    }
}

