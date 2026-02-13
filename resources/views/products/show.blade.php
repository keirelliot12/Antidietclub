<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $product->name }} - Anti Diet Club</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js" type="module"></script>
    <script src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js" nomodule=""></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
        
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #FFF5F7 0%, #FFF0F5 100%);
        }
        
        .category-badge {
            background: linear-gradient(135deg, #FFB6C1, #FFC0CB);
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #FF69B4, #FF1493);
            transition: all 0.3s ease;
        }
        
        .btn-primary:hover {
            background: linear-gradient(135deg, #FF1493, #FF69B4);
            transform: scale(1.05);
        }
        
        .quantity-btn {
            background: linear-gradient(135deg, #FFB6C1, #FFC0CB);
            transition: all 0.2s ease;
        }
        
        .quantity-btn:hover {
            background: linear-gradient(135deg, #FF69B4, #FF1493);
            transform: scale(1.1);
        }
        
        .related-card {
            transition: all 0.3s ease;
        }
        
        .related-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(255, 182, 193, 0.3);
        }
        
        .info-box {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
        }
    </style>
</head>
<body class="min-h-screen">

    <!-- Navigation -->
    @include('components.navbar')

    <!-- Breadcrumb -->
    <div class="container mx-auto px-4 py-4 pt-20">
        <nav class="flex items-center space-x-2 text-sm">
            <a href="/" class="text-gray-500 hover:text-pink-500">Home</a>
            <ion-icon name="chevron-forward-outline" class="text-gray-400"></ion-icon>
            <a href="{{ route('products.index') }}" class="text-gray-500 hover:text-pink-500">Products</a>
            <ion-icon name="chevron-forward-outline" class="text-gray-400"></ion-icon>
            <span class="text-pink-500">{{ $product->name }}</span>
        </nav>
    </div>

    <!-- Product Detail -->
    <main class="container mx-auto px-4 pb-12">
        <div class="bg-white rounded-3xl shadow-xl overflow-hidden">
            <div class="md:flex">
                <!-- Product Image -->
                <div class="md:w-1/2 p-8">
                    <div class="aspect-square bg-gradient-to-br from-pink-100 to-purple-100 rounded-2xl overflow-hidden">
                        @if($product->primaryImage->first())
                        <img src="{{ $product->primaryImage->first()->image_url }}" 
                             alt="{{ $product->name }}"
                             class="w-full h-full object-cover">
                        @else
                        <div class="w-full h-full flex items-center justify-center">
                            <ion-icon name="image-outline" class="text-8xl text-pink-300"></ion-icon>
                        </div>
                        @endif
                    </div>
                </div>
                
                <!-- Product Info -->
                <div class="md:w-1/2 p-8 flex flex-col justify-center">
                    <!-- Category -->
                    <span class="category-badge text-white text-sm px-4 py-1 rounded-full inline-block w-fit mb-4">
                        {{ $product->category->name }}
                    </span>
                    
                    <!-- Name -->
                    <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-3">
                        {{ $product->name }}
                    </h1>
                    
                    <!-- Featured Badge -->
                    @if($product->is_featured)
                    <div class="flex items-center text-yellow-500 text-sm mb-4">
                        <ion-icon name="star"></ion-icon>
                        <ion-icon name="star"></ion-icon>
                        <ion-icon name="star"></ion-icon>
                        <ion-icon name="star"></ion-icon>
                        <ion-icon name="star"></ion-icon>
                        <span class="ml-2 text-gray-600">Featured Product</span>
                    </div>
                    @endif
                    
                    <!-- Price -->
                    <div class="flex items-baseline space-x-2 mb-6">
                        <p class="text-pink-500 font-bold text-4xl">
                            Rp {{ number_format($product->price, 0, ',', '.') }}
                        </p>
                        @if($product->weight)
                        <p class="text-gray-400">{{ $product->weight }}g</p>
                        @endif
                    </div>
                    
                    <!-- Description -->
                    <div class="mb-6">
                        <h3 class="font-semibold text-gray-700 mb-2">Description</h3>
                        <p class="text-gray-600 leading-relaxed">
                            {{ $product->description }}
                        </p>
                    </div>
                    
                    <!-- Ingredients -->
                    @if($product->ingredients)
                    <div class="mb-6">
                        <h3 class="font-semibold text-gray-700 mb-2">Ingredients</h3>
                        <p class="text-gray-600 leading-relaxed">
                            {{ $product->ingredients }}
                        </p>
                    </div>
                    @endif
                    
                    <!-- Weight Info -->
                    @if($product->weight)
                    <div class="mb-8 info-box rounded-xl p-4">
                        <div class="flex items-center text-gray-600">
                            <ion-icon name="scale-outline" class="text-2xl text-pink-400 mr-3"></ion-icon>
                            <div>
                                <p class="font-medium">Weight: {{ $product->weight }}g</p>
                                <p class="text-sm text-gray-400">Perfect for sharing or enjoying alone</p>
                            </div>
                        </div>
                    </div>
                    @endif
                    
                    <!-- Add to Cart -->
                    <div class="flex items-center space-x-4">
                        <!-- Quantity Selector -->
                        <div class="flex items-center bg-gray-100 rounded-xl">
                            <button type="button" 
                                    class="quantity-btn w-12 h-12 rounded-l-xl flex items-center justify-center text-white"
                                    onclick="updateQuantity(-1)">
                                <ion-icon name="remove"></ion-icon>
                            </button>
                            <input type="number" 
                                   id="quantity" 
                                   name="quantity" 
                                   value="1" 
                                   min="1" 
                                   max="10"
                                   class="w-16 h-12 text-center font-semibold text-gray-800 bg-transparent outline-none"
                                   readonly>
                            <button type="button" 
                                    class="quantity-btn w-12 h-12 rounded-r-xl flex items-center justify-center text-white"
                                    onclick="updateQuantity(1)">
                                <ion-icon name="add"></ion-icon>
                            </button>
                        </div>
                        
                        <!-- Add to Cart Button -->
                        <form action="{{ route('products.add-to-cart', $product->slug) }}" method="POST" class="flex-1">
                            @csrf
                            <input type="hidden" name="quantity" id="quantityInput" value="1">
                            <button type="submit" 
                                    class="w-full btn-primary text-white py-4 rounded-xl font-semibold text-lg flex items-center justify-center space-x-2"
                                    onclick="addToCartAlert(event, '{{ $product->name }}')">
                                <ion-icon name="cart-outline"></ion-icon>
                                <span>Add to Cart</span>
                            </button>
                        </form>
                    </div>
                    
                    <!-- Availability -->
                    @if($product->is_available)
                    <div class="flex items-center text-green-500 mt-4">
                        <ion-icon name="checkmark-circle" class="mr-2"></ion-icon>
                        <span class="text-sm">Available and ready to ship</span>
                    </div>
                    @else
                    <div class="flex items-center text-red-500 mt-4">
                        <ion-icon name="close-circle" class="mr-2"></ion-icon>
                        <span class="text-sm">Currently out of stock</span>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        
        <!-- Related Products -->
        @if($relatedProducts->count() > 0)
        <section class="mt-12">
            <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
                <ion-icon name="heart-outline" class="text-pink-400 mr-2"></ion-icon>
                You May Also Like
            </h2>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($relatedProducts as $related)
                <div class="related-card bg-white rounded-2xl shadow-lg overflow-hidden">
                    <!-- Product Image -->
                    <a href="{{ route('products.show', $related->slug) }}" class="block">
                        <div class="aspect-square bg-gradient-to-br from-pink-100 to-purple-100 flex items-center justify-center">
                            @if($related->primaryImage->first())
                            <img src="{{ $related->primaryImage->first()->image_url }}" 
                                 alt="{{ $related->name }}"
                                 class="w-full h-full object-cover">
                            @else
                            <ion-icon name="image-outline" class="text-4xl text-pink-300"></ion-icon>
                            @endif
                        </div>
                    </a>
                    
                    <!-- Product Info -->
                    <div class="p-4">
                        <span class="category-badge text-white text-xs px-2 py-1 rounded-full">
                            {{ $related->category->name }}
                        </span>
                        
                        <h3 class="font-semibold text-gray-800 mt-2">
                            <a href="{{ route('products.show', $related->slug) }}" class="hover:text-pink-500 transition">
                                {{ $related->name }}
                            </a>
                        </h3>
                        
                        <p class="text-pink-500 font-bold mt-1">
                            Rp {{ number_format($related->price, 0, ',', '.') }}
                        </p>
                    </div>
                </div>
                @endforeach
            </div>
        </section>
        @endif
    </main>

    <!-- Footer -->
    <footer class="bg-white/80 backdrop-blur-md py-8 mt-12">
        <div class="container mx-auto px-4">
            <div class="text-center">
                <span class="text-xl font-bold bg-gradient-to-r from-pink-400 to-purple-400 bg-clip-text text-transparent">
                    Anti Diet Club
                </span>
                <p class="text-gray-500 mt-2">Delicious treats for every occasion</p>
                <p class="text-gray-400 text-sm mt-4">© 2024 Anti Diet Club. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script>
        // Quantity update
        function updateQuantity(change) {
            const quantityInput = document.getElementById('quantity');
            const quantityHidden = document.getElementById('quantityInput');
            let currentValue = parseInt(quantityInput.value);
            
            currentValue += change;
            
            // Ensure quantity is between 1 and 10
            if (currentValue < 1) currentValue = 1;
            if (currentValue > 10) currentValue = 10;
            
            quantityInput.value = currentValue;
            quantityHidden.value = currentValue;
        }
        
        // Add to cart alert
        function addToCartAlert(event, productName) {
            event.preventDefault();
            
            const form = event.target.closest('form');
            const quantity = document.getElementById('quantityInput').value;
            
            const formData = new FormData(form);
            formData.set('quantity', quantity);
            
            fetch(form.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content')
                }
            }).then(response => {
                Swal.fire({
                    title: 'Added to Cart!',
                    text: quantity + ' x ' + productName + ' has been added to your cart.',
                    icon: 'success',
                    confirmButtonColor: '#FF69B4',
                    timer: 2000,
                    timerProgressBar: true
                }).then(() => {
                    location.reload();
                });
            }).catch(error => {
                Swal.fire({
                    title: 'Error',
                    text: 'Could not add item to cart.',
                    icon: 'error',
                    confirmButtonColor: '#FF69B4'
                });
            });
        }
    </script>
</body>
</html>