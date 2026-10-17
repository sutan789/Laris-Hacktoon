<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OpportunityPrediction extends Model
{
    protected $guarded = [];

    protected $casts = [
        'key_insights' => 'array',
        'cost_price' => 'decimal:2',
        'selling_price' => 'decimal:2',
        'gross_margin_pct' => 'decimal:2',
        'confidence_pct' => 'decimal:2',
        'projected_revenue' => 'decimal:2',
        'projected_net_profit' => 'decimal:2',
    ];

    public function store(): BelongsTo
    {
        return $this->belongsTo(Store::class);
    }
}
