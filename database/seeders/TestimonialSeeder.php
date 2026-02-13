<?php

namespace Database\Seeders;

use App\Models\Testimonial;
use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $testimonials = [
            [
                'customer_name' => 'Siti Rahayu',
                'customer_role' => 'Food Blogger',
                'rating' => 5,
                'content' => 'Cookies terbaik yang pernah saya coba! Choco chip cookies-nya benar-benar sempurna dengan tekstur yang chewy dan rasa cokelat yang intens.',
                'customer_photo' => null,
                'is_approved' => true,
                'is_featured' => true,
            ],
            [
                'customer_name' => 'Budi Santoso',
                'customer_role' => 'Loyal Customer',
                'rating' => 5,
                'content' => 'Double Fudge Brownies adalah favorit keluarga kami. Selalu fresh dan nikmat, sudah langganan sejak bulan pertama buka.',
                'customer_photo' => null,
                'is_approved' => true,
                'is_featured' => true,
            ],
            [
                'customer_name' => 'Dewi Lestari',
                'customer_role' => 'Pastry Chef',
                'rating' => 4,
                'content' => 'Kualitas bahan-bahannya terasa premium. Red Velvet Cookies-nya unik dan lembut, recommended untuk pecinta dessert.',
                'customer_photo' => null,
                'is_approved' => true,
                'is_featured' => false,
            ],
            [
                'customer_name' => 'Andi Pratama',
                'customer_role' => 'Corporate Client',
                'rating' => 5,
                'content' => 'Gift Box Premium sangat cocok untuk hadiah klien. Packaging elegan dan rasanya tidak mengecewakan. Pasti akan repeat order.',
                'customer_photo' => null,
                'is_approved' => true,
                'is_featured' => true,
            ],
            [
                'customer_name' => 'Maya Putri',
                'customer_role' => 'Customer',
                'rating' => 4,
                'content' => 'Oatmeal Raisin Cookies-nya sehat tapi tetap enak. Suka rasanya yang tidak terlalu manis, pas untuk camilan sore.',
                'customer_photo' => null,
                'is_approved' => true,
                'is_featured' => false,
            ],
        ];

        foreach ($testimonials as $testimonial) {
            Testimonial::create($testimonial);
        }
    }
}