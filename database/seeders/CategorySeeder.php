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
                'name' => 'Dessert Series',
                'slug' => 'dessert-series',
                'description' => 'Matcha & Oreo dessert beverages. Creamy, rich, and satisfying.',
                'color' => '#FFB6C1',
                'icon' => '🍵',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'Tea Series',
                'slug' => 'tea-series',
                'description' => 'Thai Tea & Greentea beverages. Refreshing and aromatic.',
                'color' => '#DDA0DD',
                'icon' => '🧋',
                'sort_order' => 2,
                'is_active' => true,
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}