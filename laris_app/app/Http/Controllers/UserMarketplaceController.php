<?php

namespace App\Http\Controllers;

use App\Models\Store;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UserMarketplaceController extends Controller
{
    /**
     * Tampilan Utama Marketplace Konsumen / User ala Gojek
     */
    public function index(Request $request)
    {
        $currentSector = $request->input('sector', 'all');
        $search = trim($request->input('search', ''));

        // 1. Kategori / Sektor UMKM
        $sectors = [
            'all' => 'Semua Sektor',
            'Kuliner & F&B' => 'Kuliner & F&B',
            'Sembako & Kelontong' => 'Sembako & Kelontong',
            'Fashion & Pakaian' => 'Fashion & Busana',
            'Kerajinan & Kriya' => 'Kriya & Kerajinan',
            'Jasa & Layanan' => 'Jasa & Layanan',
        ];

        // 2. Query Gerai UMKM Terverifikasi
        $storesQuery = Store::withCount('products')->where('is_verified', true);
        if ($currentSector !== 'all') {
            $storesQuery->where('category', $currentSector);
        }
        if ($search) {
            $storesQuery->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('location', 'like', "%{$search}%")
                  ->orWhere('address', 'like', "%{$search}%");
            });
        }
        $stores = $storesQuery->get();

        // 3. Flash Sale Cuci Gudang Jam 7 Malam (Anti-Basi)
        $flashSaleProducts = Product::with('store')
            ->where(function ($q) {
                $q->where('sku', 'like', 'FS-%')
                  ->orWhere('name', 'like', '%Flash Sale%')
                  ->orWhere('health_status', 'Attention');
            })
            ->where('current_stock', '>', 0)
            ->take(6)
            ->get();

        // Fallback jika belum ada produk FS
        if ($flashSaleProducts->isEmpty()) {
            $flashSaleProducts = Product::with('store')
                ->where('current_stock', '>', 0)
                ->orderBy('selling_price', 'asc')
                ->take(4)
                ->get();
        }

        // 4. Rekomendasi Menu & Barang Terlaris (AI Curated)
        $recommendedProducts = Product::with('store')
            ->where('current_stock', '>', 0)
            ->where('sku', 'not like', 'FS-%')
            ->orderBy('current_stock', 'desc')
            ->take(8)
            ->get();

        // 5. Semua Katalog Produk Berdasarkan Sektor & Sensitivitas Pencarian
        $productsQuery = Product::with('store')->where('current_stock', '>', 0);
        if ($currentSector !== 'all') {
            $productsQuery->where('category', $currentSector);
        }
        if ($search) {
            $productsQuery->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('category', 'like', "%{$search}%")
                  ->orWhere('sku', 'like', "%{$search}%")
                  ->orWhereHas('store', function ($sq) use ($search) {
                      $sq->where('name', 'like', "%{$search}%")
                        ->orWhere('location', 'like', "%{$search}%");
                  });
            });
        }
        $products = $productsQuery->paginate(12)->withQueryString();

        // 6. Voucher Aktif Platform
        $vouchers = DB::table('vouchers')->where('is_active', true)->get();

        // 7. Pesanan Aktif User yang Sedang Berjalan
        $user = auth()->user();
        $myActiveOrders = [];
        if ($user) {
            $myActiveOrders = Order::with(['store', 'items.product'])
                ->where(function ($q) use ($user) {
                    $q->where('user_id', $user->id);
                    if (!empty($user->phone)) {
                        $q->orWhere('customer_phone', $user->phone);
                    }
                })
                ->latest()
                ->take(5)
                ->get();
        }

        $allStores = Store::all()->keyBy('id');

        return view('pages.user_marketplace', compact(
            'sectors',
            'currentSector',
            'search',
            'stores',
            'allStores',
            'flashSaleProducts',
            'recommendedProducts',
            'products',
            'vouchers',
            'myActiveOrders'
        ));
    }

    /**
     * Halaman Detail Gerai & Menu / Katalog Produk
     */
    public function storeDetail($id)
    {
        $store = Store::with(['products' => function ($q) {
            $q->where('current_stock', '>', 0);
        }])->findOrFail($id);

        $vouchers = DB::table('vouchers')->where('is_active', true)->get();

        return view('pages.user_store_detail', compact('store', 'vouchers'));
    }

    /**
     * Proses Pemesanan / Checkout oleh User (Gojek Flow: Delivery/Pickup, Tunai/QRIS, Voucher)
     */
    public function checkout(Request $request)
    {
        // Pengunjung tamu di marketplace publik wajib login saat checkout
        if (!auth()->check()) {
            return redirect()->route('login')->with('info', 'Silakan masuk ke akun Anda terlebih dahulu untuk menyelesaikan transaksi pemesanan.');
        }

        $validated = $request->validate([
            'store_id' => 'required|exists:stores,id',
            'delivery_type' => 'required|in:delivery,pickup',
            'payment_method' => 'required|in:cash,qris,bank',
            'customer_name' => 'required|string|max:100',
            'customer_phone' => 'required|string|max:20',
            'delivery_address' => 'nullable|string|max:255',
            'delivery_district' => 'nullable|string|max:100',
            'location_point' => 'nullable|string|max:255',
            'voucher_code' => 'nullable|string|max:50',
            'notes' => 'nullable|string|max:255',
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
        ]);

        $store = Store::findOrFail($validated['store_id']);

        // Validasi Kebijakan Pengantaran Gerai
        if ($validated['delivery_type'] === 'delivery') {
            if (!$store->has_delivery) {
                return back()->withErrors([
                    'delivery_type' => "Mohon maaf, gerai '{$store->name}' saat ini HANYA melayani Ambil Sendiri di Gerai (Self-Pickup). Harap pilih opsi Ambil di Tempat.",
                ])->withInput();
            }
            if (empty($validated['delivery_address'])) {
                return back()->withErrors([
                    'delivery_address' => 'Alamat pengantaran wajib diisi jika memilih layanan Pengantaran Toko.',
                ])->withInput();
            }
        }

        // Validasi Kebijakan Gerai, Multi-Tenancy & Ketersediaan Stok
        $subtotal = 0;
        $totalCost = 0;
        $orderItemsData = [];

        foreach ($validated['items'] as $itemData) {
            $product = Product::findOrFail($itemData['product_id']);
            $qty = (int) $itemData['quantity'];

            // 1. Anti Cross-Store Cart Poisoning: pastikan produk berasal dari gerai yang sama
            if ((int)$product->store_id !== (int)$store->id) {
                return back()->withErrors([
                    'items' => "Produk '{$product->name}' bukan berasal dari gerai '{$store->name}'. Harap bersihkan keranjang dan pesan dari satu gerai.",
                ])->withInput();
            }

            // 2. Anti Overselling & Negative Stock: pastikan stok fisik mencukupi
            if ($product->current_stock < $qty) {
                return back()->withErrors([
                    'items' => "Stok produk '{$product->name}' tidak mencukupi (Tersisa: {$product->current_stock} unit, diminta: {$qty} unit).",
                ])->withInput();
            }

            $sellPrice = (float) $product->selling_price;
            $costPrice = (float) ($product->cost_price ?? ($sellPrice * 0.7));
            $lineTotal = $sellPrice * $qty;
            $subtotal += $lineTotal;
            $totalCost += ($costPrice * $qty);

            $orderItemsData[] = [
                'product_id' => $product->id,
                'quantity' => $qty,
                'unit_selling_price' => $sellPrice,
                'unit_cost_price' => $costPrice,
                'subtotal' => $lineTotal,
            ];
        }

        // Biaya Pengantaran
        $deliveryFee = 0;
        if ($validated['delivery_type'] === 'delivery') {
            $deliveryFee = (float) ($store->delivery_fee ?? 5000);
        }

        // Hitung Diskon Voucher
        $discountAmount = 0;
        $voucherApplied = null;
        if (!empty($validated['voucher_code'])) {
            $voucher = DB::table('vouchers')
                ->where('code', strtoupper(trim($validated['voucher_code'])))
                ->where('is_active', true)
                ->first();

            if ($voucher && $subtotal >= (float) $voucher->min_order) {
                if ($voucher->discount_type === 'percent') {
                    $discountAmount = ($subtotal * (float) $voucher->discount_value) / 100;
                } else {
                    $discountAmount = (float) $voucher->discount_value;
                }
                if ($discountAmount > $subtotal) {
                    $discountAmount = $subtotal;
                }
                $voucherApplied = $voucher->code;
            }
        }

        $grandTotal = max(0, ($subtotal + $deliveryFee - $discountAmount));
        $orderNumber = 'ORD-' . strtoupper(Str::random(8));

        // Format alamat lengkap beserta kecamatan dan titik lokasi patokan
        $finalAddress = 'Ambil Langsung di Gerai';
        if ($validated['delivery_type'] === 'delivery') {
            $parts = [];
            if (!empty($validated['delivery_address'])) {
                $parts[] = $validated['delivery_address'];
            }
            if (!empty($validated['delivery_district'])) {
                $parts[] = 'Kec. ' . $validated['delivery_district'];
            }
            if (!empty($validated['location_point'])) {
                $parts[] = '[Patokan/Lokasi: ' . $validated['location_point'] . ']';
            }
            $finalAddress = implode(', ', $parts);
        }

        DB::beginTransaction();
        try {
            $order = Order::create([
                'store_id' => $store->id,
                'user_id' => auth()->id(),
                'order_number' => $orderNumber,
                'channel' => 'Marketplace App',
                'customer_name' => $validated['customer_name'],
                'customer_phone' => $validated['customer_phone'],
                'delivery_type' => $validated['delivery_type'],
                'delivery_address' => $finalAddress,
                'delivery_fee' => $deliveryFee,
                'discount_amount' => $discountAmount,
                'voucher_code' => $voucherApplied,
                'total_amount' => $grandTotal,
                'total_cost' => $totalCost,
                'gross_profit' => max(0, $grandTotal - $totalCost),
                'payment_method' => strtoupper($validated['payment_method']),
                'status' => 'Processing',
                'notes' => $validated['notes'] ?? null,
            ]);

            foreach ($orderItemsData as $item) {
                $order->items()->create($item);

                // Pengurangan stok atomik dengan pessimistic row locking
                $product = Product::lockForUpdate()->find($item['product_id']);
                if ($product) {
                    if ($product->current_stock < $item['quantity']) {
                        throw new \Exception("Stok untuk produk '{$product->name}' tidak mencukupi saat finalisasi pembayaran.");
                    }
                    $product->current_stock = max(0, $product->current_stock - $item['quantity']);
                    $product->ai_velocity = round(max(0.5, $product->ai_velocity + ($item['quantity'] * 0.1)), 2);
                    $product->stock_runway_days = (int) floor($product->current_stock / max(0.5, $product->ai_velocity ?: 1));

                    if ($product->stock_runway_days <= 4 || $product->current_stock <= $product->min_threshold) {
                        $product->health_status = 'Critical';
                    } elseif ($product->stock_runway_days <= 7) {
                        $product->health_status = 'Attention';
                    } else {
                        $product->health_status = 'Healthy';
                    }
                    $product->save();
                }
            }

            DB::commit();

            $paymentMethodText = match($validated['payment_method']) {
                'qris' => 'QRIS Nasional (Lunas)',
                'bank' => "Transfer Bank ({$store->bank_name})",
                default => 'Tunai (Bayar Saat Diterima)',
            };

            $successMsg = "Pesanan #{$orderNumber} berhasil dibuat dengan metode {$paymentMethodText}! Gerai {$store->name} sedang menyiapkan pesanan Anda.";

            return redirect()->route('user.orders')->with([
                'success' => $successMsg,
                'last_order_id' => $order->id,
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Gagal memproses pesanan: ' . $e->getMessage()])->withInput();
        }
    }

    /**
     * Halaman Riwayat & Pelacakan Pesanan Saya
     */
    public function myOrders(Request $request)
    {
        $user = auth()->user();
        $statusTab = $request->input('status', 'all');

        $baseQuery = Order::with(['store', 'items.product'])
            ->where(function ($q) use ($user) {
                $q->where('user_id', $user ? $user->id : 0);
                if ($user && !empty($user->phone)) {
                    $q->orWhere('customer_phone', $user->phone);
                }
            });

        // Tab counts
        $counts = [
            'all' => (clone $baseQuery)->count(),
            'processing' => (clone $baseQuery)->whereIn('status', ['Pending', 'Processing', 'Diproses Gerai'])->count(),
            'shipping' => (clone $baseQuery)->whereIn('status', ['Shipping', 'Dalam Pengantaran', 'Siap Diambil'])->count(),
            'completed' => (clone $baseQuery)->whereIn('status', ['Completed', 'Selesai'])->count(),
            'cancelled' => (clone $baseQuery)->whereIn('status', ['Cancelled', 'Dibatalkan'])->count(),
        ];

        $query = clone $baseQuery;
        if ($statusTab === 'processing') {
            $query->whereIn('status', ['Pending', 'Processing', 'Diproses Gerai']);
        } elseif ($statusTab === 'shipping') {
            $query->whereIn('status', ['Shipping', 'Dalam Pengantaran', 'Siap Diambil']);
        } elseif ($statusTab === 'completed') {
            $query->whereIn('status', ['Completed', 'Selesai']);
        } elseif ($statusTab === 'cancelled') {
            $query->whereIn('status', ['Cancelled', 'Dibatalkan']);
        }

        $orders = $query->latest()->paginate(8)->withQueryString();

        return view('pages.user_orders', compact('orders', 'statusTab', 'counts'));
    }

    /**
     * Batalkan Pesanan oleh Pembeli (CRUD: Update status & restore stock atomik)
     */
    public function cancelOrder($id, Request $request)
    {
        $order = Order::with('items.product')->findOrFail($id);
        $user = auth()->user();

        if (!$user) {
            abort(401, 'Silakan masuk terlebih dahulu.');
        }

        // Strict authorization: Hanya pemilik pesanan atau owner/super_admin yang berhak membatalkan
        $isPrivileged = in_array($user->role, ['owner', 'super_admin']);
        if (!$isPrivileged && (int)$order->user_id !== (int)$user->id) {
            abort(403, 'Akses tidak diizinkan. Anda hanya dapat membatalkan pesanan milik Anda sendiri.');
        }

        // Cegah eksploit penggandaan stok: Validasi status sebelum pembatalan
        $statusLower = strtolower($order->status);
        if (in_array($statusLower, ['cancelled', 'dibatalkan'])) {
            return back()->with('error', "Pesanan #{$order->order_number} sudah dibatalkan sebelumnya.");
        }
        if (in_array($statusLower, ['completed', 'selesai'])) {
            return back()->with('error', "Pesanan #{$order->order_number} sudah selesai dan tidak dapat dibatalkan.");
        }
        if (in_array($statusLower, ['shipping', 'dalam pengantaran', 'siap diambil'])) {
            return back()->with('error', "Pesanan #{$order->order_number} sedang dalam proses pengantaran atau siap diambil. Silakan hubungi pihak gerai.");
        }

        DB::transaction(function () use ($order, $request) {
            $reason = $request->input('reason', 'Dibatalkan atas permintaan pembeli');
            $order->status = 'Cancelled';
            $order->cancelled_reason = $reason;
            $order->cancelled_at = now();
            $order->save();

            // Kembalikan stok produk secara atomik & sinkronkan indikator kesehatan inventaris
            foreach ($order->items as $item) {
                if ($item->product_id) {
                    $prod = Product::lockForUpdate()->find($item->product_id);
                    if ($prod) {
                        $prod->current_stock += $item->quantity;
                        $prod->stock_runway_days = (int) ceil($prod->current_stock / max(0.5, $prod->ai_velocity ?: 1));

                        if ($prod->current_stock > $prod->min_threshold) {
                            $prod->health_status = 'Healthy';
                        } elseif ($prod->current_stock > ($prod->min_threshold * 0.5)) {
                            $prod->health_status = 'Attention';
                        } else {
                            $prod->health_status = 'Critical';
                        }
                        $prod->save();
                    }
                }
            }
        });

        return redirect()->back()->with('success', "Pesanan #{$order->order_number} berhasil dibatalkan. Stok barang telah dikembalikan secara riil ke inventaris toko.");
    }

    /**
     * Konfirmasi Pesanan Diterima / Selesai (CRUD: Update)
     */
    public function completeOrder($id)
    {
        $order = Order::findOrFail($id);
        $user = auth()->user();

        if (!$user) {
            abort(401, 'Silakan masuk terlebih dahulu.');
        }

        $isPrivileged = in_array($user->role, ['owner', 'super_admin']);
        if (!$isPrivileged && (int)$order->user_id !== (int)$user->id) {
            abort(403, 'Akses tidak diizinkan. Anda hanya dapat mengonfirmasi pesanan milik Anda sendiri.');
        }

        $statusLower = strtolower($order->status);
        if (in_array($statusLower, ['cancelled', 'dibatalkan'])) {
            return back()->with('error', "Pesanan yang sudah dibatalkan tidak dapat dikonfirmasi selesai.");
        }
        if (in_array($statusLower, ['completed', 'selesai'])) {
            return back()->with('info', "Pesanan #{$order->order_number} sudah selesai.");
        }

        $order->status = 'Completed';
        $order->save();

        return redirect()->back()->with('success', "Pesanan #{$order->order_number} telah dikonfirmasi selesai! Terima kasih telah berbelanja di UMKM lokal.");
    }

    /**
     * Berikan Ulasan dan Penilaian Bintang (CRUD: Update)
     */
    public function reviewOrder($id, Request $request)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'nullable|string|max:500',
        ]);

        $order = Order::findOrFail($id);
        $user = auth()->user();

        if (!$user) {
            abort(401, 'Silakan masuk terlebih dahulu.');
        }

        $isPrivileged = in_array($user->role, ['owner', 'super_admin']);
        if (!$isPrivileged && (int)$order->user_id !== (int)$user->id) {
            abort(403, 'Akses tidak diizinkan. Anda hanya dapat mengulas pesanan milik Anda sendiri.');
        }

        $order->rating = (int) $request->input('rating');
        $order->review = $request->input('review');
        $order->save();

        return redirect()->back()->with('success', "Ulasan dan penilaian bintang {$order->rating} untuk pesanan #{$order->order_number} berhasil dikirim!");
    }

    /**
     * Hapus Riwayat Pesanan dari Daftar (CRUD: Delete)
     */
    public function deleteOrder($id)
    {
        $order = Order::findOrFail($id);
        $user = auth()->user();

        if (!$user) {
            abort(401, 'Silakan masuk terlebih dahulu.');
        }

        $isPrivileged = in_array($user->role, ['owner', 'super_admin']);
        if (!$isPrivileged && (int)$order->user_id !== (int)$user->id) {
            abort(403, 'Akses tidak diizinkan. Anda hanya dapat menghapus riwayat pesanan milik Anda sendiri.');
        }

        // Tolak penghapusan pesanan aktif yang sedang berjalan
        $statusLower = strtolower($order->status);
        if (in_array($statusLower, ['processing', 'pending', 'shipping', 'dalam pengantaran', 'siap diambil', 'diproses gerai'])) {
            return back()->with('error', "Pesanan yang sedang aktif diproses tidak dapat dihapus dari daftar riwayat.");
        }

        $num = $order->order_number;
        $order->delete();

        return redirect()->back()->with('success', "Riwayat pesanan #{$num} berhasil dihapus dari daftar.");
    }

    /**
     * API Cek & Klaim Voucher
     */
    public function checkVoucher(Request $request)
    {
        $code = strtoupper(trim($request->input('code')));
        $subtotal = (float) $request->input('subtotal', 0);

        $voucher = DB::table('vouchers')
            ->where('code', $code)
            ->where('is_active', true)
            ->first();

        if (!$voucher) {
            return response()->json([
                'success' => false,
                'message' => 'Kode voucher tidak ditemukan atau sudah kedaluwarsa.',
            ], 404);
        }

        if ($subtotal < (float) $voucher->min_order) {
            return response()->json([
                'success' => false,
                'message' => 'Minimal belanja untuk voucher ini adalah Rp ' . number_format($voucher->min_order, 0, ',', '.'),
            ], 422);
        }

        $discount = ($voucher->discount_type === 'percent') 
            ? ($subtotal * (float) $voucher->discount_value) / 100 
            : (float) $voucher->discount_value;

        return response()->json([
            'success' => true,
            'code' => $voucher->code,
            'title' => $voucher->title,
            'discount' => min($discount, $subtotal),
            'formatted_discount' => 'Rp ' . number_format(min($discount, $subtotal), 0, ',', '.'),
        ]);
    }

    /**
     * Marketplace Publik (Dapat Diakses Tamu / Tanpa Login)
     */
    public function publicMarketplace(Request $request)
    {
        return $this->index($request);
    }

    /**
     * Detail Gerai Publik (Dapat Diakses Tamu / Tanpa Login)
     */
    public function publicStoreDetail($id)
    {
        return $this->storeDetail($id);
    }

    /**
     * Endpoint Polling Status Pesanan Realtime untuk Pembeli
     */
    public function liveOrderStatus(Request $request)
    {
        $user = auth()->user();
        if (!$user) {
            return response()->json(['status' => 'unauthenticated', 'orders' => []]);
        }

        $orders = Order::with('store')
            ->where(function ($q) use ($user) {
                $q->where('user_id', $user->id);
                if (!empty($user->phone)) {
                    $q->orWhere('customer_phone', $user->phone);
                }
            })
            ->latest()
            ->take(20)
            ->get();

        $data = $orders->map(function ($ord) {
            $statusNormalized = strtolower($ord->status);
            $badgeClass = 'status-pending';
            $step = 1;
            $displayLabel = $ord->status;

            if (in_array($statusNormalized, ['processing', 'diproses gerai'])) {
                $badgeClass = 'status-processing';
                $step = 2;
                $displayLabel = 'Diproses Gerai';
            } elseif (in_array($statusNormalized, ['shipping', 'dalam pengantaran', 'siap diambil'])) {
                $badgeClass = 'status-shipping';
                $step = 3;
                $displayLabel = $ord->delivery_type === 'pickup' ? 'Siap Diambil di Gerai' : 'Sedang Diantar';
            } elseif (in_array($statusNormalized, ['completed', 'selesai'])) {
                $badgeClass = 'status-completed';
                $step = 4;
                $displayLabel = 'Selesai';
            } elseif (in_array($statusNormalized, ['cancelled', 'dibatalkan'])) {
                $badgeClass = 'status-cancelled';
                $step = 0;
                $displayLabel = 'Dibatalkan';
            }

            return [
                'id' => $ord->id,
                'order_number' => $ord->order_number,
                'status' => $ord->status,
                'display_label' => $displayLabel,
                'badge_class' => $badgeClass,
                'step' => $step,
                'delivery_type' => $ord->delivery_type,
                'total_amount' => $ord->total_amount,
                'updated_at' => $ord->updated_at->diffForHumans(),
            ];
        });

        return response()->json([
            'status' => 'success',
            'orders' => $data,
            'timestamp' => now()->format('H:i:s') . ' WIB',
        ]);
    }
}
