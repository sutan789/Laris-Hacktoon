<?php

namespace App\Http\Controllers;

use App\Services\OrderService;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Http\Request;

class PosController extends Controller
{
    protected OrderService $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    /**
     * Endpoint untuk checkout transaksi baru (Offline Store, Shopee, Tokopedia)
     */
    public function checkout(Request $request)
    {
        $request->validate([
            'channel' => 'required|string|in:Shopee,Tokopedia,Offline Store',
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
            'payment_method' => 'nullable|string',
        ]);

        $order = $this->orderService->processOrder(
            $request->input('channel'),
            $request->input('items'),
            $request->input('payment_method', 'QRIS')
        );

        return response()->json([
            'status' => 'success',
            'message' => "Transaksi {$order->order_number} berhasil diproses!",
            'data' => [
                'order_number' => $order->order_number,
                'channel' => $order->channel,
                'total_amount' => $order->total_amount,
                'gross_profit' => $order->gross_profit,
                'status' => $order->status,
            ]
        ], 201);
    }

    /**
     * Mendapatkan riwayat transaksi terkini
     */
    public function recentOrders()
    {
        $orders = Order::with('items.product')->latest()->take(10)->get();

        return response()->json([
            'status' => 'success',
            'data' => $orders,
        ]);
    }
}
