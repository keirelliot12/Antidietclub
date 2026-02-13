<nav id="main-navbar" class="fixed top-0 left-0 right-0 z-50 transition-all duration-300 transform translate-y-0">
    <div class="bg-white/80 backdrop-blur-md shadow-softer">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <a href="{{ url('/') }}" class="font-heading text-2xl text-pastel-purple">
                    <span class="text-pastel-pink">Anti</span> Diet Club
                </a>

                <!-- Desktop Navigation -->
                <div class="hidden md:flex space-x-8">
                    <a href="{{ url('/') }}" class="text-gray-700 hover:text-pastel-pink transition-colors font-medium">Home</a>
                    <a href="{{ route('products.index') }}" class="text-gray-700 hover:text-pastel-pink transition-colors font-medium">Products</a>
                    <a href="{{ route('blog.index') }}" class="text-gray-700 hover:text-pastel-pink transition-colors font-medium">Blog</a>
                    <a href="{{ route('cart.index') }}" class="text-gray-700 hover:text-pastel-pink transition-colors font-medium">Cart</a>
                </div>

                <!-- Cart Button -->
                <a href="{{ route('cart.index') }}" class="bg-pastel-pink text-white px-6 py-2 rounded-full font-medium hover:bg-pastel-purple transition-colors shadow-soft flex items-center gap-2">
                    <span>🛒</span>
                    @php
                        $cartService = new \App\Services\CartService();
                        $cartCount = $cartService->getCount();
                    @endphp
                    @if($cartCount > 0)
                        <span class="bg-white text-pastel-pink rounded-full w-5 h-5 flex items-center justify-center text-xs font-semibold">{{ $cartCount }}</span>
                    @endif
                </a>
            </div>
        </div>
    </div>
</nav>

<style>
    .navbar-hidden {
        transform: translateY(-100%) !important;
    }

    .navbar-visible {
        transform: translateY(0) !important;
    }
</style>

<script>
    let lastScroll = 0;
    const navbar = document.getElementById('main-navbar');

    window.addEventListener('scroll', () => {
        const currentScroll = window.pageYOffset;

        // Hide navbar when scrolling down
        if (currentScroll > lastScroll && currentScroll > 100) {
            navbar.classList.add('navbar-hidden');
            navbar.classList.remove('navbar-visible');
        }
        // Show navbar when scrolling up
        else {
            navbar.classList.remove('navbar-hidden');
            navbar.classList.add('navbar-visible');
        }

        lastScroll = currentScroll;
    });
</script>