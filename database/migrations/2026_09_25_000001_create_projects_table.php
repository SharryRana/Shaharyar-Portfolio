<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('tagline')->nullable();
            $table->text('summary')->nullable();           // short description for cards
            $table->longText('overview')->nullable();      // full overview paragraph
            $table->longText('problem')->nullable();
            $table->longText('solution')->nullable();
            $table->text('my_role')->nullable();
            $table->longText('architecture')->nullable();
            $table->longText('challenges')->nullable();
            $table->longText('results')->nullable();
            $table->json('tech_stack')->nullable();        // array of tech strings
            $table->json('highlights')->nullable();        // key achievement bullets
            $table->string('project_type')->nullable();    // e.g. 'SaaS', 'FinTech', 'E-commerce'
            $table->string('thumbnail')->nullable();
            $table->string('thumbnail_alt')->nullable();
            $table->string('demo_url')->nullable();
            $table->string('github_url')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->date('project_date')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->enum('status', ['active', 'inactive'])->default('active');
            // SEO fields
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->string('og_image')->nullable();
            $table->string('focus_keyword')->nullable();
            $table->timestamps();
            $table->index(['status', 'sort_order']);
            $table->index('is_featured');
        });

        Schema::create('project_screenshots', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained()->cascadeOnDelete();
            $table->string('image');
            $table->string('alt_text')->nullable();
            $table->string('title')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('project_screenshots');
        Schema::dropIfExists('projects');
    }
};
