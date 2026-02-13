# Cart System & WhatsApp Integration - Anti Diet Club

## Overview
Session-based cart system with WhatsApp order integration for Anti Diet Club e-commerce site.

## Files Created

### 1. CartService (`app/Services/CartService.php`)
Handles all cart operations using session storage:
- `getCart()` - Retrieve cart from session
- `addToCart($productId, $quantity)` - Add product to cart
- `updateQuantity($productId, $quantity)` - Update item quantity
- `removeItem($productId)` - Remove item from cart
- `clear()` - Clear entire cart
- `getCartItems()` - Get cart items with product details
- `getTotal()` - Calculate cart total
- `getCount()` - Get total item count
- `isEmpty()` - Check if cart is empty
- `formatPrice($price)` - Format price to Indonesian Rupiah

### 2. CartController (`app/Http/Controllers/CartController.php`)
HTTP controllers for cart operations:
- `index()` - Display cart page (`/cart`)
- `add()` - Add product to cart (POST `/cart/add`)
- `update()` - Update quantity (POST `/cart/update`)
- `remove()` - Remove item (POST `/cart/remove`)
- `checkout()` - Display checkout form (`/cart/checkout`)
- `whatsapp()` - Generate WhatsApp message and redirect (POST `/cart/whatsapp`)

### 3. Cart Views

#### `resources/views/cart/index.blade.php`
Cart page showing:
- List of cart items with product image, name, price
- Quantity selector (+/- buttons)
- Remove button for each item
- Item total (price × quantity)
- Cart summary with subtotal and total
- "Checkout via WhatsApp" button
- "Continue Shopping" link
- Empty cart state with call-to-action

#### `resources/views/cart/checkout.blade.php`
Checkout form page with:
- Name input (required)
- Address textarea (required)
- Notes textarea (optional)
- Order summary sidebar
- "Send Order to WhatsApp" button
- WhatsApp icon integration
- Back to cart link

### 4. Routes (`routes/web.php`)
Added cart routes:
- `GET /cart` - View cart
- `POST /cart/add` - Add product to cart
- `POST /cart/update` - Update quantity
- `POST /cart/remove` - Remove item
- `GET /cart/checkout` - Checkout form
- `POST /cart/whatsapp` - Send via WhatsApp

## Features

### Cart System
- **Session-based**: No database storage required
- **Add to cart**: Products can be added with quantity
- **Update quantity**: Increase/decrease or set exact quantity
- **Remove items**: Individual item removal
- **Empty state**: Friendly message when cart is empty
- **Item validation**: Checks product availability

### WhatsApp Integration
- **Message format**:
  ```
  Halo Anti Diet Club! 🍪

  📦 Order:
  - [Product 1] x2 - Rp 90.000
  - [Product 2] x1 - Rp 55.000

  💰 Total: Rp 145.000

  📍 Pengiriman:
  Nama: [customer name]
  Alamat: [address]
  Catatan: [notes]

  Terima kasih! 🙏
  ```
- **Dynamic phone number**: Reads from `Setting::get('whatsapp_phone')`
- **URL encoding**: Properly encodes message for WhatsApp
- **Cart clearing**: Automatically clears cart after order submission

### Styling
- **Pastel color scheme**: Matches Anti Diet Club branding
- **Responsive design**: Mobile-friendly layout
- **Clean UI**: Minimal, modern design with Tailwind CSS
- **Hover effects**: Interactive card animations
- **Sticky sidebar**: Order summary stays visible on checkout

## Usage

### Adding to Cart
```html
<form action="{{ route('cart.add') }}" method="POST">
    @csrf
    <input type="hidden" name="product_id" value="{{ $product->id }}">
    <input type="hidden" name="quantity" value="1">
    <button type="submit">Add to Cart</button>
</form>
```

### Cart Link
```html
<a href="{{ route('cart.index') }}">
    🛒 Cart ({{ app('App\Services\CartService')->getCount() }})
</a>
```

### WhatsApp Phone Configuration
Set the WhatsApp phone number in the Settings table:
- Key: `whatsapp_phone`
- Value: `6281234567890` (without + or spaces)

## Testing
1. Visit `/test-cart` for basic cart testing
2. Add products to cart
3. View cart at `/cart`
4. Proceed to checkout at `/cart/checkout`
5. Fill in delivery details
6. Click "Send Order to WhatsApp"
7. Verify WhatsApp message format

## Notes
- Cart persists in browser session
- Cart is cleared after WhatsApp redirect
- Product availability is checked before adding
- Maximum quantity per item: 99
- Price formatting: Indonesian Rupiah (Rp)