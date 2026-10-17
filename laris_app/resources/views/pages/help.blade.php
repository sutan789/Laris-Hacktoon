@extends('layouts.app', ['title' => 'Pusat Bantuan & Dokumentasi - LARIS BI Platform'])

@section('content')
<div class="help-container">

    <!-- HERO HEADER -->
    <div class="help-hero-card">
        <div class="hero-badge">PUSAT BANTUAN &amp; DOKUMENTASI RESMI</div>
        <h1 class="hero-title">Bagaimana Kami Bisa Membantu Juragan Hari Ini?</h1>
        <p class="hero-subtitle">Pelajari cara kerja Autonomous Decision Engine, simulasi prediktif, integrasi kasir, dan optimasi margin toko Anda.</p>
        
        <div class="help-search-box">
            <svg width="18" height="18" fill="none" stroke="#64748B" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z"/></svg>
            <input type="text" id="faq-search" placeholder="Ketik kata kunci pertanyaan... (misal: simulasi, restock, ongkir, XAI)">
        </div>
    </div>

    <!-- 4 FEATURE GUIDE PILLARS -->
    <div class="guide-grid">
        <div class="guide-card card-panel">
            <div class="guide-icon-badge">🎯</div>
            <h3>LARIS Predict</h3>
            <p>Fitur "What If I Sell This?" untuk memprediksi probabilitas sukses produk baru sebelum belanja modal stok.</p>
            <a href="{{ route('predict.index') }}" class="guide-link">Buka Fitur &rarr;</a>
        </div>

        <div class="guide-card card-panel">
            <div class="guide-icon-badge">📈</div>
            <h3>Trend Hunter</h3>
            <p>Radar pemantau lonjakan tren viral marketplace lokal dengan perhitungan Growth Velocity &amp; Viral Score.</p>
            <a href="{{ route('trends.index') }}" class="guide-link">Buka Fitur &rarr;</a>
        </div>

        <div class="guide-card card-panel">
            <div class="guide-icon-badge">📦</div>
            <h3>Smart Inventory</h3>
            <p>Autonomous PO Bundling yang menggabungkan pengadaan stok kritis dari supplier sama untuk hemat ongkir 18%.</p>
            <a href="{{ route('inventory.index') }}" class="guide-link">Buka Fitur &rarr;</a>
        </div>

        <div class="guide-card card-panel">
            <div class="guide-icon-badge">🤖</div>
            <h3>Juragan AI Copilot</h3>
            <p>Konsultan bisnis cerdas berbasis Gemini 3.8 Flash yang memahami data telemetri penjualan toko Anda.</p>
            <a href="{{ route('juragan.index') }}" class="guide-link">Buka Fitur &rarr;</a>
        </div>
    </div>

    <!-- FAQ ACCORDION -->
    <div class="card-panel">
        <div class="faq-head">
            <h3>Pertanyaan yang Sering Diajukan (FAQ)</h3>
            <p class="sub-muted">Jawaban seputar akurasi model, keamanan data, dan tata kelola platform</p>
        </div>

        <div class="faq-list">
            @foreach($faqs as $idx => $faq)
                <div class="faq-item" data-question="{{ strtolower($faq['question'] . ' ' . $faq['answer']) }}">
                    <button class="faq-toggle" onclick="toggleFaq({{ $idx }})">
                        <span class="faq-q-text">{{ $faq['question'] }}</span>
                        <span class="faq-cat-tag">{{ $faq['category'] }}</span>
                        <span class="faq-arrow" id="arrow-{{ $idx }}">&darr;</span>
                    </button>
                    <div class="faq-answer" id="answer-{{ $idx }}">
                        <p>{{ $faq['answer'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- SUPPORT CONTACT CARD -->
    <div class="support-contact-strip">
        <div class="support-info">
            <div class="support-logo-badge">MEUKARYA</div>
            <div>
                <h4>Dibuat oleh Tim Meukarya untuk INFEST Hackathon 2026</h4>
                <p>Butuh bantuan teknis atau implementasi kustom untuk jaringan toko Anda? Tim kami siap berdiskusi.</p>
            </div>
        </div>
        <div class="support-actions">
            <a href="mailto:support@laris.id" class="btn-email-supp">Kirim Email</a>
            <a href="https://wa.me/6281234567890?text=Halo%20Tim%20LARIS,%20saya%20ingin%20konsultasi%20fitur" target="_blank" class="btn-wa-supp">
                WhatsApp Support &rarr;
            </a>
        </div>
    </div>

</div>

@push('styles')
<style>
    .help-container {
        display: flex;
        flex-direction: column;
        gap: 24px;
    }

    .help-hero-card {
        background: radial-gradient(circle at top right, #1E293B 0%, #0B1215 100%);
        border: 1px solid #1E2D33;
        border-radius: 16px;
        padding: 36px 32px;
        text-align: center;
        color: #FFFFFF;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.25);
    }

    .hero-badge {
        display: inline-block;
        background: rgba(204, 255, 0, 0.12);
        color: #CCFF00;
        border: 1px solid rgba(204, 255, 0, 0.3);
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 800;
        letter-spacing: 1px;
        margin-bottom: 12px;
    }

    .hero-title {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 26px;
        font-weight: 800;
        letter-spacing: -0.5px;
        margin-bottom: 8px;
    }

    .hero-subtitle {
        font-size: 13px;
        color: #94A3B8;
        max-width: 640px;
        margin: 0 auto 20px auto;
        line-height: 1.5;
    }

    .help-search-box {
        display: flex;
        align-items: center;
        gap: 12px;
        background: #FFFFFF;
        border-radius: 30px;
        padding: 10px 20px;
        max-width: 540px;
        margin: 0 auto;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
    }

    .help-search-box input {
        border: none;
        outline: none;
        width: 100%;
        font-size: 13px;
        color: #0F172A;
    }

    .guide-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 16px;
    }

    .guide-card {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        padding: 20px;
        transition: all 0.2s;
    }

    .guide-card:hover {
        transform: translateY(-3px);
        border-color: #CCFF00;
        box-shadow: 0 8px 24px rgba(204, 255, 0, 0.12);
    }

    .guide-icon-badge {
        font-size: 28px;
        margin-bottom: 12px;
    }

    .guide-card h3 {
        font-size: 15px;
        font-weight: 700;
        color: #0F172A;
        margin-bottom: 6px;
    }

    .guide-card p {
        font-size: 12px;
        color: #64748B;
        line-height: 1.4;
        margin-bottom: 16px;
    }

    .guide-link {
        font-size: 12px;
        font-weight: 700;
        color: #16A34A;
        text-decoration: none;
    }

    /* FAQ */
    .faq-head {
        margin-bottom: 16px;
        padding-bottom: 12px;
        border-bottom: 1px solid #F1F5F9;
    }

    .faq-head h3 {
        font-size: 16px;
        font-weight: 700;
        color: #0F172A;
    }

    .faq-list {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .faq-item {
        border: 1px solid #E2E8F0;
        border-radius: 10px;
        overflow: hidden;
        transition: all 0.15s;
    }

    .faq-toggle {
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: space-between;
        background: #F8FAFC;
        border: none;
        padding: 14px 18px;
        font-family: inherit;
        font-size: 13px;
        font-weight: 700;
        color: #1E293B;
        cursor: pointer;
        text-align: left;
    }

    .faq-toggle:hover {
        background: #F1F5F9;
    }

    .faq-cat-tag {
        font-size: 10px;
        font-weight: 700;
        background: #E2E8F0;
        color: #475569;
        padding: 3px 8px;
        border-radius: 12px;
        margin-left: auto;
        margin-right: 12px;
    }

    .faq-arrow {
        font-size: 14px;
        color: #64748B;
        transition: transform 0.2s;
    }

    .faq-answer {
        display: none;
        padding: 14px 18px;
        background: #FFFFFF;
        font-size: 13px;
        color: #475569;
        line-height: 1.6;
        border-top: 1px solid #F1F5F9;
    }

    /* SUPPORT STRIP */
    .support-contact-strip {
        background: #0B1215;
        border: 1px solid #1E2D33;
        border-radius: 14px;
        padding: 20px 24px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        color: #FFFFFF;
    }

    .support-info {
        display: flex;
        align-items: center;
        gap: 16px;
    }

    .support-logo-badge {
        background: #CCFF00;
        color: #000000;
        font-weight: 900;
        font-size: 11px;
        letter-spacing: 1px;
        padding: 8px 12px;
        border-radius: 8px;
    }

    .support-info h4 {
        font-size: 14px;
        font-weight: 700;
        color: #FFFFFF;
    }

    .support-info p {
        font-size: 12px;
        color: #94A3B8;
        margin-top: 2px;
    }

    .support-actions {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .btn-email-supp {
        background: #1E293B;
        color: #FFFFFF;
        padding: 8px 16px;
        border-radius: 8px;
        font-size: 12px;
        font-weight: 600;
        text-decoration: none;
        border: 1px solid #334155;
    }

    .btn-wa-supp {
        background: #CCFF00;
        color: #000000;
        padding: 8px 16px;
        border-radius: 8px;
        font-size: 12px;
        font-weight: 700;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    @media (max-width: 1000px) {
        .guide-grid { grid-template-columns: repeat(2, 1fr); }
        .support-contact-strip { flex-direction: column; gap: 16px; text-align: center; }
        .support-info { flex-direction: column; }
    }
</style>
@endpush

@push('scripts')
<script>
    function toggleFaq(index) {
        const ans = document.getElementById('answer-' + index);
        const arrow = document.getElementById('arrow-' + index);
        if (ans.style.display === 'block') {
            ans.style.display = 'none';
            arrow.style.transform = 'rotate(0deg)';
        } else {
            ans.style.display = 'block';
            arrow.style.transform = 'rotate(180deg)';
        }
    }

    // Live search FAQ
    document.getElementById('faq-search').addEventListener('input', function(e) {
        const q = e.target.value.toLowerCase().trim();
        const items = document.querySelectorAll('.faq-item');
        items.forEach(item => {
            const text = item.getAttribute('data-question') || '';
            if (text.includes(q)) {
                item.style.display = 'block';
            } else {
                item.style.display = 'none';
            }
        });
    });
</script>
@endpush
@endsection
