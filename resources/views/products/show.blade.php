@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
    @if(session('success'))
        <div class="bg-green-900/30 border-l-4 border-green-500 text-green-300 p-4 mb-6 rounded-r-lg shadow-sm">
            <p>{{ session('success') }}</p>
        </div>
    @endif
    @if(session('error'))
        <div class="bg-red-900/30 border-l-4 border-red-500 text-red-300 p-4 mb-6 rounded-r-lg shadow-sm">
            <p>{{ session('error') }}</p>
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <!-- Image -->
        <div class="bg-gray-800 rounded-xl overflow-hidden flex items-center justify-center aspect-square">
            @if($product->image)
                <img src="{{ asset('storage/' . $product->image) }}" class="object-cover w-full h-full" alt="{{ $product->name }}">
            @else
                <span class="text-gray-500 text-sm">Aucune image</span>
            @endif
        </div>

        <!-- Informations -->
        <div class="space-y-4">
            <h1 class="text-3xl font-bold text-white">{{ $product->name }}</h1>
            <p class="text-gray-400">Categorie : {{ $product->category->name ?? 'Non categorise' }}</p>
            <p class="text-gray-300 leading-relaxed">{{ $product->description }}</p>
            <p class="text-3xl font-bold text-brand-red">{{ number_format($product->price, 2) }} $</p>
            <p class="text-gray-400">Stock : <span class="text-white font-medium">{{ $product->stock }}</span></p>

            <!-- Panier -->
            @if(!auth()->user() || !auth()->user()->isAdmin())
                <form action="{{ route('cart.add', $product->id) }}" method="POST" class="cart-add-form" data-product-id="{{ $product->id }}">
                    @csrf
                    <div>
                        <label for="quantity" class="block text-sm font-medium text-gray-300 mb-1">Quantite</label>
                        <input type="number" name="quantity" id="quantity" value="1" min="1" max="{{ $product->stock }}" 
                               class="w-24 rounded-lg border-gray-600 bg-gray-800 text-white shadow-sm focus:border-brand-red focus:ring-brand-red">
                    </div>
                    <button type="submit" class="btn-primary px-6 py-2">Ajouter au panier</button>
                </form>
            @else
                <div class="bg-yellow-900/30 border-l-4 border-yellow-500 text-yellow-300 p-4 rounded-lg">
                    Mode administration : vous ne pouvez pas acheter.
                </div>
            @endif

            <!-- Favoris -->
            @auth
                @if(!auth()->user()->isAdmin())
                    @php
                        $inWishlist = auth()->user()->isProductInWishlist($product->id);
                    @endphp
                    @if($inWishlist)
                        <form action="{{ route('wishlist.remove', $product) }}" method="POST" class="inline-block">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-red-400 hover:text-red-300 transition">Retirer des favoris</button>
                        </form>
                    @else
                        <form action="{{ route('wishlist.add', $product) }}" method="POST" class="inline-block">
                            @csrf
                            <button type="submit" class="text-brand-red hover:underline transition">Ajouter aux favoris</button>
                        </form>
                    @endif
                @endif
            @endauth
        </div>
    </div>
</div>
@endsection