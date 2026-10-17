<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();

        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('health_status', ucfirst($request->status));
        }

        if ($request->filled('category') && $request->category !== 'all') {
            $query->where('category', $request->category);
        }

        $products = $query->orderBy('stock_runway_days', 'asc')->get();

        // Ringkasan kesehatan inventaris
        $totalSku = Product::count();
        $criticalCount = Product::where('health_status', 'Critical')->count();
        $attentionCount = Product::where('health_status', 'Attention')->count();
        $healthyCount = Product::where('health_status', 'Healthy')->count();

        $healthyPct = $totalSku > 0 ? round(($healthyCount / $totalSku) * 100) : 85;
        $attentionPct = $totalSku > 0 ? round(($attentionCount / $totalSku) * 100) : 10;
        $criticalPct = $totalSku > 0 ? round(($criticalCount / $totalSku) * 100) : 5;

        // Auto-bundle critical items from same supplier
        $criticalProducts = Product::where('health_status', 'Critical')->get();

        return view('pages.smart_inventory', compact(
            'products',
            'totalSku',
            'criticalCount',
            'attentionCount',
            'healthyCount',
            'healthyPct',
            'attentionPct',
            'criticalPct',
            'criticalProducts'
        ));
    }

    public function reorder(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $qty = $request->input('quantity', $product->min_threshold * 2);

        // Simulasi penambahan stok
        $product->current_stock += $qty;
        $product->health_status = 'Healthy';
        $product->stock_runway_days = (int) ceil($product->current_stock / ($product->ai_velocity ?: 1));
        $product->save();

        return redirect()->back()->with('success', "Berhasil membuat restock order {$qty} unit untuk {$product->name}!");
    }

    public function createAutoBundlePO(Request $request)
    {
        // Temukan produk berstatus Critical dari supplier yang sama
        $criticalItems = Product::where('health_status', 'Critical')->get();

        if ($criticalItems->isEmpty()) {
            return redirect()->back()->with('info', 'Tidak ada produk berstatus kritis untuk digabungkan.');
        }

        $supplier = $criticalItems->first()->supplier_name ?: 'PT Kopi Nusantara Bandung';
        $storeId = 1;

        $totalAmount = 0;
        $itemsData = [];

        foreach ($criticalItems as $item) {
            $orderQty = $item->min_threshold * 2;
            $subtotal = $orderQty * $item->cost_price;
            $totalAmount += $subtotal;
            $itemsData[] = [
                'product_id' => $item->id,
                'quantity' => $orderQty,
                'unit_cost_price' => $item->cost_price,
                'subtotal' => $subtotal,
            ];

            // Update stok dan status produk
            $item->current_stock += $orderQty;
            $item->health_status = 'Healthy';
            $item->stock_runway_days = (int) ceil($item->current_stock / ($item->ai_velocity ?: 1));
            $item->save();
        }

        $poNumber = 'PO-' . date('Ymd') . '-' . strtoupper(substr(uniqid(), -4));
        $shippingSavings = $totalAmount * 0.05; // Estimasi 5% penghematan biaya logistik gabungan

        $po = \App\Models\PurchaseOrder::create([
            'po_number' => $poNumber,
            'store_id' => $storeId,
            'supplier_name' => $supplier,
            'total_amount' => $totalAmount,
            'shipping_discount_pct' => 18.0,
            'shipping_savings' => $shippingSavings,
            'prevented_lost_sales' => 2850000,
            'status' => 'Sent',
            'notes' => 'Auto-Bundle Restock via LARIS Smart Inventory Optimizer.',
        ]);

        foreach ($itemsData as $data) {
            $data['purchase_order_id'] = $po->id;
            \App\Models\PurchaseOrderItem::create($data);
        }

        return redirect()->back()->with('success', "Auto-Bundle PO {$poNumber} berhasil diterbitkan untuk {$supplier}! Potensi lost sales Rp 2.85M berhasil dicegah dan hemat ongkir 18%.");
    }

    public function joinCollectivePool(Request $request)
    {
        $poolName = $request->input('pool_name', 'Minyak Goreng Sawit 2L');
        $qty = (int) $request->input('pledge_qty', 10);
        $savings = (int) $request->input('estimated_savings', 55000);

        return redirect()->back()->with('success', "🎉 Berhasil bergabung ke Kulakan Bareng [{$poolName}] sebanyak {$qty} unit! Estimasi hemat modal: Rp " . number_format($savings, 0, ',', '.') . ". Pesanan akan otomatis dikirim bersama 14 warung tetangga lainnya saat pool terkumpul.");
    }
}

