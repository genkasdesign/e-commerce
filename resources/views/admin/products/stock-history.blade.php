@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold text-brand-red">Historique des mouvements - {{ $product->name }}</h1>
        <a href="{{ route('admin.products.index') }}" class="btn-outline px-4 py-2">← Retour</a>
    </div>

    <div class="card overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-700">
                <thead class="bg-gray-800/50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-300">Date</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-300">Type</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-300">Quantité</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-300">Stock avant</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-300">Stock après</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-300">Raison</th>
                    </tr>
                </thead>
                <tbody class="bg-gray-900 divide-y divide-gray-800">
                    @forelse($movements as $movement)
                        <tr class="hover:bg-gray-800/50 transition-colors">
                            <td class="px-6 py-4 text-sm text-white">{{ $movement->created_at->format('d/m/Y H:i') }}</td>
                            <td class="px-6 py-4 text-sm">
                                <span class="px-2 py-1 text-xs rounded-full
                                    @if($movement->type == 'in') bg-green-900/30 text-green-300
                                    @else bg-red-900/30 text-red-300 @endif">
                                    {{ $movement->type == 'in' ? 'Entrée' : 'Sortie' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm text-white">{{ $movement->quantity }}</td>
                            <td class="px-6 py-4 text-sm text-gray-300">{{ $movement->stock_before }}</td>
                            <td class="px-6 py-4 text-sm text-gray-300">{{ $movement->stock_after }}</td>
                            <td class="px-6 py-4 text-sm text-gray-300">{{ $movement->reason ?? '-' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-gray-400">Aucun mouvement.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection