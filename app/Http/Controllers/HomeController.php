<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Product;
use App\Models\Category;
use App\Models\Testimonial;
use App\Models\Setting;

class HomeController extends Controller
{
    public function index()
    {
        // Get active hero banner
        $heroBanner = Banner::where('type', 'hero')
            ->where('is_active', true)
            ->first();

        // Get featured products
        $featuredProducts = Product::where('is_featured', true)
            ->where('is_available', true)
            ->with(['category', 'primaryImage'])
            ->orderBy('sort_order')
            ->take(8)
            ->get();

        // Get active categories
        $categories = Category::where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        // Get featured and approved testimonials
        $testimonials = Testimonial::where('is_featured', true)
            ->where('is_approved', true)
            ->orderBy('created_at', 'desc')
            ->get();

        // Get settings for contact info and social media
        $whatsappNumber = Setting::get('whatsapp_phone', '+6281332875057');
        $contactPhone = Setting::get('contact_phone', '+62 812 3456 7890');
        $contactAddress = Setting::get('contact_address', 'Jakarta, Indonesia');
        $instagramUrl = Setting::get('instagram_url', '#');
        $tiktokUrl = Setting::get('tiktok_url', '#');
        $facebookUrl = Setting::get('facebook_url', '#');

        return view('home', compact(
            'heroBanner',
            'featuredProducts',
            'categories',
            'testimonials',
            'whatsappNumber',
            'contactPhone',
            'contactAddress',
            'instagramUrl',
            'tiktokUrl',
            'facebookUrl'
        ));
    }
}