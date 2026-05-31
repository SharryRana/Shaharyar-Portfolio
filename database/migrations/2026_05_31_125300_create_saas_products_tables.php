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
        Schema::create('saas_products', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('tagline')->nullable();
            $table->text('overview');
            $table->text('how_it_works')->nullable();
            $table->text('access_instructions')->nullable();
            $table->string('thumbnail')->nullable();
            $table->string('thumbnail_alt')->nullable();
            $table->string('icon')->nullable();
            $table->string('category')->nullable();
            $table->string('demo_url')->nullable();
            $table->string('video_url')->nullable();
            $table->json('benefits')->nullable();
            $table->json('use_cases')->nullable();
            $table->json('tech_stack')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('meta_keywords')->nullable();
            $table->string('canonical_url')->nullable();
            $table->string('og_title')->nullable();
            $table->text('og_description')->nullable();
            $table->string('og_image')->nullable();
            $table->string('twitter_title')->nullable();
            $table->text('twitter_description')->nullable();
            $table->string('twitter_image')->nullable();
            $table->text('product_schema_json')->nullable();
            $table->string('focus_keyword')->nullable();
            $table->timestamps();

            $table->index(['status', 'sort_order']);
        });

        Schema::create('saas_product_features', function (Blueprint $table) {
            $table->id();
            $table->foreignId('saas_product_id')->constrained()->cascadeOnDelete();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('icon')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('saas_product_screenshots', function (Blueprint $table) {
            $table->id();
            $table->foreignId('saas_product_id')->constrained()->cascadeOnDelete();
            $table->string('image');
            $table->string('alt_text')->nullable();
            $table->string('title')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('saas_product_faqs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('saas_product_id')->constrained()->cascadeOnDelete();
            $table->string('question');
            $table->text('answer');
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('saas_product_pricing_plans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('saas_product_id')->constrained()->cascadeOnDelete();
            $table->string('title');
            $table->decimal('price', 10, 2)->default(0);
            $table->string('currency', 10)->default('USD');
            $table->string('duration')->nullable();
            $table->string('cta_label')->nullable();
            $table->json('features')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('saas_product_country_prices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('saas_product_pricing_plan_id')->constrained()->cascadeOnDelete();
            $table->string('country_code', 10)->nullable();
            $table->string('country_name');
            $table->string('currency', 10);
            $table->decimal('price', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('saas_product_country_prices');
        Schema::dropIfExists('saas_product_pricing_plans');
        Schema::dropIfExists('saas_product_faqs');
        Schema::dropIfExists('saas_product_screenshots');
        Schema::dropIfExists('saas_product_features');
        Schema::dropIfExists('saas_products');
    }
};
