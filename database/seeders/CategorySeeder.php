<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Cookies',
                'slug' => 'cookies',
                'description' => 'Delicious homemade cookies with various flavors and textures.',
                'color' => '#FFB6C1',
                'icon' => null,
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'Brownies',
                'slug' => 'brownies',
                'description' => 'Rich, fudgy brownies that melt in your mouth.',
                'color' => '#DDA0DD',
                'icon' => null,
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'name' => 'Cakes',
                'slug' => 'cakes',
                'description' => 'Soft and moist cakes for every celebration.',
                'color' => '#FFFACD',
                'icon' => null,
                'sort_order' => 3,
                'is_active' => true,
            ],
            [
                'name' => 'Gift Sets',
                'slug' => 'gift-sets',
                'description' => 'Perfect gift boxes for your loved ones.',
                'color' => '#B0E0E6',
                'icon' => null,
                'sort_order' => 4,
                'is_active' => true,
            ],
            [
                'name' => 'Limited Edition',
                'slug' => 'limited-edition',
                'description' => 'Exclusive treats available for a limited time only.',
                'color' => '#FFA07A',
                'icon' => null,
                'sort_order' => 5,
                'is_active' => true,
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}