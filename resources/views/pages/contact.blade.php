@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
    <h1 class="text-3xl font-bold text-brand-red mb-6">Nous contacter</h1>

    @if(session('success'))
        <div class="bg-green-900/30 border-l-4 border-green-500 text-green-300 p-4 mb-6 rounded-r-lg shadow-sm">
            {{ session('success') }}
        </div>
    @endif

    <div class="card p-6 mb-6">
        <p class="text-gray-300">Vous pouvez nous écrire à l’adresse suivante :</p>
        <p class="text-white font-medium text-lg mt-2">contact@genshop.com</p>
        <p class="text-gray-400 text-sm mt-1">Nous vous répondrons dans les 48 heures.</p>
    </div>

    <div class="card p-6">
        <form action="{{ route('contact.send') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-300 mb-1">Votre nom</label>
                <input type="text" name="name" id="name" class="w-full rounded-lg border-gray-600 bg-gray-800 text-white shadow-sm focus:border-brand-red focus:ring-brand-red" required>
            </div>
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-300 mb-1">Votre email</label>
                <input type="email" name="email" id="email" class="w-full rounded-lg border-gray-600 bg-gray-800 text-white shadow-sm focus:border-brand-red focus:ring-brand-red" required>
            </div>
            <div class="mb-4">
                <label for="message" class="block text-sm font-medium text-gray-300 mb-1">Message</label>
                <textarea name="message" id="message" rows="5" class="w-full rounded-lg border-gray-600 bg-gray-800 text-white shadow-sm focus:border-brand-red focus:ring-brand-red" required></textarea>
            </div>
            <button type="submit" class="btn-primary w-full py-3">Envoyer</button>
        </form>
    </div>
</div>
@endsection