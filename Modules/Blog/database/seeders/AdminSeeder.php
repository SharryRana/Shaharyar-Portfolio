<?php

namespace Modules\Blog\Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\User::updateOrCreate(
            ['email' => ''],
            [
                'name' => 'Admin User',
                'username' => 'blogadmin',
                'phone' => null,
                'password' => \Illuminate\Support\Facades\Hash::make('123456'),
                'role' => 'admin',
                'status' => 'active',
            ]
        );
    }
}
