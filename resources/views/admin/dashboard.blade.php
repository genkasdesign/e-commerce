@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <h1 class="text-3xl font-bold text-brand-red mb-8">Tableau de bord</h1>

    <!-- Cartes statistiques -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="card p-6 text-center">
            <div class="text-sm text-gray-400">Commandes</div>
            <div class="text-3xl font-bold text-white">{{ $totalOrders }}</div>
        </div>
        <div class="card p-6 text-center">
            <div class="text-sm text-gray-400">Chiffre d'affaires</div>
            <div class="text-3xl font-bold text-brand-red">{{ number_format($totalRevenue, 2) }} $</div>
        </div>
        <div class="card p-6 text-center">
            <div class="text-sm text-gray-400">Clients</div>
            <div class="text-3xl font-bold text-white">{{ $totalCustomers }}</div>
        </div>
        <div class="card p-6 text-center">
            <div class="text-sm text-gray-400">Produits</div>
            <div class="text-3xl font-bold text-white">{{ $totalProducts }}</div>
        </div>
    </div>

    <!-- Graphiques -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
        <div class="card p-6">
            <h2 class="text-xl font-semibold text-white mb-4">Ventes (7 derniers jours)</h2>
            <canvas id="dailyChart" height="200"></canvas>
        </div>
        <div class="card p-6">
            <h2 class="text-xl font-semibold text-white mb-4">Ventes (12 derniers mois)</h2>
            <canvas id="monthlyChart" height="200"></canvas>
        </div>
    </div>

    <!-- Produits les plus consultés -->
    <div class="card p-6 mb-8">
        <h2 class="text-xl font-semibold text-white mb-4">Produits les plus consultés</h2>
        @if($topViewedProducts->count())
            <ul class="divide-y divide-gray-700">
                @foreach($topViewedProducts as $product)
                    <li class="py-2 flex justify-between items-center text-gray-300">
                        <span>{{ $product->name }}</span>
                        <span class="text-sm text-gray-400">{{ $product->views }} vues</span>
                    </li>
                @endforeach
            </ul>
        @else
            <p class="text-gray-400">Aucune donnée pour le moment.</p>
        @endif
    </div>

    <!-- Produits les plus vendus -->
    <div class="card p-6 mb-8">
        <h2 class="text-xl font-semibold text-white mb-4">Produits les plus vendus</h2>
        @if($topProducts->count())
            <ul class="divide-y divide-gray-700">
                @foreach($topProducts as $product)
                    <li class="py-2 flex justify-between items-center text-gray-300">
                        <span>{{ $product->name }}</span>
                        <span class="text-brand-red font-semibold">{{ $product->total_sold }} vendus</span>
                    </li>
                @endforeach
            </ul>
        @else
            <p class="text-gray-400">Aucune vente pour le moment.</p>
        @endif
    </div>

    <!-- Commandes récentes -->
    <div class="card p-6">
        <h2 class="text-xl font-semibold text-white mb-4">Dernières commandes</h2>
        @if($recentOrders->count())
            <table class="min-w-full divide-y divide-gray-700">
                <thead class="text-left text-xs text-gray-400">
                    <tr>
                        <th class="pb-2">#</th>
                        <th class="pb-2">Client</th>
                        <th class="pb-2">Total</th>
                        <th class="pb-2">Statut</th>
                        <th class="pb-2">Date</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-800">
                    @foreach($recentOrders as $order)
                    <tr class="py-2 text-sm text-gray-300">
                        <td class="py-2">{{ $order->id }}</td>
                        <td>{{ $order->user->email }}</td>
                        <td>{{ number_format($order->total, 2) }} $</td>
                        <td>
                            <span class="px-2 py-1 text-xs rounded-full 
                                @if($order->status == 'pending') bg-yellow-900/30 text-yellow-300
                                @elseif($order->status == 'processing') bg-blue-900/30 text-blue-300
                                @elseif($order->status == 'completed') bg-green-900/30 text-green-300
                                @else bg-red-900/30 text-red-300 @endif">
                                {{ ucfirst($order->status) }}
                            </span>
                        </td>
                        <td>{{ $order->created_at->format('d/m/Y') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p class="text-gray-400">Aucune commande récente.</p>
        @endif
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Graphique journalier
    fetch('/admin/charts/daily')
        .then(res => res.json())
        .then(data => {
            const ctx = document.getElementById('dailyChart').getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: data.map(item => item.date),
                    datasets: [{
                        label: 'Ventes (USD)',
                        data: data.map(item => item.total),
                        backgroundColor: 'rgba(230, 57, 70, 0.6)',
                        borderColor: '#E63946',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: { labels: { color: '#e5e7eb' } }
                    },
                    scales: {
                        y: { ticks: { color: '#e5e7eb' } },
                        x: { ticks: { color: '#e5e7eb' } }
                    }
                }
            });
        });

    // Graphique mensuel
    fetch('/admin/charts/monthly')
        .then(res => res.json())
        .then(data => {
            const ctx = document.getElementById('monthlyChart').getContext('2d');
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: data.map(item => item.month),
                    datasets: [{
                        label: 'Ventes (USD)',
                        data: data.map(item => item.total),
                        borderColor: '#E63946',
                        backgroundColor: 'rgba(230, 57, 70, 0.1)',
                        fill: true,
                        tension: 0.3
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: { labels: { color: '#e5e7eb' } }
                    },
                    scales: {
                        y: { ticks: { color: '#e5e7eb' } },
                        x: { ticks: { color: '#e5e7eb' } }
                    }
                }
            });
        });
});
</script>
@endpush
@endsection