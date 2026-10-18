<!-- LARIS INTERACTIVE ANIMATED ALERT & CONFIRMATION MODAL SYSTEM -->
<div id="larisAlertBackdrop" class="laris-alert-backdrop" style="display: none;">
    <div id="larisAlertCard" class="laris-alert-card" role="dialog" aria-modal="true">
        <!-- ICON CONTAINER -->
        <div id="larisAlertIconBox" class="laris-alert-icon-box info">
            <!-- SUCCESS ICON -->
            <div class="icon-svg icon-success" style="display: none;">
                <svg width="34" height="34" fill="none" stroke="#10B981" viewBox="0 0 24 24">
                    <circle cx="12" cy="12" r="10" stroke-width="2" stroke-opacity="0.25" fill="#ECFDF5"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="m8.5 12.5 2.5 2.5 5-5.5"/>
                </svg>
            </div>
            <!-- INFO ICON -->
            <div class="icon-svg icon-info" style="display: none;">
                <svg width="34" height="34" fill="none" stroke="#0284C7" viewBox="0 0 24 24">
                    <circle cx="12" cy="12" r="10" stroke-width="2" stroke-opacity="0.25" fill="#F0F9FF"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8.5v.01M12 12v4"/>
                </svg>
            </div>
            <!-- WARNING ICON -->
            <div class="icon-svg icon-warning" style="display: none;">
                <svg width="34" height="34" fill="none" stroke="#F59E0B" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M12 9v4m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" fill="#FFFBEB"/>
                </svg>
            </div>
            <!-- ERROR ICON -->
            <div class="icon-svg icon-error" style="display: none;">
                <svg width="34" height="34" fill="none" stroke="#EF4444" viewBox="0 0 24 24">
                    <circle cx="12" cy="12" r="10" stroke-width="2" stroke-opacity="0.25" fill="#FEF2F2"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="m15 9-6 6m0-6 6 6"/>
                </svg>
            </div>
        </div>

        <!-- CONTENT -->
        <h3 id="larisAlertTitle" class="laris-alert-title">Pemberitahuan Sistem</h3>
        <div id="larisAlertMsg" class="laris-alert-msg">Pesan sistem...</div>

        <!-- BUTTONS CONTAINER -->
        <div class="laris-alert-actions">
            <button type="button" id="larisAlertCancelBtn" class="laris-btn-cancel" style="display: none;">Batal</button>
            <button type="button" id="larisAlertConfirmBtn" class="laris-btn-confirm">Oke, Mengerti</button>
        </div>
    </div>
</div>

<style>
    /* BACKDROP */
    .laris-alert-backdrop {
        position: fixed;
        inset: 0;
        background: rgba(11, 19, 27, 0.72);
        backdrop-filter: blur(14px);
        -webkit-backdrop-filter: blur(14px);
        z-index: 9999999;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
        opacity: 0;
        pointer-events: none;
        transition: opacity 0.25s cubic-bezier(0.16, 1, 0.3, 1);
    }

    .laris-alert-backdrop.active {
        opacity: 1;
        pointer-events: auto;
    }

    /* CARD DIALOG */
    .laris-alert-card {
        background: #FFFFFF;
        border: 1px solid rgba(16, 185, 129, 0.28);
        border-radius: 22px;
        width: 100%;
        max-width: 440px;
        padding: 30px 26px 26px;
        box-shadow: 0 25px 60px -15px rgba(0, 0, 0, 0.45), 0 0 0 1px rgba(255, 255, 255, 0.2);
        text-align: center;
        transform: scale(0.85) translateY(20px);
        transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
        position: relative;
        overflow: hidden;
    }

    .laris-alert-backdrop.active .laris-alert-card {
        transform: scale(1) translateY(0);
    }

    /* ICON BOX WITH RIPPLE */
    .laris-alert-icon-box {
        width: 68px;
        height: 68px;
        border-radius: 22px;
        margin: 0 auto 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        animation: larisIconPulse 2s infinite;
    }

    .laris-alert-icon-box.success {
        background: #ECFDF5;
        border: 2px solid #10B981;
        box-shadow: 0 8px 20px rgba(16, 185, 129, 0.25);
    }
    .laris-alert-icon-box.info {
        background: #F0F9FF;
        border: 2px solid #0284C7;
        box-shadow: 0 8px 20px rgba(2, 132, 199, 0.25);
    }
    .laris-alert-icon-box.warning {
        background: #FFFBEB;
        border: 2px solid #F59E0B;
        box-shadow: 0 8px 20px rgba(245, 158, 11, 0.25);
    }
    .laris-alert-icon-box.error {
        background: #FEF2F2;
        border: 2px solid #EF4444;
        box-shadow: 0 8px 20px rgba(239, 68, 68, 0.25);
    }

    @keyframes larisIconPulse {
        0% { transform: scale(0.96); }
        50% { transform: scale(1.04); }
        100% { transform: scale(0.96); }
    }

    /* TITLE & MESSAGE */
    .laris-alert-title {
        font-size: 18.5px;
        font-weight: 800;
        color: #0F172A;
        margin: 0 0 10px 0;
        letter-spacing: -0.02em;
        line-height: 1.3;
    }

    .laris-alert-msg {
        font-size: 13.5px;
        color: #475569;
        line-height: 1.6;
        margin: 0 0 24px 0;
        font-weight: 500;
        word-break: break-word;
    }

    .laris-alert-msg strong {
        color: #0F172A;
        font-weight: 700;
    }

    /* ACTIONS */
    .laris-alert-actions {
        display: flex;
        gap: 12px;
        justify-content: center;
        align-items: center;
    }

    .laris-btn-cancel {
        flex: 1;
        background: #F1F5F9;
        border: 1px solid #E2E8F0;
        color: #475569;
        font-size: 13.5px;
        font-weight: 700;
        padding: 12px 18px;
        border-radius: 12px;
        cursor: pointer;
        transition: all 0.2s;
        outline: none;
    }
    .laris-btn-cancel:hover {
        background: #E2E8F0;
        color: #1E293B;
    }

    .laris-btn-confirm {
        flex: 1;
        background: #0B131B;
        border: 1px solid rgba(204, 255, 0, 0.4);
        color: #CCFF00;
        font-size: 13.5px;
        font-weight: 800;
        padding: 12px 22px;
        border-radius: 12px;
        cursor: pointer;
        transition: all 0.2s;
        box-shadow: 0 4px 14px rgba(11, 19, 27, 0.2);
        outline: none;
    }
    .laris-btn-confirm:hover {
        background: #10B981;
        color: #FFFFFF;
        border-color: #10B981;
        transform: translateY(-1px);
        box-shadow: 0 6px 18px rgba(16, 185, 129, 0.35);
    }

    .laris-btn-confirm.theme-success {
        background: #10B981;
        color: #FFFFFF;
        border-color: #10B981;
        box-shadow: 0 4px 14px rgba(16, 185, 129, 0.3);
    }
    .laris-btn-confirm.theme-success:hover {
        background: #059669;
    }
</style>

<script>
    (function() {
        let currentResolve = null;
        let currentOnConfirm = null;
        let currentOnCancel = null;

        function closeLarisDialog() {
            const backdrop = document.getElementById('larisAlertBackdrop');
            if (!backdrop) return;
            backdrop.classList.remove('active');
            setTimeout(() => {
                backdrop.style.display = 'none';
            }, 250);
        }

        // Global Alert Dialog (Replacing native alert)
        window.larisAlert = function(titleOrMsg, message = null, type = 'info', onConfirm = null) {
            return new Promise((resolve) => {
                let title = 'Pemberitahuan Sistem';
                let msg = titleOrMsg;
                let actualType = type;

                if (message !== null) {
                    title = titleOrMsg;
                    msg = message;
                } else if (typeof titleOrMsg === 'string' && (titleOrMsg.includes('Voucher') || titleOrMsg.includes('Sukses') || titleOrMsg.includes('Berhasil'))) {
                    title = 'Sukses!';
                    actualType = 'success';
                }

                currentResolve = resolve;
                currentOnConfirm = onConfirm;
                currentOnCancel = null;

                const backdrop = document.getElementById('larisAlertBackdrop');
                const titleEl = document.getElementById('larisAlertTitle');
                const msgEl = document.getElementById('larisAlertMsg');
                const iconBox = document.getElementById('larisAlertIconBox');
                const cancelBtn = document.getElementById('larisAlertCancelBtn');
                const confirmBtn = document.getElementById('larisAlertConfirmBtn');

                if (!backdrop) return;

                // Set Content
                titleEl.innerText = title;
                msgEl.innerHTML = msg;

                // Configure Icon
                iconBox.className = 'laris-alert-icon-box ' + actualType;
                document.querySelectorAll('.laris-alert-icon-box .icon-svg').forEach(el => el.style.display = 'none');
                const activeIcon = document.querySelector('.laris-alert-icon-box .icon-' + actualType);
                if (activeIcon) activeIcon.style.display = 'block';

                // Single Button for Alert
                cancelBtn.style.display = 'none';
                confirmBtn.innerText = 'Oke, Mengerti';
                confirmBtn.className = 'laris-btn-confirm ' + (actualType === 'success' ? 'theme-success' : '');

                // Show Modal
                backdrop.style.display = 'flex';
                requestAnimationFrame(() => {
                    backdrop.classList.add('active');
                    confirmBtn.focus();
                });
            });
        };

        // Global Confirm Dialog (Replacing native confirm)
        window.larisConfirm = function(title, message, onConfirm = null, onCancel = null, confirmText = 'Ya, Lanjutkan', cancelText = 'Batal', type = 'warning') {
            return new Promise((resolve) => {
                currentResolve = resolve;
                currentOnConfirm = onConfirm;
                currentOnCancel = onCancel;

                const backdrop = document.getElementById('larisAlertBackdrop');
                const titleEl = document.getElementById('larisAlertTitle');
                const msgEl = document.getElementById('larisAlertMsg');
                const iconBox = document.getElementById('larisAlertIconBox');
                const cancelBtn = document.getElementById('larisAlertCancelBtn');
                const confirmBtn = document.getElementById('larisAlertConfirmBtn');

                if (!backdrop) return;

                titleEl.innerText = title;
                msgEl.innerHTML = message;

                iconBox.className = 'laris-alert-icon-box ' + type;
                document.querySelectorAll('.laris-alert-icon-box .icon-svg').forEach(el => el.style.display = 'none');
                const activeIcon = document.querySelector('.laris-alert-icon-box .icon-' + type);
                if (activeIcon) activeIcon.style.display = 'block';

                cancelBtn.style.display = 'block';
                cancelBtn.innerText = cancelText;
                confirmBtn.innerText = confirmText;
                confirmBtn.className = 'laris-btn-confirm theme-success';

                backdrop.style.display = 'flex';
                requestAnimationFrame(() => {
                    backdrop.classList.add('active');
                    confirmBtn.focus();
                });
            });
        };

        // Global Micro-Toast
        window.larisToast = function(msg, type = 'success', duration = 3200) {
            const toast = document.createElement('div');
            toast.style.position = 'fixed';
            toast.style.bottom = '24px';
            toast.style.right = '24px';
            toast.style.background = '#0B131B';
            toast.style.color = type === 'success' ? '#CCFF00' : '#FFFFFF';
            toast.style.border = '1px solid ' + (type === 'success' ? '#10B981' : '#334155');
            toast.style.padding = '12px 20px';
            toast.style.borderRadius = '14px';
            toast.style.fontSize = '13px';
            toast.style.fontWeight = '700';
            toast.style.boxShadow = '0 12px 30px rgba(0,0,0,0.35)';
            toast.style.zIndex = '99999999';
            toast.style.display = 'flex';
            toast.style.alignItems = 'center';
            toast.style.gap = '8px';
            toast.style.transform = 'translateY(15px) scale(0.95)';
            toast.style.opacity = '0';
            const iconSvg = type === 'success' 
                ? '<svg width="16" height="16" fill="none" stroke="#10B981" viewBox="0 0 24 24" style="flex-shrink:0;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="m4.5 12.75 6 6 9-13.5"/></svg>'
                : '<svg width="16" height="16" fill="none" stroke="#38BDF8" viewBox="0 0 24 24" style="flex-shrink:0;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z"/></svg>';
            toast.innerHTML = iconSvg + '<span>' + msg + '</span>';

            document.body.appendChild(toast);
            requestAnimationFrame(() => {
                toast.style.transform = 'translateY(0) scale(1)';
                toast.style.opacity = '1';
            });

            setTimeout(() => {
                toast.style.transform = 'translateY(10px) scale(0.9)';
                toast.style.opacity = '0';
                setTimeout(() => toast.remove(), 300);
            }, duration);
        };

        // OVERRIDE NATIVE WINDOW.ALERT GRACEFULLY
        const originalAlert = window.alert;
        window.alert = function(msg) {
            window.larisAlert('Pemberitahuan Sistem', msg, 'info');
        };

        // Button Click Handlers
        document.addEventListener('DOMContentLoaded', function() {
            const confirmBtn = document.getElementById('larisAlertConfirmBtn');
            const cancelBtn = document.getElementById('larisAlertCancelBtn');
            const backdrop = document.getElementById('larisAlertBackdrop');

            if (confirmBtn) {
                confirmBtn.addEventListener('click', function() {
                    closeLarisDialog();
                    if (typeof currentOnConfirm === 'function') currentOnConfirm();
                    if (typeof currentResolve === 'function') currentResolve(true);
                });
            }

            if (cancelBtn) {
                cancelBtn.addEventListener('click', function() {
                    closeLarisDialog();
                    if (typeof currentOnCancel === 'function') currentOnCancel();
                    if (typeof currentResolve === 'function') currentResolve(false);
                });
            }

            // Keyboard Listeners
            document.addEventListener('keydown', function(e) {
                if (!backdrop || !backdrop.classList.contains('active')) return;
                if (e.key === 'Escape') {
                    closeLarisDialog();
                    if (typeof currentOnCancel === 'function') currentOnCancel();
                    if (typeof currentResolve === 'function') currentResolve(false);
                } else if (e.key === 'Enter') {
                    closeLarisDialog();
                    if (typeof currentOnConfirm === 'function') currentOnConfirm();
                    if (typeof currentResolve === 'function') currentResolve(true);
                }
            });
        });
    })();
</script>
