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
}
