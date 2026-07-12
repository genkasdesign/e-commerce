@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold text-brand-red">Commande #{{ $order->id }}</h1>
        <a href="{{ route('orders.index') }}" class="btn-outline text-sm px-4 py-2 rounded-lg">
            ← Retour à mes commandes
        </a>
    </div>

    @if(session('status'))
        <div class="bg-blue-900/30 border-l-4 border-blue-500 text-blue-300 p-4 mb-6 rounded-r-lg shadow-sm">
            {{ session('status') }}
        </div>
    @endif

    <!-- Informations générales -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="card p-6">
            <div class="text-sm text-gray-400">Date</div>
            <div class="font-medium text-white mt-1">{{ $order->created_at->format('d/m/Y à H:i') }}</div>
        </div>
        <div class="card p-6">
            <div class="text-sm text-gray-400">Statut</div>
            @php
                $statusColors = [
                    'pending' => 'bg-yellow-900/30 text-yellow-300',
                    'processing' => 'bg-blue-900/30 text-blue-300',
                    'completed' => 'bg-green-900/30 text-green-300',
                    'cancelled' => 'bg-red-900/30 text-red-300',
                ];
            @endphp
            <span class="inline-block mt-1 px-3 py-1 text-xs font-semibold rounded-full {{ $statusColors[$order->status] ?? 'bg-gray-700 text-gray-300' }}">
                {{ __('status.' . $order->status) }}
            </span>
        </div>
        <div class="card p-6">
            <div class="text-sm text-gray-400">Paiement</div>
            @php
                $paymentStatusColors = [
                    'pending' => 'bg-yellow-900/30 text-yellow-300',
                    'paid' => 'bg-green-900/30 text-green-300',
                    'failed' => 'bg-red-900/30 text-red-300',
                ];
            @endphp
            <span class="inline-block mt-1 px-3 py-1 text-xs font-semibold rounded-full {{ $paymentStatusColors[$order->payment_status] ?? 'bg-gray-700 text-gray-300' }}">
                {{ __('status.' . $order->payment_status) }}
            </span>
        </div>
        <div class="card p-6">
            <div class="text-sm text-gray-400">Total</div>
            <div class="text-xl font-bold text-brand-red mt-1">{{ number_format($order->total, 2) }} $</div>
        </div>
    </div>

    <!-- Adresse de livraison -->
    <div class="card p-6 mb-8">
        <h3 class="text-lg font-semibold text-white mb-2">Adresse de livraison</h3>
        <p class="text-gray-300">{{ $order->shipping_address ?? 'Non renseignée' }}</p>
    </div>

    <!-- Produits commandés -->
    <div class="card overflow-hidden">
        <div class="px-6 py-4 bg-gray-800/50 border-b border-gray-700">
            <h3 class="text-lg font-semibold text-white">Produits commandés</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-700">
                <thead class="bg-gray-800/50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider">Produit</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider">Quantité</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider">Prix unitaire</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider">Total</th>
                    </tr>
                </thead>
                <tbody class="bg-gray-900 divide-y divide-gray-800">
                    @foreach($order->items as $item)
                    <tr class="hover:bg-gray-800/50 transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center space-x-3">
                                <div class="h-10 w-10 flex-shrink-0 rounded-lg overflow-hidden bg-gray-800">
                                    @if($item->product && $item->product->image)
                                        <img src="{{ asset('storage/' . $item->product->image) }}" class="h-full w-full object-cover" alt="{{ $item->product->name }}">
                                    @else
                                        <div class="h-full w-full flex items-center justify-center text-gray-500 text-xs">Image</div>
                                    @endif
                                </div>
                                <div>
                                    <div class="text-sm font-medium text-white">{{ $item->product->name ?? 'Produit supprimé' }}</div>
                                    <div class="text-xs text-gray-400">Réf: #{{ $item->product_id }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-white">{{ $item->quantity }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-white">{{ number_format($item->price, 2) }} $</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-brand-red">{{ number_format($item->quantity * $item->price, 2) }} $</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="bg-gray-800/50 px-6 py-4 border-t border-gray-700 flex justify-end">
            <div class="flex items-center space-x-6">
                <span class="text-base font-medium text-white">Total :</span>
                <span class="text-2xl font-bold text-brand-red">{{ number_format($order->total, 2) }} $</span>
            </div>
        </div>
    </div>

    <!-- Bouton de paiement si en attente -->
    @if($order->payment_status === 'pending')
        <div class="mt-8 text-center">
            <a href="{{ route('payment.show', $order) }}" class="btn-primary px-8 py-3 text-lg">
                Payer maintenant
            </a>
        </div>
    @endif
</div>
@endsection