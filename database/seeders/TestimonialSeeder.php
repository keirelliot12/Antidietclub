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
                'content' => 'Dessert Series Matcha-nya creamy banget! Porsi standard 250ml pas untuk dinikmati sambil nugas. Recommended buat pecinta matcha!',
                'customer_photo' => null,
                'is_approved' => true,
                'is_featured' => true,
            ],
            [
                'customer_name' => 'Budi Santoso',
                'customer_role' => 'Loyal Customer',
                'rating' => 5,
                'content' => 'Thai Tea-nya enak dan segar! Sudah langganan sejak grand opening. Harganya juga terjangkau banget untuk kualitas sebagus ini.',
                'customer_photo' => null,
                'is_approved' => true,
                'is_featured' => true,
            ],
            [
                'customer_name' => 'Dewi Lestari',
                'customer_role' => 'Pelanggan',
                'rating' => 5,
                'content' => 'Oreo Dessert-nya beneran bikin ketagihan! Creamy, manisnya pas, dan Oreo crumbs-nya banyak. Large size puas banget!',
                'customer_photo' => null,
                'is_approved' => true,
                'is_featured' => true,
            ],
            [
                'customer_name' => 'Andi Pratama',
                'customer_role' => 'Corporate Client',
                'rating' => 5,
                'content' => 'Pesan 20 cup Greentea untuk meeting kantor. Semua rekan suka! Packaging rapi dan datang masih dingin. Pasti repeat order.',
                'customer_photo' => null,
                'is_approved' => true,
                'is_featured' => false,
            ],
            [
                'customer_name' => 'Maya Putri',
                'customer_role' => 'Mahasiswa',
                'rating' => 4,
                'content' => 'Harga 5k untuk ukuran small itu murah banget! Cocok untuk anak kost yang pengen minum enak tapi hemat. Tea Series favoritku!',
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