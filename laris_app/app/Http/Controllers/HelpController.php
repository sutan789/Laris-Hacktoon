<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HelpController extends Controller
{
    public function index()
    {
        $faqs = [
            [
                'question' => 'Bagaimana cara kerja LARIS Predict ("What If I Sell This?")?',
                'category' => 'Predict',
                'answer' => 'LARIS Predict menggunakan model Explainable AI (XAI) yang menganalisis historis data produk serupa, elastisitas harga, sinyal pencarian pasar, serta struktur biaya HPP untuk memproyeksikan potensi penjualan mingguan, ROI, dan estimasi laba bersih sebelum Anda membeli stok fisik.'
            ],
            [
                'question' => 'Dari mana sinyal di Trend Hunter diperoleh?',
                'category' => 'Trends',
                'answer' => 'Sinyal pasar dikumpulkan dari marketplace lokal (Shopee, Tokopedia, TikTok Shop) serta tren pencarian regional di Indonesia. Algoritma LARIS menghitung Growth Velocity (%) dan Viral Score untuk memilah produk yang benar-benar memiliki lonjakan permintaan nyata.'
            ],
            [
                'question' => 'Bagaimana cara kerja Auto-Bundle Purchase Order (PO)?',
                'category' => 'Inventory',
                'answer' => 'Sistem Smart Inventory memantau sisa hari runway stok secara berkala. Ketika beberapa item mendekati batas kritis, AI otomatis menggabungkan kebutuhan restock dari supplier yang sama menjadi satu PO kolektif, sehingga toko mendapatkan diskon ongkos kirim dan penghematan biaya logistik rata-rata 18%.'
            ],
            [
                'question' => 'Apakah data keuangan dan transaksi kasir saya aman?',
                'category' => 'Keamanan',
                'answer' => 'Ya. Data transaksi POS dan margin toko Anda disimpan secara aman dan diisolasi per toko (Multi-Tenant). Data tidak pernah dibagikan kepada pihak ketiga dan hanya diproses secara privat oleh AI engine untuk memberikan rekomendasi kepada akun Anda.'
            ],
            [
                'question' => 'Bagaimana jika ingin menghubungkan kasir fisik atau cabang baru?',
                'category' => 'Integrasi',
                'answer' => 'Anda dapat mendaftarkan staf kasir baru di menu Pengguna atau menghubungkan POS hardware Anda melalui API POS LARIS yang tersedia di menu Settings -> Integrasi Channel.'
            ],
        ];

        return view('pages.help', compact('faqs'));
    }
}
