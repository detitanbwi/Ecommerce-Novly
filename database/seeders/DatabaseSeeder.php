<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Admin User
        User::factory()->create([
            'name' => 'Admin Novly',
            'email' => 'admin@novly.com',
            'password' => bcrypt('password'),
        ]);

        // Categories
        $categories = [
            'Buku',
            'Properti',
            'Lain-Lain'
        ];

        foreach ($categories as $category) {
            \App\Models\Category::create([
                'name' => $category,
                'slug' => \Illuminate\Support\Str::slug($category)
            ]);
        }

        // Settings
        \App\Models\Setting::create([
            'key' => 'whatsapp_number',
            'value' => '6281234567890' // Default WA
        ]);
    }
}
