@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center px-4 sm:px-6 lg:px-8">
    <div class="card w-full max-w-md p-8">
        <h2 class="text-2xl font-bold text-white text-center mb-6">Connexion</h2>

        @if ($errors->any())
            <div class="bg-red-900/30 border-l-4 border-red-500 text-red-300 p-4 mb-4 rounded-r-lg shadow-sm">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-300 mb-1">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" 
                       class="w-full rounded-lg border-gray-600 bg-gray-800 text-white shadow-sm focus:border-brand-red focus:ring-brand-red" 
                       required autofocus>
            </div>

            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-300 mb-1">Mot de passe</label>
                <input type="password" name="password" id="password" 
                       class="w-full rounded-lg border-gray-600 bg-gray-800 text-white shadow-sm focus:border-brand-red focus:ring-brand-red" 
                       required>
            </div>

            <div class="flex items-center justify-between mb-4">
                <label class="flex items-center text-sm text-gray-300">
                    <input type="checkbox" name="remember" class="rounded border-gray-600 bg-gray-800 text-brand-red shadow-sm focus:ring-brand-red">
                    <span class="ml-2">Se souvenir de moi</span>
                </label>
                <a href="{{ route('password.request') }}" class="text-sm text-brand-red hover:underline">Mot de passe oublié ?</a>
            </div>

            <button type="submit" class="btn-primary w-full py-3">Se connecter</button>

            <p class="text-center text-gray-400 text-sm mt-4">
                Pas encore de compte ? 
                <a href="{{ route('register') }}" class="text-brand-red hover:underline">Créer un compte</a>
            </p>
        </form>
    </div>
</div>
@endsection