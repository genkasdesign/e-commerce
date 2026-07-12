@extends('layouts.auth')

@section('content')
<div class="w-full max-w-md px-4">
    <div class="card p-8">
        <h2 class="text-2xl font-bold text-white text-center mb-6">Créer un compte</h2>

        @if ($errors->any())
            <div class="bg-red-900/30 border-l-4 border-red-500 text-red-300 p-4 mb-4 rounded-r-lg shadow-sm">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-300 mb-1">Nom</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" 
                       class="w-full rounded-lg border-gray-600 bg-gray-800 text-white shadow-sm focus:border-brand-red focus:ring-brand-red" 
                       required autofocus>
            </div>

            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-300 mb-1">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" 
                       class="w-full rounded-lg border-gray-600 bg-gray-800 text-white shadow-sm focus:border-brand-red focus:ring-brand-red" 
                       required>
            </div>

            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-300 mb-1">Mot de passe</label>
                <input type="password" name="password" id="password" 
                       class="w-full rounded-lg border-gray-600 bg-gray-800 text-white shadow-sm focus:border-brand-red focus:ring-brand-red" 
                       required>
            </div>

            <div class="mb-4">
                <label for="password_confirmation" class="block text-sm font-medium text-gray-300 mb-1">Confirmer le mot de passe</label>
                <input type="password" name="password_confirmation" id="password_confirmation" 
                       class="w-full rounded-lg border-gray-600 bg-gray-800 text-white shadow-sm focus:border-brand-red focus:ring-brand-red" 
                       required>
            </div>

            <button type="submit" class="btn-primary w-full py-3">S'inscrire</button>

            <p class="text-center text-gray-400 text-sm mt-4">
                Déjà un compte ? 
                <a href="{{ route('login') }}" class="text-brand-red hover:underline">Se connecter</a>
            </p>
        </form>
    </div>
</div>
@endsection