<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - Anti Diet Club</title>
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
</head>
<body class="font-body bg-pastel-cream min-h-screen">

    <!-- Navigation -->
    @include('components.navbar')

    <!-- Checkout Page -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 pt-20">
        <div class="text-center mb-12">
            <h1 class="font-heading text-4xl md:text-5xl text-pastel-purple mb-4">
                📦 Checkout
            </h1>
            <p class="font-accent text-xl text-pastel-pink">Almost there! Complete your order</p>
        </div>

        @if(session('error'))
        <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-2xl">
            {{ session('error') }}
        </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Checkout Form -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-3xl shadow-soft p-6 md:p-8">
                    <h2 class="font-heading text-2xl text-pastel-purple mb-6">📍 Delivery Details</h2>

                    <form action="{{ route('cart.whatsapp') }}" method="POST">
                        @csrf

                        <!-- Name -->
                        <div class="mb-6">
                            <label for="name" class="block text-gray-700 font-medium mb-2">
                                Full Name <span class="text-pastel-pink">*</span>
                            </label>
                            <input type="text"
                                   id="name"
                                   name="name"
                                   required
                                   placeholder="Enter your full name"
                                   class="w-full px-4 py-3 border-2 border-pastel-purple/30 rounded-2xl focus:outline-none focus:ring-2 focus:ring-pastel-pink focus:border-transparent transition-all"
                                   value="{{ old('name') }}">
                            @error('name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Address -->
                        <div class="mb-6">
                            <label for="address" class="block text-gray-700 font-medium mb-2">
                                Delivery Address <span class="text-pastel-pink">*</span>
                            </label>
                            <textarea id="address"
                                      name="address"
                                      required
                                      rows="4"
                                      placeholder="Enter your complete delivery address"
                                      class="w-full px-4 py-3 border-2 border-pastel-purple/30 rounded-2xl focus:outline-none focus:ring-2 focus:ring-pastel-pink focus:border-transparent transition-all resize-none">{{ old('address') }}</textarea>
                            @error('address')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Notes -->
                        <div class="mb-8">
                            <label for="notes" class="block text-gray-700 font-medium mb-2">
                                Order Notes <span class="text-gray-400">(Optional)</span>
                            </label>
                            <textarea id="notes"
                                      name="notes"
                                      rows="3"
                                      placeholder="Any special requests? (e.g., no nuts, gift wrapping)"
                                      class="w-full px-4 py-3 border-2 border-pastel-purple/30 rounded-2xl focus:outline-none focus:ring-2 focus:ring-pastel-pink focus:border-transparent transition-all resize-none">{{ old('notes') }}</textarea>
                            @error('notes')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <button type="submit"
                                class="w-full bg-gradient-to-r from-pastel-pink to-pastel-purple text-white py-4 rounded-full font-heading text-xl hover:shadow-lg transition-all duration-300 flex items-center justify-center gap-2">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                            </svg>
                            Send Order to WhatsApp
                        </button>
                    </form>
                </div>
            </div>

            <!-- Order Summary -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-3xl shadow-soft p-6 md:p-8 sticky top-24">
                    <h2 class="font-heading text-2xl text-pastel-purple mb-6">Order Summary</h2>

                    <!-- Cart Items -->
                    <div class="space-y-4 mb-6 max-h-64 overflow-y-auto">
                        @foreach($cartItems as $item)
                        <div class="flex items-center gap-3 p-3 bg-pastel-cream rounded-xl">
                            <div class="w-12 h-12 bg-gradient-to-br from-pastel-pink/30 to-pastel-purple/30 rounded-lg flex items-center justify-center flex-shrink-0">
                                @if($item['product']->primaryImage->first())
                                <img src="{{ asset('storage/' . $item['product']->primaryImage->first()->image_path) }}"
                                     alt="{{ $item['product']->name }}"
                                     class="w-full h-full object-cover rounded-lg">
                                @else
                                <span class="text-2xl">🧁</span>
                                @endif
                            </div>
                            <div class="flex-grow">
                                <p class="font-medium text-gray-800 text-sm">{{ $item['product']->name }}</p>
                                <p class="text-pastel-purple text-sm">x{{ $item['quantity'] }}</p>
                            </div>
                            <p class="font-semibold text-gray-800 text-sm">
                                Rp {{ number_format($item['subtotal'], 0, ',', '.') }}
                            </p>
                        </div>
                        @endforeach
                    </div>

                    <!-- Totals -->
                    <div class="border-t-2 border-dashed border-pastel-purple/30 pt-4 space-y-3">
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600">Subtotal</span>
                            <span class="font-semibold text-gray-800">
                                Rp {{ number_format($total, 0, ',', '.') }}
                            </span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600">Shipping</span>
                            <span class="font-semibold text-pastel-orange">Calculated later</span>
                        </div>
                        <div class="border-t-2 border-pastel-purple/30 pt-3">
                            <div class="flex justify-between items-center">
                                <span class="font-heading text-xl text-pastel-purple">Total</span>
                                <span class="font-heading text-2xl text-pastel-pink">
                                    Rp {{ number_format($total, 0, ',', '.') }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Back Button -->
                    <div class="mt-6">
                        <a href="{{ route('cart.index') }}"
                           class="block w-full bg-pastel-cream text-pastel-purple text-center py-3 rounded-full font-medium hover:bg-pastel-yellow transition-colors">
                            ← Back to Cart
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-pastel-purple text-white py-8 mt-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <p class="font-accent">© {{ date('Y') }} Anti Diet Club. Made with 💖</p>
        </div>
    </footer>

</body>
</html>