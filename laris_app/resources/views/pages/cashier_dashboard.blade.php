@extends('layouts.app', ['title' => 'Dashboard Kasir & Smart POS - LARIS'])

@push('styles')
<style>
    .pos-top-bar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        background: #0E161A;
        border: 1px solid #1E2D33;
        border-radius: 16px;
        padding: 20px 24px;
        color: #FFFFFF;
    }
    .pos-main-grid {
        display: grid;
        grid-template-columns: 2fr 1.2fr;
        gap: 24px;
    }
    @media (max-width: 900px) {
        .pos-top-bar {
            flex-direction: column;
            align-items: stretch;
            gap: 16px;
        }
        .pos-top-bar > div:last-child {
            text-align: left !important;
            border-top: 1px solid #1E2D33;
            padding-top: 12px;
        }
        .pos-main-grid {
            grid-template-columns: 1fr;
            gap: 16px;
        }
    }
</style>
@endpush

@section('content')
<div style="display: flex; flex-direction: column; gap: 24px;">

    <!-- TOP BAR KASIR -->
    <div class="pos-top-bar">
        <div>
            <div style="display: inline-flex; align-items: center; gap: 8px; background: rgba(204, 255, 0, 0.15); color: #CCFF00; font-size: 11px; font-weight: 700; padding: 4px 10px; border-radius: 20px; margin-bottom: 6px;">
                <span style="width: 7px; height: 7px; background: #CCFF00; border-radius: 50%;"></span>
                SMART POS KASIR ONLINE
            </div>
            <h1 style="font-size: 22px; font-weight: 800;">Mesin Kasir Cepat (Point of Sale)</h1>
            <p style="color: #94A3B8; font-size: 13px;">Shift Aktif: <strong>Rian Kasir</strong> • Kasir Standby Siap Transaksi</p>
        </div>
        <div style="text-align: right;">
            <span style="font-size: 11px; color: #94A3B8; text-transform: uppercase; font-weight: 700;">Omzet Kasir Hari Ini</span>
            <h2 style="font-size: 26px; font-weight: 800; color: #CCFF00;">Rp {{ number_format($todayTotal, 0, ',', '.') }}</h2>
            <span style="font-size: 12px; color: #94A3B8;">{{ $todayCount }} Struk Transaksi Selesai</span>
        </div>
    </div>

    <!-- GRID KATALOG PRODUK KASIR & STRUK CHECKOUT -->
    <div class="pos-main-grid">
        
        <!-- KATALOG PRODUK CEPAT -->
        <div class="card-panel">
            <h3 style="font-size: 16px; font-weight: 700; margin-bottom: 16px; display: flex; align-items: center; gap: 8px;">
                <span>🛒</span> Katalog Produk Siap Jual
            </h3>

            <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 16px;">
                @foreach($products as $prod)
                    <div style="border: 1px solid #E2E8F0; border-radius: 12px; padding: 14px; background: #FFFFFF; display: flex; flex-direction: column; justify-content: space-between; transition: all 0.2s;" onmouseover="this.style.borderColor='#CCFF00'; this.style.transform='translateY(-2px)'" onmouseout="this.style.borderColor='#E2E8F0'; this.style.transform='none'">
                        <div>
                            <span style="font-size: 11px; color: #64748B; font-weight: 600;">SKU: {{ $prod->sku }}</span>
                            <h4 style="font-size: 13px; font-weight: 700; margin: 4px 0 8px 0; color: #0F172A;">{{ $prod->name }}</h4>
                            <div style="font-size: 15px; font-weight: 800; color: #16A34A;">Rp {{ number_format($prod->selling_price, 0, ',', '.') }}</div>
                            <span style="font-size: 11px; color: #64748B;">Sisa Stok: <strong>{{ $prod->current_stock }} unit</strong></span>
                        </div>
                        <button onclick="quickAdd({{ $prod->id }}, '{{ addslashes($prod->name) }}', {{ $prod->selling_price }})" style="margin-top: 12px; width: 100%; background: #0B1215; color: #CCFF00; border: none; padding: 8px; border-radius: 8px; font-weight: 700; font-size: 12px; cursor: pointer;">
                            + Tambah ke Struk
                        </button>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- STRUK CHECKOUT KASIR -->
        <div class="card-panel" style="display: flex; flex-direction: column; justify-content: space-between;">
            <div>
                <h3 style="font-size: 16px; font-weight: 700; margin-bottom: 16px; border-bottom: 1px solid #E2E8F0; padding-bottom: 12px;">
                    🧾 Struk Transaksi Baru
                </h3>

                <div id="cartItems" style="display: flex; flex-direction: column; gap: 10px; max-height: 280px; overflow-y: auto; margin-bottom: 16px;">
                    <p id="emptyCartText" style="text-align: center; color: #94A3B8; font-size: 13px; padding: 24px 0;">Belum ada produk yang dipilih.</p>
                </div>
            </div>

            <div style="border-top: 1px solid #E2E8F0; padding-top: 16px;">
                <div style="display: flex; justify-content: space-between; margin-bottom: 8px;">
                    <span style="color: #64748B; font-size: 13px;">Metode Pembayaran:</span>
                    <select id="payMethod" style="background: #F1F5F9; border: 1px solid #CBD5E1; padding: 4px 8px; border-radius: 6px; font-size: 12px; font-weight: 600;">
                        <option value="QRIS">QRIS Statis/Dinamis</option>
                        <option value="Tunai">Tunai / Cash</option>
                        <option value="Debit">Kartu Debit</option>
                    </select>
                </div>
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px;">
                    <strong style="font-size: 15px;">Total Bayar:</strong>
                    <strong id="cartTotal" style="font-size: 20px; color: #16A34A;">Rp 0</strong>
                </div>
                <button onclick="submitCheckout()" style="width: 100%; background: #CCFF00; color: #000000; border: none; padding: 14px; border-radius: 10px; font-size: 14px; font-weight: 800; cursor: pointer; box-shadow: 0 4px 14px rgba(204, 255, 0, 0.3);">
                    PROSES BAYAR (F8) &rarr;
                </button>
            </div>
        </div>

    </div>

</div>

<script>
    let cart = [];

    function quickAdd(id, name, price) {
        let existing = cart.find(i => i.id === id);
        if (existing) {
            existing.qty += 1;
        } else {
            cart.push({ id, name, price, qty: 1 });
        }
        renderCart();
    }

    function renderCart() {
        let container = document.getElementById('cartItems');
        let emptyText = document.getElementById('emptyCartText');
        if (cart.length === 0) {
            container.innerHTML = '<p id="emptyCartText" style="text-align: center; color: #94A3B8; font-size: 13px; padding: 24px 0;">Belum ada produk yang dipilih.</p>';
            document.getElementById('cartTotal').innerText = 'Rp 0';
            return;
        }

        let total = 0;
        let html = '';
        cart.forEach((item, index) => {
            let sub = item.price * item.qty;
            total += sub;
            html += `
                <div style="display: flex; justify-content: space-between; align-items: center; background: #F8FAF9; padding: 8px 12px; border-radius: 8px; font-size: 13px;">
                    <div>
                        <strong>${item.name}</strong>
                        <div style="color: #64748B; font-size: 11px;">Rp ${item.price.toLocaleString('id-ID')} x ${item.qty}</div>
                    </div>
                    <div style="font-weight: 700; color: #0F172A;">Rp ${sub.toLocaleString('id-ID')}</div>
                </div>
            `;
        });

        container.innerHTML = html;
        document.getElementById('cartTotal').innerText = 'Rp ' + total.toLocaleString('id-ID');
    }

    function submitCheckout() {
        if (cart.length === 0) {
            alert('Pilih minimal satu produk untuk transaksi!');
            return;
        }

        let payload = {
            channel: 'Offline Store',
            payment_method: document.getElementById('payMethod').value,
            items: cart.map(i => ({ product_id: i.id, quantity: i.qty }))
        };

        fetch("{{ route('pos.checkout') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify(payload)
        })
        .then(res => res.json())
        .then(data => {
            if (data.status === 'success') {
                alert('Transaksi Kasir Berhasil! Struk ' + data.data.order_number + ' senilai Rp ' + data.data.total_amount.toLocaleString('id-ID') + ' tercatat.');
                cart = [];
                location.reload();
            } else {
                alert('Gagal memproses transaksi: ' + data.message);
            }
        });
    }
</script>
@endsection
