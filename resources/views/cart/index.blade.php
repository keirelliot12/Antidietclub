<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart - Anti Diet Club</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fredoka+One&family=Poppins:wght@300;400;500;600;700&family=Pacifico&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        pastel: {
                            pink: '#FFB6C1',
                            purple: '#DDA0DD',
                            yellow: '#FFFACD',
                            blue: '#B0E0E6',
                            orange: '#FFA07A',
                            cream: '#FFF8E7',
                        }
                    },
                    fontFamily: {
                        heading: ['Fredoka One', 'cursive'],
                        body: ['Poppins', 'sans-serif'],
                        accent: ['Pacifico', 'cursive'],
                    },
                    boxShadow: {
                        'soft': '0 8px 30px rgba(0, 0, 0, 0.08)',
                        'softer': '0 4px 20px rgba(0, 0, 0, 0.05)',
                    }
                }
            }
        }
    </script>
    <style>
        .card-hover {
            transition: all 0.3s ease;
        }
        .card-hover:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.12);
        }
    </style>
</head>
<body class="font-body bg-pastel-cream min-h-screen">

    <!-- Navigation -->
    @include('components.navbar')

    <!-- Cart Page -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 pt-20">
        <div class="text-center mb-12">
            <h1 class="font-heading text-4xl md:text-5xl text-pastel-purple mb-4">
                🛒 Your Cart
            </h1>
            <p class="font-accent text-xl text-pastel-pink">Sweet treats waiting for you!</p>
        </div>

        @if(session('success'))
        <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-2xl">
            {{ session('success') }}
        </div>
        @endif

        @if(session('error'))
        <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-2xl">
            {{ session('error') }}
        </div>
        @endif

        @if($isEmpty)
        <div class="bg-white rounded-3xl shadow-soft p-12 text-center">
            <div class="text-8xl mb-6">🧁</div>
            <h2 class="font-heading text-2xl text-gray-800 mb-4">Your cart is empty</h2>
            <p class="text-gray-600 mb-8">Time to add some delicious treats!</p>
            <a href="{{ url('/') }}" class="inline-block bg-pastel-pink text-white px-8 py-3 rounded-full font-medium hover:bg-pastel-purple transition-colors shadow-soft">
                Browse Products ✨
            </a>
        </div>
        @else
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Cart Items -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-3xl shadow-soft p-6 md:p-8">
                    <div class="space-y-6">
                        @foreach($cartItems as $item)
                        <div class="flex flex-col sm:flex-row items-center gap-6 p-4 bg-pastel-cream rounded-2xl">
                            <!-- Product Image -->
                            <div class="w-24 h-24 bg-gradient-to-br from-pastel-pink/30 to-pastel-purple/30 rounded-2xl flex items-center justify-center flex-shrink-0">
                                @if($item['product']->primaryImage->first())
                                <img src="{{ asset('storage/' . $item['product']->primaryImage->first()->image_path) }}"
                                     alt="{{ $item['product']->name }}"
                                     class="w-full h-full object-cover rounded-2xl">
                                @else
                                <span class="text-4xl">🧁</span>
                                @endif
                            </div>

                            <!-- Product Info -->
                            <div class="flex-grow text-center sm:text-left">
                                <h3 class="font-heading text-xl text-gray-800 mb-2">{{ $item['product']->name }}</h3>
                                <p class="text-pastel-purple font-semibold text-lg">
                                    Rp {{ number_format($item['product']->price, 0, ',', '.') }}
                                </p>
                            </div>

                            <!-- Quantity Control -->
                            <div class="flex items-center gap-3">
                                <form action="{{ route('cart.update') }}" method="POST" class="flex items-center gap-2">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $item['product']->id }}">
                                    <button type="submit" name="quantity" value="{{ $item['quantity'] - 1 }}"
                                            class="w-10 h-10 bg-pastel-blue text-white rounded-full font-bold text-xl hover:bg-pastel-pink transition-colors shadow-softer">
                                        −
                                    </button>
                                    <input type="number" name="quantity" value="{{ $item['quantity'] }}"
                                           min="1" max="99"
                                           class="w-16 h-10 text-center border-2 border-pastel-purple rounded-xl font-semibold text-lg focus:outline-none focus:ring-2 focus:ring-pastel-pink">
                                    <button type="submit" name="quantity" value="{{ $item['quantity'] + 1 }}"
                                            class="w-10 h-10 bg-pastel-blue text-white rounded-full font-bold text-xl hover:bg-pastel-pink transition-colors shadow-softer">
                                        +
                                    </button>
                                </form>
                            </div>

                            <!-- Item Total & Remove -->
                            <div class="text-center sm:text-right">
                                <p class="font-heading text-xl text-pastel-purple mb-3">
                                    Rp {{ number_format($item['subtotal'], 0, ',', '.') }}
                                </p>
                                <form action="{{ route('cart.remove') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $item['product']->id }}">
                                    <button type="submit"
                                            class="text-red-400 hover:text-red-600 font-medium transition-colors text-sm">
                                        🗑️ Remove
                                    </button>
                                </form>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Cart Summary -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-3xl shadow-soft p-6 md:p-8 sticky top-24">
                    <h2 class="font-heading text-2xl text-pastel-purple mb-6">Order Summary</h2>

                    <div class="space-y-4 mb-6">
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600">Subtotal</span>
                            <span class="font-semibold text-gray-800">
                                Rp {{ number_format($total, 0, ',', '.') }}
                            </span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600">Shipping</span>
                            <span class="font-semibold text-pastel-orange">Calculated at checkout</span>
                        </div>
                        <div class="border-t-2 border-dashed border-pastel-purple/30 pt-4">
                            <div class="flex justify-between items-center">
                                <span class="font-heading text-xl text-pastel-purple">Total</span>
                                <span class="font-heading text-2xl text-pastel-pink">
                                    Rp {{ number_format($total, 0, ',', '.') }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <a href="{{ route('cart.checkout') }}"
                       class="block w-full bg-gradient-to-r from-pastel-pink to-pastel-purple text-white text-center py-4 rounded-full font-heading text-xl hover:shadow-lg transition-all duration-300 mb-4">
                        Checkout via WhatsApp 📱
                    </a>

                    <a href="{{ url('/') }}"
                       class="block w-full bg-pastel-cream text-pastel-purple text-center py-3 rounded-full font-medium hover:bg-pastel-yellow transition-colors">
                        ← Continue Shopping
                    </a>
                </div>
            </div>
        </div>
        @endif
    </div>

    <!-- Footer -->
    <footer class="bg-pastel-purple text-white py-8 mt-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <p class="font-accent">© {{ date('Y') }} Anti Diet Club. Made with 💖</p>
        </div>
    </footer>

</body>
</html>