<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $post->title }} - Anti Diet Club</title>
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

    <!-- Breadcrumb -->
    <div class="bg-white/50 py-4 pt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <nav class="flex text-sm text-gray-600">
                <a href="{{ route('home') }}" class="hover:text-pastel-purple transition-colors">Home</a>
                <span class="mx-2">/</span>
                <a href="{{ route('blog.index') }}" class="hover:text-pastel-purple transition-colors">Blog</a>
                <span class="mx-2">/</span>
                <span class="text-pastel-purple">{{ $post->title }}</span>
            </nav>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Blog Post Content -->
            <div class="lg:w-3/4">
                <article class="bg-white rounded-2xl shadow-lg overflow-hidden">
                    <!-- Featured Image -->
                    @if($post->featured_image)
                        <img src="{{ $post->featured_image }}"
                             alt="{{ $post->title }}"
                             class="w-full h-64 md:h-96 object-cover">
                    @else
                        <div class="w-full h-64 md:h-96 bg-gradient-to-br from-pastel-pink to-pastel-purple flex items-center justify-center">
                            <span class="text-6xl">🌸</span>
                        </div>
                    @endif

                    <div class="p-6 md:p-10">
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
                            <span class="inline-block px-4 py-2 rounded-full text-sm font-semibold {{ $badgeClass }} mb-4">
                                {{ $post->category->name }}
                            </span>
                        @endif

                        <!-- Title -->
                        <h1 class="text-3xl md:text-4xl font-pacifico text-gray-800 mb-6 leading-tight">
                            {{ $post->title }}
                        </h1>

                        <!-- Meta Info -->
                        <div class="flex flex-wrap items-center gap-4 mb-8 pb-8 border-b-2 border-pastel-lavender">
                            <div class="flex items-center gap-2 text-gray-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                <span>Anti Diet Club Team</span>
                            </div>
                            <div class="flex items-center gap-2 text-gray-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <span>{{ $post->published_at ? $post->published_at->format('d M Y') : 'Belum dipublikasikan' }}</span>
                            </div>
                        </div>

                        <!-- Content -->
                        <div class="prose prose-lg max-w-none text-gray-700 leading-relaxed">
                            {!! $post->content !!}
                        </div>

                        <!-- Share Buttons -->
                        <div class="mt-10 pt-8 border-t-2 border-pastel-lavender">
                            <h3 class="font-semibold text-gray-800 mb-4">Bagikan Artikel Ini</h3>
                            <div class="flex gap-4">
                                <a href="https://wa.me/?text={{ urlencode($post->title . ' - ' . route('blog.show', $post->slug)) }}"
                                   target="_blank"
                                   class="flex items-center gap-2 px-4 py-2 bg-green-500 text-white rounded-xl hover:bg-green-600 transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                                    </svg>
                                    WhatsApp
                                </a>
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('blog.show', $post->slug)) }}"
                                   target="_blank"
                                   class="flex items-center gap-2 px-4 py-2 bg-blue-600 text-white rounded-xl hover:bg-blue-700 transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                                    </svg>
                                    Facebook
                                </a>
                                <a href="https://twitter.com/intent/tweet?text={{ urlencode($post->title) }}&url={{ urlencode(route('blog.show', $post->slug)) }}"
                                   target="_blank"
                                   class="flex items-center gap-2 px-4 py-2 bg-sky-500 text-white rounded-xl hover:bg-sky-600 transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
                                    </svg>
                                    Twitter
                                </a>
                            </div>
                        </div>
                    </div>
                </article>

                <!-- Back to Blog -->
                <div class="mt-8">
                    <a href="{{ route('blog.index') }}"
                       class="inline-flex items-center gap-2 px-6 py-3 bg-white text-pastel-purple font-semibold rounded-xl shadow-lg hover:shadow-xl hover:bg-pastel-purple hover:text-white transition-all">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Kembali ke Blog
                    </a>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="lg:w-1/4 space-y-8">
                <!-- Recent Posts -->
                <div class="bg-white rounded-2xl shadow-lg p-6">
                    <h3 class="font-pacifico text-xl text-gray-800 mb-4">Artikel Terbaru</h3>
                    @if($recentPosts->count() > 0)
                        <div class="space-y-4">
                            @foreach($recentPosts as $recent)
                                <a href="{{ route('blog.show', $recent->slug) }}" class="block group">
                                    <div class="flex gap-3">
                                        <!-- Thumbnail -->
                                        @if($recent->featured_image)
                                            <img src="{{ $recent->featured_image }}"
                                                 alt="{{ $recent->title }}"
                                                 class="w-20 h-20 object-cover rounded-lg flex-shrink-0">
                                        @else
                                            <div class="w-20 h-20 bg-gradient-to-br from-pastel-pink to-pastel-purple rounded-lg flex items-center justify-center flex-shrink-0">
                                                <span class="text-2xl">🌸</span>
                                            </div>
                                        @endif
                                        <div class="flex-1">
                                            <!-- Category -->
                                            @if($recent->category)
                                                <span class="text-xs text-pastel-purple font-medium">
                                                    {{ $recent->category->name }}
                                                </span>
                                            @endif
                                            <!-- Title -->
                                            <h4 class="text-sm font-semibold text-gray-800 group-hover:text-pastel-purple transition-colors line-clamp-2">
                                                {{ $recent->title }}
                                            </h4>
                                            <!-- Date -->
                                            <span class="text-xs text-gray-400">
                                                {{ $recent->published_at ? $recent->published_at->format('d M Y') : '' }}
                                            </span>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500 text-sm">Belum ada artikel lain.</p>
                    @endif
                </div>

                <!-- Categories -->
                <div class="bg-white rounded-2xl shadow-lg p-6">
                    <h3 class="font-pacifico text-xl text-gray-800 mb-4">Kategori</h3>
                    <ul class="space-y-2">
                        @foreach($categories as $category)
                            <li>
                                <a href="{{ route('blog.index', ['category' => $category->slug]) }}"
                                   class="block px-4 py-2 rounded-xl bg-gray-100 text-gray-700 hover:bg-pastel-lavender hover:text-pastel-purple transition-colors">
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