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
                'title' => 'Welcome to Anti Diet Club',
                'subtitle' => 'Indulge in Life\'s Sweetest Moments',
                'description' => 'Discover our handcrafted cookies, brownies, and cakes made with love and premium ingredients. Because life is too short for bad dessert.',
                'image' => 'banners/hero-banner.jpg',
                'button_text' => 'Shop Now',
                'button_link' => '/products',
                'is_active' => true,
                'position' => 'home_hero',
                'sort_order' => 1,
            ],
            [
                'type' => 'promo',
                'title' => 'Weekend Special',
                'subtitle' => '20% Off All Cookies',
                'description' => 'Treat yourself this weekend! Get 20% off on all our delicious cookies. Limited time offer, don\'t miss out!',
                'image' => 'banners/promo-banner.jpg',
                'button_text' => 'Order Now',
                'button_link' => '/products?category=cookies',
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