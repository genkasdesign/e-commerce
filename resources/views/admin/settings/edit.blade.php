@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold text-brand-red">Paramètres de la boutique</h1>
    </div>

    @if(session('success'))
        <div class="bg-green-900/30 border-l-4 border-green-500 text-green-300 p-4 mb-6 rounded-r-lg shadow-sm">
            {{ session('success') }}
        </div>
    @endif

    <div class="card p-6">
        <form action="{{ route('admin.settings.update') }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="exchange_rate" class="block text-sm font-medium text-gray-300 mb-1">
                    Taux de change (1 USD = ? CDF)
                </label>
                <input type="number" name="exchange_rate" id="exchange_rate" 
                       value="{{ old('exchange_rate', $exchangeRate) }}" step="0.01" min="1"
                       class="w-full rounded-lg border-gray-600 bg-gray-800 text-white shadow-sm focus:border-brand-red focus:ring-brand-red" required>
                <p class="text-xs text-gray-500 mt-1">Prix en CDF = Prix en USD × Taux de change</p>
            </div>

            <button type="submit" class="btn-primary w-full py-3">Mettre à jour le taux</button>
        </form>
    </div>

    <div class="mt-6 text-sm text-gray-400 text-center">
        Exemple : Si le taux est 2800, un produit à 10 USD coûtera 28 000 CDF.
    </div>
</div>
@endsection