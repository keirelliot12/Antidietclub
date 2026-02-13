<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog - Anti Diet Club</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        pacifico: ['Pacifico', 'cursive'],
                        poppins: ['Poppins', 'sans-serif'],
                    },
                    colors: {
                        pastel: {
                            pink: '#FFD1DC',
                            blue: '#AEC6CF',
                            green: '#77DD77',
                            yellow: '#FDFD96',
                            purple: '#B39EB5',
                            lavender: '#E6E6FA',
                            peach: '#FFDAB9',
                            mint: '#98FF98',
                        }
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gradient-to-br from-pastel-lavender via-white to-pastel-pink min-h-screen font-poppins">

    <!-- Navigation -->
    @include('components.navbar')

    <!-- Header -->
    <div class="bg-gradient-to-r from-pastel-pink to-pastel-lavender py-12 pt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl md:text-5xl font-pacifico text-gray-800 mb-4">Blog</h1>
            <p class="text-gray-600 text-lg">Tips, resep, dan inspirasi untuk hidup sehat tanpa diet ketat</p>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Blog Posts Grid -->
            <div class="lg:w-3/4">
                @if($posts->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
                        @foreach($posts as $post)
                            <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                                <!-- Featured Image -->
                                @if($post->featured_image)
                                    <img src="{{ $post->featured_image }}"
                                         alt="{{ $post->title }}"
                                         class="w-full h-48 object-cover">
                                @else
                                    <div class="w-full h-48 bg-gradient-to-br from-pastel-pink to-pastel-purple flex items-center justify-center">
                                        <span class="text-4xl">🌸</span>
                                    </div>
                                @endif

                                <div class="p-6">
                                    <!-- Category Badge -->
                                    @if($post->category)
                                        @php
                                            $categoryColors = [
                                                'tips-tricks' => 'bg-pastel-green text-green-800',
                                                'recipes' => 'bg-pastel-peach text-orange-800',
                                                'default' => 'bg-pastel-blue text-blue-800'
                                            ];
                                            $badgeClass = $categoryColors[$post->category->slug] ?? $categoryColors['default'];
                                        @endphp
                                        <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold {{ $badgeClass }} mb-3">
                                            {{ $post->category->name }}
                                        </span>
                                    @endif

                                    <!-- Title -->
                                    <h2 class="text-xl font-semibold text-gray-800 mb-2 hover:text-pastel-purple transition-colors">
                                        <a href="{{ route('blog.show', $post->slug) }}">
                                            {{ $post->title }}
                                        </a>
                                    </h2>

                                    <!-- Excerpt -->
                                    <p class="text-gray-600 text-sm mb-4 line-clamp-3">
                                        {{ $post->excerpt }}
                                    </p>

                                    <!-- Date -->
                                    <div class="flex items-center justify-between">
                                        <span class="text-gray-400 text-xs">
                                            {{ $post->published_at ? $post->published_at->format('d M Y') : 'Belum dipublikasikan' }}
                                        </span>
                                        <a href="{{ route('blog.show', $post->slug) }}"
                                           class="text-pastel-purple hover:text-pink-500 text-sm font-medium transition-colors">
                                            Baca Selengkapnya →
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    @if($posts->hasPages())
                        <div class="mt-10 flex justify-center">
                            {{ $posts->links() }}
                        </div>
                    @endif
                @else
                    <div class="text-center py-12">
                        <div class="text-6xl mb-4">🌸</div>
                        <h3 class="text-xl font-semibold text-gray-800 mb-2">Belum ada artikel</h3>
                        <p class="text-gray-600">Coba kata kunci pencarian lain atau kategori berbeda.</p>
                    </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="lg:w-1/4 space-y-8">
                <!-- Search -->
                <div class="bg-white rounded-2xl shadow-lg p-6">
                    <h3 class="font-pacifico text-xl text-gray-800 mb-4">Cari Artikel</h3>
                    <form action="{{ route('blog.index') }}" method="GET" class="relative">
                        <input type="text"
                               name="search"
                               value="{{ request('search') }}"
                               placeholder="Cari..."
                               class="w-full px-4 py-3 rounded-xl border-2 border-pastel-lavender focus:border-pastel-purple focus:outline-none transition-colors">
                        <button type="submit" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-pastel-purple">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </button>
                    </form>
                </div>

                <!-- Categories -->
                <div class="bg-white rounded-2xl shadow-lg p-6">
                    <h3 class="font-pacifico text-xl text-gray-800 mb-4">Kategori</h3>
                    <ul class="space-y-2">
                        <li>
                            <a href="{{ route('blog.index') }}"
                               class="block px-4 py-2 rounded-xl {{ !request('category') ? 'bg-pastel-purple text-white' : 'bg-gray-100 text-gray-700 hover:bg-pastel-lavender' }} transition-colors">
                                Semua
                            </a>
                        </li>
                        @foreach($categories as $category)
                            <li>
                                <a href="{{ route('blog.index', ['category' => $category->slug]) }}"
                                   class="block px-4 py-2 rounded-xl {{ request('category') === $category->slug ? 'bg-pastel-purple text-white' : 'bg-gray-100 text-gray-700 hover:bg-pastel-lavender' }} transition-colors">
                                    {{ $category->name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-white/80 backdrop-blur-sm mt-12 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <p class="text-gray-600 font-pacifico text-lg">© {{ date('Y') }} Anti Diet Club. Semua hak dilindungi.</p>
        </div>
    </footer>
</body>
</html>