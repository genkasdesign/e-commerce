@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold text-brand-red">Détail du produit</h1>
        <div class="flex space-x-3">
            <a href="{{ route('admin.products.edit', $product) }}" class="btn-primary px-4 py-2">Modifier</a>
            <a href="{{ route('admin.products.index') }}" class="btn-outline px-4 py-2">← Retour</a>
        </div>
    </div>

    <div class="card overflow-hidden">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 p-6">
            <!-- Image -->
            <div class="flex items-center justify-center bg-gray-800 rounded-xl aspect-square">
                @if($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}" class="object-cover w-full h-full rounded-xl" alt="{{ $product->name }}">
                @else
                    <span class="text-gray-500 text-sm">Aucune image</span>
                @endif
            </div>

            <!-- Informations -->
            <div class="space-y-4">
                <div>
                    <h2 class="text-2xl font-bold text-white">{{ $product->name }}</h2>
                    <p class="text-sm text-gray-400">Slug : {{ $product->slug }}</p>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <span class="text-xs text-gray-400 uppercase">Catégorie</span>
                        <p class="text-white font-medium">{{ $product->category->name ?? 'Non catégorisé' }}</p>
                    </div>
                    <div>
                        <span class="text-xs text-gray-400 uppercase">Prix</span>
                        <p class="text-xl font-bold text-brand-red">{{ number_format($product->price, 2) }} €</p>
                    </div>
                    <div>
                        <span class="text-xs text-gray-400 uppercase">Stock</span>
                        @if($product->stock <= 5)
                            <p class="text-red-400 font-semibold">{{ $product->stock }} ⚠️ stock bas</p>
                        @else
                            <p class="text-white">{{ $product->stock }}</p>
                        @endif
                    </div>
                    <div>
                        <span class="text-xs text-gray-400 uppercase">ID</span>
                        <p class="text-white">#{{ $product->id }}</p>
                    </div>
                </div>

                <div>
                    <span class="text-xs text-gray-400 uppercase">Description</span>
                    <p class="text-gray-300 mt-1 leading-relaxed">{{ $product->description ?? 'Aucune description' }}</p>
                </div>

                <div class="pt-4 border-t border-gray-700 text-xs text-gray-500">
                    <p>Créé le : {{ $product->created_at->format('d/m/Y à H:i') }}</p>
                    <p>Dernière mise à jour : {{ $product->updated_at->format('d/m/Y à H:i') }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Lien vers la page publique -->
    <div class="mt-6 text-center">
        <a href="{{ route('product.show', $product->slug) }}" target="_blank" class="text-brand-red hover:underline text-sm">
            Voir la page publique du produit ↗
        </a>
    </div>
</div>
@endsection