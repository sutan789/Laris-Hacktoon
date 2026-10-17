<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Stores (Profil Usaha)
        Schema::create('stores', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('owner_name')->default('Juragan Bambang');
            $table->string('category')->default('Retail & Stationery');
            $table->string('location')->default('Bandung & Jabodetabek');
            $table->decimal('daily_revenue_target', 15, 2)->default(10000000);
            $table->decimal('monthly_revenue_target', 15, 2)->default(120000000);
            $table->integer('business_health_score')->default(94);
            $table->timestamps();
        });

        // 2. Categories
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->timestamps();
        });

        // 3. Products & Inventory
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('store_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->string('sku')->unique();
            $table->string('category');
            $table->string('image_url')->nullable();
            $table->decimal('cost_price', 12, 2); // HPP
            $table->decimal('selling_price', 12, 2);
            $table->integer('current_stock')->default(0);
            $table->integer('min_threshold')->default(10);
            $table->string('health_status')->default('Healthy'); // Healthy, Attention, Critical
            $table->decimal('ai_velocity', 8, 2)->default(1.0); // units/day
            $table->integer('stock_runway_days')->default(14); // remaining days
            $table->string('supplier_name')->nullable();
            $table->integer('supplier_lead_time_days')->default(2);
            $table->boolean('is_dead_stock')->default(false);
            $table->integer('dead_stock_days')->default(0);
            $table->timestamps();
        });

        // 4. Market Trends (Trend Hunter Radar)
        Schema::create('market_trends', function (Blueprint $table) {
            $table->id();
            $table->string('trend_name');
            $table->string('category');
            $table->string('stage')->default('Early Stage'); // Early Stage, Growth Stage, Mature Stage
            $table->integer('signal_strength')->default(80); // %
            $table->string('growth_velocity')->default('+284%');
            $table->string('price_range')->default('Rp 15k - 45k');
            $table->string('competition_level')->default('Rendah');
            $table->string('national_deficit')->default('63%');
            $table->text('recommendation')->nullable();
            $table->string('image_url')->nullable();
            $table->timestamps();
        });

        // 5. Product Opportunity Predictions (LARIS Predict History)
        Schema::create('opportunity_predictions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('store_id')->constrained()->cascadeOnDelete();
            $table->string('product_name');
            $table->string('category');
            $table->decimal('cost_price', 12, 2);
            $table->decimal('selling_price', 12, 2);
            $table->decimal('gross_margin_pct', 5, 2);
            $table->integer('opportunity_score')->default(85);
            $table->decimal('confidence_pct', 5, 2)->default(88.0);
            $table->string('estimated_demand_range')->default('38 - 52 pcs');
            $table->decimal('projected_revenue', 12, 2)->default(810000);
            $table->decimal('projected_net_profit', 12, 2)->default(427500);
            $table->json('key_insights')->nullable();
            $table->timestamps();
        });

        // 6. Operational Alerts
        Schema::create('operational_alerts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('store_id')->constrained()->cascadeOnDelete();
            $table->string('alert_type'); // imminent_stockout, margin_drop, dead_stock
            $table->string('product_name');
            $table->string('badge_text');
            $table->text('description');
            $table->string('action_label');
            $table->string('action_url')->nullable();
            $table->boolean('is_resolved')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('operational_alerts');
        Schema::dropIfExists('opportunity_predictions');
        Schema::dropIfExists('market_trends');
        Schema::dropIfExists('products');
        Schema::dropIfExists('categories');
        Schema::dropIfExists('stores');
    }
};
