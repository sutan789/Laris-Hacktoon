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
        $reply = $this->aiService->juraganChat($message);

        return response()->json([
            'status' => 'success',
            'reply' => $reply,
            'timestamp' => now()->format('H:i'),
        ]);
    }
}
