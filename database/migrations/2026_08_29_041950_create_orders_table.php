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
        Schema::create('orders', function (Blueprint $table) {

            $table->id();

            /*
            |--------------------------------------------------------------------------
            | Order Information
            |--------------------------------------------------------------------------
            */

            $table->string('order_number')->unique();

            /*
            |--------------------------------------------------------------------------
            | Product / Part
            |--------------------------------------------------------------------------
            */

            $table->foreignId('part_id')
                ->nullable()
                ->constrained('parts')
                ->nullOnDelete();

            /*
            |--------------------------------------------------------------------------
            | Customer
            |--------------------------------------------------------------------------
            */

            $table->foreignId('customer_id')
                ->nullable()
                ->constrained('customers')
                ->nullOnDelete();

            /*
            |--------------------------------------------------------------------------
            | Supplier
            |--------------------------------------------------------------------------
            */

            $table->foreignId('supplier_id')
                ->nullable()
                ->constrained('suppliers')
                ->nullOnDelete();

            /*
            |--------------------------------------------------------------------------
            | Order Details
            |--------------------------------------------------------------------------
            */

            $table->unsignedInteger('quantity')->default(1);

            $table->decimal('unit_price', 12, 2)->default(0);

            $table->decimal('total_price', 12, 2)->default(0);

            /*
            |--------------------------------------------------------------------------
            | Arrival
            |--------------------------------------------------------------------------
            */

            $table->date('estimated_arrival')->nullable();

            $table->date('arrived_at')->nullable();

            /*
            |--------------------------------------------------------------------------
            | Status
            |--------------------------------------------------------------------------
            */

            $table->enum('status', [
                'ordered',
                'confirmed',
                'shipped',
                'arrived',
                'cancelled',
            ])->default('ordered');

            /*
            |--------------------------------------------------------------------------
            | Notes
            |--------------------------------------------------------------------------
            */

            $table->text('notes')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};