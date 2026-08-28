<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RepairJob extends Model
{
    protected $fillable = [
        'job_number',
        'customer_id',
        'appointment_id',
        'device_type',
        'brand',
        'model',
        'serial_number',
        'imei',
        'problem_reported',
        'diagnosis',
        'repair_notes',
        'status',
        'priority',
        'estimated_cost',
        'labor_cost',
        'parts_cost',
        'discount',
        'final_cost',
        'amount_paid',
        'date_received',
        'expected_completion_date',
        'completed_at',
        'released_at',
    ];

    protected $casts = [
        'date_received' => 'date',
        'expected_completion_date' => 'date',
        'completed_at' => 'datetime',
        'released_at' => 'datetime',
        'estimated_cost' => 'decimal:2',
        'labor_cost' => 'decimal:2',
        'parts_cost' => 'decimal:2',
        'discount' => 'decimal:2',
        'final_cost' => 'decimal:2',
        'amount_paid' => 'decimal:2',
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function appointment(): BelongsTo
    {
        return $this->belongsTo(Appointment::class);
    }

    public function parts(): HasMany
    {
        return $this->hasMany(RepairJobPart::class);
    }

    public function statusHistories(): HasMany
    {
        return $this->hasMany(RepairJobStatusHistory::class);
    }

    public function getBalanceAttribute(): float
    {
        return max(
            0,
            (float) $this->final_cost - (float) $this->amount_paid
        );
    }
}