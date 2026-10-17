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
        Schema::table('stores', function (Blueprint $table) {
            $table->string('business_type')->nullable()->after('category');
            $table->string('address')->nullable()->after('location');
            $table->string('phone')->nullable()->after('address');
            $table->string('operating_hours')->nullable()->default('08:00 - 22:00 WIB')->after('phone');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('stores', function (Blueprint $table) {
            $table->dropColumn(['business_type', 'address', 'phone', 'operating_hours']);
        });
    }
};
