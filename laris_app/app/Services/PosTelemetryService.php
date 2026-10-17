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

        $todayOrders = Order::whereDate('created_at', $today);
        $todayRevenue = (float) $todayOrders->sum('total_amount');
        $todayProfit = (float) $todayOrders->sum('gross_profit');
        $ordersCount = $todayOrders->count();

        // Baseline untuk demo dashboard jika transaksi baru sedikit
        $baseRevenue = 45200000;
        $baseProfit = 15800000;

        $finalRevenue = $todayRevenue > 0 ? ($baseRevenue + $todayRevenue) : $baseRevenue;
        $finalProfit = $todayProfit > 0 ? ($baseProfit + $todayProfit) : $baseProfit;
        $marginPct = $finalRevenue > 0 ? round(($finalProfit / $finalRevenue) * 100, 1) : 34.9;

        // Channel breakdown
        $channels = Order::selectRaw('channel, SUM(total_amount) as total, COUNT(*) as orders_count')
            ->whereDate('created_at', $today)
            ->groupBy('channel')
            ->get();

        return [
            'revenue_today' => $finalRevenue,
            'net_profit_today' => $finalProfit,
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
        $randomProduct = Product::where('current_stock', '>', 5)->inRandomOrder()->first() ?: Product::first();

        $randomQty = rand(1, 3);
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
