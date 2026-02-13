<?php

namespace Database\Seeders;

use App\Models\BlogCategory;
use App\Models\BlogPost;
use Illuminate\Database\Seeder;

class BlogPostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create blog categories first
        $categoryTips = BlogCategory::create([
            'name' => 'Tips & Tricks',
            'slug' => 'tips-tricks',
        ]);

        $categoryRecipes = BlogCategory::create([
            'name' => 'Recipes',
            'slug' => 'recipes',
        ]);

        $posts = [
            [
                'title' => '5 Cara Menikmati Cookies Tanpa Rasa Bersalah',
                'slug' => '5-cara-menikmati-cookies-tanpa-rasa-bersalah',
                'category_id' => $categoryTips->id,
                'featured_image' => null,
                'excerpt' => 'Temukan cara menikmati cookies favoritmu tanpa merasa bersalah. Tips praktis untuk menyeimbangkan hasrat manis dengan gaya hidup sehat.',
                'content' => "Siapa yang bilang tidak bisa menikmati cookies tetap hidup sehat? Di Anti Diet Club, kami percaya bahwa keseimbangan adalah kunci kebahagiaan. Berikut adalah lima cara cerdas menikmati cookies tanpa rasa bersalah.

Pertama, pilih cookies dengan bahan berkualitas. Cookies buatan rumah seperti produk kami menggunakan bahan-bahan alami tanpa pengawet buatan. Kualitas bahan sangat mempengaruhi nutrisi dan rasa kenyang yang kamu dapatkan.

Kedua, nikmati dengan penuh kesadaran. Alih-alih makan secara terburu-buru sambil menonton TV, cobalah duduk diam dan benar-benar menikmati setiap gigitan. Rasakan tekstur, rasa, dan aroma cookies. Dengan cara ini, kamu akan merasa puas dengan porsi yang lebih kecil.

Ketiga, kombinasikan dengan makanan sehat. Nikmati cookies bersama dengan buah segar atau segelas susu almond. Kombinasi ini menambah serat dan protein, membuat camilanmu lebih seimbang dan bernutrisi.

Keempat, jadikan momen spesial. Jadikan makan cookies sebagai pengalaman istimewa, mungkin saat menghabiskan waktu berkualitas dengan teman atau keluarga. Ini akan mengurangi kecenderungan makan berlebihan dari rasa bosan atau stres.

Kelima, ingat bahwa hidup tentang keseimbangan. Satu atau dua cookies tidak akan merusak pola makan sehatmu. Yang terpenting adalah pola makan secara keseluruhan, bukan satu camilan saja. Di Anti Diet Club, kami mengajakmu untuk menikmati hidup dengan bijak dan tanpa rasa bersalah.",
                'status' => 'published',
                'published_at' => now(),
                'is_featured' => true,
            ],
            [
                'title' => 'Resep Brownies Fudgy Terbaik',
                'slug' => 'resep-brownies-fudgy-terbaik',
                'category_id' => $categoryRecipes->id,
                'featured_image' => null,
                'excerpt' => 'Pelajari rahasia membuat brownies fudgy sempurna yang lembab dan coklat pekat. Tips dari dapur Anti Diet Club untuk hasil profesional di rumah.',
                'content' => "Brownies fudgy adalah impian setiap pecinta cokelat. Tekstur yang lembab, padat, dan kaya rasa cokelat membuat kue ini sulit ditolak. Hari ini kami berbagi resep rahasia brownies fudgy terbaik yang bisa kamu buat di dapur sendiri.

Kunci dari brownies fudgy sempurna adalah rasio bahan yang tepat. Gunakan lebih banyak mentega daripada tepung, dan pilih cokelat hitam berkualitas tinggi dengan kandungan kakao minimal 60%. Semakin tinggi kualitas cokelat, semakin intens rasanya.

Teknik pencampuran juga sangat penting. Jangan overmix adonan brownies. Campur cukup hingga bahan tergabung, berhenti segera setelah tidak ada tepung yang terlihat. Overmixing akan membuat brownies menjadi keras dan cakey, bukan fudgy seperti yang kita inginkan.

Suhu oven adalah faktor kritis lainnya. Panaskan oven terlebih dahulu pada 175°C dan gunakan termometer oven untuk memastikan suhu akurat. Brownies siap ketika tusuk gigi dimasukkan keluar dengan sedikit remah basah, bukan bersih sepenuhnya. Ini menjamin tekstur fudgy yang sempurna.

Tips terakhir: biarkan brownies mendingin sepenuhnya sebelum dipotong. Ini mungkin sulit, tapi kesabaran akan terbayar dengan potongan yang rapi dan tekstur yang optimal. Simpan dalam wadah kedap udara di suhu ruangan untuk menjaga kelembapan.

Di Anti Diet Club, kami percaya bahwa membuat kue sendiri adalah bentuk cinta. Selamat mencoba resep ini dan jangan lupa berbagi dengan orang tersayang!",
                'status' => 'published',
                'published_at' => now(),
                'is_featured' => false,
            ],
            [
                'title' => 'Tips Mengirim Cookies Hampers untuk Teman',
                'slug' => 'tips-mengirim-cookies-hampers-untuk-teman',
                'category_id' => $categoryTips->id,
                'featured_image' => null,
                'excerpt' => 'Panduan lengkap mengirim kue sebagai hadiah. Pastikan cookies tetap segar dan cantik saat sampai ke tangan penerima.',
                'content' => "Mengirim cookies sebagai hadiah adalah tindakan penuh kasih yang pasti diterima dengan senyuman. Namun, memastikan cookies sampai dalam kondisi sempurna membutuhkan perencanaan yang baik. Berikut adalah tips dari Anti Diet Club untuk mengirim cookies hampers seperti seorang profesional.

Pertama, pilih cookies yang tahan lama. Cookies seperti choco chip atau oatmeal raisin bertahan lebih baik dalam perjalanan dibanding cookies dengan frosting lembut. Produk kami secara khusus dirancang untuk tetap segar selama 3-5 hari dalam kemasan yang tepat.

Kedua, kemas dengan hati-hati. Gunakan wadah kedap udara atau kaleng cookies yang kokoh. Lapisi setiap lapis dengan kertas roti atau kertas baking untuk mencegah cookies saling bergesekan dan pecah. Isi ruang kosong dengan kertas tisu atau bubble wrap untuk mencegah pergerakan.

Ketiga, pertimbangkan pengiriman. Untuk jarak jauh, gunakan jasa ekspedisi dengan tracking dan pilih layanan tercepat. Tambahkan note 'Fragile' pada paket dan hindari pengiriman pada hari Jumat untuk mencegah cookies terjebak di gudang selama akhir pekan.

Keempat, sertakan kartu ucapan personal. Tulis tangan pesan spesial dan sertakan daftar rasa cookies serta tanggal produksi. Sentuhan personal ini membuat hadiahmu lebih berharga dan bermakna bagi penerima.

Kelima, timing adalah segalanya. Usahakan mengirim cookies 1-2 hari sebelum tanggal diperlukan, terutama jika untuk acara spesial. Ini memberikan buffer waktu jika terjadi keterlambatan pengiriman yang tidak diinginkan.

Di Anti Diet Club, kami menawarkan gift box yang sudah dikemas profesional dengan standar pengiriman terbaik. Namun, jika kamu ingin mengirim kue buatan sendiri atau produk kami secara personal, tips ini akan memastikan hadiahmu sampai dengan sempurna. Ingat, hadiah terbaik adalah hadiah yang dikirim dengan c!",
                'status' => 'published',
                'published_at' => now(),
                'is_featured' => true,
            ],
        ];

        foreach ($posts as $post) {
            BlogPost::create($post);
        }
    }
}