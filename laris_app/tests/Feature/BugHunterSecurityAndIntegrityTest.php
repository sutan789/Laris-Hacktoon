<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Store;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\MarketTrend;
use App\Models\OperationalAlert;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BugHunterSecurityAndIntegrityTest extends TestCase
{
    /**
     * TEST 1: Celah IDOR - User tidak boleh membatalkan atau menghapus pesanan milik orang lain atau transaksi POS.
     */
    public function test_user_cannot_cancel_or_delete_other_user_or_pos_order(): void
    {
        $store = Store::first() ?? Store::create([
            'name' => 'Toko Uji Coba',
            'owner_name' => 'Juragan Test',
            'category' => 'Retail',
            'location' => 'Bandung',
            'has_delivery' => true,
        ]);

        $victimUser = User::create([
            'name' => 'Korban Test',
            'email' => 'victim_' . uniqid() . '@laris.id',
            'password' => bcrypt('password'),
            'role' => 'user',
        ]);

        $attackerUser = User::create([
            'name' => 'Attacker Test',
            'email' => 'attacker_' . uniqid() . '@laris.id',
            'password' => bcrypt('password'),
            'role' => 'user',
        ]);

        // 1. Pesanan milik victim
        $victimOrder = Order::create([
            'store_id' => $store->id,
            'user_id' => $victimUser->id,
            'order_number' => 'ORD-VICTIM-' . uniqid(),
            'total_amount' => 50000,
            'status' => 'Processing',
        ]);

        // 2. Pesanan POS Kasir (user_id = null)
        $posOrder = Order::create([
            'store_id' => $store->id,
            'user_id' => null,
            'order_number' => 'ORD-POS-' . uniqid(),
            'total_amount' => 75000,
            'status' => 'Completed',
        ]);

        // Attacker login
        $this->actingAs($attackerUser);

        // Attacker mencoba cancel order victim -> Harus 403 Forbidden
        $response1 = $this->post("/user/orders/{$victimOrder->id}/cancel");
        $response1->assertStatus(403);

        // Attacker mencoba cancel order POS kasir -> Harus 403 Forbidden
        $response2 = $this->post("/user/orders/{$posOrder->id}/cancel");
        $response2->assertStatus(403);

        // Attacker mencoba delete order POS kasir -> Harus 403 Forbidden
        $response3 = $this->post("/user/orders/{$posOrder->id}/delete");
        $response3->assertStatus(403);

        // Pastikan pesanan tetap utuh di database
        $this->assertDatabaseHas('orders', ['id' => $victimOrder->id, 'status' => 'Processing']);
        $this->assertDatabaseHas('orders', ['id' => $posOrder->id, 'status' => 'Completed']);
    }

    /**
     * TEST 2: Eksploit Penggandaan Stok - Pesanan yang sudah dibatalkan tidak boleh dibatalkan ulang untuk menambah stok.
     */
    public function test_prevent_stock_duplication_exploit_on_repeat_cancel(): void
    {
        $store = Store::first();
        $user = User::where('role', 'user')->first() ?? User::create([
            'name' => 'Pembeli Jujur',
            'email' => 'buyer_' . uniqid() . '@laris.id',
            'password' => bcrypt('password'),
            'role' => 'user',
        ]);

        $product = Product::create([
            'store_id' => $store->id,
            'name' => 'Barang Uji Stok ' . uniqid(),
            'sku' => 'STK-' . uniqid(),
            'category' => 'Retail',
            'cost_price' => 10000,
            'selling_price' => 15000,
            'current_stock' => 10,
            'min_threshold' => 5,
        ]);

        $order = Order::create([
            'store_id' => $store->id,
            'user_id' => $user->id,
            'order_number' => 'ORD-CANCEL-' . uniqid(),
            'total_amount' => 30000,
            'status' => 'Processing',
        ]);

        OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $product->id,
            'quantity' => 2,
            'unit_selling_price' => 15000,
            'unit_cost_price' => 10000,
            'subtotal' => 30000,
        ]);

        $this->actingAs($user);

        // Pembatalan pertama: Berhasil, stok bertambah dari 10 jadi 12
        $res1 = $this->post("/user/orders/{$order->id}/cancel");
        $res1->assertSessionHas('success');
        $this->assertEquals(12, $product->fresh()->current_stock);

        // Pembatalan kedua (Eksploit repeat cancel): Harus ditolak dengan pesan error
        $res2 = $this->post("/user/orders/{$order->id}/cancel");
        $res2->assertSessionHas('error');

        // Stok TIDAK boleh bertambah lagi (tetap 12, bukan 14)
        $this->assertEquals(12, $product->fresh()->current_stock);
    }

    /**
     * TEST 3: Anti-Overselling & Anti Cross-Store Cart Poisoning pada Checkout
     */
    public function test_checkout_rejects_insufficient_stock_and_cross_store_products(): void
    {
        $storeA = Store::first();
        $storeB = Store::create([
            'name' => 'Gerai Lain ' . uniqid(),
            'owner_name' => 'Owner Lain',
            'category' => 'Retail',
            'location' => 'Jakarta',
            'has_delivery' => true,
        ]);

        $productStoreA = Product::create([
            'store_id' => $storeA->id,
            'name' => 'Produk Terbatas A',
            'sku' => 'LTD-' . uniqid(),
            'category' => 'Retail',
            'cost_price' => 5000,
            'selling_price' => 10000,
            'current_stock' => 2, // Hanya ada 2 unit
            'min_threshold' => 1,
        ]);

        $productStoreB = Product::create([
            'store_id' => $storeB->id,
            'name' => 'Produk Toko Sebelah B',
            'sku' => 'OTH-' . uniqid(),
            'category' => 'Retail',
            'cost_price' => 8000,
            'selling_price' => 12000,
            'current_stock' => 50,
            'min_threshold' => 5,
        ]);

        $user = User::where('role', 'user')->first();
        $this->actingAs($user);

        // A. Coba beli 10 unit padahal stok cuma 2 -> Harus gagal dengan session error
        $payloadOversell = [
            'store_id' => $storeA->id,
            'delivery_type' => 'pickup',
            'payment_method' => 'cash',
            'customer_name' => 'Pembeli Rakus',
            'customer_phone' => '089912345678',
            'items' => [
                ['product_id' => $productStoreA->id, 'quantity' => 10]
            ],
        ];

        $resOversell = $this->post(route('user.checkout'), $payloadOversell);
        $resOversell->assertSessionHasErrors('items');
        $this->assertEquals(2, $productStoreA->fresh()->current_stock); // Stok tidak boleh jadi negatif

        // B. Coba beli produk Toko B di invoice Toko A (Cross-Store Cart Poisoning) -> Harus gagal
        $payloadCrossStore = [
            'store_id' => $storeA->id,
            'delivery_type' => 'pickup',
            'payment_method' => 'cash',
            'customer_name' => 'Hacker Store',
            'customer_phone' => '089912345678',
            'items' => [
                ['product_id' => $productStoreB->id, 'quantity' => 1]
            ],
        ];

        $resCross = $this->post(route('user.checkout'), $payloadCrossStore);
        $resCross->assertSessionHasErrors('items');
    }

    /**
     * TEST 4: POS Checkout terlindungi hak akses role kasir/owner
     */
    public function test_pos_checkout_requires_cashier_or_owner_auth(): void
    {
        // Unauthenticated -> Harus redirect ke login
        $resUnauth = $this->postJson(route('pos.checkout'), [
            'channel' => 'Offline Store',
            'items' => [['product_id' => 1, 'quantity' => 1]],
        ]);
        $resUnauth->assertStatus(401);

        // Login sebagai pembeli biasa (role: user) -> Harus 403 Forbidden / Akses Dibatasi
        $buyer = User::where('role', 'user')->first();
        $resBuyer = $this->actingAs($buyer)->post(route('pos.checkout'), [
            'channel' => 'Offline Store',
            'items' => [['product_id' => 1, 'quantity' => 1]],
        ]);
        // Middleware EnsureUserRole me-redirect dengan pesan akses dibatasi
        $resBuyer->assertRedirect();
        $resBuyer->assertSessionHas('warning');
    }

    /**
     * TEST 5: Trend Hunter category query filter
     */
    public function test_trend_hunter_filters_category_correctly(): void
    {
        MarketTrend::create([
            'trend_name' => 'Tumbler Stainless Premium',
            'category' => 'Drinkware Eksklusif',
            'stage' => 'Growth Stage',
            'signal_strength' => 88,
        ]);

        $owner = User::where('role', 'owner')->first();
        $response = $this->actingAs($owner)->get('/trend-hunter?category=Drinkware');

        $response->assertStatus(200);
        $response->assertSee('Tumbler Stainless Premium');
    }

    /**
     * TEST 6: Resolving margin drop calculates safe margin dynamically (bukan hardcoded 36.500)
     */
    public function test_resolve_margin_drop_calculates_safe_margin_dynamically(): void
    {
        $store = Store::first();
        $owner = User::where('role', 'owner')->first();

        // Produk dengan HPP Rp 80.000 (jika harga diset 36.500 toko rugi 54%!)
        $expensiveProduct = Product::create([
            'store_id' => $store->id,
            'name' => 'Jaket Hoodie Premium ' . uniqid(),
            'sku' => 'JKT-' . uniqid(),
            'category' => 'Fashion',
            'cost_price' => 80000,
            'selling_price' => 82000, // Margin tipis
            'current_stock' => 15,
            'min_threshold' => 5,
        ]);

        $alert = \App\Models\OperationalAlert::create([
            'store_id' => $store->id,
            'alert_type' => 'margin_drop',
            'product_name' => $expensiveProduct->name,
            'badge_text' => 'MARGIN DROP',
            'description' => 'Margin tipis terdeteksi',
            'action_label' => 'Sesuaikan Harga',
            'is_resolved' => false,
        ]);

        $response = $this->actingAs($owner)->post("/operational-alerts/{$alert->id}/resolve");
        $response->assertRedirect();
        $response->assertSessionHas('success');

        // Harga baru harus dinamis (80.000 * 1.35 = 108.000), BUKAN Rp 36.500!
        $expensiveProduct->refresh();
        $this->assertEquals(108000, (int) $expensiveProduct->selling_price);
        $this->assertTrue($alert->fresh()->is_resolved);
    }

    /**
     * TEST 7: Resolving imminent stockout menerbitkan Purchase Order resmi
     */
    public function test_resolve_imminent_stockout_creates_official_purchase_order(): void
    {
        $store = Store::first();
        $owner = User::where('role', 'owner')->first();

        $product = Product::create([
            'store_id' => $store->id,
            'name' => 'Beras Organik Cianjur ' . uniqid(),
            'sku' => 'BRS-' . uniqid(),
            'category' => 'Sembako',
            'cost_price' => 50000,
            'selling_price' => 65000,
            'current_stock' => 2,
            'min_threshold' => 10,
        ]);

        $alert = \App\Models\OperationalAlert::create([
            'store_id' => $store->id,
            'alert_type' => 'imminent_stockout',
            'product_name' => $product->name,
            'badge_text' => 'SISA 2 UNIT',
            'description' => 'Stok menipis drastis',
            'action_label' => 'Reorder Cepat',
            'is_resolved' => false,
        ]);

        $response = $this->actingAs($owner)->post("/operational-alerts/{$alert->id}/resolve");
        $response->assertRedirect();

        // Pastikan stok bertambah dan PO resmi tercipta di database
        $product->refresh();
        $this->assertGreaterThan(10, $product->current_stock);
        $this->assertDatabaseHas('purchase_orders', [
            'store_id' => $store->id,
            'status' => 'Confirmed',
        ]);
        $this->assertDatabaseHas('purchase_order_items', [
            'product_id' => $product->id,
        ]);
    }

    /**
     * TEST 8: Download ringkasan eksekutif PDF berhasil dengan HTTP 200
     */
    public function test_executive_summary_download_pdf_success(): void
    {
        $owner = User::where('role', 'owner')->first();
        $response = $this->actingAs($owner)->get('/dashboard/download-summary');

        $response->assertStatus(200);
        $this->assertTrue(str_contains($response->headers->get('content-type') ?? '', 'pdf') || str_contains($response->headers->get('content-disposition') ?? '', '.pdf'));
    }

    /**
     * TEST 9: Endpoint simulate-webhook terlindungi middleware role:owner
     */
    public function test_simulate_webhook_requires_owner_role(): void
    {
        // Unauthenticated -> Redirect login
        $resUnauth = $this->post('/api/telemetry/simulate-webhook');
        $resUnauth->assertRedirect(route('login'));

        // Customer biasa -> Warning Akses Dibatasi
        $buyer = User::where('role', 'user')->first();
        $resBuyer = $this->actingAs($buyer)->post('/api/telemetry/simulate-webhook');
        $resBuyer->assertRedirect();
        $resBuyer->assertSessionHas('warning');
    }

    /**
     * TEST 10: Prefill simulator predict membaca param price/cost dari spotlight dashboard
     */
    public function test_predict_prefill_supports_both_price_and_selling_price_query_params(): void
    {
        $owner = User::where('role', 'owner')->first();
        $response = $this->actingAs($owner)->get('/laris-predict?product_name=Kopi+Drip+Bag&price=28000&cost=16000&category=Biji+Kopi');

        $response->assertStatus(200);
        $response->assertSee('value="28000"', false);
        $response->assertSee('value="16000"', false);
    }

    /**
     * TEST 11: IDOR Alert Resolution - Owner Toko B tidak boleh menyelesaikan peringatan Toko A
     */
    public function test_resolve_alert_rejects_cross_store_idor(): void
    {
        $storeA = Store::create([
            'name' => 'Toko A ' . uniqid(),
            'category' => 'Retail',
        ]);
        $storeB = Store::create([
            'name' => 'Toko B ' . uniqid(),
            'category' => 'Retail',
        ]);

        $ownerB = User::create([
            'name' => 'Juragan Toko B',
            'email' => 'owner_b_' . uniqid() . '@laris.id',
            'password' => bcrypt('password'),
            'role' => 'owner',
            'store_id' => $storeB->id,
        ]);

        $alertA = OperationalAlert::create([
            'store_id' => $storeA->id,
            'alert_type' => 'margin_drop',
            'product_name' => 'Produk Toko A ' . uniqid(),
            'badge_text' => 'Margin Drop',
            'description' => 'Test alert Toko A',
            'action_label' => 'Sesuaikan Margin',
            'is_resolved' => false,
        ]);

        // Owner Toko B mencoba menyelesaikan alert milik Toko A -> 403 Forbidden
        $response = $this->actingAs($ownerB)->post("/operational-alerts/{$alertA->id}/resolve");
        $response->assertStatus(403);

        // Pastikan alert Toko A tidak berubah
        $alertA->refresh();
        $this->assertFalse($alertA->is_resolved);
    }

    /**
     * TEST 12: Pencegahan Double Execution pada Resolve Alert
     */
    public function test_resolve_alert_rejects_duplicate_execution(): void
    {
        $store = Store::first();
        $owner = User::where('role', 'owner')->first();

        $product = Product::create([
            'store_id' => $store->id,
            'name' => 'Produk Darurat ' . uniqid(),
            'sku' => 'EMRG-' . uniqid(),
            'category' => 'Retail',
            'cost_price' => 15000,
            'selling_price' => 20000,
            'current_stock' => 5,
            'min_threshold' => 10,
            'health_status' => 'Critical',
        ]);

        $alert = OperationalAlert::create([
            'store_id' => $store->id,
            'alert_type' => 'imminent_stockout',
            'product_name' => $product->name,
            'badge_text' => 'Stok Kritis',
            'description' => 'Sisa 5 pcs',
            'action_label' => 'Restock Cepat',
            'is_resolved' => false,
        ]);

        // Eksekusi pertama -> Berhasil
        $res1 = $this->actingAs($owner)->post("/operational-alerts/{$alert->id}/resolve");
        $res1->assertRedirect();
        $res1->assertSessionHas('success');

        $product->refresh();
        $stockAfterFirst = $product->current_stock;
        $this->assertGreaterThan(5, $stockAfterFirst);

        // Eksekusi kedua (duplicate POST) -> Harus ditolak dan tidak menambah stok lagi
        $res2 = $this->actingAs($owner)->post("/operational-alerts/{$alert->id}/resolve");
        $res2->assertRedirect();
        $res2->assertSessionHas('info');

        $product->refresh();
        $this->assertEquals($stockAfterFirst, $product->current_stock);
    }

    /**
     * TEST 13: Endpoint Telemetry Live membutuhkan autentikasi
     */
    public function test_telemetry_live_requires_authentication(): void
    {
        // Akses tanpa login -> Harus diarahkan ke login
        $resUnauth = $this->get('/api/telemetry/live');
        $resUnauth->assertRedirect(route('login'));

        // Akses dengan login owner -> HTTP 200 JSON
        $owner = User::where('role', 'owner')->first();
        $resAuth = $this->actingAs($owner)->get('/api/telemetry/live');
        $resAuth->assertStatus(200);
        $resAuth->assertJsonStructure([
            'status',
            'data' => [
                'revenue_raw',
                'revenue_formatted',
                'profit_raw',
                'profit_formatted',
                'margin_pct',
                'orders_count',
                'stock_health_pct',
            ]
        ]);
    }

    /**
     * TEST 14: Download Summary PDF mendukung timeframe dinamis (7d & 30d)
     */
    public function test_download_summary_supports_timeframe_query(): void
    {
        $owner = User::where('role', 'owner')->first();

        // Download dengan timeframe 7d
        $res7d = $this->actingAs($owner)->get('/dashboard/download-summary?timeframe=7d');
        $res7d->assertStatus(200);

        // Download dengan timeframe 30d
        $res30d = $this->actingAs($owner)->get('/dashboard/download-summary?timeframe=30d');
        $res30d->assertStatus(200);
    }

    /**
     * TEST 15: Notifikasi Navbar terisolasi per gerai
     */
    public function test_unread_notifications_scoped_to_store(): void
    {
        $storeA = Store::create(['name' => 'Toko Notif A ' . uniqid()]);
        $storeB = Store::create(['name' => 'Toko Notif B ' . uniqid()]);

        $ownerA = User::create([
            'name' => 'Owner Toko A',
            'email' => 'owner_notif_a_' . uniqid() . '@laris.id',
            'password' => bcrypt('password'),
            'role' => 'owner',
            'store_id' => $storeA->id,
        ]);

        $ownerB = User::create([
            'name' => 'Owner Toko B',
            'email' => 'owner_notif_b_' . uniqid() . '@laris.id',
            'password' => bcrypt('password'),
            'role' => 'owner',
            'store_id' => $storeB->id,
        ]);

        // Buat order di Toko B
        $orderB = Order::create([
            'store_id' => $storeB->id,
            'order_number' => 'ORD-B-' . uniqid(),
            'total_amount' => 125000,
            'status' => 'Processing',
        ]);

        // Owner Toko A cek notifikasi -> Order B TIDAK boleh muncul
        $resA = $this->actingAs($ownerA)->get('/api/notifications/unread');
        $resA->assertStatus(200);
        $notificationsA = $resA->json('notifications');
        $idsA = array_column($notificationsA, 'title');
        $this->assertFalse(in_array("Order Baru: #{$orderB->order_number}", $idsA));

        // Owner Toko B cek notifikasi -> Order B HARUS muncul
        $resB = $this->actingAs($ownerB)->get('/api/notifications/unread');
        $resB->assertStatus(200);
        $notificationsB = $resB->json('notifications');
        $idsB = array_column($notificationsB, 'title');
        $this->assertTrue(in_array("Order Baru: #{$orderB->order_number}", $idsB));
    }
}

