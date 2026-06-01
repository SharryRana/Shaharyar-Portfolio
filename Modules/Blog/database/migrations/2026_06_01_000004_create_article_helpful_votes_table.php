<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('article_helpful_votes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('article_id')->constrained('articles')->cascadeOnDelete();
            $table->string('fingerprint', 64);
            $table->string('vote', 10);
            $table->timestamps();

            $table->unique(['article_id', 'fingerprint'], 'article_helpful_unique');
            $table->index(['article_id', 'vote'], 'article_helpful_count_index');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('article_helpful_votes');
    }
};
