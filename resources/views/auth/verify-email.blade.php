@extends('layouts.auth')

@section('content')
<div class="w-full max-w-md px-4">
    <div class="card p-8 text-center">
        <h2 class="text-2xl font-bold text-white mb-4">Vérifiez votre email</h2>

        <p class="text-gray-300 text-sm mb-4">
            Merci de vous être inscrit. Avant de continuer, veuillez vérifier votre adresse email en cliquant sur le lien que nous venons de vous envoyer.
        </p>

        @if (session('status') == 'verification-link-sent')
            <div class="bg-green-900/30 border-l-4 border-green-500 text-green-300 p-4 mb-4 rounded-r-lg shadow-sm text-sm">
                Un nouveau lien de vérification a été envoyé à votre adresse email.
            </div>
        @endif

        <form method="POST" action="{{ route('verification.send') }}" class="inline-block">
            @csrf
            <button type="submit" class="btn-primary px-6 py-2">Renvoyer le lien</button>
        </form>

        <form method="POST" action="{{ route('logout') }}" class="inline-block mt-4">
            @csrf
            <button type="submit" class="text-brand-red hover:underline text-sm">Se déconnecter</button>
        </form>
    </div>
</div>
@endsection