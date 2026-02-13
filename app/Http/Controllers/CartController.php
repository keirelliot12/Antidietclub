<?php

namespace App\Http\Controllers;

use App\Services\CartService;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class CartController extends Controller
{
    protected $cartService;

    public function __construct()
    {
        $this->cartService = new CartService();
    }

    /**
     * Display cart page
     */
    public function index()
    {
        // Debug: Log session info
        \Log::info('Cart page loaded', [
            'session_id' => session()->getId(),
            'cart_count' => $this->cartService->getCount(),
            'cart_data' => $this->cartService->getCart()
        ]);

        $cartItems = $this->cartService->getCartItems();
        $total = $this->cartService->getTotal();
        $isEmpty = $this->cartService->isEmpty();

        return view('cart.index', compact('cartItems', 'total', 'isEmpty'));
    }

    /**
     * Add product to cart
     */
    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|integer|exists:products,id',
            'quantity' => 'nullable|integer|min:1|max:99',
        ]);

        $productId = $request->input('product_id');
        $quantity = $request->input('quantity', 1);

        try {
            $this->cartService->addToCart($productId, $quantity);

            // Debug: Log session info
            \Log::info('Cart added', [
                'session_id' => session()->getId(),
                'cart_count' => $this->cartService->getCount(),
                'cart_data' => $this->cartService->getCart()
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Product added to cart successfully!',
                'cart_count' => $this->cartService->getCount()
            ]);
        } catch (\Exception $e) {
            \Log::error('Cart add error', [
                'error' => $e->getMessage(),
                'session_id' => session()->getId()
            ]);
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 400);
        }
    }

    /**
     * Update item quantity
     */
    public function update(Request $request)
    {
        $request->validate([
            'product_id' => 'required|integer|exists:products,id',
            'quantity' => 'required|integer|min:0|max:99',
        ]);

        $productId = $request->input('product_id');
        $quantity = $request->input('quantity');

        try {
            $this->cartService->updateQuantity($productId, $quantity);

            return redirect()
                ->route('cart.index')
                ->with('success', 'Keranjang berhasil diperbarui!');
        } catch (\Exception $e) {
            return redirect()
                ->route('cart.index')
                ->with('error', $e->getMessage());
        }
    }

    /**
     * Remove item from cart
     */
    public function remove(Request $request)
    {
        $request->validate([
            'product_id' => 'required|integer|exists:products,id',
        ]);

        $productId = $request->input('product_id');

        $this->cartService->removeItem($productId);

        return redirect()
            ->route('cart.index')
            ->with('success', 'Produk berhasil dihapus dari keranjang!');
    }

    /**
     * Display checkout form
     */
    public function checkout()
    {
        if ($this->cartService->isEmpty()) {
            return redirect()
                ->route('cart.index')
                ->with('error', 'Keranjang Anda kosong!');
        }

        $cartItems = $this->cartService->getCartItems();
        $total = $this->cartService->getTotal();

        return view('cart.checkout', compact('cartItems', 'total'));
    }

    /**
     * Generate WhatsApp message and redirect
     */
    public function whatsapp(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:1000',
            'notes' => 'nullable|string|max:500',
        ]);

        if ($this->cartService->isEmpty()) {
            return redirect()
                ->route('cart.index')
                ->with('error', 'Keranjang Anda kosong!');
        }

        $cartItems = $this->cartService->getCartItems();
        $total = $this->cartService->getTotal();

        // Get WhatsApp phone from settings
        $whatsappPhone = Setting::get('whatsapp_phone', '6281234567890');

        // Build order message
        $message = 'Halo Anti Diet Club! 🍪' . PHP_EOL . PHP_EOL;
        $message .= '📦 Order:' . PHP_EOL;

        foreach ($cartItems as $item) {
            $product = $item['product'];
            $quantity = $item['quantity'];
            $subtotal = $item['subtotal'];

            $message .= sprintf(
                '- %s x%d - %s' . PHP_EOL,
                $product->name,
                $quantity,
                $this->cartService->formatPrice($subtotal)
            );
        }

        $message .= sprintf(PHP_EOL . '💰 Total: %s' . PHP_EOL . PHP_EOL, $this->cartService->formatPrice($total));
        $message .= '📍 Pengiriman:' . PHP_EOL;
        $message .= sprintf('Nama: %s' . PHP_EOL, $request->input('name'));
        $message .= sprintf('Alamat: %s' . PHP_EOL, $request->input('address'));

        if ($request->filled('notes')) {
            $message .= sprintf('Catatan: %s' . PHP_EOL, $request->input('notes'));
        }

        $message .= PHP_EOL . 'Terima kasih! 🙏';

        // Clear cart after order
        $this->cartService->clear();

        // Redirect to WhatsApp
        $whatsappUrl = sprintf(
            'https://wa.me/%s?text=%s',
            $whatsappPhone,
            rawurlencode($message)
        );

        return redirect()->away($whatsappUrl);
    }
}