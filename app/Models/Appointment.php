<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Appointment extends Model
{
    protected $fillable = [
        'customer_id',
        'appointment_date',
        'appointment_time',
        'device_type',
        'device_model',
        'service',
        'problem_description',
        'estimated_cost',
        'parts_breakdown',
        'labor_cost',
        'estimated_profit',
        'status',
        'payment_status',
        'notes',
    ];

    protected $casts = [
        'appointment_date' => 'date',
        'appointment_time' => 'datetime:H:i',
        'parts_breakdown' => 'array',
        'labor_cost' => 'decimal:2',
        'estimated_cost' => 'decimal:2',
        'estimated_profit' => 'decimal:2',
    ];
    
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function repairJob(): HasOne
    {
        return $this->hasOne(RepairJob::class);
    }
}