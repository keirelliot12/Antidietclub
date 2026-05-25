<?php

namespace Database\Seeders;

use App\Models\Banner;
use Illuminate\Database\Seeder;

class BannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $banners = [
            [
                'type' => 'hero',
                'title' => 'Welcome to Luwe & Cha-Ology',
                'subtitle' => 'Dessert & Minuman Spesial untukmu',
                'description' => 'Discover our handcrafted desserts made with love and premium ingredients. Karena hidup terlalu singkat untuk dessert biasa.',
                'image' => 'banners/hero-banner.jpg',
                'button_text' => 'Pesan Sekarang',
                'button_link' => '/products',
                'is_active' => true,
                'position' => 'home_hero',
                'sort_order' => 1,
            ],
            [
                'type' => 'promo',
                'title' => 'Grand Opening Promo',
                'subtitle' => 'Semua Item Cuma 5K!',
                'description' => 'Promo spesial grand opening! Thai Tea, Greentea, Dessert Matcha, Dessert Oreo — SEMUA UKURAN cuma Rp 5.000! Berlaku 25-27 Mei 2026. Jangan sampai ketinggalan!',
                'image' => 'banners/promo-banner.jpg',
                'button_text' => 'Pesan Sekarang',
                'button_link' => '/products',
                'is_active' => true,
                'position' => 'home_promo',
                'sort_order' => 2,
            ],
        ];

        foreach ($banners as $banner) {
            Banner::create($banner);
        }
    }
}