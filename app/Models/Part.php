<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Part extends Model
{
    protected $fillable = [
        'supplier_id',
        'name',
        'part_number',
        'category',
        'device_type',
        'brand',
        'quantity',
        'reorder_level',
        'cost_price',
        'selling_price',
        'location',
        'description',
        'notes',
    ];

    protected $casts = [
        'quantity' => 'integer',
        'reorder_level' => 'integer',
        'cost_price' => 'decimal:2',
        'selling_price' => 'decimal:2',
    ];

    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class);
    }

    public function getStockStatusAttribute(): string
    {
        if ($this->quantity <= 0) {
            return 'Out of Stock';
        }

        if ($this->quantity <= $this->reorder_level) {
            return 'Low Stock';
        }

        return 'In Stock';
    }
}