@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
    <h1 class="text-3xl font-bold text-brand-red mb-8">Foire aux questions</h1>

    <div class="space-y-4">
        <div class="card p-6">
            <h3 class="text-lg font-semibold text-white">Comment passer une commande ?</h3>
            <p class="text-gray-300 mt-2">Ajoutez des produits à votre panier, puis validez votre commande en renseignant votre adresse de livraison.</p>
        </div>
        <div class="card p-6">
            <h3 class="text-lg font-semibold text-white">Quels sont les délais de livraison ?</h3>
            <p class="text-gray-300 mt-2">Les délais varient entre 2 et 5 jours ouvrés selon votre localisation.</p>
        </div>
        <div class="card p-6">
            <h3 class="text-lg font-semibold text-white">Puis-je retourner un produit ?</h3>
            <p class="text-gray-300 mt-2">Oui, vous disposez de 14 jours pour retourner un produit non utilisé.</p>
        </div>
        <div class="card p-6">
            <h3 class="text-lg font-semibold text-white">Comment suivre ma commande ?</h3>
            <p class="text-gray-300 mt-2">Connectez-vous à votre espace client et consultez la section "Mes commandes".</p>
        </div>
        <div class="card p-6">
            <h3 class="text-lg font-semibold text-white">Quels moyens de paiement sont acceptés ?</h3>
            <p class="text-gray-300 mt-2">Nous acceptons les cartes bancaires (Visa, Mastercard) et les paiements sécurisés en ligne.</p>
        </div>
    </div>
</div>
@endsection