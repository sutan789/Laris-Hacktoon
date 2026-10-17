<?php

namespace App\Services;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\OperationalAlert;
use App\Models\Store;
use Illuminate\Support\Facades\DB;

class OrderService
{
    /**
     * Memproses pesanan masuk (Kasir POS, Shopee, Tokopedia) secara atomik
     */
    public function processOrder(string $channel, array $items, string $paymentMethod = 'QRIS'): Order
    {
        return DB::transaction(function () use ($channel, $items, $paymentMethod) {
            $store = Store::first();
            $storeId = $store ? $store->id : 1;

            $totalAmount = 0;
            $totalCost = 0;
            $itemsData = [];

            // 1. Validasi & Kalkulasi Finansial
            foreach ($items as $item) {
                $product = Product::lockForUpdate()->findOrFail($item['product_id']);
                $qty = (int) $item['quantity'];

                $itemSubtotal = $product->selling_price * $qty;
                $itemCostTotal = $product->cost_price * $qty;

                $totalAmount += $itemSubtotal;
                $totalCost += $itemCostTotal;

                // 2. Pengurangan Stok Atomik (Atomic Depletion)
                $product->current_stock = max(0, $product->current_stock - $qty);

                // 3. Update Laju Penjualan AI (Velocity) & Runway Sisa Hari
                $product->ai_velocity = round(max(0.5, $product->ai_velocity + ($qty * 0.1)), 2);
                $product->stock_runway_days = (int) floor($product->current_stock / ($product->ai_velocity ?: 1));

                // 4. Deteksi Kesehatan Inventaris & Pembuatan Alert Otomatis
                if ($product->stock_runway_days <= 4 || $product->current_stock <= $product->min_threshold) {
                    $product->health_status = 'Critical';

                    // Buat atau perbarui operational alert jika belum ada
                    OperationalAlert::firstOrCreate([
                        'store_id' => $storeId,
                        'product_name' => $product->name,
                        'alert_type' => 'imminent_stockout',
                        'is_resolved' => false,
                    ], [
                        'badge_text' => 'SISA ' . $product->current_stock . ' UNIT',
                        'description' => "Stok menipis drastis akibat lonjakan transaksi kanal {$channel}. Segera restock!",
                        'action_label' => 'Order Ulang',
                        'action_url' => '/smart-inventory',
                    ]);
                } elseif ($product->stock_runway_days <= 7) {
                    $product->health_status = 'Attention';
                } else {
                    $product->health_status = 'Healthy';
                }

                $product->save();

                $itemsData[] = [
                    'product_id' => $product->id,
                    'quantity' => $qty,
                    'unit_selling_price' => $product->selling_price,
                    'unit_cost_price' => $product->cost_price,
                    'subtotal' => $itemSubtotal,
                ];
            }

            $grossProfit = max(0, $totalAmount - $totalCost);

            // Channel Prefix
            $prefix = match(strtolower($channel)) {
                'shopee' => 'SHP',
                'tokopedia' => 'TKP',
                default => 'POS'
            };
            $orderNumber = "ORD-{$prefix}-" . date('Ymd') . '-' . strtoupper(substr(uniqid(), -4));

            // 5. Simpan Order
            $order = Order::create([
                'order_number' => $orderNumber,
                'store_id' => $storeId,
                'channel' => $channel,
                'total_amount' => $totalAmount,
                'total_cost' => $totalCost,
                'gross_profit' => $grossProfit,
                'payment_method' => $paymentMethod,
                'status' => 'Completed',
            ]);

            foreach ($itemsData as $row) {
                $row['order_id'] = $order->id;
                OrderItem::create($row);
            }

            return $order;
        });
    }
}
