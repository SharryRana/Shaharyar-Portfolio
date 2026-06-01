<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('article_comments', function (Blueprint $table) {
            if (! Schema::hasColumn('article_comments', 'visitor_key')) {
                $table->string('visitor_key', 64)->nullable()->after('user_agent');
                $table->unique(['article_id', 'visitor_key'], 'article_comments_article_visitor_unique');
            }
        });
    }

    public function down(): void
    {
        Schema::table('article_comments', function (Blueprint $table) {
            if (Schema::hasColumn('article_comments', 'visitor_key')) {
                $table->dropUnique('article_comments_article_visitor_unique');
                $table->dropColumn('visitor_key');
            }
        });
    }
};
