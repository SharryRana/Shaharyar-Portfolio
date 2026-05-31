<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $articles = DB::table('articles')
            ->whereNull('author_id')
            ->whereNotNull('author_name')
            ->get(['id', 'author_name', 'author_avatar', 'author_signature']);

        foreach ($articles as $article) {
            $authorName = trim($article->author_name ?: 'Admin');

            if ($authorName === '') {
                $authorName = 'Admin';
            }

            $author = DB::table('authors')
                ->where('name', $authorName)
                ->whereNull('deleted_at')
                ->first();

            if (! $author) {
                $authorId = DB::table('authors')->insertGetId([
                    'name' => $authorName,
                    'avatar' => $article->author_avatar,
                    'signature' => $article->author_signature,
                    'bio' => null,
                    'designation' => null,
                    'is_active' => true,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            } else {
                $authorId = $author->id;

                DB::table('authors')
                    ->where('id', $authorId)
                    ->update([
                        'avatar' => $author->avatar ?: $article->author_avatar,
                        'signature' => $author->signature ?: $article->author_signature,
                        'updated_at' => now(),
                    ]);
            }

            DB::table('articles')
                ->where('id', $article->id)
                ->update(['author_id' => $authorId]);
        }

        if (! DB::table('authors')->whereNull('deleted_at')->exists()) {
            DB::table('authors')->insert([
                'name' => 'Admin',
                'avatar' => null,
                'signature' => null,
                'bio' => null,
                'designation' => null,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    public function down(): void
    {
        DB::table('articles')->update(['author_id' => null]);

        DB::table('authors')
            ->whereIn('name', function ($query) {
                $query->select('author_name')
                    ->from('articles')
                    ->whereNotNull('author_name');
            })
            ->orWhere('name', 'Admin')
            ->delete();
    }
};
