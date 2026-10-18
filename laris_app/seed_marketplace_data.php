<?php

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\User;
use App\Models\Store;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

// 1. Seed / Update Super Admin
User::updateOrCreate(
    ['email' => 'superadmin@laris.id'],
    [
        'name' => 'Super Administrator Platform',
        'password' => Hash::make('password123'),
        'role' => 'super_admin',
    ]
);

// 2. Seed / Update User (Pembeli)
User::updateOrCreate(
    ['email' => 'user@laris.id'],
    [
        'name' => 'Budi Pratama (User)',
        'password' => Hash::make('password123'),
        'role' => 'user',
        'phone' => '081234567890',
    ]
);

User::updateOrCreate(
    ['email' => 'konsumen@laris.id'],
    [
        'name' => 'Siti Nurhaliza (User)',
        'password' => Hash::make('password123'),
        'role' => 'user',
        'phone' => '081298765432',
    ]
);

// 3. Seed Diverse UMKM Stores with Payment Details
$storesData = [
    [
        'id' => 1,
        'name' => 'Toko Berkah Sembako Utama',
        'owner_name' => 'Juragan Bambang',
        'category' => 'Sembako & Kelontong',
        'location' => 'Bandung Tengah',
        'address' => 'Jl. Asia Afrika No. 42, Bandung',
        'has_delivery' => true,
        'delivery_fee' => 5000,
        'delivery_radius_km' => 4,
        'rating' => 4.9,
        'description' => 'Pusat sembako lengkap beras, minyak, gula, telur, dan kebutuhan dapur warga sekitar.',
        'phone' => '081234567891',
        'operating_hours' => '06:00 - 22:00 WIB',
        'is_verified' => true,
        'banner_image' => 'https://images.unsplash.com/photo-1578916171728-46686eac8d58?w=800&auto=format&fit=crop&q=80',
        'qris_image' => 'https://images.unsplash.com/photo-1595079672139-545c6020c681?w=400&auto=format&fit=crop&q=80',
        'qris_nmid' => 'ID1029384756',
        'bank_name' => 'BCA (Bank Central Asia)',
        'bank_account_number' => '7820-192-381',
        'bank_account_name' => 'Toko Berkah Utama - Bambang',
    ],
    [
        'id' => 2,
        'name' => 'Dapur Nusantara & Kopi Kenangan',
        'owner_name' => 'Ibu Rahmawati',
        'category' => 'Kuliner & F&B',
        'location' => 'Bandung Wetan',
        'address' => 'Jl. R.E. Martadinata No. 88, Bandung',
        'has_delivery' => true,
        'delivery_fee' => 7000,
        'delivery_radius_km' => 6,
        'rating' => 4.8,
        'description' => 'Kuliner nusantara favorit, ayam geprek sambal korek pedas gurih, roti bakar dan aneka es kopi susu.',
        'phone' => '081234567892',
        'operating_hours' => '09:00 - 21:30 WIB',
        'is_verified' => true,
        'banner_image' => 'https://images.unsplash.com/photo-1555396273-367ea4eb4db5?w=800&auto=format&fit=crop&q=80',
        'qris_image' => 'https://images.unsplash.com/photo-1595079672139-545c6020c681?w=400&auto=format&fit=crop&q=80',
        'qris_nmid' => 'ID2039485711',
        'bank_name' => 'Bank Mandiri',
        'bank_account_number' => '1320-001-92834',
        'bank_account_name' => 'Dapur Nusantara - Rahmawati',
    ],
    [
        'id' => 3,
        'name' => 'Warung Padang Minang Saiyo',
        'owner_name' => 'Uda Herman',
        'category' => 'Kuliner & F&B',
        'location' => 'Bandung Kulon',
        'address' => 'Jl. Sudirman No. 115, Bandung',
        'has_delivery' => false, // SELF PICKUP ONLY!
        'delivery_fee' => 0,
        'delivery_radius_km' => 0,
        'rating' => 4.9,
        'description' => 'Masakan Padang otentik rendang sapi Minang, gulai tunjang, dan ayam pop. Layanan ambil langsung di tempat.',
        'phone' => '081234567893',
        'operating_hours' => '08:00 - 20:00 WIB',
        'is_verified' => true,
        'banner_image' => 'https://images.unsplash.com/photo-1544025162-d76694265947?w=800&auto=format&fit=crop&q=80',
        'qris_image' => 'https://images.unsplash.com/photo-1595079672139-545c6020c681?w=400&auto=format&fit=crop&q=80',
        'qris_nmid' => 'ID3049586722',
        'bank_name' => 'Bank BRI',
        'bank_account_number' => '0281-01-092837-50-1',
        'bank_account_name' => 'RM Padang Saiyo - Herman',
    ],
    [
        'id' => 4,
        'name' => 'Serambi Batik & Busana Etnik',
        'owner_name' => 'Mbak Maya Lestari',
        'category' => 'Fashion & Pakaian',
        'location' => 'Bandung Selatan',
        'address' => 'Jl. Buah Batu No. 67, Bandung',
        'has_delivery' => true,
        'delivery_fee' => 10000,
        'delivery_radius_km' => 10,
        'rating' => 4.7,
        'description' => 'Koleksi kemeja batik tulis pria, kain tenun tradisional, gamis casual, dan hijab voal premium.',
        'phone' => '081234567894',
        'operating_hours' => '10:00 - 20:00 WIB',
        'is_verified' => true,
        'banner_image' => 'https://images.unsplash.com/photo-1441986300917-64674bd600d8?w=800&auto=format&fit=crop&q=80',
        'qris_image' => 'https://images.unsplash.com/photo-1595079672139-545c6020c681?w=400&auto=format&fit=crop&q=80',
        'qris_nmid' => 'ID4059687833',
        'bank_name' => 'Bank Syariah Indonesia (BSI)',
        'bank_account_number' => '7182-938-401',
        'bank_account_name' => 'Serambi Batik - Maya',
    ],
    [
        'id' => 5,
        'name' => 'Kriya Anyaman Bambu & Rotan Indah',
        'owner_name' => 'Pak Joko Santoso',
        'category' => 'Kerajinan & Kriya',
        'location' => 'Bandung Utara',
        'address' => 'Jl. Setiabudi No. 140, Bandung',
        'has_delivery' => false, // SELF PICKUP ONLY!
        'delivery_fee' => 0,
        'delivery_radius_km' => 0,
        'rating' => 4.8,
        'description' => 'Kerajinan tangan lokal ramah lingkungan: keranjang rotan multifungsi, vas bunga bambu, tudung saji rajut.',
        'phone' => '081234567895',
        'operating_hours' => '08:30 - 17:00 WIB',
        'is_verified' => true,
        'banner_image' => 'https://images.unsplash.com/photo-1513519245088-0e12902e5a38?w=800&auto=format&fit=crop&q=80',
        'qris_image' => 'https://images.unsplash.com/photo-1595079672139-545c6020c681?w=400&auto=format&fit=crop&q=80',
        'qris_nmid' => 'ID5069788944',
        'bank_name' => 'Bank BCA',
        'bank_account_number' => '8920-112-901',
        'bank_account_name' => 'Kriya Anyaman - Joko Santoso',
    ],
    [
        'id' => 6,
        'name' => 'Laundry Kilat Bersih Wangi',
        'owner_name' => 'Mas Dimas',
        'category' => 'Jasa & Layanan',
        'location' => 'Bandung Tengah',
        'address' => 'Jl. Dago No. 54, Bandung',
        'has_delivery' => true,
        'delivery_fee' => 5000,
        'delivery_radius_km' => 5,
        'rating' => 4.9,
        'description' => 'Jasa cuci komplit kilat 3 jam selesai, cuci selimut & bedcover, setrika uap rapi harum tahan lama.',
        'phone' => '081234567896',
        'operating_hours' => '07:00 - 21:00 WIB',
        'is_verified' => true,
        'banner_image' => 'https://images.unsplash.com/photo-1517677208171-0bc6725a3e60?w=800&auto=format&fit=crop&q=80',
        'qris_image' => 'https://images.unsplash.com/photo-1595079672139-545c6020c681?w=400&auto=format&fit=crop&q=80',
        'qris_nmid' => 'ID6079889055',
        'bank_name' => 'Bank BNI',
        'bank_account_number' => '0829-102-918',
        'bank_account_name' => 'Laundry Bersih Wangi - Dimas',
    ]
];

foreach ($storesData as $sData) {
    Store::updateOrCreate(['id' => $sData['id']], $sData);
}

// 4. Seed Products with Real High Quality Images & Stock Details
$productsData = [
    // Store 1: Sembako & Kelontong
    [
        'store_id' => 1,
        'name' => 'Beras Pandan Wangi Super 5kg',
        'sku' => 'SBK-BRS-01',
        'category' => 'Sembako & Kelontong',
        'cost_price' => 68000,
        'selling_price' => 76000,
        'current_stock' => 45,
        'min_threshold' => 10,
        'health_status' => 'Healthy',
        'image_url' => 'https://images.unsplash.com/photo-1586201375761-83865001e31c?w=500&auto=format&fit=crop&q=80',
    ],
    [
        'store_id' => 1,
        'name' => 'Minyak Goreng Sawit 2L Pouch',
        'sku' => 'SBK-MYK-02',
        'category' => 'Sembako & Kelontong',
        'cost_price' => 31000,
        'selling_price' => 35500,
        'current_stock' => 32,
        'min_threshold' => 8,
        'health_status' => 'Healthy',
        'image_url' => 'https://images.unsplash.com/photo-1474979266404-7eaacbcd87c5?w=500&auto=format&fit=crop&q=80',
    ],
    [
        'store_id' => 1,
        'name' => 'Telur Ayam Negeri Fresh 1kg',
        'sku' => 'SBK-TLR-03',
        'category' => 'Sembako & Kelontong',
        'cost_price' => 26000,
        'selling_price' => 29500,
        'current_stock' => 20,
        'min_threshold' => 5,
        'health_status' => 'Healthy',
        'image_url' => 'https://images.unsplash.com/photo-1516467508483-a7212febe31a?w=500&auto=format&fit=crop&q=80',
    ],
    [
        'store_id' => 1,
        'name' => 'Gula Pasir Kristal Putih 1kg',
        'sku' => 'SBK-GLA-04',
        'category' => 'Sembako & Kelontong',
        'cost_price' => 14500,
        'selling_price' => 17500,
        'current_stock' => 35,
        'min_threshold' => 8,
        'health_status' => 'Healthy',
        'image_url' => 'https://images.unsplash.com/photo-1622484214819-35a22fe7f7d1?w=500&auto=format&fit=crop&q=80',
    ],

    // Store 2: Kuliner & F&B
    [
        'store_id' => 2,
        'name' => 'Paket Ayam Geprek Sambal Korek + Nasi',
        'sku' => 'FNB-AGP-01',
        'category' => 'Kuliner & F&B',
        'cost_price' => 14000,
        'selling_price' => 22000,
        'current_stock' => 60,
        'min_threshold' => 15,
        'health_status' => 'Healthy',
        'image_url' => 'https://images.unsplash.com/photo-1626082927389-6cd097cdc6ec?w=500&auto=format&fit=crop&q=80',
    ],
    [
        'store_id' => 2,
        'name' => 'Es Kopi Susu Gula Aren 250ml',
        'sku' => 'FNB-KPS-02',
        'category' => 'Kuliner & F&B',
        'cost_price' => 8000,
        'selling_price' => 18000,
        'current_stock' => 40,
        'min_threshold' => 10,
        'health_status' => 'Healthy',
        'image_url' => 'https://images.unsplash.com/photo-1517701604599-bb29b565090c?w=500&auto=format&fit=crop&q=80',
    ],
    [
        'store_id' => 2,
        'name' => 'Roti Bakar Bandung Coklat Keju',
        'sku' => 'FNB-RTB-03',
        'category' => 'Kuliner & F&B',
        'cost_price' => 9000,
        'selling_price' => 16000,
        'current_stock' => 25,
        'min_threshold' => 5,
        'health_status' => 'Healthy',
        'image_url' => 'https://images.unsplash.com/photo-1525351484163-7529414344d8?w=500&auto=format&fit=crop&q=80',
    ],

    // Store 3: Padang (Self Pickup)
    [
        'store_id' => 3,
        'name' => 'Rendang Daging Sapi Minang Porsi Spesial',
        'sku' => 'PDG-RND-01',
        'category' => 'Kuliner & F&B',
        'cost_price' => 22000,
        'selling_price' => 32000,
        'current_stock' => 30,
        'min_threshold' => 8,
        'health_status' => 'Healthy',
        'image_url' => 'https://images.unsplash.com/photo-1544025162-d76694265947?w=500&auto=format&fit=crop&q=80',
    ],
    [
        'store_id' => 3,
        'name' => 'Ayam Pop Sambalado Merah',
        'sku' => 'PDG-AYP-02',
        'category' => 'Kuliner & F&B',
        'cost_price' => 15000,
        'selling_price' => 24000,
        'current_stock' => 25,
        'min_threshold' => 6,
        'health_status' => 'Healthy',
        'image_url' => 'https://images.unsplash.com/photo-1598515214211-89d3c73ae83b?w=500&auto=format&fit=crop&q=80',
    ],

    // Store 4: Fashion & Pakaian
    [
        'store_id' => 4,
        'name' => 'Kemeja Batik Katun Pria Lengan Panjang',
        'sku' => 'FSH-BTK-01',
        'category' => 'Fashion & Pakaian',
        'cost_price' => 95000,
        'selling_price' => 165000,
        'current_stock' => 18,
        'min_threshold' => 4,
        'health_status' => 'Healthy',
        'image_url' => 'https://images.unsplash.com/photo-1596755094514-f87e34085b2c?w=500&auto=format&fit=crop&q=80',
    ],
    [
        'store_id' => 4,
        'name' => 'Hijab Segiempat Voal Premium',
        'sku' => 'FSH-HJB-02',
        'category' => 'Fashion & Pakaian',
        'cost_price' => 24000,
        'selling_price' => 45000,
        'current_stock' => 50,
        'min_threshold' => 10,
        'health_status' => 'Healthy',
        'image_url' => 'https://images.unsplash.com/photo-1584917865442-de89df76afd3?w=500&auto=format&fit=crop&q=80',
    ],

    // Store 5: Kerajinan & Kriya
    [
        'store_id' => 5,
        'name' => 'Keranjang Rotan Estetik Multifungsi',
        'sku' => 'KRY-RTN-01',
        'category' => 'Kerajinan & Kriya',
        'cost_price' => 38000,
        'selling_price' => 65000,
        'current_stock' => 14,
        'min_threshold' => 3,
        'health_status' => 'Healthy',
        'image_url' => 'https://images.unsplash.com/photo-1513519245088-0e12902e5a38?w=500&auto=format&fit=crop&q=80',
    ],
    [
        'store_id' => 5,
        'name' => 'Tudung Saji Anyaman Bambu Tradisional',
        'sku' => 'KRY-TDG-02',
        'category' => 'Kerajinan & Kriya',
        'cost_price' => 32000,
        'selling_price' => 54000,
        'current_stock' => 12,
        'min_threshold' => 3,
        'health_status' => 'Healthy',
        'image_url' => 'https://images.unsplash.com/photo-1616486338812-3dadae4b4ace?w=500&auto=format&fit=crop&q=80',
    ],

    // Store 6: Jasa & Layanan
    [
        'store_id' => 6,
        'name' => 'Paket Cuci Kering Setrika 5kg Kilat',
        'sku' => 'JSA-LND-01',
        'category' => 'Jasa & Layanan',
        'cost_price' => 18000,
        'selling_price' => 35000,
        'current_stock' => 100,
        'min_threshold' => 20,
        'health_status' => 'Healthy',
        'image_url' => 'https://images.unsplash.com/photo-1517677208171-0bc6725a3e60?w=500&auto=format&fit=crop&q=80',
    ],
    [
        'store_id' => 6,
        'name' => 'Layanan Cuci Bedcover King Size + Antar Jemput',
        'sku' => 'JSA-LND-02',
        'category' => 'Jasa & Layanan',
        'cost_price' => 22000,
        'selling_price' => 45000,
        'current_stock' => 80,
        'min_threshold' => 15,
        'health_status' => 'Healthy',
        'image_url' => 'https://images.unsplash.com/photo-1582735689369-4fe89db7114c?w=500&auto=format&fit=crop&q=80',
    ],

    // FLASH SALE PRODUCTS
    [
        'store_id' => 1,
        'name' => 'Roti Tawar Gandum Sari Roti (Flash Sale)',
        'sku' => 'FS-ROTI-01',
        'category' => 'Sembako & Kelontong',
        'cost_price' => 10000,
        'selling_price' => 11500,
        'current_stock' => 4,
        'min_threshold' => 2,
        'health_status' => 'Attention',
        'image_url' => 'https://images.unsplash.com/photo-1509440159596-0249088772ff?w=500&auto=format&fit=crop&q=80',
    ],
    [
        'store_id' => 1,
        'name' => 'Susu Segar Greenfield Pasteurisasi 1L',
        'sku' => 'FS-SUSU-02',
        'category' => 'Sembako & Kelontong',
        'cost_price' => 15000,
        'selling_price' => 18000,
        'current_stock' => 3,
        'min_threshold' => 2,
        'health_status' => 'Attention',
        'image_url' => 'https://images.unsplash.com/photo-1550583724-b2692b85b150?w=500&auto=format&fit=crop&q=80',
    ],
    [
        'store_id' => 1,
        'name' => 'Pisang Cavendish Sunpride 1 Sisir',
        'sku' => 'FS-PSNG-03',
        'category' => 'Sembako & Kelontong',
        'cost_price' => 12000,
        'selling_price' => 16000,
        'current_stock' => 5,
        'min_threshold' => 2,
        'health_status' => 'Attention',
        'image_url' => 'https://images.unsplash.com/photo-1571771894821-ce9b6c11b08e?w=500&auto=format&fit=crop&q=80',
    ],
    [
        'store_id' => 2,
        'name' => 'Donat Kentang Gula Tabur (Isi 4)',
        'sku' => 'FS-DNAT-04',
        'category' => 'Kuliner & F&B',
        'cost_price' => 6000,
        'selling_price' => 8500,
        'current_stock' => 4,
        'min_threshold' => 2,
        'health_status' => 'Attention',
        'image_url' => 'https://images.unsplash.com/photo-1551024709-8f23befc6f87?w=500&auto=format&fit=crop&q=80',
    ],
];

foreach ($productsData as $pData) {
    Product::updateOrCreate(['sku' => $pData['sku']], $pData);
}

// 5. Seed Platform Vouchers
$vouchers = [
    [
        'code' => 'DISKON10K',
        'title' => 'Potongan Langsung Rp 10.000',
        'description' => 'Diskon Rp 10.000 untuk belanja di semua gerai UMKM dengan minimal order Rp 30.000.',
        'discount_type' => 'fixed',
        'discount_value' => 10000,
        'min_order' => 30000,
        'is_active' => true,
    ],
    [
        'code' => 'GRATISONGKIR',
        'title' => 'Voucher Gratis Ongkir Gerai',
        'description' => 'Gratis ongkir pengantaran gerai lokal hingga Rp 7.000.',
        'discount_type' => 'fixed',
        'discount_value' => 7000,
        'min_order' => 25000,
        'is_active' => true,
    ],
    [
        'code' => 'FLASH50',
        'title' => 'Kupon Cuci Gudang Diskon 50%',
        'description' => 'Diskon spesial 50% untuk produk bertanda Flash Sale Cuci Gudang Jam 7 Malam.',
        'discount_type' => 'percent',
        'discount_value' => 50,
        'min_order' => 15000,
        'is_active' => true,
    ],
    [
        'code' => 'USERBARU',
        'title' => 'Diskon Pengguna Baru Rp 15.000',
        'description' => 'Spesial sambutan user baru di ekosistem platform LARIS.',
        'discount_type' => 'fixed',
        'discount_value' => 15000,
        'min_order' => 40000,
        'is_active' => true,
    ],
];

foreach ($vouchers as $v) {
    DB::table('vouchers')->updateOrInsert(['code' => $v['code']], $v);
}

echo "SUCCESS: Seeded Multi-Sector Stores with Payment/QRIS, Products with Real Images, and Vouchers successfully!\n";
