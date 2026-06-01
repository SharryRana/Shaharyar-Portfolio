<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('article_comment_reactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('article_comment_id')->constrained('article_comments')->cascadeOnDelete();
            $table->string('fingerprint', 64);
            $table->string('reaction', 10);
            $table->timestamps();

            $table->unique(['article_comment_id', 'fingerprint'], 'comment_reaction_unique');
            $table->index(['article_comment_id', 'reaction'], 'comment_reaction_count_index');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('article_comment_reactions');
    }
};
