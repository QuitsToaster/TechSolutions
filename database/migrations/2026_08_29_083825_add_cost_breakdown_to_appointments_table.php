<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('appointments', function (Blueprint $table) {
            $table->json('parts_breakdown')->nullable()->after('estimated_cost');
            $table->decimal('labor_cost', 10, 2)->default(0)->after('parts_breakdown');
            $table->decimal('estimated_profit', 10, 2)->default(0)->after('labor_cost');
        });
    }

    public function down(): void
    {
        Schema::table('appointments', function (Blueprint $table) {
            $table->dropColumn([
                'parts_breakdown',
                'labor_cost',
                'estimated_profit',
            ]);
        });
    }
};