<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    protected $guarded = [];

    protected $casts = [
        'cost_price' => 'decimal:2',
        'selling_price' => 'decimal:2',
        'ai_velocity' => 'decimal:2',
        'is_dead_stock' => 'boolean',
    ];

    public function store(): BelongsTo
    {
        return $this->belongsTo(Store::class);
    }

    // Hitung margin kotor rupiah
    public function getGrossProfitAttribute(): float
    {
        return (float) ($this->selling_price - $this->cost_price);
    }

    // Hitung persentase gross margin
    public function getGrossMarginPctAttribute(): float
    {
        if ($this->selling_price <= 0) return 0;
        return round((($this->selling_price - $this->cost_price) / $this->selling_price) * 100, 1);
    }

    // Hitung sisa runway hari stok berdasarkan ai velocity
    public function calculateStockRunway(): int
    {
        if ($this->ai_velocity <= 0) return 999;
        return (int) ceil($this->current_stock / $this->ai_velocity);
    }
}
