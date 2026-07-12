@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
    <h1 class="text-3xl font-bold text-brand-red mb-6">Laisser un avis</h1>

    @if(session('error'))
        <div class="bg-red-900/30 border-l-4 border-red-500 text-red-300 p-4 mb-6 rounded-r-lg shadow-sm">
            {{ session('error') }}
        </div>
    @endif

    @if($products->count())
        <div class="card p-6">
            <form action="{{ route('reviews.store') }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label for="product_id" class="block text-sm font-medium text-gray-300 mb-1">Produit</label>
                    <select name="product_id" id="product_id" class="w-full rounded-lg border-gray-600 bg-gray-800 text-white shadow-sm focus:border-brand-red focus:ring-brand-red" required>
                        <option value="">Sélectionnez un produit acheté</option>
                        @foreach($products as $product)
                            <option value="{{ $product->id }}" {{ old('product_id') == $product->id ? 'selected' : '' }}>{{ $product->name }}</option>
                        @endforeach
                    </select>
                    @error('product_id')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-300 mb-1">Note</label>
                    <div class="flex flex-row-reverse justify-end space-x-1 space-x-reverse" x-data="{ rating: {{ old('rating', 0) }} }">
                        @for($i=5; $i>=1; $i--)
                            <label class="cursor-pointer text-3xl" :class="rating >= {{ $i }} ? 'text-yellow-400' : 'text-gray-500'">
                                <input type="radio" name="rating" value="{{ $i }}" x-model="rating" class="hidden">
                                ★
                            </label>
                        @endfor
                    </div>
                    @error('rating')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="comment" class="block text-sm font-medium text-gray-300 mb-1">Votre avis</label>
                    <textarea name="comment" id="comment" rows="4" class="w-full rounded-lg border-gray-600 bg-gray-800 text-white shadow-sm focus:border-brand-red focus:ring-brand-red" required>{{ old('comment') }}</textarea>
                    @error('comment')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" class="btn-primary w-full py-3">Publier l'avis</button>
            </form>
        </div>
    @else
        <div class="card p-12 text-center">
            <p class="text-gray-400">Vous n'avez pas encore acheté de produits pour laisser un avis.</p>
            <a href="{{ route('dashboard') }}" class="btn-primary inline-block mt-4">Découvrir nos produits</a>
        </div>
    @endif
</div>
@endsection