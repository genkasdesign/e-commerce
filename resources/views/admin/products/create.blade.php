@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold text-brand-red">Ajouter un produit</h1>
        <a href="{{ route('admin.products.index') }}" class="btn-outline text-sm px-4 py-2 rounded-lg">← Retour</a>
    </div>

    @if ($errors->any())
        <div class="bg-red-900/30 border-l-4 border-red-500 text-red-300 p-4 mb-6 rounded-r-lg shadow-sm">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card p-6">
        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-4">
                <label for="category_id" class="block text-sm font-medium text-gray-300 mb-1">Catégorie</label>
                <select name="category_id" id="category_id" class="w-full rounded-lg border-gray-600 bg-gray-800 text-white shadow-sm focus:border-brand-red focus:ring-brand-red" required>
                    <option value="">Sélectionner</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-300 mb-1">Nom du produit</label>
                <input type="text" name="name" id="name" class="w-full rounded-lg border-gray-600 bg-gray-800 text-white shadow-sm focus:border-brand-red focus:ring-brand-red" value="{{ old('name') }}" required>
            </div>

            <div class="mb-4">
                <label for="slug" class="block text-sm font-medium text-gray-300 mb-1">Slug (URL unique)</label>
                <input type="text" name="slug" id="slug" class="w-full rounded-lg border-gray-600 bg-gray-800 text-white shadow-sm focus:border-brand-red focus:ring-brand-red" value="{{ old('slug') }}" required>
            </div>

            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-gray-300 mb-1">Description</label>
                <textarea name="description" id="description" rows="4" class="w-full rounded-lg border-gray-600 bg-gray-800 text-white shadow-sm focus:border-brand-red focus:ring-brand-red">{{ old('description') }}</textarea>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="mb-4">
                    <label for="price" class="block text-sm font-medium text-gray-300 mb-1">Prix ($)</label>
                    <input type="number" step="0.01" name="price" id="price" class="w-full rounded-lg border-gray-600 bg-gray-800 text-white shadow-sm focus:border-brand-red focus:ring-brand-red" value="{{ old('price') }}" required>
                </div>
                <div class="mb-4">
                    <label for="stock" class="block text-sm font-medium text-gray-300 mb-1">Stock</label>
                    <input type="number" name="stock" id="stock" class="w-full rounded-lg border-gray-600 bg-gray-800 text-white shadow-sm focus:border-brand-red focus:ring-brand-red" value="{{ old('stock') }}" required>
                </div>
            </div>

            <div class="mb-4">
                <label for="image" class="block text-sm font-medium text-gray-300 mb-1">Image (optionnel)</label>
                <input type="file" name="image" id="image" class="w-full rounded-lg border-gray-600 bg-gray-800 text-white shadow-sm focus:border-brand-red focus:ring-brand-red" accept="image/*">
            </div>

            <button type="submit" class="btn-primary w-full py-3">Créer le produit</button>
        </form>
    </div>
</div>
@endsection