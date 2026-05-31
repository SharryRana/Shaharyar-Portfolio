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
        Schema::table('visits', function (Blueprint $table) {
            if (!Schema::hasColumn('visits', 'article_id')) {
                $table->unsignedBigInteger('article_id')->nullable()->index();
            }
            if (!Schema::hasColumn('visits', 'referer')) {
                $table->string('referer')->nullable();
            }
            if (!Schema::hasColumn('visits', 'device_type')) {
                $table->string('device_type')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('visits', function (Blueprint $table) {
            if (Schema::hasColumn('visits', 'article_id')) {
                $table->dropIndex(['article_id']);
                $table->dropColumn('article_id');
            }
            if (Schema::hasColumn('visits', 'referer')) {
                $table->dropColumn('referer');
            }
            if (Schema::hasColumn('visits', 'device_type')) {
                $table->dropColumn('device_type');
            }
        });
    }
};
