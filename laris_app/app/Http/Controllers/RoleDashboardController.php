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

        return view('pages.cashier_dashboard', compact('products', 'recentSales', 'todayTotal', 'todayCount'));
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
