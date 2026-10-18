<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Store;
use Illuminate\Http\Request;

class ConsumerController extends Controller
{
    public function index(Request $request)
    {
        $store = Store::first() ?? (object) [
            'name' => 'Toko Berkah Utama',
            'address' => 'Jl. Braga No. 45, Bandung, Jawa Barat',
            'phone' => '081234567890',
            'operating_hours' => '08:00 - 22:00 WIB',
            'category' => 'Retail, Sembako & FMCG',
        ];

        $query = Product::query();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('category', 'like', "%{$search}%")
                  ->orWhere('sku', 'like', "%{$search}%");
            });
        }

        if ($request->filled('category') && $request->input('category') !== 'all') {
            $query->where('category', $request->input('category'));
        }

        $products = $query->get();

        // Kategori unik untuk filter pill
        $categories = Product::select('category')->distinct()->pluck('category');

        // Flash Sale Cuci Gudang Jam 7 Malam (Anti-Basi)
        $flashSaleItems = [
            [
                'id' => 'fs-1',
                'name' => 'Roti Tawar Gandum Sari Roti',
                'category' => 'Bakery & Roti',
                'original_price' => 19500,
                'discount_price' => 11500,
                'discount_pct' => 41,
                'stock_left' => 3,
                'unit' => 'bungkus',
                'reason' => 'Kedaluwarsa 2 hari lagi - Fresh Baked',
                'image' => 'https://images.unsplash.com/photo-1509440159596-0249088772ff?w=300&auto=format&fit=crop&q=80',
            ],
            [
                'id' => 'fs-2',
                'name' => 'Susu Segar Greenfield Pasteurisasi 1L',
                'category' => 'Dairy',
                'original_price' => 28000,
                'discount_price' => 18000,
                'discount_pct' => 36,
                'stock_left' => 2,
                'unit' => 'botol',
                'reason' => 'Suhu dingin terjaga optimal di chiller warung',
                'image' => 'https://images.unsplash.com/photo-1550583724-b2692b85b150?w=300&auto=format&fit=crop&q=80',
            ],
            [
                'id' => 'fs-3',
                'name' => 'Pisang Cavendish Sunpride 1 Sisir',
                'category' => 'Buah Segar',
                'original_price' => 32000,
                'discount_price' => 16000,
                'discount_pct' => 50,
                'stock_left' => 2,
                'unit' => 'sisir',
                'reason' => 'Tingkat kematangan optimal siap santap',
                'image' => 'https://images.unsplash.com/photo-1571771894821-ce9b6c11b08e?w=300&auto=format&fit=crop&q=80',
            ],
            [
                'id' => 'fs-4',
                'name' => 'Donat Kentang Gula Tabur (Isi 4)',
                'category' => 'Snack & Kue',
                'original_price' => 15000,
                'discount_price' => 8500,
                'discount_pct' => 43,
                'stock_left' => 4,
                'unit' => 'mika',
                'reason' => 'Dibuat pagi tadi, cuci gudang malam ini',
                'image' => 'https://images.unsplash.com/photo-1551024709-8f23befc6f87?w=300&auto=format&fit=crop&q=80',
            ],
        ];

        // Daftar Pre-order yang tersimpan di sesi
        $preOrders = session('consumer_preorders', [
            [
                'id' => 'PO-CUST-01',
                'item_name' => 'Minyak Goreng SunCo 2L (Pouch)',
                'customer_name' => 'Ibu Ratna',
                'phone' => '0812****4412',
                'quantity' => 2,
                'status' => 'Dikonfirmasi Juragan (Belanja Besok Pagi)',
                'time' => '1 jam yang lalu',
            ],
            [
                'id' => 'PO-CUST-02',
                'item_name' => 'Beras Pandan Wangi Cianjur 10kg',
                'customer_name' => 'Pak Agus',
                'phone' => '0878****9901',
                'quantity' => 1,
                'status' => 'Antrean Belanja Pasar Induk',
                'time' => '3 jam yang lalu',
            ],
        ]);

        return view('pages.consumer', compact('store', 'products', 'categories', 'flashSaleItems', 'preOrders'));
    }

    public function storePreOrder(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:100',
            'phone' => 'required|string|max:20',
            'item_name' => 'required|string|max:150',
            'quantity' => 'required|integer|min:1',
        ]);

        $newOrder = [
            'id' => 'PO-CUST-' . rand(10, 99),
            'item_name' => $request->input('item_name'),
            'customer_name' => $request->input('customer_name'),
            'phone' => substr($request->input('phone'), 0, 4) . '****' . substr($request->input('phone'), -4),
            'quantity' => (int) $request->input('quantity'),
            'notes' => $request->input('notes'),
            'status' => 'Terkirim ke Juragan (Belanja Pagi 06.00 WIB)',
            'time' => 'Baru saja',
        ];

        $preOrders = session('consumer_preorders', [
            [
                'id' => 'PO-CUST-01',
                'item_name' => 'Minyak Goreng SunCo 2L (Pouch)',
                'customer_name' => 'Ibu Ratna',
                'phone' => '0812****4412',
                'quantity' => 2,
                'status' => 'Dikonfirmasi Juragan (Belanja Besok Pagi)',
                'time' => '1 jam yang lalu',
            ],
            [
                'id' => 'PO-CUST-02',
                'item_name' => 'Beras Pandan Wangi Cianjur 10kg',
                'customer_name' => 'Pak Agus',
                'phone' => '0878****9901',
                'quantity' => 1,
                'status' => 'Antrean Belanja Pasar Induk',
                'time' => '3 jam yang lalu',
            ],
        ]);

        array_unshift($preOrders, $newOrder);
        session(['consumer_preorders' => $preOrders]);

        return redirect()->back()->with('success_preorder', "✅ Pesanan Titip Belanja Stok untuk '{$request->input('item_name')}' ({$request->input('quantity')} pcs) berhasil dikirim ke Toko! Juragan akan membelanjakannya besok pagi.");
    }

    public function claimFlashSale(Request $request)
    {
        $itemName = $request->input('item_name', 'Produk Flash Sale Cuci Gudang');
        $code = 'KUPON-CUCIGUDANG-' . strtoupper(substr(uniqid(), -5));

        return redirect()->back()->with('success_coupon', [
            'item' => $itemName,
            'code' => $code,
            'message' => "Kupon Flash Sale Cuci Gudang Jam 7 Malam berhasil diklaim! Tunjukkan kode [{$code}] saat pembayaran di kasir sebelum toko tutup.",
        ]);
    }
}
