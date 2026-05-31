<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('authors')) {
            Schema::create('authors', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('avatar')->nullable();
                $table->string('signature')->nullable();
                $table->text('bio')->nullable();
                $table->string('designation')->nullable();
                $table->boolean('is_active')->default(true);
                $table->timestamps();
                $table->softDeletes();
            });
        }

        Schema::table('articles', function (Blueprint $table) {
            if (! Schema::hasColumn('articles', 'author_id')) {
                $table->unsignedBigInteger('author_id')->nullable()->after('id');
            }
        });
    }

    public function down(): void
    {
        Schema::table('articles', function (Blueprint $table) {
            if (Schema::hasColumn('articles', 'author_id')) {
                $table->dropColumn('author_id');
            }
        });

        Schema::dropIfExists('authors');
    }
};
