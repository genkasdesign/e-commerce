@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold text-brand-red">Ajouter une catégorie</h1>
        <a href="{{ route('admin.categories.index') }}" class="btn-outline text-sm px-4 py-2">← Retour</a>
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
        <form action="{{ route('admin.categories.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-300 mb-1">Nom</label>
                <input type="text" name="name" class="w-full rounded-lg border-gray-600 bg-gray-800 text-white" value="{{ old('name') }}" required>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-300 mb-1">Slug</label>
                <input type="text" name="slug" class="w-full rounded-lg border-gray-600 bg-gray-800 text-white" value="{{ old('slug') }}" required>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-300 mb-1">Description</label>
                <textarea name="description" rows="3" class="w-full rounded-lg border-gray-600 bg-gray-800 text-white">{{ old('description') }}</textarea>
            </div>
            <button type="submit" class="btn-primary w-full py-3">Créer</button>
        </form>
    </div>
</div>
@endsection