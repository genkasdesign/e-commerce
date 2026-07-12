@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold text-brand-red">Gestion des produits</h1>
        <a href="{{ route('admin.products.create') }}" class="btn-primary px-4 py-2">
            + Ajouter un produit
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-900/30 border-l-4 border-green-500 text-green-300 p-4 mb-6 rounded-r-lg shadow-sm">
            <p>{{ session('success') }}</p>
        </div>
    @endif

    <div class="card overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-700">
                <thead class="bg-gray-800/50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider">ID</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider">Image</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider">Nom</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider">Catégorie</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider">Prix</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider">Stock</th>
                        <th class="px-6 py-3 text-right text-xs font-semibold text-gray-300 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-gray-900 divide-y divide-gray-800">
                    @forelse($products as $product)
                        <tr class="hover:bg-gray-800/50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-white">{{ $product->id }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="h-10 w-10 rounded-lg overflow-hidden bg-gray-800">
                                    @if($product->image)
                                        <img src="{{ asset('storage/' . $product->image) }}" class="h-full w-full object-cover" alt="{{ $product->name }}">
                                    @else
                                        <div class="h-full w-full flex items-center justify-center text-gray-500 text-xs">Image</div>
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-white">{{ $product->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">{{ $product->category->name ?? '—' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-white">{{ number_format($product->price, 2) }} $</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                @if($product->stock <= 5)
                                    <span class="text-red-400 font-semibold">{{ $product->stock }}</span>
                                    <span class="text-xs text-red-400 ml-1">⚠️ stock bas</span>
                                @else
                                    <span class="text-white">{{ $product->stock }}</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right">
                                <a href="{{ route('admin.products.show', $product) }}" class="text-blue-400 hover:text-blue-300 transition mr-2">Voir</a>
                                <a href="{{ route('admin.products.edit', $product) }}" class="text-blue-400 hover:text-blue-300 transition mr-2">Modifier</a>
                                <a href="{{ route('admin.products.stock-history', $product) }}" class="text-green-400 hover:text-green-300 transition mr-2">Stock</a>
                                <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="inline-block">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-400 hover:text-red-300 transition" onclick="return confirm('Supprimer ce produit ?')">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-12 text-center text-gray-400">
                                Aucun produit. <a href="{{ route('admin.products.create') }}" class="text-brand-red hover:underline">Ajouter le premier</a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection