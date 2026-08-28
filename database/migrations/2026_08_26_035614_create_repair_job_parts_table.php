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
        Schema::create('repair_job_parts', function (Blueprint $table) {
            $table->id();

            $table->foreignId('repair_job_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('product_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            $table->string('part_name');

            $table->integer('quantity')
                ->default(1);

            $table->decimal('unit_cost', 12, 2)
                ->default(0);

            $table->decimal('total_cost', 12, 2)
                ->default(0);

            $table->text('notes')
                ->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('repair_job_parts');
    }
};
