<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LarisDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Store
        $storeId = DB::table('stores')->insertGetId([
            'name' => 'Toko Berkah Utama',
            'owner_name' => 'Juragan Bambang',
            'category' => 'Stationery, Retail & FMCG',
            'location' => 'Bandung, Jawa Barat',
            'daily_revenue_target' => 40000000,
            'monthly_revenue_target' => 120000000,
            'business_health_score' => 94,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // 2. Categories
        $categories = [
            ['name' => 'Stationery & Toys', 'slug' => 'stationery-toys'],
            ['name' => 'Kopi & Minuman Kemasan', 'slug' => 'kopi-minuman'],
            ['name' => 'Kebutuhan Pokok / Sembako', 'slug' => 'sembako'],
            ['name' => 'Aksesoris Gadget', 'slug' => 'aksesoris-gadget'],
            ['name' => 'Packaging', 'slug' => 'packaging'],
        ];
        foreach ($categories as $cat) {
            DB::table('categories')->insert(array_merge($cat, ['created_at' => now(), 'updated_at' => now()]));
        }

        // 3. Products
        $products = [
            [
                'store_id' => $storeId,
                'name' => 'Kopi Arabica Gayo 250g',
                'sku' => 'KPG-GY-01',
                'category' => 'Biji Kopi',
                'image_url' => 'https://images.unsplash.com/photo-1559056199-641a0ac8b55e?w=120&auto=format&fit=crop&q=80',
                'cost_price' => 45000,
                'selling_price' => 75000,
                'current_stock' => 24,
                'min_threshold' => 40,
                'health_status' => 'Critical',
                'ai_velocity' => 6.0,
                'stock_runway_days' => 4,
                'supplier_name' => 'PT Kopi Nusantara Bandung',
                'supplier_lead_time_days' => 2,
                'is_dead_stock' => false,
                'dead_stock_days' => 0,
            ],
            [
                'store_id' => $storeId,
                'name' => 'Pensil Labubu Premium Edition (Set 12 Warna Pastel)',
                'sku' => 'STN-LBB-09',
                'category' => 'Stationery',
                'image_url' => 'https://images.unsplash.com/photo-1585336261026-784860010041?w=120&auto=format&fit=crop&q=80',
                'cost_price' => 8500,
                'selling_price' => 18000,
                'current_stock' => 180,
                'min_threshold' => 50,
                'health_status' => 'Healthy',
                'ai_velocity' => 8.5,
                'stock_runway_days' => 21,
                'supplier_name' => 'Distributor Stationery Jaya',
                'supplier_lead_time_days' => 3,
                'is_dead_stock' => false,
                'dead_stock_days' => 0,
            ],
            [
                'store_id' => $storeId,
                'name' => 'Sirup Caramel 750ml Artisan Flavour',
                'sku' => 'BEV-CRM-03',
                'category' => 'Sirup & Flavor',
                'image_url' => 'https://images.unsplash.com/photo-1514432324607-a09d9b4aefdd?w=120&auto=format&fit=crop&q=80',
                'cost_price' => 58000,
                'selling_price' => 92000,
                'current_stock' => 12,
                'min_threshold' => 15,
                'health_status' => 'Attention',
                'ai_velocity' => 2.0,
                'stock_runway_days' => 6,
                'supplier_name' => 'PT Kopi Nusantara Bandung',
                'supplier_lead_time_days' => 2,
                'is_dead_stock' => false,
                'dead_stock_days' => 0,
            ],
            [
                'store_id' => $storeId,
                'name' => 'Paper Cup 8oz Eco Biodegradable Kraft',
                'sku' => 'PKG-CUP-08',
                'category' => 'Packaging',
                'image_url' => 'https://images.unsplash.com/photo-1577937927133-66ef06acdf18?w=120&auto=format&fit=crop&q=80',
                'cost_price' => 450,
                'selling_price' => 900,
                'current_stock' => 450,
                'min_threshold' => 100,
                'health_status' => 'Healthy',
                'ai_velocity' => 15.0,
                'stock_runway_days' => 30,
                'supplier_name' => 'Kemas Eco Packaging',
                'supplier_lead_time_days' => 4,
                'is_dead_stock' => false,
                'dead_stock_days' => 0,
            ],
            [
                'store_id' => $storeId,
                'name' => 'Susu UHT Barista 1L Fresh Milk High Protein',
                'sku' => 'DRY-UHT-10',
                'category' => 'Dairy',
                'image_url' => 'https://images.unsplash.com/photo-1550583724-b2692b85b150?w=120&auto=format&fit=crop&q=80',
                'cost_price' => 17500,
                'selling_price' => 24000,
                'current_stock' => 8,
                'min_threshold' => 20,
                'health_status' => 'Critical',
                'ai_velocity' => 4.0,
                'stock_runway_days' => 2,
                'supplier_name' => 'PT Kopi Nusantara Bandung',
                'supplier_lead_time_days' => 2,
                'is_dead_stock' => false,
                'dead_stock_days' => 0,
            ],
            [
                'store_id' => $storeId,
                'name' => 'Tumbler Stainless 500ml Pastel',
                'sku' => 'LFS-TMB-05',
                'category' => 'Lifestyle',
                'image_url' => 'https://images.unsplash.com/photo-1517256064527-09c73fc73e38?w=120&auto=format&fit=crop&q=80',
                'cost_price' => 42000,
                'selling_price' => 68000,
                'current_stock' => 42,
                'min_threshold' => 10,
                'health_status' => 'Attention',
                'ai_velocity' => 0.1,
                'stock_runway_days' => 90,
                'supplier_name' => 'Impor Mandiri Ritel',
                'supplier_lead_time_days' => 7,
                'is_dead_stock' => true,
                'dead_stock_days' => 24,
            ]
        ];
        foreach ($products as $p) {
            DB::table('products')->insert(array_merge($p, ['created_at' => now(), 'updated_at' => now()]));
        }

        // 4. Market Trends
        $trends = [
            [
                'trend_name' => 'Labubu Stationery & Merchandise',
                'category' => 'Stationery',
                'stage' => 'Early Stage',
                'signal_strength' => 82,
                'growth_velocity' => '+284%',
                'price_range' => 'Rp 15k - 45k',
                'competition_level' => 'Rendah',
                'national_deficit' => '63%',
                'recommendation' => 'Permintaan Labubu Stationery berada pada fase eksponensial awal dengan defisit stok distributor di area Jabodetabek & Surabaya. Amankan stok 50-100 unit pertama untuk mengunci margin kotor premium (~52%) sebelum perang harga pasar umum terjadi dalam 14-20 hari.',
                'image_url' => 'https://images.unsplash.com/photo-1585336261026-784860010041?w=200&auto=format&fit=crop&q=80',
            ],
            [
                'trend_name' => 'Vintage Botanical Journal',
                'category' => 'Paper Craft',
                'stage' => 'Growth Stage',
                'signal_strength' => 76,
                'growth_velocity' => '+115%',
                'price_range' => 'Rp 35k - 85k',
                'competition_level' => 'Sedang',
                'national_deficit' => '42%',
                'recommendation' => 'Buku jurnal hard cover bertema flora retro untuk segmen bullet journal anak muda.',
                'image_url' => 'https://images.unsplash.com/photo-1544716278-ca5e3f4abd8c?w=200&auto=format&fit=crop&q=80',
            ],
            [
                'trend_name' => 'Bamboo Gel Pen Eco Refill',
                'category' => 'Eco Office',
                'stage' => 'Mature Stage',
                'signal_strength' => 69,
                'growth_velocity' => '+45%',
                'price_range' => 'Rp 12k - 25k',
                'competition_level' => 'Tinggi',
                'national_deficit' => '18%',
                'recommendation' => 'Pulpen ramah lingkungan isi ulang bahan bambu asli dengan margin konsisten.',
                'image_url' => 'https://images.unsplash.com/photo-1583485088034-697b5bc54ccd?w=200&auto=format&fit=crop&q=80',
            ],
            [
                'trend_name' => 'Korean Pastel Insulated Tumbler',
                'category' => 'Lifestyle',
                'stage' => 'Early Stage',
                'signal_strength' => 64,
                'growth_velocity' => '+140%',
                'price_range' => 'Rp 45k - 95k',
                'competition_level' => 'Rendah',
                'national_deficit' => '55%',
                'recommendation' => 'Botol minum insulasi stainless pastel dengan pegangan estetik gaya Korea.',
                'image_url' => 'https://images.unsplash.com/photo-1517256064527-09c73fc73e38?w=200&auto=format&fit=crop&q=80',
            ]
        ];
        foreach ($trends as $t) {
            DB::table('market_trends')->insert(array_merge($t, ['created_at' => now(), 'updated_at' => now()]));
        }

        // 5. Operational Alerts
        $alerts = [
            [
                'store_id' => $storeId,
                'alert_type' => 'imminent_stockout',
                'product_name' => 'Kopi Arabica Gayo 250g',
                'badge_text' => 'SISA 5 UNIT',
                'description' => 'Diprediksi habis dalam 14 jam berdasarkan laju transaksi harian. Supplier: PT Kopi Nusantara Bandung.',
                'action_label' => 'Order Ulang',
                'action_url' => '/smart-inventory',
            ],
            [
                'store_id' => $storeId,
                'alert_type' => 'margin_drop',
                'product_name' => 'Minyak Goreng Sania 2L',
                'badge_text' => 'MARGIN TURUN',
                'description' => 'Harga beli distributor naik Rp 1.500. Juragan disarankan menaikkan harga jual ritel jadi Rp 36.500 (Dampak Margin: -4.2%).',
                'action_label' => 'Sesuaikan Harga',
                'action_url' => '/business-dashboard',
            ],
            [
                'store_id' => $storeId,
                'alert_type' => 'dead_stock',
                'product_name' => 'Tumbler Stainless 500ml',
                'badge_text' => 'STAGNAN 24 HARI',
                'description' => 'Stok 42 unit menahan modal Rp 1.8M. Buat paket bundling dengan produk best seller untuk likuiditas!',
                'action_label' => 'Buat Promo Bundling',
                'action_url' => '/juragan-ai',
            ]
        ];
        foreach ($alerts as $a) {
            DB::table('operational_alerts')->insert(array_merge($a, ['created_at' => now(), 'updated_at' => now()]));
        }
    }
}
