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

        $cashReceived = (float) $request->input('cash_received', 0);

        try {
            $order = $this->orderService->processOrder(
                $request->input('channel'),
                $request->input('items'),
                $request->input('payment_method', 'QRIS')
            );
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 422);
        }

        $order->load(['items.product', 'store']);
        $changeAmount = max(0, $cashReceived - (float)$order->total_amount);

        return response()->json([
            'status' => 'success',
            'message' => "Transaksi {$order->order_number} berhasil diproses!",
            'data' => [
                'id' => $order->id,
                'order_number' => $order->order_number,
                'channel' => $order->channel,
                'total_amount' => $order->total_amount,
                'gross_profit' => $order->gross_profit,
                'status' => $order->status,
                'payment_method' => $order->payment_method,
                'cash_received' => $cashReceived,
                'change_amount' => $changeAmount,
                'created_at' => $order->created_at->format('d/m/Y H:i'),
                'items' => $order->items->map(function ($it) {
                    return [
                        'name' => $it->product ? $it->product->name : 'Produk',
                        'quantity' => $it->quantity,
                        'unit_price' => $it->unit_selling_price,
                        'subtotal' => $it->subtotal,
                    ];
                }),
                'store' => [
                    'name' => $order->store->name ?? 'LARIS Smart Store',
                    'address' => $order->store->address ?? 'Jl. Dipati Ukur No. 112, Bandung',
                    'phone' => $order->store->phone ?? '0812-3456-7890',
                ]
            ]
        ], 201);
    }

    /**
     * Mendownload struk dalam format PDF
     */
    public function downloadReceiptPdf($id)
    {
        $order = Order::with(['items.product', 'store'])->findOrFail($id);
        $store = $order->store ?? \App\Models\Store::first();

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('reports.receipt_pdf', [
            'order' => $order,
            'store' => $store,
        ]);
        $pdf->setPaper([0, 0, 226.77, 500], 'portrait');

        return $pdf->download("struk-{$order->order_number}.pdf");
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
