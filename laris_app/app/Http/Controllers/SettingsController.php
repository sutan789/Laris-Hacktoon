<?php

namespace App\Http\Controllers;

use App\Models\Store;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SettingsController extends Controller
{
    public function index()
    {
        $store = Store::first() ?? new Store([
            'name' => 'Toko Berkah Utama',
            'business_type' => 'Retail & Grosir MSME',
            'address' => 'Jl. Braga No. 45, Bandung, Jawa Barat',
            'phone' => '081234567890',
            'operating_hours' => '08:00 - 22:00 WIB'
        ]);

        $user = auth()->user() ?? User::where('role', 'owner')->first() ?? (object) [
            'name' => 'Juragan Bambang',
            'email' => 'juragan@laris.id',
            'role' => 'owner',
            'phone' => '081234567890',
        ];

        // Integrasi Ekosistem Ritel, Marketplace, & Finansial Nasional
        $defaultChannels = [
            'pos_offline' => ['name' => 'Kasir Smart POS (Laris POS Offline-Sync)', 'status' => 'connected', 'last_sync' => '1 menit lalu', 'type' => 'pos'],
            'google_trends' => ['name' => 'Google Trends API Engine', 'status' => 'connected', 'last_sync' => 'Realtime Sync', 'type' => 'analytics'],
            'google_analytics' => ['name' => 'Google Analytics 4 (GA4 Live Stream)', 'status' => 'connected', 'last_sync' => 'Realtime Sync', 'type' => 'analytics'],
            'tiktok' => ['name' => 'TikTok Shop Intelligence API', 'status' => 'connected', 'last_sync' => '4 menit lalu', 'type' => 'marketplace'],
            'tokopedia' => ['name' => 'Tokopedia Official Store Open API', 'status' => 'connected', 'last_sync' => '5 menit lalu', 'type' => 'marketplace'],
            'shopee' => ['name' => 'Shopee Open Platform API', 'status' => 'connected', 'last_sync' => '3 menit lalu', 'type' => 'marketplace'],
            'qris_bi' => ['name' => 'QRIS Bank Indonesia (ASPI / GPN Settlement)', 'status' => 'connected', 'last_sync' => 'Settlement Realtime', 'type' => 'payment'],
        ];
        $channels = session('settings_channels', $defaultChannels);

        $aiConfig = session('settings_ai', [
            'model' => 'juragan-ai-standard',
            'sensitivity' => 'Tinggi (Viral Signals > 80%)',
            'runway_threshold' => 5, // hari
            'auto_bundle_discount' => 18, // persen
        ]);

        return view('pages.settings', compact('store', 'user', 'channels', 'aiConfig'));
    }

    public function updateStore(Request $request)
    {
        $request->validate([
            'store_name' => 'required|string|max:100',
            'address' => 'nullable|string|max:255',
            'operating_hours' => 'nullable|string|max:50',
            'phone' => 'nullable|string|max:30',
            'has_delivery' => 'nullable|boolean',
            'delivery_fee' => 'nullable|numeric|min:0',
            'delivery_radius_km' => 'nullable|integer|min:0',
            'bank_name' => 'nullable|string|max:50',
            'bank_account_number' => 'nullable|string|max:50',
            'bank_account_name' => 'nullable|string|max:100',
            'qris_nmid' => 'nullable|string|max:50',
            'qris_image' => 'nullable|string|max:1000',
            'qris_file' => 'nullable|file|image|mimes:jpeg,png,jpg,webp|max:3072',
        ]);

        $store = Store::first() ?? new Store();
        $store->name = $request->input('store_name');
        $store->address = $request->input('address');
        $store->operating_hours = $request->input('operating_hours');
        $store->phone = $request->input('phone');
        if ($request->has('has_delivery')) {
            $store->has_delivery = $request->boolean('has_delivery');
        }
        if ($request->filled('delivery_fee')) {
            $store->delivery_fee = (float) $request->input('delivery_fee');
        }
        if ($request->filled('delivery_radius_km')) {
            $store->delivery_radius_km = (int) $request->input('delivery_radius_km');
        }

        // Simpan Data Pembayaran Toko (QRIS & Bank)
        $store->bank_name = $request->input('bank_name', $store->bank_name);
        $store->bank_account_number = $request->input('bank_account_number', $store->bank_account_number);
        $store->bank_account_name = $request->input('bank_account_name', $store->bank_account_name);
        $store->qris_nmid = $request->input('qris_nmid', $store->qris_nmid);

        if ($request->hasFile('qris_file')) {
            $file = $request->file('qris_file');
            $filename = 'qris_' . time() . '_' . Str::random(5) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/qris'), $filename);
            $store->qris_image = asset('uploads/qris/' . $filename);
        } elseif ($request->filled('qris_image')) {
            $store->qris_image = $request->input('qris_image');
        }

        $store->save();

        return redirect()->back()->with('success', 'Profil dan pengaturan pembayaran toko berhasil diperbarui!');
    }

    public function updateAi(Request $request)
    {
        $aiConfig = [
            'model' => $request->input('model', 'juragan-ai-standard'),
            'sensitivity' => $request->input('sensitivity', 'Tinggi (Viral Signals > 80%)'),
            'runway_threshold' => (int) $request->input('runway_threshold', 5),
            'auto_bundle_discount' => (int) $request->input('auto_bundle_discount', 18),
        ];

        session(['settings_ai' => $aiConfig]);

        return redirect()->back()->with('success', 'Konfigurasi Autonomous AI Engine berhasil diperbarui!');
    }

    public function toggleChannel(Request $request, string $channelKey)
    {
        $defaultChannels = [
            'pos_offline' => ['name' => 'Kasir Smart POS (Laris POS Offline-Sync)', 'status' => 'connected', 'last_sync' => '1 menit lalu', 'type' => 'pos'],
            'google_trends' => ['name' => 'Google Trends API Engine', 'status' => 'connected', 'last_sync' => 'Realtime Sync', 'type' => 'analytics'],
            'google_analytics' => ['name' => 'Google Analytics 4 (GA4 Live Stream)', 'status' => 'connected', 'last_sync' => 'Realtime Sync', 'type' => 'analytics'],
            'tiktok' => ['name' => 'TikTok Shop Intelligence API', 'status' => 'connected', 'last_sync' => '4 menit lalu', 'type' => 'marketplace'],
            'tokopedia' => ['name' => 'Tokopedia Official Store Open API', 'status' => 'connected', 'last_sync' => '5 menit lalu', 'type' => 'marketplace'],
            'shopee' => ['name' => 'Shopee Open Platform API', 'status' => 'connected', 'last_sync' => '3 menit lalu', 'type' => 'marketplace'],
            'qris_bi' => ['name' => 'QRIS Bank Indonesia (ASPI / GPN Settlement)', 'status' => 'connected', 'last_sync' => 'Settlement Realtime', 'type' => 'payment'],
        ];
        $channels = session('settings_channels', $defaultChannels);

        if (isset($channels[$channelKey])) {
            $channels[$channelKey]['status'] = ($channels[$channelKey]['status'] === 'connected') ? 'disconnected' : 'connected';
            $channels[$channelKey]['last_sync'] = 'Baru saja diubah';
            session(['settings_channels' => $channels]);
        }

        return redirect()->back()->with('success', "Status integrasi channel {$channels[$channelKey]['name']} berhasil diperbarui!");
    }
}
