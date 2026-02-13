<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of products with filtering and sorting.
     */
    public function index(Request $request)
    {
        // Get filter values from request
        $categorySlug = $request->input('category');
        $searchKeyword = $request->input('search');
        $selectedCategories = $request->input('categories', []);
        $priceMin = $request->input('price_min', 0);
        $priceMax = $request->input('price_max', 999999);
        $sortBy = $request->input('sort', 'name_asc');
        $featuredOnly = $request->has('featured');

        // Get the minimum and maximum prices in the database
        $priceRange = Product::selectRaw('MIN(price) as min_price, MAX(price) as max_price')
            ->where('is_available', true)
            ->first();

        $minPriceDb = $priceRange->min_price ?? 25000;
        $maxPriceDb = $priceRange->max_price ?? 150000;

        // Build query
        $query = Product::where('is_available', true)
            ->with(['category', 'primaryImage']);

        // Filter by category slug (from URL parameter)
        if ($categorySlug) {
            $category = Category::where('slug', $categorySlug)->where('is_active', true)->first();
            if ($category) {
                $query->where('category_id', $category->id);
                // Add to selected categories for display
                if (!in_array($category->id, $selectedCategories)) {
                    $selectedCategories[] = $category->id;
                }
            }
        }

        // Filter by search keyword
        if ($searchKeyword) {
            $query->where('name', 'like', '%' . $searchKeyword . '%');
        }

        // Filter by categories (from sidebar)
        if (!empty($selectedCategories)) {
            $query->whereIn('category_id', $selectedCategories);
        }

        // Filter by price range
        $query->whereBetween('price', [$priceMin, $priceMax]);

        // Filter by featured only
        if ($featuredOnly) {
            $query->where('is_featured', true);
        }

        // Apply sorting
        switch ($sortBy) {
            case 'price_low':
                $query->orderBy('price', 'asc');
                break;
            case 'price_high':
                $query->orderBy('price', 'desc');
                break;
            case 'name_desc':
                $query->orderBy('name', 'desc');
                break;
            case 'name_asc':
            default:
                $query->orderBy('name', 'asc');
                break;
        }

        // Paginate results (12 per page for better grid layout)
        $products = $query->paginate(12);

        // Get all active categories for filter buttons
        $categories = Category::where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        // Get cart count from CartService
        $cartService = new \App\Services\CartService();
        $cartCount = $cartService->getCount();

        return view('products.index', compact(
            'products',
            'categories',
            'categorySlug',
            'searchKeyword',
            'selectedCategories',
            'priceMin',
            'priceMax',
            'minPriceDb',
            'maxPriceDb',
            'sortBy',
            'featuredOnly',
            'cartCount'
        ));
    }

    /**
     * Display the specified product.
     */
    public function show($slug)
    {
        $product = Product::where('slug', $slug)
            ->with(['category', 'images'])
            ->firstOrFail();

        // Get related products from the same category (max 4, excluding current product)
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->where('is_available', true)
            ->with(['category', 'primaryImage'])
            ->orderBy('sort_order')
            ->take(4)
            ->get();

        // Get cart count from CartService
        $cartService = new \App\Services\CartService();
        $cartCount = $cartService->getCount();

        return view('products.show', compact(
            'product',
            'relatedProducts',
            'cartCount'
        ));
    }

    /**
     * Add product to cart.
     */
    public function addToCart(Request $request, $slug)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1|max:99',
        ]);

        $quantity = $request->input('quantity', 1);

        try {
            $product = Product::where('slug', $slug)
                ->where('is_available', true)
                ->firstOrFail();

            $cartService = new \App\Services\CartService();
            $cartService->addToCart($product->id, $quantity);

            return response()->json([
                'success' => true,
                'message' => 'Product added to cart successfully!',
                'cart_count' => $cartService->getCount()
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Could not add product to cart.'
            ], 400);
        }
    }
}