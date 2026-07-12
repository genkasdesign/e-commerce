

<?php $__env->startSection('content'); ?>
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <!-- Message bienvenue invité -->
    <?php if(auth()->guard()->guest()): ?>
        <div class="bg-gradient-to-r from-brand-red/20 to-brand-red/10 border border-brand-red/30 rounded-xl p-6 mb-8 text-center">
            <h2 class="text-2xl font-bold text-white">Bienvenue sur GenShop</h2>
            <p class="text-gray-300 mt-2">
                Creez un compte ou connectez-vous pour profiter de toutes les fonctionnalites :
                panier, commandes, favoris, et bien plus encore.
            </p>
            <div class="mt-4 flex justify-center space-x-4">
                <a href="<?php echo e(route('register')); ?>" class="btn-primary px-6 py-2">Creer un compte</a>
                <a href="<?php echo e(route('login')); ?>" class="btn-outline px-6 py-2">Se connecter</a>
            </div>
        </div>
    <?php endif; ?>

    <!-- Carrousel -->
    <?php if(isset($products) && $products->count() > 0): ?>
    <div class="swiper mySwiper rounded-xl overflow-hidden mb-8">
        <div class="swiper-wrapper">
            <?php $__currentLoopData = $products->take(5); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="swiper-slide">
                    <div class="relative h-80 md:h-96 bg-gray-800 flex items-center justify-center">
                        <?php if($product->image): ?>
                            <img src="<?php echo e(asset('storage/' . $product->image)); ?>" class="object-cover w-full h-full" alt="<?php echo e($product->name); ?>">
                        <?php else: ?>
                            <span class="text-gray-500">Pas d'image</span>
                        <?php endif; ?>
                        <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/80 to-transparent p-6">
                            <h3 class="text-2xl font-bold text-white"><?php echo e($product->name); ?></h3>
                            <p class="text-brand-red text-xl font-semibold"><?php echo e(number_format($product->price, 2)); ?> $</p>
                            <a href="<?php echo e(route('product.show', $product->slug)); ?>" class="btn-primary inline-block mt-2 text-sm">Voir le produit</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <div class="swiper-pagination"></div>
        <div class="swiper-button-next text-white"></div>
        <div class="swiper-button-prev text-white"></div>
    </div>
    <?php endif; ?>

    <!-- Titre -->
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold text-brand-red">Nos Produits</h1>
        <p class="text-sm text-gray-400"><?php echo e($products->total() ?? 0); ?> article(s)</p>
    </div>

    <?php if(session('success')): ?>
        <div class="bg-green-900/30 border-l-4 border-green-500 text-green-300 p-4 mb-6 rounded-r-lg shadow-sm">
            <p><?php echo e(session('success')); ?></p>
        </div>
    <?php endif; ?>
    <?php if(session('error')): ?>
        <div class="bg-red-900/30 border-l-4 border-red-500 text-red-300 p-4 mb-6 rounded-r-lg shadow-sm">
            <p><?php echo e(session('error')); ?></p>
        </div>
    <?php endif; ?>

    <!-- Filtres -->
    <div class="card p-6 mb-8" data-aos="fade-up">
        <form method="GET" action="<?php echo e(route('dashboard')); ?>" class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-1">Rechercher</label>
                <input type="text" name="search" placeholder="Nom du produit..." 
                       class="w-full rounded-lg border-gray-600 bg-gray-800 text-white shadow-sm focus:border-brand-red focus:ring-brand-red"
                       value="<?php echo e(request('search')); ?>">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-1">Categorie</label>
                <select name="category" class="w-full rounded-lg border-gray-600 bg-gray-800 text-white shadow-sm focus:border-brand-red focus:ring-brand-red">
                    <option value="">Toutes</option>
                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($cat->id); ?>" <?php echo e(request('category') == $cat->id ? 'selected' : ''); ?>><?php echo e($cat->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-1">Prix min ($)</label>
                <input type="number" name="price_min" placeholder="0" 
                       class="w-full rounded-lg border-gray-600 bg-gray-800 text-white shadow-sm focus:border-brand-red focus:ring-brand-red"
                       value="<?php echo e(request('price_min')); ?>">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-1">Prix max ($)</label>
                <input type="number" name="price_max" placeholder="1000" 
                       class="w-full rounded-lg border-gray-600 bg-gray-800 text-white shadow-sm focus:border-brand-red focus:ring-brand-red"
                       value="<?php echo e(request('price_max')); ?>">
            </div>
            <div class="md:col-span-4 flex justify-end">
                <button type="submit" class="btn-primary px-6 py-2">Filtrer</button>
                <?php if(request()->anyFilled(['search', 'category', 'price_min', 'price_max'])): ?>
                    <a href="<?php echo e(route('dashboard')); ?>" class="btn-outline ml-3 px-6 py-2">Reinitialiser</a>
                <?php endif; ?>
            </div>
        </form>
    </div>

    <!-- Grille produits -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="card group relative">
                <!-- Favoris -->
                <?php if(auth()->guard()->check()): ?>
                    <?php if(!auth()->user()->isAdmin()): ?>
                        <?php
                            $inWishlist = auth()->user()->isProductInWishlist($product->id);
                        ?>
                        <form id="wishlist-form-<?php echo e($product->id); ?>" 
                              action="<?php echo e($inWishlist ? route('wishlist.remove', $product) : route('wishlist.add', $product)); ?>" 
                              method="POST" 
                              class="absolute top-2 right-2 z-10">
                            <?php echo csrf_field(); ?>
                            <?php if($inWishlist): ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="text-red-500 hover:text-red-700 transition" title="Retirer des favoris">
                                    <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
                                    </svg>
                                </button>
                            <?php else: ?>
                                <button type="submit" class="text-gray-400 hover:text-yellow-400 transition" title="Ajouter aux favoris">
                                    <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
                                    </svg>
                                </button>
                            <?php endif; ?>
                        </form>
                    <?php endif; ?>
                <?php endif; ?>

                <!-- Image -->
                <div class="relative overflow-hidden bg-gray-800 aspect-square flex items-center justify-center">
                    <?php if($product->image): ?>
                        <img src="<?php echo e(asset('storage/' . $product->image)); ?>" class="object-cover w-full h-full group-hover:scale-105 transition-transform duration-300" alt="<?php echo e($product->name); ?>">
                    <?php else: ?>
                        <span class="text-gray-500 text-sm">Pas d'image</span>
                    <?php endif; ?>
                </div>

                <!-- Infos -->
                <div class="p-4">
                    <h3 class="text-lg font-semibold text-white truncate"><?php echo e($product->name); ?></h3>
                    <p class="text-sm text-gray-400 mt-1 h-10 overflow-hidden"><?php echo e(str($product->description)->limit(60)); ?></p>
                    <div class="flex items-center justify-between mt-3">
                        <span class="text-xl font-bold text-brand-red"><?php echo e(number_format($product->price, 2)); ?> $</span>
                        <div class="flex space-x-2">
                            <a href="<?php echo e(route('product.show', $product->slug)); ?>" class="btn-outline text-sm px-3 py-1 rounded-lg">Voir</a>
                            <?php if(auth()->check() && !auth()->user()->isAdmin()): ?>
                                <form action="<?php echo e(route('cart.add', $product->id)); ?>" method="POST" class="cart-add-form" data-product-id="<?php echo e($product->id); ?>">
                                    <?php echo csrf_field(); ?>
                                    <input type="hidden" name="quantity" value="1">
                                    <button type="submit" class="btn-primary text-sm px-3 py-1 rounded-lg">Ajouter au panier</button>
                                </form>
                            <?php else: ?>
                                <a href="<?php echo e(route('login')); ?>" class="btn-outline text-sm px-3 py-1 rounded-lg">Ajouter au panier</a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <!-- Pagination -->
    <div class="mt-8">
        <?php echo e($products->withQueryString()->links()); ?>

    </div>

    <!-- Section avis -->
    <?php echo $__env->make('partials.reviews', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\site-eCommerce\ecommerce\resources\views/dashboard.blade.php ENDPATH**/ ?>