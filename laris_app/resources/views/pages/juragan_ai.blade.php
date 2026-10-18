@extends('layouts.app', ['title' => 'Juragan AI - Asisten Bisnis & Strategi Pintar'])

@section('content')
<div class="juragan-page">

    <!-- 1. GLOSSY HEADER BAR -->
    <div class="dash-header">
        <div class="header-main-info">
            <div class="greeting-row">
                <h1 class="page-greeting">Juragan <span class="store-gradient-name">AI Copilot</span></h1>
                <span class="verified-store-badge">
                    <svg width="14" height="14" viewBox="0 0 20 20" fill="#10B981"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd" /></svg>
                    <span>Asisten Resmi</span>
                </span>
                <span class="live-status-pill">
                    <span class="pulse-dot"></span>
                    <span>Model v3.8 (Terhubung Data POS &amp; Pasar)</span>
                </span>
            </div>
            <p class="page-subtitle">Konsultasi strategi harga, rekomendasi restock, promosi akhir pekan, dan efisiensi operasional gerai Anda.</p>
        </div>

        <div class="dash-actions">
            <div class="business-health-card-glossy">
                <div>
                    <span class="health-lbl">KESEHATAN BISNIS</span>
                    <strong class="health-val text-green">Skor 94 / 100</strong>
                </div>
                <div class="ai-gem-icon" style="width: 36px; height: 36px; border-radius: 10px;">
                    <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.75 13.5l10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75z"/></svg>
                </div>
            </div>
        </div>
    </div>

    <!-- 2. MAIN TWO COLUMN CHAT LAYOUT -->
    <div class="dash-columns" style="grid-template-columns: 320px 1fr;">

        <!-- SIDEBAR KIRI: PROFIL & PINTASAN TOPIK -->
        <div class="col-left" style="display: flex; flex-direction: column; gap: 18px;">
            
            <!-- PROFIL JURAGAN WIDGET -->
            <div class="card-panel">
                <div class="profile-top-row">
                    <img class="profile-photo-glossy" src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=100&auto=format&fit=crop&q=80" alt="Juragan Bambang">
                    <div>
                        <div class="flex-align gap-6">
                            <h4 class="profile-name">Juragan Bambang</h4>
                            <span class="verified-store-badge" style="padding: 3px 6px; display: inline-flex; align-items: center;">
                                <svg width="12" height="12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="m4.5 12.75 6 6 9-13.5"/></svg>
                            </span>
                        </div>
                        <span class="profile-store-id">Toko Berkah Utama</span>
                    </div>
                </div>

                <div class="profile-stat-grid mt-14">
                    <div class="f-box-glossy" style="padding: 10px 12px;">
                        <span class="f-lbl">OMZET HARI INI</span>
                        <strong class="stat-num">Rp 3.840.000</strong>
                    </div>
                    <div class="f-box-glossy" style="padding: 10px 12px;">
                        <span class="f-lbl">MARGIN RATA2</span>
                        <strong class="stat-num text-green">31.4%</strong>
                    </div>
                </div>
            </div>

            <!-- TOPIK PERCAKAPAN CEPAT -->
            <div class="card-panel">
                <div class="panel-header" style="margin-bottom: 12px;">
                    <div>
                        <h4 class="panel-title" style="font-size: 13.5px;">Pertanyaan Cepat</h4>
                        <p class="panel-subtitle">Saran otomatis berdasarkan data toko</p>
                    </div>
                    <span class="tag-pill-glossy">PINTASAN</span>
                </div>

                <div class="topic-buttons-list">
                    <button type="button" class="topic-btn-glossy" onclick="sendQuickPrompt('berdasarkan pengamatan saya, asap dari kebakaran hutan telah menyebar sampai ke kota saya dan sekolah-sekolah sudah diliburkan. apakah dengan kita menjual masker itu menjadi sebuah peluang? tapi saya tidak tahu pasti bencana ini akan berlalu sampai kapan, gimana pendapat anda')">
                        <div class="topic-icon" style="background: rgba(239, 68, 68, 0.15); color: #EF4444;">
                            <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z"/></svg>
                        </div>
                        <div class="topic-text">
                            <strong>Analisis Asap &amp; Jual Masker</strong>
                            <span>Peluang darurat, margin &amp; mitigasi risiko</span>
                        </div>
                    </button>

                    <button type="button" class="topic-btn-glossy" onclick="sendQuickPrompt('tambah stok masker 50 unit')">
                        <div class="topic-icon" style="background: rgba(16, 185, 129, 0.15); color: #10B981;">
                            <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.5v15m7.5-7.5h-15"/></svg>
                        </div>
                        <div class="topic-text">
                            <strong>Tambah Stok Masker (+50)</strong>
                            <span>Instruksikan AI perbarui stok gudang</span>
                        </div>
                    </button>

                    <button type="button" class="topic-btn-glossy" onclick="sendQuickPrompt('Tampilkan kompilasi sinyal viral di Trend Hunter saat ini!')">
                        <div class="topic-icon" style="background: rgba(59, 130, 246, 0.15); color: #3B82F6;">
                            <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/></svg>
                        </div>
                        <div class="topic-text">
                            <strong>Radar Trend Hunter</strong>
                            <span>Sinyal pencarian &amp; produk viral</span>
                        </div>
                    </button>

                    <button type="button" class="topic-btn-glossy" onclick="sendQuickPrompt('Saya ingin mengunduh laporan bisnis bulanan dalam format CSV, Excel, PDF, dan TXT.')">
                        <div class="topic-icon" style="background: rgba(245, 158, 11, 0.15); color: #F59E0B;">
                            <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z"/></svg>
                        </div>
                        <div class="topic-text">
                            <strong>Unduh Laporan Bisnis</strong>
                            <span>Ekspor format PDF / Excel / CSV / TXT</span>
                        </div>
                    </button>

                    <button type="button" class="topic-btn-glossy" onclick="sendQuickPrompt('Cek produk apa saja yang stoknya hampir habis dan perlu segera di-reorder!')">
                        <div class="topic-icon">
                            <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z"/></svg>
                        </div>
                        <div class="topic-text">
                            <strong>Cek Stok Kritis</strong>
                            <span>Deteksi item yang butuh restock</span>
                        </div>
                    </button>
                </div>
            </div>

        </div>

        <!-- PANEL KANAN: CHAT COPILOT STREAM (GLOSSY & MEWAH) -->
        <div class="col-right">
            <div class="card-panel chat-container-glossy">
                
                <!-- CHAT TOP BAR -->
                <div class="chat-top-bar">
                    <div class="chat-copilot-info">
                        <div class="ai-gem-icon" style="width: 40px; height: 40px;">
                            <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.813 15.904 9 18.75l-.813-2.846a4.5 4.5 0 0 0-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 0 0 3.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 0 0 3.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 0 0-3.09 3.09ZM18.259 8.715 18 9.75l-.259-1.035a3.375 3.375 0 0 0-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 0 0 2.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 0 0 2.456 2.456L21.75 6l-1.035.259a3.375 3.375 0 0 0-2.456 2.456Z"/></svg>
                        </div>
                        <div>
                            <div class="flex-align gap-8">
                                <h3 class="copilot-title">Juragan AI</h3>
                                <span class="tag-pill-glossy">AKTIF</span>
                            </div>
                            <span class="copilot-sub">Mitra Strategis &amp; Analisis Realtime Toko Berkah</span>
                        </div>
                    </div>

                    <div style="display: flex; gap: 8px; align-items: center;">
                        <button type="button" id="btnToggleVoiceAI" class="btn-timeframe-glossy" onclick="toggleVoiceAI()" style="cursor: pointer; display: inline-flex; align-items: center; gap: 6px; border: 1.5px solid #334155; transition: all 0.2s;">
                            <svg id="voiceAIIcon" width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.114 5.636a9 9 0 0 1 0 12.728M16.463 8.288a5.25 5.25 0 0 1 0 7.424M6.75 8.25l4.72-4.72a.75.75 0 0 1 1.28.53v15.88a.75.75 0 0 1-1.28.53l-4.72-4.72H4.51c-.88 0-1.704-.507-1.938-1.354A9.009 9.009 0 0 1 2.25 12c0-.83.112-1.633.322-2.396C2.806 8.757 3.63 8.25 4.51 8.25H6.75Z"/></svg>
                            <span id="voiceAILabel">Voice AI: Nonaktif</span>
                        </button>
                        <button type="button" class="btn-timeframe-glossy" onclick="document.getElementById('chatStream').innerHTML = ''; showToast('Riwayat obrolan sesi ini dibersihkan.');">
                            <span>Bersihkan Chat</span>
                        </button>
                    </div>
                </div>

                <!-- CHAT MESSAGES STREAM -->
                <div class="chat-messages-stream" id="chatStream">
                    
                    <div class="chat-date-pill">
                        <span>SESI HARI INI • DIDUKUNG JURAGAN AI LIVE</span>
                    </div>

                    <!-- AI GREETING -->
                    <div class="msg-row ai-row">
                        <div class="msg-avatar-ai">
                            <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.813 15.904 9 18.75l-.813-2.846a4.5 4.5 0 0 0-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 0 0 3.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 0 0 3.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 0 0-3.09 3.09Z"/></svg>
                        </div>
                        <div class="msg-bubble-ai">
                            <p>Halo <strong>Juragan Bambang!</strong> Saya siap membantu analisis gerai Anda hari ini. Berdasarkan sinkronisasi kasir dan marketplace terakhir, penjualan berjalan sangat sehat dengan <strong>omzet Rp 3,84 Juta</strong>.</p>
                            <p style="margin-top: 6px;">Ada yang ingin Anda konsultasikan terkait strategi harga, stok gudang, atau tren produk viral di sekitar toko?</p>
                            <span class="msg-time-ai">Baru saja • Sinkronisasi Data Riil</span>
                        </div>
                    </div>

                </div>

                <!-- CHAT INPUT WRAPPER -->
                <div class="chat-input-wrapper">
                    <input type="text" id="userChatInput" class="chat-input-field" placeholder="Ketik pertanyaan untuk Juragan AI... (Contoh: Strategi promo akhir pekan)" onkeypress="handleKeyPress(event)">
                    
                    <button type="button" class="btn-send-glossy" onclick="sendMessage()">
                        <span>Kirim</span>
                        <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5"/></svg>
                    </button>
                </div>

            </div>
        </div>

    </div>

</div>
@endsection

@push('styles')
<style>
    .juragan-page {
        display: flex;
        flex-direction: column;
        gap: 22px;
    }

    .business-health-card-glossy {
        display: flex;
        align-items: center;
        gap: 12px;
        background: #FFFFFF;
        border: 1px solid #E2E8F0;
        border-radius: 14px;
        padding: 8px 16px;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.03);
    }

    .health-lbl {
        font-size: 10px;
        font-weight: 800;
        color: #64748B;
        letter-spacing: 0.5px;
        display: block;
    }

    .health-val {
        font-size: 14px;
        font-weight: 800;
    }

    /* Profile Widget */
    .profile-top-row {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .profile-photo-glossy {
        width: 46px;
        height: 46px;
        border-radius: 14px;
        object-fit: cover;
        border: 2px solid #FFFFFF;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
    }

    .profile-name {
        font-size: 14px;
        font-weight: 800;
        color: var(--text-main);
        margin: 0;
    }

    .profile-store-id {
        font-size: 11.5px;
        color: var(--text-muted);
    }

    .profile-stat-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 8px;
    }

    .stat-num {
        font-size: 13.5px;
        font-weight: 800;
        color: var(--text-main);
    }

    /* Topic Buttons */
    .topic-buttons-list {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .topic-btn-glossy {
        background: #FFFFFF;
        border: 1px solid #E2E8F0;
        border-radius: 12px;
        padding: 10px 12px;
        display: flex;
        align-items: center;
        gap: 10px;
        cursor: pointer;
        transition: all 0.2s;
        text-align: left;
    }

    .topic-btn-glossy:hover {
        border-color: #10B981;
        transform: translateY(-1px);
        box-shadow: 0 4px 10px rgba(16, 185, 129, 0.06);
    }

    .topic-icon {
        width: 32px;
        height: 32px;
        border-radius: 8px;
        background: rgba(16, 185, 129, 0.1);
        color: #10B981;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .topic-text strong {
        font-size: 12px;
        font-weight: 700;
        color: var(--text-main);
        display: block;
    }

    .topic-text span {
        font-size: 10.5px;
        color: var(--text-muted);
    }

    /* Chat Container Glossy */
    .chat-container-glossy {
        padding: 0;
        overflow: hidden;
        display: flex;
        flex-direction: column;
        height: 640px;
    }

    .chat-top-bar {
        padding: 16px 20px;
        background: #F8FAFC;
        border-bottom: 1px solid #E2E8F0;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .chat-copilot-info {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .copilot-title {
        font-size: 15px;
        font-weight: 800;
        color: var(--text-main);
        margin: 0;
    }

    .copilot-sub {
        font-size: 11.5px;
        color: var(--text-muted);
    }

    /* Chat Stream */
    .chat-messages-stream {
        flex: 1;
        padding: 20px;
        overflow-y: auto;
        display: flex;
        flex-direction: column;
        gap: 16px;
        background: linear-gradient(180deg, #FFFFFF 0%, #F8FAFC 100%);
    }

    .chat-date-pill {
        text-align: center;
        font-size: 10.5px;
        font-weight: 800;
        color: #94A3B8;
        letter-spacing: 0.5px;
        margin-bottom: 8px;
    }

    .msg-row {
        display: flex;
        gap: 12px;
        max-width: 85%;
    }

    .ai-row {
        align-self: flex-start;
    }

    .user-row {
        align-self: flex-end;
        flex-direction: row-reverse;
    }

    .msg-avatar-ai {
        width: 32px;
        height: 32px;
        border-radius: 10px;
        background: #10B981;
        color: #FFFFFF;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .msg-avatar-user {
        width: 32px;
        height: 32px;
        border-radius: 10px;
        object-fit: cover;
        flex-shrink: 0;
    }

    .msg-bubble-ai {
        background: #FFFFFF;
        border: 1px solid #E2E8F0;
        border-radius: 16px;
        border-top-left-radius: 4px;
        padding: 14px 18px;
        font-size: 13px;
        color: var(--text-main);
        line-height: 1.55;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.02);
    }

    .msg-bubble-user {
        background: #0B131B;
        color: #FFFFFF;
        border-radius: 16px;
        border-top-right-radius: 4px;
        padding: 14px 18px;
        font-size: 13px;
        line-height: 1.5;
        box-shadow: 0 4px 14px rgba(11, 19, 27, 0.2);
    }

    .msg-time-ai {
        display: block;
        font-size: 10.5px;
        color: #94A3B8;
        margin-top: 6px;
    }

    .msg-time-user {
        display: block;
        font-size: 10.5px;
        color: #64748B;
        margin-top: 4px;
        text-align: right;
    }

    /* Input Bar */
    .chat-input-wrapper {
        padding: 14px 18px;
        background: #FFFFFF;
        border-top: 1px solid #E2E8F0;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .chat-input-field {
        flex: 1;
        background: #F8FAFC;
        border: 1px solid #E2E8F0;
        border-radius: 12px;
        padding: 11px 16px;
        font-size: 13px;
        color: var(--text-main);
        outline: none;
        transition: all 0.2s;
    }

    .chat-input-field:focus {
        border-color: #10B981;
        background: #FFFFFF;
        box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
    }

    .btn-send-glossy {
        background: #0B131B;
        color: #CCFF00;
        border: none;
        border-radius: 12px;
        padding: 11px 18px;
        font-size: 13px;
        font-weight: 800;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: all 0.2s;
    }

    .btn-send-glossy:hover {
        background: #162432;
        transform: translateY(-1px);
    }

    @media (max-width: 1024px) {
        .dash-columns {
            grid-template-columns: 1fr !important;
        }
    }
</style>
@endpush

@push('scripts')
<script>
    let isVoiceAIActive = false;

    function toggleVoiceAI() {
        isVoiceAIActive = !isVoiceAIActive;
        const btn = document.getElementById('btnToggleVoiceAI');
        const lbl = document.getElementById('voiceAILabel');
        const icon = document.getElementById('voiceAIIcon');

        if (isVoiceAIActive) {
            btn.style.background = 'rgba(16, 185, 129, 0.15)';
            btn.style.borderColor = '#10B981';
            btn.style.color = '#10B981';
            lbl.textContent = 'Voice AI: Aktif';
            showToast('Voice AI Aktif: Kesimpulan jawaban AI akan dibacakan otomatis.');
            // Test speak confirmation
            speakExecutiveSummary('Voice AI aktif. Saya akan membacakan inti ringkasan jawaban untuk Juragan.');
        } else {
            if ('speechSynthesis' in window) {
                window.speechSynthesis.cancel();
            }
            btn.style.background = '';
            btn.style.borderColor = '#334155';
            btn.style.color = '';
            lbl.textContent = 'Voice AI: Nonaktif';
            showToast('Voice AI dinonaktifkan.');
        }
    }

    function extractExecutiveSummary(rawText) {
        if (!rawText) return '';
        // 1. Remove markdown bold, headers, list tokens, backticks, urls
        let clean = rawText
            .replace(/#{1,6}\s+/g, '')
            .replace(/\*\*(.*?)\*\*/g, '$1')
            .replace(/\*(.*?)\*/g, '$1')
            .replace(/`{1,3}[^`]*`{1,3}/g, '')
            .replace(/\[(.*?)\]\(.*?\)/g, '$1')
            .replace(/^[\*\-\•\d+\.]\s+/gm, '')
            .replace(/<[^>]+>/g, ' ')
            .replace(/\s+/g, ' ')
            .trim();

        // 2. Look for summary sentences or keywords like "Kesimpulan", "Rekomendasi", "Saran"
        const sentences = clean.split(/(?<=[.!?])\s+/).filter(s => s.trim().length > 10);
        
        let summary = '';
        // Find if any sentence explicitly contains recommendation/conclusion
        const highlightSentence = sentences.find(s => 
            /kesimpulan|rekomendasi|saran|langkah|solusi|peluang|sebaiknya/i.test(s)
        );

        if (highlightSentence && highlightSentence.length < 200) {
            summary = highlightSentence;
        } else if (sentences.length > 0) {
            // Take the first 1-2 concise sentences
            summary = sentences.slice(0, 2).join(' ');
        } else {
            summary = clean.slice(0, 180);
        }

        if (summary.length > 220) {
            summary = summary.slice(0, 217) + '...';
        }
        return summary;
    }

    function speakExecutiveSummary(rawText) {
        if (!('speechSynthesis' in window)) {
            showToast('Browser Anda belum mendukung text-to-speech.');
            return;
        }

        const summaryText = extractExecutiveSummary(rawText);
        if (!summaryText) return;

        window.speechSynthesis.cancel(); // Stop current speech
        const utterance = new SpeechSynthesisUtterance(summaryText);
        utterance.lang = 'id-ID';
        utterance.rate = 1.05;
        utterance.pitch = 1.0;

        // Try to pick Indonesian voice if available
        const voices = window.speechSynthesis.getVoices();
        const idVoice = voices.find(v => v.lang.startsWith('id') || v.lang.includes('ID') || v.name.toLowerCase().includes('indonesia'));
        if (idVoice) {
            utterance.voice = idVoice;
        }

        window.speechSynthesis.speak(utterance);
        showToast('Memutar suara ringkasan AI...');
    }

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
            <div class="msg-row user-row">
                <img class="msg-avatar-user" src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=60&auto=format&fit=crop&q=80" alt="User">
                <div class="msg-bubble-user">
                    <p style="margin: 0;">${text}</p>
                    <span class="msg-time-user">Baru saja • Terkirim</span>
                </div>
            </div>
        `;
        stream.insertAdjacentHTML('beforeend', userHtml);
        input.value = '';
        stream.scrollTop = stream.scrollHeight;

        // Loading Indicator
        const loadingId = 'aiLoading_' + Date.now();
        const loadingHtml = `
            <div id="${loadingId}" class="msg-row ai-row">
                <div class="msg-avatar-ai">
                    <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.813 15.904 9 18.75l-.813-2.846a4.5 4.5 0 0 0-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 0 0 3.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 0 0 3.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 0 0-3.09 3.09Z"/></svg>
                </div>
                <div class="msg-bubble-ai" style="color: #64748B; font-style: italic;">
                    <p style="margin: 0;">Juragan AI sedang menganalisis data gerai Anda...</p>
                </div>
            </div>
        `;
        stream.insertAdjacentHTML('beforeend', loadingHtml);
        stream.scrollTop = stream.scrollHeight;

        // Call Backend API
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
            
            // Clean Markdown format
            replyText = replyText
                .replace(/^---$/gm, '')
                .replace(/^#{1,4}\s*(.*)$/gm, '<strong style="color: #0F172A; display: block; margin: 10px 0 4px 0; font-size: 13.5px;">$1</strong>')
                .replace(/\*\*(.*?)\*\*/g, '<strong>$1</strong>')
                .replace(/\*(.*?)\*/g, '<em>$1</em>')
                .replace(/^[\*\-]\s+(.*)$/gm, '<span style="display: block; margin-left: 10px;">• $1</span>')
                .replace(/\n\n+/g, '<br><br>')
                .replace(/\n/g, '<br>');

            let actionHtml = '';
            if (data.action && (data.action.type === 'stock_updated' || data.action.type === 'stock_created')) {
                actionHtml = `
                    <div style="margin-top: 12px; background: rgba(16, 185, 129, 0.08); border: 1px solid rgba(16, 185, 129, 0.3); border-radius: 10px; padding: 12px 14px;">
                        <div style="display: flex; align-items: center; gap: 8px; font-weight: 700; color: #10B981; font-size: 13px;">
                            <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/></svg>
                            <span>EKSEKUSI STOK BERHASIL</span>
                        </div>
                        <div style="font-size: 12px; color: #334155; margin-top: 5px;">
                            Produk: <strong>${data.action.product_name}</strong> &bull; Perubahan: <span style="font-weight: 800; color: #10B981;">${data.action.delta} unit</span> &bull; Total Stok Sekarang: <strong>${data.action.new_stock} unit</strong>
                        </div>
                    </div>
                `;
            }

            let suggestionsHtml = '';
            if (data.suggestions && data.suggestions.length > 0) {
                let chips = data.suggestions.map(sug => {
                    if (sug.type === 'button') {
                        return `<button type="button" onclick="executeAiAction('${sug.action}')" style="display: inline-flex; align-items: center; gap: 6px; padding: 6px 14px; border-radius: 8px; background: linear-gradient(135deg, #10B981, #059669); color: #FFFFFF; font-size: 12px; font-weight: 700; border: none; cursor: pointer; box-shadow: 0 2px 6px rgba(16, 185, 129, 0.3); transition: all 0.2s;" onmouseover="this.style.transform='translateY(-1px)'" onmouseout="this.style.transform='none'">${sug.label}</button>`;
                    } else {
                        return `<a href="${sug.url}" style="display: inline-flex; align-items: center; gap: 6px; padding: 6px 12px; border-radius: 8px; background: #0B131B; color: #34D399; font-size: 12px; font-weight: 700; text-decoration: none; border: 1px solid rgba(52, 211, 153, 0.3); transition: all 0.2s;" onmouseover="this.style.background='#10B981'; this.style.color='#FFFFFF'" onmouseout="this.style.background='#0B131B'; this.style.color='#34D399'">${sug.label}</a>`;
                    }
                }).join('');

                suggestionsHtml = `
                    <div style="display: flex; flex-wrap: wrap; gap: 8px; margin-top: 14px; padding-top: 12px; border-top: 1px dashed rgba(0,0,0,0.1);">
                        ${chips}
                    </div>
                `;
            }

            const aiHtml = `
                <div class="msg-row ai-row">
                    <div class="msg-avatar-ai">
                        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.813 15.904 9 18.75l-.813-2.846a4.5 4.5 0 0 0-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 0 0 3.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 0 0 3.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 0 0-3.09 3.09Z"/></svg>
                    </div>
                    <div class="msg-bubble-ai">
                        <div style="margin: 0; line-height: 1.6;">${replyText}</div>
                        ${actionHtml}
                        ${suggestionsHtml}
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 8px; pt: 4px;">
                            <span class="msg-time-ai">${data.timestamp || 'Baru saja'} • Juragan AI Live</span>
                            <button type="button" onclick="speakExecutiveSummary(decodeURIComponent('${encodeURIComponent(data.reply || '')}'))" style="background: rgba(16, 185, 129, 0.1); border: 1px solid rgba(16, 185, 129, 0.3); color: #10B981; font-size: 11px; font-weight: 700; padding: 4px 10px; border-radius: 6px; cursor: pointer; display: inline-flex; align-items: center; gap: 5px;">
                                <svg width="13" height="13" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.114 5.636a9 9 0 0 1 0 12.728M16.463 8.288a5.25 5.25 0 0 1 0 7.424M6.75 8.25l4.72-4.72a.75.75 0 0 1 1.28.53v15.88a.75.75 0 0 1-1.28.53l-4.72-4.72H4.51c-.88 0-1.704-.507-1.938-1.354A9.009 9.009 0 0 1 2.25 12c0-.83.112-1.633.322-2.396C2.806 8.757 3.63 8.25 4.51 8.25H6.75Z"/></svg>
                                <span>Dengarkan Kesimpulan</span>
                            </button>
                        </div>
                    </div>
                </div>
            `;
            stream.insertAdjacentHTML('beforeend', aiHtml);
            stream.scrollTop = stream.scrollHeight;

            if (isVoiceAIActive && data.reply) {
                speakExecutiveSummary(data.reply);
            }
        })
        .catch(error => {
            const loadingElem = document.getElementById(loadingId);
            if (loadingElem) loadingElem.remove();

            const errorHtml = `
                <div class="msg-row ai-row">
                    <div class="msg-avatar-ai">
                        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.813 15.904 9 18.75l-.813-2.846a4.5 4.5 0 0 0-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 0 0 3.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 0 0 3.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 0 0-3.09 3.09Z"/></svg>
                    </div>
                    <div class="msg-bubble-ai" style="border-left: 3px solid #DC2626;">
                        <p style="margin: 0;">Koneksi ke AI Cloud terputus. Silakan ulangi pertanyaan Anda, Juragan.</p>
                        <span class="msg-time-ai">Gagal sinkronisasi</span>
                    </div>
                </div>
            `;
            stream.insertAdjacentHTML('beforeend', errorHtml);
            stream.scrollTop = stream.scrollHeight;
        });
    }

    function executeAiAction(actionName) {
        showToast('Memproses instruksi otomatis Juragan AI...');
        fetch("{{ route('juragan.action_execute') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ action: actionName })
        })
        .then(res => res.json())
        .then(res => {
            if (res.status === 'success') {
                if (typeof larisAlert === 'function') {
                    larisAlert('Aksi AI Berhasil Dijalankan!', res.message, 'success');
                } else {
                    showToast(res.message);
                }
                const stream = document.getElementById('chatStream');
                const successMsgHtml = `
                    <div class="msg-row ai-row">
                        <div class="msg-avatar-ai">
                            <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.813 15.904 9 18.75l-.813-2.846a4.5 4.5 0 0 0-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 0 0 3.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 0 0 3.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 0 0-3.09 3.09Z"/></svg>
                        </div>
                        <div class="msg-bubble-ai">
                            <p style="margin: 0; font-weight: 700; color: #10B981; display: flex; align-items: center; gap: 6px;"><svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="m4.5 12.75 6 6 9-13.5"/></svg> <span>Instruksi Selesai: ${res.message}</span></p>
                            <div style="margin-top: 10px; display: flex; gap: 8px; flex-wrap: wrap;">
                                <a href="{{ route('inventory.index') }}" style="display: inline-flex; align-items: center; gap: 6px; padding: 6px 12px; border-radius: 8px; background: #0B131B; color: #34D399; font-size: 12px; font-weight: 700; text-decoration: none; border: 1px solid rgba(52, 211, 153, 0.3);">Lihat di Smart Inventory ↗</a>
                                <a href="{{ route('predict.index') }}" style="display: inline-flex; align-items: center; gap: 6px; padding: 6px 12px; border-radius: 8px; background: #0B131B; color: #34D399; font-size: 12px; font-weight: 700; text-decoration: none; border: 1px solid rgba(52, 211, 153, 0.3);">Uji di LARIS Predict ↗</a>
                            </div>
                            <span class="msg-time-ai">Baru saja • Juragan AI Engine</span>
                        </div>
                    </div>
                `;
                stream.insertAdjacentHTML('beforeend', successMsgHtml);
                stream.scrollTop = stream.scrollHeight;
            } else {
                if (typeof larisAlert === 'function') {
                    larisAlert('Gagal Eksekusi', res.message || 'Terjadi kesalahan sistem.', 'warning');
                } else {
                    showToast(res.message || 'Gagal eksekusi aksi.');
                }
            }
        })
        .catch(err => {
            showToast('Gagal menghubungi server aksi.');
        });
    }

    function showToast(message) {
        const toast = document.createElement('div');
        toast.style.position = 'fixed';
        toast.style.bottom = '24px';
        toast.style.right = '24px';
        toast.style.background = '#0B131B';
        toast.style.color = '#CCFF00';
        toast.style.border = '1px solid #10B981';
        toast.style.padding = '12px 20px';
        toast.style.borderRadius = '12px';
        toast.style.fontSize = '12.5px';
        toast.style.fontWeight = '700';
        toast.style.boxShadow = '0 10px 25px rgba(0,0,0,0.3)';
        toast.style.zIndex = '9999';
        toast.textContent = message;

        document.body.appendChild(toast);
        setTimeout(() => {
            toast.style.opacity = '0';
            setTimeout(() => toast.remove(), 400);
        }, 3200);
    }
</script>
@endpush
