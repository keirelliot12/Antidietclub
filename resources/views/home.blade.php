<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Luwe & Cha-Ology - Dessert & Minuman</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <!-- Fonts now loaded via app.css: DM Sans, Cormorant Garamond, Satisfy -->

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
        /* Botanical Tea Dessert gradient — creamy, warm, earthy */
        .gradient-bg {
            background: linear-gradient(135deg, #F7F1E4 0%, #E9D8B8 45%, #B97861 100%);
        }
        .card-hover {
            transition: all 0.3s ease;
        }
        .card-hover:hover {
            transform: translateY(-8px);
            box-shadow: var(--shadow-soft);
        }
    </style>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-body bg-cream-milk min-h-screen pt-16">

    <!-- Navigation -->
    @include('components.navbar')

    <!-- Hero Section -->
    @if($heroBanner)
    <section class="gradient-bg relative overflow-hidden">
        <!-- Botanical decorations -- subtle cream/gold/olive blobs -->
        <div class="absolute inset-0 opacity-25">
            <div class="absolute top-10 left-10 w-32 h-32 bg-warm-white rounded-full float-animation"></div>
            <div class="absolute top-40 right-20 w-24 h-24 bg-matcha-olive/30 rounded-full float-animation" style="animation-delay: 1s;"></div>
            <div class="absolute bottom-20 left-1/4 w-20 h-20 bg-honey-gold/30 rounded-full float-animation" style="animation-delay: 2s;"></div>
        </div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 md:py-32 relative z-10">
            <div class="text-center">
                @if($heroBanner->subtitle)
                <p class="font-script text-2xl md:text-3xl text-warm-white/95 mb-4">{{ $heroBanner->subtitle }}</p>
                @endif
                <h1 class="font-heading text-5xl md:text-7xl lg:text-8xl text-tea-green mb-6 drop-shadow-md">
                    {{ $heroBanner->title }}
                </h1>
                @if($heroBanner->description)
                <p class="text-lg md:text-xl text-tea-green/90 max-w-3xl mx-auto mb-8">
                    {{ $heroBanner->description }}
                </p>
                @endif
                @if($heroBanner->button_text && $heroBanner->button_link)
                <a href="{{ $heroBanner->button_link }}" class="inline-block bg-soft-terra text-warm-white px-10 py-4 rounded-full font-heading text-xl hover:bg-tea-brown transition-all duration-300 shadow-soft wiggle-animation">
                    {{ $heroBanner->button_text }} ✦
                </a>
                @endif
            </div>
        </div>
        <div class="absolute bottom-0 left-0 right-0">
            <svg viewBox="0 0 1440 120" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 120L60 105C120 90 240 60 360 45C480 30 600 30 720 37.5C840 45 960 60 1080 67.5C1200 75 1320 75 1380 75L1440 75V120H1380C1320 120 1200 120 1080 120C960 120 840 120 720 120C600 120 480 120 360 120C240 120 120 120 60 120H0Z" fill="#F7F1E4"/>
            </svg>
        </div>
    </section>
    @endif

    <!-- Featured Products Section -->
    @if($featuredProducts->count() > 0)
    <section class="py-16 md:py-24 bg-cream">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="font-heading text-4xl md:text-5xl text-tea-green mb-4">
                    ✦ Signature Desserts
                </h2>
                <p class="font-script text-xl text-soft-terra">Our most loved creations</p>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                @foreach($featuredProducts as $product)
                <div class="bg-warm-white rounded-soft shadow-card overflow-hidden card-hover border border-tea-brown/10">
                    <div class="h-48 bg-gradient-to-br from-cream-milk to-matcha-olive/20 flex items-center justify-center">
                        @if($product->primaryImage->first())
                        <img src="{{ asset('storage/' . $product->primaryImage->first()->image_path) }}" 
                             alt="{{ $product->name }}" 
                             class="h-full w-full object-cover">
                        @else
                        <span class="text-5xl text-tea-brown">🍵</span>
                        @endif
                    </div>
                    <div class="p-6">
                        <h3 class="font-body text-lg text-tea-green font-semibold mb-2">{{ $product->name }}</h3>
                        <p class="text-soft-terra font-bold text-2xl mb-4">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                        <button onclick="addToCart({{ $product->id }}, 1)"
                                class="block w-full bg-soft-terra text-warm-white text-center py-3 rounded-full font-heading hover:bg-tea-brown transition-colors mb-2 shadow-soft">
                            Add to Cart 🛒
                        </button>
                        <a href="{{ route('products.show', $product->slug) }}" class="block w-full bg-cream-milk text-tea-green text-center py-2 rounded-full font-medium hover:bg-matcha-olive hover:text-warm-white transition-colors">
                            View Details
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
    <section class="py-16 md:py-24 bg-warm-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="font-heading text-4xl md:text-5xl text-tea-green mb-4">
                    🌿 Browse by Category
                </h2>
                <p class="font-script text-xl text-soft-terra">Find your perfect match</p>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-6">
                @foreach($categories as $category)
                <a href="{{ route('products.index', ['category' => $category->slug]) }}" 
                   class="group block">
                    <div class="rounded-soft p-6 text-center card-hover shadow-card border border-matcha-olive/20"
                         style="background-color: {{ $category->color }}15;">
                        <div class="text-4xl mb-3">{{ $category->icon ?? '🍵' }}</div>
                        <h3 class="font-body text-base text-tea-green font-medium group-hover:text-soft-terra transition-colors">
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
    <section class="py-16 md:py-24 bg-gradient-to-br from-cream-milk/50 to-matcha-olive/10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="font-heading text-4xl md:text-5xl text-tea-green mb-4">
                    💬 Sweet Words
                </h2>
                <p class="font-script text-xl text-soft-terra">What our customers say</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($testimonials as $testimonial)
                <div class="bg-warm-white rounded-soft p-8 shadow-card card-hover border border-tea-brown/10">
                    <div class="flex items-center mb-4">
                        @if($testimonial->customer_photo)
                        <img src="{{ asset('storage/' . $testimonial->customer_photo) }}" 
                             alt="{{ $testimonial->customer_name }}" 
                             class="w-14 h-14 rounded-full object-cover mr-4 border-2 border-soft-terra">
                        @else
                        <div class="w-14 h-14 rounded-full bg-soft-terra flex items-center justify-center mr-4">
                            <span class="text-warm-white font-heading text-xl">{{ substr($testimonial->customer_name, 0, 1) }}</span>
                        </div>
                        @endif
                        <div>
                            <h4 class="font-body text-base text-tea-green font-semibold">{{ $testimonial->customer_name }}</h4>
                            <p class="text-sm text-matcha-olive">{{ $testimonial->customer_role }}</p>
                        </div>
                    </div>
                    <div class="mb-4">
                        @for($i = 1; $i <= 5; $i++)
                        <span class="text-xl {{ $i <= $testimonial->rating ? 'text-honey-gold' : 'text-gray-300' }}">★</span>
                        @endfor
                    </div>
                    <p class="text-tea-green/80 italic">"{{ $testimonial->content }}"</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- CTA Section -->
    <section class="py-12 bg-cream-milk">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="font-heading text-3xl md:text-4xl text-tea-green mb-6">✦ Hubungi Kami</h2>
            <div class="flex flex-wrap justify-center gap-6 mb-6">
                <a href="https://wa.me/{{ $whatsappNumber }}" target="_blank"
                   class="inline-flex items-center gap-2 bg-soft-terra text-warm-white px-8 py-4 rounded-full font-heading text-lg hover:bg-tea-brown transition-colors shadow-soft">
                    WhatsApp Order
                </a>
                <a href="{{ $instagramUrl }}" target="_blank"
                   class="inline-flex items-center gap-2 bg-tea-green text-warm-white px-8 py-4 rounded-full font-heading text-lg hover:bg-matcha-olive transition-colors shadow-soft">
                    Instagram
                </a>
            </div>
            <p class="text-tea-green/80 text-lg font-body">📍 {{ $contactAddress }}</p>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-tea-green text-warm-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">
                <div>
                    <h3 class="font-heading text-2xl mb-4">
                        <span class="text-soft-terra">Luwe</span> & Cha-Ology
                    </h3>
                    <p class="font-script text-lg text-warm-white/80">Dessert & Minuman Spesial!</p>
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
                        <a href="{{ $instagramUrl }}" target="_blank" class="w-12 h-12 bg-warm-white/20 rounded-full flex items-center justify-center hover:bg-soft-terra transition-colors">
                            <span class="text-2xl">📸</span>
                        </a>
                        @endif
                        @if($tiktokUrl)
                        <a href="{{ $tiktokUrl }}" target="_blank" class="w-12 h-12 bg-warm-white/20 rounded-full flex items-center justify-center hover:bg-soft-terra transition-colors">
                            <span class="text-2xl">🎵</span>
                        </a>
                        @endif
                        @if($facebookUrl)
                        <a href="{{ $facebookUrl }}" target="_blank" class="w-12 h-12 bg-warm-white/20 rounded-full flex items-center justify-center hover:bg-soft-terra transition-colors">
                            <span class="text-2xl">👍</span>
                        </a>
                        @endif
                    </div>
                </div>
            </div>
            <div class="border-t border-warm-white/20 pt-8 text-center">
                <p class="font-script text-warm-white/70">© {{ date('Y') }} Luwe & Cha-Ology. Crafted with ✦</p>
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
                        confirmButtonColor: '#8B5E3C',
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
                        confirmButtonColor: '#8B5E3C'
                    });
                }
            }).catch(error => {
                Swal.fire({
                    title: 'Error',
                    text: 'Something went wrong.',
                    icon: 'error',
                    confirmButtonColor: '#8B5E3C'
                });
            });
        }
    </script>

</body>
</html>