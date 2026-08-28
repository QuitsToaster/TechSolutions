<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('parts', function (Blueprint $table) {
            $table->unsignedInteger('stock_quantity')
                ->default(0)
                ->after('name');

            $table->unsignedInteger('minimum_stock')
                ->default(1)
                ->after('stock_quantity');
        });
    }

    public function down(): void
    {
        Schema::table('parts', function (Blueprint $table) {
            $table->dropColumn([
                'stock_quantity',
                'minimum_stock',
            ]);
        });
    }
};