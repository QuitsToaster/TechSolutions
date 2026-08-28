<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('parts', function (Blueprint $table) {
            $table->id();

            $table->foreignId('supplier_id')
                ->nullable()
                ->constrained('suppliers')
                ->nullOnDelete();

            $table->string('name');
            $table->string('part_number')->nullable()->unique();
            $table->string('category')->nullable();
            $table->string('device_type')->nullable();
            $table->string('brand')->nullable();

            $table->unsignedInteger('quantity')->default(0);
            $table->unsignedInteger('reorder_level')->default(1);

            $table->decimal('cost_price', 10, 2)->default(0);
            $table->decimal('selling_price', 10, 2)->default(0);

            $table->string('location')->nullable();

            $table->text('description')->nullable();
            $table->text('notes')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('parts');
    }
};