<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('articles', function (Blueprint $table) {
            if (! Schema::hasColumn('articles', 'image_title')) {
                $table->string('image_title')->nullable()->after('image');
            }

            if (! Schema::hasColumn('articles', 'image_alt_text')) {
                $table->string('image_alt_text')->nullable()->after('image_title');
            }

            if (! Schema::hasColumn('articles', 'image_description')) {
                $table->text('image_description')->nullable()->after('image_alt_text');
            }

            if (! Schema::hasColumn('articles', 'image_caption')) {
                $table->text('image_caption')->nullable()->after('image_description');
            }
        });
    }

    public function down(): void
    {
        Schema::table('articles', function (Blueprint $table) {
            if (Schema::hasColumn('articles', 'image_caption')) {
                $table->dropColumn('image_caption');
            }

            if (Schema::hasColumn('articles', 'image_description')) {
                $table->dropColumn('image_description');
            }

            if (Schema::hasColumn('articles', 'image_alt_text')) {
                $table->dropColumn('image_alt_text');
            }

            if (Schema::hasColumn('articles', 'image_title')) {
                $table->dropColumn('image_title');
            }
        });
    }
};
