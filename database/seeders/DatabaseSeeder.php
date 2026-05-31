<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::firstOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Test User',
                'username' => 'testuser',
                'phone' => '123-456-7890',
                'password' => Hash::make('password'),
            ]
        );

        $this->call(TeamMemberSeeder::class);
        $this->call(PortfolioContentSeeder::class);
        $this->call(SaasProductSeeder::class);
    }
}
