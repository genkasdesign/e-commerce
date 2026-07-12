@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold text-brand-red">Gestion des catégories</h1>
        <a href="{{ route('admin.categories.create') }}" class="btn-primary px-4 py-2">+ Ajouter</a>
    </div>

    @if(session('success'))
        <div class="bg-green-900/30 border-l-4 border-green-500 text-green-300 p-4 mb-6 rounded-r-lg shadow-sm">
            <p>{{ session('success') }}</p>
        </div>
    @endif

    <div class="card overflow-hidden">
        <table class="min-w-full divide-y divide-gray-700">
            <thead class="bg-gray-800/50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-300">ID</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-300">Nom</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-300">Slug</th>
                    <th class="px-6 py-3 text-right text-xs font-semibold text-gray-300">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-gray-900 divide-y divide-gray-800">
                @forelse($categories as $cat)
                <tr class="hover:bg-gray-800/50 transition-colors">
                    <td class="px-6 py-4 text-sm text-white">{{ $cat->id }}</td>
                    <td class="px-6 py-4 text-sm text-white">{{ $cat->name }}</td>
                    <td class="px-6 py-4 text-sm text-gray-300">{{ $cat->slug }}</td>
                    <td class="px-6 py-4 text-right">
                        <a href="{{ route('admin.categories.edit', $cat) }}" class="text-blue-400 hover:text-blue-300 mr-3">Modifier</a>
                        <form action="{{ route('admin.categories.destroy', $cat) }}" method="POST" class="inline-block">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-red-400 hover:text-red-300" onclick="return confirm('Supprimer ?')">Supprimer</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-6 py-12 text-center text-gray-400">Aucune catégorie.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection