<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Facades\Session;

class CartService
{
    protected $sessionKey = 'cart';

    /**
     * Get cart from session
     */
    public function getCart()
    {
        return Session::get($this->sessionKey, []);
    }

    /**
     * Add product to cart
     */
    public function addToCart($productId, $quantity = 1)
    {
        $cart = $this->getCart();
        $product = Product::findOrFail($productId);

        if (!$product->is_available) {
            throw new \Exception('Produk tidak tersedia');
        }

        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] += $quantity;
        } else {
            $cart[$productId] = [
                'product_id' => $productId,
                'quantity' => $quantity,
            ];
        }

        \Log::info('Before save', [
            'session_id' => session()->getId(),
            'cart_before' => Session::get($this->sessionKey, []),
        ]);

        Session::put($this->sessionKey, $cart);
        Session::save(); // Force save session

        \Log::info('After save', [
            'session_id' => session()->getId(),
            'cart_after' => Session::get($this->sessionKey, []),
        ]);

        return $cart;
    }

    /**
     * Update quantity of item in cart
     */
    public function updateQuantity($productId, $quantity)
    {
        $cart = $this->getCart();

        if (!isset($cart[$productId])) {
            throw new \Exception('Produk tidak ditemukan di keranjang');
        }

        if ($quantity <= 0) {
            unset($cart[$productId]);
        } else {
            $cart[$productId]['quantity'] = $quantity;
        }

        Session::put($this->sessionKey, $cart);
        Session::save(); // Force save session

        return $cart;
    }

    /**
     * Remove item from cart
     */
    public function removeItem($productId)
    {
        $cart = $this->getCart();

        if (isset($cart[$productId])) {
            unset($cart[$productId]);
            Session::put($this->sessionKey, $cart);
            Session::save(); // Force save session
        }

        return $cart;
    }

    /**
     * Clear cart
     */
    public function clear()
    {
        Session::forget($this->sessionKey);
        Session::save(); // Force save session
    }

    /**
     * Get cart items with product details
     */
    public function getCartItems()
    {
        $cart = $this->getCart();
        $items = [];

        foreach ($cart as $productId => $data) {
            $product = Product::find($productId);
            if ($product) {
                $items[] = [
                    'product' => $product,
                    'quantity' => $data['quantity'],
                    'subtotal' => $product->price * $data['quantity'],
                ];
            }
        }

        return $items;
    }

    /**
     * Get cart total
     */
    public function getTotal()
    {
        $items = $this->getCartItems();
        $total = 0;

        foreach ($items as $item) {
            $total += $item['subtotal'];
        }

        return $total;
    }

    /**
     * Get cart count (total items)
     */
    public function getCount()
    {
        $cart = $this->getCart();
        $count = 0;

        foreach ($cart as $item) {
            $count += $item['quantity'];
        }

        return $count;
    }

    /**
     * Check if cart is empty
     */
    public function isEmpty()
    {
        return empty($this->getCart());
    }

    /**
     * Format price to Indonesian Rupiah
     */
    public function formatPrice($price)
    {
        return 'Rp ' . number_format($price, 0, ',', '.');
    }
}