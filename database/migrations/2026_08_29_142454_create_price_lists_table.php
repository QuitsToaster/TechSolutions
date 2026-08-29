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
        Schema::create('price_lists', function (Blueprint $table) {

            $table->id();

            $table->string('device_type');
            $table->string('brand');
            $table->string('model');

            $table->string('category');
            $table->string('item');

            $table->string('quality')->nullable();

            $table->decimal('part_price', 12, 2)->default(0);
            $table->decimal('labor_cost', 12, 2)->default(0);

            $table->text('notes')->nullable();

            $table->boolean('is_active')->default(true);

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('price_lists');
    }
};