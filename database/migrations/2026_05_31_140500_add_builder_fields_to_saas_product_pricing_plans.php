<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('saas_product_pricing_plans', function (Blueprint $table) {
            $table->text('description')->nullable()->after('duration');
            $table->boolean('is_popular')->default(false)->after('features');
            $table->enum('status', ['active', 'inactive'])->default('active')->after('is_popular');
        });
    }

    public function down(): void
    {
        Schema::table('saas_product_pricing_plans', function (Blueprint $table) {
            $table->dropColumn(['description', 'is_popular', 'status']);
        });
    }
};
