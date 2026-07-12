@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold text-brand-red">Modifier le client</h1>
        <a href="{{ route('admin.clients.index') }}" class="btn-outline text-sm px-4 py-2 rounded-lg">← Retour</a>
    </div>

    <div class="card p-6">
        <form action="{{ route('admin.clients.update', $client) }}" method="POST">
            @csrf @method('PUT')

            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-300 mb-1">Nom</label>
                <input type="text" name="name" id="name" value="{{ old('name', $client->name) }}" class="w-full rounded-lg border-gray-600 bg-gray-800 text-white shadow-sm focus:border-brand-red focus:ring-brand-red focus:ring-opacity-50" required>
                @error('name')
                    <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-300 mb-1">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email', $client->email) }}" class="w-full rounded-lg border-gray-600 bg-gray-800 text-white shadow-sm focus:border-brand-red focus:ring-brand-red focus:ring-opacity-50" required>
                @error('email')
                    <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="is_admin" class="flex items-center space-x-3 text-sm font-medium text-gray-300">
                    <input type="checkbox" name="is_admin" value="1" id="is_admin" 
                           class="rounded border-gray-600 bg-gray-800 text-brand-red shadow-sm focus:border-brand-red focus:ring-brand-red focus:ring-opacity-50"
                           @if($client->is_admin) checked @endif>
                    <span>Administrateur</span>
                </label>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="btn-primary px-6 py-2.5 rounded-lg">Mettre à jour</button>
            </div>
        </form>
    </div>
</div>
@endsection