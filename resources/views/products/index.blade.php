@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold text-brand-red">Nos Produits</h1>
        <p class="text-sm text-gray-400">{{ $products->total() }} article(s)</p>
    </div>

    @if(session('success'))
        <div class="bg-green-900/30 border-l-4 border-green-500 text-green-300 p-4 mb-6 rounded-r-lg shadow-sm">
            <p>{{ session('success') }}</p>
        </div>
    @endif

    <!-- ===== CARROUSEL ===== -->
    @if($products->count() > 0)
    <div class="swiper mySwiper rounded-xl overflow-hidden mb-8">
        <div class="swiper-wrapper">
            @foreach($products->take(5) as $product)
                <div class="swiper-slide">
                    <div class="relative h-80 md:h-96 bg-gray-800 flex items-center justify-center">
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" class="object-cover w-full h-full" alt="{{ $product->name }}">
                        @else
                            <span class="text-gray-500">Pas d'image</span>
                        @endif
                        <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/80 to-transparent p-6">
                            <h3 class="text-2xl font-bold text-white">{{ $product->name }}</h3>
                            <p class="text-brand-red text-xl font-semibold">{{ number_format($product->price, 2) }} €</p>
                            <a href="{{ route('product.show', $product->slug) }}" class="btn-primary inline-block mt-2 text-sm">Voir</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <!-- Pagination + navigation -->
        <div class="swiper-pagination"></div>
        <div class="swiper-button-next text-white"></div>
        <div class="swiper-button-prev text-white"></div>
    </div>
    @endif

    <!-- Barre de recherche et filtres -->
    <div class="card p-6 mb-8" data-aos="fade-up">
        <form method="GET" action="{{ route('home') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <!-- ... (contenu existant) ... -->
        </form>
    </div>

    <!-- Grille produits avec animations AOS -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        @foreach($products as $product)
            <div class="card group" data-aos="fade-up" data-aos-delay="{{ $loop->index * 50 }}">
                <!-- ... (carte produit existante) ... -->
            </div>
        @endforeach
    </div>

    <!-- Pagination -->
    <div class="mt-8">
        {{ $products->withQueryString()->links() }}
    </div>
</div>
@endsection