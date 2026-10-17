<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Store extends Model
{
    protected $guarded = [];

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function operationalAlerts(): HasMany
    {
        return $this->hasMany(OperationalAlert::class);
    }

    public function opportunityPredictions(): HasMany
    {
        return $this->hasMany(OpportunityPrediction::class);
    }
}
