<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    protected $fillable = [
        'order_number',
        'part_id',
        'part_name',
        'customer_id',
        'supplier_id',
        'quantity',
        'unit_price',
        'total_price',
        'estimated_arrival',
        'arrived_at',
        'status',
        'notes',
    ];

    protected $casts = [
        'estimated_arrival' => 'date',
        'arrived_at' => 'date',
        'unit_price' => 'decimal:2',
        'total_price' => 'decimal:2',
    ];

    /*
    |--------------------------------------------------------------------------
    | Part
    |--------------------------------------------------------------------------
    */

    public function part(): BelongsTo
    {
        return $this->belongsTo(Part::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Customer
    |--------------------------------------------------------------------------
    */

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Supplier
    |--------------------------------------------------------------------------
    */

    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Item Name
    |--------------------------------------------------------------------------
    |
    | If the order is connected to an existing Part, use the Part name.
    | Otherwise, use the manually entered part_name.
    |
    */

    public function getItemNameAttribute(): string
    {
        return $this->part?->name
            ?? $this->part_name
            ?? 'Unnamed Item';
    }
}