<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Anti Diet Club - Deliciously Different</title>
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
        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }
        @keyframes wiggle {
            0%, 100% { transform: rotate(-3deg); }
            50% { transform: rotate(3deg); }
        }
        .float-animation {
            animation: float 3s ease-in-out infinite;
        }
        .wiggle-animation:hover {
            animation: wiggle 0.5s ease-in-out infinite;
        }
        .gradient-bg {
            background: linear-gradient(135deg, #FFB6C1 0%, #DDA0DD 50%, #B0E0E6 100%);
        }
        .card-hover {
            transition: all 0.3s ease;
        }
        .card-hover:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.12);
        }
    </style>
</head>
<body class="font-body bg-pastel-cream min-h-screen pt-16">

    <!-- Navigation -->
    @include('components.navbar')

    <!-- Hero Section -->
    @if($heroBanner)
    <section class="gradient-bg relative overflow-hidden">
        <div class="absolute inset-0 opacity-20">
            <div class="absolute top-10 left-10 w-32 h-32 bg-white rounded-full float-animation"></div>
            <div class="absolute top-40 right-20 w-24 h-24 bg-pastel-yellow rounded-full float-animation" style="animation-delay: 1s;"></div>
            <div class="absolute bottom-20 left-1/4 w-20 h-20 bg-pastel-orange rounded-full float-animation" style="animation-delay: 2s;"></div>
        </div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 md:py-32 relative z-10">
            <div class="text-center">
                @if($heroBanner->subtitle)
                <p class="font-accent text-xl md:text-2xl text-white mb-4">{{ $heroBanner->subtitle }}</p>
                @endif
                <h1 class="font-heading text-4xl md:text-6xl lg:text-7xl text-white mb-6 drop-shadow-lg">
                    {{ $heroBanner->title }}
                </h1>
                @if($heroBanner->description)
                <p class="text-lg md:text-xl text-white/90 max-w-3xl mx-auto mb-8">
                    {{ $heroBanner->description }}
                </p>
                @endif
                @if($heroBanner->button_text && $heroBanner->button_link)
                <a href="{{ $heroBanner->button_link }}" class="inline-block bg-white text-pastel-pink px-8 py-4 rounded-full font-heading text-xl hover:bg-pastel-yellow hover:text-pastel-purple transition-all duration-300 shadow-lg wiggle-animation">
                    {{ $heroBanner->button_text }} ✨
                </a>
                @endif
            </div>
        </div>
        <div class="absolute bottom-0 left-0 right-0">
            <svg viewBox="0 0 1440 120" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 120L60 105C120 90 240 60 360 45C480 30 600 30 720 37.5C840 45 960 60 1080 67.5C1200 75 1320 75 1380 75L1440 75V120H1380C1320 120 1200 120 1080 120C960 120 840 120 720 120C600 120 480 120 360 120C240 120 120 120 60 120H0Z" fill="#FFF8E7"/>
            </svg>
        </div>
    </section>
    @endif

    <!-- Featured Products Section -->
    @if($featuredProducts->count() > 0)
    <section class="py-16 md:py-24 bg-pastel-cream">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="font-heading text-4xl md:text-5xl text-pastel-purple mb-4">
                    ✨ Featured Treats
                </h2>
                <p class="font-accent text-xl text-pastel-pink">Our most loved goodies</p>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                @foreach($featuredProducts as $product)
                <div class="bg-white rounded-3xl shadow-soft overflow-hidden card-hover">
                    <div class="h-48 bg-gradient-to-br from-pastel-pink/30 to-pastel-purple/30 flex items-center justify-center">
                        @if($product->primaryImage->first())
                        <img src="{{ asset('storage/' . $product->primaryImage->first()->image_path) }}" 
                             alt="{{ $product->name }}" 
                             class="h-full w-full object-cover">
                        @else
                        <span class="text-6xl">🧁</span>
                        @endif
                    </div>
                    <div class="p-6">
                        <h3 class="font-heading text-xl text-gray-800 mb-2">{{ $product->name }}</h3>
                        <p class="text-pastel-purple font-semibold text-2xl mb-4">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                        <button onclick="addToCart({{ $product->id }}, 1)"
                                class="block w-full bg-pastel-blue text-white text-center py-3 rounded-full font-medium hover:bg-pastel-pink transition-colors mb-2">
                            Add to Cart 🛒
                        </button>
                        <a href="{{ route('products.show', $product->slug) }}" class="block w-full bg-pastel-cream text-pastel-purple text-center py-2 rounded-full font-medium hover:bg-pastel-yellow transition-colors">
                            View Details 💖
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- Categories Section -->
    @if($categories->count() > 0)
    <section class="py-16 md:py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="font-heading text-4xl md:text-5xl text-pastel-purple mb-4">
                    🎨 Browse by Category
                </h2>
                <p class="font-accent text-xl text-pastel-pink">Find your perfect match</p>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-6">
                @foreach($categories as $category)
                <a href="{{ route('products.index', ['category' => $category->slug]) }}" 
                   class="group block">
                    <div class="rounded-3xl p-6 text-center card-hover shadow-softer"
                         style="background-color: {{ $category->color }}20; border: 2px solid {{ $category->color }};">
                        <div class="text-4xl mb-3">{{ $category->icon ?? '🍪' }}</div>
                        <h3 class="font-heading text-lg text-gray-800 group-hover:scale-110 transition-transform">
                            {{ $category->name }}
                        </h3>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- Testimonials Section -->
    @if($testimonials->count() > 0)
    <section class="py-16 md:py-24 bg-gradient-to-br from-pastel-yellow/30 to-pastel-orange/30">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="font-heading text-4xl md:text-5xl text-pastel-purple mb-4">
                    💬 Sweet Words
                </h2>
                <p class="font-accent text-xl text-pastel-pink">What our customers say</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($testimonials as $testimonial)
                <div class="bg-white rounded-3xl p-8 shadow-soft card-hover">
                    <div class="flex items-center mb-4">
                        @if($testimonial->customer_photo)
                        <img src="{{ asset('storage/' . $testimonial->customer_photo) }}" 
                             alt="{{ $testimonial->customer_name }}" 
                             class="w-14 h-14 rounded-full object-cover mr-4 border-3 border-pastel-pink">
                        @else
                        <div class="w-14 h-14 rounded-full bg-pastel-pink flex items-center justify-center mr-4">
                            <span class="text-white font-heading text-xl">{{ substr($testimonial->customer_name, 0, 1) }}</span>
                        </div>
                        @endif
                        <div>
                            <h4 class="font-heading text-lg text-gray-800">{{ $testimonial->customer_name }}</h4>
                            <p class="text-sm text-pastel-purple">{{ $testimonial->customer_role }}</p>
                        </div>
                    </div>
                    <div class="mb-4">
                        @for($i = 1; $i <= 5; $i++)
                        <span class="text-2xl {{ $i <= $testimonial->rating ? 'text-pastel-orange' : 'text-gray-300' }}">★</span>
                        @endfor
                    </div>
                    <p class="text-gray-600 italic">"{{ $testimonial->content }}"</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- Footer -->
    <footer class="bg-pastel-purple text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">
                <div>
                    <h3 class="font-heading text-2xl mb-4">
                        <span class="text-pastel-pink">Anti</span> Diet Club
                    </h3>
                    <p class="font-accent text-lg">Life's too short for boring food!</p>
                </div>
                <div>
                    <h4 class="font-heading text-xl mb-4">Contact Us</h4>
                    @if($whatsappNumber)
                    <p class="mb-2">📱 WhatsApp: {{ $whatsappNumber }}</p>
                    @endif
                    @if($contactPhone)
                    <p class="mb-2">📱 {{ $contactPhone }}</p>
                    @endif
                    @if($contactAddress)
                    <p>📍 {{ $contactAddress }}</p>
                    @endif
                </div>
                <div>
                    <h4 class="font-heading text-xl mb-4">Follow Us</h4>
                    <div class="flex space-x-4">
                        @if($instagramUrl)
                        <a href="{{ $instagramUrl }}" target="_blank" class="w-12 h-12 bg-white/20 rounded-full flex items-center justify-center hover:bg-pastel-pink transition-colors">
                            <span class="text-2xl">📸</span>
                        </a>
                        @endif
                        @if($tiktokUrl)
                        <a href="{{ $tiktokUrl }}" target="_blank" class="w-12 h-12 bg-white/20 rounded-full flex items-center justify-center hover:bg-pastel-pink transition-colors">
                            <span class="text-2xl">🎵</span>
                        </a>
                        @endif
                        @if($facebookUrl)
                        <a href="{{ $facebookUrl }}" target="_blank" class="w-12 h-12 bg-white/20 rounded-full flex items-center justify-center hover:bg-pastel-pink transition-colors">
                            <span class="text-2xl">👍</span>
                        </a>
                        @endif
                    </div>
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