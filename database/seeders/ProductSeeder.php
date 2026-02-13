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
            [
                'name' => 'Choco Chip Cookies',
                'slug' => 'choco-chip-cookies',
                'category_id' => $categories->where('slug', 'cookies')->first()->id,
                'description' => 'Classic chocolate chip cookies with a perfect balance of crispy edges and chewy centers. Made with premium Belgian chocolate chunks.',
                'ingredients' => 'Flour, Butter, Sugar, Eggs, Belgian Chocolate Chips, Vanilla Extract, Salt',
                'price' => 45000,
                'weight' => 200,
                'is_featured' => true,
                'is_available' => true,
            ],
            [
                'name' => 'Double Fudge Brownies',
                'slug' => 'double-fudge-brownies',
                'category_id' => $categories->where('slug', 'brownies')->first()->id,
                'description' => 'Rich and decadent double fudge brownies that melt in your mouth. Perfect for chocolate lovers who crave intense flavor.',
                'ingredients' => 'Dark Chocolate, Butter, Sugar, Eggs, Flour, Cocoa Powder, Vanilla Extract',
                'price' => 55000,
                'weight' => 200,
                'is_featured' => true,
                'is_available' => true,
            ],
            [
                'name' => 'Red Velvet Cookies',
                'slug' => 'red-velvet-cookies',
                'category_id' => $categories->where('slug', 'cookies')->first()->id,
                'description' => 'Beautiful red velvet cookies with a hint of cocoa and cream cheese frosting. A perfect treat for any occasion.',
                'ingredients' => 'Flour, Cocoa Powder, Butter, Sugar, Eggs, Cream Cheese, Vanilla Extract',
                'price' => 50000,
                'weight' => 200,
                'is_featured' => false,
                'is_available' => true,
            ],
            [
                'name' => 'Classic Chocolate Cake',
                'slug' => 'classic-chocolate-cake',
                'category_id' => $categories->where('slug', 'cakes')->first()->id,
                'description' => 'Moist and fluffy chocolate cake layered with rich chocolate ganache. The ultimate comfort dessert for chocolate enthusiasts.',
                'ingredients' => 'Flour, Cocoa Powder, Sugar, Butter, Eggs, Milk, Dark Chocolate Ganache',
                'price' => 85000,
                'weight' => 500,
                'is_featured' => true,
                'is_available' => true,
            ],
            [
                'name' => 'Oatmeal Raisin Cookies',
                'slug' => 'oatmeal-raisin-cookies',
                'category_id' => $categories->where('slug', 'cookies')->first()->id,
                'description' => 'Wholesome oatmeal cookies loaded with plump raisins and a touch of cinnamon. A healthier cookie option without compromising taste.',
                'ingredients' => 'Oats, Flour, Butter, Brown Sugar, Raisins, Cinnamon, Eggs, Vanilla Extract',
                'price' => 40000,
                'weight' => 200,
                'is_featured' => false,
                'is_available' => true,
            ],
            [
                'name' => 'Gift Box Premium',
                'slug' => 'gift-box-premium',
                'category_id' => $categories->where('slug', 'gift-sets')->first()->id,
                'description' => 'Elegant gift box featuring an assortment of our best-selling cookies and brownies. Perfect for special occasions and corporate gifts.',
                'ingredients' => 'Assorted cookies and brownies with various premium ingredients',
                'price' => 150000,
                'weight' => 500,
                'is_featured' => true,
                'is_available' => true,
            ],
            [
                'name' => 'Salted Caramel Brownies',
                'slug' => 'salted-caramel-brownies',
                'category_id' => $categories->where('slug', 'brownies')->first()->id,
                'description' => 'Fudgy brownies swirled with homemade salted caramel. The perfect combination of sweet and salty flavors.',
                'ingredients' => 'Dark Chocolate, Butter, Sugar, Eggs, Flour, Salted Caramel, Sea Salt',
                'price' => 60000,
                'weight' => 200,
                'is_featured' => false,
                'is_available' => true,
            ],
            [
                'name' => 'Matcha Green Tea Cookies',
                'slug' => 'matcha-green-tea-cookies',
                'category_id' => $categories->where('slug', 'limited-edition')->first()->id,
                'description' => 'Delicate matcha-infused cookies with a subtle earthy flavor and beautiful green hue. Limited edition seasonal treat.',
                'ingredients' => 'Premium Matcha Powder, Flour, Butter, Sugar, Eggs, White Chocolate Chips',
                'price' => 55000,
                'weight' => 100,
                'is_featured' => true,
                'is_available' => true,
            ],
            [
                'name' => 'Birthday Celebration Cake',
                'slug' => 'birthday-celebration-cake',
                'category_id' => $categories->where('slug', 'cakes')->first()->id,
                'description' => 'Colorful vanilla cake with rainbow sprinkles and buttercream frosting. The perfect centerpiece for birthday celebrations.',
                'ingredients' => 'Flour, Butter, Sugar, Eggs, Vanilla Extract, Rainbow Sprinkles, Buttercream',
                'price' => 75000,
                'weight' => 500,
                'is_featured' => false,
                'is_available' => true,
            ],
            [
                'name' => 'Mini Cookies Gift Set',
                'slug' => 'mini-cookies-gift-set',
                'category_id' => $categories->where('slug', 'gift-sets')->first()->id,
                'description' => 'Charming gift box containing bite-sized versions of our popular cookie flavors. Great for sharing and party favors.',
                'ingredients' => 'Assorted mini cookies with various premium ingredients',
                'price' => 80000,
                'weight' => 300,
                'is_featured' => false,
                'is_available' => true,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}