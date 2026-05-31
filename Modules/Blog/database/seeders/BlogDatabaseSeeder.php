<?php

namespace Modules\Blog\Database\Seeders;

use Illuminate\Database\Seeder;

class BlogDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call([
            AdminSeeder::class,
            PlatformSettingsSeeder::class,
            PageSeeder::class,
            FaqSeeder::class,
            ArticleSeeder::class,
        ]);
    }
}
