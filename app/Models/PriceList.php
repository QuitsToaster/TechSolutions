<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PriceList extends Model
{
    protected $fillable = [
        'device_type',
        'brand',
        'model',
        'category',
        'item',
        'quality',
        'part_price',
        'labor_cost',
        'notes',
        'is_active',
    ];

    protected $casts = [
        'part_price' => 'decimal:2',
        'labor_cost' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    /**
     * Get the total reference price.
     */
    public function getTotalPriceAttribute(): float
    {
        return (float) $this->part_price + (float) $this->labor_cost;
    }
}