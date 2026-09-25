<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('testimonials', function (Blueprint $table) {
            $table->id();
            $table->string('client_name');
            $table->string('client_title')->nullable(); // e.g. "Founder & CEO"
            $table->string('company_name')->nullable(); // e.g. "FinTech Solutions"
            $table->string('client_avatar')->nullable(); // image path
            $table->unsignedTinyInteger('rating')->default(5); // 1-5 stars
            $table->text('review');
            $table->string('project_title')->nullable(); // e.g. "Custom ERP & SaaS Build"
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->index(['is_active', 'sort_order']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('testimonials');
    }
};
