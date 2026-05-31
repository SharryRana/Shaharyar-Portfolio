<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('articles', function (Blueprint $table) {
            if (! Schema::hasColumn('articles', 'show_on_blog')) {
                $table->boolean('show_on_blog')->default(true)->after('status');
            }

            if (! Schema::hasColumn('articles', 'is_trending')) {
                $table->boolean('is_trending')->default(false)->after('show_on_blog');
            }
        });
    }

    public function down(): void
    {
        Schema::table('articles', function (Blueprint $table) {
            if (Schema::hasColumn('articles', 'show_on_blog')) {
                $table->dropColumn('show_on_blog');
            }

            if (Schema::hasColumn('articles', 'is_trending')) {
                $table->dropColumn('is_trending');
            }
        });
    }
};
