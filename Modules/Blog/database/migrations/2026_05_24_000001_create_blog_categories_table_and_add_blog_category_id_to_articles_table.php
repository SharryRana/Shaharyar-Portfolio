<?php

use Modules\Blog\Models\Article;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('blog_categories')) {
            Schema::create('blog_categories', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('slug')->unique();
                $table->text('description')->nullable();
                $table->boolean('is_active')->default(true);
                $table->string('meta_title')->nullable();
                $table->text('meta_description')->nullable();
                $table->text('meta_keywords')->nullable();
                $table->timestamps();
                $table->softDeletes();
            });
        }

        Schema::table('blog_categories', function (Blueprint $table) {
            if (! Schema::hasColumn('blog_categories', 'is_active')) {
                $table->boolean('is_active')->default(true)->after('description');
            }

            if (! Schema::hasColumn('blog_categories', 'meta_title')) {
                $table->string('meta_title')->nullable()->after('is_active');
            }

            if (! Schema::hasColumn('blog_categories', 'meta_description')) {
                $table->text('meta_description')->nullable()->after('meta_title');
            }

            if (! Schema::hasColumn('blog_categories', 'meta_keywords')) {
                $table->text('meta_keywords')->nullable()->after('meta_description');
            }

            if (! Schema::hasColumn('blog_categories', 'deleted_at')) {
                $table->softDeletes();
            }
        });

        Schema::table('articles', function (Blueprint $table) {
            if (! Schema::hasColumn('articles', 'blog_category_id')) {
                $table->unsignedBigInteger('blog_category_id')
                    ->nullable()
                    ->after('author_id');
            }
        });

        if (! Schema::hasIndex('articles', 'articles_blog_category_id_index')) {
            Schema::table('articles', function (Blueprint $table) {
                $table->index('blog_category_id');
            });
        }

        foreach (Article::categories() as $categoryName) {
            DB::table('blog_categories')->updateOrInsert(
                ['slug' => Str::slug($categoryName)],
                [
                    'name' => $categoryName,
                    'description' => null,
                    'is_active' => true,
                    'meta_title' => null,
                    'meta_description' => null,
                    'meta_keywords' => null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            );
        }

        DB::table('articles')
            ->whereNull('blog_category_id')
            ->orderBy('id')
            ->get(['id', 'category'])
            ->each(function ($article) {
                $categoryName = trim((string) ($article->category ?: Article::CATEGORY_LINK_BUILDING));
                $slug = Str::slug($categoryName ?: Article::CATEGORY_LINK_BUILDING);

                $category = DB::table('blog_categories')->where('slug', $slug)->first();

                if (! $category) {
                    $categoryId = DB::table('blog_categories')->insertGetId([
                        'name' => $categoryName,
                        'slug' => $slug,
                        'description' => null,
                        'is_active' => true,
                        'meta_title' => null,
                        'meta_description' => null,
                        'meta_keywords' => null,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                } else {
                    $categoryId = $category->id;
                }

                DB::table('articles')
                    ->where('id', $article->id)
                    ->update(['blog_category_id' => $categoryId]);
            });
    }

    public function down(): void
    {
        Schema::table('articles', function (Blueprint $table) {
            if (Schema::hasColumn('articles', 'blog_category_id')) {
                if (Schema::hasIndex('articles', 'articles_blog_category_id_index')) {
                    $table->dropIndex(['blog_category_id']);
                }

                $table->dropColumn('blog_category_id');
            }
        });

        Schema::dropIfExists('blog_categories');
    }
};
