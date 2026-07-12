@if($products->count() > 0)
<div class="swiper mySwiper rounded-xl overflow-hidden mb-8">
    <div class="swiper-wrapper">
        @foreach($products as $product)
            <div class="swiper-slide">
                <div class="relative h-80 md:h-96 flex items-center justify-center bg-gray-800">
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" 
                             class="absolute inset-0 w-full h-full object-cover opacity-60" 
                             alt="{{ $product->name }}">
                    @endif
                    <div class="relative z-10 text-center text-white p-6 max-w-xl">
                        <h2 class="text-3xl md:text-4xl font-bold">{{ $product->name }}</h2>
                        <p class="text-lg text-gray-200 mt-2">{{ Str::limit($product->description, 100) }}</p>
                        <p class="text-2xl font-bold text-brand-red mt-3">{{ number_format($product->price, 2) }} €</p>
                        <a href="{{ route('product.show', $product->slug) }}" 
                           class="btn-primary inline-block mt-4 px-6 py-2">
                            Voir le produit
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <!-- Navigation -->
    <div class="swiper-button-next !text-white"></div>
    <div class="swiper-button-prev !text-white"></div>
    <!-- Pagination -->
    <div class="swiper-pagination !bottom-4"></div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    new Swiper('.mySwiper', {
        slidesPerView: 1,
        spaceBetween: 0,
        loop: true,
        autoplay: {
            delay: 4000,
            disableOnInteraction: false,
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        effect: 'slide',
    });
});
</script>
@endpush
@endif