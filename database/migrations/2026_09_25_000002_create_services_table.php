<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('name');                       // e.g. 'Backend Development'
            $table->string('slug')->unique();             // e.g. 'backend-development'
            $table->string('icon')->nullable();           // Font Awesome class
            $table->string('headline')->nullable();       // hero headline
            $table->text('short_description')->nullable(); // for cards
            $table->longText('full_content')->nullable(); // full page content (can be HTML)
            $table->json('technologies')->nullable();     // array of tech strings
            $table->json('key_points')->nullable();       // bullet point benefits
            $table->json('process_steps')->nullable();    // how-we-work steps
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            // SEO fields
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->string('og_image')->nullable();
            $table->timestamps();
            $table->index(['is_active', 'sort_order']);
        });

        Schema::create('service_faqs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_id')->constrained()->cascadeOnDelete();
            $table->string('question');
            $table->text('answer');
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('service_faqs');
        Schema::dropIfExists('services');
    }
};
