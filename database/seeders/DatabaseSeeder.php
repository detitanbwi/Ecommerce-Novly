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
            'name' => 'Admin Klabat Online',
            'email' => 'admin@novly.com',
            'password' => bcrypt('password'),
        ]);

        // Categories
        $categories = [
            'Buku',
            'Properti',
            'Lain-Lain'
        ];

        // Clean Slate
        \App\Models\Category::query()->delete();

        foreach ($categories as $category) {
            \App\Models\Category::updateOrCreate(
                ['slug' => \Illuminate\Support\Str::slug($category)],
                ['name' => $category]
            );
        }

        // Run Product Seeder
        $this->call(ProductSeeder::class);

        // Settings
        \App\Models\Setting::updateOrCreate(
            ['key' => 'whatsapp_number'],
            ['value' => '6281234567890']
        );
    }
}
