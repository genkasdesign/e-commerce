@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold text-brand-red">Mes favoris</h1>
        <p class="text-sm text-gray-400">{{ $wishlists->count() }} produit(s)</p>
    </div>

    @if(session('success'))
        <div class="bg-green-900/30 border-l-4 border-green-500 text-green-300 p-4 mb-6 rounded-r-lg shadow-sm">
            <p>{{ session('success') }}</p>
        </div>
    @endif

    @if($wishlists->count())
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($wishlists as $wishlist)
                <div class="card group">
                    <div class="relative overflow-hidden bg-gray-800 aspect-square flex items-center justify-center">
                        @if($wishlist->product->image)
                            <img src="{{ asset('storage/' . $wishlist->product->image) }}" class="object-cover w-full h-full group-hover:scale-105 transition-transform duration-300" alt="{{ $wishlist->product->name }}">
                        @else
                            <span class="text-gray-500 text-sm">Pas d'image</span>
                        @endif
                    </div>
                    <div class="p-4">
                        <h3 class="text-lg font-semibold text-white truncate">{{ $wishlist->product->name }}</h3>
                        <p class="text-sm text-gray-400 mt-1">{{ number_format($wishlist->product->price, 2) }} €</p>
                        <div class="flex items-center justify-between mt-3">
                            <a href="{{ route('product.show', $wishlist->product->slug) }}" class="btn-outline text-sm px-3 py-1 rounded-lg">Voir</a>
                            <form action="{{ route('wishlist.remove', $wishlist->product) }}" method="POST">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-red-400 hover:text-red-300 transition">Retirer</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="card p-12 text-center">
            <p class="text-gray-400">Vous n'avez aucun produit dans vos favoris.</p>
            <a href="{{ route('dashboard') }}" class="btn-primary inline-block mt-4">Découvrir les produits</a>
        </div>
    @endif
</div>
@endsection