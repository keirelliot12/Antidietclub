<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = Category::all();

        $products = [
            // Dessert Series (Matcha & Oreo)
            [
                'name' => 'Dessert Series - Matcha & Oreo (Small)',
                'slug' => 'dessert-series-matcha-oreo-small',
                'category_id' => $categories->where('slug', 'dessert-series')->first()->id,
                'description' => 'Minuman dessert creamy dengan pilihan rasa Matcha atau Oreo. Ukuran small 120ml, cocok untuk camilan ringan. Harga asli Rp 6.000 — Promo Grand Opening Rp 5.000!',
                'ingredients' => 'Susu, Matcha Powder / Oreo Crumbs, Gula, Es Batu, Cream',
                'price' => 6000,
                'weight' => 120,
                'is_featured' => false,
                'is_available' => true,
                'sort_order' => 1,
            ],
            [
                'name' => 'Dessert Series - Matcha & Oreo (Standard)',
                'slug' => 'dessert-series-matcha-oreo-standard',
                'category_id' => $categories->where('slug', 'dessert-series')->first()->id,
                'description' => 'Minuman dessert creamy dengan pilihan rasa Matcha atau Oreo. Ukuran standard 250ml, porsi pas untuk dinikmati kapan saja.',
                'ingredients' => 'Susu, Matcha Powder / Oreo Crumbs, Gula, Es Batu, Cream',
                'price' => 11000,
                'weight' => 250,
                'is_featured' => true,
                'is_available' => true,
                'sort_order' => 2,
            ],
            [
                'name' => 'Dessert Series - Matcha & Oreo (Large)',
                'slug' => 'dessert-series-matcha-oreo-large',
                'category_id' => $categories->where('slug', 'dessert-series')->first()->id,
                'description' => 'Minuman dessert creamy dengan pilihan rasa Matcha atau Oreo. Ukuran large 350ml, puas untuk menemani harimu.',
                'ingredients' => 'Susu, Matcha Powder / Oreo Crumbs, Gula, Es Batu, Cream',
                'price' => 14000,
                'weight' => 350,
                'is_featured' => false,
                'is_available' => true,
                'sort_order' => 3,
            ],
            // Tea Series (Thai Tea & Greentea)
            [
                'name' => 'Tea Series - Thai Tea & Greentea (Small)',
                'slug' => 'tea-series-thai-greentea-small',
                'category_id' => $categories->where('slug', 'tea-series')->first()->id,
                'description' => 'Teh segar dengan pilihan rasa Thai Tea atau Greentea. Ukuran small 250ml, menyegarkan dan menyenangkan. Harga asli Rp 7.000 — Promo Grand Opening Rp 5.000!',
                'ingredients' => 'Thai Tea / Greentea, Gula, Susu, Es Batu',
                'price' => 7000,
                'weight' => 250,
                'is_featured' => false,
                'is_available' => true,
                'sort_order' => 4,
            ],
            [
                'name' => 'Tea Series - Thai Tea & Greentea (Standard)',
                'slug' => 'tea-series-thai-greentea-standard',
                'category_id' => $categories->where('slug', 'tea-series')->first()->id,
                'description' => 'Teh segar dengan pilihan rasa Thai Tea atau Greentea. Ukuran standard 350ml, favorit pelanggan!',
                'ingredients' => 'Thai Tea / Greentea, Gula, Susu, Es Batu',
                'price' => 11000,
                'weight' => 350,
                'is_featured' => true,
                'is_available' => true,
                'sort_order' => 5,
            ],
            [
                'name' => 'Tea Series - Thai Tea & Greentea (Large)',
                'slug' => 'tea-series-thai-greentea-large',
                'category_id' => $categories->where('slug', 'tea-series')->first()->id,
                'description' => 'Teh segar dengan pilihan rasa Thai Tea atau Greentea. Ukuran large 500ml, puas banget!',
                'ingredients' => 'Thai Tea / Greentea, Gula, Susu, Es Batu',
                'price' => 17000,
                'weight' => 500,
                'is_featured' => false,
                'is_available' => true,
                'sort_order' => 6,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}