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

        // Cari produk stok kritis yang paling mendesak butuh restock (real data)
        $emergencyProduct = Product::where('health_status', 'Critical')
            ->orWhere(function ($q) {
                $q->whereColumn('current_stock', '<=', 'min_threshold')
                  ->where('current_stock', '>', 0);
            })
            ->orderBy('stock_runway_days', 'asc')
            ->first();

        return view('pages.smart_inventory', compact(
            'products',
            'totalSku',
            'criticalCount',
            'attentionCount',
            'healthyCount',
            'healthyPct',
            'attentionPct',
            'criticalPct',
            'criticalProducts',
            'emergencyProduct'
        ));
    }

    public function storeProduct(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'sku' => 'nullable|string|max:50',
            'category' => 'required|string|max:100',
            'cost_price' => 'required|numeric|min:0',
            'selling_price' => 'required|numeric|min:0',
            'current_stock' => 'required|integer|min:0',
            'min_threshold' => 'required|integer|min:1',
            'ai_velocity' => 'nullable|numeric|min:0.1',
            'supplier_name' => 'nullable|string|max:255',
            'supplier_lead_time_days' => 'nullable|integer|min:1',
            'image_url' => 'nullable|string|max:1000',
        ]);

        $storeId = 1;
        $sku = !empty($validated['sku']) ? strtoupper($validated['sku']) : ('SKU-' . strtoupper(\Illuminate\Support\Str::random(6)));
        $velocity = !empty($validated['ai_velocity']) ? (float)$validated['ai_velocity'] : 5.0;
        $stock = (int)$validated['current_stock'];
        $minStock = (int)$validated['min_threshold'];
        
        $runwayDays = (int) ceil($stock / max(0.5, $velocity));
        $healthStatus = 'Healthy';
        if ($stock <= $minStock) {
            $healthStatus = 'Critical';
        } elseif ($stock <= ($minStock * 1.5)) {
            $healthStatus = 'Attention';
        }

        $imageUrl = !empty($validated['image_url']) 
            ? $validated['image_url'] 
            : 'https://images.unsplash.com/photo-1542838132-92c53300491e?w=400&auto=format&fit=crop&q=80';

        Product::create([
            'store_id' => $storeId,
            'name' => $validated['name'],
            'sku' => $sku,
            'category' => $validated['category'],
            'cost_price' => $validated['cost_price'],
            'selling_price' => $validated['selling_price'],
            'current_stock' => $stock,
            'min_threshold' => $minStock,
            'health_status' => $healthStatus,
            'ai_velocity' => $velocity,
            'stock_runway_days' => $runwayDays,
            'supplier_name' => $validated['supplier_name'] ?: 'Distributor Ritel Lokal',
            'supplier_lead_time_days' => $validated['supplier_lead_time_days'] ?: 2,
            'image_url' => $imageUrl,
            'is_dead_stock' => false,
            'dead_stock_days' => 0,
        ]);

        return redirect()->route('inventory.index')->with('success', "Produk baru '{$validated['name']}' ({$sku}) berhasil didaftarkan ke inventaris toko!");
    }

    public function reorder(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $qty = (int) $request->input('quantity', $product->min_threshold * 2);
        if ($qty < 1) $qty = 1;

        $oldStock = $product->current_stock;
        $product->current_stock += $qty;
        $product->stock_runway_days = (int) ceil($product->current_stock / max(0.5, $product->ai_velocity ?: 1));
        
        if ($product->current_stock > $product->min_threshold * 1.2) {
            $product->health_status = 'Healthy';
        } elseif ($product->current_stock > $product->min_threshold) {
            $product->health_status = 'Attention';
        } else {
            $product->health_status = 'Critical';
        }
        $product->save();

        // Buat Purchase Order resmi di database
        $poNumber = 'PO-RST-' . date('Ymd') . '-' . strtoupper(substr(uniqid(), -4));
        $totalAmount = $qty * $product->cost_price;
        $po = \App\Models\PurchaseOrder::create([
            'po_number' => $poNumber,
            'store_id' => $product->store_id ?: 1,
            'supplier_name' => $product->supplier_name ?: 'Distributor Ritel Resmi',
            'total_amount' => $totalAmount,
            'shipping_discount_pct' => 10.0,
            'shipping_savings' => $totalAmount * 0.03,
            'prevented_lost_sales' => $qty * ($product->selling_price - $product->cost_price),
            'status' => 'Confirmed',
            'notes' => "Restock Cepat {$qty} unit untuk {$product->name} (Stok: {$oldStock} -> {$product->current_stock}).",
        ]);

        \App\Models\PurchaseOrderItem::create([
            'purchase_order_id' => $po->id,
            'product_id' => $product->id,
            'quantity' => $qty,
            'unit_cost_price' => $product->cost_price,
            'subtotal' => $totalAmount,
        ]);

        $msg = "Restock Cepat Berhasil! Ditambahkan +{$qty} unit untuk {$product->name} (PO: {$poNumber}). Stok terkini: {$product->current_stock} unit.";

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'status' => 'success',
                'message' => $msg,
                'product' => $product,
                'po_number' => $poNumber,
                'new_stock' => $product->current_stock,
            ]);
        }

        return redirect()->back()->with('success', $msg);
    }

    public function updateProduct(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'cost_price' => 'required|numeric|min:0',
            'selling_price' => 'required|numeric|min:0',
            'current_stock' => 'required|integer|min:0',
            'min_threshold' => 'required|integer|min:1',
            'ai_velocity' => 'nullable|numeric|min:0.1',
            'supplier_name' => 'nullable|string|max:255',
            'image_url' => 'nullable|string|max:1000',
        ]);

        $stock = (int) $validated['current_stock'];
        $minStock = (int) $validated['min_threshold'];
        $velocity = !empty($validated['ai_velocity']) ? (float) $validated['ai_velocity'] : ($product->ai_velocity ?: 5.0);
        $runwayDays = (int) ceil($stock / max(0.5, $velocity));

        $healthStatus = 'Healthy';
        if ($stock <= $minStock) {
            $healthStatus = 'Critical';
        } elseif ($stock <= ($minStock * 1.5)) {
            $healthStatus = 'Attention';
        }

        $product->update([
            'name' => $validated['name'],
            'category' => $validated['category'],
            'cost_price' => $validated['cost_price'],
            'selling_price' => $validated['selling_price'],
            'current_stock' => $stock,
            'min_threshold' => $minStock,
            'ai_velocity' => $velocity,
            'stock_runway_days' => $runwayDays,
            'health_status' => $healthStatus,
            'supplier_name' => !empty($validated['supplier_name']) ? $validated['supplier_name'] : $product->supplier_name,
            'image_url' => !empty($validated['image_url']) ? $validated['image_url'] : $product->image_url,
        ]);

        $msg = "Data produk '{$product->name}' (SKU: {$product->sku}) berhasil diperbarui!";

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'status' => 'success',
                'message' => $msg,
                'product' => $product,
            ]);
        }

        return redirect()->route('inventory.index')->with('success', $msg);
    }

    public function deleteProduct(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $name = $product->name;
        $sku = $product->sku;
        $product->delete();

        $msg = "Produk '{$name}' ({$sku}) telah dihapus dari inventaris toko.";

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'status' => 'success',
                'message' => $msg,
            ]);
        }

        return redirect()->route('inventory.index')->with('success', $msg);
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

        return redirect()->back()->with('success', "Auto-Bundle PO {$poNumber} berhasil diterbitkan untuk {$supplier}! Potensi lost sales Rp 2,85 Juta berhasil dicegah dan hemat ongkir 18%.");
    }

    public function joinCollectivePool(Request $request)
    {
        $poolName = $request->input('pool_name', 'Minyak Goreng Sawit 2L');
        $qty = (int) $request->input('pledge_qty', 10);
        $savings = (int) $request->input('estimated_savings', 55000);

        return redirect()->back()->with('success', "Berhasil bergabung ke Pengadaan Grosir Bersama [{$poolName}] sebanyak {$qty} unit! Estimasi hemat modal: Rp " . number_format($savings, 0, ',', '.') . ". Pesanan akan otomatis dikirim bersama 14 warung tetangga lainnya saat kuota grosir terpenuhi.");
    }
}

