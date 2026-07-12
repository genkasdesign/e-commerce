@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
    <h1 class="text-3xl font-bold text-brand-red mb-6">Paiement de la commande #{{ $order->id }}</h1>

    <div class="card p-6 mb-6">
        <div class="flex justify-between text-gray-300">
            <span>Total de la commande</span>
            <span class="text-2xl font-bold text-brand-red">{{ number_format($order->total, 2) }} $</span>
        </div>
        <p class="text-sm text-gray-400 mt-2">Vous allez être redirigé vers une simulation de paiement.</p>
    </div>

    @if(session('error'))
        <div class="bg-red-900/30 border-l-4 border-red-500 text-red-300 p-4 mb-6 rounded-r-lg shadow-sm">
            {{ session('error') }}
        </div>
    @endif

    <div class="card p-6">
        <h2 class="text-xl font-semibold text-white mb-4">Choisissez votre moyen de paiement</h2>
        <form action="{{ route('payment.process', $order) }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-300 mb-2">Méthode</label>
                <select name="payment_method" class="w-full rounded-lg border-gray-600 bg-gray-800 text-white shadow-sm focus:border-brand-red focus:ring-brand-red">
                    <option value="carte_bancaire">Carte bancaire (simulé)</option>
                    <option value="paypal">PayPal (simulé)</option>
                    <option value="virement">Virement bancaire (simulé)</option>
                </select>
            </div>
            <div class="flex justify-end space-x-4">
                <a href="{{ route('orders.show', $order) }}" class="btn-outline px-6 py-2">Annuler</a>
                <button type="submit" class="btn-primary px-6 py-2">Payer maintenant</button>
            </div>
        </form>
    </div>

    <div class="card p-6 mt-6 bg-yellow-900/20 border border-yellow-700">
        <p class="text-yellow-300 text-sm">
            ⚠️ Mode test : le paiement est simulé. Dans 80% des cas, il sera accepté.
        </p>
    </div>
</div>
@endsection