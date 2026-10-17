<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Order;
use App\Models\Store;
use Illuminate\Http\Request;

class RoleDashboardController extends Controller
{
    /**
     * Dashboard Khusus Kasir (Smart POS & Sales Shift)
     */
    public function cashierDashboard()
    {
        $products = Product::where('current_stock', '>', 0)->get();
        $recentSales = Order::where('channel', 'Offline Store')->latest()->take(8)->get();
        $todayTotal = Order::where('channel', 'Offline Store')->whereDate('created_at', today())->sum('total_amount');
        $todayCount = Order::where('channel', 'Offline Store')->whereDate('created_at', today())->count();

        $kasbonCustomers = [
            ['name' => 'Pak RT Joko', 'phone' => '081298765432', 'score' => 94, 'status' => 'Aman', 'limit' => 350000, 'current_debt' => 45000],
            ['name' => 'Bu Siti Khodijah', 'phone' => '081388776655', 'score' => 88, 'status' => 'Aman', 'limit' => 200000, 'current_debt' => 25000],
            ['name' => 'Mas Budi Santoso', 'phone' => '085712349988', 'score' => 65, 'status' => 'Perhatian', 'limit' => 100000, 'current_debt' => 80000],
        ];

        return view('pages.cashier_dashboard', compact('products', 'recentSales', 'todayTotal', 'todayCount', 'kasbonCustomers'));
    }

    /**
     * Dashboard Khusus Staf Gudang (Smart Inventory & Stock Operations)
     */
    public function inventoryDashboard()
    {
        $criticalCount = Product::where('health_status', 'Critical')->count();
        $attentionCount = Product::where('health_status', 'Attention')->count();
        $healthyCount = Product::where('health_status', 'Healthy')->count();
        $products = Product::orderBy('current_stock', 'asc')->get();
        $pendingPOs = \App\Models\PurchaseOrder::where('status', 'Sent')->orWhere('status', 'Draft')->get();

        return view('pages.warehouse_dashboard', compact('criticalCount', 'attentionCount', 'healthyCount', 'products', 'pendingPOs'));
    }

    /**
     * Dashboard Khusus Konsumen / Pembeli Warga Sekitar
     */
    public function customerDashboard(Request $request)
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
                  ->orWhere('category', 'like', "%{$search}%");
            });
        }
        $products = $query->take(12)->get();
        $categories = Product::select('category')->distinct()->pluck('category');

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
                'discount_pct' => 35,
                'stock_left' => 5,
                'unit' => 'botol',
                'reason' => 'Stok dingin harian toko',
                'image' => 'https://images.unsplash.com/photo-1550583724-b2692b85b150?w=300&auto=format&fit=crop&q=80',
            ],
            [
                'id' => 'fs-3',
                'name' => 'Apel Fuji Manis Segar 1kg',
                'category' => 'Buah Segar',
                'original_price' => 38000,
                'discount_price' => 24000,
                'discount_pct' => 36,
                'stock_left' => 4,
                'unit' => 'kg',
                'reason' => 'Cuci rak buah sore',
                'image' => 'https://images.unsplash.com/photo-1560806887-1e4cd0b6cbd6?w=300&auto=format&fit=crop&q=80',
            ],
        ];

        $preOrders = [
            ['item_name' => 'Beras Ramos Super 10kg', 'quantity' => 2, 'customer_name' => auth()->user()->name ?? 'Ibu Siti', 'phone' => '0812-3456-7890', 'time' => '10 menit lalu', 'status' => 'Dikonfirmasi Juragan'],
            ['item_name' => 'Minyak Goreng Filma 2L', 'quantity' => 1, 'customer_name' => 'Pak Bambang', 'phone' => '0813-9876-5432', 'time' => '35 menit lalu', 'status' => 'Siap Diambil Pukul 06:30'],
            ['item_name' => 'Kopi Arabika Gayo 250g', 'quantity' => 3, 'customer_name' => 'Mas Rudi', 'phone' => '0856-1122-3344', 'time' => '1 jam lalu', 'status' => 'Dalam Perjalanan Kulakan'],
        ];

        $coupons = [
            ['code' => 'TETANGGA-HEMAT', 'title' => 'Diskon Tetangga Rp 2.500', 'desc' => 'Potongan langsung untuk belanja sembako minimal Rp 25.000', 'valid_until' => 'Hari Ini s.d 22:00'],
            ['code' => 'CUCIRAK-MALAM', 'title' => 'Ekstra Diskon 10% Cuci Rak', 'desc' => 'Dapat digunakan pada jam Flash Sale 19:00 - 22:00 WIB', 'valid_until' => 'Malam Ini'],
        ];

        return view('pages.customer_dashboard', compact('store', 'products', 'categories', 'flashSaleItems', 'preOrders', 'coupons'));
    }
}
