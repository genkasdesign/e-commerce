@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold text-brand-red">Mon profil</h1>
    </div>

    @if(session('status'))
        <div class="bg-green-900/30 border-l-4 border-green-500 text-green-300 p-4 mb-6 rounded-r-lg shadow-sm">
            {{ session('status') }}
        </div>
    @endif

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
        <form method="POST" action="{{ route('profile.update') }}">
            @csrf
            @method('patch')

            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-300 mb-1">Nom</label>
                <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" 
                       class="w-full rounded-lg border-gray-600 bg-gray-800 text-white shadow-sm focus:border-brand-red focus:ring-brand-red" required>
            </div>

            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-300 mb-1">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" 
                       class="w-full rounded-lg border-gray-600 bg-gray-800 text-white shadow-sm focus:border-brand-red focus:ring-brand-red" required>
            </div>

            <button type="submit" class="btn-primary w-full py-3">Mettre à jour</button>
        </form>
    </div>

    <!-- Formulaire de changement de mot de passe (optionnel) -->
    <div class="card p-6 mt-6">
        <h2 class="text-xl font-semibold text-white mb-4">Changer le mot de passe</h2>
        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            @method('put')

            <div class="mb-4">
                <label for="current_password" class="block text-sm font-medium text-gray-300 mb-1">Mot de passe actuel</label>
                <input type="password" name="current_password" id="current_password" 
                       class="w-full rounded-lg border-gray-600 bg-gray-800 text-white shadow-sm focus:border-brand-red focus:ring-brand-red" required>
            </div>

            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-300 mb-1">Nouveau mot de passe</label>
                <input type="password" name="password" id="password" 
                       class="w-full rounded-lg border-gray-600 bg-gray-800 text-white shadow-sm focus:border-brand-red focus:ring-brand-red" required>
            </div>

            <div class="mb-4">
                <label for="password_confirmation" class="block text-sm font-medium text-gray-300 mb-1">Confirmer</label>
                <input type="password" name="password_confirmation" id="password_confirmation" 
                       class="w-full rounded-lg border-gray-600 bg-gray-800 text-white shadow-sm focus:border-brand-red focus:ring-brand-red" required>
            </div>

            <button type="submit" class="btn-primary w-full py-3">Changer le mot de passe</button>
        </form>
    </div>
</div>
@endsection