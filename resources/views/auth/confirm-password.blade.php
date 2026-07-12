@extends('layouts.auth')

@section('content')
<div class="w-full max-w-md px-4">
    <div class="card p-8">
        <h2 class="text-2xl font-bold text-white text-center mb-6">Confirmer le mot de passe</h2>

        <p class="text-sm text-gray-400 text-center mb-4">
            Veuillez confirmer votre mot de passe avant de continuer.
        </p>

        @if ($errors->any())
            <div class="bg-red-900/30 border-l-4 border-red-500 text-red-300 p-4 mb-4 rounded-r-lg shadow-sm">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('password.confirm') }}">
            @csrf

            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-300 mb-1">Mot de passe</label>
                <input type="password" name="password" id="password" 
                       class="w-full rounded-lg border-gray-600 bg-gray-800 text-white shadow-sm focus:border-brand-red focus:ring-brand-red" 
                       required autofocus>
            </div>

            <button type="submit" class="btn-primary w-full py-3">Confirmer</button>
        </form>
    </div>
</div>
@endsection