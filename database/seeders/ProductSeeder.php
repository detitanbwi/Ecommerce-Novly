<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = \App\Models\Category::all();

        $products = [
            [
                'category_id' => $categories->where('name', 'Books')->first()->id,
                'title' => 'The Minimalist Entrepreneur',
                'slug' => 'the-minimalist-entrepreneur',
                'price' => 150000,
                'description' => "The Minimalist Entrepreneur adalah panduan bagi siapa saja yang ingin membangun bisnis yang menguntungkan tanpa harus membakar uang investor atau mengorbankan waktu tidur.\n\nDalam buku ini, Anda akan belajar:\n- Cara menemukan ide bisnis yang valid.\n- Membangun komunitas sebelum produk.\n- Menjual lebih awal dan sering.\n- Mengotomatiskan sistem kerja.",
                'images' => ['img/products/book.png', 'img/products/book.png', 'img/products/book.png'],
                'external_links' => ['shopee' => 'https://shopee.co.id', 'tokopedia' => 'https://tokopedia.com'],
            ],
            [
                'category_id' => $categories->where('name', 'Property')->first()->id,
                'title' => 'Tanah Kavling Wirodayan Residence',
                'slug' => 'tanah-kavling-wirodayan-residence',
                'price' => 250000000,
                'description' => "Miliki aset berharga di lokasi yang sedang berkembang pesat. Tanah kavling siap bangun dengan sertifikat lengkap dan akses jalan aspal.\n\nFasilitas:\n- Dekat dengan pusat perbelanjaan.\n- Bebas banjir.\n- Lingkungan asri dan tenang.\n- Ukuran bervariasi mulai 100m2.",
                'images' => ['img/products/property.png', 'img/products/property.png'],
                'external_links' => ['tokopedia' => 'https://tokopedia.com'],
            ],
            [
                'category_id' => $categories->where('name', 'Digital Invitations')->first()->id,
                'title' => 'Modern Wedding Invitation Kit',
                'slug' => 'modern-wedding-invitation-kit',
                'price' => 50000,
                'description' => "Bagikan kebahagiaan Anda dengan cara yang modern dan ramah lingkungan. Undangan digital interaktif dengan fitur lengkap.\n\nFitur:\n- Nama tamu custom.\n- RSVP via WhatsApp.\n- Google Maps integration.\n- Background music & Gallery foto.",
                'images' => ['img/products/invitation.png', 'img/products/invitation.png', 'img/products/invitation.png'],
                'external_links' => ['shopee' => 'https://shopee.co.id'],
            ],
            [
                'category_id' => $categories->where('name', 'Chicken Coops')->first()->id,
                'title' => 'Luxury Designer Chicken Coop',
                'slug' => 'luxury-designer-chicken-coop',
                'price' => 3500000,
                'description' => "Berikan yang terbaik bagi peliharaan Anda. Kandang ayam dengan desain modern yang tidak hanya fungsional tapi juga mempercantik halaman rumah Anda.\n\nSpesifikasi:\n- Bahan kayu jati belanda grade A.\n- Atap tahan panas dan hujan.\n- Ruang tidur dan area umbaran luas.\n- Mudah dibersihkan dengan tray laci.",
                'images' => ['img/products/chicken_coop.png', 'img/products/chicken_coop.png'],
                'external_links' => ['shopee' => 'https://shopee.co.id', 'tokopedia' => 'https://tokopedia.com'],
            ],
        ];

        foreach ($products as $product) {
            \App\Models\Product::create($product);
        }
    }
}
