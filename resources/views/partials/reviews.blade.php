<div class="mt-16">
    <h2 class="text-2xl font-bold text-white text-center mb-8">Avis clients</h2>
    @if($reviews->count())
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($reviews as $review)
                <div class="card p-6">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-white font-medium">{{ $review->user->name }}</span>
                        <span class="text-yellow-400">
                            @for($i=1; $i<=5; $i++)
                                <span class="text-sm">{{ $i <= $review->rating ? '★' : '☆' }}</span>
                            @endfor
                        </span>
                    </div>
                    <p class="text-gray-300 text-sm">{{ $review->comment }}</p>
                    <p class="text-gray-500 text-xs mt-2">Sur {{ $review->product->name ?? 'un produit' }}</p>
                </div>
            @endforeach
        </div>
    @else
        <p class="text-gray-400 text-center">Aucun avis pour le moment.</p>
    @endif
    @auth
        @if(!auth()->user()->isAdmin())
            <div class="text-center mt-6">
                <a href="{{ route('reviews.create') }}" class="btn-primary inline-block px-6 py-2">Laisser un avis</a>
            </div>
        @endif
    @endauth
</div>