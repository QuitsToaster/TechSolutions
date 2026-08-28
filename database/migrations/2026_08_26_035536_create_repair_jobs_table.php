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
        Schema::create('repair_jobs', function (Blueprint $table) {
            $table->id();

            $table->string('job_number')->unique();

            $table->foreignId('customer_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('appointment_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            $table->string('device_type');
            $table->string('brand')->nullable();
            $table->string('model')->nullable();
            $table->string('serial_number')->nullable();
            $table->string('imei')->nullable();

            $table->text('problem_reported');

            $table->text('diagnosis')->nullable();

            $table->text('repair_notes')->nullable();

            $table->enum('status', [
                'pending',
                'diagnosing',
                'waiting_for_parts',
                'repairing',
                'ready_for_pickup',
                'released',
                'on_hold',
                'cancelled',
            ])->default('pending');

            $table->enum('priority', [
                'low',
                'normal',
                'high',
                'urgent',
            ])->default('normal');

            $table->decimal('estimated_cost', 12, 2)
                ->default(0);

            $table->decimal('labor_cost', 12, 2)
                ->default(0);

            $table->decimal('parts_cost', 12, 2)
                ->default(0);

            $table->decimal('discount', 12, 2)
                ->default(0);

            $table->decimal('final_cost', 12, 2)
                ->default(0);

            $table->decimal('amount_paid', 12, 2)
                ->default(0);

            $table->date('date_received');

            $table->date('expected_completion_date')
                ->nullable();

            $table->timestamp('completed_at')
                ->nullable();

            $table->timestamp('released_at')
                ->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('repair_jobs');
    }
};
