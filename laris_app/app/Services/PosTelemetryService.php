<?php

namespace App\Services;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Store;
use Carbon\Carbon;

class PosTelemetryService
{
    /**
     * Mengambil telemetri ringkasan penjualan multi-channel hari ini
     */
    public function getTodayTelemetry(): array
    {
        $today = Carbon::today();
        $user = auth()->user();
        $storeId = ($user && $user->store_id) ? $user->store_id : 1;

        $todayOrders = Order::where('store_id', $storeId)->whereDate('created_at', $today);
        $todayRevenue = (float) $todayOrders->sum('total_amount');
        $todayProfit = (float) $todayOrders->sum('gross_profit');
        $ordersCount = $todayOrders->count();

        // Data riil dari database (tanpa dummy baseline)
        if ($ordersCount === 0) {
            $recent24h = Order::where('store_id', $storeId)->where('created_at', '>=', Carbon::now()->subHours(24));
            if ($recent24h->count() > 0) {
                $todayRevenue = (float) $recent24h->sum('total_amount');
                $todayProfit = (float) $recent24h->sum('gross_profit');
                $ordersCount = $recent24h->count();
            }
        }

        $marginPct = $todayRevenue > 0 ? round(($todayProfit / $todayRevenue) * 100, 1) : 0;

        // Channel breakdown riil
        $channels = Order::where('store_id', $storeId)
            ->selectRaw('channel, SUM(total_amount) as total, COUNT(*) as orders_count')
            ->whereDate('created_at', $today)
            ->groupBy('channel')
            ->get();

        if ($channels->isEmpty()) {
            $channels = Order::where('store_id', $storeId)
                ->selectRaw('channel, SUM(total_amount) as total, COUNT(*) as orders_count')
                ->where('created_at', '>=', Carbon::now()->subHours(24))
                ->groupBy('channel')
                ->get();
        }

        return [
            'revenue_today' => $todayRevenue,
            'net_profit_today' => $todayProfit,
            'margin_pct' => $marginPct,
            'orders_count' => $ordersCount,
            'channel_breakdown' => $channels,
            'last_sync' => now()->format('H:i') . ' WIB',
        ];
    }

    /**
     * Simulasi Webhook Pesanan Masuk Otomatis dari Marketplace (Shopee/Tokopedia)
     */
    public function simulateMarketplaceWebhook(string $channel = 'Shopee'): Order
    {
        $orderService = app(OrderService::class);
        $user = auth()->user();
        $storeId = ($user && $user->store_id) ? $user->store_id : 1;

        $randomProduct = Product::where('store_id', $storeId)->where('current_stock', '>', 5)->inRandomOrder()->first() 
            ?: Product::where('store_id', $storeId)->where('current_stock', '>', 0)->first()
            ?: Product::where('current_stock', '>', 0)->first();

        if (!$randomProduct) {
            throw new \Exception("Tidak dapat mensimulasikan pesanan webhook: Semua produk di gerai sedang kehabisan stok.");
        }

        $randomQty = min($randomProduct->current_stock, rand(1, 3));
        $paymentMethods = ['ShopeePay', 'GoPay', 'BCA Virtual Account', 'QRIS'];
        $payment = $paymentMethods[array_rand($paymentMethods)];

        return $orderService->processOrder($channel, [
            [
                'product_id' => $randomProduct->id,
                'quantity' => $randomQty,
            ]
        ], $payment);
    }
}
