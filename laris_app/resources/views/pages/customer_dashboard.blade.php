@extends('layouts.app', ['title' => 'Portal Konsumen & Warga - Toko Berkah Utama'])

@section('content')
<div class="customer-dashboard-page" style="display: flex; flex-direction: column; gap: 24px;">

    <!-- TOP WELCOME BANNER -->
    <div class="card-panel cust-hero-banner" style="background: linear-gradient(135deg, #0F172A 0%, #1E293B 100%); color: #FFFFFF; border-radius: 16px; padding: 24px 28px; position: relative; overflow: hidden; border: 1px solid #334155;">
        <div style="position: relative; z-index: 2; max-width: 680px;">
            <div style="display: inline-flex; align-items: center; gap: 8px; background: rgba(16, 185, 129, 0.2); color: #34D399; font-size: 11px; font-weight: 700; padding: 4px 12px; border-radius: 20px; margin-bottom: 12px; border: 1px solid rgba(16, 185, 129, 0.3);">
                <span style="width: 7px; height: 7px; border-radius: 50%; background: #34D399; display: inline-block;"></span>
                <span>PORTAL WARGA &amp; KONSUMEN • DUKUNG UMKM TETANGGA</span>
            </div>
            <h1 style="font-size: 26px; font-weight: 800; color: #FFFFFF; margin-bottom: 8px; line-height: 1.3;">
                Selamat Datang, {{ auth()->user()->name ?? 'Ibu Siti' }}!
            </h1>
            <p style="font-size: 13.5px; color: #CBD5E1; line-height: 1.6; margin-bottom: 16px;">
                Cek stok kebutuhan harian secara langsung, klaim diskon <strong>Flash Sale Cuci Gudang Jam 7 Malam</strong>, atau titipkan pesanan barang langka saat Juragan belanja stok besok pagi.
            </p>
            <div style="display: flex; flex-wrap: wrap; gap: 10px;">
                <a href="#flash-sale-section" class="btn-primary-soft" style="background: #10B981; color: #FFFFFF; text-decoration: none; padding: 10px 18px; border-radius: 10px; font-size: 13px; font-weight: 700; display: inline-flex; align-items: center; gap: 6px;">
                    <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.362 5.214A8.252 8.252 0 0 1 12 21 8.25 8.25 0 0 1 6.038 7.047 8.287 8.287 0 0 0 9 9.601a8.983 8.983 0 0 1 3.361-6.867 8.21 8.21 0 0 0 3 2.48Z"/></svg>
                    <span>Lihat Flash Sale Cuci Gudang</span>
                </a>
                <button type="button" onclick="openPreOrderModal('')" style="background: rgba(255, 255, 255, 0.1); color: #FFFFFF; border: 1px solid rgba(255, 255, 255, 0.2); padding: 10px 18px; border-radius: 10px; font-size: 13px; font-weight: 600; cursor: pointer; display: inline-flex; align-items: center; gap: 6px;">
                    <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.5v15m7.5-7.5h-15"/></svg>
                    <span>Titip Belanja Stok</span>
                </button>
            </div>
        </div>
    </div>

    <!-- 3 STATS PILLARS -->
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 16px;">
        <div class="card-panel" style="padding: 18px; border-radius: 14px; background: #FFFFFF; border: 1px solid #E2E8F0;">
            <div style="font-size: 11px; font-weight: 700; color: #64748B; text-transform: uppercase;">Toko Fisik Mitra</div>
            <h3 style="font-size: 18px; font-weight: 800; color: #0F172A; margin: 4px 0;">{{ $store->name ?? 'Toko Berkah Utama' }}</h3>
            <span style="font-size: 12px; color: #10B981; font-weight: 600; display: inline-flex; align-items: center; gap: 4px;">
                <span style="width: 6px; height: 6px; border-radius: 50%; background: #10B981;"></span>
                Radius 400m • Buka s.d 22:00 WIB
            </span>
        </div>
        <div class="card-panel" style="padding: 18px; border-radius: 14px; background: #FFFFFF; border: 1px solid #E2E8F0;">
            <div style="font-size: 11px; font-weight: 700; color: #64748B; text-transform: uppercase;">Kupon Warga Aktif</div>
            <h3 style="font-size: 18px; font-weight: 800; color: #0F172A; margin: 4px 0;">{{ count($coupons) }} Voucher Tersedia</h3>
            <span style="font-size: 12px; color: #D97706; font-weight: 600;">Hemat hingga Rp 15.000 hari ini</span>
        </div>
        <div class="card-panel" style="padding: 18px; border-radius: 14px; background: #FFFFFF; border: 1px solid #E2E8F0;">
            <div style="font-size: 11px; font-weight: 700; color: #64748B; text-transform: uppercase;">Titip Belanja Saya</div>
            <h3 style="font-size: 18px; font-weight: 800; color: #0F172A; margin: 4px 0;">{{ count($preOrders) }} Pesanan Diproses</h3>
            <span style="font-size: 12px; color: #2563EB; font-weight: 600;">Jadwal ambil: Besok 06:30 WIB</span>
        </div>
    </div>

    <!-- FLASH SALE CUCI GUDANG JAM 7 MALAM -->
    <div id="flash-sale-section" class="card-panel" style="border-radius: 16px; padding: 22px; background: #FFFFFF; border: 1px solid #E2E8F0;">
        <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 14px; margin-bottom: 20px; border-bottom: 1px solid #F1F5F9; padding-bottom: 16px;">
            <div style="display: flex; align-items: center; gap: 12px;">
                <div style="width: 40px; height: 40px; border-radius: 10px; background: #FEF2F2; color: #DC2626; display: flex; align-items: center; justify-content: center;">
                    <svg width="22" height="22" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.362 5.214A8.252 8.252 0 0 1 12 21 8.25 8.25 0 0 1 6.038 7.047 8.287 8.287 0 0 0 9 9.601a8.983 8.983 0 0 1 3.361-6.867 8.21 8.21 0 0 0 3 2.48Z"/></svg>
                </div>
                <div>
                    <h2 style="font-size: 18px; font-weight: 800; color: #0F172A; margin: 0;">Flash Sale Cuci Gudang Jam 7 Malam</h2>
                    <p style="font-size: 13px; color: #64748B; margin: 2px 0 0 0;">Diskon spesial 30%–50% produk roti &amp; segar sebelum toko tutup agar tidak mubazir.</p>
                </div>
            </div>
            <div style="background: #FEF3C7; border: 1px solid #FCD34D; color: #92400E; padding: 6px 14px; border-radius: 20px; font-size: 12px; font-weight: 700; display: inline-flex; align-items: center; gap: 6px;">
                <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/></svg>
                <span>BERAKHIR DALAM: 01:14:20</span>
            </div>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(260px, 1fr)); gap: 18px;">
            @foreach($flashSaleItems as $fs)
                <div style="border: 1px solid #E2E8F0; border-radius: 12px; overflow: hidden; background: #FAFAFA; display: flex; flex-direction: column; justify-content: space-between; transition: transform 0.2s, box-shadow 0.2s;" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 20px rgba(0,0,0,0.06)'" onmouseout="this.style.transform='none'; this.style.boxShadow='none'">
                    <div style="position: relative;">
                        <img src="{{ $fs['image'] }}" alt="{{ $fs['name'] }}" style="width: 100%; height: 140px; object-fit: cover;">
                        <span style="position: absolute; top: 10px; right: 10px; background: #DC2626; color: #FFFFFF; font-size: 11px; font-weight: 800; padding: 3px 8px; border-radius: 6px;">
                            -{{ $fs['discount_pct'] }}%
                        </span>
                    </div>
                    <div style="padding: 14px; flex-grow: 1;">
                        <span style="font-size: 11px; color: #64748B; font-weight: 600;">{{ $fs['category'] }}</span>
                        <h4 style="font-size: 14px; font-weight: 700; color: #0F172A; margin: 4px 0 8px 0;">{{ $fs['name'] }}</h4>
                        <div style="display: flex; align-items: baseline; gap: 8px;">
                            <span style="font-size: 16px; font-weight: 800; color: #10B981;">Rp {{ number_format($fs['discount_price'], 0, ',', '.') }}</span>
                            <span style="font-size: 12px; color: #94A3B8; text-decoration: line-through;">Rp {{ number_format($fs['original_price'], 0, ',', '.') }}</span>
                        </div>
                        <div style="margin-top: 8px; font-size: 11px; color: #D97706; background: #FEF3C7; padding: 4px 8px; border-radius: 6px; display: inline-flex; align-items: center; gap: 4px;">
                            <svg width="12" height="12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18v-5.25m0 0a6.01 6.01 0 0 0 1.5-.189m-1.5.189a6.01 6.01 0 0 1-1.5-.189m3.75 7.478a12.06 12.06 0 0 1-4.5 0m3.75 2.383a14.406 14.406 0 0 1-3 0M14.25 18v-.192c0-.983.658-1.823 1.508-2.316a7.5 7.5 0 1 0-7.516 0c.85.493 1.508 1.333 1.508 2.316V18"/></svg>
                            <span>{{ $fs['reason'] }}</span>
                        </div>
                        <div style="font-size: 11px; color: #DC2626; font-weight: 700; margin-top: 6px;">
                            Sisa {{ $fs['stock_left'] }} {{ $fs['unit'] }} di rak
                        </div>
                    </div>
                    <div style="padding: 12px 14px; background: #FFFFFF; border-top: 1px solid #E2E8F0;">
                        <button type="button" onclick="openQrisModal('{{ addslashes($fs['name']) }}', {{ $fs['discount_price'] }})" style="width: 100%; background: #0F172A; color: #FFFFFF; border: none; padding: 8px; border-radius: 8px; font-size: 12px; font-weight: 700; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 6px;">
                            <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16.5 6v.75m0 3v.75m0 3v.75m0 3V18m-9-5.25h5.25M7.5 15h3M3.375 5.25c-.621 0-1.125.504-1.125 1.125v3.026a2.999 2.999 0 0 1 0 5.198v3.026c0 .621.504 1.125 1.125 1.125h17.25c.621 0 1.125-.504 1.125-1.125v-3.026a2.999 2.999 0 0 1 0-5.198V6.375c0-.621-.504-1.125-1.125-1.125H3.375Z"/></svg>
                            <span>Klaim &amp; Bayar QRIS</span>
                        </button>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- KATALOG REAL-TIME & TITIP BELANJA STOK -->
    <div class="card-panel" style="border-radius: 16px; padding: 22px; background: #FFFFFF; border: 1px solid #E2E8F0;">
        <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 14px; margin-bottom: 20px;">
            <div>
                <h2 style="font-size: 18px; font-weight: 800; color: #0F172A; margin: 0;">Katalog Kebutuhan Harian &amp; Sembako</h2>
                <p style="font-size: 13px; color: #64748B; margin: 2px 0 0 0;">Informasi stok real-time langsung dari sistem kasir Toko Berkah Utama.</p>
            </div>
            <form action="{{ route('customer.dashboard') }}" method="GET" style="display: flex; gap: 8px;">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari beras, minyak, kopi..." style="background: #F8FAFC; border: 1px solid #CBD5E1; padding: 8px 14px; border-radius: 8px; font-size: 13px; outline: none; width: 220px;">
                <button type="submit" style="background: #0F172A; color: #FFFFFF; border: none; padding: 8px 14px; border-radius: 8px; font-size: 13px; font-weight: 700; cursor: pointer;">Cari</button>
            </form>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(220px, 1fr)); gap: 16px;">
            @foreach($products as $p)
                @php $isOut = $p->current_stock <= 0; @endphp
                <div style="border: 1px solid #E2E8F0; border-radius: 12px; padding: 14px; background: #FFFFFF; display: flex; flex-direction: column; justify-content: space-between;">
                    <div>
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 6px;">
                            <span style="font-size: 11px; color: #64748B;">{{ $p->category }}</span>
                            @if($isOut)
                                <span style="font-size: 10px; font-weight: 700; background: #FEE2E2; color: #DC2626; padding: 2px 6px; border-radius: 4px;">Habis</span>
                            @else
                                <span style="font-size: 10px; font-weight: 700; background: #DCFCE7; color: #16A34A; padding: 2px 6px; border-radius: 4px;">Ready: {{ $p->current_stock }} unit</span>
                            @endif
                        </div>
                        <h4 style="font-size: 14px; font-weight: 700; color: #0F172A; margin: 0 0 6px 0;">{{ $p->name }}</h4>
                        <div style="font-size: 16px; font-weight: 800; color: #0F172A;">Rp {{ number_format($p->selling_price, 0, ',', '.') }}</div>
                    </div>
                    <div style="margin-top: 12px;">
                        @if(!$isOut)
                            <button type="button" onclick="openQrisModal('{{ addslashes($p->name) }}', {{ $p->selling_price }})" style="width: 100%; background: #10B981; color: #FFFFFF; border: none; padding: 8px; border-radius: 8px; font-size: 12px; font-weight: 700; cursor: pointer;">
                                Beli &amp; Scan QRIS
                            </button>
                        @else
                            <button type="button" onclick="openPreOrderModal('{{ addslashes($p->name) }}')" style="width: 100%; background: #D97706; color: #FFFFFF; border: none; padding: 8px; border-radius: 8px; font-size: 12px; font-weight: 700; cursor: pointer;">
                                + Titip Belanja ke Juragan
                            </button>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- ANTREAN TITIP BELANJA STOK (PRE-ORDER) SAYA -->
    <div class="card-panel" style="border-radius: 16px; padding: 22px; background: #FFFFFF; border: 1px solid #E2E8F0;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px;">
            <div style="display: flex; align-items: center; gap: 8px;">
                <svg width="20" height="20" fill="none" stroke="#2563EB" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25ZM6.75 12h.008v.008H6.75V12Zm0 3h.008v.008H6.75V15Zm0 3h.008v.008H6.75V18Z"/></svg>
                <h3 style="font-size: 16px; font-weight: 800; color: #0F172A; margin: 0;">Status Titip Belanja Warga Terkini</h3>
            </div>
            <span style="font-size: 11px; background: #DCFCE7; color: #166534; padding: 4px 10px; border-radius: 20px; font-weight: 700;">Terhubung ke Aplikasi Juragan</span>
        </div>
        <div style="display: flex; flex-direction: column; gap: 10px;">
            @foreach($preOrders as $po)
                <div style="display: flex; justify-content: space-between; align-items: center; padding: 12px 16px; background: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 10px; flex-wrap: wrap; gap: 8px;">
                    <div>
                        <strong style="font-size: 13.5px; color: #0F172A;">{{ $po['item_name'] }} ({{ $po['quantity'] }} unit)</strong>
                        <div style="font-size: 11px; color: #64748B;">Pemesan: {{ $po['customer_name'] }} • {{ $po['time'] }}</div>
                    </div>
                    <span style="font-size: 11px; font-weight: 700; background: #DBEAFE; color: #1E40AF; padding: 4px 10px; border-radius: 6px;">{{ $po['status'] }}</span>
                </div>
            @endforeach
        </div>
    </div>

</div>

<!-- MODAL FORM TITIP BELANJA STOK -->
<div id="modal-preorder" style="position: fixed; inset: 0; background: rgba(15, 23, 42, 0.7); backdrop-filter: blur(4px); display: none; align-items: center; justify-content: center; z-index: 9999; padding: 16px;">
    <div style="background: #FFFFFF; border-radius: 16px; max-width: 480px; width: 100%; box-shadow: 0 20px 40px rgba(0,0,0,0.2); overflow: hidden;">
        <div style="display: flex; justify-content: space-between; align-items: center; padding: 18px 24px; border-bottom: 1px solid #E2E8F0; background: #F8FAFC;">
            <h3 style="font-size: 16px; font-weight: 800; color: #0F172A; margin: 0;">Titip Belanja Stok ke Juragan Toko</h3>
            <button type="button" onclick="closePreOrderModal()" style="background: none; border: none; font-size: 20px; cursor: pointer; color: #64748B;">&times;</button>
        </div>
        <form action="{{ route('consumer.pre_order') }}" method="POST" style="padding: 20px;">
            @csrf
            <p style="font-size: 12px; color: #64748B; margin-bottom: 16px; line-height: 1.5;">
                Barang yang dititipkan akan otomatis dibelanjakan Juragan Toko Berkah Utama saat belanja stok ke pasar induk &amp; distributor besok pagi pukul 06.00 WIB tanpa ongkir tambahan!
            </p>
            <div style="margin-bottom: 12px;">
                <label style="font-size: 12px; font-weight: 700; color: #334155; display: block; margin-bottom: 4px;">Nama Anda</label>
                <input type="text" name="customer_name" value="{{ auth()->user()->name ?? 'Ibu Siti' }}" required style="width: 100%; padding: 8px 12px; border: 1px solid #CBD5E1; border-radius: 8px; font-size: 13px;">
            </div>
            <div style="margin-bottom: 12px;">
                <label style="font-size: 12px; font-weight: 700; color: #334155; display: block; margin-bottom: 4px;">Nomor WhatsApp</label>
                <input type="text" name="phone" value="081234567890" required style="width: 100%; padding: 8px 12px; border: 1px solid #CBD5E1; border-radius: 8px; font-size: 13px;">
            </div>
            <div style="margin-bottom: 12px;">
                <label style="font-size: 12px; font-weight: 700; color: #334155; display: block; margin-bottom: 4px;">Nama Barang yang Dicari</label>
                <input type="text" name="item_name" id="preorder-item-name" placeholder="Misal: Minyak Bimoli 2L / Beras Ramos 5kg" required style="width: 100%; padding: 8px 12px; border: 1px solid #CBD5E1; border-radius: 8px; font-size: 13px;">
            </div>
            <div style="margin-bottom: 16px;">
                <label style="font-size: 12px; font-weight: 700; color: #334155; display: block; margin-bottom: 4px;">Jumlah (Unit / Pcs)</label>
                <input type="number" name="quantity" value="1" min="1" max="20" required style="width: 100%; padding: 8px 12px; border: 1px solid #CBD5E1; border-radius: 8px; font-size: 13px;">
            </div>
            <div style="display: flex; justify-content: flex-end; gap: 8px;">
                <button type="button" onclick="closePreOrderModal()" style="background: #F1F5F9; border: 1px solid #CBD5E1; padding: 8px 16px; border-radius: 8px; font-size: 13px; font-weight: 600; cursor: pointer;">Batal</button>
                <button type="submit" style="background: #10B981; color: #FFFFFF; border: none; padding: 8px 18px; border-radius: 8px; font-size: 13px; font-weight: 700; cursor: pointer;">Kirim Pesanan ke Juragan</button>
            </div>
        </form>
    </div>
</div>

<!-- MODAL SIMULASI QRIS -->
<div id="modal-qris" style="position: fixed; inset: 0; background: rgba(15, 23, 42, 0.7); backdrop-filter: blur(4px); display: none; align-items: center; justify-content: center; z-index: 9999; padding: 16px;">
    <div style="background: #FFFFFF; border-radius: 16px; max-width: 400px; width: 100%; box-shadow: 0 20px 40px rgba(0,0,0,0.2); overflow: hidden; text-align: center; padding: 24px;">
        <h3 style="font-size: 16px; font-weight: 800; color: #0F172A; margin: 0 0 6px 0;">Pembayaran QRIS Nasional</h3>
        <p style="font-size: 12px; color: #64748B; margin-bottom: 16px;">{{ $store->name ?? 'Toko Berkah Utama' }} • NMID ID1029384756</p>
        
        <div style="background: #F8FAFC; border: 2px dashed #CBD5E1; border-radius: 12px; padding: 16px; display: inline-block; margin-bottom: 16px;">
            <svg width="150" height="150" viewBox="0 0 100 100" fill="#0F172A">
                <rect x="5" y="5" width="25" height="25" fill="#0F172A"/>
                <rect x="10" y="10" width="15" height="15" fill="#FFFFFF"/>
                <rect x="13" y="13" width="9" height="9" fill="#0F172A"/>
                <rect x="70" y="5" width="25" height="25" fill="#0F172A"/>
                <rect x="75" y="10" width="15" height="15" fill="#FFFFFF"/>
                <rect x="78" y="13" width="9" height="9" fill="#0F172A"/>
                <rect x="5" y="70" width="25" height="25" fill="#0F172A"/>
                <rect x="10" y="75" width="15" height="15" fill="#FFFFFF"/>
                <rect x="13" y="78" width="9" height="9" fill="#0F172A"/>
                <rect x="35" y="10" width="10" height="10"/>
                <rect x="50" y="15" width="12" height="6"/>
                <rect x="35" y="35" width="30" height="30"/>
                <rect x="42" y="42" width="16" height="16" fill="#FFFFFF"/>
                <rect x="45" y="45" width="10" height="10" fill="#10B981"/>
                <rect x="70" y="35" width="8" height="18"/>
                <rect x="80" y="45" width="15" height="10"/>
                <rect x="35" y="75" width="15" height="15"/>
                <rect x="55" y="70" width="20" height="8"/>
                <rect x="80" y="75" width="15" height="15"/>
            </svg>
            <div style="font-size: 11px; font-weight: 700; color: #16A34A; margin-top: 6px;">BCA • GoPay • OVO • Dana • ShopeePay</div>
        </div>

        <div style="background: #F1F5F9; border-radius: 10px; padding: 10px 14px; margin-bottom: 16px; text-align: left;">
            <div style="display: flex; justify-content: space-between; font-size: 12px; color: #64748B;">
                <span>Item:</span>
                <strong id="qris-item-label" style="color: #0F172A;">-</strong>
            </div>
            <div style="display: flex; justify-content: space-between; font-size: 14px; margin-top: 4px;">
                <span style="color: #64748B;">Total Tagihan:</span>
                <strong id="qris-price-label" style="color: #10B981; font-size: 16px;">Rp 0</strong>
            </div>
        </div>

        <div style="display: flex; gap: 8px;">
            <button type="button" onclick="closeQrisModal()" style="flex: 1; background: #F1F5F9; border: 1px solid #CBD5E1; padding: 10px; border-radius: 8px; font-size: 13px; font-weight: 600; cursor: pointer;">Tutup</button>
            <button type="button" onclick="simulateQrisSuccess()" style="flex: 1; background: #10B981; color: #FFFFFF; border: none; padding: 10px; border-radius: 8px; font-size: 13px; font-weight: 700; cursor: pointer;">Konfirmasi Bayar</button>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function openPreOrderModal(name) {
        document.getElementById('preorder-item-name').value = name || '';
        document.getElementById('modal-preorder').style.display = 'flex';
    }
    function closePreOrderModal() {
        document.getElementById('modal-preorder').style.display = 'none';
    }
    function openQrisModal(name, price) {
        document.getElementById('qris-item-label').innerText = name;
        document.getElementById('qris-price-label').innerText = 'Rp ' + Number(price).toLocaleString('id-ID');
        document.getElementById('modal-qris').style.display = 'flex';
    }
    function closeQrisModal() {
        document.getElementById('modal-qris').style.display = 'none';
    }
    function simulateQrisSuccess() {
        closeQrisModal();
        larisAlert('Pembayaran QRIS Berhasil!', 'Struk transaksi telah otomatis dicatat ke sistem toko.', 'success');
    }
</script>
@endpush
@endsection
