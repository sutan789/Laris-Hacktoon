<?php

namespace App\Http\Controllers;

use App\Models\Store;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SuperAdminController extends Controller
{
    /**
     * Dashboard Utama Super Admin Platform LARIS
     */
    public function dashboard(Request $request)
    {
        // 1. Metrik Platform Nasional
        $totalGMV = Order::sum('total_amount');
        $totalOrders = Order::count();
        $totalStores = Store::count();
        $totalUsers = User::count();

        // 2. Distribusi Sektor UMKM
        $sectorStats = Store::select('category', DB::raw('count(*) as total'))
            ->groupBy('category')
            ->get();

        // 3. Daftar Semua Gerai UMKM Lintas Sektor
        $storesQuery = Store::withCount('products');
        if ($request->filled('sector') && $request->sector !== 'all') {
            $storesQuery->where('category', $request->sector);
        }
        if ($request->filled('search')) {
            $s = $request->search;
            $storesQuery->where(function($q) use ($s) {
                $q->where('name', 'like', "%{$s}%")
                  ->orWhere('owner_name', 'like', "%{$s}%")
                  ->orWhere('location', 'like', "%{$s}%");
            });
        }
        $stores = $storesQuery->orderBy('created_at', 'asc')->get();

        // 4. Daftar Akun Pengguna & Role
        $usersQuery = User::with('store');
        if ($request->filled('role_filter') && $request->role_filter !== 'all') {
            $usersQuery->where('role', $request->role_filter);
        }
        $users = $usersQuery->latest()->take(20)->get();

        // 5. Transaksi Nasional Lintas Gerai
        $recentOrders = Order::with('store')
            ->latest()
            ->take(10)
            ->get();

        return view('pages.super_admin_dashboard', compact(
            'totalGMV',
            'totalOrders',
            'totalStores',
            'totalUsers',
            'sectorStats',
            'stores',
            'users',
            'recentOrders'
        ));
    }

    /**
     * Toggle status verifikasi gerai UMKM
     */
    public function toggleStoreVerification($id)
    {
        $store = Store::findOrFail($id);
        $store->is_verified = !$store->is_verified;
        $store->save();

        return back()->with('success', "Status verifikasi gerai '{$store->name}' berhasil diperbarui menjadi: " . ($store->is_verified ? 'Terverifikasi' : 'Belum Diverifikasi'));
    }

    /**
     * Toggle ketersediaan layanan pengantaran / delivery gerai
     */
    public function toggleStoreDelivery(Request $request, $id)
    {
        $store = Store::findOrFail($id);
        $store->has_delivery = !$store->has_delivery;
        if ($request->filled('delivery_fee')) {
            $store->delivery_fee = (float) $request->delivery_fee;
        }
        $store->save();

        $statusMsg = $store->has_delivery 
            ? "Layanan Antar Aktif (Ongkir: Rp " . number_format($store->delivery_fee, 0, ',', '.') . ")" 
            : "Layanan Antar Dinonaktifkan (Wajib Ambil Sendiri / Self-Pickup)";

        return back()->with('success', "Pengaturan pengantaran gerai '{$store->name}' berhasil diubah: {$statusMsg}");
    }

    /**
     * Tambah Akun Pengguna Baru oleh Super Admin
     */
    public function createUser(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'role' => 'required|in:super_admin,owner,staff_cashier,staff_inventory,user',
            'store_id' => 'nullable|exists:stores,id',
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'],
            'store_id' => $validated['store_id'] ?? null,
        ]);

        return back()->with('success', "Akun pengguna '{$validated['name']}' dengan peran " . ucfirst(str_replace('_', ' ', $validated['role'])) . " berhasil dibuat!");
    }

    /**
     * Update Role Pengguna
     */
    public function updateUserRole(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $validated = $request->validate([
            'role' => 'required|in:super_admin,owner,staff_cashier,staff_inventory,user',
        ]);

        $user->role = $validated['role'];
        $user->save();

        return back()->with('success', "Peran akun {$user->name} berhasil diperbarui menjadi: " . ucfirst(str_replace('_', ' ', $user->role)));
    }

    /**
     * Tambah Gerai UMKM Baru oleh Super Admin
     */
    public function createStore(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:150',
            'owner_name' => 'required|string|max:100',
            'category' => 'required|string|max:100',
            'location' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'has_delivery' => 'nullable',
            'delivery_fee' => 'nullable|numeric|min:0',
            'is_verified' => 'nullable',
        ]);

        $store = Store::create([
            'name' => $validated['name'],
            'owner_name' => $validated['owner_name'],
            'category' => $validated['category'],
            'location' => $validated['location'],
            'phone' => $validated['phone'] ?? '0812-3456-7890',
            'has_delivery' => $request->boolean('has_delivery'),
            'delivery_fee' => (float)($validated['delivery_fee'] ?? 5000),
            'delivery_radius_km' => 5,
            'rating' => 4.9,
            'is_verified' => $request->boolean('is_verified', true),
        ]);

        return back()->with('success', "Gerai UMKM '{$store->name}' berhasil didaftarkan ke platform LARIS!");
    }

    /**
     * Update Gerai UMKM oleh Super Admin
     */
    public function updateStore(Request $request, $id)
    {
        $store = Store::findOrFail($id);
        $validated = $request->validate([
            'name' => 'required|string|max:150',
            'owner_name' => 'required|string|max:100',
            'category' => 'required|string|max:100',
            'location' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'has_delivery' => 'nullable',
            'delivery_fee' => 'nullable|numeric|min:0',
            'is_verified' => 'nullable',
        ]);

        $store->update([
            'name' => $validated['name'],
            'owner_name' => $validated['owner_name'],
            'category' => $validated['category'],
            'location' => $validated['location'],
            'phone' => $validated['phone'] ?? $store->phone,
            'has_delivery' => $request->boolean('has_delivery'),
            'delivery_fee' => (float)($validated['delivery_fee'] ?? 0),
            'is_verified' => $request->boolean('is_verified'),
        ]);

        return back()->with('success', "Data gerai '{$store->name}' berhasil diperbarui!");
    }

    /**
     * Hapus Gerai UMKM oleh Super Admin
     */
    public function deleteStore($id)
    {
        $store = Store::findOrFail($id);
        $name = $store->name;
        User::where('store_id', $store->id)->update(['store_id' => null]);
        $store->delete();

        return back()->with('success', "Gerai '{$name}' telah dihapus dari sistem.");
    }

    /**
     * Update Pengguna oleh Super Admin
     */
    public function updateUser(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role' => 'required|in:super_admin,owner,staff_cashier,staff_inventory,user',
            'store_id' => 'nullable|exists:stores,id',
            'password' => 'nullable|string|min:6',
        ]);

        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->role = $validated['role'];
        $user->store_id = $validated['store_id'] ?? null;
        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }
        $user->save();

        return back()->with('success', "Data pengguna '{$user->name}' berhasil diperbarui!");
    }

    /**
     * Hapus Pengguna oleh Super Admin
     */
    public function deleteUser($id)
    {
        if (auth()->id() == $id) {
            return back()->with('error', 'Anda tidak dapat menghapus akun Anda sendiri saat sedang aktif.');
        }

        $user = User::findOrFail($id);
        $name = $user->name;
        $user->delete();

        return back()->with('success', "Akun pengguna '{$name}' telah dihapus.");
    }
}
