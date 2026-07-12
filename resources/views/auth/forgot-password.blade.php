@extends('layouts.auth')

@section('content')
<div class="w-full max-w-md px-4">
    <div class="card p-8">
        <h2 class="text-2xl font-bold text-white text-center mb-6">Mot de passe oublié</h2>

        <p class="text-sm text-gray-400 text-center mb-6">
            Saisissez votre email et nous vous enverrons un lien pour réinitialiser votre mot de passe.
        </p>

        @if (session('status'))
            <div class="bg-green-900/30 border-l-4 border-green-500 text-green-300 p-4 mb-4 rounded-r-lg shadow-sm">
                {{ session('status') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="bg-red-900/30 border-l-4 border-red-500 text-red-300 p-4 mb-4 rounded-r-lg shadow-sm">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-300 mb-1">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" 
                       class="w-full rounded-lg border-gray-600 bg-gray-800 text-white shadow-sm focus:border-brand-red focus:ring-brand-red" 
                       required autofocus>
            </div>

            <button type="submit" class="btn-primary w-full py-3">Envoyer le lien</button>

            <p class="text-center text-gray-400 text-sm mt-4">
                <a href="{{ route('login') }}" class="text-brand-red hover:underline">Retour à la connexion</a>
            </p>
        </form>
    </div>
</div>
@endsection