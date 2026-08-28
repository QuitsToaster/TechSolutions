<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Models\RepairJob;

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
        'status',
        'payment_status',
        'notes',
    ];

    protected $casts = [
        'appointment_date' => 'date',
        'estimated_cost' => 'decimal:2',
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