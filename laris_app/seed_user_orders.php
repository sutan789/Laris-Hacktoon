<?php

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\User;
use App\Models\Store;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Str;

$user = User::where('email', 'user@laris.id')->first();
if (!$user) {
    echo "User not found\n";
    exit(1);
}

// Remove any prior test orders for user to have a clean test dataset
$existing = Order::where('user_id', $user->id)->get();
foreach ($existing as $ex) {
    $ex->items()->delete();
    $ex->delete();
}

$ordersData = [
    // 1. Processing (Diproses Gerai)
    [
        'order_number' => 'ORD-PRC-001',
        'store_id' => 1, // Toko Berkah
        'status' => 'Processing',
        'delivery_type' => 'delivery',
        'delivery_address' => 'Jl. Dago Asri No. 12, RT 03/RW 04, Bandung',
        'delivery_fee' => 5000,
        'payment_method' => 'QRIS',
        'discount_amount' => 10000,
        'voucher_code' => 'DISKON10K',
        'notes' => 'Tolong diantar sebelum jam 12 siang, terima kasih.',
        'created_at' => now()->subMinutes(15),
        'items' => [
            ['sku' => 'SBK-BRS-01', 'qty' => 1],
            ['sku' => 'SBK-MYK-02', 'qty' => 2],
        ]
    ],
    // 2. Processing (Diproses Gerai)
    [
        'order_number' => 'ORD-PRC-002',
        'store_id' => 2, // Dapur Nusantara
        'status' => 'Processing',
        'delivery_type' => 'delivery',
        'delivery_address' => 'Jl. Dago Asri No. 12, RT 03/RW 04, Bandung',
        'delivery_fee' => 7000,
        'payment_method' => 'CASH',
        'discount_amount' => 0,
        'voucher_code' => null,
        'notes' => 'Ayamnya jangan terlalu pedas ya, sambal dipisah.',
        'created_at' => now()->subMinutes(35),
        'items' => [
            ['sku' => 'KLN-AYM-01', 'qty' => 2],
            ['sku' => 'KLN-KPI-02', 'qty' => 2],
        ]
    ],
    // 3. Shipping (Dalam Pengantaran)
    [
        'order_number' => 'ORD-SHP-001',
        'store_id' => 4, // Serambi Batik
        'status' => 'Shipping',
        'delivery_type' => 'delivery',
        'delivery_address' => 'Jl. Dago Asri No. 12, RT 03/RW 04, Bandung',
        'delivery_fee' => 10000,
        'payment_method' => 'BANK',
        'discount_amount' => 7000,
        'voucher_code' => 'GRATISONGKIR',
        'notes' => 'Packing bubble wrap yang rapi ya kak.',
        'created_at' => now()->subHours(2),
        'items' => [
            ['sku' => 'FSH-BTK-01', 'qty' => 1],
        ]
    ],
    // 4. Shipping / Ready for Pickup (Siap Diambil)
    [
        'order_number' => 'ORD-PKP-002',
        'store_id' => 3, // Warung Padang
        'status' => 'Shipping',
        'delivery_type' => 'pickup',
        'delivery_address' => 'Ambil Langsung di Gerai (Jl. Sudirman No. 115, Bandung)',
        'delivery_fee' => 0,
        'payment_method' => 'QRIS',
        'discount_amount' => 0,
        'voucher_code' => null,
        'notes' => 'Bungkus daun pisang ya da.',
        'created_at' => now()->subHours(1),
        'items' => [
            ['sku' => 'KLN-RDG-01', 'qty' => 2],
            ['sku' => 'KLN-TJG-02', 'qty' => 1],
        ]
    ],
    // 5. Completed with 5-star review
    [
        'order_number' => 'ORD-CMP-001',
        'store_id' => 1,
        'status' => 'Completed',
        'delivery_type' => 'delivery',
        'delivery_address' => 'Jl. Dago Asri No. 12, Bandung',
        'delivery_fee' => 5000,
        'payment_method' => 'QRIS',
        'discount_amount' => 0,
        'voucher_code' => null,
        'notes' => null,
        'rating' => 5,
        'review' => 'Bahan sembako sangat fresh, telur utuh tidak ada yang pecah, pengiriman kurir toko super cepat!',
        'created_at' => now()->subDays(1),
        'items' => [
            ['sku' => 'SBK-TLR-03', 'qty' => 2],
            ['sku' => 'SBK-GLA-04', 'qty' => 2],
        ]
    ],
    // 6. Completed without review (Ready to be reviewed)
    [
        'order_number' => 'ORD-CMP-002',
        'store_id' => 2,
        'status' => 'Completed',
        'delivery_type' => 'delivery',
        'delivery_address' => 'Jl. Dago Asri No. 12, Bandung',
        'delivery_fee' => 7000,
        'payment_method' => 'CASH',
        'discount_amount' => 0,
        'voucher_code' => null,
        'notes' => null,
        'rating' => null,
        'review' => null,
        'created_at' => now()->subDays(2),
        'items' => [
            ['sku' => 'KLN-RTB-03', 'qty' => 2],
        ]
    ],
    // 7. Completed with review
    [
        'order_number' => 'ORD-CMP-003',
        'store_id' => 5, // Kriya Anyaman
        'status' => 'Completed',
        'delivery_type' => 'pickup',
        'delivery_address' => 'Ambil di Gerai',
        'delivery_fee' => 0,
        'payment_method' => 'QRIS',
        'discount_amount' => 0,
        'voucher_code' => null,
        'notes' => null,
        'rating' => 5,
        'review' => 'Kualitas anyaman sangat rapi dan kokoh, penjual ramah sekali.',
        'created_at' => now()->subDays(3),
        'items' => [
            ['sku' => 'KRY-RTN-01', 'qty' => 1],
        ]
    ],
    // 8. Completed with review
    [
        'order_number' => 'ORD-CMP-004',
        'store_id' => 6, // Laundry
        'status' => 'Completed',
        'delivery_type' => 'delivery',
        'delivery_address' => 'Jl. Dago Asri No. 12, Bandung',
        'delivery_fee' => 5000,
        'payment_method' => 'QRIS',
        'discount_amount' => 0,
        'voucher_code' => null,
        'notes' => null,
        'rating' => 4,
        'review' => 'Cucian wangi dan rapi banget, tepat waktu 3 jam selesai.',
        'created_at' => now()->subDays(4),
        'items' => [
            ['sku' => 'JSA-LND-01', 'qty' => 1],
        ]
    ],
    // 9. Completed Flash Sale with review
    [
        'order_number' => 'ORD-CMP-005',
        'store_id' => 1,
        'status' => 'Completed',
        'delivery_type' => 'delivery',
        'delivery_address' => 'Jl. Dago Asri No. 12, Bandung',
        'delivery_fee' => 5000,
        'payment_method' => 'QRIS',
        'discount_amount' => 0,
        'voucher_code' => null,
        'notes' => null,
        'rating' => 5,
        'review' => 'Flash sale nya sangat menguntungkan, roti masih fresh exp lama.',
        'created_at' => now()->subDays(5),
        'items' => [
            ['sku' => 'FS-ROTI-01', 'qty' => 2],
        ]
    ],
    // 10. Cancelled
    [
        'order_number' => 'ORD-CNC-001',
        'store_id' => 3,
        'status' => 'Cancelled',
        'delivery_type' => 'pickup',
        'delivery_address' => 'Ambil Langsung di Gerai',
        'delivery_fee' => 0,
        'payment_method' => 'CASH',
        'discount_amount' => 0,
        'voucher_code' => null,
        'notes' => null,
        'cancelled_reason' => 'Salah pilih menu, ingin mengganti pesanan baru',
        'cancelled_at' => now()->subDays(6),
        'created_at' => now()->subDays(6),
        'items' => [
            ['sku' => 'KLN-RDG-01', 'qty' => 1],
        ]
    ],
    // 11. Cancelled
    [
        'order_number' => 'ORD-CNC-002',
        'store_id' => 1,
        'status' => 'Cancelled',
        'delivery_type' => 'delivery',
        'delivery_address' => 'Jl. Dago Asri No. 12, Bandung',
        'delivery_fee' => 5000,
        'payment_method' => 'QRIS',
        'discount_amount' => 0,
        'voucher_code' => null,
        'notes' => null,
        'cancelled_reason' => 'Perubahan alamat pengantaran',
        'cancelled_at' => now()->subDays(7),
        'created_at' => now()->subDays(7),
        'items' => [
            ['sku' => 'SBK-MYK-02', 'qty' => 1],
        ]
    ]
];

foreach ($ordersData as $oData) {
    $subtotal = 0;
    $totalCost = 0;
    $itemsToCreate = [];

    foreach ($oData['items'] as $item) {
        $prod = Product::where('sku', $item['sku'])->first();
        if (!$prod) {
            $prod = Product::where('store_id', $oData['store_id'])->first();
        }
        if (!$prod) continue;

        $qty = $item['qty'];
        $lineTotal = $prod->selling_price * $qty;
        $cost = ($prod->cost_price ?? ($prod->selling_price * 0.7)) * $qty;
        $subtotal += $lineTotal;
        $totalCost += $cost;

        $itemsToCreate[] = [
            'product_id' => $prod->id,
            'quantity' => $qty,
            'unit_selling_price' => $prod->selling_price,
            'unit_cost_price' => $prod->cost_price ?? ($prod->selling_price * 0.7),
            'subtotal' => $lineTotal,
        ];
    }

    $grandTotal = max(0, $subtotal + $oData['delivery_fee'] - $oData['discount_amount']);

    $order = Order::create([
        'store_id' => $oData['store_id'],
        'user_id' => $user->id,
        'order_number' => $oData['order_number'],
        'channel' => 'Marketplace App',
        'customer_name' => $user->name,
        'customer_phone' => $user->phone ?? '081234567890',
        'delivery_type' => $oData['delivery_type'],
        'delivery_address' => $oData['delivery_address'],
        'delivery_fee' => $oData['delivery_fee'],
        'discount_amount' => $oData['discount_amount'],
        'voucher_code' => $oData['voucher_code'],
        'total_amount' => $grandTotal,
        'total_cost' => $totalCost,
        'gross_profit' => max(0, $grandTotal - $totalCost),
        'payment_method' => $oData['payment_method'],
        'status' => $oData['status'],
        'notes' => $oData['notes'],
        'rating' => $oData['rating'] ?? null,
        'review' => $oData['review'] ?? null,
        'cancelled_reason' => $oData['cancelled_reason'] ?? null,
        'cancelled_at' => $oData['cancelled_at'] ?? null,
        'created_at' => $oData['created_at'],
        'updated_at' => $oData['created_at'],
    ]);

    foreach ($itemsToCreate as $it) {
        $order->items()->create($it);
    }
}

echo "Successfully seeded 11 test orders for user: {$user->email}\n";
