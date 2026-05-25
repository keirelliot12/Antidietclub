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
            // ── Dessert Series ──

            // Oreo Small
            [
                'name' => 'Dessert Series - Oreo (Small)',
                'slug' => 'dessert-series-oreo-small',
                'category_id' => $categories->where('slug', 'dessert-series')->first()->id,
                'description' => 'Minuman dessert creamy Oreo. Ukuran small 120ml, cocok untuk camilan ringan. Harga asli Rp 6.000 — Promo Grand Opening Rp 5.000!',
                'ingredients' => 'Susu, Oreo Crumbs, Gula, Es Batu, Cream',
                'price' => 6000,
                'weight' => 120,
                'is_featured' => false,
                'is_available' => true,
                'sort_order' => 1,
            ],
            // Matcha Small
            [
                'name' => 'Dessert Series - Matcha (Small)',
                'slug' => 'dessert-series-matcha-small',
                'category_id' => $categories->where('slug', 'dessert-series')->first()->id,
                'description' => 'Minuman dessert creamy Matcha. Ukuran small 120ml, cocok untuk camilan ringan. Harga asli Rp 6.000 — Promo Grand Opening Rp 5.000!',
                'ingredients' => 'Susu, Matcha Powder, Gula, Es Batu, Cream',
                'price' => 6000,
                'weight' => 120,
                'is_featured' => false,
                'is_available' => true,
                'sort_order' => 2,
            ],
            // Oreo Standard
            [
                'name' => 'Dessert Series - Oreo (Standard)',
                'slug' => 'dessert-series-oreo-standard',
                'category_id' => $categories->where('slug', 'dessert-series')->first()->id,
                'description' => 'Minuman dessert creamy Oreo. Ukuran standard 250ml, porsi pas untuk dinikmati kapan saja.',
                'ingredients' => 'Susu, Oreo Crumbs, Gula, Es Batu, Cream',
                'price' => 11000,
                'weight' => 250,
                'is_featured' => true,
                'is_available' => true,
                'sort_order' => 3,
            ],
            // Matcha Standard
            [
                'name' => 'Dessert Series - Matcha (Standard)',
                'slug' => 'dessert-series-matcha-standard',
                'category_id' => $categories->where('slug', 'dessert-series')->first()->id,
                'description' => 'Minuman dessert creamy Matcha. Ukuran standard 250ml, favorit pencinta matcha!',
                'ingredients' => 'Susu, Matcha Powder, Gula, Es Batu, Cream',
                'price' => 11000,
                'weight' => 250,
                'is_featured' => true,
                'is_available' => true,
                'sort_order' => 4,
            ],
            // Oreo Large
            [
                'name' => 'Dessert Series - Oreo (Large)',
                'slug' => 'dessert-series-oreo-large',
                'category_id' => $categories->where('slug', 'dessert-series')->first()->id,
                'description' => 'Minuman dessert creamy Oreo. Ukuran large 350ml, puas untuk menemani harimu.',
                'ingredients' => 'Susu, Oreo Crumbs, Gula, Es Batu, Cream',
                'price' => 14000,
                'weight' => 350,
                'is_featured' => false,
                'is_available' => true,
                'sort_order' => 5,
            ],
            // Matcha Large
            [
                'name' => 'Dessert Series - Matcha (Large)',
                'slug' => 'dessert-series-matcha-large',
                'category_id' => $categories->where('slug', 'dessert-series')->first()->id,
                'description' => 'Minuman dessert creamy Matcha. Ukuran large 350ml, puas banget buat pecinta matcha!',
                'ingredients' => 'Susu, Matcha Powder, Gula, Es Batu, Cream',
                'price' => 14000,
                'weight' => 350,
                'is_featured' => false,
                'is_available' => true,
                'sort_order' => 6,
            ],

            // ── Tea Series ──

            // Thai Tea Small
            [
                'name' => 'Tea Series - Thai Tea (Small)',
                'slug' => 'tea-series-thai-tea-small',
                'category_id' => $categories->where('slug', 'tea-series')->first()->id,
                'description' => 'Thai Tea segar klasik. Ukuran small 250ml, menyegarkan dan menyenangkan. Harga asli Rp 7.000 — Promo Grand Opening Rp 5.000!',
                'ingredients' => 'Thai Tea, Gula, Susu, Es Batu',
                'price' => 7000,
                'weight' => 250,
                'is_featured' => false,
                'is_available' => true,
                'sort_order' => 7,
            ],
            // Greentea Small
            [
                'name' => 'Tea Series - Greentea (Small)',
                'slug' => 'tea-series-greentea-small',
                'category_id' => $categories->where('slug', 'tea-series')->first()->id,
                'description' => 'Greentea segar premium. Ukuran small 250ml, seger dan ringan. Harga asli Rp 7.000 — Promo Grand Opening Rp 5.000!',
                'ingredients' => 'Greentea, Gula, Susu, Es Batu',
                'price' => 7000,
                'weight' => 250,
                'is_featured' => false,
                'is_available' => true,
                'sort_order' => 8,
            ],
            // Thai Tea Standard
            [
                'name' => 'Tea Series - Thai Tea (Standard)',
                'slug' => 'tea-series-thai-tea-standard',
                'category_id' => $categories->where('slug', 'tea-series')->first()->id,
                'description' => 'Thai Tea segar klasik. Ukuran standard 350ml, favorit pelanggan!',
                'ingredients' => 'Thai Tea, Gula, Susu, Es Batu',
                'price' => 11000,
                'weight' => 350,
                'is_featured' => true,
                'is_available' => true,
                'sort_order' => 9,
            ],
            // Greentea Standard
            [
                'name' => 'Tea Series - Greentea (Standard)',
                'slug' => 'tea-series-greentea-standard',
                'category_id' => $categories->where('slug', 'tea-series')->first()->id,
                'description' => 'Greentea segar premium. Ukuran standard 350ml, pas banget buat daily!',
                'ingredients' => 'Greentea, Gula, Susu, Es Batu',
                'price' => 11000,
                'weight' => 350,
                'is_featured' => true,
                'is_available' => true,
                'sort_order' => 10,
            ],
            // Thai Tea Large
            [
                'name' => 'Tea Series - Thai Tea (Large)',
                'slug' => 'tea-series-thai-tea-large',
                'category_id' => $categories->where('slug', 'tea-series')->first()->id,
                'description' => 'Thai Tea segar klasik. Ukuran large 500ml, puas banget!',
                'ingredients' => 'Thai Tea, Gula, Susu, Es Batu',
                'price' => 17000,
                'weight' => 500,
                'is_featured' => false,
                'is_available' => true,
                'sort_order' => 11,
            ],
            // Greentea Large
            [
                'name' => 'Tea Series - Greentea (Large)',
                'slug' => 'tea-series-greentea-large',
                'category_id' => $categories->where('slug', 'tea-series')->first()->id,
                'description' => 'Greentea segar premium. Ukuran large 500ml, seger maksimal!',
                'ingredients' => 'Greentea, Gula, Susu, Es Batu',
                'price' => 17000,
                'weight' => 500,
                'is_featured' => false,
                'is_available' => true,
                'sort_order' => 12,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}