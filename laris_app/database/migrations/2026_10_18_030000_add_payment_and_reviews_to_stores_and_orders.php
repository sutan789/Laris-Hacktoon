<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Add payment settings to stores
        Schema::table('stores', function (Blueprint $table) {
            if (!Schema::hasColumn('stores', 'qris_image')) {
                $table->string('qris_image')->nullable();
            }
            if (!Schema::hasColumn('stores', 'qris_nmid')) {
                $table->string('qris_nmid')->nullable();
            }
            if (!Schema::hasColumn('stores', 'bank_name')) {
                $table->string('bank_name')->nullable();
            }
            if (!Schema::hasColumn('stores', 'bank_account_number')) {
                $table->string('bank_account_number')->nullable();
            }
            if (!Schema::hasColumn('stores', 'bank_account_name')) {
                $table->string('bank_account_name')->nullable();
            }
        });

        // 2. Add review, rating, and cancellation fields to orders
        Schema::table('orders', function (Blueprint $table) {
            if (!Schema::hasColumn('orders', 'rating')) {
                $table->integer('rating')->nullable();
            }
            if (!Schema::hasColumn('orders', 'review')) {
                $table->text('review')->nullable();
            }
            if (!Schema::hasColumn('orders', 'cancelled_reason')) {
                $table->string('cancelled_reason')->nullable();
            }
            if (!Schema::hasColumn('orders', 'cancelled_at')) {
                $table->timestamp('cancelled_at')->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('stores', function (Blueprint $table) {
            $table->dropColumn(['qris_image', 'qris_nmid', 'bank_name', 'bank_account_number', 'bank_account_name']);
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['rating', 'review', 'cancelled_reason', 'cancelled_at']);
        });
    }
};
