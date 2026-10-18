<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Enrich Stores with Marketplace & Delivery capabilities
        Schema::table('stores', function (Blueprint $table) {
            if (!Schema::hasColumn('stores', 'has_delivery')) {
                $table->boolean('has_delivery')->default(true);
            }
            if (!Schema::hasColumn('stores', 'delivery_fee')) {
                $table->decimal('delivery_fee', 10, 2)->default(5000);
            }
            if (!Schema::hasColumn('stores', 'delivery_radius_km')) {
                $table->integer('delivery_radius_km')->default(5);
            }
            if (!Schema::hasColumn('stores', 'rating')) {
                $table->decimal('rating', 3, 1)->default(4.8);
            }
            if (!Schema::hasColumn('stores', 'description')) {
                $table->text('description')->nullable();
            }
            if (!Schema::hasColumn('stores', 'banner_image')) {
                $table->string('banner_image')->nullable();
            }
            if (!Schema::hasColumn('stores', 'is_verified')) {
                $table->boolean('is_verified')->default(true);
            }
        });

        // 2. Enrich Orders for User Marketplace Checkout & Tracking
        Schema::table('orders', function (Blueprint $table) {
            if (!Schema::hasColumn('orders', 'user_id')) {
                $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            }
            if (!Schema::hasColumn('orders', 'customer_name')) {
                $table->string('customer_name')->nullable();
            }
            if (!Schema::hasColumn('orders', 'customer_phone')) {
                $table->string('customer_phone')->nullable();
            }
            if (!Schema::hasColumn('orders', 'delivery_type')) {
                $table->string('delivery_type')->default('pickup'); // delivery, pickup
            }
            if (!Schema::hasColumn('orders', 'delivery_address')) {
                $table->text('delivery_address')->nullable();
            }
            if (!Schema::hasColumn('orders', 'delivery_fee')) {
                $table->decimal('delivery_fee', 10, 2)->default(0);
            }
            if (!Schema::hasColumn('orders', 'discount_amount')) {
                $table->decimal('discount_amount', 10, 2)->default(0);
            }
            if (!Schema::hasColumn('orders', 'voucher_code')) {
                $table->string('voucher_code')->nullable();
            }
            if (!Schema::hasColumn('orders', 'notes')) {
                $table->text('notes')->nullable();
            }
        });

        // 3. Create Vouchers Table if not exists
        if (!Schema::hasTable('vouchers')) {
            Schema::create('vouchers', function (Blueprint $table) {
                $table->id();
                $table->string('code')->unique();
                $table->string('title');
                $table->text('description')->nullable();
                $table->string('discount_type')->default('fixed'); // fixed, percent
                $table->decimal('discount_value', 12, 2)->default(10000);
                $table->decimal('min_order', 12, 2)->default(0);
                $table->boolean('is_active')->default(true);
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('vouchers');
    }
};
