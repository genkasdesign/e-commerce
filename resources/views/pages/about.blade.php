@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
    <h1 class="text-3xl font-bold text-brand-red mb-8">À propos de GenShop</h1>

    <div class="card p-6 mb-8">
        <h2 class="text-2xl font-semibold text-white mb-4">Qui sommes-nous ?</h2>
        <p class="text-gray-300 leading-relaxed">
            GenShop est une boutique en ligne dédiée à la vente de produits de qualité.
            Fondée en 2025, notre mission est de vous offrir une expérience d'achat simple, rapide et agréable.
        </p>
    </div>

    <div class="card p-6 mb-8">
        <h2 class="text-2xl font-semibold text-white mb-4">Nos valeurs</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="text-center">
                <div class="text-brand-red text-4xl font-bold mb-3">S</div>
                <h3 class="text-white font-semibold">Sécurité</h3>
                <p class="text-gray-400 text-sm">Vos données sont protégées.</p>
            </div>
            <div class="text-center">
                <div class="text-brand-red text-4xl font-bold mb-3">R</div>
                <h3 class="text-white font-semibold">Rapidité</h3>
                <p class="text-gray-400 text-sm">Livraison express dans toute la France.</p>
            </div>
            <div class="text-center">
                <div class="text-brand-red text-4xl font-bold mb-3">Q</div>
                <h3 class="text-white font-semibold">Qualité</h3>
                <p class="text-gray-400 text-sm">Des produits soigneusement sélectionnés.</p>
            </div>
        </div>
    </div>

    <div class="card p-6">
        <h2 class="text-2xl font-semibold text-white mb-4">Notre équipe</h2>
        <p class="text-gray-300 leading-relaxed">
            GenShop est porté par une équipe passionnée, dédiée à vous offrir le meilleur service.
            Pour toute question, vous pouvez nous écrire à 
            <a href="mailto:contact@genshop.com" class="text-brand-red hover:underline">contact@genshop.com</a>
        </p>
    </div>
</div>
@endsection