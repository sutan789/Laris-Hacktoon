@extends('layouts.app', ['title' => 'Pusat Bantuan & Dokumentasi - LARIS BI'])

@section('content')
<div class="help-container">

    <!-- 1. GLOSSY HEADER BAR -->
    <div class="dash-header">
        <div class="header-main-info">
            <div class="greeting-row">
                <h1 class="page-greeting">Pusat <span class="store-gradient-name">Bantuan &amp; Panduan</span></h1>
                <span class="verified-store-badge">
                    <svg width="14" height="14" viewBox="0 0 20 20" fill="#10B981"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd" /></svg>
                    <span>Dokumentasi Resmi</span>
                </span>
                <span class="live-status-pill">
                    <span class="pulse-dot"></span>
                    <span>Dukungan 24/7</span>
                </span>
            </div>
            <p class="page-subtitle">Pelajari cara kerja simulasi margin, radar tren pasar, pengadaan grosir bersama, dan asisten cerdas Juragan AI.</p>
        </div>

        <div class="dash-actions">
            <a href="https://wa.me/6281234567890?text=Halo%20Tim%20LARIS,%20saya%20ingin%20konsultasi%20fitur" target="_blank" class="btn-download-glossy" style="background: #10B981; text-decoration: none; box-shadow: 0 4px 14px rgba(16, 185, 129, 0.3);">
                <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.625 12a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H8.25m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H12m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0h-.375M21 12c0 4.556-4.03 8.25-9 8.25a9.764 9.764 0 0 1-2.555-.337A5.972 5.972 0 0 1 5.41 20.97a.75.75 0 0 1-.974-.944 6.345 6.345 0 0 0 .806-2.91C3.844 15.68 3 13.93 3 12c0-4.556 4.03-8.25 9-8.25s9 3.694 9 8.25Z"/></svg>
                <span>Hubungi WhatsApp Tim Ahli</span>
            </a>
        </div>
    </div>

    <!-- 2. SEARCH BOX HERO (GLOSSY & MEWAH) -->
    <div class="card-panel search-hero-panel">
        <div class="search-hero-content">
            <h2 class="search-hero-title">Ada yang bisa kami bantu jelaskan hari ini?</h2>
            <p class="search-hero-sub">Ketik pertanyaan atau kata kunci untuk mencari solusi instan seputar operasional toko</p>
            
            <div class="search-input-glossy-wrap">
                <svg width="18" height="18" fill="none" stroke="#64748B" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z"/></svg>
                <input type="text" id="faq-search" placeholder="Cari pertanyaan... (misal: simulasi, restock, ongkir, pengadaan grosir, AI)">
            </div>
        </div>
    </div>

    <!-- 3. 4 FEATURE GUIDE PILLARS -->
    <div class="kpi-grid">
        <div class="kpi-card card-glossy">
            <div class="panel-icon-circle" style="background: rgba(16, 185, 129, 0.12); color: #10B981; margin-bottom: 12px;">
                <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v12m6-6H6m15 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/></svg>
            </div>
            <h3 class="pillar-card-title">LARIS Predict</h3>
            <p class="pillar-card-desc">Simulasi "What If I Sell This?" untuk menguji margin dan peluang sukses sebelum belanja modal barang.</p>
            <a href="{{ route('predict.index') }}" class="link-view-all mt-10">Buka Panduan &rarr;</a>
        </div>

        <div class="kpi-card card-glossy">
            <div class="panel-icon-circle" style="background: rgba(2, 132, 199, 0.12); color: #0284C7; margin-bottom: 12px;">
                <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.25 18 9 11.25l4.306 4.306a11.95 11.95 0 0 1 5.814-5.518l2.74-1.22m0 0-5.94-2.281m5.94 2.28-2.28 5.941"/></svg>
            </div>
            <h3 class="pillar-card-title">Trend Hunter</h3>
            <p class="pillar-card-desc">Radar deteksi dini produk viral marketplace dan media sosial di sekitar gerai Anda.</p>
            <a href="{{ route('trends.index') }}" class="link-view-all mt-10">Buka Panduan &rarr;</a>
        </div>

        <div class="kpi-card card-glossy">
            <div class="panel-icon-circle" style="background: rgba(217, 119, 6, 0.12); color: #D97706; margin-bottom: 12px;">
                <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z"/></svg>
            </div>
            <h3 class="pillar-card-title">Smart Inventory</h3>
            <p class="pillar-card-desc">Monitoring stok otomatis, peringatan kehabisan barang, dan pengadaan grosir bersama diskon distributor.</p>
            <a href="{{ route('inventory.index') }}" class="link-view-all mt-10">Buka Panduan &rarr;</a>
        </div>

        <div class="kpi-card card-glossy">
            <div class="panel-icon-circle" style="background: rgba(204, 255, 0, 0.15); color: #15803D; margin-bottom: 12px;">
                <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.813 15.904 9 18.75l-.813-2.846a4.5 4.5 0 0 0-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 0 0 3.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 0 0 3.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 0 0-3.09 3.09Z"/></svg>
            </div>
            <h3 class="pillar-card-title">Juragan AI Copilot</h3>
            <p class="pillar-card-desc">Asisten bisnis pintar berbasis data riil toko Anda untuk tanya jawab strategi dan kenaikan omzet.</p>
            <a href="{{ route('juragan.index') }}" class="link-view-all mt-10">Buka Panduan &rarr;</a>
        </div>
    </div>

    <!-- 4. FAQ ACCORDION -->
    <div class="card-panel">
        <div class="panel-header">
            <div>
                <h3 class="panel-title">Pertanyaan yang Sering Diajukan (FAQ)</h3>
                <p class="panel-subtitle">Jawaban seputar akurasi sistem, keamanan data, dan tata kelola akun gerai</p>
            </div>
            <span class="tag-pill-glossy">TANYA JAWAB</span>
        </div>

        <div class="faq-list">
            @foreach($faqs as $idx => $faq)
                <div class="faq-item-glossy" data-question="{{ strtolower($faq['question'] . ' ' . $faq['answer']) }}">
                    <button type="button" class="faq-toggle-glossy" onclick="toggleFaq({{ $idx }})">
                        <span class="faq-q-text">{{ $faq['question'] }}</span>
                        <div class="flex-align gap-8">
                            <span class="badge-slate" style="font-size: 10px;">{{ $faq['category'] }}</span>
                            <span class="faq-arrow-icon" id="arrow-{{ $idx }}">&darr;</span>
                        </div>
                    </button>
                    <div class="faq-answer-glossy" id="answer-{{ $idx }}">
                        <p>{{ $faq['answer'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- 5. SUPPORT STRIP -->
    <div class="instant-insight-banner">
        <div class="insight-left">
            <div class="ai-gem-icon">
                <svg width="22" height="22" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z"/></svg>
            </div>
            <div class="insight-text">
                <div class="insight-tag">KONSULTASI KUSTOM &amp; BANTUAN TEKNIS</div>
                <p>Butuh bantuan menghubungkan kasir POS fisik atau ingin mendaftarkan komunitas gerai pengadaan grosir bersama? Tim ahli LARIS siap membantu mendampingi gerai Anda secara langsung.</p>
            </div>
        </div>
        <a href="mailto:support@laris.id" class="btn-timeframe-glossy" style="text-decoration: none;">
            <span>Kirim Email Support</span>
        </a>
    </div>

</div>
@endsection

@push('styles')
<style>
    .help-container {
        display: flex;
        flex-direction: column;
        gap: 22px;
    }

    .search-hero-panel {
        background: linear-gradient(135deg, rgba(16, 185, 129, 0.08) 0%, rgba(204, 255, 0, 0.05) 50%, rgba(255, 255, 255, 0.95) 100%);
        border: 1px solid rgba(16, 185, 129, 0.25);
        text-align: center;
        padding: 32px 24px;
    }

    .search-hero-title {
        font-size: 22px;
        font-weight: 800;
        color: #0F172A;
        margin-bottom: 4px;
    }

    .search-hero-sub {
        font-size: 13px;
        color: #64748B;
        max-width: 580px;
        margin: 0 auto 20px auto;
    }

    .search-input-glossy-wrap {
        display: flex;
        align-items: center;
        gap: 12px;
        background: #FFFFFF;
        border: 1px solid #E2E8F0;
        border-radius: 9999px;
        padding: 10px 20px;
        max-width: 500px;
        margin: 0 auto;
        box-shadow: 0 4px 14px rgba(0, 0, 0, 0.04);
        transition: all 0.2s;
    }

    .search-input-glossy-wrap:focus-within {
        border-color: #10B981;
        box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.15);
    }

    .search-input-glossy-wrap input {
        border: none;
        outline: none;
        width: 100%;
        font-size: 13.5px;
        color: var(--text-main);
    }

    .pillar-card-title {
        font-size: 15px;
        font-weight: 800;
        color: var(--text-main);
        margin-bottom: 4px;
    }

    .pillar-card-desc {
        font-size: 12px;
        color: var(--text-muted);
        line-height: 1.45;
        margin: 0;
    }

    /* FAQ List */
    .faq-list {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .faq-item-glossy {
        border: 1px solid #E2E8F0;
        border-radius: 14px;
        overflow: hidden;
        background: #FFFFFF;
        transition: all 0.2s;
    }

    .faq-toggle-glossy {
        width: 100%;
        background: #FFFFFF;
        border: none;
        padding: 14px 18px;
        text-align: left;
        display: flex;
        justify-content: space-between;
        align-items: center;
        cursor: pointer;
        font-size: 13.5px;
        font-weight: 700;
        color: var(--text-main);
        transition: background 0.15s;
    }

    .faq-toggle-glossy:hover {
        background: #F8FAFC;
    }

    .faq-arrow-icon {
        font-size: 14px;
        color: #64748B;
        transition: transform 0.2s;
    }

    .faq-answer-glossy {
        display: none;
        padding: 0 18px 16px 18px;
        font-size: 13px;
        color: #475569;
        line-height: 1.55;
        border-top: 1px solid #F1F5F9;
        background: #F8FAFC;
    }

    .faq-answer-glossy p {
        margin: 12px 0 0 0;
    }
</style>
@endpush

@push('scripts')
<script>
    function toggleFaq(idx) {
        const ans = document.getElementById('answer-' + idx);
        const arrow = document.getElementById('arrow-' + idx);
        if (ans) {
            const isOpen = ans.style.display === 'block';
            ans.style.display = isOpen ? 'none' : 'block';
            if (arrow) arrow.innerHTML = isOpen ? '&darr;' : '&uarr;';
        }
    }

    // Interactive Search
    const searchInput = document.getElementById('faq-search');
    if (searchInput) {
        searchInput.addEventListener('input', function(e) {
            const term = e.target.value.toLowerCase().trim();
            const items = document.querySelectorAll('.faq-item-glossy');
            items.forEach(item => {
                const text = item.getAttribute('data-question') || '';
                item.style.display = text.includes(term) ? 'block' : 'none';
            });
        });
    }
</script>
@endpush
