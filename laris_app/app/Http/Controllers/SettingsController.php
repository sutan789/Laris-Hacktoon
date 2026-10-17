<?php

namespace App\Http\Controllers;

use App\Models\Store;
use App\Models\User;
use Illuminate\Http\Request;

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

        // Simulasi setting integrasi & AI dari config/session
        $channels = session('settings_channels', [
            'pos_offline' => ['name' => 'Kasir Smart POS (Laris POS)', 'status' => 'connected', 'last_sync' => '1 menit lalu'],
            'shopee' => ['name' => 'Shopee Official Store', 'status' => 'connected', 'last_sync' => '3 menit lalu'],
            'tokopedia' => ['name' => 'Tokopedia Power Merchant', 'status' => 'connected', 'last_sync' => '5 menit lalu'],
            'tiktok' => ['name' => 'TikTok Shop Seller', 'status' => 'standby', 'last_sync' => 'Belum dikonfigurasi'],
        ]);

        $aiConfig = session('settings_ai', [
            'model' => env('AI_MODEL', 'gemini-3.8-flash'),
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
        ]);

        $store = Store::first() ?? new Store();
        $store->name = $request->input('store_name');
        $store->address = $request->input('address');
        $store->operating_hours = $request->input('operating_hours');
        $store->phone = $request->input('phone');
        $store->save();

        return redirect()->back()->with('success', 'Profil toko berhasil diperbarui!');
    }

    public function updateAi(Request $request)
    {
        $aiConfig = [
            'model' => $request->input('model', 'gemini-3.8-flash'),
            'sensitivity' => $request->input('sensitivity', 'Tinggi (Viral Signals > 80%)'),
            'runway_threshold' => (int) $request->input('runway_threshold', 5),
            'auto_bundle_discount' => (int) $request->input('auto_bundle_discount', 18),
        ];

        session(['settings_ai' => $aiConfig]);

        return redirect()->back()->with('success', 'Konfigurasi Autonomous AI Engine berhasil diperbarui!');
    }

    public function toggleChannel(Request $request, string $channelKey)
    {
        $channels = session('settings_channels', [
            'pos_offline' => ['name' => 'Kasir Smart POS (Laris POS)', 'status' => 'connected', 'last_sync' => '1 menit lalu'],
            'shopee' => ['name' => 'Shopee Official Store', 'status' => 'connected', 'last_sync' => '3 menit lalu'],
            'tokopedia' => ['name' => 'Tokopedia Power Merchant', 'status' => 'connected', 'last_sync' => '5 menit lalu'],
            'tiktok' => ['name' => 'TikTok Shop Seller', 'status' => 'standby', 'last_sync' => 'Belum dikonfigurasi'],
        ]);

        if (isset($channels[$channelKey])) {
            $channels[$channelKey]['status'] = ($channels[$channelKey]['status'] === 'connected') ? 'disconnected' : 'connected';
            $channels[$channelKey]['last_sync'] = 'Baru saja diubah';
            session(['settings_channels' => $channels]);
        }

        return redirect()->back()->with('success', "Status integrasi channel {$channels[$channelKey]['name']} berhasil diperbarui!");
    }
}
