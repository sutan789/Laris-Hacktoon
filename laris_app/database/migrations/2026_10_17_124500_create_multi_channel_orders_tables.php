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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_number')->unique();
            $table->foreignId('store_id')->constrained()->cascadeOnDelete();
            $table->string('channel')->default('Offline Store'); // Shopee, Tokopedia, Offline Store
            $table->decimal('total_amount', 15, 2)->default(0); // Gross Revenue
            $table->decimal('total_cost', 15, 2)->default(0);   // Total HPP
            $table->decimal('gross_profit', 15, 2)->default(0); // Laba Kotor
            $table->string('payment_method')->default('QRIS');  // QRIS, Tunai, Transfer
            $table->string('status')->default('Completed');     // Pending, Completed, Cancelled
            $table->timestamps();
        });

        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->cascadeOnDelete();
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
            $table->integer('quantity');
            $table->decimal('unit_selling_price', 12, 2);
            $table->decimal('unit_cost_price', 12, 2);
            $table->decimal('subtotal', 15, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
        Schema::dropIfExists('orders');
    }
};
