<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('experiences', function (Blueprint $table) {
            $table->id();
            $table->string('company');
            $table->string('role');                      // job title
            $table->string('location')->nullable();
            $table->string('employment_type')->nullable(); // Full-time, Contract, Freelance
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->boolean('is_current')->default(false);
            $table->text('description')->nullable();     // overview paragraph
            $table->json('highlights')->nullable();      // responsibilities/achievements array
            $table->json('technologies')->nullable();    // tech used array
            $table->string('company_url')->nullable();
            $table->string('company_logo')->nullable();  // optional logo
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('is_visible')->default(true);
            $table->timestamps();
            $table->index(['is_visible', 'sort_order']);
        });
    }

    public function down(): void {
        Schema::dropIfExists('experiences');
    }
};
