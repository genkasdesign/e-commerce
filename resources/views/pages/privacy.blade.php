@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
    <h1 class="text-3xl font-bold text-brand-red mb-8">Politique de confidentialité</h1>

    <div class="card p-6 mb-6">
        <h2 class="text-xl font-semibold text-white mb-4">Collecte des données</h2>
        <p class="text-gray-300 leading-relaxed">Nous collectons les données que vous nous fournissez lors de votre inscription, commande ou contact (nom, email, adresse).</p>
    </div>

    <div class="card p-6 mb-6">
        <h2 class="text-xl font-semibold text-white mb-4">Utilisation des données</h2>
        <p class="text-gray-300 leading-relaxed">Vos données sont utilisées pour le traitement des commandes, la communication et l'amélioration de nos services.</p>
    </div>

    <div class="card p-6 mb-6">
        <h2 class="text-xl font-semibold text-white mb-4">Partage des données</h2>
        <p class="text-gray-300 leading-relaxed">Vos données ne sont pas vendues à des tiers. Elles peuvent être partagées avec nos prestataires (livraison, paiement) dans le cadre de l'exécution de votre commande.</p>
    </div>

    <div class="card p-6 mb-6">
        <h2 class="text-xl font-semibold text-white mb-4">Droits des utilisateurs</h2>
        <p class="text-gray-300 leading-relaxed">Conformément au RGPD, vous disposez d’un droit d’accès, de rectification et de suppression de vos données. Contactez-nous pour exercer ces droits.</p>
    </div>

    <div class="card p-6">
        <h2 class="text-xl font-semibold text-white mb-4">Sécurité</h2>
        <p class="text-gray-300 leading-relaxed">Nous mettons en œuvre des mesures de sécurité pour protéger vos données contre tout accès non autorisé.</p>
    </div>
</div>
@endsection