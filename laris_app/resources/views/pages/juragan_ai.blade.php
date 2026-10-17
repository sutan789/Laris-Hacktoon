@extends('layouts.app', ['title' => 'Juragan AI - Asisten Bisnis & Strategi Pintar'])

@section('content')
<div class="juragan-page">

    <!-- PAGE TOP BAR -->
    <div class="juragan-header-bar">
        <div class="header-left-title">
            <div class="flex-align gap-8">
                <h1 class="j-title">Juragan AI</h1>
                <span class="j-model-pill">● Model v3.8 - Real-time Data Sync Active</span>
            </div>
            <p class="j-subtitle">Asisten Bisnis Pintar & Partner Strategi Toko Berkah Utama</p>
        </div>
        <div class="business-health-badge">
            <div class="health-meta">
                <span class="health-label">KESEHATAN BISNIS</span>
                <span class="health-score">Skor 94/100 (Sangat Sehat)</span>
            </div>
            <div class="health-icon-box">
                <svg width="18" height="18" fill="none" stroke="#CCFF00" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.75 13.5l10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75z"/></svg>
            </div>
        </div>
    </div>

    <!-- MAIN TWO COLUMN CHAT LAYOUT -->
    <div class="juragan-layout-grid">

        <!-- SIDEBAR KIRI: PROFIL & PINTASAN TOPIK -->
        <div class="juragan-side-panel">
            
            <!-- PROFIL JURAGAN WIDGET -->
            <div class="card-panel juragan-profile-card">
                <div class="profile-top-row">
                    <img class="profile-photo" src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=100&auto=format&fit=crop&q=80" alt="Juragan Bambang">
                    <div>
                        <div class="profile-name-flex">
                            <h4>Juragan Bambang</h4>
                            <span class="badge-verified">✔</span>
                        </div>
                        <div class="profile-store-id">Toko Berkah Utama • ID #88412</div>
                    </div>
                </div>
                <div class="profile-stat-grid">
                    <div class="stat-cell">
                        <span class="s-label">OMZET HARI INI</span>
                        <span class="s-val">Rp 3.840.000</span>
                    </div>
                    <div class="stat-cell">
                        <span class="s-label">MARGIN RATA2</span>
                        <span class="s-val text-green">31.4%</span>
                    </div>
                </div>
            </div>

            <!-- TOPIK PERCAKAPAN CEPAT -->
            <div class="card-panel">
                <div class="topic-header">
                    <span>TOPIK PERCAKAPAN CEPAT</span>
                    <span class="bolt-icon">⚡</span>
                </div>

                <div class="topic-buttons-list">
                    <button class="topic-btn" onclick="sendQuickPrompt('Analisis Omzet Bulan Ini')">
                        <div class="topic-btn-icon">💡</div>
                        <div class="topic-btn-text">
                            <strong>Analisis Omzet Bulan Ini</strong>
                            <span>Review performa kotor vs target</span>
                        </div>
                    </button>

                    <button class="topic-btn" onclick="sendQuickPrompt('Cek Produk Menjelang Habis')">
                        <div class="topic-btn-icon">📦</div>
                        <div class="topic-btn-text">
                            <strong>Cek Produk Menjelang Habis</strong>
                            <span>Deteksi 4 SKU stok kritis</span>
                        </div>
                    </button>

                    <button class="topic-btn" onclick="sendQuickPrompt('Rekomendasi Flash Sale Akhir Pekan')">
                        <div class="topic-btn-icon">⚡</div>
                        <div class="topic-btn-text">
                            <strong>Rekomendasi Flash Sale Akhir Pekan</strong>
                            <span>Simulasi kenaikan laba bersih</span>
                        </div>
                    </button>

                    <button class="topic-btn" onclick="sendQuickPrompt('Catat Transaksi Offline Cepat')">
                        <div class="topic-btn-icon">📝</div>
                        <div class="topic-btn-text">
                            <strong>Catat Transaksi Offline Cepat</strong>
                            <span>Voice atau upload foto struk nota</span>
                        </div>
                    </button>
                </div>
            </div>

            <!-- RIWAYAT KONSULTASI -->
            <div class="card-panel">
                <div class="history-header">
                    <span>RIWAYAT KONSULTASI</span>
                    <a href="#all" class="history-link">Lihat Semua</a>
                </div>

                <div class="history-list">
                    <div class="history-item">
                        <div>
                            <div class="h-title">Strategi Kenaikan Margin Q3</div>
                            <div class="h-tag-row">
                                <span class="tag-profit">PROFIT</span>
                                <span class="h-time">Hari ini, 09:14</span>
                            </div>
                        </div>
                        <span class="h-arrow">&rsaquo;</span>
                    </div>

                    <div class="history-item">
                        <div>
                            <div class="h-title">Evaluasi Supplier Minyak Goreng</div>
                            <div class="h-tag-row">
                                <span class="tag-supply">SUPPLY</span>
                                <span class="h-time">Kemarin, 16:30</span>
                            </div>
                        </div>
                        <span class="h-arrow">&rsaquo;</span>
                    </div>

                    <div class="history-item">
                        <div>
                            <div class="h-title">Forecast Permintaan Musim Hujan</div>
                            <div class="h-tag-row">
                                <span class="tag-predict">PREDICT</span>
                                <span class="h-time">22 Okt</span>
                            </div>
                        </div>
                        <span class="h-arrow">&rsaquo;</span>
                    </div>
                </div>
            </div>

        </div>

        <!-- PANEL UTAMA: CHAT COPILOT -->
        <div class="juragan-chat-container card-panel">
            
            <!-- CHAT TOP BAR -->
            <div class="chat-top-header">
                <div class="chat-copilot-title">
                    <div class="copilot-avatar">🤖</div>
                    <div>
                        <div class="flex-align gap-8">
                            <h3>Juragan AI</h3>
                            <span class="copilot-tag">COPILOT</span>
                        </div>
                        <p class="copilot-meta">Operational & Strategy Assistant • Berbasis Algoritma LARIS BI</p>
                    </div>
                </div>
                <div class="chat-actions">
                    <button class="btn-icon" title="Download Riwayat"><svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3"/></svg></button>
                    <button class="btn-icon" title="Pengaturan Chat"><svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.5 6h9.75M10.5 6a1.5 1.5 0 1 1-3 0m3 0a1.5 1.5 0 1 0-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-9.75 0h9.75"/></svg></button>
                </div>
            </div>

            <!-- CHAT CONVERSATION STREAM -->
            <div class="chat-messages-stream" id="chatStream">
                
                <div class="chat-session-divider">
                    <span>HARI INI • SESI ANALISIS STRATEGIS</span>
                </div>

                <!-- AI GREETING MESSAGE -->
                <div class="message-row ai-row">
                    <div class="msg-avatar">🤖</div>
                    <div class="msg-bubble ai-bubble">
                        <p>Halo <strong>Juragan Bambang!</strong> 👋 Selamat datang kembali. Berdasarkan rekonsiliasi data kasir dan marketplace hari ini, omzet bulanan sudah mencapai <strong>Rp 12.4M (+18% MoM)</strong>. Ada 3 insight penting untuk dievaluasi.</p>
                        <span class="msg-time">09:12 • Terverifikasi data live</span>
                    </div>
                </div>

                <!-- USER MESSAGE -->
                <div class="message-row user-row">
                    <div class="msg-bubble user-bubble">
                        <p>Bagaimana cara menaikkan profit margin minggu ini tanpa kehilangan pelanggan?</p>
                        <span class="msg-time">09:13 • Terkirim</span>
                    </div>
                    <img class="user-msg-avatar" src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=60&auto=format&fit=crop&q=80" alt="User">
                </div>

                <!-- RICH AI RECOMMENDATION MESSAGE -->
                <div class="message-row ai-row">
                    <div class="msg-avatar">🤖</div>
                    <div class="msg-bubble ai-bubble rich-bubble">
                        
                        <div class="rich-header">
                            <span class="lightbulb">💡</span>
                            <h4>Fokus pada produk margin tinggi dengan sinyal permintaan kuat:</h4>
                        </div>

                        <!-- 2 CARDS IN RESPONSE -->
                        <div class="rich-cards-grid">
                            
                            <!-- BUNDLE OPPORTUNITY -->
                            <div class="rich-card">
                                <div class="rich-card-top">
                                    <span class="r-badge-muted">BUNDLING OPPORTUNITY</span>
                                    <span class="r-badge-green">+22% Basket</span>
                                </div>
                                <div class="r-product-title">
                                    <span class="coffee-icon">☕</span>
                                    <strong>Kopi Arabica Gayo</strong>
                                </div>
                                <p class="r-desc">Sisa stok <strong>24 unit</strong>. Lakukan bundling dengan <strong>Sirup Caramel</strong> untuk mendongkrak rata-rata nilai transaksi belanja tanpa memicu sensitivitas harga.</p>
                                <div class="r-metric-row">
                                    <span class="lbl">ESTIMASI TAMBAHAN LABA</span>
                                    <span class="val-bold text-green">+Rp 1.450.000</span>
                                </div>
                            </div>

                            <!-- TREND OPPORTUNITY -->
                            <div class="rich-card">
                                <div class="rich-card-top">
                                    <span class="r-badge-dark">RADAR TREN #1</span>
                                    <span class="r-badge-lime">⚡ Skor 87/100</span>
                                </div>
                                <div class="r-product-title">
                                    <span class="pencil-icon">✏</span>
                                    <strong>Pensil Labubu Series</strong>
                                </div>
                                <p class="r-desc">Tingkat permintaan lokal sedang melonjak <strong>82%</strong>. Naikkan harga dari Rp 17.500 ke <strong>Rp 18.500</strong> tanpa menurunkan konversi pembelian.</p>
                                <div class="r-metric-row">
                                    <span class="lbl">ELASTISITAS HARGA</span>
                                    <span class="val-bold text-green">Aman (+5.7% Margin)</span>
                                </div>
                            </div>

                        </div>

                        <!-- ACTION BUTTONS ROW -->
                        <div class="rich-actions-row">
                            <button class="btn-lime">
                                <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z"/></svg>
                                <span>Buat Paket Bundling</span>
                            </button>
                            <a href="{{ url('/laris-predict') }}" class="btn-dark">
                                <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.75 3v11.25A2.25 2.25 0 0 0 6 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0 1 18 16.5h-2.25m-7.5 0h7.5m-7.5 0-1 3m8.5-3 1 3m0 0 .5 1.5m-.5-1.5h-9.5m0 0-.5 1.5m.75-9 3-3 2.148 2.148A12.061 12.061 0 0 1 16.5 7.605"/></svg>
                                <span>Buka LARIS Predict</span>
                            </a>
                            <button class="btn-outline">
                                <span>Catat Pengeluaran Baru</span>
                            </button>
                        </div>

                        <span class="msg-time mt-10">09:14 • Rekomendasi didukung oleh LARIS Engine v3.8</span>
                    </div>
                </div>

            </div>

            <!-- CHAT INPUT COMPONENT -->
            <div class="chat-input-wrapper">
                <div class="chat-input-bar">
                    <button class="attach-btn" title="Upload Struk / File">
                        <svg width="18" height="18" fill="none" stroke="#64748B" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m18.375 12.739-7.693 7.693a4.5 4.5 0 0 1-6.364-6.364l10.94-10.94A3 3 0 1 1 19.5 7.373L8.552 18.32a1.5 1.5 0 0 1-2.122-2.122l8.74-8.739"/></svg>
                    </button>
                    <input type="text" id="userChatInput" placeholder="Tanya apa saja seputar penjualan, stok, atau strategi toko..." onkeypress="handleKeyPress(event)">
                    <button class="voice-btn" title="Gunakan Suara">
                        <svg width="18" height="18" fill="none" stroke="#64748B" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18.75a6 6 0 0 0 6-6v-1.5m-6 7.5a6 6 0 0 1-6-6v-1.5m6 7.5v3.75m-3.75 0h7.5M12 15a3 3 0 0 1-3-3V4.5a3 3 0 1 1 6 0v7.5a3 3 0 0 1-3 3Z"/></svg>
                    </button>
                    <button class="send-btn" onclick="sendMessage()">
                        <svg width="18" height="18" fill="none" stroke="#000000" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5"/></svg>
                    </button>
                </div>
                
                <div class="chat-suggestions-row">
                    <span class="saran-lbl">SARAN:</span>
                    <button class="chip-saran" onclick="sendQuickPrompt('Kapan harus restock kopi?')">"Kapan harus restock kopi?"</button>
                    <button class="chip-saran" onclick="sendQuickPrompt('Simulasi diskon 10% vs 15%')">"Simulasi diskon 10% vs 15%"</button>
                    <button class="chip-saran" onclick="sendQuickPrompt('Produk paling laris di Shopee')">"Produk paling laris di Shopee"</button>
                </div>
            </div>

        </div>

    </div>

</div>

@push('styles')
<style>
    .juragan-page {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .juragan-header-bar {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .j-title {
        font-family: 'Outfit', sans-serif;
        font-size: 26px;
        font-weight: 800;
        color: var(--text-main);
    }

    .j-model-pill {
        background: #CCFF00;
        color: #000000;
        font-size: 11px;
        font-weight: 800;
        padding: 3px 10px;
        border-radius: 20px;
    }

    .j-subtitle {
        font-size: 13px;
        color: var(--text-muted);
        margin-top: 2px;
    }

    .business-health-badge {
        display: flex;
        align-items: center;
        gap: 12px;
        background: #0B1215;
        color: #FFFFFF;
        padding: 8px 16px;
        border-radius: 12px;
        border: 1px solid #1E2D33;
    }

    .health-meta {
        text-align: right;
    }

    .health-label {
        font-size: 9px;
        font-weight: 700;
        color: #94A3B8;
        display: block;
        letter-spacing: 0.5px;
    }

    .health-score {
        font-size: 12px;
        font-weight: 800;
        color: #FFFFFF;
    }

    .health-icon-box {
        width: 32px;
        height: 32px;
        background: #162228;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .juragan-layout-grid {
        display: grid;
        grid-template-columns: 320px 1fr;
        gap: 22px;
        align-items: start;
    }

    /* SIDEBAR KIRI */
    .juragan-side-panel {
        display: flex;
        flex-direction: column;
        gap: 16px;
    }

    .juragan-profile-card {
        padding: 16px;
    }

    .profile-top-row {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 14px;
    }

    .profile-photo {
        width: 44px;
        height: 44px;
        border-radius: 50%;
        border: 2px solid #CCFF00;
    }

    .profile-name-flex {
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .profile-name-flex h4 {
        font-size: 14px;
        font-weight: 700;
    }

    .badge-verified {
        color: #16A34A;
        font-size: 12px;
    }

    .profile-store-id {
        font-size: 11px;
        color: var(--text-muted);
    }

    .profile-stat-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 8px;
        background: #F8FAFC;
        padding: 10px;
        border-radius: 10px;
    }

    .stat-cell .s-label {
        font-size: 9px;
        font-weight: 700;
        color: var(--text-muted);
        display: block;
    }

    .stat-cell .s-val {
        font-size: 13px;
        font-weight: 800;
        color: var(--text-main);
    }

    /* TOPIC BUTTONS */
    .topic-header, .history-header {
        font-size: 11px;
        font-weight: 800;
        color: var(--text-muted);
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 12px;
        letter-spacing: 0.5px;
    }

    .topic-buttons-list {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .topic-btn {
        display: flex;
        align-items: center;
        gap: 10px;
        background: #F8FAFC;
        border: 1px solid #E2E8F0;
        border-radius: 10px;
        padding: 10px 12px;
        text-align: left;
        cursor: pointer;
        transition: all 0.15s;
    }

    .topic-btn:hover {
        background: #FFFFFF;
        border-color: #CCFF00;
        box-shadow: 0 2px 10px rgba(0,0,0,0.04);
    }

    .topic-btn-icon {
        font-size: 16px;
    }

    .topic-btn-text strong {
        font-size: 12px;
        color: var(--text-main);
        display: block;
    }

    .topic-btn-text span {
        font-size: 11px;
        color: var(--text-muted);
    }

    /* HISTORY LIST */
    .history-link {
        font-size: 11px;
        color: #16A34A;
        text-decoration: none;
        font-weight: 700;
    }

    .history-list {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .history-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 8px 0;
        border-bottom: 1px solid #F1F5F9;
        cursor: pointer;
    }

    .h-title {
        font-size: 12px;
        font-weight: 600;
        color: var(--text-main);
    }

    .h-tag-row {
        display: flex;
        gap: 6px;
        align-items: center;
        margin-top: 2px;
    }

    .tag-profit { background: #DCFCE7; color: #16A34A; font-size: 9px; font-weight: 800; padding: 1px 5px; border-radius: 4px; }
    .tag-supply { background: #FEF3C7; color: #D97706; font-size: 9px; font-weight: 800; padding: 1px 5px; border-radius: 4px; }
    .tag-predict { background: #F1F5F9; color: #475569; font-size: 9px; font-weight: 800; padding: 1px 5px; border-radius: 4px; }

    .h-time { font-size: 10px; color: var(--text-muted); }
    .h-arrow { font-size: 16px; color: var(--text-muted); }

    /* CHAT CONTAINER */
    .juragan-chat-container {
        display: flex;
        flex-direction: column;
        height: 720px;
        padding: 0;
        overflow: hidden;
    }

    .chat-top-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 16px 24px;
        border-bottom: 1px solid var(--border-light);
        background: #FFFFFF;
    }

    .chat-copilot-title {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .copilot-avatar {
        width: 38px;
        height: 38px;
        background: #0B1215;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
    }

    .copilot-tag {
        background: #0B1215;
        color: #CCFF00;
        font-size: 10px;
        font-weight: 800;
        padding: 2px 7px;
        border-radius: 10px;
    }

    .copilot-meta {
        font-size: 11px;
        color: var(--text-muted);
    }

    .chat-actions {
        display: flex;
        gap: 8px;
    }

    .btn-icon {
        width: 32px;
        height: 32px;
        border-radius: 8px;
        background: #F8FAFC;
        border: 1px solid #E2E8F0;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #64748B;
    }

    /* MESSAGES STREAM */
    .chat-messages-stream {
        flex: 1;
        padding: 24px;
        overflow-y: auto;
        display: flex;
        flex-direction: column;
        gap: 18px;
        background: #FAFBFB;
    }

    .chat-session-divider {
        text-align: center;
        margin: 6px 0;
    }

    .chat-session-divider span {
        background: #E2E8F0;
        color: #475569;
        font-size: 10px;
        font-weight: 800;
        padding: 4px 12px;
        border-radius: 20px;
        letter-spacing: 0.5px;
    }

    .message-row {
        display: flex;
        gap: 12px;
        max-width: 85%;
    }

    .ai-row { align-self: flex-start; }
    .user-row { align-self: flex-end; flex-direction: row-reverse; }

    .msg-avatar {
        width: 34px;
        height: 34px;
        background: #0B1215;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
        flex-shrink: 0;
    }

    .user-msg-avatar {
        width: 34px;
        height: 34px;
        border-radius: 50%;
        border: 2px solid #CCFF00;
        flex-shrink: 0;
    }

    .msg-bubble {
        padding: 14px 18px;
        border-radius: 14px;
        font-size: 13px;
        line-height: 1.5;
    }

    .ai-bubble {
        background: #FFFFFF;
        border: 1px solid #E2E8F0;
        color: var(--text-main);
    }

    .user-bubble {
        background: #0B1215;
        color: #FFFFFF;
    }

    .msg-time {
        font-size: 10px;
        color: #94A3B8;
        display: block;
        margin-top: 6px;
    }

    /* RICH BUBBLE CONTENT */
    .rich-bubble {
        width: 100%;
        max-width: 620px;
    }

    .rich-header {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 14px;
    }

    .rich-header h4 {
        font-size: 14px;
        font-weight: 700;
    }

    .rich-cards-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 14px;
        margin-bottom: 16px;
    }

    .rich-card {
        background: #F8FAFC;
        border: 1px solid #E2E8F0;
        border-radius: 12px;
        padding: 14px;
    }

    .rich-card-top {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 8px;
    }

    .r-badge-muted { font-size: 9px; font-weight: 800; color: #64748B; }
    .r-badge-green { font-size: 9px; font-weight: 800; background: #DCFCE7; color: #16A34A; padding: 2px 6px; border-radius: 4px; }
    .r-badge-dark { font-size: 9px; font-weight: 800; background: #0B1215; color: #FFFFFF; padding: 2px 6px; border-radius: 4px; }
    .r-badge-lime { font-size: 9px; font-weight: 800; background: #CCFF00; color: #000000; padding: 2px 6px; border-radius: 4px; }

    .r-product-title {
        font-size: 13px;
        margin-bottom: 6px;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .r-desc {
        font-size: 11px;
        color: var(--text-muted);
        line-height: 1.4;
        margin-bottom: 10px;
    }

    .r-metric-row {
        display: flex;
        justify-content: space-between;
        font-size: 11px;
        border-top: 1px solid #EEF2F6;
        padding-top: 8px;
    }

    .rich-actions-row {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }

    .mt-10 { margin-top: 10px; }

    /* CHAT INPUT AREA */
    .chat-input-wrapper {
        padding: 16px 24px;
        background: #FFFFFF;
        border-top: 1px solid var(--border-light);
    }

    .chat-input-bar {
        display: flex;
        align-items: center;
        gap: 10px;
        background: #F1F5F9;
        border: 1px solid #E2E8F0;
        border-radius: 14px;
        padding: 6px 10px;
        transition: all 0.2s;
    }

    .chat-input-bar:focus-within {
        background: #FFFFFF;
        border-color: #CCFF00;
        box-shadow: 0 0 0 3px rgba(204, 255, 0, 0.25);
    }

    .attach-btn, .voice-btn {
        background: transparent;
        border: none;
        cursor: pointer;
        padding: 6px;
        display: flex;
        align-items: center;
    }

    .chat-input-bar input {
        flex: 1;
        border: none;
        background: transparent;
        outline: none;
        font-size: 13px;
        color: var(--text-main);
    }

    .send-btn {
        width: 36px;
        height: 36px;
        background: #CCFF00;
        border: none;
        border-radius: 10px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: transform 0.15s;
    }

    .send-btn:hover {
        transform: scale(1.05);
    }

    .chat-suggestions-row {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-top: 10px;
        overflow-x: auto;
    }

    .saran-lbl {
        font-size: 10px;
        font-weight: 800;
        color: #94A3B8;
    }

    .chip-saran {
        background: #F8FAFC;
        border: 1px solid #E2E8F0;
        border-radius: 20px;
        padding: 4px 10px;
        font-size: 11px;
        color: #475569;
        cursor: pointer;
        white-space: nowrap;
        transition: all 0.15s;
    }

    .chip-saran:hover {
        background: #FFFFFF;
        border-color: #CBD5E1;
        color: #000000;
    }

    @media (max-width: 1024px) {
        .juragan-layout-grid {
            grid-template-columns: 1fr;
            gap: 16px;
        }
        .juragan-header-bar {
            flex-direction: column;
            align-items: stretch;
            gap: 14px;
        }
        .business-health-badge {
            align-self: flex-start;
        }
    }

    @media (max-width: 640px) {
        .message-row {
            max-width: 96%;
        }
        .chat-input-wrapper {
            padding: 12px 14px;
        }
        .chat-messages-stream {
            padding: 16px 12px;
        }
        .j-title {
            font-size: 22px;
        }
        .j-model-pill {
            font-size: 10px;
        }
    }
</style>
@endpush

@push('scripts')
<script>
    function sendQuickPrompt(text) {
        document.getElementById('userChatInput').value = text;
        sendMessage();
    }

    function handleKeyPress(e) {
        if (e.key === 'Enter') {
            sendMessage();
        }
    }

    function sendMessage() {
        const input = document.getElementById('userChatInput');
        const text = input.value.trim();
        if (!text) return;

        const stream = document.getElementById('chatStream');

        // Append User Message
        const userHtml = `
            <div class="message-row user-row">
                <div class="msg-bubble user-bubble">
                    <p>${text}</p>
                    <span class="msg-time">Baru saja • Terkirim</span>
                </div>
                <img class="user-msg-avatar" src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=60&auto=format&fit=crop&q=80" alt="User">
            </div>
        `;
        stream.insertAdjacentHTML('beforeend', userHtml);
        input.value = '';
        stream.scrollTop = stream.scrollHeight;

        // Tampilkan Indikator AI Sedang Berpikir
        const loadingId = 'aiLoading_' + Date.now();
        const loadingHtml = `
            <div id="${loadingId}" class="message-row ai-row">
                <div class="msg-avatar">🤖</div>
                <div class="msg-bubble ai-bubble" style="color: #94A3B8; font-style: italic;">
                    <p>⚡ Juragan AI sedang menganalisis data toko...</p>
                </div>
            </div>
        `;
        stream.insertAdjacentHTML('beforeend', loadingHtml);
        stream.scrollTop = stream.scrollHeight;

        // Panggil Backend Laravel (Gemini 3.8 Flash + Grounded Store Context)
        fetch("{{ route('juragan.chat') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ message: text })
        })
        .then(response => response.json())
        .then(data => {
            const loadingElem = document.getElementById(loadingId);
            if (loadingElem) loadingElem.remove();

            let replyText = data.reply || 'Maaf Juragan, sistem AI sedang merefresh koneksi data.';
            
            // Pembersihan tanda-tanda aneh markdown
            replyText = replyText
                .replace(/^---$/gm, '')                            // Hapus garis horizontal ---
                .replace(/^#{1,4}\s*(.*)$/gm, '<strong style="color: #0F172A; display: block; margin: 10px 0 4px 0; font-size: 14px;">$1</strong>') // Ubah ### menjadi sub-judul elegan
                .replace(/\*\*(.*?)\*\*/g, '<strong>$1</strong>')  // Bold **teks**
                .replace(/\*(.*?)\*/g, '<em>$1</em>')              // Italic *teks*
                .replace(/^[\*\-]\s+(.*)$/gm, '<span style="display: block; margin-left: 12px;">• $1</span>') // Bullet rapi
                .replace(/\n\n+/g, '<br><br>')                     // Paragraf baru bersih
                .replace(/\n/g, '<br>');                           // Baris baru

            const aiHtml = `
                <div class="message-row ai-row">
                    <div class="msg-avatar">🤖</div>
                    <div class="msg-bubble ai-bubble" style="line-height: 1.6;">
                        <p>${replyText}</p>
                        <span class="msg-time">${data.timestamp || 'Baru saja'} • Live Gemini 3.8 Flash</span>
                    </div>
                </div>
            `;
            stream.insertAdjacentHTML('beforeend', aiHtml);
            stream.scrollTop = stream.scrollHeight;
        })
        .catch(error => {
            const loadingElem = document.getElementById(loadingId);
            if (loadingElem) loadingElem.remove();

            const errorHtml = `
                <div class="message-row ai-row">
                    <div class="msg-avatar">🤖</div>
                    <div class="msg-bubble ai-bubble" style="border-left: 3px solid #DC2626;">
                        <p>Koneksi ke AI Cloud terputus. Silakan ulangi pertanyaan Anda, Juragan.</p>
                        <span class="msg-time">Gagal sinkronisasi</span>
                    </div>
                </div>
            `;
            stream.insertAdjacentHTML('beforeend', errorHtml);
            stream.scrollTop = stream.scrollHeight;
        });
    }
</script>
@endpush
@endsection
