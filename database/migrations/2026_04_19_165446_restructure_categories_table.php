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
        // 1. Ensure new names for core categories
        \DB::table('categories')->where('name', 'Books')->update(['name' => 'Buku', 'slug' => 'buku']);
        \DB::table('categories')->where('name', 'Property')->update(['name' => 'Properti', 'slug' => 'properti']);

        // 2. Create 'Lain-Lain'
        $othersId = \DB::table('categories')->insertGetId([
            'name' => 'Lain-Lain',
            'slug' => 'lain-lain',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // 3. Move products from obsolete categories to 'Lain-Lain'
        // Categories to be removed: Digital Invitations, Chicken Coops
        $obsoleteIds = \DB::table('categories')
            ->whereIn('name', ['Digital Invitations', 'Chicken Coops'])
            ->pluck('id');

        \DB::table('products')->whereIn('category_id', $obsoleteIds)->update(['category_id' => $othersId]);

        // 4. Delete obsolete categories
        \DB::table('categories')->whereIn('id', $obsoleteIds)->delete();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
