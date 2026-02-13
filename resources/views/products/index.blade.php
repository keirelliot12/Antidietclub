<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Products - Anti Diet Club</title>
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
            transform: translateY(-8px);
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.12);
        }
        .wiggle-animation:hover {
            animation: wiggle 0.5s ease-in-out infinite;
        }
        @keyframes wiggle {
            0%, 100% { transform: rotate(-3deg); }
            50% { transform: rotate(3deg); }
        }
        .category-btn {
            transition: all 0.3s ease;
        }
        .category-btn:hover {
            transform: scale(1.05);
        }
        .category-btn.active {
            transform: scale(1.1);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>
<body class="font-body bg-pastel-cream min-h-screen">

    <!-- Navigation -->
    @include('components.navbar')

    <div class="pt-16">

    <!-- Page Header -->
    <section class="gradient-bg relative overflow-hidden py-16">
        <div class="absolute inset-0 opacity-20">
            <div class="absolute top-10 left-10 w-32 h-32 bg-white rounded-full"></div>
            <div class="absolute top-20 right-20 w-24 h-24 bg-pastel-yellow rounded-full"></div>
            <div class="absolute bottom-10 left-1/4 w-20 h-20 bg-pastel-orange rounded-full"></div>
        </div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center">
                <h1 class="font-heading text-4xl md:text-6xl text-white mb-4 drop-shadow-lg">
                    🍪 Our Products
                </h1>
                <p class="font-accent text-xl text-white/90">Delicious treats for every craving</p>
            </div>
        </div>
    </section>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Search Bar -->
        <div class="max-w-2xl mx-auto mb-12">
            <form action="{{ route('products.index') }}" method="GET" class="relative">
                <input type="text" 
                       name="search" 
                       value="{{ request('search') }}"
                       placeholder="Search for your favorite treats..."
                       class="w-full px-6 py-4 rounded-full border-2 border-pastel-pink/30 focus:border-pastel-pink focus:ring-4 focus:ring-pastel-pink/20 outline-none text-lg bg-white shadow-soft">
                <button type="submit" class="absolute right-2 top-2 bg-pastel-pink text-white px-6 py-2 rounded-full font-medium hover:bg-pastel-purple transition-colors">
                    🔍 Search
                </button>
            </form>
        </div>

        <!-- Category Filters -->
        <div class="mb-12">
            <h2 class="font-heading text-2xl text-pastel-purple mb-6 text-center">🎨 Filter by Category</h2>
            <div class="flex flex-wrap justify-center gap-4">
                <a href="{{ route('products.index') }}" 
                   class="category-btn px-6 py-3 rounded-full font-medium shadow-softer {{ !request('category') ? 'active bg-pastel-purple text-white' : 'bg-white text-gray-700 hover:bg-pastel-pink hover:text-white' }}"
                   style="{{ !request('category') ? '' : 'border: 2px solid #FFB6C1;' }}">
                    All Products ✨
                </a>
                @foreach($categories as $category)
                <a href="{{ route('products.index', ['category' => $category->slug]) }}" 
                   class="category-btn px-6 py-3 rounded-full font-medium shadow-softer {{ request('category') === $category->slug ? 'active' : 'bg-white text-gray-700 hover:text-white' }}"
                   style="{{ request('category') === $category->slug 
                       ? 'background-color: ' . $category->color . '; color: white;' 
                       : 'background-color: ' . $category->color . '20; color: ' . $category->color . '; border: 2px solid ' . $category->color . ';' }}">
                    {{ $category->icon ?? '🍪' }} {{ $category->name }}
                </a>
                @endforeach
            </div>
        </div>

        <!-- Products Grid -->
        @if($products->count() > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
            @foreach($products as $product)
            <div class="bg-white rounded-3xl shadow-soft overflow-hidden card-hover">
                <!-- Product Image -->
                <a href="{{ route('products.show', $product->slug) }}" class="block">
                    <div class="h-56 bg-gradient-to-br from-pastel-pink/30 to-pastel-purple/30 flex items-center justify-center relative">
                        @if($product->primaryImage && $product->primaryImage->first())
                        <img src="{{ asset('storage/' . $product->primaryImage->first()->image_path) }}" 
                             alt="{{ $product->name }}" 
                             class="h-full w-full object-cover">
                        @else
                        <span class="text-7xl">🧁</span>
                        @endif
                        @if($product->is_featured)
                        <div class="absolute top-4 right-4 bg-pastel-yellow text-pastel-purple px-3 py-1 rounded-full text-sm font-heading shadow-soft">
                            ⭐ Featured
                        </div>
                        @endif
                    </div>
                </a>
                
                <!-- Product Info -->
                <div class="p-6">
                    <!-- Category Badge -->
                    @if($product->category)
                    <span class="inline-block px-4 py-1 rounded-full text-sm font-medium mb-3"
                          style="background-color: {{ $product->category->color }}20; color: {{ $product->category->color }};">
                        {{ $product->category->icon ?? '🍪' }} {{ $product->category->name }}
                    </span>
                    @endif
                    
                    <!-- Product Name -->
                    <h3 class="font-heading text-xl text-gray-800 mb-2">
                        <a href="{{ route('products.show', $product->slug) }}" class="hover:text-pastel-pink transition-colors">
                            {{ $product->name }}
                        </a>
                    </h3>
                    
                    <!-- Price -->
                    <p class="text-pastel-purple font-heading text-2xl mb-4">
                        Rp {{ number_format($product->price, 0, ',', '.') }}
                    </p>

                    <!-- Add to Cart Button -->
                    <button onclick="addToCart({{ $product->id }}, 1)"
                            class="w-full bg-pastel-blue text-white text-center py-3 rounded-full font-medium hover:bg-pastel-pink transition-colors wiggle-animation mb-2">
                        Add to Cart 🛒
                    </button>

                    <!-- View Detail Button -->
                    <a href="{{ route('products.show', $product->slug) }}"
                       class="block w-full bg-pastel-cream text-pastel-purple text-center py-2 rounded-full font-medium hover:bg-pastel-yellow transition-colors">
                        View Detail 💖
                    </a>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <!-- Empty State -->
        <div class="text-center py-20">
            <div class="text-8xl mb-6">😢</div>
            <h3 class="font-heading text-3xl text-gray-600 mb-4">No Products Found</h3>
            <p class="font-accent text-xl text-pastel-pink mb-8">
                @if(request('search'))
                We couldn't find any products matching "{{ request('search') }}"
                @elseif(request('category'))
                No products available in this category yet
                @else
                No products available at the moment
                @endif
            </p>
            <a href="{{ route('products.index') }}" 
               class="inline-block bg-pastel-pink text-white px-8 py-4 rounded-full font-heading text-lg hover:bg-pastel-purple transition-colors shadow-soft">
                View All Products ✨
            </a>
        </div>
        @endif
    </main>

    <!-- Footer -->
    <footer class="bg-pastel-purple text-white py-12 mt-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">
                <div>
                    <h3 class="font-heading text-2xl mb-4">
                        <span class="text-pastel-pink">Anti</span> Diet Club
                    </h3>
                    <p class="font-accent text-lg">Life's too short for boring food!</p>
                </div>
                <div>
                    <h4 class="font-heading text-xl mb-4">Quick Links</h4>
                    <div class="space-y-2">
                        <a href="/" class="block hover:text-pastel-pink transition-colors">Home</a>
                        <a href="{{ route('products.index') }}" class="block hover:text-pastel-pink transition-colors">Products</a>
                        <a href="#about" class="block hover:text-pastel-pink transition-colors">About</a>
                        <a href="#contact" class="block hover:text-pastel-pink transition-colors">Contact</a>
                    </div>
                </div>
                <div>
                    <h4 class="font-heading text-xl mb-4">Contact</h4>
                    @if($contactEmail ?? null)
                    <p class="mb-2">📧 {{ $contactEmail }}</p>
                    @endif
                    @if($contactPhone ?? null)
                    <p class="mb-2">📱 {{ $contactPhone }}</p>
                    @endif
                    @if($contactAddress ?? null)
                    <p>📍 {{ $contactAddress }}</p>
                    @endif
                </div>
            </div>
            <div class="border-t border-white/20 pt-8 text-center">
                <p class="font-accent">© {{ date('Y') }} Anti Diet Club. Made with 💖</p>
            </div>
        </div>
    </footer>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function addToCart(productId, quantity = 1) {
            const formData = new FormData();
            formData.append('product_id', productId);
            formData.append('quantity', quantity);

            fetch('{{ route('cart.add') }}', {
                method: 'POST',
                body: formData,
                headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content')
                }
            }).then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        title: 'Added to Cart!',
                        text: 'Product has been added to your cart.',
                        icon: 'success',
                        confirmButtonColor: '#FFB6C1',
                        timer: 2000,
                        timerProgressBar: true
                    }).then(() => {
                        location.reload();
                    });
                } else {
                    Swal.fire({
                        title: 'Error',
                        text: 'Could not add item to cart.',
                        icon: 'error',
                        confirmButtonColor: '#FFB6C1'
                    });
                }
            }).catch(error => {
                Swal.fire({
                    title: 'Error',
                    text: 'Something went wrong.',
                    icon: 'error',
                    confirmButtonColor: '#FFB6C1'
                });
            });
        }
    </script>

</body>
</html>