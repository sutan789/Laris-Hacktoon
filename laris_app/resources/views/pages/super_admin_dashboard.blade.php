@extends('layouts.app', ['title' => 'Super Administrator Platform - LARIS'])

@section('content')
<div class="admin-dashboard-container">
    {{-- Header Banner --}}
    <div class="admin-header-card">
        <div class="header-left">
            <div class="super-badge">
                <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                <span>Portal Pusat Manajemen Nasional</span>
            </div>
            <h1 class="admin-title">Super Administrator Platform</h1>
            <p class="admin-subtitle">Monitoring performa GMV nasional, kontrol gerai UMKM lintas sektor, manajemen hak akses 4 role, dan otomasi logistik pengantaran.</p>
        </div>
        <div class="header-actions">
            <button type="button" class="btn-admin-primary" onclick="openAddUserModal()">
                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/></svg>
                <span>Tambah Akun Pengguna</span>
            </button>
            <a href="{{ url('/') }}" target="_blank" class="btn-admin-secondary">
                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                <span>Kunjungi Landing Page</span>
            </a>
        </div>
    </div>

    {{-- Alert Messages --}}
    @if(session('success'))
        <div class="alert-box success">
            <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
            <span>{{ session('success') }}</span>
        </div>
    @endif
    @if($errors->any())
        <div class="alert-box error">
            <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            <span>{{ $errors->first() }}</span>
        </div>
    @endif

    {{-- Platform Top Metrics (GMV, Stores, Orders, Users) --}}
    <div class="kpi-grid">
        <div class="kpi-card">
            <div class="kpi-icon-wrap mint">
                <svg width="22" height="22" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <div class="kpi-content">
                <div class="kpi-label">Gross Merchandise Value (GMV)</div>
                <div class="kpi-value">Rp {{ number_format($totalGMV, 0, ',', '.') }}</div>
                <div class="kpi-meta"><span class="kpi-trend positive">+18.4%</span> volume belanja ekosistem</div>
            </div>
        </div>

        <div class="kpi-card">
            <div class="kpi-icon-wrap blue">
                <svg width="22" height="22" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
            </div>
            <div class="kpi-content">
                <div class="kpi-label">Gerai UMKM Terdaftar</div>
                <div class="kpi-value">{{ $totalStores }} <span class="unit">Gerai</span></div>
                <div class="kpi-meta">5 sektor aktif terverifikasi</div>
            </div>
        </div>

        <div class="kpi-card">
            <div class="kpi-icon-wrap amber">
                <svg width="22" height="22" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
            </div>
            <div class="kpi-content">
                <div class="kpi-label">Total Transaksi Selesai</div>
                <div class="kpi-value">{{ number_format($totalOrders, 0, ',', '.') }} <span class="unit">Order</span></div>
                <div class="kpi-meta">Layanan Antar &amp; Self-Pickup</div>
            </div>
        </div>

        <div class="kpi-card">
            <div class="kpi-icon-wrap indigo">
                <svg width="22" height="22" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
            </div>
            <div class="kpi-content">
                <div class="kpi-label">Akun Pengguna Terdaftar</div>
                <div class="kpi-value">{{ $totalUsers }} <span class="unit">Akun</span></div>
                <div class="kpi-meta">4 peran terisolasi aman</div>
            </div>
        </div>
    </div>

    {{-- Sektor UMKM Distribution Badges --}}
    <div class="sector-badges-bar">
        <span class="sector-bar-title">Sebaran Sektor UMKM:</span>
        @foreach($sectorStats as $stat)
            <div class="sector-pill">
                <span class="sector-name">{{ $stat->category }}</span>
                <span class="sector-count">{{ $stat->total }} gerai</span>
            </div>
        @endforeach
    </div>

    {{-- Tab Navigation for Admin Sections --}}
    <div class="admin-tabs" id="admin-tabs-nav">
        <button class="tab-btn active" onclick="switchAdminTab('stores-tab', this)">
            <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
            <span>Gerai UMKM Lintas Sektor</span>
        </button>
        <button class="tab-btn" onclick="switchAdminTab('users-tab', this)">
            <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
            <span>Manajemen Pengguna (4 Role)</span>
        </button>
        <button class="tab-btn" onclick="switchAdminTab('orders-tab', this)">
            <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/></svg>
            <span>Telemetri Transaksi Nasional</span>
        </button>
    </div>

    {{-- TAB 1: GERAI UMKM LINTAS SEKTOR --}}
    <div class="tab-pane active" id="stores-tab">
        <div class="section-card">
            <div class="section-card-header">
                <div>
                    <h2 class="section-card-title">Daftar Gerai UMKM &amp; Pengaturan Pengantaran</h2>
                    <p class="section-card-desc">Atur status verifikasi resmi dan tentukan apakah gerai menyediakan pengantaran toko atau hanya self-pickup.</p>
                </div>
                <div style="display: flex; gap: 10px; align-items: center; flex-wrap: wrap;">
                    <button type="button" class="btn-admin-primary" onclick="openAddStoreModal()">
                        <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.5v15m7.5-7.5h-15"/></svg>
                        <span>Tambah Gerai Baru</span>
                    </button>
                    {{-- Filter Sektor --}}
                    <form action="{{ route('admin.dashboard') }}" method="GET" class="filter-form">
                        <select name="sector" onchange="this.form.submit()" class="filter-select">
                            <option value="all">Semua Sektor UMKM</option>
                            <option value="Kuliner & F&B" {{ request('sector') === 'Kuliner & F&B' ? 'selected' : '' }}>Kuliner &amp; F&amp;B</option>
                            <option value="Sembako & Kelontong" {{ request('sector') === 'Sembako & Kelontong' ? 'selected' : '' }}>Sembako &amp; Kelontong</option>
                            <option value="Fashion & Pakaian" {{ request('sector') === 'Fashion & Pakaian' ? 'selected' : '' }}>Fashion &amp; Pakaian</option>
                            <option value="Kerajinan & Kriya" {{ request('sector') === 'Kerajinan & Kriya' ? 'selected' : '' }}>Kerajinan &amp; Kriya</option>
                            <option value="Jasa & Layanan" {{ request('sector') === 'Jasa & Layanan' ? 'selected' : '' }}>Jasa &amp; Layanan</option>
                        </select>
                    </form>
                </div>
            </div>

            <div class="table-responsive">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Gerai &amp; Juragan</th>
                            <th>Sektor / Kategori</th>
                            <th>Lokasi &amp; Kontak</th>
                            <th>Rating &amp; Produk</th>
                            <th>Layanan Pengantaran</th>
                            <th>Verifikasi</th>
                            <th style="text-align: right;">Aksi Kontrol</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($stores as $st)
                            <tr>
                                <td>
                                    <div class="store-cell">
                                        <div class="store-avatar">
                                            <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                                        </div>
                                        <div>
                                            <div class="cell-primary-text">{{ $st->name }}</div>
                                            <div class="cell-sub-text">Pemilik: {{ $st->owner_name }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="sector-tag">{{ $st->category }}</span>
                                </td>
                                <td>
                                    <div class="cell-primary-text">{{ $st->location }}</div>
                                    <div class="cell-sub-text">{{ $st->phone ?? '0812-xxxx-xxxx' }}</div>
                                </td>
                                <td>
                                    <div class="rating-cell">
                                        <svg width="14" height="14" fill="#F59E0B" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                        <span style="font-weight: 700; color: #0F172A;">{{ number_format($st->rating ?? 4.8, 1) }}</span>
                                        <span class="cell-sub-text">({{ $st->products_count }} item)</span>
                                    </div>
                                </td>
                                <td>
                                    @if($st->has_delivery)
                                        <div class="delivery-badge-yes">
                                            <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0"/></svg>
                                            <span>Diantar Toko (Rp {{ number_format($st->delivery_fee ?? 5000, 0, ',', '.') }})</span>
                                        </div>
                                    @else
                                        <div class="delivery-badge-no">
                                            <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                            <span>Ambil Sendiri di Gerai (Self-Pickup)</span>
                                        </div>
                                    @endif
                                </td>
                                <td>
                                    @if($st->is_verified)
                                        <span class="status-badge verified">
                                            <svg width="12" height="12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                            Terverifikasi
                                        </span>
                                    @else
                                        <span class="status-badge unverified">
                                            <svg width="12" height="12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                            Pending
                                        </span>
                                    @endif
                                </td>
                                <td style="text-align: right;">
                                    <div class="action-btn-group" style="display: flex; gap: 6px; justify-content: flex-end; align-items: center; flex-wrap: wrap;">
                                        {{-- Edit Gerai Modal Trigger --}}
                                        <button type="button" class="btn-action-outline" onclick="openEditStoreModal({{ $st->id }}, '{{ addslashes($st->name) }}', '{{ addslashes($st->owner_name) }}', '{{ addslashes($st->category) }}', '{{ addslashes($st->location) }}', '{{ addslashes($st->phone ?? '') }}', {{ $st->has_delivery ? 'true' : 'false' }}, {{ (float)($st->delivery_fee ?? 0) }}, {{ $st->is_verified ? 'true' : 'false' }})" title="Edit Gerai">
                                            <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125"/></svg>
                                            <span>Edit</span>
                                        </button>

                                        {{-- Toggle Delivery Form --}}
                                        <form action="{{ route('admin.stores.toggle_delivery', $st->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            <button type="submit" class="btn-action-outline" title="Ubah status pengantaran toko">
                                                <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/></svg>
                                                <span>{{ $st->has_delivery ? 'Pickup' : 'Antar' }}</span>
                                            </button>
                                        </form>

                                        {{-- Toggle Verification Form --}}
                                        <form action="{{ route('admin.stores.toggle_verification', $st->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            <button type="submit" class="btn-action-outline {{ $st->is_verified ? 'text-amber' : 'text-mint' }}" title="Ubah status verifikasi">
                                                <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                                <span>{{ $st->is_verified ? 'Unverify' : 'Verify' }}</span>
                                            </button>
                                        </form>

                                        {{-- Hapus Gerai --}}
                                        <form action="{{ route('admin.stores.delete', $st->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus gerai {{ addslashes($st->name) }}?')">
                                            @csrf
                                            <button type="submit" class="btn-action-outline" title="Hapus Gerai" style="color: #EF4444; border-color: rgba(239, 68, 68, 0.3);">
                                                <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"/></svg>
                                                <span>Hapus</span>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" style="text-align: center; padding: 36px; color: #94A3B8;">Tidak ada data gerai ditemukan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- TAB 2: MANAJEMEN PENGGUNA (4 ROLE TERISOLASI) --}}
    <div class="tab-pane" id="users-tab">
        <div class="section-card">
            <div class="section-card-header">
                <div>
                    <h2 class="section-card-title">Manajemen Akun Pengguna (4 Role Resmi)</h2>
                    <p class="section-card-desc">Kontrol hak akses dan pemisahan sesi untuk Super Admin, Juragan (Owner), Kasir Toko, dan User (Pembeli).</p>
                </div>
                <button type="button" class="btn-admin-primary" onclick="openAddUserModal()">
                    <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                    <span>Tambah Pengguna</span>
                </button>
            </div>

            <div class="table-responsive">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Nama &amp; Email Pengguna</th>
                            <th>Peran (Role Sistem)</th>
                            <th>Afiliasi Gerai</th>
                            <th>Tanggal Bergabung</th>
                            <th style="text-align: right;">Ubah Peran</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $usr)
                            <tr>
                                <td>
                                    <div class="store-cell">
                                        <div class="user-cell-avatar">
                                            {{ strtoupper(substr($usr->name, 0, 1)) }}
                                        </div>
                                        <div>
                                            <div class="cell-primary-text">{{ $usr->name }}</div>
                                            <div class="cell-sub-text">{{ $usr->email }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    @php
                                        $roleBadgeClass = match($usr->role) {
                                            'super_admin' => 'role-superadmin',
                                            'owner' => 'role-owner',
                                            'staff_cashier' => 'role-cashier',
                                            'staff_inventory' => 'role-inventory',
                                            'user', 'customer' => 'role-user',
                                            default => 'role-user',
                                        };
                                        $roleName = match($usr->role) {
                                            'super_admin' => 'Super Administrator',
                                            'owner' => 'Juragan UMKM (Owner)',
                                            'staff_cashier' => 'Kasir Toko',
                                            'staff_inventory' => 'Staf Gudang',
                                            'user', 'customer' => 'User (Pembeli)',
                                            default => ucfirst($usr->role),
                                        };
                                    @endphp
                                    <span class="role-pill {{ $roleBadgeClass }}">{{ $roleName }}</span>
                                </td>
                                <td>
                                    <div class="cell-primary-text">{{ $usr->store->name ?? '-' }}</div>
                                </td>
                                <td>
                                    <div class="cell-sub-text">{{ $usr->created_at ? $usr->created_at->format('d M Y, H:i') : '-' }}</div>
                                </td>
                                <td style="text-align: right;">
                                    <div style="display: inline-flex; align-items: center; gap: 6px; justify-content: flex-end;">
                                        <form action="{{ route('admin.users.update_role', $usr->id) }}" method="POST" style="display: inline-flex; align-items: center; gap: 4px;">
                                            @csrf
                                            <select name="role" class="role-select" title="Ganti peran cepat">
                                                <option value="user" {{ in_array($usr->role, ['user', 'customer']) ? 'selected' : '' }}>User</option>
                                                <option value="owner" {{ $usr->role === 'owner' ? 'selected' : '' }}>Juragan</option>
                                                <option value="staff_cashier" {{ $usr->role === 'staff_cashier' ? 'selected' : '' }}>Kasir</option>
                                                <option value="staff_inventory" {{ $usr->role === 'staff_inventory' ? 'selected' : '' }}>Gudang</option>
                                                <option value="super_admin" {{ $usr->role === 'super_admin' ? 'selected' : '' }}>Admin</option>
                                            </select>
                                            <button type="submit" class="btn-action-mini" title="Simpan Peran">
                                                <svg width="13" height="13" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                            </button>
                                        </form>

                                        {{-- Edit User Modal Trigger --}}
                                        <button type="button" class="btn-action-mini" onclick="openEditUserModal({{ $usr->id }}, '{{ addslashes($usr->name) }}', '{{ addslashes($usr->email) }}', '{{ $usr->role }}', '{{ $usr->store_id ?? '' }}')" title="Edit Akun Lengkap" style="background: #F1F5F9; border: 1px solid #CBD5E1; color: #334155;">
                                            <svg width="13" height="13" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125"/></svg>
                                        </button>

                                        {{-- Hapus User --}}
                                        @if(auth()->id() != $usr->id)
                                        <form action="{{ route('admin.users.delete', $usr->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus akun {{ addslashes($usr->name) }}?')">
                                            @csrf
                                            <button type="submit" class="btn-action-mini" title="Hapus Akun" style="background: #FEF2F2; border: 1px solid #FCA5A5; color: #EF4444;">
                                                <svg width="13" height="13" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"/></svg>
                                            </button>
                                        </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- TAB 3: TELEMETRI TRANSAKSI NASIONAL --}}
    <div class="tab-pane" id="orders-tab">
        <div class="section-card">
            <div class="section-card-header">
                <div>
                    <h2 class="section-card-title">Telemetri Transaksi Lintas Gerai Real-Time</h2>
                    <p class="section-card-desc">Arus pesanan multi-kanal (Offline POS, Marketplace App, TikTok, Shopee, Tokopedia).</p>
                </div>
            </div>

            <div class="table-responsive">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>No. Order</th>
                            <th>Gerai UMKM</th>
                            <th>Pelanggan</th>
                            <th>Kanal &amp; Tipe Pengantaran</th>
                            <th>Metode Pembayaran</th>
                            <th>Total Nominal</th>
                            <th>Status Pesanan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentOrders as $ord)
                            <tr>
                                <td>
                                    <span class="order-code">{{ $ord->order_number ?? ('ORD-' . $ord->id) }}</span>
                                    <div class="cell-sub-text">{{ $ord->created_at ? $ord->created_at->diffForHumans() : 'Baru saja' }}</div>
                                </td>
                                <td>
                                    <div class="cell-primary-text">{{ $ord->store->name ?? 'Gerai Pusat' }}</div>
                                    <div class="cell-sub-text">{{ $ord->store->category ?? 'Retail' }}</div>
                                </td>
                                <td>
                                    <div class="cell-primary-text">{{ $ord->customer_name ?? 'Pelanggan Umum' }}</div>
                                    <div class="cell-sub-text">{{ $ord->customer_phone ?? '-' }}</div>
                                </td>
                                <td>
                                    <div class="cell-primary-text">{{ $ord->channel ?? 'Marketplace App' }}</div>
                                    <div class="cell-sub-text" style="display: flex; align-items: center; gap: 4px;">
                                        @if(($ord->delivery_type ?? 'delivery') === 'pickup')
                                            <svg width="12" height="12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z"/></svg>
                                            <span>Ambil di Gerai (Self-Pickup)</span>
                                        @else
                                            <svg width="12" height="12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.25 18.75a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 0 1-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 0 0-3.213-9.193 2.056 2.056 0 0 0-1.58-.86H14.25M16.5 18.75h-2.25m0-11.175V3.75A1.125 1.125 0 0 0 13.125 2.625h-6.75A1.125 1.125 0 0 0 5.25 3.75v10.5"/></svg>
                                            <span>Pengantaran Toko</span>
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    @if(strtolower($ord->payment_method ?? 'cash') === 'qris')
                                        <span class="pay-tag qris">QRIS Otomatis</span>
                                    @else
                                        <span class="pay-tag cash">Tunai</span>
                                    @endif
                                </td>
                                <td>
                                    <div style="font-weight: 700; color: #0F172A;">Rp {{ number_format($ord->total_amount, 0, ',', '.') }}</div>
                                    @if($ord->discount_amount > 0)
                                        <div class="cell-sub-text" style="color: #10B981;">Diskon: -Rp {{ number_format($ord->discount_amount, 0, ',', '.') }}</div>
                                    @endif
                                </td>
                                <td>
                                    <span class="status-badge success">
                                        <svg width="12" height="12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                        {{ $ord->status ?? 'Selesai' }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" style="text-align: center; padding: 36px; color: #94A3B8;">Belum ada riwayat pesanan tercatat.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

{{-- Modal Tambah Akun Pengguna --}}
<div id="addUserModal" class="modal-overlay">
    <div class="modal-card">
        <div class="modal-header">
            <h3 class="modal-title">Tambah Akun Pengguna Baru</h3>
            <button type="button" class="modal-close-btn" onclick="closeAddUserModal()">
                <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
        <form action="{{ route('admin.users.create') }}" method="POST">
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text" name="name" required class="form-input" placeholder="Contoh: Andi Wijaya">
                </div>
                <div class="form-group">
                    <label class="form-label">Alamat Email</label>
                    <input type="email" name="email" required class="form-input" placeholder="user@laris.id">
                </div>
                <div class="form-group">
                    <label class="form-label">Kata Sandi</label>
                    <input type="password" name="password" required minlength="6" class="form-input" placeholder="Minimal 6 karakter">
                </div>
                <div class="form-group">
                    <label class="form-label">Peran Sistem (Role)</label>
                    <select name="role" required class="form-input" onchange="toggleStoreField(this.value)">
                        <option value="user">User (Pembeli / Konsumen Gojek Style)</option>
                        <option value="owner">Juragan UMKM (Owner Store)</option>
                        <option value="staff_cashier">Kasir Toko (Terminal Smart POS)</option>
                        <option value="staff_inventory">Staf Gudang (Smart Inventory)</option>
                        <option value="super_admin">Super Administrator Platform</option>
                    </select>
                </div>
                <div class="form-group" id="storeSelectGroup">
                    <label class="form-label">Asosiasi Gerai UMKM (Khusus Pengelola Toko)</label>
                    <select name="store_id" class="form-input">
                        <option value="">-- Tanpa Gerai (Konsumen / Super Admin) --</option>
                        @foreach($stores as $st)
                            <option value="{{ $st->id }}">{{ $st->name }} ({{ $st->category }})</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-admin-secondary" onclick="closeAddUserModal()">Batal</button>
                <button type="submit" class="btn-admin-primary">Buat Akun Sekarang</button>
            </div>
        </form>
    </div>
</div>

{{-- Modal Tambah Gerai UMKM Baru --}}
<div id="addStoreModal" class="modal-overlay">
    <div class="modal-card">
        <div class="modal-header">
            <h3 class="modal-title">Tambah Gerai UMKM Baru</h3>
            <button type="button" class="modal-close-btn" onclick="closeAddStoreModal()">
                <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
        <form action="{{ route('admin.stores.create') }}" method="POST">
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label class="form-label">Nama Gerai UMKM</label>
                    <input type="text" name="name" required class="form-input" placeholder="Contoh: Kedai Kopi Nusantara">
                </div>
                <div class="form-group">
                    <label class="form-label">Nama Pemilik / Juragan</label>
                    <input type="text" name="owner_name" required class="form-input" placeholder="Contoh: Mas Budi Santoso">
                </div>
                <div class="form-group">
                    <label class="form-label">Sektor / Kategori Usaha</label>
                    <select name="category" required class="form-input">
                        <option value="Kuliner & F&B">Kuliner &amp; F&amp;B</option>
                        <option value="Sembako & Kelontong">Sembako &amp; Kelontong</option>
                        <option value="Fashion & Pakaian">Fashion &amp; Pakaian</option>
                        <option value="Kerajinan & Kriya">Kerajinan &amp; Kriya</option>
                        <option value="Jasa & Layanan">Jasa &amp; Layanan</option>
                        <option value="Retail & Stationery">Retail &amp; Stationery</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Lokasi / Alamat Gerai</label>
                    <input type="text" name="location" required class="form-input" placeholder="Contoh: Jl. Braga No. 45, Coblong, Bandung">
                </div>
                <div class="form-group">
                    <label class="form-label">Nomor WhatsApp / Telepon</label>
                    <input type="text" name="phone" class="form-input" placeholder="Contoh: 0812-3456-7890">
                </div>
                <div class="form-group">
                    <label class="form-label">Ongkos Kirim Pengantaran Toko (Rp)</label>
                    <input type="number" name="delivery_fee" class="form-input" value="5000" min="0">
                </div>
                <div style="display: flex; gap: 16px; margin-top: 4px;">
                    <label style="display: flex; align-items: center; gap: 6px; font-size: 12px; color: #334155; font-weight: 600; cursor: pointer;">
                        <input type="checkbox" name="has_delivery" value="1" checked> Sediakan Pengantaran Toko
                    </label>
                    <label style="display: flex; align-items: center; gap: 6px; font-size: 12px; color: #334155; font-weight: 600; cursor: pointer;">
                        <input type="checkbox" name="is_verified" value="1" checked> Verifikasi Resmi Langsung
                    </label>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-admin-secondary" onclick="closeAddStoreModal()">Batal</button>
                <button type="submit" class="btn-admin-primary">Daftarkan Gerai</button>
            </div>
        </form>
    </div>
</div>

{{-- Modal Edit Gerai UMKM --}}
<div id="editStoreModal" class="modal-overlay">
    <div class="modal-card">
        <div class="modal-header">
            <h3 class="modal-title">Edit Data Gerai UMKM</h3>
            <button type="button" class="modal-close-btn" onclick="closeEditStoreModal()">
                <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
        <form id="editStoreForm" method="POST">
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label class="form-label">Nama Gerai UMKM</label>
                    <input type="text" id="editStoreName" name="name" required class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Nama Pemilik / Juragan</label>
                    <input type="text" id="editStoreOwner" name="owner_name" required class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Sektor / Kategori Usaha</label>
                    <select id="editStoreCategory" name="category" required class="form-input">
                        <option value="Kuliner & F&B">Kuliner &amp; F&amp;B</option>
                        <option value="Sembako & Kelontong">Sembako &amp; Kelontong</option>
                        <option value="Fashion & Pakaian">Fashion &amp; Pakaian</option>
                        <option value="Kerajinan & Kriya">Kerajinan &amp; Kriya</option>
                        <option value="Jasa & Layanan">Jasa &amp; Layanan</option>
                        <option value="Retail & Stationery">Retail &amp; Stationery</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Lokasi / Alamat Gerai</label>
                    <input type="text" id="editStoreLocation" name="location" required class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Nomor WhatsApp / Telepon</label>
                    <input type="text" id="editStorePhone" name="phone" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Ongkos Kirim Pengantaran Toko (Rp)</label>
                    <input type="number" id="editStoreDeliveryFee" name="delivery_fee" class="form-input" min="0">
                </div>
                <div style="display: flex; gap: 16px; margin-top: 4px;">
                    <label style="display: flex; align-items: center; gap: 6px; font-size: 12px; color: #334155; font-weight: 600; cursor: pointer;">
                        <input type="checkbox" id="editStoreHasDelivery" name="has_delivery" value="1"> Sediakan Pengantaran Toko
                    </label>
                    <label style="display: flex; align-items: center; gap: 6px; font-size: 12px; color: #334155; font-weight: 600; cursor: pointer;">
                        <input type="checkbox" id="editStoreIsVerified" name="is_verified" value="1"> Verifikasi Resmi
                    </label>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-admin-secondary" onclick="closeEditStoreModal()">Batal</button>
                <button type="submit" class="btn-admin-primary">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>

{{-- Modal Edit Pengguna --}}
<div id="editUserModal" class="modal-overlay">
    <div class="modal-card">
        <div class="modal-header">
            <h3 class="modal-title">Edit Data Pengguna</h3>
            <button type="button" class="modal-close-btn" onclick="closeEditUserModal()">
                <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
        <form id="editUserForm" method="POST">
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text" id="editUserName" name="name" required class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Alamat Email</label>
                    <input type="email" id="editUserEmail" name="email" required class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Kata Sandi Baru (Kosongkan bila tidak diubah)</label>
                    <input type="password" name="password" minlength="6" class="form-input" placeholder="Opsional (minimal 6 karakter)">
                </div>
                <div class="form-group">
                    <label class="form-label">Peran Sistem (Role)</label>
                    <select id="editUserRole" name="role" required class="form-input" onchange="toggleEditStoreField(this.value)">
                        <option value="user">User (Pembeli / Konsumen Gojek Style)</option>
                        <option value="owner">Juragan UMKM (Owner Store)</option>
                        <option value="staff_cashier">Kasir Toko (Terminal Smart POS)</option>
                        <option value="staff_inventory">Staf Gudang (Smart Inventory)</option>
                        <option value="super_admin">Super Administrator Platform</option>
                    </select>
                </div>
                <div class="form-group" id="editStoreSelectGroup">
                    <label class="form-label">Asosiasi Gerai UMKM</label>
                    <select id="editUserStoreId" name="store_id" class="form-input">
                        <option value="">-- Tanpa Gerai (Konsumen / Super Admin) --</option>
                        @foreach($stores as $st)
                            <option value="{{ $st->id }}">{{ $st->name }} ({{ $st->category }})</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-admin-secondary" onclick="closeEditUserModal()">Batal</button>
                <button type="submit" class="btn-admin-primary">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>

<style>
    .admin-dashboard-container {
        display: flex;
        flex-direction: column;
        gap: 24px;
    }

    .admin-header-card {
        background: linear-gradient(135deg, #0B131B 0%, #162434 100%);
        border-radius: 20px;
        padding: 30px 32px;
        color: #FFFFFF;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 20px;
        box-shadow: 0 10px 30px -5px rgba(11, 19, 27, 0.2);
    }

    .super-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: rgba(99, 102, 241, 0.2);
        color: #818CF8;
        border: 1px solid rgba(99, 102, 241, 0.35);
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        padding: 4px 10px;
        border-radius: 99px;
        margin-bottom: 12px;
    }

    .admin-title {
        font-size: 24px;
        font-weight: 800;
        letter-spacing: -0.02em;
        margin-bottom: 6px;
    }

    .admin-subtitle {
        color: #94A3B8;
        font-size: 13px;
        max-width: 650px;
        line-height: 1.5;
    }

    .header-actions {
        display: flex;
        gap: 12px;
        flex-shrink: 0;
    }

    .btn-admin-primary {
        background: linear-gradient(135deg, #10B981 0%, #059669 100%);
        color: #FFFFFF;
        font-weight: 700;
        font-size: 13px;
        padding: 10px 18px;
        border-radius: 10px;
        border: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        cursor: pointer;
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
        transition: all 0.2s;
    }
    .btn-admin-primary:hover {
        transform: translateY(-1px);
        box-shadow: 0 6px 16px rgba(16, 185, 129, 0.4);
    }

    .btn-admin-secondary {
        background: rgba(255, 255, 255, 0.08);
        border: 1px solid rgba(255, 255, 255, 0.15);
        color: #F1F5F9;
        font-weight: 600;
        font-size: 13px;
        padding: 10px 16px;
        border-radius: 10px;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        text-decoration: none;
        cursor: pointer;
        transition: all 0.2s;
    }
    .btn-admin-secondary:hover {
        background: rgba(255, 255, 255, 0.14);
        color: #FFFFFF;
    }

    .alert-box {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 14px 18px;
        border-radius: 12px;
        font-size: 13px;
        font-weight: 600;
    }
    .alert-box.success {
        background: #ECFDF5;
        border: 1px solid #A7F3D0;
        color: #065F46;
    }
    .alert-box.error {
        background: #FEF2F2;
        border: 1px solid #FECACA;
        color: #991B1B;
    }

    /* KPI GRID */
    .kpi-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 16px;
    }

    .kpi-card {
        background: #FFFFFF;
        border: 1px solid #E2E8F0;
        border-radius: 16px;
        padding: 20px;
        display: flex;
        gap: 16px;
        align-items: flex-start;
        box-shadow: 0 2px 8px rgba(15, 23, 42, 0.03);
        transition: transform 0.18s, box-shadow 0.18s;
    }
    .kpi-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(15, 23, 42, 0.06);
    }

    .kpi-icon-wrap {
        width: 44px;
        height: 44px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }
    .kpi-icon-wrap.mint { background: #ECFDF5; color: #10B981; }
    .kpi-icon-wrap.blue { background: #F0F9FF; color: #0284C7; }
    .kpi-icon-wrap.amber { background: #FFFBEB; color: #D97706; }
    .kpi-icon-wrap.indigo { background: #EEF2FF; color: #6366F1; }

    .kpi-label {
        font-size: 12px;
        font-weight: 600;
        color: #64748B;
        margin-bottom: 4px;
    }

    .kpi-value {
        font-size: 20px;
        font-weight: 800;
        color: #0F172A;
        letter-spacing: -0.02em;
    }
    .kpi-value .unit {
        font-size: 13px;
        font-weight: 600;
        color: #64748B;
    }

    .kpi-meta {
        font-size: 11px;
        color: #94A3B8;
        margin-top: 4px;
    }

    .kpi-trend.positive {
        color: #10B981;
        font-weight: 700;
    }

    /* SECTOR BADGES */
    .sector-badges-bar {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 10px;
        background: #FFFFFF;
        border: 1px solid #E2E8F0;
        border-radius: 12px;
        padding: 12px 18px;
    }

    .sector-bar-title {
        font-size: 12px;
        font-weight: 700;
        color: #475569;
    }

    .sector-pill {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: #F8FAFC;
        border: 1px solid #E2E8F0;
        padding: 4px 10px;
        border-radius: 99px;
        font-size: 12px;
    }
    .sector-name { font-weight: 600; color: #334155; }
    .sector-count { color: #64748B; font-weight: 500; }

    /* ADMIN TABS */
    .admin-tabs {
        display: flex;
        gap: 8px;
        border-bottom: 2px solid #E2E8F0;
        padding-bottom: 2px;
    }

    .tab-btn {
        background: transparent;
        border: none;
        padding: 10px 18px;
        font-size: 13px;
        font-weight: 700;
        color: #64748B;
        border-radius: 8px 8px 0 0;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        cursor: pointer;
        transition: all 0.18s;
        position: relative;
    }
    .tab-btn:hover {
        color: #0F172A;
        background: #F1F5F9;
    }
    .tab-btn.active {
        color: #10B981;
        background: #FFFFFF;
        box-shadow: 0 -2px 10px rgba(0,0,0,0.03);
    }
    .tab-btn.active::after {
        content: '';
        position: absolute;
        bottom: -2px;
        left: 0;
        right: 0;
        height: 2px;
        background: #10B981;
    }

    .tab-pane {
        display: none;
    }
    .tab-pane.active {
        display: block;
        animation: tabFadeIn 0.2s ease-out;
    }

    @keyframes tabFadeIn {
        from { opacity: 0; transform: translateY(6px); }
        to { opacity: 1; transform: translateY(0); }
    }

    /* SECTION CARD & TABLE */
    .section-card {
        background: #FFFFFF;
        border: 1px solid #E2E8F0;
        border-radius: 16px;
        padding: 24px;
        box-shadow: 0 2px 8px rgba(15, 23, 42, 0.02);
    }

    .section-card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        gap: 16px;
        flex-wrap: wrap;
    }

    .section-card-title {
        font-size: 16px;
        font-weight: 800;
        color: #0F172A;
        margin-bottom: 4px;
    }

    .section-card-desc {
        font-size: 12px;
        color: #64748B;
    }

    .filter-select {
        padding: 8px 14px;
        border-radius: 9px;
        border: 1px solid #CBD5E1;
        font-size: 12px;
        font-weight: 600;
        color: #334155;
        background: #FFFFFF;
        outline: none;
        cursor: pointer;
    }

    .admin-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 13px;
        text-align: left;
    }

    .admin-table th {
        background: #F8FAFC;
        color: #475569;
        font-weight: 700;
        padding: 12px 14px;
        border-bottom: 1px solid #E2E8F0;
        white-space: nowrap;
    }

    .admin-table td {
        padding: 14px;
        border-bottom: 1px solid #F1F5F9;
        vertical-align: middle;
    }

    .admin-table tbody tr:hover {
        background: #F8FAFC;
    }

    .store-cell {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .store-avatar {
        width: 36px;
        height: 36px;
        background: #F1F5F9;
        color: #475569;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .user-cell-avatar {
        width: 34px;
        height: 34px;
        background: linear-gradient(135deg, #6366F1, #818CF8);
        color: #FFFFFF;
        font-weight: 800;
        font-size: 13px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .cell-primary-text {
        font-weight: 700;
        color: #0F172A;
    }

    .cell-sub-text {
        font-size: 11px;
        color: #64748B;
    }

    .sector-tag {
        display: inline-block;
        background: #F1F5F9;
        color: #334155;
        font-weight: 600;
        font-size: 11px;
        padding: 3px 8px;
        border-radius: 6px;
    }

    .rating-cell {
        display: flex;
        align-items: center;
        gap: 4px;
    }

    .delivery-badge-yes {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        background: #ECFDF5;
        color: #065F46;
        font-size: 11px;
        font-weight: 700;
        padding: 4px 9px;
        border-radius: 99px;
        border: 1px solid #A7F3D0;
    }

    .delivery-badge-no {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        background: #FFFBEB;
        color: #92400E;
        font-size: 11px;
        font-weight: 700;
        padding: 4px 9px;
        border-radius: 99px;
        border: 1px solid #FDE68A;
    }

    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        font-size: 11px;
        font-weight: 700;
        padding: 3px 8px;
        border-radius: 99px;
    }
    .status-badge.verified {
        background: #ECFDF5;
        color: #059669;
    }
    .status-badge.unverified {
        background: #F1F5F9;
        color: #64748B;
    }
    .status-badge.success {
        background: #ECFDF5;
        color: #059669;
    }

    .action-btn-group {
        display: flex;
        gap: 6px;
        justify-content: flex-end;
    }

    .btn-action-outline {
        background: #FFFFFF;
        border: 1px solid #CBD5E1;
        padding: 6px 10px;
        border-radius: 7px;
        font-size: 11px;
        font-weight: 600;
        color: #334155;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 4px;
        transition: all 0.15s;
    }
    .btn-action-outline:hover {
        background: #F8FAFC;
        border-color: #94A3B8;
        color: #0F172A;
    }
    .btn-action-outline.text-mint { color: #059669; border-color: #A7F3D0; }
    .btn-action-outline.text-amber { color: #D97706; border-color: #FDE68A; }

    /* ROLE PILLS */
    .role-pill {
        display: inline-block;
        padding: 3px 9px;
        border-radius: 99px;
        font-size: 11px;
        font-weight: 700;
    }
    .role-superadmin { background: #EEF2FF; color: #4F46E5; }
    .role-owner { background: #ECFDF5; color: #059669; }
    .role-cashier { background: #F0F9FF; color: #0284C7; }
    .role-inventory { background: #FFFBEB; color: #D97706; }
    .role-user { background: #F3E8FF; color: #7E22CE; }

    .role-select {
        padding: 4px 8px;
        border-radius: 6px;
        border: 1px solid #CBD5E1;
        font-size: 11px;
        font-weight: 600;
        background: #FFFFFF;
    }

    .btn-action-mini {
        background: #10B981;
        color: #FFFFFF;
        border: none;
        border-radius: 6px;
        padding: 5px 8px;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    .order-code {
        font-family: monospace;
        font-weight: 700;
        color: #0284C7;
        font-size: 12px;
    }

    .pay-tag {
        display: inline-block;
        font-size: 11px;
        font-weight: 700;
        padding: 3px 8px;
        border-radius: 6px;
    }
    .pay-tag.qris { background: #F0FDF4; color: #16A34A; border: 1px solid #BBF7D0; }
    .pay-tag.cash { background: #F8FAFC; color: #475569; border: 1px solid #E2E8F0; }

    /* MODAL */
    .modal-overlay {
        display: none;
        position: fixed;
        top: 0; left: 0; right: 0; bottom: 0;
        background: rgba(15, 23, 42, 0.6);
        backdrop-filter: blur(4px);
        z-index: 1000;
        align-items: center;
        justify-content: center;
        padding: 16px;
    }
    .modal-overlay.active {
        display: flex;
    }

    .modal-card {
        background: #FFFFFF;
        border-radius: 18px;
        width: 100%;
        max-width: 480px;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        overflow: hidden;
        animation: modalScale 0.2s cubic-bezier(0.16, 1, 0.3, 1);
    }

    @keyframes modalScale {
        from { transform: scale(0.95); opacity: 0; }
        to { transform: scale(1); opacity: 1; }
    }

    .modal-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 18px 24px;
        border-bottom: 1px solid #F1F5F9;
    }

    .modal-title {
        font-size: 16px;
        font-weight: 800;
        color: #0F172A;
    }

    .modal-close-btn {
        background: transparent;
        border: none;
        color: #94A3B8;
        cursor: pointer;
        padding: 4px;
        border-radius: 6px;
    }
    .modal-close-btn:hover { color: #0F172A; }

    .modal-body {
        padding: 20px 24px;
        display: flex;
        flex-direction: column;
        gap: 14px;
    }

    .form-group {
        display: flex;
        flex-direction: column;
        gap: 6px;
    }

    .form-label {
        font-size: 12px;
        font-weight: 700;
        color: #334155;
    }

    .form-input {
        padding: 9px 12px;
        border-radius: 8px;
        border: 1px solid #CBD5E1;
        font-size: 13px;
        font-family: inherit;
        outline: none;
    }
    .form-input:focus {
        border-color: #10B981;
        box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.12);
    }

    .modal-footer {
        padding: 14px 24px 20px 24px;
        display: flex;
        justify-content: flex-end;
        gap: 10px;
        border-top: 1px solid #F1F5F9;
    }

    @media (max-width: 900px) {
        .kpi-grid { grid-template-columns: repeat(2, 1fr); }
        .admin-header-card { flex-direction: column; align-items: flex-start; }
    }
    @media (max-width: 600px) {
        .kpi-grid { grid-template-columns: 1fr; }
    }
</style>

<script>
    function switchAdminTab(tabId, btn) {
        document.querySelectorAll('.tab-pane').forEach(el => el.classList.remove('active'));
        document.querySelectorAll('.tab-btn').forEach(el => el.classList.remove('active'));
        const pane = document.getElementById(tabId);
        if (pane) pane.classList.add('active');
        if (btn) btn.classList.add('active');
        window.location.hash = tabId;
    }

    // Auto-detect hash tab on load or hash change
    function handleAdminHash() {
        const hash = window.location.hash ? window.location.hash.substring(1) : '';
        if (hash && document.getElementById(hash)) {
            const btn = document.querySelector(`.tab-btn[onclick*="${hash}"]`);
            switchAdminTab(hash, btn);
        }
    }
    window.addEventListener('DOMContentLoaded', handleAdminHash);
    window.addEventListener('hashchange', handleAdminHash);

    // Add User Modal
    function openAddUserModal() {
        document.getElementById('addUserModal').classList.add('active');
    }
    function closeAddUserModal() {
        document.getElementById('addUserModal').classList.remove('active');
    }
    function toggleStoreField(role) {
        const storeGroup = document.getElementById('storeSelectGroup');
        if (role === 'user' || role === 'super_admin') {
            storeGroup.style.display = 'none';
        } else {
            storeGroup.style.display = 'flex';
        }
    }

    // Add Store Modal
    function openAddStoreModal() {
        document.getElementById('addStoreModal').classList.add('active');
    }
    function closeAddStoreModal() {
        document.getElementById('addStoreModal').classList.remove('active');
    }

    // Edit Store Modal
    function openEditStoreModal(id, name, owner, category, location, phone, hasDelivery, fee, isVerified) {
        document.getElementById('editStoreForm').action = '/admin/stores/' + id + '/update';
        document.getElementById('editStoreName').value = name;
        document.getElementById('editStoreOwner').value = owner;
        document.getElementById('editStoreCategory').value = category;
        document.getElementById('editStoreLocation').value = location;
        document.getElementById('editStorePhone').value = phone || '';
        document.getElementById('editStoreDeliveryFee').value = fee || 0;
        document.getElementById('editStoreHasDelivery').checked = Boolean(hasDelivery);
        document.getElementById('editStoreIsVerified').checked = Boolean(isVerified);
        document.getElementById('editStoreModal').classList.add('active');
    }
    function closeEditStoreModal() {
        document.getElementById('editStoreModal').classList.remove('active');
    }

    // Edit User Modal
    function openEditUserModal(id, name, email, role, storeId) {
        document.getElementById('editUserForm').action = '/admin/users/' + id + '/update';
        document.getElementById('editUserName').value = name;
        document.getElementById('editUserEmail').value = email;
        document.getElementById('editUserRole').value = role;
        document.getElementById('editUserStoreId').value = storeId || '';
        toggleEditStoreField(role);
        document.getElementById('editUserModal').classList.add('active');
    }
    function closeEditUserModal() {
        document.getElementById('editUserModal').classList.remove('active');
    }
    function toggleEditStoreField(role) {
        const storeGroup = document.getElementById('editStoreSelectGroup');
        if (role === 'user' || role === 'super_admin') {
            storeGroup.style.display = 'none';
        } else {
            storeGroup.style.display = 'flex';
        }
    }
</script>
@endsection
